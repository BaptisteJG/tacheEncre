<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825132004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD etat_command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9AAD548F FOREIGN KEY (etat_command_id) REFERENCES etat_command (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9AAD548F ON commande (etat_command_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9AAD548F');
        $this->addSql('DROP INDEX IDX_6EEAA67D9AAD548F ON commande');
        $this->addSql('ALTER TABLE commande DROP etat_command_id');
    }
}
