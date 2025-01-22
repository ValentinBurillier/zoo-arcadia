<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250121103000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renommer la table statut_avis en statut';
    }

    public function up(Schema $schema): void
    {
        // Cette commande renomme la table
        $this->addSql('RENAME TABLE statut_avis TO statut');
    }

    public function down(Schema $schema): void
    {
        // Cette commande restaure l'ancien nom de la table
        $this->addSql('RENAME TABLE statut TO statut_avis');
    }
}
