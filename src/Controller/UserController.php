<?php
// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\Meals;
use App\Form\MealType;
use App\Repository\AnimalsRepository;
use App\Repository\FoodsRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function employe(
        Request $request,
        ServicesRepository $servicesRepository,
        ReviewsRepository $reviewsRepository,
        StatutRepository $statutRepository,
        AnimalsRepository $animalsRepository,
        FoodsRepository $foodsRepository,
        EntityManagerInterface $em
    ): Response {
        // Vérification du statut "to_checked"
        $statusChecked = $statutRepository->findOneBy(['statut' => 'to_checked']);
        $reviews = $statusChecked ? $reviewsRepository->findBy(['status' => $statusChecked->getId()]) : [];

        // Récupération des données
        $services = $servicesRepository->findAll();
        $animals = $animalsRepository->findAll();
        $foods = $foodsRepository->findAll();

        // Création du formulaire
        $meal = new Meals();
        $formMeal = $this->createForm(MealType::class, $meal, [
            'animals' => $animals,
            'foods' => $foods
        ]);
        $formMeal->handleRequest($request);

        if ($formMeal->isSubmitted() && $formMeal->isValid()) {
            $em->persist($meal);
            $em->flush();
            $this->addFlash('success', 'Le repas a bien été ajouté.');

            return $this->redirectToRoute('app_employe');
        }

        return $this->render('user/employe.html.twig', [
            'services' => $services,
            'reviews' => $reviews,
            'animals' => $animals,
            'foods' => $foods,
            'formMeal' => $formMeal->createView()
        ]);
    }

    #[Route('/employe/services/modifications', name: 'app_modifications_services', methods: ['POST'])]
    public function modificationsServices(Request $request, ServicesRepository $servicesRepository, EntityManagerInterface $em): Response
    {
        $data = $request->request->all();

        if (!isset($data['id'], $data['title'], $data['description'])) {
            $this->addFlash('danger', 'Données invalides.');
            return $this->redirectToRoute('app_employe');
        }

        $service = $servicesRepository->find($data['id']);

        if (!$service) {
            $this->addFlash('danger', 'Service introuvable.');
            return $this->redirectToRoute('app_employe');
        }

        $service->setTitle($data['title']);
        $service->setDescription($data['description']);
        
        $em->persist($service);
        $em->flush();
        
        $this->addFlash('success', 'Le service a bien été modifié.');

        return $this->redirectToRoute('app_employe');
    }

    #[Route('/veterinaire', name: 'app_user')]
    public function veterinaire(): Response
    {
        return $this->render('user/veterinaire.html.twig');
    }
}
