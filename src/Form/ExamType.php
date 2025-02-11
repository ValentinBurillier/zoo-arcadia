<?php

namespace App\Form;

use App\Entity\Animals;
use App\Entity\Exam;
use App\Entity\Foods;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weight')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('details')
            ->add('animal', EntityType::class, [
                'class' => Animals::class,
                'choice_label' => 'id',
            ])
            ->add('food', EntityType::class, [
                'class' => Foods::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exam::class,
        ]);
    }
}
