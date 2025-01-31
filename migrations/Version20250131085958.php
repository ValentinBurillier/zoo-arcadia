<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131085958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add FK status_id on reviews table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reviews ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F6BF700BD FOREIGN KEY (status_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_6970EB0F6BF700BD ON reviews (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F6BF700BD');
        $this->addSql('DROP INDEX IDX_6970EB0F6BF700BD ON reviews');
        $this->addSql('ALTER TABLE reviews DROP status_id');
    }
}
