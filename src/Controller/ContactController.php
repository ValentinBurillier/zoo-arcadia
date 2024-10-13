<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        $formSmall = $this->createForm(ContactType::class);
        $formLarge = $this->createForm(ContactType::class);
        return $this->render('contact/index.html.twig', [
            'formSmall' => $formSmall->createView(),
            'formLarge' => $formLarge->createView(),
        ]);
    }
}
