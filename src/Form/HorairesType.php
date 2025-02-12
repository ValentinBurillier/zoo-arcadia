<?php 
namespace App\Form;

use App\Entity\Horaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['horaires'] as $horaire) {
            $builder->add($horaire->getJour() . '_opening', TimeType::class, [
                'label' => 'Ouverture ' . ucfirst($horaire->getJour()),
                'widget' => 'single_text',
                'data' => $horaire->getOpeningHours(),
                'required' => true,
            ]);

            $builder->add($horaire->getJour() . '_closing', TimeType::class, [
                'label' => 'Fermeture ' . ucfirst($horaire->getJour()),
                'widget' => 'single_text',
                'data' => $horaire->getClosingHours(),
                'required' => true,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,  // Pas d'entité unique car c'est une collection
            'horaires' => [], // On passe les horaires dans l'option
        ]);
    }
}
