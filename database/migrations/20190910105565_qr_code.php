<?php

use think\migration\Migrator;

/**
 * Class QrCode 二维码
 */
class QrCode extends Migrator
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
        $table = $this->table('qr_code', array('engine' => 'InnoDB'));
        $table->addColumn(
                'unique_code',
                'string',
                array('limit' => 32,'comment'=>'二维码唯一ID')
            )
            ->addColumn(
                'product_id',
                'integer',
                array('limit' => 10, 'comment' => '商品ID')
            )
            ->addColumn(
                'url',
                'string',
                array(
                    'limit' => 200,
                    'default' => 1,
                    'comment' => '链接地址'
                )
            )
            ->addTimestamps('create_time')
            ->addSoftDelete()
            ->addIndex(array('unique_code', 'product_id', 'url'))
            ->create();
    }

}
