<?php

namespace App\Controller;

use App\Entity\Technology;
use App\Form\TechnologyType;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTechnologyController extends AbstractController
{
    #[Route('/admin/technologies', name: 'admin_technologies')]
    public function index(TechnologyRepository $repo): Response
    {
        return $this->render('admin/technology/index.html.twig', [
            'technologies' => $repo->findAll(),
        ]);
    }

    #[Route('/admin/technology/{id}/edit', name: 'admin_technology_edit')]
    public function edit(Technology $technology, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TechnologyType::class, $technology);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($technology);
            $manager->flush();

            $this->addFlash(
                'success',
                "<strong>Succès !</strong> La technologie <strong>{$technology->getName()}</strong> a bien été modifié !"
            );

            return $this->redirectToRoute("admin_technology_edit", [
                "id" => $technology->getId()
            ]);
        }

        return $this->render('admin/technology/edit.html.twig', [
            'form' => $form->createView(),
            'technology' => $technology,
        ]);
    }
}
