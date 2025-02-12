<?php
// src/Form/HabitatsType.php
namespace App\Form;

use App\Entity\Habitat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class HabitatsTypeTwo extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('habitats', CollectionType::class, [
                'entry_type' => HabitatTypeTwo::class, // Utilisation du sous-formulaire
                'entry_options' => ['label' => false],
                'allow_add' => false, // Empêche d'ajouter dynamiquement des éléments
                'allow_delete' => false,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Car on modifie plusieurs entités
        ]);
    }
}
