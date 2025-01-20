<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request, EntityManagerInterface $em)
    {
        $user = new User();
  
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            if($form->isValid()) {
                $email = $user->getEmail();
                $password = $user->getPassword();
                $getUser = $em->getRepository(User::class)->findOneBy(['email' => $email]);
                if(isset($getUser)) {
                    if (password_verify($password, $getUser->getPassword())) {
                        return $this->redirectToRoute('app_home');
                    } else {
                        $this->addFlash('error', 'Mot de passe incorrect.');
                    }
                } else {
                    $this->addFlash('error', 'Utilisateur non trouvé.');
                }
            } else {
                $this->addFlash('error', 'Formulaire invalide.');
            }
        }
        return $this->render('security/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        // Ce code ne sera jamais exécuté, la route est gérée par Symfony
        throw new \Exception('Do not forget to activate logout in security.yaml');
    }
}
