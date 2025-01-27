<?php

namespace App\Controller;

use App\Repository\AnimalsRepository;
use App\Repository\HabitatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(HabitatsRepository $habitatsRepository): Response
    {
        $habitats = $habitatsRepository->findAll();
        $iconMenu = $habitatsRepository->find(3)->getIconMenu();

        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats,
            'iconMenu' => $iconMenu
        ]);
    }

    #[Route('/habitats/{name}', name: 'app_habitat')]
    public function habitat(string $name, HabitatsRepository $habitatsRepository): Response
    {
        $habitatSelected = $habitatsRepository->findOneBy(['name' => $name]);
        $animals = $habitatSelected->getAnimals();
        $allAnimals = [];
        foreach($animals as $animal) {
            $allAnimals[] = $animal;
        }
        return $this->render('habitats/habitat.html.twig', [
            'habitatSelected' => $habitatSelected,
            'allAnimals' => $allAnimals
        ]);
    }

    #[Route('/habitats/{name}/{animal}', name: 'app_animal')]
    public function animals(string $name, string $animal, HabitatsRepository $habitatsRepository, AnimalsRepository $animalsRepository): Response
    {
        $habitatSelected = $habitatsRepository->findOneBy(['name' => $name]);
       
        $animals = $habitatSelected->getAnimals();
        $allAnimals = [];
        foreach($animals as $animal) {
            $allAnimals[] = $animal;
        }

        $iconMenu = $allAnimals[0]->getHabitat()->getIconMenu();

        return $this->render('habitats/animals.html.twig', [
            'habitatSelected' => $habitatSelected,
            'allAnimals' => $allAnimals,
            'iconMenu' => $iconMenu
        ]);
    }
}
