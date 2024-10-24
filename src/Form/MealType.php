<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Meal;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\TextType;
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
                'required' => true
            ])
            ->add('food', TextType::class, [
                'required' => true
            ])
            ->add('quantity', FloatType::class, [
                'required' => true
            ])
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meal::class,
        ]);
    }
}
