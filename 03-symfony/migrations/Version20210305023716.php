<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305023716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tarea_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tarea (id INT NOT NULL, proyecto_id INT NOT NULL, generado_por_id INT NOT NULL, padre_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, inicio TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, tipo VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, progreso INT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3CA05366F625D1BA ON tarea (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_3CA053664FB28359 ON tarea (generado_por_id)');
        $this->addSql('CREATE INDEX IDX_3CA05366613CEC58 ON tarea (padre_id)');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366F625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA053664FB28359 FOREIGN KEY (generado_por_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366613CEC58 FOREIGN KEY (padre_id) REFERENCES tarea (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto ALTER titulo SET NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tarea DROP CONSTRAINT FK_3CA05366613CEC58');
        $this->addSql('DROP SEQUENCE tarea_id_seq CASCADE');
        $this->addSql('DROP TABLE tarea');
        $this->addSql('ALTER TABLE "proyecto" ALTER titulo DROP NOT NULL');
    }
}
