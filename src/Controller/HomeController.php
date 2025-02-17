<?php

namespace App\Controller;

use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use App\Repository\StatutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository, StatutRepository $statutRepository): Response
  {
    $statusChecked = $statutRepository->findOneBy(['statut' => 'checked']);
    $idStatusChecked = $statusChecked->getId();
    $reviews = $reviewsRepository->findBy(['status' => $idStatusChecked]);

    $services = $servicesRepository->findAll();
    return $this->render('accueil/index.html.twig', [
      'services' => $services,
      'reviews' => $reviews
    ]);
  }
}