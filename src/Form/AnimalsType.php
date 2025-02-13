<?php

namespace App\Form;

use App\Entity\Animals;
use App\Entity\Foods;
use App\Entity\Habitats;
use App\Entity\Species;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('image')
            ->add('arrival_date', null, [
                'widget' => 'single_text',
            ])
            ->add('current_state')
            ->add('habitat', EntityType::class, [
                'class' => Habitats::class,
                'choice_label' => 'name',
            ])
            ->add('specie', EntityType::class, [
                'class' => Species::class,
                'choice_label' => 'specie',
            ])
            ->add('food', EntityType::class, [
                'class' => Foods::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animals::class,
        ]);
    }
}
