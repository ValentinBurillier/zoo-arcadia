<?php

namespace App\Controller;

use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/employe', name: 'app_user')]
    public function index(ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository): Response
    {
        $reviews = $reviewsRepository
            ->createQueryBuilder('r')
            ->andWhere('r.statut = :statut')
            ->setParameter('statut', 'check')
            ->getQuery()
            ->getResult();
   
        $services = $servicesRepository->findAll();
        return $this->render('user/index.html.twig', [
            'services' => $services,
            'reviews' => $reviews
        ]);
    }
}
