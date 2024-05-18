<?php

// src/Controller/DjController.php
namespace App\Controller;

use App\Entity\Dj;
use App\Form\DjType;
use App\Repository\DjRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DjController extends AbstractController
{
    #[Route('/djs', name: 'dj_index')]
    public function index(DjRepository $DjRepository): Response
    {
        $djs = $DjRepository->findAll();
        return $this->render('dj/index.html.twig', [
            'djs' => $djs,
        ]);
    }

    #[Route('/dj/new', name: 'dj_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dj = new Dj();
        $form = $this->createForm(DjType::class, $dj);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dj);
            $entityManager->flush();

            return $this->redirectToRoute('dj_index');
        }

        return $this->render('dj/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/dj/{id}', name: 'dj_show')]
    public function show(Dj $dj): Response
    {
        return $this->render('dj/show.html.twig', [
            'dj' => $dj,
        ]);
    }

    #[Route('/dj/{id}/edit', name: 'dj_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Dj $dj, EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authChecker): Response
    {
        // Check if the current user has the required role
        if (!$authChecker->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Only administrators can access this page.');
        }

        $form = $this->createForm(DjType::class, $dj);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('dj_index');
        }

        return $this->render('dj/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/dj/{id}/delete', name: 'dj_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Dj $dj, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $dj->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dj);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dj_index');
    }
}
