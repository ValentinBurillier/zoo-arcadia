<?php 
namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class RolesArrayToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforme un tableau en une simple valeur pour le formulaire.
     *
     * @param array|null $roles
     * @return string|null
     */
    public function transform($roles): ?string
    {
        if (!is_array($roles)) {
            return null;
        }

        return count($roles) > 0 ? $roles[0] : null;
    }

    /**
     * Transforme la valeur du formulaire en un tableau pour l'entité.
     *
     * @param string|null $role
     * @return array
     */
    public function reverseTransform($role): array
    {
        if (null === $role) {
            return [];
        }

        return [$role]; // Symfony attend un tableau pour les rôles
    }
}
