<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010115920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, plante_id INT NOT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F177B16E8 (plante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plante (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, famille_botanique VARCHAR(255) DEFAULT NULL, origin VARCHAR(255) DEFAULT NULL, type_de_feuillage VARCHAR(255) DEFAULT NULL, frequence_arrosage VARCHAR(255) DEFAULT NULL, taille_mature NUMERIC(10, 2) DEFAULT NULL, periode_floraison VARCHAR(255) DEFAULT NULL, utilisation VARCHAR(255) DEFAULT NULL, lieu_cultive VARCHAR(255) DEFAULT NULL, couleur_fleur VARCHAR(255) DEFAULT NULL, climat VARCHAR(255) DEFAULT NULL, exposition VARCHAR(255) DEFAULT NULL, besoin_eau VARCHAR(255) DEFAULT NULL, resistance_froid VARCHAR(255) DEFAULT NULL, niveau_soin VARCHAR(255) DEFAULT NULL, nature_terre VARCHAR(255) DEFAULT NULL, humidite_sol VARCHAR(255) DEFAULT NULL, ph_sol VARCHAR(255) DEFAULT NULL, croissance VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, type_plante VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plante_user (plante_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_868D1B11177B16E8 (plante_id), INDEX IDX_868D1B11A76ED395 (user_id), PRIMARY KEY(plante_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id)');
        $this->addSql('ALTER TABLE plante_user ADD CONSTRAINT FK_868D1B11177B16E8 FOREIGN KEY (plante_id) REFERENCES plante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plante_user ADD CONSTRAINT FK_868D1B11A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F177B16E8');
        $this->addSql('ALTER TABLE plante_user DROP FOREIGN KEY FK_868D1B11177B16E8');
        $this->addSql('ALTER TABLE plante_user DROP FOREIGN KEY FK_868D1B11A76ED395');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE plante');
        $this->addSql('DROP TABLE plante_user');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
