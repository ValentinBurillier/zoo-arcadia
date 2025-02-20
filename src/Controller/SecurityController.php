<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Password\UserPasswordHasherInterface;


use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
        if($request->getMethod() === 'POST') {
            $data = $request->request->all();
            if(isset($data['login']['email']) && $data !== null) {
                $email = $data['login']['email'];
                if(isset($data['login']['password']) && $data !== null) {
                    $pass = $data['login']['password'];
                    if($entityManager->getRepository(User::class)->findOneBy(['email' => $email])) {
                        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
                        $userPass = $user->getPassword();
                        $test = password_verify($pass, $userPass);
                        
                        if($test === true) {
                            
                            $roleUser = $user->getRoles()[0];
                            
                            switch($roleUser) {
                                case 'ROLE_ADMIN':
                                    return $this->redirectToRoute('app_admin');
                                    break;
                                case 'ROLE_EMPLOYE':
                                    return $this->redirectToRoute('app_employe');
                                    break;
                                case 'ROLE_VETERINAIRE':
                                    return $this->redirectToRoute('app_veterinaire');
                                    break;
                                default:
                                    return $this->redirectToRoute('login');
                                    break;
                            }
                        }
                    }
                }
            }
        }   
        
        return $this->render('security/index.html.twig', [
            'form' => $this->createForm(LoginType::class)
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        // Ce code ne sera jamais exécuté, la route est gérée par Symfony
        throw new \Exception('Do not forget to activate logout in security.yaml');
    }
}
