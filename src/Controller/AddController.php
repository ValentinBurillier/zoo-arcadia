<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddController extends AbstractController
{
    #[Route('/habitats/add', name: 'app_add')]
    public function index(): Response
    {
        return $this->render('add/index.html.twig');
    }
}
