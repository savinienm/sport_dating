<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206145610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_134CB9355126AC48 ON sd_personne (mail)');
        $this->addSql('ALTER TABLE sd_sport CHANGE nom_sport nom_sport VARCHAR(320) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_197B8301B07D7347 ON sd_sport (nom_sport)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_134CB9355126AC48 ON sd_personne');
        $this->addSql('DROP INDEX UNIQ_197B8301B07D7347 ON sd_sport');
        $this->addSql('ALTER TABLE sd_sport CHANGE nom_sport nom_sport VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
