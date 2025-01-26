<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126152051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CREATE TABLE images_animals';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images_animals (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_91177BF8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images_animals ADD CONSTRAINT FK_91177BF8E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images_animals DROP FOREIGN KEY FK_91177BF8E962C16');
        $this->addSql('DROP TABLE images_animals');
    }
}
