<?php

use yii\db\Migration;

class m171212_130621__weekend extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_weekend}}', [
            'id' => "int(11) NOT NULL",
            'begin_date' => "datetime NOT NULL",
            'end_date' => "datetime NOT NULL",
            'default_begin_weekday' => "datetime NULL",
            'default_end_weekday' => "datetime NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_weekend}}',['id'=>'1','begin_date'=>'2016-06-08 18:17:00','end_date'=>'2016-06-08 18:20:00','default_begin_weekday'=>'2016-03-12 15:55:40','default_end_weekday'=>'2016-02-04 07:10:40']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_weekend}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

