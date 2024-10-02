<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(ServicesRepository $servicesRepository): Response
  {
    $services = $servicesRepository->findAll();
    return $this->render('pages/home.html.twig', [
      'services' => $services
    ]);
  }
}