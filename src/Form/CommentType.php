<?php

namespace App\Form;
use App\Entity\Comments;
use App\Entity\Habitats;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $habitats = $options['habitats'];
        $builder
            ->add('comment', TextareaType::class, [
                'label' => 'Ajouter un commentaire',
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Ecrivez votre commentaire ici'
                ]
            ])
            ->add('habitat', EntityType::class, [
                'class' => Habitats::class,
                'choices' => $habitats,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
            'habitats' => [],
        ]);
    }
}
