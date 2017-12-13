<?php

use yii\db\Migration;

class m171212_130621__proportion extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_proportion}}', [
            'id' => "tinyint(1) NOT NULL",
            'name' => "varchar(16) NULL",
            'proportion' => "float NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_proportion}}',['id'=>'1','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'2','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'4','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'6','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'7','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'8','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'9','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'13','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'16','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'21','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'32','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'37','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'64','name'=>NULL,'proportion'=>'10']);
        $this->insert('{{%_proportion}}',['id'=>'69','name'=>NULL,'proportion'=>'10']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_proportion}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

