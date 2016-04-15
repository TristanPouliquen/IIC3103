<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160415234657 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, provider VARCHAR(255) NOT NULL, client VARCHAR(255) NOT NULL, grossValue INT NOT NULL, vat INT NOT NULL, paymentState VARCHAR(255) NOT NULL, rejectionMotive VARCHAR(255) DEFAULT NULL, cancelationMotive VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, sku VARCHAR(255) NOT NULL, costs DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase_order (id INT AUTO_INCREMENT NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, canal VARCHAR(3) NOT NULL, provider VARCHAR(255) NOT NULL, client VARCHAR(255) NOT NULL, sku VARCHAR(255) NOT NULL, quantity INT NOT NULL, quantitySent INT DEFAULT NULL, unitPrice INT NOT NULL, deliveredAt DATETIME NOT NULL, state VARCHAR(255) NOT NULL, rejectionMotive VARCHAR(255) DEFAULT NULL, cancelationMotive VARCHAR(255) DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, origin_account_id INT DEFAULT NULL, destination_account_id INT DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_723705D122B005F7 (origin_account_id), INDEX IDX_723705D1C652C408 (destination_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D122B005F7 FOREIGN KEY (origin_account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C652C408 FOREIGN KEY (destination_account_id) REFERENCES account (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D122B005F7');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C652C408');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE purchase_order');
        $this->addSql('DROP TABLE transaction');
    }
}
