<?php

namespace App\Controller;

use App\Form\ReviewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends AbstractController
{
    #[Route('/avis', name: 'app_reviews')]
    public function index(): Response
    {
        $form = $this->createForm(ReviewsType::class);

        return $this->render('reviews/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
