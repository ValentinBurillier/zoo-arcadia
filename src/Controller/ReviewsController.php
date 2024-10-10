<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends AbstractController
{
    #[Route('/avis', name: 'app_reviews')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Reviews();

        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $cleanPseudo = htmlspecialchars($review->getPseudo(), ENT_QUOTES, 'UTF-8');
            $cleanComment = htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8');
            $score = $review->getScore();

            $review->setPseudo($cleanPseudo);
            $review->setComment($cleanComment);
            $review->setScore($score);

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('reviews/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
