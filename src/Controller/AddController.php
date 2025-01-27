<?php

namespace App\Controller;
use App\Entity\Habitats;
use App\Entity\Services;
use App\Repository\HabitatsRepository;
use App\Entity\Animals;
use App\Entity\Species;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddController extends AbstractController
{
    #[Route('/habitats/add', name: 'app_add')]
    public function index(EntityManagerInterface $em): Response
    {
        $habitat = new Habitats();
        $habitat->setName("jungle");
        $habitat->setDescription("Explorez notre jungle au zoo, un écrin de verdure où singes espiègles, perroquets colorés et majestueux toucans cohabitent en harmonie.");
        $habitat->setImage("zoo-arcadia-habitats-jungle.webp");

        $em->persist($habitat);
        $em->flush();

        die;
    }

    #[Route('/habitats/getAll', name: 'app_get_all_habitats')]
    public function getAllHabitats(EntityManagerInterface $em, HabitatsRepository $habitatsRepository): Response
    {
        $habitat = $habitatsRepository->find(1);
        $animals = $habitat->getAnimals();
        foreach ($habitat->getAnimals() as $animal) {
            dump($animal);
        }
        
    }

    #[Route('/species/add', name: 'add_species')]
    public function addSpecies(EntityManagerInterface $em): Response
    {
        $specie = new Species();
        $specie->setSpecie("rhinocéros");
        $em->persist($specie);
        $em->flush();
        die;
    }

    #[Route('/animaux/add', name: 'app_add_animal')]
    public function addAnimal(EntityManagerInterface $em): Response
    {
        $animal = new Animals();
        $animal->setName("Iris");
        $animal->setSurname("la peureuse");
        $animal->setImage("zoo-arcadia-rhinoceros.webp");
        $animal->setArrivalDate(new \DateTime("05/02/2023"));

        $specie = $em->getRepository(Species::class)->findOneBy(['specie' => 'rhinocéros']);
        $animal->setSpecie($specie);

        $habitat = $em->getRepository(Habitats::class)->findOneBy(['name' => 'savane']);
        $animal->setHabitat($habitat);

        $em->persist($animal);
        $em->flush();
        die;
    }

    #[Route('/services/add', name: 'app_add_service')]
    public function addService(EntityManagerInterface $em): Response
    {
        $service = new Services();
        $service->setTitle("visite guidée (gratuit)");
        $service->setDescription("visite des habitats");
        $service->setUrlIcon("zoo-arcadia-carte.webp");

        $em->persist($service);
        $em->flush();
        die;
    }
}
