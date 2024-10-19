<?php

namespace App\Controller;

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
        // dd($habitats);
        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats
        ]);
    }

    #[Route('/habitats/{name}', name: 'app_habitat')]
    public function show(string $name, HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();
        // dd($habitats);
        $habitat = $habitatRepository->findOneBy(['name' => $name]);
        if(!$habitat) {
            return new JsonResponse(['error' => 'Habitat not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->render('habitats/habitat.html.twig', [
            'habitat' => $habitat,
            'habitats' => $habitats
        ]);
    }
}
