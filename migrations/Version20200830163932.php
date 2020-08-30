<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830163932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_history (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, level_id_id INT DEFAULT NULL, score INT DEFAULT NULL, INDEX IDX_A61CB4D19D86650F (user_id_id), INDEX IDX_A61CB4D1159D9B5E (level_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_history ADD CONSTRAINT FK_A61CB4D19D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note_history ADD CONSTRAINT FK_A61CB4D1159D9B5E FOREIGN KEY (level_id_id) REFERENCES level (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE note_history');
    }
}
