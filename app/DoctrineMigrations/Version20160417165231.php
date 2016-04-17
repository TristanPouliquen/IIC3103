<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160417165231 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_order ADD product_id INT DEFAULT NULL, ADD status VARCHAR(255) NOT NULL, DROP sku, DROP state');
        $this->addSql('ALTER TABLE purchase_order ADD CONSTRAINT FK_21E210B24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_21E210B24584665A ON purchase_order (product_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_order DROP FOREIGN KEY FK_21E210B24584665A');
        $this->addSql('DROP INDEX IDX_21E210B24584665A ON purchase_order');
        $this->addSql('ALTER TABLE purchase_order ADD state VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP product_id, CHANGE status sku VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
