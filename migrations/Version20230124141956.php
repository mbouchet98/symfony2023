<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124141956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_personne (livre_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_63052F4637D925CB (livre_id), INDEX IDX_63052F46A21BD112 (personne_id), PRIMARY KEY(livre_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_personne ADD CONSTRAINT FK_63052F4637D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_personne ADD CONSTRAINT FK_63052F46A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre_personne DROP FOREIGN KEY FK_63052F4637D925CB');
        $this->addSql('ALTER TABLE livre_personne DROP FOREIGN KEY FK_63052F46A21BD112');
        $this->addSql('DROP TABLE livre_personne');
    }
}
