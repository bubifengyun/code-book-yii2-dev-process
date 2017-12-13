<?php

use yii\db\Migration;

class m171212_130621__person_apply extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_person_apply}}', [
            'id' => "int(11) NOT NULL",
            'apply_type' => "int(11) NULL",
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
        $this->dropTable('{{%_person_apply}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

