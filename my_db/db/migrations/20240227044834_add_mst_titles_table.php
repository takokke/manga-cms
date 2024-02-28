<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddMstTitlesTable extends AbstractMigration
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
        $table = $this->table("mst_titles");
        $table->addColumn('name', 'string', ['null' => false, 'limit' => 100])
            ->addColumn('author', 'string', ['default' => null, 'null' => false, 'limit' => 100])
            ->addColumn('description', 'string', ['default'=> null, 'null' => false])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
