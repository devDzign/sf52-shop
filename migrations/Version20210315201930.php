<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315201930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reviews_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, more_informations TEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, is_best_seller BOOLEAN NOT NULL, is_new_arrival BOOLEAN DEFAULT NULL, is_featured BOOLEAN DEFAULT NULL, is_special_offer BOOLEAN DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product_category (product_id UUID NOT NULL, category_id UUID NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('COMMENT ON COLUMN product_category.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product_category.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE related_product (id UUID NOT NULL, product_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EC53CE084584665A ON related_product (product_id)');
        $this->addSql('COMMENT ON COLUMN related_product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN related_product.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE reviews_product (id INT NOT NULL, author_id UUID NOT NULL, product_id UUID NOT NULL, note INT NOT NULL, comment TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E0851D6CF675F31B ON reviews_product (author_id)');
        $this->addSql('CREATE INDEX IDX_E0851D6C4584665A ON reviews_product (product_id)');
        $this->addSql('COMMENT ON COLUMN reviews_product.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reviews_product.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tag (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tag.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tag_product (tag_id UUID NOT NULL, product_id UUID NOT NULL, PRIMARY KEY(tag_id, product_id))');
        $this->addSql('CREATE INDEX IDX_E17B2907BAD26311 ON tag_product (tag_id)');
        $this->addSql('CREATE INDEX IDX_E17B29074584665A ON tag_product (product_id)');
        $this->addSql('COMMENT ON COLUMN tag_product.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN tag_product.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE related_product ADD CONSTRAINT FK_EC53CE084584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reviews_product ADD CONSTRAINT FK_E0851D6CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reviews_product ADD CONSTRAINT FK_E0851D6C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_product ADD CONSTRAINT FK_E17B2907BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_product ADD CONSTRAINT FK_E17B29074584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE related_product DROP CONSTRAINT FK_EC53CE084584665A');
        $this->addSql('ALTER TABLE reviews_product DROP CONSTRAINT FK_E0851D6C4584665A');
        $this->addSql('ALTER TABLE tag_product DROP CONSTRAINT FK_E17B29074584665A');
        $this->addSql('ALTER TABLE tag_product DROP CONSTRAINT FK_E17B2907BAD26311');
        $this->addSql('DROP SEQUENCE reviews_product_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE related_product');
        $this->addSql('DROP TABLE reviews_product');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_product');
    }
}
