<?php

namespace App\Entity;

use App\Repository\FoodsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodsRepository::class)]
class Foods
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Animals>
     */
    #[ORM\ManyToMany(targetEntity: Animals::class, mappedBy: 'food')]
    private Collection $animals;

    /**
     * @var Collection<int, Meals>
     */
    #[ORM\OneToMany(targetEntity: Meals::class, mappedBy: 'food', orphanRemoval: true)]
    private Collection $meal;

    /**
     * @var Collection<int, Exam>
     */
    #[ORM\OneToMany(targetEntity: Exam::class, mappedBy: 'food', orphanRemoval: true)]
    private Collection $exams;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->meal = new ArrayCollection();
        $this->exams = new ArrayCollection();
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

    /**
     * @return Collection<int, Animals>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animals $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->addFood($this);
        }

        return $this;
    }

    public function removeAnimal(Animals $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            $animal->removeFood($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Meals>
     */
    public function getMeal(): Collection
    {
        return $this->meal;
    }

    public function addMeal(Meals $meal): static
    {
        if (!$this->meal->contains($meal)) {
            $this->meal->add($meal);
            $meal->setFood($this);
        }

        return $this;
    }

    public function removeMeal(Meals $meal): static
    {
        if ($this->meal->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getFood() === $this) {
                $meal->setFood(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exam $exam): static
    {
        if (!$this->exams->contains($exam)) {
            $this->exams->add($exam);
            $exam->setFood($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): static
    {
        if ($this->exams->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getFood() === $this) {
                $exam->setFood(null);
            }
        }

        return $this;
    }
}
