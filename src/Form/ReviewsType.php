<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo',TextType::class, [
                'label' => 'Entrez un pseudo',
                'required' =>true,
                'attr' => [
                    'maxLength' => 50
                ]
            ])
            ->add('score', ChoiceType::class, [
                'label' => 'Notez le parc',
                'choices' => [
                    '1 étoile' => 1,
                    '2 étoiles' => 2,
                    '3 étoiles' => 3,
                    '4 étoiles' => 4,
                    '5 étoiles' => 5,
                ],
                'expanded' => true, // Pour afficher en boutons radio
                'multiple' => false, // Un seul choix possible
                'label_html' => true, // Permet d'utiliser HTML dans les labels
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Votre commentaire',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
