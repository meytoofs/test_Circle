<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830161659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_history (id INT AUTO_INCREMENT NOT NULL, level_id_id INT DEFAULT NULL, score INT DEFAULT NULL, INDEX IDX_A61CB4D1159D9B5E (level_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_history ADD CONSTRAINT FK_A61CB4D1159D9B5E FOREIGN KEY (level_id_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE level ADD title VARCHAR(255) NOT NULL, ADD total_score INT DEFAULT NULL, ADD featured_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD note_history_id INT DEFAULT NULL, ADD notes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497EA2AD62 FOREIGN KEY (note_history_id) REFERENCES note_history (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FC56F556 FOREIGN KEY (notes_id) REFERENCES note_history (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497EA2AD62 ON user (note_history_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FC56F556 ON user (notes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497EA2AD62');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FC56F556');
        $this->addSql('DROP TABLE note_history');
        $this->addSql('ALTER TABLE level DROP title, DROP total_score, DROP featured_image');
        $this->addSql('DROP INDEX IDX_8D93D6497EA2AD62 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649FC56F556 ON user');
        $this->addSql('ALTER TABLE user DROP note_history_id, DROP notes_id');
    }
}
