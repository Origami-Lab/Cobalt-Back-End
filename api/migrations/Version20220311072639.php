<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311072639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments_conclusions ADD padid VARCHAR(255) DEFAULT NULL, CHANGE conclusions conclusions TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE experiments_protocols ADD padid VARCHAR(255) DEFAULT NULL, CHANGE protocol protocol TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD padid VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments_conclusions DROP padid, CHANGE conclusions conclusions TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE experiments_protocols DROP padid, CHANGE protocol protocol TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users DROP padid');
    }
}
