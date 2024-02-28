<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddMstChaptersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table("mst_chapters");
        $table->addColumn('title_id', 'integer', ['signed' => false,'null' => false])
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('publication_start_date', 'date', ['null' => false])
        ->addForeignKey('title_id', 'mst_titles', 'id')
        ->create();
    }
}
