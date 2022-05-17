<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517144046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age_section (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, code VARCHAR(10) NOT NULL, color VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_E30B670D77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ended_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA7F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_scope (event_id INT NOT NULL, scope_id INT NOT NULL, INDEX IDX_41B4E4FF71F7E88B (event_id), INDEX IDX_41B4E4FF682B5931 (scope_id), PRIMARY KEY(event_id, scope_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_event_category (event_id INT NOT NULL, event_category_id INT NOT NULL, INDEX IDX_9FE4466271F7E88B (event_id), INDEX IDX_9FE44662B9CF4E62 (event_category_id), PRIMARY KEY(event_id, event_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, age_section_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, code VARCHAR(10) NOT NULL, feminine_name VARCHAR(100) DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, INDEX IDX_57698A6AD3F77268 (age_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scope (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, structure_id INT DEFAULT NULL, role_id INT DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_AF55D3A76ED395 (user_id), INDEX IDX_AF55D32534008B (structure_id), INDEX IDX_AF55D3D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, parent_structure_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, code VARCHAR(10) NOT NULL, INDEX IDX_6F0137EA755A5DA5 (parent_structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(96) NOT NULL, email VARCHAR(200) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, genre VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649D17F50A6 (uuid), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE event_scope ADD CONSTRAINT FK_41B4E4FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_scope ADD CONSTRAINT FK_41B4E4FF682B5931 FOREIGN KEY (scope_id) REFERENCES scope (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE4466271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_event_category ADD CONSTRAINT FK_9FE44662B9CF4E62 FOREIGN KEY (event_category_id) REFERENCES event_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AD3F77268 FOREIGN KEY (age_section_id) REFERENCES age_section (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D32534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA755A5DA5 FOREIGN KEY (parent_structure_id) REFERENCES structure (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AD3F77268');
        $this->addSql('ALTER TABLE event_scope DROP FOREIGN KEY FK_41B4E4FF71F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_event_category DROP FOREIGN KEY FK_9FE4466271F7E88B');
        $this->addSql('ALTER TABLE event_event_category DROP FOREIGN KEY FK_9FE44662B9CF4E62');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3D60322AC');
        $this->addSql('ALTER TABLE event_scope DROP FOREIGN KEY FK_41B4E4FF682B5931');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D32534008B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA755A5DA5');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F675F31B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3A76ED395');
        $this->addSql('DROP TABLE age_section');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_scope');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_event_category');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE scope');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE `user`');
    }
}
