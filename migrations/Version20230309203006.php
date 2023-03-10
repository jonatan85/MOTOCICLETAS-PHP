<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309203006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE motos_tipo (motos_id INT NOT NULL, tipo_id INT NOT NULL, INDEX IDX_7731EF8B3869EA14 (motos_id), INDEX IDX_7731EF8BA9276E6C (tipo_id), PRIMARY KEY(motos_id, tipo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motos_tipo ADD CONSTRAINT FK_7731EF8B3869EA14 FOREIGN KEY (motos_id) REFERENCES motos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE motos_tipo ADD CONSTRAINT FK_7731EF8BA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motos_tipo DROP FOREIGN KEY FK_7731EF8B3869EA14');
        $this->addSql('ALTER TABLE motos_tipo DROP FOREIGN KEY FK_7731EF8BA9276E6C');
        $this->addSql('DROP TABLE motos_tipo');
        $this->addSql('DROP TABLE tipo');
    }
}
