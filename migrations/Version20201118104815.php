<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118104815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AA95C5C1');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA95C5C1 ON user');
        $this->addSql('ALTER TABLE user CHANGE structure_id_id structure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6492534008B ON user (structure_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492534008B');
        $this->addSql('DROP INDEX UNIQ_8D93D6492534008B ON user');
        $this->addSql('ALTER TABLE user CHANGE structure_id structure_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AA95C5C1 FOREIGN KEY (structure_id_id) REFERENCES structure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA95C5C1 ON user (structure_id_id)');
    }
}
