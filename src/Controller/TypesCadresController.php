<?php

namespace App\Controller;

use App\Entity\TypesCadres;
use App\Form\TypesCadresType;
use App\Repository\TypesCadresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/types-cadres')]
class TypesCadresController extends AbstractController
{
    #[Route('/', name: 'app_types_cadres_index', methods: ['GET'])]
    public function index(TypesCadresRepository $typesCadresRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $typesCadresRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('types_cadres/index.html.twig', [
            // 'types_cadres' => $typesCadresRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_types_cadres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typesCadre = new TypesCadres();
        $form = $this->createForm(TypesCadresType::class, $typesCadre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typesCadre);
            $entityManager->flush();

            return $this->redirectToRoute('app_types_cadres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('types_cadres/new.html.twig', [
            'types_cadre' => $typesCadre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_types_cadres_show', methods: ['GET'])]
    public function show(TypesCadres $typesCadre): Response
    {
        return $this->render('types_cadres/show.html.twig', [
            'types_cadre' => $typesCadre,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_types_cadres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypesCadres $typesCadre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypesCadresType::class, $typesCadre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_types_cadres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('types_cadres/edit.html.twig', [
            'types_cadre' => $typesCadre,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_types_cadres_delete', methods: ['POST'])]
    public function delete(Request $request, TypesCadres $typesCadre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesCadre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typesCadre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_types_cadres_index', [], Response::HTTP_SEE_OTHER);
    }
}
