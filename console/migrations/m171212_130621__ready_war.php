<?php

use yii\db\Migration;

class m171212_130621__ready_war extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_ready_war}}', [
            'id' => "int(2) NOT NULL",
            'name' => "varchar(64) NOT NULL",
            'begin_date' => "datetime NOT NULL",
            'end_date' => "datetime NOT NULL",
            'ratio_land_officer' => "int(11) NULL",
            'ratio_air_officer' => "int(11) NULL",
            'ratio_soldier' => "int(11) NOT NULL",
            'ratio_officer' => "int(11) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='战备日期表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_ready_war}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

