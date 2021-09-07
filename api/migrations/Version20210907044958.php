<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907044958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD email VARCHAR(255) NOT NULL, DROP mfa_secret, DROP limit_nb, DROP sc_create, DROP sc_edit, DROP sc_submit, DROP sc_todo, DROP inc_files_pdf, DROP pdfa, CHANGE token avatar VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD mfa_secret VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD limit_nb TINYINT(1) DEFAULT \'15\' NOT NULL, ADD sc_create VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'c\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD sc_edit VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'e\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD sc_submit VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'s\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD sc_todo VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT \'t\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD inc_files_pdf TINYINT(1) DEFAULT \'1\' NOT NULL, ADD pdfa TINYINT(1) DEFAULT \'1\' NOT NULL, DROP email, CHANGE avatar token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
