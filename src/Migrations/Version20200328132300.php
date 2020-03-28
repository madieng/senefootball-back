<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328132300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, champion_ship_id INT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_F0E45BA9412A0CD0 (champion_ship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_club (season_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_3EA7A4EC4EC001D1 (season_id), INDEX IDX_3EA7A4EC61190A32 (club_id), PRIMARY KEY(season_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, date_of_birth DATE DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_club (player_id INT NOT NULL, club_id INT NOT NULL, INDEX IDX_1AF4684199E6F5DF (player_id), INDEX IDX_1AF4684161190A32 (club_id), PRIMARY KEY(player_id, club_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_season (player_id INT NOT NULL, season_id INT NOT NULL, INDEX IDX_6FE4CD7799E6F5DF (player_id), INDEX IDX_6FE4CD774EC001D1 (season_id), PRIMARY KEY(player_id, season_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, ad_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_9474526CB03A8386 (created_by_id), INDEX IDX_9474526C4F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion_ship (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_36606A9DF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, date DATE NOT NULL, hour TIME NOT NULL, status VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_7A5BC50561190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, content LONGTEXT NOT NULL, caption VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_23A0E66B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, creation_date DATE DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_coach (club_id INT NOT NULL, coach_id INT NOT NULL, INDEX IDX_9F37477E61190A32 (club_id), INDEX IDX_9F37477E3C105691 (coach_id), PRIMARY KEY(club_id, coach_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_president (club_id INT NOT NULL, president_id INT NOT NULL, INDEX IDX_C18272F261190A32 (club_id), INDEX IDX_C18272F2B40A33C7 (president_id), PRIMARY KEY(club_id, president_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9412A0CD0 FOREIGN KEY (champion_ship_id) REFERENCES champion_ship (id)');
        $this->addSql('ALTER TABLE season_club ADD CONSTRAINT FK_3EA7A4EC4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_club ADD CONSTRAINT FK_3EA7A4EC61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_club ADD CONSTRAINT FK_1AF4684199E6F5DF FOREIGN KEY (player_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_club ADD CONSTRAINT FK_1AF4684161190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_season ADD CONSTRAINT FK_6FE4CD7799E6F5DF FOREIGN KEY (player_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_season ADD CONSTRAINT FK_6FE4CD774EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4F34D596 FOREIGN KEY (ad_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE champion_ship ADD CONSTRAINT FK_36606A9DF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC50561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE club_coach ADD CONSTRAINT FK_9F37477E61190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_coach ADD CONSTRAINT FK_9F37477E3C105691 FOREIGN KEY (coach_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_president ADD CONSTRAINT FK_C18272F261190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_president ADD CONSTRAINT FK_C18272F2B40A33C7 FOREIGN KEY (president_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE season_club DROP FOREIGN KEY FK_3EA7A4EC4EC001D1');
        $this->addSql('ALTER TABLE player_season DROP FOREIGN KEY FK_6FE4CD774EC001D1');
        $this->addSql('ALTER TABLE champion_ship DROP FOREIGN KEY FK_36606A9DF92F3E70');
        $this->addSql('ALTER TABLE player_club DROP FOREIGN KEY FK_1AF4684199E6F5DF');
        $this->addSql('ALTER TABLE player_season DROP FOREIGN KEY FK_6FE4CD7799E6F5DF');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB03A8386');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66B03A8386');
        $this->addSql('ALTER TABLE club_coach DROP FOREIGN KEY FK_9F37477E3C105691');
        $this->addSql('ALTER TABLE club_president DROP FOREIGN KEY FK_C18272F2B40A33C7');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9412A0CD0');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4F34D596');
        $this->addSql('ALTER TABLE season_club DROP FOREIGN KEY FK_3EA7A4EC61190A32');
        $this->addSql('ALTER TABLE player_club DROP FOREIGN KEY FK_1AF4684161190A32');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC50561190A32');
        $this->addSql('ALTER TABLE club_coach DROP FOREIGN KEY FK_9F37477E61190A32');
        $this->addSql('ALTER TABLE club_president DROP FOREIGN KEY FK_C18272F261190A32');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE season_club');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE player_club');
        $this->addSql('DROP TABLE player_season');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE champion_ship');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_coach');
        $this->addSql('DROP TABLE club_president');
    }
}
