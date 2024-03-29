<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225152002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issues ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_DA7D7F83B03A8386 ON issues (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issues DROP FOREIGN KEY FK_DA7D7F83B03A8386');
        $this->addSql('DROP INDEX IDX_DA7D7F83B03A8386 ON issues');
        $this->addSql('ALTER TABLE issues DROP created_by_id');
    }
}
