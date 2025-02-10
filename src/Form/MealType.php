<?php

namespace App\Form;

use App\Entity\Animals;
use App\Entity\Foods;
use App\Entity\Meals;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $animals = $options['animals']; // Liste des animaux disponibles
        $foods = $options['foods'];  // Liste des aliments disponibles

        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('hours', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('animal', EntityType::class, [
                'class' => Animals::class,  // Classe de l'entité Animals
                'choices' => $animals,  // Remplir les options avec les animaux
                'choice_label' => 'name', // Afficher le nom de l'animal dans la liste déroulante
            ])
            ->add('food', EntityType::class, [
                'class' => Foods::class, // Classe de l'entité Foods
                'choices' => $foods,  // Remplir les options avec les aliments
                'choice_label' => 'name', // Afficher le nom de l'aliment dans la liste déroulante
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantité',  // Le label affiché pour le champ
                'attr' => [
                    'step' => '0.01',  // Permet de spécifier des valeurs avec des décimales
                    'min' => '0',  // Empêche les valeurs négatives
                ],
                'required' => true,  // Rend le champ obligatoire
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meals::class,
            'animals' => [],  // Option pour passer les animaux à la vue
            'foods' => [],  // Option pour passer les aliments à la vue
        ]);
    }
}
