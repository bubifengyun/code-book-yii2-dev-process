<?php

use yii\db\Migration;

class m171212_130621__contact extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_contact}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(32) NOT NULL",
            'tel' => "varchar(32) NOT NULL",
            'subject' => "varchar(120) NOT NULL",
            'body' => "text NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='联系我们表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_contact}}',['id'=>'5','name'=>'李天赐','tel'=>'18817559557','subject'=>'234442','body'=>'4252525']);
        $this->insert('{{%_contact}}',['id'=>'6','name'=>'李天赐','tel'=>'18817559557','subject'=>'122223123','body'=>'25424535']);
        $this->insert('{{%_contact}}',['id'=>'7','name'=>'李天赐','tel'=>'18817559557','subject'=>'32452354','body'=>'3455']);
        $this->insert('{{%_contact}}',['id'=>'8','name'=>'李天赐','tel'=>'18817559557','subject'=>'3445','body'=>'23542525']);
        $this->insert('{{%_contact}}',['id'=>'9','name'=>'李天赐','tel'=>'18817559557','subject'=>'太累了','body'=>'干不下去了。']);
        $this->insert('{{%_contact}}',['id'=>'10','name'=>'李天赐','tel'=>'18817559557','subject'=>'不好了','body'=>'老虎被老鼠吃了。']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_contact}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

