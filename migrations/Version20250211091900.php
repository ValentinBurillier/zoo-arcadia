<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250211091900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, food_id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, date DATE NOT NULL, details LONGTEXT NOT NULL, INDEX IDX_38BBA6C68E962C16 (animal_id), INDEX IDX_38BBA6C6BA8E87C4 (food_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C68E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id)');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C6BA8E87C4 FOREIGN KEY (food_id) REFERENCES foods (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C68E962C16');
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C6BA8E87C4');
        $this->addSql('DROP TABLE exam');
    }
}
