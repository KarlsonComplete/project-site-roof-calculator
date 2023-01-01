<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205163654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE coating_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE material_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_of_selected_material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE coating (id INT NOT NULL, type_of_selected_material_id INT NOT NULL, title VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F1311FC24334D104 ON coating (type_of_selected_material_id)');
        $this->addSql('CREATE TABLE material_type (id INT NOT NULL, title VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_of_selected_material (id INT NOT NULL, material_type_id INT NOT NULL, title VARCHAR(55) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CAE765174D6573C ON type_of_selected_material (material_type_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE coating ADD CONSTRAINT FK_F1311FC24334D104 FOREIGN KEY (type_of_selected_material_id) REFERENCES type_of_selected_material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_of_selected_material ADD CONSTRAINT FK_2CAE765174D6573C FOREIGN KEY (material_type_id) REFERENCES material_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE coating_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE material_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_of_selected_material_id_seq CASCADE');
        $this->addSql('ALTER TABLE coating DROP CONSTRAINT FK_F1311FC24334D104');
        $this->addSql('ALTER TABLE type_of_selected_material DROP CONSTRAINT FK_2CAE765174D6573C');
        $this->addSql('DROP TABLE coating');
        $this->addSql('DROP TABLE material_type');
        $this->addSql('DROP TABLE type_of_selected_material');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
