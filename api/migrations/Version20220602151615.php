<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602151615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_role (category_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_DCF2F02D12469DE2 (category_id), INDEX IDX_DCF2F02DD60322AC (role_id), PRIMARY KEY(category_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_category (event_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_40A0F01171F7E88B (event_id), INDEX IDX_40A0F01112469DE2 (category_id), PRIMARY KEY(event_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_role ADD CONSTRAINT FK_DCF2F02D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_role ADD CONSTRAINT FK_DCF2F02DD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_category ADD CONSTRAINT FK_40A0F01171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_category ADD CONSTRAINT FK_40A0F01112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_role DROP FOREIGN KEY FK_DCF2F02D12469DE2');
        $this->addSql('ALTER TABLE event_category DROP FOREIGN KEY FK_40A0F01112469DE2');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_category DROP FOREIGN KEY FK_40A0F01171F7E88B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_role');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
