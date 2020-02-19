<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200201144058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE pacientai (id INT AUTO_INCREMENT NOT NULL, atsakingas_id INT DEFAULT NULL, gydymas VARCHAR(255) DEFAULT NULL, nusiskundimai VARCHAR(255) DEFAULT NULL, alergijos VARCHAR(255) DEFAULT NULL, bendrines_ligos VARCHAR(255) DEFAULT NULL, amzius VARCHAR(255) NOT NULL, pirmadienis LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', antradienis LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', treciadienis LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ketvirtadienis LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', penktadienis LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', bet_kada LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', vardas VARCHAR(255) NOT NULL, numeris VARCHAR(255) NOT NULL, test LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_E15442F398A4570 (atsakingas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eile (id INT AUTO_INCREMENT NOT NULL, pacientas_id INT DEFAULT NULL, user_id INT DEFAULT NULL, data DATETIME NOT NULL, INDEX IDX_9E2A99FE933C1DF2 (pacientas_id), INDEX IDX_9E2A99FEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eile ADD CONSTRAINT FK_9E2A99FE933C1DF2 FOREIGN KEY (pacientas_id) REFERENCES pacientai (id)');
        $this->addSql('ALTER TABLE eile ADD CONSTRAINT FK_9E2A99FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pacientai ADD CONSTRAINT FK_E15442F398A4570 FOREIGN KEY (atsakingas_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eile DROP FOREIGN KEY FK_9E2A99FE933C1DF2');
        $this->addSql('DROP TABLE eile');
        $this->addSql('DROP TABLE pacientai');
    }
}
