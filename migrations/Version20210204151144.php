<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204151144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sd_pratique (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, id_sport_id INT NOT NULL, niveau VARCHAR(255) NOT NULL, INDEX IDX_1D70C75BBA091CE5 (id_personne_id), INDEX IDX_1D70C75BFCA3506D (id_sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sd_pratique ADD CONSTRAINT FK_1D70C75BBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES sd_personne (id)');
        $this->addSql('ALTER TABLE sd_pratique ADD CONSTRAINT FK_1D70C75BFCA3506D FOREIGN KEY (id_sport_id) REFERENCES sd_sport (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sd_pratique');
    }
}
