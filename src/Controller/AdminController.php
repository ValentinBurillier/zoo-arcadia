<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Horaires;
use App\Entity\Services;
use App\Form\HorairesType;
use App\Form\ServicesType;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $passwordHasher): Response
    {
        // FirstItem
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if (is_string($user->getRoles())) {
                $user->setRoles([$user->getRoles()]);
            }
            $plainPassword = $this->generateRandomPassword();

            // Hacher le mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Utilisateur enregistré avec succès !');
        }

        // SecondItem (Services)
        $newServices = new Services();
        $formServices = $this->createForm(ServicesType::class, $newServices);
        $services = $entityManagerInterface->getRepository(Services::class)->findAll();

        // ThirdItem (Horaires)
        $hours = new Horaires();
        $formHours = $this->createForm(HorairesType::class, $hours);

        $formHours->handleRequest($request);

        if($formHours->isSubmitted() && $formHours->isValid()) {
            $day = $request->request->all('horaires')["jour"];
            $opening = $request->request->all('horaires')["openingHours"];
            $closing = $request->request->all('horaires')["closingHours"];
            if(isset($request->request->all('horaires')["ferme"])) {
                $close = $request->request->all('horaires')["ferme"];
            }
            $getDayinBdd = $entityManagerInterface->getRepository(Horaires::class)
                ->createQueryBuilder('h')
                ->where('h.jour = :jour')
                ->setParameter('jour', $day)
                ->getQuery()
                ->getOneOrNullResult();
            if(isset($close)) {
                $opening = new \DateTime('00:00:00');
                $closing = new \DateTime('00:00:00'); 
            } else {
                $opening = new \DateTime($opening);
                $closing = new \DateTime($closing);
            }
            $getDayinBdd->setOpeningHours($opening);
            $getDayinBdd->setClosingHours($closing);   
            // $entityManagerInterface->persist($hours);
            $entityManagerInterface->flush();
            

            $this->addFlash('success', 'Les horaires ont été enregistrés');
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'formHours' => $formHours->createView(),
            'formServices' => $formServices->createView(),
            'services' => $services,
        ]);
    }
    private function generateRandomPassword(int $length = 12): string
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+'), 0, $length);
    }
}
