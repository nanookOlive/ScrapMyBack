<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115092541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biblio_game_game DROP FOREIGN KEY FK_8F1339B0E48FD905');
        $this->addSql('ALTER TABLE biblio_game_game DROP FOREIGN KEY FK_8F1339B0F0049243');
        $this->addSql('DROP TABLE biblio_game_game');
        $this->addSql('ALTER TABLE biblio_game DROP FOREIGN KEY FK_E4BCAF4AA76ED395');
        $this->addSql('DROP INDEX UNIQ_E4BCAF4AA76ED395 ON biblio_game');
        $this->addSql('ALTER TABLE biblio_game DROP user_id');
        $this->addSql('ALTER TABLE user DROP name, DROP firstname, DROP location');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biblio_game_game (biblio_game_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_8F1339B0F0049243 (biblio_game_id), INDEX IDX_8F1339B0E48FD905 (game_id), PRIMARY KEY(biblio_game_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE biblio_game_game ADD CONSTRAINT FK_8F1339B0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE biblio_game_game ADD CONSTRAINT FK_8F1339B0F0049243 FOREIGN KEY (biblio_game_id) REFERENCES biblio_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD location LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE biblio_game ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE biblio_game ADD CONSTRAINT FK_E4BCAF4AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E4BCAF4AA76ED395 ON biblio_game (user_id)');
    }
}
