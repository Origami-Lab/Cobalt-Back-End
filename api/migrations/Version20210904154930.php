<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210904154930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_keys (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, name VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, can_write TINYINT(1) NOT NULL, INDEX fk_api_keys_users_id (userid), INDEX fk_api_keys_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banned_users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, fingerprint CHAR(32) NOT NULL, time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config (conf_name VARCHAR(255) NOT NULL, conf_value TEXT DEFAULT NULL, PRIMARY KEY(conf_name)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments (id INT UNSIGNED AUTO_INCREMENT NOT NULL, userid INT UNSIGNED DEFAULT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, startdate DATETIME DEFAULT NULL, duedate DATETIME DEFAULT NULL, datetime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, lastchange DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX fk_experiments_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_comments (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, comment TEXT NOT NULL, INDEX fk_experiments_comments_experiments_id (item_id), INDEX fk_experiments_comments_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_conclusions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experiment_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, conclusions TEXT NOT NULL, INDEX fk_experiments_conclusions_experiments_id (experiment_id), INDEX fk_experiments_conclusions_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_content (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, goal TEXT NOT NULL, `procedure` TEXT NOT NULL, results TEXT NOT NULL, INDEX fk_experiments_content_experiments_id (item_id), INDEX fk_experiments_content_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_links (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experiment_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, link TEXT NOT NULL, INDEX fk_experiments_links_experiments_id (experiment_id), INDEX fk_experiments_links_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_notes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experiment_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, notes TEXT NOT NULL, INDEX fk_experiments_notes_experiments_id (experiment_id), INDEX fk_experiments_notes_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_protocols (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experiment_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, protocol TEXT NOT NULL, INDEX fk_experiments_protocols_experiments_id (experiment_id), INDEX fk_experiments_protocols_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_revisions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED NOT NULL, body MEDIUMTEXT NOT NULL, savedate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, userid INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_steps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, body TEXT NOT NULL, ordering INT UNSIGNED DEFAULT NULL, finished TINYINT(1) NOT NULL, finished_time DATETIME DEFAULT NULL, INDEX fk_experiments_steps_experiments_id (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_templates (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, body TEXT DEFAULT NULL, name VARCHAR(255) NOT NULL, userid INT UNSIGNED DEFAULT NULL, canread VARCHAR(255) NOT NULL, canwrite VARCHAR(255) NOT NULL, ordering INT UNSIGNED DEFAULT NULL, INDEX fk_experiments_templates_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_templates_links (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, link_id INT UNSIGNED DEFAULT NULL, INDEX fk_experiments_templates_links_items_id (item_id), INDEX fk_experiments_templates_links_items_id2 (link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiments_templates_steps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, body TEXT NOT NULL, ordering INT UNSIGNED DEFAULT NULL, finished TINYINT(1) NOT NULL, finished_time DATETIME DEFAULT NULL, INDEX fk_experiments_templates_steps_items_id (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE greeting (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, entityid VARCHAR(255) NOT NULL, sso_url VARCHAR(255) NOT NULL, sso_binding VARCHAR(255) NOT NULL, slo_url VARCHAR(255) NOT NULL, slo_binding VARCHAR(255) NOT NULL, x509 TEXT NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, date INT UNSIGNED NOT NULL, body MEDIUMTEXT DEFAULT NULL, rating TINYINT(1) DEFAULT NULL, category INT UNSIGNED NOT NULL, locked TINYINT(1) DEFAULT NULL, lockedby INT UNSIGNED DEFAULT NULL, lockedwhen DATETIME DEFAULT NULL, userid INT UNSIGNED NOT NULL, canread VARCHAR(255) DEFAULT \'team\' NOT NULL, canwrite VARCHAR(255) DEFAULT \'team\' NOT NULL, available TINYINT(1) DEFAULT \'1\' NOT NULL, lastchange DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX fk_items_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_comments (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, datetime DATETIME NOT NULL, comment TEXT NOT NULL, INDEX fk_items_comments_items_id (item_id), INDEX fk_items_comments_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_links (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, link_id INT UNSIGNED DEFAULT NULL, INDEX fk_items_links_items_id (item_id), INDEX fk_items_links_items_id2 (link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_revisions (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, body MEDIUMTEXT NOT NULL, savedate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX fk_items_revisions_items_id (item_id), INDEX fk_items_revisions_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_steps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, body TEXT NOT NULL, ordering INT UNSIGNED DEFAULT NULL, finished TINYINT(1) NOT NULL, finished_time DATETIME DEFAULT NULL, INDEX fk_items_steps_items_id (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_types (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, name TEXT NOT NULL, color VARCHAR(6) DEFAULT \'000000\', template TEXT DEFAULT NULL, ordering INT UNSIGNED DEFAULT NULL, bookable TINYINT(1) DEFAULT NULL, INDEX fk_items_types_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, filename TEXT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, experimentid TEXT NOT NULL, user_id TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pin2users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, users_id INT UNSIGNED DEFAULT NULL, entity_id INT UNSIGNED NOT NULL, type VARCHAR(255) NOT NULL, INDEX fk_pin2users_userid (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, name TEXT NOT NULL, color VARCHAR(6) NOT NULL, is_timestampable TINYINT(1) DEFAULT \'1\' NOT NULL, is_default TINYINT(1) DEFAULT NULL, ordering INT UNSIGNED DEFAULT NULL, INDEX fk_status_teams_team_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, tag VARCHAR(255) NOT NULL, INDEX fk_tags_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags2entity (id INT AUTO_INCREMENT NOT NULL, item_id INT UNSIGNED NOT NULL, tag_id INT UNSIGNED NOT NULL, item_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_events (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, userid INT UNSIGNED DEFAULT NULL, item INT UNSIGNED NOT NULL, start VARCHAR(255) NOT NULL, end VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, experiment INT UNSIGNED DEFAULT NULL, INDEX fk_team_events_teams_id (team), INDEX fk_team_events_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_groups (id INT UNSIGNED AUTO_INCREMENT NOT NULL, team INT UNSIGNED DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX fk_team_groups_teams_id (team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, deletable_xp TINYINT(1) DEFAULT \'1\' NOT NULL, link_name TEXT NOT NULL, link_href TEXT NOT NULL, datetime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, stamplogin TEXT DEFAULT NULL, stamppass TEXT DEFAULT NULL, stampprovider TEXT DEFAULT NULL, stampcert TEXT DEFAULT NULL, stamphash VARCHAR(10) DEFAULT \'sha256\', orgid VARCHAR(255) DEFAULT NULL, public_db TINYINT(1) NOT NULL, force_canread VARCHAR(255) DEFAULT \'team\' NOT NULL, force_canwrite VARCHAR(255) DEFAULT \'user\' NOT NULL, do_force_canread TINYINT(1) NOT NULL, do_force_canwrite TINYINT(1) NOT NULL, visible TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todolist (id INT UNSIGNED AUTO_INCREMENT NOT NULL, userid INT UNSIGNED DEFAULT NULL, body TEXT NOT NULL, creation_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ordering INT UNSIGNED DEFAULT NULL, INDEX fk_todolist_users_userid (userid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uploads (id INT UNSIGNED AUTO_INCREMENT NOT NULL, real_name TEXT NOT NULL, long_name TEXT NOT NULL, comment TEXT NOT NULL, item_id INT UNSIGNED DEFAULT NULL, userid TEXT NOT NULL, type VARCHAR(255) NOT NULL, datetime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, hash VARCHAR(128) DEFAULT NULL, hash_algorithm VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usergroups (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_sysadmin TINYINT(1) NOT NULL, is_admin TEXT NOT NULL, can_lock TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (userid INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, mfa_secret VARCHAR(32) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, limit_nb TINYINT(1) DEFAULT \'15\' NOT NULL, sc_create VARCHAR(1) DEFAULT \'c\' NOT NULL, sc_edit VARCHAR(1) DEFAULT \'e\' NOT NULL, sc_submit VARCHAR(1) DEFAULT \'s\' NOT NULL, sc_todo VARCHAR(1) DEFAULT \'t\' NOT NULL, inc_files_pdf TINYINT(1) DEFAULT \'1\' NOT NULL, pdfa TINYINT(1) DEFAULT \'1\' NOT NULL, last_login DATETIME DEFAULT NULL, PRIMARY KEY(userid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users2team_groups (id INT AUTO_INCREMENT NOT NULL, userid INT UNSIGNED NOT NULL, groupid INT UNSIGNED NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users2teams (id INT AUTO_INCREMENT NOT NULL, teams_id INT UNSIGNED DEFAULT NULL, users_id INT UNSIGNED DEFAULT NULL, INDEX fk_users2teams_teams_id (teams_id), INDEX fk_users2teams_users_id (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_keys ADD CONSTRAINT FK_9579321FC4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE api_keys ADD CONSTRAINT FK_9579321FF132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments ADD CONSTRAINT FK_3E7272F3F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_comments ADD CONSTRAINT FK_75D71D27126F525E FOREIGN KEY (item_id) REFERENCES experiments (id)');
        $this->addSql('ALTER TABLE experiments_comments ADD CONSTRAINT FK_75D71D27F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_conclusions ADD CONSTRAINT FK_96BBA4CFF444C8 FOREIGN KEY (experiment_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments_conclusions ADD CONSTRAINT FK_96BBA4CF132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_content ADD CONSTRAINT FK_D865A952126F525E FOREIGN KEY (item_id) REFERENCES experiments (id)');
        $this->addSql('ALTER TABLE experiments_content ADD CONSTRAINT FK_D865A952F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_links ADD CONSTRAINT FK_A46D3511FF444C8 FOREIGN KEY (experiment_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments_links ADD CONSTRAINT FK_A46D3511F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_notes ADD CONSTRAINT FK_74F43285FF444C8 FOREIGN KEY (experiment_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments_notes ADD CONSTRAINT FK_74F43285F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_protocols ADD CONSTRAINT FK_1A37373AFF444C8 FOREIGN KEY (experiment_id) REFERENCES experiments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experiments_protocols ADD CONSTRAINT FK_1A37373AF132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE experiments_steps ADD CONSTRAINT FK_41CD9E7B126F525E FOREIGN KEY (item_id) REFERENCES experiments (id)');
        $this->addSql('ALTER TABLE experiments_templates ADD CONSTRAINT FK_11B348B8C4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE experiments_templates_links ADD CONSTRAINT FK_D783E727126F525E FOREIGN KEY (item_id) REFERENCES experiments_templates (id)');
        $this->addSql('ALTER TABLE experiments_templates_links ADD CONSTRAINT FK_D783E727ADA40271 FOREIGN KEY (link_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE experiments_templates_steps ADD CONSTRAINT FK_32234C4D126F525E FOREIGN KEY (item_id) REFERENCES experiments_templates (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DC4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE items_comments ADD CONSTRAINT FK_28E526E4126F525E FOREIGN KEY (item_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE items_comments ADD CONSTRAINT FK_28E526E4F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE items_links ADD CONSTRAINT FK_D55E6BA3126F525E FOREIGN KEY (item_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE items_links ADD CONSTRAINT FK_D55E6BA3ADA40271 FOREIGN KEY (link_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE items_revisions ADD CONSTRAINT FK_F51AB682126F525E FOREIGN KEY (item_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE items_revisions ADD CONSTRAINT FK_F51AB682F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE items_steps ADD CONSTRAINT FK_30FEC0C9126F525E FOREIGN KEY (item_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE items_types ADD CONSTRAINT FK_5DEC438BC4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE pin2users ADD CONSTRAINT FK_9994AF0167B3B43D FOREIGN KEY (users_id) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CC4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC9426C4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE team_events ADD CONSTRAINT FK_259C1093C4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE team_events ADD CONSTRAINT FK_259C1093F132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE team_groups ADD CONSTRAINT FK_86767EA9C4E0A61F FOREIGN KEY (team) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE todolist ADD CONSTRAINT FK_DD4DF6DBF132696E FOREIGN KEY (userid) REFERENCES users (userid)');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A95D6365F12 FOREIGN KEY (teams_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE users2teams ADD CONSTRAINT FK_C5DF9A9567B3B43D FOREIGN KEY (users_id) REFERENCES users (userid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experiments_comments DROP FOREIGN KEY FK_75D71D27126F525E');
        $this->addSql('ALTER TABLE experiments_conclusions DROP FOREIGN KEY FK_96BBA4CFF444C8');
        $this->addSql('ALTER TABLE experiments_content DROP FOREIGN KEY FK_D865A952126F525E');
        $this->addSql('ALTER TABLE experiments_links DROP FOREIGN KEY FK_A46D3511FF444C8');
        $this->addSql('ALTER TABLE experiments_notes DROP FOREIGN KEY FK_74F43285FF444C8');
        $this->addSql('ALTER TABLE experiments_protocols DROP FOREIGN KEY FK_1A37373AFF444C8');
        $this->addSql('ALTER TABLE experiments_steps DROP FOREIGN KEY FK_41CD9E7B126F525E');
        $this->addSql('ALTER TABLE experiments_templates_links DROP FOREIGN KEY FK_D783E727126F525E');
        $this->addSql('ALTER TABLE experiments_templates_steps DROP FOREIGN KEY FK_32234C4D126F525E');
        $this->addSql('ALTER TABLE experiments_templates_links DROP FOREIGN KEY FK_D783E727ADA40271');
        $this->addSql('ALTER TABLE items_comments DROP FOREIGN KEY FK_28E526E4126F525E');
        $this->addSql('ALTER TABLE items_links DROP FOREIGN KEY FK_D55E6BA3126F525E');
        $this->addSql('ALTER TABLE items_links DROP FOREIGN KEY FK_D55E6BA3ADA40271');
        $this->addSql('ALTER TABLE items_revisions DROP FOREIGN KEY FK_F51AB682126F525E');
        $this->addSql('ALTER TABLE items_steps DROP FOREIGN KEY FK_30FEC0C9126F525E');
        $this->addSql('ALTER TABLE api_keys DROP FOREIGN KEY FK_9579321FC4E0A61F');
        $this->addSql('ALTER TABLE experiments_templates DROP FOREIGN KEY FK_11B348B8C4E0A61F');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DC4E0A61F');
        $this->addSql('ALTER TABLE items_types DROP FOREIGN KEY FK_5DEC438BC4E0A61F');
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651CC4E0A61F');
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC9426C4E0A61F');
        $this->addSql('ALTER TABLE team_events DROP FOREIGN KEY FK_259C1093C4E0A61F');
        $this->addSql('ALTER TABLE team_groups DROP FOREIGN KEY FK_86767EA9C4E0A61F');
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A95D6365F12');
        $this->addSql('ALTER TABLE api_keys DROP FOREIGN KEY FK_9579321FF132696E');
        $this->addSql('ALTER TABLE experiments DROP FOREIGN KEY FK_3E7272F3F132696E');
        $this->addSql('ALTER TABLE experiments_comments DROP FOREIGN KEY FK_75D71D27F132696E');
        $this->addSql('ALTER TABLE experiments_conclusions DROP FOREIGN KEY FK_96BBA4CF132696E');
        $this->addSql('ALTER TABLE experiments_content DROP FOREIGN KEY FK_D865A952F132696E');
        $this->addSql('ALTER TABLE experiments_links DROP FOREIGN KEY FK_A46D3511F132696E');
        $this->addSql('ALTER TABLE experiments_notes DROP FOREIGN KEY FK_74F43285F132696E');
        $this->addSql('ALTER TABLE experiments_protocols DROP FOREIGN KEY FK_1A37373AF132696E');
        $this->addSql('ALTER TABLE items_comments DROP FOREIGN KEY FK_28E526E4F132696E');
        $this->addSql('ALTER TABLE items_revisions DROP FOREIGN KEY FK_F51AB682F132696E');
        $this->addSql('ALTER TABLE pin2users DROP FOREIGN KEY FK_9994AF0167B3B43D');
        $this->addSql('ALTER TABLE team_events DROP FOREIGN KEY FK_259C1093F132696E');
        $this->addSql('ALTER TABLE todolist DROP FOREIGN KEY FK_DD4DF6DBF132696E');
        $this->addSql('ALTER TABLE users2teams DROP FOREIGN KEY FK_C5DF9A9567B3B43D');
        $this->addSql('DROP TABLE api_keys');
        $this->addSql('DROP TABLE banned_users');
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE experiments');
        $this->addSql('DROP TABLE experiments_comments');
        $this->addSql('DROP TABLE experiments_conclusions');
        $this->addSql('DROP TABLE experiments_content');
        $this->addSql('DROP TABLE experiments_links');
        $this->addSql('DROP TABLE experiments_notes');
        $this->addSql('DROP TABLE experiments_protocols');
        $this->addSql('DROP TABLE experiments_revisions');
        $this->addSql('DROP TABLE experiments_steps');
        $this->addSql('DROP TABLE experiments_templates');
        $this->addSql('DROP TABLE experiments_templates_links');
        $this->addSql('DROP TABLE experiments_templates_steps');
        $this->addSql('DROP TABLE greeting');
        $this->addSql('DROP TABLE idps');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE items_comments');
        $this->addSql('DROP TABLE items_links');
        $this->addSql('DROP TABLE items_revisions');
        $this->addSql('DROP TABLE items_steps');
        $this->addSql('DROP TABLE items_types');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('DROP TABLE pin2users');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags2entity');
        $this->addSql('DROP TABLE team_events');
        $this->addSql('DROP TABLE team_groups');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE todolist');
        $this->addSql('DROP TABLE uploads');
        $this->addSql('DROP TABLE usergroups');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users2team_groups');
        $this->addSql('DROP TABLE users2teams');
    }
}
