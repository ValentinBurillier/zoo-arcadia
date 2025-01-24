<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250124144641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exam DROP FOREIGN KEY FK_38BBA6C68E962C16');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C8E962C16');
        $this->addSql('DROP TABLE animal');
        $this->addSql('ALTER TABLE animals DROP FOREIGN KEY FK_animals');
        $this->addSql('DROP INDEX FK_animals ON animals');
        $this->addSql('DROP INDEX IDX_38BBA6C68E962C16 ON exam');
        $this->addSql('ALTER TABLE exam DROP animal_id');
        $this->addSql('DROP INDEX IDX_9EF68E9C8E962C16 ON meal');
        $this->addSql('ALTER TABLE meal DROP animal_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, species VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, arrival_date DATE NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, food VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, state VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, views INT NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals ADD CONSTRAINT FK_animals FOREIGN KEY (habitat_id) REFERENCES habitats (id)');
        $this->addSql('CREATE INDEX FK_animals ON animals (habitat_id)');
        $this->addSql('ALTER TABLE exam ADD animal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C68E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_38BBA6C68E962C16 ON exam (animal_id)');
        $this->addSql('ALTER TABLE meal ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_9EF68E9C8E962C16 ON meal (animal_id)');
    }
}
