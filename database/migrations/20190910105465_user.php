<?php

use think\migration\Migrator;

/**
 * Class User 用户
 */
class User extends Migrator
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
        $table = $this->table('user', array('engine' => 'InnoDB'));
        $table->addColumn(
                'nickname',
                'string',
                array('limit' => 24,'comment'=>'用户名')
            )
            ->addColumn(
                'openid',
                'string',
                array('limit' => 34, 'comment' => '微信openid')
            )
            ->addColumn(
                'level',
                'integer',
                array(
                    'limit' => 2,
                    'default' => 1,
                    'comment' => '角色类型 ; 1 -> 普通用户 | 2 -> 员工'
                )
            )
            ->addColumn(
                'icon',
                'string',
                array('limit' => 250, 'default' => 1,'comment' => '角色头像')
            )
            ->addColumn('unionid', 'string', array('limit' => 62, 'null' => 'null','comment' => '唯一值'))
            ->addColumn('province', 'string', array('limit' => 10, 'null' => 'null','comment' => '省分'))
            ->addColumn('city', 'string', array('limit' => 10, 'null' => 'null','comment' => '城市'))
            ->addColumn('country', 'string', array('limit' => 10, 'null' => 'null','comment' => '国家'))
            ->addTimestamps('create_time', 'update_time')
            ->addSoftDelete()
            ->addIndex(array('nickname', 'openid','level','unionid'))
            ->create();
    }

}
