<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124101548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, nom_livre VARCHAR(255) NOT NULL, rÃesumer_livre LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_edition (livre_id INT NOT NULL, edition_id INT NOT NULL, INDEX IDX_65E25C4B37D925CB (livre_id), INDEX IDX_65E25C4B74281A5E (edition_id), PRIMARY KEY(livre_id, edition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_edition ADD CONSTRAINT FK_65E25C4B37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_edition ADD CONSTRAINT FK_65E25C4B74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre_edition DROP FOREIGN KEY FK_65E25C4B37D925CB');
        $this->addSql('ALTER TABLE livre_edition DROP FOREIGN KEY FK_65E25C4B74281A5E');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE livre_edition');
    }
}
