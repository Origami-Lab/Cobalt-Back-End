<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210908090856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments DROP lastchange');
        $this->addSql('ALTER TABLE users ADD roles JSON DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE INDEX email_idx ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX usersteams ON users2teams (users_id, teams_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments ADD lastchange DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('DROP INDEX email_idx ON users');
        $this->addSql('ALTER TABLE users DROP roles');
        $this->addSql('DROP INDEX usersteams ON users2teams');
    }
}
