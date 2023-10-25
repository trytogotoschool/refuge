<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930141129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE animal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE photo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE photo_article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE animal (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AAB231F5E237E06 ON animal (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AAB231F989D9B62 ON animal (slug)');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, usr_id INT NOT NULL, username_id INT DEFAULT NULL, description TEXT NOT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E665E237E06 ON article (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66989D9B62 ON article (slug)');
        $this->addSql('CREATE INDEX IDX_23A0E66C69D3FB ON article (usr_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66ED766068 ON article (username_id)');
        $this->addSql('CREATE TABLE article_photo_article (article_id INT NOT NULL, photo_article_id INT NOT NULL, PRIMARY KEY(article_id, photo_article_id))');
        $this->addSql('CREATE INDEX IDX_B001F64E7294869C ON article_photo_article (article_id)');
        $this->addSql('CREATE INDEX IDX_B001F64E3EF06894 ON article_photo_article (photo_article_id)');
        $this->addSql('CREATE TABLE pet (id INT NOT NULL, usr_id INT NOT NULL, animal_id INT NOT NULL, birth TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, gender INT NOT NULL, description TEXT DEFAULT NULL, adopt BOOLEAN DEFAULT NULL, online BOOLEAN DEFAULT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E4529B855E237E06 ON pet (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E4529B85989D9B62 ON pet (slug)');
        $this->addSql('CREATE INDEX IDX_E4529B85C69D3FB ON pet (usr_id)');
        $this->addSql('CREATE INDEX IDX_E4529B858E962C16 ON pet (animal_id)');
        $this->addSql('CREATE TABLE pet_tag (pet_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(pet_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_4AC9A6D6966F7FB6 ON pet_tag (pet_id)');
        $this->addSql('CREATE INDEX IDX_4AC9A6D6BAD26311 ON pet_tag (tag_id)');
        $this->addSql('CREATE TABLE photo (id INT NOT NULL, pet_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14B78418966F7FB6 ON photo (pet_id)');
        $this->addSql('CREATE TABLE photo_article (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(30) NOT NULL, update_blog BOOLEAN NOT NULL, update_pet BOOLEAN NOT NULL, update_user BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57698A6A5E237E06 ON role (name)');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(30) NOT NULL, slug VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B7835E237E06 ON tag (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783989D9B62 ON tag (slug)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, role_id INT DEFAULT NULL, name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, activated BOOLEAN NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON "user" (name)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66ED766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_photo_article ADD CONSTRAINT FK_B001F64E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_photo_article ADD CONSTRAINT FK_B001F64E3EF06894 FOREIGN KEY (photo_article_id) REFERENCES photo_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B85C69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B858E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pet_tag ADD CONSTRAINT FK_4AC9A6D6966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pet_tag ADD CONSTRAINT FK_4AC9A6D6BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE animal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE photo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE photo_article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66C69D3FB');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66ED766068');
        $this->addSql('ALTER TABLE article_photo_article DROP CONSTRAINT FK_B001F64E7294869C');
        $this->addSql('ALTER TABLE article_photo_article DROP CONSTRAINT FK_B001F64E3EF06894');
        $this->addSql('ALTER TABLE pet DROP CONSTRAINT FK_E4529B85C69D3FB');
        $this->addSql('ALTER TABLE pet DROP CONSTRAINT FK_E4529B858E962C16');
        $this->addSql('ALTER TABLE pet_tag DROP CONSTRAINT FK_4AC9A6D6966F7FB6');
        $this->addSql('ALTER TABLE pet_tag DROP CONSTRAINT FK_4AC9A6D6BAD26311');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B78418966F7FB6');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D60322AC');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_photo_article');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pet_tag');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE photo_article');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
