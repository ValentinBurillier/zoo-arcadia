<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Horaires;
use App\Entity\Habitat;
use App\Entity\Services;
use App\Form\HabitatsType;
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
        $services = $entityManagerInterface->getRepository(Services::class)->findAll();
        $newServices = new Services();
        $formServices = $this->createForm(ServicesType::class, $newServices);
        $formServices->handleRequest($request);
        if($formServices->isSubmitted() && $formServices->isValid()) {
            $entityManagerInterface->persist($newServices);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Service ajouté !');
        }
        

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

        //fourthItem (Habitats)
        $habitats = $entityManagerInterface->getRepository(Habitat::class)->findAll();
        $newHabitat = new Habitat();
        $formHabitats = $this->createForm(HabitatsType::class, $newHabitat);
        $formHabitats->handleRequest($request);
        if($formHabitats->isSubmitted() && $formHabitats->isValid()) {
            $entityManagerInterface->persist($newHabitat);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Service ajouté !');
        }

        // FifthItem (Animaux)
        //$habitats = array [0;3]
        //$habitats : 4 propriétés : id, name, description, image, animals(liaison)
        // Pour récupérer tous les animaux d'un habitat : $habitats[0]->getAnimals()
        // Attention, getAnimals() ne va pas afficher les animaux car il s'agit d'une collection non initialisée. Solution : convertir la collection
        // en un tableau php classique en utilisant la méthode ->toArray() : getAnimals()->toArray()
        // Savoir combien il y a d'animaux dans cet habitat : count($habitats[0]->getAnimals())

        // dd($habitats[0]->getAnimals()[0]->getExams()[0]->getState());
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'formHours' => $formHours->createView(),
            'formServices' => $formServices->createView(),
            'services' => $services,
            'habitats' => $habitats,
            'formhabitats' => $formHabitats->createView(),
        ]);
    }
    private function generateRandomPassword(int $length = 12): string
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+'), 0, $length);
    }

    #[Route('/admin/delete/{title}', name: 'app_admin_delete', methods: "DELETE")]
    public function delete(string $title, EntityManagerInterface $entityManagerInterface): Response
    {
        $deleteService = $entityManagerInterface->getRepository(Services::class)->findOneBy(['title' => $title]);
        $deleteService2 = $entityManagerInterface->getRepository(Habitat::class)->findOneBy(['name' => $title]);
        if(isset($deleteService)) {
            $entityManagerInterface->remove($deleteService);
        } else {
            $entityManagerInterface->remove($deleteService2);
        }
        $entityManagerInterface->flush();
        return new Response('Supprimé avec succès.', 200);
    }
}
