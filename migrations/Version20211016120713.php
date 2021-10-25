<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016120713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE legend_game');
        $this->addSql('ALTER TABLE legend ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE legend ADD CONSTRAINT FK_C66AB3A6E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_C66AB3A6E48FD905 ON legend (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE legend_game (legend_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_564EF4EBD93B9119 (legend_id), INDEX IDX_564EF4EBE48FD905 (game_id), PRIMARY KEY(legend_id, game_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE legend_game ADD CONSTRAINT FK_564EF4EBD93B9119 FOREIGN KEY (legend_id) REFERENCES legend (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legend_game ADD CONSTRAINT FK_564EF4EBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legend DROP FOREIGN KEY FK_C66AB3A6E48FD905');
        $this->addSql('DROP INDEX IDX_C66AB3A6E48FD905 ON legend');
        $this->addSql('ALTER TABLE legend DROP game_id');
    }
}
