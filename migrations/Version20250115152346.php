<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115152346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modifie la colonne "id" pour être AUTO_INCREMENT et ajoute une clé primaire.';
    }

    public function up(Schema $schema): void
    {
        // Supprimer la colonne roles_id
        $this->addSql('ALTER TABLE roles DROP COLUMN roles_id');

        // Ajouter AUTO_INCREMENT à la colonne "id"
        $this->addSql('ALTER TABLE roles MODIFY id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // Reviens à l'état précédent : enlève la propriété AUTO_INCREMENT et la clé primaire
        $this->addSql('ALTER TABLE roles MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE roles DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE roles ADD roles_id INT NOT NULL, CHANGE id id INT NOT NULL');
    }
}
