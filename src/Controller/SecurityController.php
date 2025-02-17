<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request, EntityManagerInterface $em, AuthenticationUtils $authenticationUtils)
    {
        // Récupérer les erreurs de connexion (si existantes)
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Récupérer le dernier email saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        // Ce code ne sera jamais exécuté, la route est gérée par Symfony
        throw new \Exception('Do not forget to activate logout in security.yaml');
    }
}
