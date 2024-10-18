<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
