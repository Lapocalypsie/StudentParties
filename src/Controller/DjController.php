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
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $dj = new Dj();
        $form = $this->createForm(DjType::class, $dj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                $imageDirectory = $this->getParameter('kernel.project_dir') . '/public/DJ';

                if (!file_exists($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                $imageFile->move(
                    $imageDirectory,
                    $newFilename
                );

                $dj->setImagePath('/DJ/' . $newFilename);
            }

            $entityManager->persist($dj);
            $entityManager->flush();

            return $this->redirectToRoute('dj_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dj/new.html.twig', [
            'dj' => $dj,
            'form' => $form,
        ]);
    }

    #[Route('/dj/{id}/edit', name: 'dj_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Dj $dj, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(DjType::class, $dj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                $imageDirectory = $this->getParameter('kernel.project_dir') . '/public/DJ';

                if (!file_exists($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                $imageFile->move(
                    $imageDirectory,
                    $newFilename
                );

                $dj->setImagePath('/DJ/' . $newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('dj_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dj/edit.html.twig', [
            'dj' => $dj,
            'form' => $form,
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

    
    #[Route('/dj/{id}', name:"dj_show", methods: ['GET'])]
    public function show(Dj $dj): Response
    {
        return $this->render('dj/show.html.twig', [
            'dj' => $dj,
        ]);
    }
}
