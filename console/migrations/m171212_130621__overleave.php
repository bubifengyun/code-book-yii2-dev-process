<?php

use yii\db\Migration;

class m171212_130621__overleave extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_overleave}}', [
            'o_id' => "int(11) NOT NULL AUTO_INCREMENT",
            'id' => "varchar(32) NOT NULL",
            'type' => "int(2) NOT NULL",
            'ps' => "varchar(72) NOT NULL",
            'PRIMARY KEY (`o_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_overleave}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

