<?php

use Phinx\Migration\AbstractMigration;

class CreateShopTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('products')
            ->addColumn('name', 'text')
            ->addColumn('description', 'text')
            ->addColumn('price', 'float')
            ->addColumn('image', 'text', ['null' => true])
            ->create();

        $this->table('cart')
            ->addColumn('id_good', 'integer')
            ->addColumn('session_id', 'text')
            ->addColumn('qty', 'integer')
            ->addColumn('user', 'text', ['null' => true])
            ->create();

        $this->table('feedback')
            ->addColumn('name', 'text')
            ->addColumn('feedback', 'text')
            ->addColumn('id_good', 'integer')
            ->create();

        $this->table('orders')
            ->addColumn('session_id', 'text')
            ->addColumn('name', 'text')
            ->addColumn('phone', 'integer')
            ->addColumn('price', 'integer')
            ->addColumn('status', 'integer')
            ->addColumn('user', 'text', ['null' => true])
            ->create();

        $this->table('users')
            ->addColumn('login', 'text')
            ->addColumn('pass', 'text')
            ->addColumn('hash', 'text', ['null' => true])
            ->addColumn('role', 'integer')
            ->create();
    }
}
