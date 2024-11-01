<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Meal;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timeOfDish', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('food', TextType::class)
            ->add('quantity', NumberType::class)
            // ->add('animal', EntityType::class, [
            //     'class' => Animal::class,
            //     'choice_label' => 'name', // Remplacez par le champ approprié de l'entité Animal
            // ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meal::class,
        ]);
    }
}
