<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180927121751 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A44584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A44584665A ON projects (product_id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D6514584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_7B85D6514584665A ON requests (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A44584665A');
        $this->addSql('DROP INDEX IDX_5C93B3A44584665A ON projects');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D6514584665A');
        $this->addSql('DROP INDEX IDX_7B85D6514584665A ON requests');
    }
}
