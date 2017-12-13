<?php

use yii\db\Migration;

class m171212_130621__exe extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_exe}}', [
            'id' => "int(2) NOT NULL",
            'authItem' => "varchar(16) NOT NULL",
            'name' => "varchar(16) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作权限表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_exe}}',['id'=>'0','authItem'=>'normal','name'=>'普通用户']);
        $this->insert('{{%_exe}}',['id'=>'1','authItem'=>'supervisor','name'=>'基层主官']);
        $this->insert('{{%_exe}}',['id'=>'2','authItem'=>'leader','name'=>'上级领导']);
        $this->insert('{{%_exe}}',['id'=>'4','authItem'=>'officer','name'=>'机关人员']);
        $this->insert('{{%_exe}}',['id'=>'5','authItem'=>'admin','name'=>'管理员']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_exe}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

