<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Form\SujetType;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\SujetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/sujet')]
class SujetController extends AbstractController
{
    #[Route('/', name: 'app_sujet_index', methods: ['GET'])]
    public function index(SujetRepository $sujetRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $sujetRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        // Partie pour la recherche de commande par nom
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $searchData->page = $request->query->getInt('page', 1);
            $sujets = $sujetRepository->findBySearch($searchData);

            $pagination = $paginator->paginate($sujets, $searchData->page, 10);

            return $this->render('sujet/index.html.twig', [
                'form' => $form->createView(),
                'pagination' => $pagination,
            ]);
        }

        return $this->render('sujet/index.html.twig', [
            // 'sujets' => $sujetRepository->findAll(),
            'form' => $form->createView(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_sujet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sujet = new Sujet();
        $form = $this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($sujet);
            $entityManager->flush();

            return $this->redirectToRoute('app_sujet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sujet/new.html.twig', [
            'sujet' => $sujet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sujet_show', methods: ['GET'])]
    public function show(Sujet $sujet): Response
    {
        return $this->render('sujet/show.html.twig', [
            'sujet' => $sujet,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_sujet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sujet $sujet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sujet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sujet/edit.html.twig', [
            'sujet' => $sujet,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_sujet_delete', methods: ['POST'])]
    public function delete(Request $request, Sujet $sujet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sujet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sujet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sujet_index', [], Response::HTTP_SEE_OTHER);
    }
}
