<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403190333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proposed_referendum_student (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposed_referendum_student_user (proposed_referendum_student_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C5B3F8DB756E5B9C (proposed_referendum_student_id), INDEX IDX_C5B3F8DBA76ED395 (user_id), PRIMARY KEY(proposed_referendum_student_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposed_referendum_student_user ADD CONSTRAINT FK_C5B3F8DB756E5B9C FOREIGN KEY (proposed_referendum_student_id) REFERENCES proposed_referendum_student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposed_referendum_student_user ADD CONSTRAINT FK_C5B3F8DBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proposed_referendum_student_user DROP FOREIGN KEY FK_C5B3F8DB756E5B9C');
        $this->addSql('DROP TABLE proposed_referendum_student');
        $this->addSql('DROP TABLE proposed_referendum_student_user');
    }
}
