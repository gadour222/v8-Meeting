<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240427232225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat ADD idsender INT NOT NULL, ADD idreciption INT NOT NULL, DROP username, DROP room');
        $this->addSql('ALTER TABLE mentoroffers ADD mentor VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD exprience VARCHAR(255) DEFAULT NULL, DROP parcour, DROP formation, DROP username, CHANGE domaine domaine VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat ADD username VARCHAR(255) NOT NULL, ADD room VARCHAR(255) NOT NULL, DROP idsender, DROP idreciption');
        $this->addSql('ALTER TABLE mentoroffers DROP mentor');
        $this->addSql('ALTER TABLE user ADD formation VARCHAR(255) DEFAULT NULL, ADD username VARCHAR(100) NOT NULL, CHANGE domaine domaine VARCHAR(255) DEFAULT NULL, CHANGE exprience parcour VARCHAR(255) DEFAULT NULL');
    }
}
