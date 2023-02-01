<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131112050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE roof_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE roof_list (id INT NOT NULL, coatings_id INT NOT NULL, material_types_id INT DEFAULT NULL, coating VARCHAR(55) NOT NULL, material_type VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4D0BE2BF617CBB4 ON roof_list (coatings_id)');
        $this->addSql('CREATE INDEX IDX_4D0BE2BFC86A17F5 ON roof_list (material_types_id)');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT FK_4D0BE2BF617CBB4 FOREIGN KEY (coatings_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT FK_4D0BE2BFC86A17F5 FOREIGN KEY (material_types_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roof_list ALTER material_types_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE roof_list_id_seq CASCADE');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT FK_4D0BE2BF617CBB4');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT FK_4D0BE2BFC86A17F5');
        $this->addSql('ALTER TABLE roof_list ALTER material_types_id DROP NOT NULL');
        $this->addSql('DROP TABLE roof_list');
    }

}
