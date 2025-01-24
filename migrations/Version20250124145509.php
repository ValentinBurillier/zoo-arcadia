<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250124145509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove FK on contact and reviews tables for clean tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638F6203804');
        $this->addSql('DROP INDEX IDX_4C62E638F6203804 ON contact');
        $this->addSql('ALTER TABLE contact DROP statut_id');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FF6203804');
        $this->addSql('DROP INDEX IDX_6970EB0FF6203804 ON reviews');
        $this->addSql('ALTER TABLE reviews DROP statut_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD statut_id INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638F6203804 ON contact (statut_id)');
        $this->addSql('ALTER TABLE reviews ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_6970EB0FF6203804 ON reviews (statut_id)');
    }
}
