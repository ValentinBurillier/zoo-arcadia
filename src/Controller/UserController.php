<?php
// src/Controller/UserController.php

namespace App\Controller;
use App\Form\AnimalType;
use App\Entity\Animal; // Ajoutez ceci
use App\Entity\Meal;
use App\Form\MealType;
use App\Entity\Habitats;
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
    public function employe(ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository, StatutRepository $statutRepository, HabitatsRepository $habitatsRepository): Response
    {
        $statusChecked = $statutRepository->findOneBy(['statut' => 'checked']);
        $idStatusChecked = $statusChecked->getId();
        $reviews = $reviewsRepository->findBy(['status' => $idStatusChecked]);
        
        $services = $servicesRepository->findAll();

        $habitats = $habitatsRepository->findAll();
  
        return $this->render('user/employe.html.twig', [
            'services' => $services,
            'reviews' => $reviews,
            'habitats' => $habitats
        ]);
    }

    #[Route('/veterinaire', name: 'app_user')]
    public function veterinaire(): Response
    {
        return $this->render('user/veterinaire.html.twig');
    }
}
