<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307024537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE etiqueta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE etiqueta (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE proyecto_etiqueta (proyecto_id INT NOT NULL, etiqueta_id INT NOT NULL, PRIMARY KEY(proyecto_id, etiqueta_id))');
        $this->addSql('CREATE INDEX IDX_20803D02F625D1BA ON proyecto_etiqueta (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_20803D02D53DA3AB ON proyecto_etiqueta (etiqueta_id)');
        $this->addSql('CREATE TABLE tarea_etiqueta (tarea_id INT NOT NULL, etiqueta_id INT NOT NULL, PRIMARY KEY(tarea_id, etiqueta_id))');
        $this->addSql('CREATE INDEX IDX_835FFBE96D5BDFE1 ON tarea_etiqueta (tarea_id)');
        $this->addSql('CREATE INDEX IDX_835FFBE9D53DA3AB ON tarea_etiqueta (etiqueta_id)');
        $this->addSql('ALTER TABLE proyecto_etiqueta ADD CONSTRAINT FK_20803D02F625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_etiqueta ADD CONSTRAINT FK_20803D02D53DA3AB FOREIGN KEY (etiqueta_id) REFERENCES etiqueta (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea_etiqueta ADD CONSTRAINT FK_835FFBE96D5BDFE1 FOREIGN KEY (tarea_id) REFERENCES "tarea" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea_etiqueta ADD CONSTRAINT FK_835FFBE9D53DA3AB FOREIGN KEY (etiqueta_id) REFERENCES etiqueta (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE proyecto_etiqueta DROP CONSTRAINT FK_20803D02D53DA3AB');
        $this->addSql('ALTER TABLE tarea_etiqueta DROP CONSTRAINT FK_835FFBE9D53DA3AB');
        $this->addSql('DROP SEQUENCE etiqueta_id_seq CASCADE');
        $this->addSql('DROP TABLE etiqueta');
        $this->addSql('DROP TABLE proyecto_etiqueta');
        $this->addSql('DROP TABLE tarea_etiqueta');
    }
}
