<?php

namespace App\Controller;

use App\Entity\Codespostaux;
use App\Form\CodespostauxType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CodespostauxRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/codespostaux')]
class CodespostauxController extends AbstractController
{
    #[Route('/', name: 'app_codespostaux_index', methods: ['GET'])]
    public function index(CodespostauxRepository $codespostauxRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $codespostauxRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('codespostaux/index.html.twig', [
            // 'codespostauxes' => $codespostauxRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_codespostaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $codespostaux = new Codespostaux();
        $form = $this->createForm(CodespostauxType::class, $codespostaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($codespostaux);
            $entityManager->flush();

            return $this->redirectToRoute('app_codespostaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('codespostaux/new.html.twig', [
            'codespostaux' => $codespostaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_codespostaux_show', methods: ['GET'])]
    public function show(Codespostaux $codespostaux): Response
    {
        return $this->render('codespostaux/show.html.twig', [
            'codespostaux' => $codespostaux,
        ]);
    }

    #[Route('modifier/{id}', name: 'app_codespostaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Codespostaux $codespostaux, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CodespostauxType::class, $codespostaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_codespostaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('codespostaux/edit.html.twig', [
            'codespostaux' => $codespostaux,
            'form' => $form,
        ]);
    }

    #[Route('supprimer/{id}', name: 'app_codespostaux_delete', methods: ['POST'])]
    public function delete(Request $request, Codespostaux $codespostaux, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$codespostaux->getId(), $request->request->get('_token'))) {
            $entityManager->remove($codespostaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_codespostaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
