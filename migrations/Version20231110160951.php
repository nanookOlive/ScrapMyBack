<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110160951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(500) NOT NULL, image VARCHAR(1000) NOT NULL, editeur VARCHAR(500) NOT NULL, duration SMALLINT NOT NULL, age SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_tmp (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, href VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_type_game (game_type_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_26823586508EF3BC (game_type_id), INDEX IDX_26823586E48FD905 (game_id), PRIMARY KEY(game_type_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_type_game ADD CONSTRAINT FK_26823586508EF3BC FOREIGN KEY (game_type_id) REFERENCES game_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_type_game ADD CONSTRAINT FK_26823586E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_type_game DROP FOREIGN KEY FK_26823586508EF3BC');
        $this->addSql('ALTER TABLE game_type_game DROP FOREIGN KEY FK_26823586E48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_tmp');
        $this->addSql('DROP TABLE game_type');
        $this->addSql('DROP TABLE game_type_game');
    }
}
