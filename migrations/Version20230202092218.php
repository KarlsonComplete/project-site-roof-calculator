<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202092218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roof_list ADD type_of_select_material_id INT NOT NULL');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT FK_4D0BE2BFA4D3F99D FOREIGN KEY (type_of_select_material_id) REFERENCES type_of_select_material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4D0BE2BFA4D3F99D ON roof_list (type_of_select_material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT FK_4D0BE2BFA4D3F99D');
        $this->addSql('DROP INDEX IDX_4D0BE2BFA4D3F99D');
        $this->addSql('ALTER TABLE roof_list DROP type_of_select_material_id');
    }
}
