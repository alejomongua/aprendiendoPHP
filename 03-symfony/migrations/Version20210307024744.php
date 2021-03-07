<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307024744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proyecto_user (proyecto_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(proyecto_id, user_id))');
        $this->addSql('CREATE INDEX IDX_B00928AF625D1BA ON proyecto_user (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_B00928AA76ED395 ON proyecto_user (user_id)');
        $this->addSql('ALTER TABLE proyecto_user ADD CONSTRAINT FK_B00928AF625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_user ADD CONSTRAINT FK_B00928AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE proyecto_user');
    }
}
