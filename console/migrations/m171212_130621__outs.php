<?php

use yii\db\Migration;

class m171212_130621__outs extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_outs}}', [
            'o_id' => "int(32) NOT NULL AUTO_INCREMENT",
            'id' => "varchar(32) NOT NULL",
            'time_leave' => "timestamp NULL",
            'time_cancel' => "timestamp NULL",
            'note' => "varchar(32) NULL",
            'PRIMARY KEY (`o_id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='外出总表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_outs}}',['o_id'=>'1','id'=>'sunwukong2.12@winter.com','time_leave'=>'2016-04-08 11:05:52','time_cancel'=>NULL,'note'=>'13']);
        $this->insert('{{%_outs}}',['o_id'=>'2','id'=>'sunwukong3.12@winter.com','time_leave'=>'2016-04-08 12:10:43','time_cancel'=>NULL,'note'=>'']);
        $this->insert('{{%_outs}}',['o_id'=>'3','id'=>'sunwukong4.12@winter.com','time_leave'=>'2016-04-08 12:10:43','time_cancel'=>NULL,'note'=>'']);
        $this->insert('{{%_outs}}',['o_id'=>'4','id'=>'caocao.6@winter.com','time_leave'=>'2016-04-12 21:26:19','time_cancel'=>NULL,'note'=>'sadfasf']);
        $this->insert('{{%_outs}}',['o_id'=>'5','id'=>'sunwukong10.13@winter.com','time_leave'=>'2016-04-14 08:53:50','time_cancel'=>NULL,'note'=>'sd']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_outs}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

