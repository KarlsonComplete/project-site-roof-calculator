<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202100921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_of_select_material DROP CONSTRAINT fk_3aa84f5168ee894b');
        $this->addSql('DROP INDEX idx_3aa84f5168ee894b');
        $this->addSql('ALTER TABLE type_of_select_material DROP coating_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE type_of_select_material ADD coating_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_of_select_material ADD CONSTRAINT fk_3aa84f5168ee894b FOREIGN KEY (coating_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_3aa84f5168ee894b ON type_of_select_material (coating_id)');
    }
}
