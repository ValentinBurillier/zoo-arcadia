<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealRepository::class)]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timeOfDish = null;

    #[ORM\Column(length: 255)]
    private ?string $food = null;

    #[ORM\Column]
    private ?float $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeOfDish(): ?\DateTimeInterface
    {
        return $this->timeOfDish;
    }

    public function setTimeOfDish(\DateTimeInterface $timeOfDish): static
    {
        $this->timeOfDish = $timeOfDish;

        return $this;
    }

    public function getFood(): ?string
    {
        return $this->food;
    }

    public function setFood(string $food): static
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
