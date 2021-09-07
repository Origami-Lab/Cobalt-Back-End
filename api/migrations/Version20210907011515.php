<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907011515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A9567B3B43D');
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A95D6365F12');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A9567B3B43D FOREIGN KEY (users_id) REFERENCES users (userid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A95D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A95D6365F12');
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A9567B3B43D');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A95D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A9567B3B43D FOREIGN KEY (users_id) REFERENCES users (userid) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
