<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129090258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animals_foods (animals_id INT NOT NULL, foods_id INT NOT NULL, INDEX IDX_D7EA35132B9E58 (animals_id), INDEX IDX_D7EA357BC2350B (foods_id), PRIMARY KEY(animals_id, foods_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals_foods ADD CONSTRAINT FK_D7EA35132B9E58 FOREIGN KEY (animals_id) REFERENCES animals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animals_foods ADD CONSTRAINT FK_D7EA357BC2350B FOREIGN KEY (foods_id) REFERENCES foods (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animals_foods DROP FOREIGN KEY FK_D7EA35132B9E58');
        $this->addSql('ALTER TABLE animals_foods DROP FOREIGN KEY FK_D7EA357BC2350B');
        $this->addSql('DROP TABLE animals_foods');
    }
}
