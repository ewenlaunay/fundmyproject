<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200120124004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project_category (project_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_3B02921A166D1F9C (project_id), INDEX IDX_3B02921A12469DE2 (category_id), PRIMARY KEY(project_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_category ADD CONSTRAINT FK_3B02921A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE project_has_category');
        $this->addSql('ALTER TABLE category CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE project CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE project RENAME INDEX fk_project_user1_idx TO IDX_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE contribution CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE project_id project_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE contribution RENAME INDEX fk_contribution_project1_idx TO IDX_EA351E15166D1F9C');
        $this->addSql('ALTER TABLE contribution RENAME INDEX fk_contribution_user1_idx TO IDX_EA351E15A76ED395');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project_has_category (project_id BIGINT NOT NULL, category_id BIGINT NOT NULL, INDEX fk_project_has_category_category1_idx (category_id), INDEX fk_project_has_category_project_idx (project_id), PRIMARY KEY(project_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_has_category ADD CONSTRAINT fk_project_has_category_category1 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE project_has_category ADD CONSTRAINT fk_project_has_category_project FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE project_category');
        $this->addSql('ALTER TABLE category CHANGE id id BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE contribution CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE project_id project_id BIGINT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15a76ed395 TO fk_contribution_user1_idx');
        $this->addSql('ALTER TABLE contribution RENAME INDEX idx_ea351e15166d1f9c TO fk_contribution_project1_idx');
        $this->addSql('ALTER TABLE project CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE project RENAME INDEX idx_2fb3d0eea76ed395 TO fk_project_user1_idx');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE roles roles VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
