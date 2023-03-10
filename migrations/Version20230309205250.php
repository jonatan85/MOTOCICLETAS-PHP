<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309205250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moto_tipo (moto_id INT NOT NULL, tipo_id INT NOT NULL, INDEX IDX_484113BC78B8F2AC (moto_id), INDEX IDX_484113BCA9276E6C (tipo_id), PRIMARY KEY(moto_id, tipo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moto_tipo ADD CONSTRAINT FK_484113BC78B8F2AC FOREIGN KEY (moto_id) REFERENCES moto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moto_tipo ADD CONSTRAINT FK_484113BCA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moto_tipo DROP FOREIGN KEY FK_484113BC78B8F2AC');
        $this->addSql('ALTER TABLE moto_tipo DROP FOREIGN KEY FK_484113BCA9276E6C');
        $this->addSql('DROP TABLE moto_tipo');
    }
}
