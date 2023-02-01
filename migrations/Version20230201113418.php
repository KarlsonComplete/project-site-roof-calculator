<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201113418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT fk_4d0be2bf617cbb4');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT fk_4d0be2bfc86a17f5');
        $this->addSql('DROP INDEX idx_4d0be2bfc86a17f5');
        $this->addSql('DROP INDEX idx_4d0be2bf617cbb4');
        $this->addSql('ALTER TABLE roof_list ADD coating_id INT NOT NULL');
        $this->addSql('ALTER TABLE roof_list ADD material_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE roof_list DROP coatings_id');
        $this->addSql('ALTER TABLE roof_list DROP material_types_id');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT FK_4D0BE2BF68EE894B FOREIGN KEY (coating_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT FK_4D0BE2BF74D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4D0BE2BF68EE894B ON roof_list (coating_id)');
        $this->addSql('CREATE INDEX IDX_4D0BE2BF74D6573C ON roof_list (material_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT FK_4D0BE2BF68EE894B');
        $this->addSql('ALTER TABLE roof_list DROP CONSTRAINT FK_4D0BE2BF74D6573C');
        $this->addSql('DROP INDEX IDX_4D0BE2BF68EE894B');
        $this->addSql('DROP INDEX IDX_4D0BE2BF74D6573C');
        $this->addSql('ALTER TABLE roof_list ADD coatings_id INT NOT NULL');
        $this->addSql('ALTER TABLE roof_list ADD material_types_id INT NOT NULL');
        $this->addSql('ALTER TABLE roof_list DROP coating_id');
        $this->addSql('ALTER TABLE roof_list DROP material_type_id');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT fk_4d0be2bf617cbb4 FOREIGN KEY (coatings_id) REFERENCES coating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roof_list ADD CONSTRAINT fk_4d0be2bfc86a17f5 FOREIGN KEY (material_types_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4d0be2bfc86a17f5 ON roof_list (material_types_id)');
        $this->addSql('CREATE INDEX idx_4d0be2bf617cbb4 ON roof_list (coatings_id)');
    }
}
