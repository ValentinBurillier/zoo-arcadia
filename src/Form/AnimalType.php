<?php
// src/Form/AnimalMealType.php
namespace App\Form;

use App\Entity\Animal; // Assurez-vous d'importer l'entité Animal
use App\Entity\Meal; // Assurez-vous d'importer l'entité Meal
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Habitat; // Assurez-vous d'importer l'entité Habitat

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('species', TextType::class)
            ->add('arrival_date', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('image', TextType::class) // Ou un champ d'upload d'image
            ->add('habitat', EntityType::class, [
                'class' => Habitat::class,
                'choice_label' => 'name',
            ]);
            // ->add('meal', MealType::class); // Inclut le sous-formulaire MealType
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class, // Assurez-vous que c'est l'entité appropriée
        ]);
    }
}
