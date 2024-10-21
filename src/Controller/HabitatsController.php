<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();
        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats
        ]);
    }

    #[Route('/habitats/{name}', name: 'app_habitat')]
    public function show(string $name, HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();
        $habitat = $habitatRepository->findOneBy(['name' => $name]);
        if(!$habitat) {
            return new JsonResponse(['error' => 'Habitat not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->render('habitats/habitat.html.twig', [
            'habitat' => $habitat,
            'habitats' => $habitats
        ]);
    }

    #[Route('/habitats/{name}/{animal}', name: 'app_animal')]
    public function animals(string $name, string $animal, HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();
        foreach($habitats as $hab) {
            foreach($hab->getAnimals() as $anim){
                if($animal === $anim->getName()) {
                    $image = $anim->getImage();
                }
            };
           
        }
        $habitat = $habitatRepository->findOneBy(['name' => $name]);
        if(!$habitat) {
            return new JsonResponse(['error' => 'Habitat not found'], Response::HTTP_NOT_FOUND);
        }
        return $this->render('habitats/animal.html.twig', [
            'image' => $image,
            'name' => $name,
            'animal' => $animal,
            'habitat' => $habitat,
            'habitats' => $habitats
        ]);
    }
}
