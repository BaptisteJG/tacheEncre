<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\SujetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeClientController extends AbstractController
{
    #[Route('/commande/client', name: 'app_commande_client')]
    public function index(Request $request, CommandeRepository $commandeRepository): Response
    {
        $user = $this->getUser() ;
        // $commande = $commandeRepository->find($request->request->get('id'));
        
        // $reposytory = $this->getDoctrine()->gatRepository(User::class);
        // dd($user);
        return $this->render('commande_client/index.html.twig', [
            'user' => $user,
            'commandes' => $commandeRepository->findBy(['user'=>$user]),
            'controller_name' => 'CommandeClientController',
        ]);
    }

    #[Route('/sujet/commande{id}', name: 'commande_sujet_client', methods: ['GET'])]
    public function sujet(Commande $commande, SujetRepository $sujetRepository): Response
    {
        return $this->render('commande_client/sujet-commande.html.twig', [
            'sujets' => $sujetRepository->findBy(['commande'=>$commande]),
            'commande' => $commande,
        ]);
    }
}
