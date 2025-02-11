<?php

namespace App\Form;

use App\Entity\Animals;
use App\Entity\Exam;
use App\Entity\Foods;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $animals = $options['animals']; // Liste des animaux disponibles
        $foods = $options['foods'];  // Liste des aliments disponibles

        $builder
            ->add('weight', NumberType::class, [
                'label' => 'Grammage (en kg)',
                'required' => true,
                'attr' => [
                    'step' => '0.01',  // Permet de spécifier des valeurs avec des décimales
                    'min' => '0',  // Empêche les valeurs négatives
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('details', TextareaType::class, [
                'label' => 'Détails',
                'required' => false,
            ])
            ->add('animal', EntityType::class, [
                'class' => Animals::class,
                'choices' => $animals,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('food', EntityType::class, [
                'class' => Foods::class, // Classe de l'entité Foods
                'choices' => $foods,  // Remplir les options avec les aliments
                'choice_label' => 'name', // Afficher le nom de l'aliment dans la liste déroulante
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
            'animals' => [],  // Option pour passer les animaux à la vue
            'foods' => [],  // Option pour passer les aliments à la vue
        ]);
    }
}
