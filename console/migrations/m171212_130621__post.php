<?php

use yii\db\Migration;

class m171212_130621__post extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_post}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'title' => "varchar(128) NOT NULL",
            'content' => "text NOT NULL",
            'tags' => "text NULL",
            'status' => "int(11) NOT NULL",
            'create_time' => "datetime NULL",
            'update_time' => "datetime NULL",
            'author_id' => "varchar(64) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('FK_post_author','{{%_post}}','author_id',0);
        
        
        /* 表数据 */
        $this->insert('{{%_post}}',['id'=>'123','title'=>'woqu','content'=>'sdsdgsdgsdf','tags'=>'test','status'=>'2','create_time'=>'2017-12-12 20:08:05','update_time'=>'2017-12-12 20:08:05','author_id'=>'1@winter.com']);
        $this->insert('{{%_post}}',['id'=>'125','title'=>'sdfsdf','content'=>'dsgfsdg','tags'=>'sdfgdfsg','status'=>'2','create_time'=>'2017-12-12 20:59:28','update_time'=>'2017-12-12 20:59:28','author_id'=>'1@winter.com']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_post}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

