<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ville;
use App\Form\UserType;
use App\Entity\Adresse;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Entity\Codespostaux;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $userRepository->paginationQuery(),  
            $request->query->get('page', 1),
            10,
        );

        // Partie pour la recherche de commande par nom
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $searchData->page = $request->query->getInt('page', 1);
            $users = $userRepository->findBySearch($searchData);

            $pagination = $paginator->paginate($users, $searchData->page, 10);

            return $this->render('user/index.html.twig', [
                'form' => $form->createView(),
                'pagination' => $pagination,
            ]);
        }

        return $this->render('user/index.html.twig', [
            // 'users' => $userRepository->findAll(),
            'form' => $form->createView(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/ajouter', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user -> setPassword($userPasswordHasherInterface->hashPassword($user, $form->get('plainPassword')->getData()));

            // Permet d'ajouter une nouvelle ville et un nouveau CP
            $adresse = $form->get('adresse')->getData();
            // dd($form->get('adresse')->all()['newVille']->getData());
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

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user -> setPassword($userPasswordHasherInterface->hashPassword($user, $form->get('plainPassword')->getData()));
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
