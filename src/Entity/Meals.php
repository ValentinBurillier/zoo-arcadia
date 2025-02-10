<?php

namespace App\Entity;

use App\Repository\MealsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealsRepository::class)]
class Meals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hours = null;

    #[ORM\ManyToOne(inversedBy: 'meals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animals $animal = null;

    #[ORM\ManyToOne(inversedBy: 'meal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Foods $food = null;

    #[ORM\Column]
    private ?float $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHours(): ?\DateTimeInterface
    {
        return $this->hours;
    }

    public function setHours(\DateTimeInterface $hours): static
    {
        $this->hours = $hours;

        return $this;
    }

    public function getAnimal(): ?Animals
    {
        return $this->animal;
    }

    public function setAnimal(?Animals $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getFood(): ?Foods
    {
        return $this->food;
    }

    public function setFood(?Foods $food): static
    {
        $this->food = $food;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
