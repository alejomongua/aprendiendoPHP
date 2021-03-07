<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307222040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etiqueta (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D5CA63AA02A2F00 ON etiqueta (descripcion)');
        $this->addSql('CREATE TABLE "proyecto" (id INT NOT NULL, generado_por_id INT NOT NULL, inicio TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, estado VARCHAR(20) NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6FD202B94FB28359 ON "proyecto" (generado_por_id)');
        $this->addSql('CREATE TABLE proyecto_etiqueta (proyecto_id INT NOT NULL, etiqueta_id INT NOT NULL, PRIMARY KEY(proyecto_id, etiqueta_id))');
        $this->addSql('CREATE INDEX IDX_20803D02F625D1BA ON proyecto_etiqueta (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_20803D02D53DA3AB ON proyecto_etiqueta (etiqueta_id)');
        $this->addSql('CREATE TABLE proyecto_user (proyecto_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(proyecto_id, user_id))');
        $this->addSql('CREATE INDEX IDX_B00928AF625D1BA ON proyecto_user (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_B00928AA76ED395 ON proyecto_user (user_id)');
        $this->addSql('CREATE TABLE "tarea" (id INT NOT NULL, proyecto_id INT NOT NULL, generado_por_id INT NOT NULL, padre_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descripcion TEXT DEFAULT NULL, inicio TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, tipo VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, progreso INT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3CA05366F625D1BA ON "tarea" (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_3CA053664FB28359 ON "tarea" (generado_por_id)');
        $this->addSql('CREATE INDEX IDX_3CA05366613CEC58 ON "tarea" (padre_id)');
        $this->addSql('CREATE TABLE tarea_etiqueta (tarea_id INT NOT NULL, etiqueta_id INT NOT NULL, PRIMARY KEY(tarea_id, etiqueta_id))');
        $this->addSql('CREATE INDEX IDX_835FFBE96D5BDFE1 ON tarea_etiqueta (tarea_id)');
        $this->addSql('CREATE INDEX IDX_835FFBE9D53DA3AB ON tarea_etiqueta (etiqueta_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE "proyecto" ADD CONSTRAINT FK_6FD202B94FB28359 FOREIGN KEY (generado_por_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_etiqueta ADD CONSTRAINT FK_20803D02F625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_etiqueta ADD CONSTRAINT FK_20803D02D53DA3AB FOREIGN KEY (etiqueta_id) REFERENCES etiqueta (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_user ADD CONSTRAINT FK_B00928AF625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proyecto_user ADD CONSTRAINT FK_B00928AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "tarea" ADD CONSTRAINT FK_3CA05366F625D1BA FOREIGN KEY (proyecto_id) REFERENCES "proyecto" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "tarea" ADD CONSTRAINT FK_3CA053664FB28359 FOREIGN KEY (generado_por_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "tarea" ADD CONSTRAINT FK_3CA05366613CEC58 FOREIGN KEY (padre_id) REFERENCES "tarea" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea_etiqueta ADD CONSTRAINT FK_835FFBE96D5BDFE1 FOREIGN KEY (tarea_id) REFERENCES "tarea" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarea_etiqueta ADD CONSTRAINT FK_835FFBE9D53DA3AB FOREIGN KEY (etiqueta_id) REFERENCES etiqueta (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE proyecto_etiqueta DROP CONSTRAINT FK_20803D02D53DA3AB');
        $this->addSql('ALTER TABLE tarea_etiqueta DROP CONSTRAINT FK_835FFBE9D53DA3AB');
        $this->addSql('ALTER TABLE proyecto_etiqueta DROP CONSTRAINT FK_20803D02F625D1BA');
        $this->addSql('ALTER TABLE proyecto_user DROP CONSTRAINT FK_B00928AF625D1BA');
        $this->addSql('ALTER TABLE "tarea" DROP CONSTRAINT FK_3CA05366F625D1BA');
        $this->addSql('ALTER TABLE "tarea" DROP CONSTRAINT FK_3CA05366613CEC58');
        $this->addSql('ALTER TABLE tarea_etiqueta DROP CONSTRAINT FK_835FFBE96D5BDFE1');
        $this->addSql('ALTER TABLE "proyecto" DROP CONSTRAINT FK_6FD202B94FB28359');
        $this->addSql('ALTER TABLE proyecto_user DROP CONSTRAINT FK_B00928AA76ED395');
        $this->addSql('ALTER TABLE "tarea" DROP CONSTRAINT FK_3CA053664FB28359');
        $this->addSql('DROP TABLE etiqueta');
        $this->addSql('DROP TABLE "proyecto"');
        $this->addSql('DROP TABLE proyecto_etiqueta');
        $this->addSql('DROP TABLE proyecto_user');
        $this->addSql('DROP TABLE "tarea"');
        $this->addSql('DROP TABLE tarea_etiqueta');
        $this->addSql('DROP TABLE "user"');
    }
}
