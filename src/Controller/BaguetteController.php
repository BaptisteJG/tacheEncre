<?php

namespace App\Controller;

use App\Entity\Baguette;
use App\Form\BaguetteType;
use App\Repository\BaguetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/baguette')]
class BaguetteController extends AbstractController
{
    #[Route('/', name: 'app_baguette_index', methods: ['GET'])]
    public function index(BaguetteRepository $baguetteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $baguetteRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('baguette/index.html.twig', [
            // 'baguettes' => $baguetteRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_baguette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $baguette = new Baguette();
        $form = $this->createForm(BaguetteType::class, $baguette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($baguette);
            $entityManager->flush();

            return $this->redirectToRoute('app_baguette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('baguette/new.html.twig', [
            'baguette' => $baguette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_baguette_show', methods: ['GET'])]
    public function show(Baguette $baguette): Response
    {
        return $this->render('baguette/show.html.twig', [
            'baguette' => $baguette,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_baguette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Baguette $baguette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BaguetteType::class, $baguette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_baguette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('baguette/edit.html.twig', [
            'baguette' => $baguette,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_baguette_delete', methods: ['POST'])]
    public function delete(Request $request, Baguette $baguette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$baguette->getId(), $request->request->get('_token'))) {
            $entityManager->remove($baguette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_baguette_index', [], Response::HTTP_SEE_OTHER);
    }
}
