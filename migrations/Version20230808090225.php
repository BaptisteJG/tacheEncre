<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808090225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, codespostaux_id INT DEFAULT NULL, num_rue VARCHAR(255) DEFAULT NULL, INDEX IDX_C35F0816A73F0036 (ville_id), INDEX IDX_C35F0816CDD80637 (codespostaux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baguette (id INT AUTO_INCREMENT NOT NULL, types_cadres_id INT DEFAULT NULL, mantiere_id INT DEFAULT NULL, couleur_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_D765813BCBF44C93 (types_cadres_id), INDEX IDX_D765813B22A4FFA2 (mantiere_id), INDEX IDX_D765813BC31BA576 (couleur_id), INDEX IDX_D765813B670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE codespostaux (id INT AUTO_INCREMENT NOT NULL, numero INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, tel VARCHAR(14) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_369ECA324DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passe_partout (id INT AUTO_INCREMENT NOT NULL, couleur_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E81F09B2C31BA576 (couleur_id), INDEX IDX_E81F09B2670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujet (id INT AUTO_INCREMENT NOT NULL, baguette_id INT DEFAULT NULL, passe_partout_id INT DEFAULT NULL, verre_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, format_sujet VARCHAR(255) DEFAULT NULL, taille_baguette VARCHAR(255) DEFAULT NULL, taille_pp VARCHAR(255) DEFAULT NULL, taille_verre VARCHAR(255) DEFAULT NULL, montant_total DOUBLE PRECISION DEFAULT NULL, accompte DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2E13599D513FF34B (baguette_id), INDEX IDX_2E13599DFC51591A (passe_partout_id), INDEX IDX_2E13599D8693204A (verre_id), INDEX IDX_2E13599D82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_cadres (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, tel VARCHAR(14) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6494DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verre (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_CBECD7DE670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816CDD80637 FOREIGN KEY (codespostaux_id) REFERENCES codespostaux (id)');
        $this->addSql('ALTER TABLE baguette ADD CONSTRAINT FK_D765813BCBF44C93 FOREIGN KEY (types_cadres_id) REFERENCES types_cadres (id)');
        $this->addSql('ALTER TABLE baguette ADD CONSTRAINT FK_D765813B22A4FFA2 FOREIGN KEY (mantiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE baguette ADD CONSTRAINT FK_D765813BC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE baguette ADD CONSTRAINT FK_D765813B670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA324DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE passe_partout ADD CONSTRAINT FK_E81F09B2C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE passe_partout ADD CONSTRAINT FK_E81F09B2670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599D513FF34B FOREIGN KEY (baguette_id) REFERENCES baguette (id)');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599DFC51591A FOREIGN KEY (passe_partout_id) REFERENCES passe_partout (id)');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599D8693204A FOREIGN KEY (verre_id) REFERENCES verre (id)');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE verre ADD CONSTRAINT FK_CBECD7DE670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A73F0036');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816CDD80637');
        $this->addSql('ALTER TABLE baguette DROP FOREIGN KEY FK_D765813BCBF44C93');
        $this->addSql('ALTER TABLE baguette DROP FOREIGN KEY FK_D765813B22A4FFA2');
        $this->addSql('ALTER TABLE baguette DROP FOREIGN KEY FK_D765813BC31BA576');
        $this->addSql('ALTER TABLE baguette DROP FOREIGN KEY FK_D765813B670C757F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA324DE7DC5C');
        $this->addSql('ALTER TABLE passe_partout DROP FOREIGN KEY FK_E81F09B2C31BA576');
        $this->addSql('ALTER TABLE passe_partout DROP FOREIGN KEY FK_E81F09B2670C757F');
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599D513FF34B');
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599DFC51591A');
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599D8693204A');
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599D82EA2E54');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DE7DC5C');
        $this->addSql('ALTER TABLE verre DROP FOREIGN KEY FK_CBECD7DE670C757F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE baguette');
        $this->addSql('DROP TABLE codespostaux');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE passe_partout');
        $this->addSql('DROP TABLE sujet');
        $this->addSql('DROP TABLE types_cadres');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE verre');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
