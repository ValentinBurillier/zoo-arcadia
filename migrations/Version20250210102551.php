<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210102551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meals (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, food_id INT NOT NULL, date DATE NOT NULL, hours TIME NOT NULL, INDEX IDX_E229E6EA8E962C16 (animal_id), INDEX IDX_E229E6EABA8E87C4 (food_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA8E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id)');
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EABA8E87C4 FOREIGN KEY (food_id) REFERENCES foods (id)');
        $this->addSql('ALTER TABLE animals DROP meals_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA8E962C16');
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EABA8E87C4');
        $this->addSql('DROP TABLE meals');
        $this->addSql('ALTER TABLE animals ADD meals_id INT NOT NULL');
    }
}
