<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Fournisseur;
use App\Entity\Codespostaux;
use App\Form\FournisseurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FournisseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fournisseur')]
class FournisseurController extends AbstractController
{
    #[Route('/', name: 'app_fournisseur_index', methods: ['GET'])]
    public function index(FournisseurRepository $fournisseurRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $fournisseurRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        return $this->render('fournisseur/index.html.twig', [
            // 'fournisseurs' => $fournisseurRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_fournisseur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adresse = $form->get('adresse')->getData();
            if ($form->get('adresse')->all()['newVille']->getData() != null){               // On va cherhcher les donnée newVille dans l'adresse
                $ville = new Ville();
                $ville -> setLibelle($form->get('adresse')->all()['newVille']->getData());
                $entityManager -> persist($ville);
                $adresse -> setVille($ville);
            }

            if ($form->get('adresse')->all()['newCP']->getData() != null){    
                $codesPostaux = new Codespostaux();
                $codesPostaux -> setNumero($form->get('adresse')->all()['newCP']->getData());
                $entityManager -> persist($codesPostaux);
                $adresse -> setCodespostaux($codesPostaux);
            }

            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fournisseur/new.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fournisseur_show', methods: ['GET'])]
    public function show(Fournisseur $fournisseur): Response
    {
        return $this->render('fournisseur/show.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_fournisseur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fournisseur $fournisseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fournisseur/edit.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_fournisseur_delete', methods: ['POST'])]
    public function delete(Request $request, Fournisseur $fournisseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fournisseur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fournisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
