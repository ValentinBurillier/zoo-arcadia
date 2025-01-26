<?php

namespace App\Entity;

use App\Repository\AnimalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalsRepository::class)]
class Animals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $arrival_date = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitats $habitat = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Species $specie = null;

    /**
     * @var Collection<int, ImagesAnimals>
     */
    #[ORM\OneToMany(targetEntity: ImagesAnimals::class, mappedBy: 'animal', orphanRemoval: true)]
    private Collection $imagesAnimals;

    public function __construct()
    {
        $this->imagesAnimals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): static
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getHabitat(): ?Habitats
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitats $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    public function getSpecie(): ?Species
    {
        return $this->specie;
    }

    public function setSpecie(?Species $specie): static
    {
        $this->specie = $specie;

        return $this;
    }

    /**
     * @return Collection<int, ImagesAnimals>
     */
    public function getImagesAnimals(): Collection
    {
        return $this->imagesAnimals;
    }

    public function addImagesAnimal(ImagesAnimals $imagesAnimal): static
    {
        if (!$this->imagesAnimals->contains($imagesAnimal)) {
            $this->imagesAnimals->add($imagesAnimal);
            $imagesAnimal->setAnimal($this);
        }

        return $this;
    }

    public function removeImagesAnimal(ImagesAnimals $imagesAnimal): static
    {
        if ($this->imagesAnimals->removeElement($imagesAnimal)) {
            // set the owning side to null (unless already changed)
            if ($imagesAnimal->getAnimal() === $this) {
                $imagesAnimal->setAnimal(null);
            }
        }

        return $this;
    }
}
