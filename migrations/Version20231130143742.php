<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130143742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bibliogame (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, member_id INT NOT NULL, is_available TINYINT(1) DEFAULT NULL, borrowed_by INT DEFAULT NULL, borrowed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2E765A0DE48FD905 (game_id), INDEX IDX_2E765A0D7597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, editor_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, minimum_age INT DEFAULT NULL, release_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', rating DOUBLE PRECISION DEFAULT NULL, duration INT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, player_min INT NOT NULL, player_max INT DEFAULT NULL, slug VARCHAR(50) NOT NULL, short_description LONGTEXT NOT NULL, long_description LONGTEXT DEFAULT NULL, INDEX IDX_232B318C6995AC4C (editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_author (game_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_C09A7500E48FD905 (game_id), INDEX IDX_C09A7500F675F31B (author_id), PRIMARY KEY(game_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_illustrator (game_id INT NOT NULL, illustrator_id INT NOT NULL, INDEX IDX_495A53B5E48FD905 (game_id), INDEX IDX_495A53B5653613B3 (illustrator_id), PRIMARY KEY(game_id, illustrator_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_type (game_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_67CB3B05E48FD905 (game_id), INDEX IDX_67CB3B05C54C8C93 (type_id), PRIMARY KEY(game_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_theme (game_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_A5469E87E48FD905 (game_id), INDEX IDX_A5469E8759027487 (theme_id), PRIMARY KEY(game_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_tmp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, href VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE illustrator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, slug VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL, birthed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', address VARCHAR(100) NOT NULL, city VARCHAR(50) NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, postal_code INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bibliogame ADD CONSTRAINT FK_2E765A0DE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE bibliogame ADD CONSTRAINT FK_2E765A0D7597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE game_author ADD CONSTRAINT FK_C09A7500E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_author ADD CONSTRAINT FK_C09A7500F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_illustrator ADD CONSTRAINT FK_495A53B5E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_illustrator ADD CONSTRAINT FK_495A53B5653613B3 FOREIGN KEY (illustrator_id) REFERENCES illustrator (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_type ADD CONSTRAINT FK_67CB3B05E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_type ADD CONSTRAINT FK_67CB3B05C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_theme ADD CONSTRAINT FK_A5469E87E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_theme ADD CONSTRAINT FK_A5469E8759027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bibliogame DROP FOREIGN KEY FK_2E765A0DE48FD905');
        $this->addSql('ALTER TABLE bibliogame DROP FOREIGN KEY FK_2E765A0D7597D3FE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6995AC4C');
        $this->addSql('ALTER TABLE game_author DROP FOREIGN KEY FK_C09A7500E48FD905');
        $this->addSql('ALTER TABLE game_author DROP FOREIGN KEY FK_C09A7500F675F31B');
        $this->addSql('ALTER TABLE game_illustrator DROP FOREIGN KEY FK_495A53B5E48FD905');
        $this->addSql('ALTER TABLE game_illustrator DROP FOREIGN KEY FK_495A53B5653613B3');
        $this->addSql('ALTER TABLE game_type DROP FOREIGN KEY FK_67CB3B05E48FD905');
        $this->addSql('ALTER TABLE game_type DROP FOREIGN KEY FK_67CB3B05C54C8C93');
        $this->addSql('ALTER TABLE game_theme DROP FOREIGN KEY FK_A5469E87E48FD905');
        $this->addSql('ALTER TABLE game_theme DROP FOREIGN KEY FK_A5469E8759027487');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE bibliogame');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_author');
        $this->addSql('DROP TABLE game_illustrator');
        $this->addSql('DROP TABLE game_type');
        $this->addSql('DROP TABLE game_theme');
        $this->addSql('DROP TABLE game_tmp');
        $this->addSql('DROP TABLE illustrator');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
