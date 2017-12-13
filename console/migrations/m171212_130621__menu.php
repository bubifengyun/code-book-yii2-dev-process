<?php

use yii\db\Migration;

class m171212_130621__menu extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_menu}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(128) NOT NULL",
            'parent' => "int(11) NULL",
            'route' => "varchar(256) NULL",
            'order' => "int(11) NULL",
            'data' => "text NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('parent','{{%_menu}}','parent',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk__menu_7023_00','{{%_menu}}', 'parent', '{{%_menu}}', 'id', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_menu}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

