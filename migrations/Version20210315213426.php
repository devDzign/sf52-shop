<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315213426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_product DROP CONSTRAINT fk_e17b2907bad26311');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_product');
        $this->addSql('ALTER TABLE product ADD tags TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE tag (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tag.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tag_product (tag_id UUID NOT NULL, product_id UUID NOT NULL, PRIMARY KEY(tag_id, product_id))');
        $this->addSql('CREATE INDEX idx_e17b29074584665a ON tag_product (product_id)');
        $this->addSql('CREATE INDEX idx_e17b2907bad26311 ON tag_product (tag_id)');
        $this->addSql('COMMENT ON COLUMN tag_product.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN tag_product.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE tag_product ADD CONSTRAINT fk_e17b2907bad26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_product ADD CONSTRAINT fk_e17b29074584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product DROP tags');
        $this->addSql('ALTER TABLE product DROP slug');
    }
}
