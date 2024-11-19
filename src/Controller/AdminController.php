<?php

namespace App\Controller;

use App\Entity\User;
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
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView()
        ]);
    }
    private function generateRandomPassword(int $length = 12): string
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+'), 0, $length);
    }
}
