<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250711114940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agents (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, phone_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, INDEX IDX_9596AB6EED5CA9E6 (service_id), UNIQUE INDEX UNIQ_9596AB6E3B7323CB (phone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6E3B7323CB FOREIGN KEY (phone_id) REFERENCES phone (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents DROP FOREIGN KEY FK_9596AB6EED5CA9E6');
        $this->addSql('ALTER TABLE agents DROP FOREIGN KEY FK_9596AB6E3B7323CB');
        $this->addSql('DROP TABLE agents');
    }
}
