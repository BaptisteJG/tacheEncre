<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/commande')]
class CommandeController extends AbstractController
{
    #[Route('/', name: 'app_commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        // $form->remove('plainPassword');            // Supprimer le champ du formulaire
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form->get('user'));

            // On vérifie si le client existe, si il n'existe pas on le crée sinon ou lui ajoute la commande
            $email=$form->get('user')->get('email')->getData();
            $user=$userRepository->findOneBy(['email'=>$email]);
            if (is_null($user)){
                // On crée un nouvelle user avec les infos suivante
                $user = new User();
                $user -> setEmail($email);
                $user -> setNom($form->get('user')->get('nom')->getData());
                $user -> setTel($form->get('user')->get('tel')->getData());
                // On crée un mot de passe par défaut 
                $user -> setPassword($userPasswordHasherInterface->hashPassword($user, 'pass785'));
                $user -> setRoles(['ROLE_USER']);
                $entityManager->persist($user);
            }
            $commande->setUser($user);

            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commande_show', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_commande_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
    }


}
