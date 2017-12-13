<?php

use yii\db\Migration;

class m171212_130621__tag extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_tag}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(128) NOT NULL",
            'frequency' => "int(11) NULL DEFAULT '1'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_tag}}',['id'=>'78','name'=>'test','frequency'=>'2']);
        $this->insert('{{%_tag}}',['id'=>'80','name'=>'sdfgdfsg','frequency'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_tag}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

