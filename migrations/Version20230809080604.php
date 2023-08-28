<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809080604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE baguette_matiere (baguette_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_717625FA513FF34B (baguette_id), INDEX IDX_717625FAF46CD258 (matiere_id), PRIMARY KEY(baguette_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baguette_matiere ADD CONSTRAINT FK_717625FA513FF34B FOREIGN KEY (baguette_id) REFERENCES baguette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE baguette_matiere ADD CONSTRAINT FK_717625FAF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE baguette DROP FOREIGN KEY FK_D765813B22A4FFA2');
        $this->addSql('DROP INDEX IDX_D765813B22A4FFA2 ON baguette');
        $this->addSql('ALTER TABLE baguette DROP mantiere_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE baguette_matiere DROP FOREIGN KEY FK_717625FA513FF34B');
        $this->addSql('ALTER TABLE baguette_matiere DROP FOREIGN KEY FK_717625FAF46CD258');
        $this->addSql('DROP TABLE baguette_matiere');
        $this->addSql('ALTER TABLE baguette ADD mantiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE baguette ADD CONSTRAINT FK_D765813B22A4FFA2 FOREIGN KEY (mantiere_id) REFERENCES matiere (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D765813B22A4FFA2 ON baguette (mantiere_id)');
    }
}
