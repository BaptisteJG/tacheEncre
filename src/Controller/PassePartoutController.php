<?php

namespace App\Controller;

use App\Entity\PassePartout;
use App\Form\PassePartoutType;
use App\Repository\PassePartoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/passe-partout')]
class PassePartoutController extends AbstractController
{
    #[Route('/', name: 'app_passe_partout_index', methods: ['GET'])]
    public function index(PassePartoutRepository $passePartoutRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $passePartoutRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('passe_partout/index.html.twig', [
            // 'passe_partouts' => $passePartoutRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_passe_partout_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $passePartout = new PassePartout();
        $form = $this->createForm(PassePartoutType::class, $passePartout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($passePartout);
            $entityManager->flush();

            return $this->redirectToRoute('app_passe_partout_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('passe_partout/new.html.twig', [
            'passe_partout' => $passePartout,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_passe_partout_show', methods: ['GET'])]
    public function show(PassePartout $passePartout): Response
    {
        return $this->render('passe_partout/show.html.twig', [
            'passe_partout' => $passePartout,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_passe_partout_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PassePartout $passePartout, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PassePartoutType::class, $passePartout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_passe_partout_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('passe_partout/edit.html.twig', [
            'passe_partout' => $passePartout,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_passe_partout_delete', methods: ['POST'])]
    public function delete(Request $request, PassePartout $passePartout, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$passePartout->getId(), $request->request->get('_token'))) {
            $entityManager->remove($passePartout);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_passe_partout_index', [], Response::HTTP_SEE_OTHER);
    }
}
