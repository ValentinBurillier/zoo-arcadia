<?php

namespace App\Form;

use App\Entity\Horaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class HorairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jour', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi', 
                    'Dimanche' => 'Dimanche'
                ],
                'label' => 'Jour',
                'expanded' => false,
                'multiple' => false,
                'required' => true,
            ])
            ->add('openingHours', TimeType::class, [
                // 'choices' => $this->getHoraires(),
                'input' => 'datetime',
                'label' => 'Horaire d\'ouverture',
                'required' => true,
            ])
            ->add('closingHours', TimeType::class, [
                'input' => 'datetime',
                'label' => 'Horaire de fermeture',
                'required' => true,
            ])
            ->add('ferme', CheckboxType::class, [
                'label'    => 'Fermé',
                'required' => false,
                'mapped'   => false, // Ne pas lier ce champ à la base de données
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horaires::class,
        ]);
    }
    private function getHoraires(): array
    {
        $horaires = [];
        for ($h = 0; $h < 24; $h++) {
            for ($m = 0; $m < 60; $m += 15) {
                $time = sprintf('%02d:%02d', $h, $m);
                $horaires[$time] = $time;
            }
        }
        return $horaires;
    }
}
