<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906115042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE config CHANGE conf_name conf_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE teams DROP deletable_xp, DROP link_name, DROP link_href, DROP stamplogin, DROP stamppass, DROP stampprovider, DROP stampcert, DROP stamphash, DROP orgid, DROP public_db, DROP force_canread, DROP force_canwrite, DROP do_force_canread, DROP do_force_canwrite, DROP visible');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE config CHANGE conf_name conf_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE teams ADD deletable_xp TINYINT(1) DEFAULT \'1\' NOT NULL, ADD link_name TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD link_href TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD stamplogin TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD stamppass TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD stampprovider TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD stampcert TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD stamphash VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'sha256\' COLLATE `utf8mb4_unicode_ci`, ADD orgid VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD public_db TINYINT(1) NOT NULL, ADD force_canread VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'team\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD force_canwrite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'user\' NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD do_force_canread TINYINT(1) NOT NULL, ADD do_force_canwrite TINYINT(1) NOT NULL, ADD visible TINYINT(1) DEFAULT \'1\' NOT NULL');
    }
}
