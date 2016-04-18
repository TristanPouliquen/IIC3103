<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160418070300 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D122B005F7');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C652C408');
        $this->addSql('DROP INDEX IDX_723705D122B005F7 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1C652C408 ON transaction');
        $this->addSql('ALTER TABLE transaction ADD originAccount VARCHAR(255) NOT NULL, ADD destinationAccount VARCHAR(255) NOT NULL, DROP origin_account_id, DROP destination_account_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD origin_account_id INT DEFAULT NULL, ADD destination_account_id INT DEFAULT NULL, DROP originAccount, DROP destinationAccount');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D122B005F7 FOREIGN KEY (origin_account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C652C408 FOREIGN KEY (destination_account_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_723705D122B005F7 ON transaction (origin_account_id)');
        $this->addSql('CREATE INDEX IDX_723705D1C652C408 ON transaction (destination_account_id)');
    }
}
