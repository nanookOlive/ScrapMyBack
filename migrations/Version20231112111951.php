<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112111951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, editeur VARCHAR(255) NOT NULL, duration SMALLINT NOT NULL, nb_joueurs_min SMALLINT NOT NULL, nb_joueurs_max SMALLINT NOT NULL, age SMALLINT NOT NULL, image VARCHAR(1000) NOT NULL, short_description VARCHAR(1000) NOT NULL, long_description VARCHAR(5000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE game_tmp');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_tmp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, href VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE game');
    }
}
