<?php

use yii\db\Migration;

class m171212_130621__gate extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_gate}}', [
            'id' => "int(32) NOT NULL AUTO_INCREMENT",
            'person_id' => "varchar(32) NOT NULL",
            'leave_time' => "datetime NOT NULL",
            'leave_sentry' => "int(2) NOT NULL",
            'leave_host' => "varchar(32) NOT NULL",
            'come_time' => "datetime NULL",
            'come_sentry' => "int(2) NULL",
            'come_host' => "varchar(32) NULL",
            'type' => "int(2) NOT NULL",
            'has_completed' => "tinyint(1) NOT NULL DEFAULT '0'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='门岗登记表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_gate}}',['id'=>'1','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-12 21:19:18','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-12 21:19:24','come_sentry'=>'0','come_host'=>'哪吒','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'2','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-12 21:19:28','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-12 21:19:35','come_sentry'=>'0','come_host'=>'哪吒','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'3','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-12 21:22:21','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-12 21:22:24','come_sentry'=>'0','come_host'=>'哪吒','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'4','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-12 21:23:05','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-12 21:25:47','come_sentry'=>'0','come_host'=>'哪吒','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'5','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-12 21:26:43','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-12 21:26:48','come_sentry'=>'0','come_host'=>'哪吒','type'=>'1','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'6','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-18 10:11:47','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-04-18 10:11:53','come_sentry'=>'0','come_host'=>'哪吒','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'7','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-04-18 10:32:55','leave_sentry'=>'1','leave_host'=>'接引道人','come_time'=>'2016-04-18 10:33:00','come_sentry'=>'1','come_host'=>'接引道人','type'=>'3','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'8','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-05-09 11:16:20','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>'2016-05-09 11:54:43','come_sentry'=>'0','come_host'=>'哪吒','type'=>'9','has_completed'=>'1']);
        $this->insert('{{%_gate}}',['id'=>'9','person_id'=>'caocao.6@winter.com','leave_time'=>'2016-05-09 11:54:57','leave_sentry'=>'0','leave_host'=>'哪吒','come_time'=>NULL,'come_sentry'=>NULL,'come_host'=>NULL,'type'=>'3','has_completed'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_gate}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

