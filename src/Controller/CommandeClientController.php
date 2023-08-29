<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\SujetRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeClientController extends AbstractController
{
    #[Route('/commande/client', name: 'app_commande_client')]
    public function index(Request $request, CommandeRepository $commandeRepository, PaginatorInterface $paginator): Response
    {
        $user = $this->getUser() ;
        // $commandes = $commandeRepository->findBy(['user'=>$user]);

        $pagination = $paginator->paginate(
            $commandeRepository->paginationClientQuery(['user'=>$user]),  
            $request->query->get('page', 1), // On ajoute le query, on fait passer la page et si il n'y en a pas on ce met sur la 1
            5,  // limite du nombre de commande dans la page
        );

        // dd($user);
        return $this->render('commande_client/index.html.twig', [
            'user' => $user,
            // 'commandes' => $commandes,
            'pagination' => $pagination,
            'controller_name' => 'CommandeClientController',
        ]);
    }

    #[Route('/sujet/commande{id}', name: 'commande_sujet_client', methods: ['GET'])]
    public function sujet(Commande $commande, SujetRepository $sujetRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $sujetRepository->paginationClientQuery(['commande'=>$commande]),  
            $request->query->get('page', 1),
            5,
        );

        return $this->render('commande_client/sujet-commande.html.twig', [
            // 'sujets' => $sujetRepository->findBy(['commande'=>$commande]),
            'pagination' => $pagination,
            'commande' => $commande,
        ]);
    }
}
