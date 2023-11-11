<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231111181828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_game (theme_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_69ECC5B159027487 (theme_id), INDEX IDX_69ECC5B1E48FD905 (game_id), PRIMARY KEY(theme_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE theme_game ADD CONSTRAINT FK_69ECC5B159027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme_game ADD CONSTRAINT FK_69ECC5B1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE theme_game DROP FOREIGN KEY FK_69ECC5B159027487');
        $this->addSql('ALTER TABLE theme_game DROP FOREIGN KEY FK_69ECC5B1E48FD905');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE theme_game');
    }
}
