<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427163315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE details (id INT AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_72260B8AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT UNSIGNED AUTO_INCREMENT NOT NULL, post_mark_id INT DEFAULT NULL, comment_mark_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_1483A5E97F784618 (post_mark_id), INDEX IDX_1483A5E9B1E3933B (comment_mark_id), UNIQUE INDEX email_idx (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments_marks (id INT AUTO_INCREMENT NOT NULL, mark INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, category_id INT NOT NULL, post_mark_id INT NOT NULL, topic VARCHAR(255) NOT NULL, post LONGTEXT NOT NULL, INDEX IDX_885DBAFAA76ED395 (user_id), INDEX IDX_885DBAFA12469DE2 (category_id), INDEX IDX_885DBAFA7F784618 (post_mark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, user_id INT UNSIGNED DEFAULT NULL, comment_mark_id INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_5F9E962A4B89032C (post_id), INDEX IDX_5F9E962AA76ED395 (user_id), INDEX IDX_5F9E962AB1E3933B (comment_mark_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_marks (id INT AUTO_INCREMENT NOT NULL, mark INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E97F784618 FOREIGN KEY (post_mark_id) REFERENCES posts_marks (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9B1E3933B FOREIGN KEY (comment_mark_id) REFERENCES comments_marks (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA7F784618 FOREIGN KEY (post_mark_id) REFERENCES posts_marks (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AB1E3933B FOREIGN KEY (comment_mark_id) REFERENCES comments_marks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AA76ED395');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9B1E3933B');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AB1E3933B');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4B89032C');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E97F784618');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA7F784618');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE comments_marks');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE posts_marks');
    }
}
