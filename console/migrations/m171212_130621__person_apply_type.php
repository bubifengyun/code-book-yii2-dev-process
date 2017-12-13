<?php

use yii\db\Migration;

class m171212_130621__person_apply_type extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_person_apply_type}}', [
            'id' => "int(11) NOT NULL",
            'name' => "varchar(50) NOT NULL",
            'local' => "tinyint(4) NULL",
            'id_status' => "int(11) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='人员申请类型表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_person_apply_type}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

