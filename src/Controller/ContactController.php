<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Statut;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        
        $contact = new Contact();
  
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            if($form->isValid()) {
                // Récupérer l'objet Statut avec l'id = 1
                $statut = $em->getRepository(Statut::class)->find(1);
                // Vérifier si l'objet Statut existe
                if ($statut) {
                    $contact->setStatut($statut);
                }
                $em->persist($contact);
                $em->flush();

                $this->addFlash('success', 'Votre message a été envoyé avec succès.');
                // Rediriger vers la page d'accueil
                return $this->redirectToRoute('app_home');
            } else {
                // Message flash d'erreur si le formulaire n'est pas valide
                $this->addFlash('error', 'Formulaire incorrect, veuillez recommencer.');
            }
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
