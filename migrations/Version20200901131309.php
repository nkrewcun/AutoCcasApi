<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901131309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, ligne1 VARCHAR(50) DEFAULT NULL, ligne2 VARCHAR(50) DEFAULT NULL, ligne3 VARCHAR(50) DEFAULT NULL, code_postal VARCHAR(5) NOT NULL, commune VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, modele_id INT NOT NULL, garage_id INT NOT NULL, carburant_id INT NOT NULL, reference VARCHAR(10) NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, description_courte VARCHAR(255) NOT NULL, annee_mise_circulation INT NOT NULL, kilometrage INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_publication DATE NOT NULL, INDEX IDX_F65593E5AC14B70A (modele_id), INDEX IDX_F65593E5C4FFF555 (garage_id), INDEX IDX_F65593E532DAAD24 (carburant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, professionnel_id INT NOT NULL, nom VARCHAR(50) NOT NULL, numero_tel VARCHAR(10) NOT NULL, INDEX IDX_9F26610B4DE7DC5C (adresse_id), INDEX IDX_9F26610B8A49CC82 (professionnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, source VARCHAR(50) NOT NULL, label VARCHAR(50) DEFAULT NULL, INDEX IDX_14B784188805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, numero_siret VARCHAR(14) NOT NULL, login VARCHAR(20) NOT NULL, password VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_7A28C10FAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_carburant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E532DAAD24 FOREIGN KEY (carburant_id) REFERENCES type_carburant (id)');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610B4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610B8A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610B4DE7DC5C');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188805AB2F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C4FFF555');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5AC14B70A');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610B8A49CC82');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E532DAAD24');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE type_carburant');
    }
}
