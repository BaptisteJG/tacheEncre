<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Adresse;
use App\Entity\Codespostaux;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/adresse')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    public function index(AdresseRepository $adresseRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $adresseRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('adresse/index.html.twig', [
            // 'adresses' => $adresseRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('newVille')->getData()!=null){
                $ville = new Ville();
                $ville -> setLibelle($form->get('newVille')->getData());
                $entityManager -> persist($ville);
                $adresse -> setVille($ville);
            }
            
            if ($form->get('newCP')->getData()!=null){
                $codesPostaux = new Codespostaux();
                $codesPostaux -> setNumero($form->get('newCP')->getData());
                $entityManager -> persist($codesPostaux);
                $adresse -> setCodespostaux($codesPostaux);
            }

            $entityManager->persist($adresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
