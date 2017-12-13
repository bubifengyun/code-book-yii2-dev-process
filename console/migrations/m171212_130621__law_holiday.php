<?php

use yii\db\Migration;

class m171212_130621__law_holiday extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_law_holiday}}', [
            'id' => "int(2) NOT NULL AUTO_INCREMENT",
            'name' => "date NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='法定节假日表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_law_holiday}}',['id'=>'3','name'=>'2015-03-12']);
        $this->insert('{{%_law_holiday}}',['id'=>'4','name'=>'2015-03-17']);
        $this->insert('{{%_law_holiday}}',['id'=>'5','name'=>'2015-01-01']);
        $this->insert('{{%_law_holiday}}',['id'=>'6','name'=>'2015-03-29']);
        $this->insert('{{%_law_holiday}}',['id'=>'7','name'=>'2015-04-01']);
        $this->insert('{{%_law_holiday}}',['id'=>'8','name'=>'2015-04-05']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_law_holiday}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

