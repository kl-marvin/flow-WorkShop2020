<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117130901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, type_id_id INT DEFAULT NULL, phone VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, street_name VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6F0137EA714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE user ADD structure_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AA95C5C1 FOREIGN KEY (structure_id_id) REFERENCES structure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA95C5C1 ON user (structure_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AA95C5C1');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA714819A0');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA95C5C1 ON user');
        $this->addSql('ALTER TABLE user DROP structure_id_id');
    }
}
