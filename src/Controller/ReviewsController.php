<?php

namespace App\Controller;

use DateTime;
use App\Entity\Reviews;
use App\Entity\Statut;
use App\Repository\ReviewsRepository;
use App\Form\ReviewsType;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        // Récupérer l'objet Statut avec l'id = 1
        $statut = $entityManager->getRepository(Statut::class)->find(1);

        // Si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // Si le formulaire est valide, enregistrer les données
            if ($form->isValid()) {
                
                $cleanPseudo = htmlspecialchars($review->getPseudo(), ENT_QUOTES, 'UTF-8');
                $cleanComment = htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8');
                $score = $review->getScore();
                $date = new DateTime();
                $review->setPseudo($cleanPseudo);
                $review->setComment($cleanComment);
                $review->setScore($score);
                $review->setDate($date);

                // Vérifier si l'objet Statut existe
                if ($statut) {
                    $review->setStatus($statut);
                }

                // Persister les données
                $entityManager->persist($review);
                $entityManager->flush();

                // Message flash de succès
                $this->addFlash('success', 'Avis envoyé avec succès !');

                // Rediriger vers la page d'accueil
                return $this->redirectToRoute('app_home');
            } else {
                // Message flash d'erreur si le formulaire n'est pas valide
                $this->addFlash('error', 'Formulaire incorrect, veuillez recommencer.');
            }
        }

        // Rendu de la vue
        return $this->render('reviews/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('avis/valider/{id}', name:'app_reviews_validate', methods: 'POST')]
    public function validate(Request $request, ReviewsRepository $reviewsRepository, EntityManagerInterface $entityManager, StatutRepository $statutRepository):JsonResponse
    {
        // Récupérer l'id de l'avis
        $id = $request->attributes->get('id');

        $review = $reviewsRepository->find($id);
        $statut = $statutRepository->find(2);
        $review->setStatus($statut);
        

        $entityManager->persist($review);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Avis validé avec succès'], Response::HTTP_OK);
    }

    #[Route('avis/supprimer/{id}', name:'app_reviews_delete', methods: 'POST')]
    public function delete(Request $request, ReviewsRepository $reviewsRepository, EntityManagerInterface $entityManager):JsonResponse
    {
        // Récupérer l'id de l'avis
        $id = $request->attributes->get('id');

        $review = $reviewsRepository->find($id);
        $entityManager->remove($review);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Avis supprimé avec succès'], Response::HTTP_OK);
    }
}
