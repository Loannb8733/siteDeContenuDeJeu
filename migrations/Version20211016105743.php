<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016105743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legend_game (legend_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_564EF4EBD93B9119 (legend_id), INDEX IDX_564EF4EBE48FD905 (game_id), PRIMARY KEY(legend_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE legend_game ADD CONSTRAINT FK_564EF4EBD93B9119 FOREIGN KEY (legend_id) REFERENCES legend (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legend_game ADD CONSTRAINT FK_564EF4EBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legend DROP title_game, CHANGE image image VARCHAR(255) NOT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE legend_game DROP FOREIGN KEY FK_564EF4EBE48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE legend_game');
        $this->addSql('ALTER TABLE legend ADD title_game VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
