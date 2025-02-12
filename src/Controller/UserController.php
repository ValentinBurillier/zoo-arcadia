<?php
// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Exam;
use App\Entity\Meals;
use App\Entity\Services;
use App\Entity\User;
use App\Form\MealType;
use App\Form\CommentType;
use App\Form\ExamType;
use App\Form\HabitatsType;
use App\Form\administrateur\HabitatTypeTwo;
use App\Form\HabitatsTypeTwo;
use App\Form\HabitatTypeTwo as FormHabitatTypeTwo;
use App\Form\HorairesType;
use App\Form\ServicesType;
use App\Form\UserType;
use App\Repository\AnimalsRepository;
use App\Repository\FoodsRepository;
use App\Repository\HabitatsRepository;
use App\Repository\HorairesRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function employe(
        Request $request,
        ServicesRepository $servicesRepository,
        ReviewsRepository $reviewsRepository,
        StatutRepository $statutRepository,
        AnimalsRepository $animalsRepository,
        FoodsRepository $foodsRepository,
        EntityManagerInterface $em
    ): Response {
        // Vérification du statut "to_checked"
        $statusChecked = $statutRepository->findOneBy(['statut' => 'to_checked']);
        $reviews = $statusChecked ? $reviewsRepository->findBy(['status' => $statusChecked->getId()]) : [];

        // Récupération des données
        $services = $servicesRepository->findAll();
        $animals = $animalsRepository->findAll();
        $foods = $foodsRepository->findAll();

        // Création du formulaire
        $meal = new Meals();
        $formMeal = $this->createForm(MealType::class, $meal, [
            'animals' => $animals,
            'foods' => $foods
        ]);
        $formMeal->handleRequest($request);

        if ($formMeal->isSubmitted() && $formMeal->isValid()) {
            $em->persist($meal);
            $em->flush();
            $this->addFlash('success', 'Le repas a bien été ajouté.');

            return $this->redirectToRoute('app_employe');
        }

        return $this->render('user/employe.html.twig', [
            'services' => $services,
            'reviews' => $reviews,
            'animals' => $animals,
            'foods' => $foods,
            'formMeal' => $formMeal->createView()
        ]);
    }

    #[Route('/employe/services/modifications', name: 'app_modifications_services', methods: ['POST'])]
    public function modificationsServices(Request $request, ServicesRepository $servicesRepository, EntityManagerInterface $em): Response
    {
        $data = $request->request->all();

        if (!isset($data['id'], $data['title'], $data['description'])) {
            $this->addFlash('danger', 'Données invalides.');
            return $this->redirectToRoute('app_employe');
        }

        $service = $servicesRepository->find($data['id']);

        if (!$service) {
            $this->addFlash('danger', 'Service introuvable.');
            return $this->redirectToRoute('app_employe');
        }

        $service->setTitle($data['title']);
        $service->setDescription($data['description']);
        
        $em->persist($service);
        $em->flush();
        
        $this->addFlash('success', 'Le service a bien été modifié.');

        return $this->redirectToRoute('app_employe');
    }

    #[Route('/veterinaire', name: 'app_veterinaire')]
    public function veterinaire(
        HabitatsRepository $habitatsRepository, 
        AnimalsRepository $animalsRepository,
        Request $request,
        EntityManagerInterface $em,
        FoodsRepository $foodsRepository
        ): Response
    {
        $animals = $animalsRepository->findAll();
        $habitats = $habitatsRepository->findAll();

        // Création du formulaire Commentaire
        $comment = new Comments();
        $formComment = $this->createForm(CommentType::class, $comment, [
            'habitats' => $habitats
        ]);
        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()) {
            $comment->setDate(new \DateTime());
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Le repas a bien été ajouté.');

            return $this->redirectToRoute('app_veterinaire');
        }


        // Création du formulaire pour écrire un rapport

        $foods = $foodsRepository->findAll();
        $report = new Exam();

        $formReport = $this->createForm(ExamType::class, $report, [
            'animals' => $animals,
            'foods' => $foods
        ]);

        $formReport->handleRequest($request);

        if ($formReport->isSubmitted() && $formReport->isValid()) {
            $em->persist($report);
            $em->flush();
            $this->addFlash('success', 'Le rapport a bien été ajouté.');

            return $this->redirectToRoute('app_veterinaire');
            
        };
        
        return $this->render('user/veterinaire.html.twig',[
            'animals' => $animals,
            'habitats' => $habitats,
            'formComment' => $formComment->createView(),
            'formReport' => $formReport->createView(),
        ]);
    }

    #[Route('/veterinaire/{animal}', name: 'app_veterinaire_animal', methods: ['GET'])]
    public function getAnimalData(Request $request, AnimalsRepository $animalsRepository): Response
    {
        $animalSelected = $request->attributes->get('animal');
        $animal = $animalsRepository->findOneBy(['name' => $animalSelected]);
        return $this->render('user/animalData.html.twig', [
            'animal' => $animal
        ]);
    }

    #[Route('/administrateur', name:'app_administrateur')]
    public function administrateur(Request $request, EntityManagerInterface $em, ServicesRepository $servicesRepository, HorairesRepository $horairesRepository, HabitatsRepository $habitatsRepository): Response
    {
        // GET services
        $services = $servicesRepository->findAll();
        $formServices = [];
        foreach ($services as $service) {
            $formService = $this->createForm(ServicesType::class, $service);
            $formService->handleRequest($request);

            if($formService->isSubmitted() && $formService->isValid()) {
                $em->flush();
                return $this->redirectToRoute('app_administrateur');
            }

            $formServices[] = $formService->createView();
        }


        // Get horaires
        $horaires = $horairesRepository->findAll();
        $formHoraires = $this->createForm(HorairesType::class, null, [
            'horaires' => $horaires,
        ]);
        $formHoraires->handleRequest($request);
        if ($formHoraires->isSubmitted() && $formHoraires->isValid()) {
            foreach ($horaires as $horaire) {
                $jour = $horaire->getJour();
                $horaire->setOpeningHours($formHoraires->get($jour . '_opening')->getData());
                $horaire->setClosingHours($formHoraires->get($jour . '_closing')->getData());
            }

            $em->flush();
            $this->addFlash('success', 'Les horaires ont été mis à jour.');
            return $this->redirectToRoute('app_administrateur');
        }

        // GET habitats
        $habitats = $habitatsRepository->findAll();
        $formHabitats = $this->createForm(HabitatsTypeTwo::class, ['habitats' => $habitats]);
        $formHabitats->handleRequest($request);
        if ($formHabitats->isSubmitted() && $formHabitats->isValid()) {
            foreach ($habitats as $habitat) {
                $em->persist($habitat);
            }
            $em->flush();

            $this->addFlash('success', 'Les habitats ont été mis à jour avec succès !');
            return $this->redirectToRoute('app_administrateur');
        }

        // CREATE NEW USER
        $user = new User();
        $formCreateUser = $this->createForm(UserType::class, $user);
        $formCreateUser->handleRequest($request);

        if ($formCreateUser->isSubmitted() && $formCreateUser->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'L\'utilisateur a bien été créé.');

            return $this->redirectToRoute('app_administrateur');
        }

        return $this->render('user/administrateur.html.twig',[
            'formCreateUser' => $formCreateUser,
            'formServices' => $formServices,
            'formHoraires' => $formHoraires->createView(),
            'formHabitats' => $formHabitats->createView()
        ]);
    }

}
