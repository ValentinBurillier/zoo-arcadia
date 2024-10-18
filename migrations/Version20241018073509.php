<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018073509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, date DATE NOT NULL, state VARCHAR(255) NOT NULL, food LONGTEXT NOT NULL, INDEX IDX_38BBA6C68E962C16 (animal_id), INDEX IDX_38BBA6C65C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C68E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C65C80924 FOREIGN KEY (veterinaire_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C68E962C16');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C65C80924');
        $this->addSql('DROP TABLE exam');
    }
}
