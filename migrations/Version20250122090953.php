<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122090953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renommer la table habitat en habitats';
    }

    public function up(Schema $schema): void
    {
        // Cette commande renomme la table
        $this->addSql('RENAME TABLE habitat TO habitats');
    }

    public function down(Schema $schema): void
    {
        // Cette commande restaure l'ancien nom de la table
        $this->addSql('RENAME TABLE habitats TO habitat');
    }
}
