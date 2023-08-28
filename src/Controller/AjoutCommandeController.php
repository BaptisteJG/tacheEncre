<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Sujet;
use App\Entity\Commande;
use App\Form\AjoutCommandeType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/nouvelle_commande')]
class AjoutCommandeController extends AbstractController
{
    #[Route('/', name: 'app_ajout_commande')]
    public function index(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {

        $commande = new Commande();
        $sujet = new Sujet();
        $form = $this->createForm(AjoutCommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $email=$form->get('user')->get('email')->getData();
            $user=$userRepository->findOneBy(['email'=>$email]);
            if (is_null($user)){
                $user = new User();
                $user -> setEmail($email);
                $user -> setNom($form->get('user')->get('nom')->getData());
                $user -> setTel($form->get('user')->get('tel')->getData());
                $user -> setPassword($userPasswordHasherInterface->hashPassword($user, 'pass785'));
                $user -> setRoles(['ROLE_USER']);
                $entityManager->persist($user);
            }
            $commande->setUser($user);

            $entityManager->persist($sujet);
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('app_ajout_commande', [], Response::HTTP_SEE_OTHER);
        }

        // dd($form);
        
        return $this->renderform('ajout_commande/index.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

}