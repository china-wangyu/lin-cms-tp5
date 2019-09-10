<?php

use think\migration\Migrator;

/**
 * Class ProductCategory 商品分类
 */
class ProductCategory extends Migrator
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
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('product_category', array('engine' => 'InnoDB'));
        $table->addColumn(
                'title',
                'string',
                array('limit' => 24,'comment'=>'用户名')
            )
            ->addColumn(
                'parent_id',
                'integer',
                array('limit' => 4, 'comment' => '父级id')
            )
            ->addTimestamps('create_time', 'update_time')
            ->addSoftDelete()
            ->addIndex(array('title', 'parent_id'))
            ->create();
    }

}
