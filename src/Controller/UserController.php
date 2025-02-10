<?php
// src/Controller/UserController.php

namespace App\Controller;
use App\Form\AnimalType;
use App\Entity\Animal; // Ajoutez ceci
use App\Entity\Meals;
use App\Form\MealType;
use App\Entity\Services;
use App\Form\ServicesType;
use App\Entity\Habitats;
use App\Repository\AnimalsRepository;
use App\Repository\FoodsRepository;
use App\Repository\HabitatsRepository;
use App\Repository\StatutRepository;
use App\Repository\ReviewsRepository;
use Doctrine\ORM\EntityManagerInterface; // Importez l'interface ici
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function employe(Request $request, ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository, StatutRepository $statutRepository, HabitatsRepository $habitatsRepository, ServicesType $servicesType, EntityManagerInterface $em, AnimalsRepository $animalsRepository, FoodsRepository $foodsRepository): Response
    {
        $statusChecked = $statutRepository->findOneBy(['statut' => 'to_checked']);
        $idStatusChecked = $statusChecked->getId();
        $reviews = $reviewsRepository->findBy(['status' => $idStatusChecked]);
        
        // SERVICES
        $services = $servicesRepository->findAll();

        // Habitats
        $animals = $animalsRepository->findAll();
        $foods = $foodsRepository->findAll();
        // Alimentation
        $meal = new Meals();
        $formMeal = $this->createForm(MealType::class, $meal, [
            'animals' => $animals,
            'foods' => $foods
        ]);
        $formMeal->handleRequest($request);

        if($formMeal->isSubmitted() && $formMeal->isValid()) {
            $em->persist($meal);
            $em->flush();

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

    #[Route('/employe/services/modifications', name:'app_modifications_services')]
    public function modificationsServices(Request $request, ServicesRepository $servicesRepository, EntityManagerInterface $em)
    {
        // Récupéré les données du formulaire soumis
        $data = $request->request->all();
        $serviceInDb = $servicesRepository->find($data['id']);
        $serviceInDb->setTitle($data['title']);
        $serviceInDb->setDescription($data['description']);
        
        // Persister les modifications et flusher la base de données
        $em->persist($serviceInDb);
        $em->flush();
        return $this->redirectToRoute('app_employe');
    }


    #[Route('/veterinaire', name: 'app_user')]
    public function veterinaire(): Response
    {
        return $this->render('user/veterinaire.html.twig');
    }
}
