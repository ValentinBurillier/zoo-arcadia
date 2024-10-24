<?php

namespace App\Controller;

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
        return $this->render('user/index.html.twig', [
            'habitats' => $habitats,
            'services' => $services,
            'reviews' => $reviews
        ]);
    }
}
