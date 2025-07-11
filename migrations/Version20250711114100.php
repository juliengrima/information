<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250711114100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, site_name VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, localistaion_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, number INT DEFAULT NULL, INDEX IDX_444F97DDC7366CBA (localistaion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, localisation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD2C68BE09C (localisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDC7366CBA FOREIGN KEY (localistaion_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDC7366CBA');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2C68BE09C');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE service');
    }
}
