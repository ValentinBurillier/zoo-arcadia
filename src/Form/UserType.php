<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Entrez votre email",
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Employé' => User::ROLE_EMPLOYE,
                    'Vétérinaire' => User::ROLE_VETERINAIRE
                ],
                'row_attr' => [
                    'class' => "container-types"
                ],
                'expanded' => true,
                'multiple' => true,
                'required' => true,
                'choice_attr' => function () {
                    return ['class' => 'radio-wrapper']; // Ajoute une classe spécifique
                },
                'label' => 'Type :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
