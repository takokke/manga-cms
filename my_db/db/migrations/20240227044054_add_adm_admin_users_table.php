<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddAdmAdminUsersTable extends AbstractMigration
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
        $table = $this->table("adm_admin_users");
        $table->addColumn('email', 'string', ['default' => null, 'limit' => 100, 'null' => false])
            ->addColumn('password', 'string', ['default' => null, 'null' => false])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
