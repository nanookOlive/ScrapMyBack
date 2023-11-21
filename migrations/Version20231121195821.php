<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121195821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur_game (auteur_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_9F6F6F0260BB6FE6 (auteur_id), INDEX IDX_9F6F6F02E48FD905 (game_id), PRIMARY KEY(auteur_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dessinateur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dessinateur_game (dessinateur_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_1DECAACAEF0AD3BC (dessinateur_id), INDEX IDX_1DECAACAE48FD905 (game_id), PRIMARY KEY(dessinateur_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, editeur VARCHAR(255) NOT NULL, duration SMALLINT NOT NULL, nb_joueurs_min SMALLINT NOT NULL, nb_joueurs_max SMALLINT NOT NULL, age SMALLINT NOT NULL, image VARCHAR(1000) NOT NULL, short_description VARCHAR(1000) NOT NULL, long_description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_tmp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, href VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_game (theme_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_69ECC5B159027487 (theme_id), INDEX IDX_69ECC5B1E48FD905 (game_id), PRIMARY KEY(theme_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_game (type_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F424F484C54C8C93 (type_id), INDEX IDX_F424F484E48FD905 (game_id), PRIMARY KEY(type_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_game ADD CONSTRAINT FK_9F6F6F0260BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_game ADD CONSTRAINT FK_9F6F6F02E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dessinateur_game ADD CONSTRAINT FK_1DECAACAEF0AD3BC FOREIGN KEY (dessinateur_id) REFERENCES dessinateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dessinateur_game ADD CONSTRAINT FK_1DECAACAE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme_game ADD CONSTRAINT FK_69ECC5B159027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme_game ADD CONSTRAINT FK_69ECC5B1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_game ADD CONSTRAINT FK_F424F484C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_game ADD CONSTRAINT FK_F424F484E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur_game DROP FOREIGN KEY FK_9F6F6F0260BB6FE6');
        $this->addSql('ALTER TABLE auteur_game DROP FOREIGN KEY FK_9F6F6F02E48FD905');
        $this->addSql('ALTER TABLE dessinateur_game DROP FOREIGN KEY FK_1DECAACAEF0AD3BC');
        $this->addSql('ALTER TABLE dessinateur_game DROP FOREIGN KEY FK_1DECAACAE48FD905');
        $this->addSql('ALTER TABLE theme_game DROP FOREIGN KEY FK_69ECC5B159027487');
        $this->addSql('ALTER TABLE theme_game DROP FOREIGN KEY FK_69ECC5B1E48FD905');
        $this->addSql('ALTER TABLE type_game DROP FOREIGN KEY FK_F424F484C54C8C93');
        $this->addSql('ALTER TABLE type_game DROP FOREIGN KEY FK_F424F484E48FD905');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteur_game');
        $this->addSql('DROP TABLE dessinateur');
        $this->addSql('DROP TABLE dessinateur_game');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_tmp');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE theme_game');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_game');
        $this->addSql('DROP TABLE user');
    }
}
