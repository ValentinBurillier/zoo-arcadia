<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126151843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ADD FOREIGN KEY ON ANIMALS TABLE';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals ADD specie_id INT NOT NULL');
        $this->addSql('ALTER TABLE animals ADD CONSTRAINT FK_966C69DDD5436AB7 FOREIGN KEY (specie_id) REFERENCES species (id)');
        $this->addSql('CREATE INDEX IDX_966C69DDD5436AB7 ON animals (specie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals DROP FOREIGN KEY FK_966C69DDD5436AB7');
        $this->addSql('DROP INDEX IDX_966C69DDD5436AB7 ON animals');
        $this->addSql('ALTER TABLE animals DROP specie_id');
    }
}
