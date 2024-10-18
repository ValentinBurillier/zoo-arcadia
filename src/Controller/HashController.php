<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HashController extends AbstractController
{
    #[Route('/hash', name: 'app_hash')]
    
    public function index(): Response
    {
        $hashedPassword = password_hash('employe', PASSWORD_BCRYPT);
        // password_hash('Azerty34!', PASSWORD_BCRYPT); // ADMIN
        // password_hash('veterinaire', PASSWORD_BCRYPT); // VETERINAIRE
        // password_hash('employe', PASSWORD_BCRYPT); // EMPLOYE
        dd($hashedPassword);
        return $this->render('hash/index.html.twig');
    }
}
