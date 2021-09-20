<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920040855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experiments2labels (id INT AUTO_INCREMENT NOT NULL, experiments_id INT UNSIGNED DEFAULT NULL, labels_id INT UNSIGNED DEFAULT NULL, INDEX fk_experiments2labels_experiments_id (experiments_id), INDEX fk_experiments2labels_labels_id (labels_id), UNIQUE INDEX experiments2labels (experiments_id, labels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE labels (id INT UNSIGNED AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B5D10211EA750E8 (label), INDEX label_idx (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experiments2labels ADD CONSTRAINT FK_2619780472C103E3 FOREIGN KEY (experiments_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments2labels ADD CONSTRAINT FK_26197804B8478C02 FOREIGN KEY (labels_id) REFERENCES labels (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments2labels DROP FOREIGN KEY FK_26197804B8478C02');
        $this->addSql('DROP TABLE experiments2labels');
        $this->addSql('DROP TABLE labels');
    }
}
