<?php

namespace App\Controller;

use App\Entity\Verre;
use App\Form\VerreType;
use App\Repository\VerreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/verre')]
class VerreController extends AbstractController
{
    #[Route('/', name: 'app_verre_index', methods: ['GET'])]
    public function index(VerreRepository $verreRepository): Response
    {
        return $this->render('verre/index.html.twig', [
            'verres' => $verreRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_verre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $verre = new Verre();
        $form = $this->createForm(VerreType::class, $verre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($verre);
            $entityManager->flush();

            return $this->redirectToRoute('app_verre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('verre/new.html.twig', [
            'verre' => $verre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_verre_show', methods: ['GET'])]
    public function show(Verre $verre): Response
    {
        return $this->render('verre/show.html.twig', [
            'verre' => $verre,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_verre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Verre $verre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VerreType::class, $verre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_verre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('verre/edit.html.twig', [
            'verre' => $verre,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_verre_delete', methods: ['POST'])]
    public function delete(Request $request, Verre $verre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$verre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($verre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_verre_index', [], Response::HTTP_SEE_OTHER);
    }
}
