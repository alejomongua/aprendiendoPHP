<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304023734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE "proyecto" ADD COLUMN titulo VARCHAR(255)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE "proyecto" DROP COLUMN titulo');
    }
}
