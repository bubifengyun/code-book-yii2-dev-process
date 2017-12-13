<?php

use yii\db\Migration;

class m171212_130621__user_post extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_user_post}}', [
            'id' => "int(11) NOT NULL",
            'type' => "int(11) NULL",
            'name' => "varchar(50) NULL",
            'org' => "varchar(50) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='移植的用户职务'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_user_post}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

