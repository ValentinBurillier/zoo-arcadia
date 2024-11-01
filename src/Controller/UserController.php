<?php
// src/Controller/UserController.php

namespace App\Controller;
use App\Entity\Meal;
use App\Form\MealType;
use App\Repository\HabitatRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/employe', name: 'app_user')]
    public function index(ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository, HabitatRepository $habitatRepository): Response
    {
        $reviews = $reviewsRepository
            ->createQueryBuilder('r')
            ->andWhere('r.statut = :statut')
            ->setParameter('statut', 'check')
            ->getQuery()
            ->getResult();

        $habitats = $habitatRepository->findAll();
        $services = $servicesRepository->findAll();

        // Créer un tableau pour stocker les formulaires
        $forms = [];

        // Créer un formulaire pour chaque animal
        foreach ($habitats as $habitat) {
            foreach ($habitat->getAnimals() as $animal) {
                // Créer une nouvelle instance de Meal
                $meal = new Meal();
                $meal->setAnimal($animal); // Associer l'animal

                // Créer le formulaire pour chaque animal
                $form = $this->createForm(MealType::class, $meal);
                $forms[$animal->getId()] = $form->createView(); // Stocker la vue du formulaire
            }
        }

        return $this->render('user/index.html.twig', [
            'habitats' => $habitats,
            'services' => $services,
            'reviews' => $reviews,
            'forms' => $forms // Passer les formulaires à la vue
        ]);
    }
}
