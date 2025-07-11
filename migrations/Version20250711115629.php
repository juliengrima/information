<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250711115629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F363ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADF3F363ED5CA9E6 ON data (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE data DROP FOREIGN KEY FK_ADF3F363ED5CA9E6');
        $this->addSql('DROP INDEX UNIQ_ADF3F363ED5CA9E6 ON data');
        $this->addSql('ALTER TABLE data DROP service_id');
    }
}
