<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223160216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, movie_id INT DEFAULT NULL, role VARCHAR(60) NOT NULL, credit_order INT NOT NULL, INDEX IDX_D11BBA50217BBB47 (person_id), INDEX IDX_D11BBA508F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, release_date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_genre (movie_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_FD1229648F93B6FC (movie_id), INDEX IDX_FD1229644296D31F (genre_id), PRIMARY KEY(movie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, content LONGTEXT NOT NULL, published_at DATETIME NOT NULL, INDEX IDX_794381C68F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA508F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229648F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229644296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229644296D31F');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA508F93B6FC');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229648F93B6FC');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68F93B6FC');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50217BBB47');
        $this->addSql('DROP TABLE casting');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_genre');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE review');
    }
}
