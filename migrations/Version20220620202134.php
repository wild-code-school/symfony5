<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620202134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programs_actors (actor_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_32B98AB10DAF24A (actor_id), INDEX IDX_32B98AB3EB8070A (program_id), PRIMARY KEY(actor_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE programs_actors ADD CONSTRAINT FK_32B98AB10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE programs_actors ADD CONSTRAINT FK_32B98AB3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE actors_programs');
        $this->addSql('ALTER TABLE program ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actors_programs (actor_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_7E91335710DAF24A (actor_id), INDEX IDX_7E9133573EB8070A (program_id), PRIMARY KEY(actor_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actors_programs ADD CONSTRAINT FK_7E91335710DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actors_programs ADD CONSTRAINT FK_7E9133573EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE programs_actors');
        $this->addSql('ALTER TABLE program DROP slug');
    }
}
