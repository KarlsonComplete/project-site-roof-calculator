<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103093026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coating DROP CONSTRAINT fk_f1311fc24334d104');
        $this->addSql('DROP SEQUENCE type_of_selected_material_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE type_of_select_material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE type_of_select_material (id INT NOT NULL, coating_id INT DEFAULT NULL, material_type_id INT DEFAULT NULL, title VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3AA84F5168EE894B ON type_of_select_material (coating_id)');
        $this->addSql('CREATE INDEX IDX_3AA84F5174D6573C ON type_of_select_material (material_type_id)');
        $this->addSql('ALTER TABLE type_of_select_material ADD CONSTRAINT FK_3AA84F5168EE894B FOREIGN KEY (coating_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_of_select_material ADD CONSTRAINT FK_3AA84F5174D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_of_selected_material DROP CONSTRAINT fk_2cae765174d6573c');
        $this->addSql('DROP TABLE type_of_selected_material');
        $this->addSql('DROP INDEX idx_f1311fc24334d104');
        $this->addSql('ALTER TABLE coating DROP type_of_selected_material_id');
        $this->addSql('ALTER TABLE material_type ADD coating_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE material_type ADD CONSTRAINT FK_D8B63A1C68EE894B FOREIGN KEY (coating_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D8B63A1C68EE894B ON material_type (coating_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE type_of_select_material_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE type_of_selected_material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE type_of_selected_material (id INT NOT NULL, material_type_id INT NOT NULL, title VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2cae765174d6573c ON type_of_selected_material (material_type_id)');
        $this->addSql('ALTER TABLE type_of_selected_material ADD CONSTRAINT fk_2cae765174d6573c FOREIGN KEY (material_type_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_of_select_material DROP CONSTRAINT FK_3AA84F5168EE894B');
        $this->addSql('ALTER TABLE type_of_select_material DROP CONSTRAINT FK_3AA84F5174D6573C');
        $this->addSql('DROP TABLE type_of_select_material');
        $this->addSql('ALTER TABLE material_type DROP CONSTRAINT FK_D8B63A1C68EE894B');
        $this->addSql('DROP INDEX IDX_D8B63A1C68EE894B');
        $this->addSql('ALTER TABLE material_type DROP coating_id');
        $this->addSql('ALTER TABLE coating ADD type_of_selected_material_id INT NOT NULL');
        $this->addSql('ALTER TABLE coating ADD CONSTRAINT fk_f1311fc24334d104 FOREIGN KEY (type_of_selected_material_id) REFERENCES type_of_selected_material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f1311fc24334d104 ON coating (type_of_selected_material_id)');
    }
}
