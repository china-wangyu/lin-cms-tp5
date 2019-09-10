<?php

use think\migration\Migrator;

/**
 * Class Product 商品
 */
class Product extends Migrator
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
        $table = $this->table('product', array('engine' => 'InnoDB'));
        $table->addColumn(
                'title',
                'string',
                array('limit' => 24,'comment'=>'商品名称')
            )
            ->addColumn(
                'description',
                'string',
                array('limit' => 200, 'comment' => '简介')
            )
            ->addColumn(
                'category_id',
                'integer',
                array(
                    'limit' => 200,
                    'default' => 1,
                    'comment' => '分类ID'
                )
            )
            ->addColumn(
                'icon',
                'string',
                array('limit' => 250, 'default' => 1,'comment' => '图标')
            )
            ->addTimestamps('create_time', 'update_time')
            ->addSoftDelete()
            ->addIndex(array('title', 'category_id', 'icon'))
            ->create();
    }

}
