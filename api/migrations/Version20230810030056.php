<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810030056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experiments2molecules (id INT AUTO_INCREMENT NOT NULL, experiments_id INT UNSIGNED DEFAULT NULL, molecules_id INT UNSIGNED DEFAULT NULL, INDEX fk_experiments2molecules_experiments_id (experiments_id), INDEX fk_experiments2molecules_molecules_id (molecules_id), UNIQUE INDEX experiments2molecules (experiments_id, molecules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE molecules (id INT UNSIGNED AUTO_INCREMENT NOT NULL, molecule VARCHAR(255) NOT NULL, fullmolecule TEXT NOT NULL, INDEX molecule_idx (molecule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experiments2molecules ADD CONSTRAINT FK_1E7B12D772C103E3 FOREIGN KEY (experiments_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments2molecules ADD CONSTRAINT FK_1E7B12D7FD7195FA FOREIGN KEY (molecules_id) REFERENCES molecules (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments2molecules DROP FOREIGN KEY FK_1E7B12D7FD7195FA');
        $this->addSql('DROP TABLE experiments2molecules');
        $this->addSql('DROP TABLE molecules');
    }
}
