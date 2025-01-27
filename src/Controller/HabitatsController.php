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
    public function animals(string $name, string $animal, HabitatsRepository $habitatsRepository, AnimalRepository $animalRepository): Response
    {
        $habitats = $habitatsRepository->findAll();
        foreach($habitats as $hab) {
            foreach($hab->getAnimals() as $anim){
                if($animal === $anim->getName()) {
                    $image = $anim->getImage();
                }
            };
           
        }
        $animalData = $animalRepository->findOneBy(['name' => $animal]);
        $habitat = $habitatsRepository->findOneBy(['name' => $name]);
        if(!$habitat) {
            return new JsonResponse(['error' => 'Habitat not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->render('habitats/animal.html.twig', [
            'animalData' => $animalData,
            'image' => $image,
            'name' => $name,
            'animal' => $animal,
            'habitat' => $habitat,
            'habitats' => $habitats
        ]);
    }
}
