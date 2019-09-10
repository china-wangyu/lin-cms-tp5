<?php

use think\migration\Migrator;

/**
 * Class User 用户
 */
class Config extends Migrator
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
        $table = $this->table('config', array('engine' => 'InnoDB'));
        $table->addColumn(
                'name',
                'string',
                array('limit' => 24,'comment'=>'配置名称')
            )
            ->addColumn(
                'keyword',
                'string',
                array('limit' => 30, 'comment' => '配置key值')
            )
            ->addColumn(
                'value',
                'string',
                array(
                    'limit' => 200,
                    'null' => null,
                    'comment' => '配置值'
                )
            )
            ->addColumn(
                'tip',
                'string',
                array('limit' => 200, 'null' => null,'comment' => '提示')
            )
            ->addTimestamps('create_time', 'update_time')
            ->addSoftDelete()
            ->addIndex(array('name', 'keyword','value'))
            ->create();
    }

}
