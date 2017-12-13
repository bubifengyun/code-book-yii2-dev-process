<?php

use yii\db\Migration;

class m171212_130621__out extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_out}}', [
            'id' => "varchar(32) NOT NULL",
            'time_leave' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'time_come' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'time_cancel' => "timestamp NULL",
            'tel' => "varchar(32) NULL",
            'note' => "varchar(32) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='外出表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_out}}',['id'=>'caocao.6@winter.com','time_leave'=>'2016-04-12 21:26:19','time_come'=>'2016-04-13 01:26:19','time_cancel'=>NULL,'tel'=>'143','note'=>'sadfasf']);
        $this->insert('{{%_out}}',['id'=>'guanyu.6@winter.com','time_leave'=>'2016-01-28 18:17:48','time_come'=>'2016-01-28 22:17:48','time_cancel'=>'2016-02-22 15:52:54','tel'=>'','note'=>'']);
        $this->insert('{{%_out}}',['id'=>'hepengfei.1.201201@winter.com','time_leave'=>'2017-04-09 20:28:56','time_come'=>'2017-04-09 20:28:56','time_cancel'=>NULL,'tel'=>NULL,'note'=>NULL]);
        $this->insert('{{%_out}}',['id'=>'hepengfei.6@winter.com','time_leave'=>'2016-01-27 14:28:56','time_come'=>'2016-01-27 14:28:56','time_cancel'=>NULL,'tel'=>NULL,'note'=>NULL]);
        $this->insert('{{%_out}}',['id'=>'liqingzhao.6@winter.com','time_leave'=>'2016-01-27 22:04:47','time_come'=>'2016-01-27 22:04:47','time_cancel'=>NULL,'tel'=>NULL,'note'=>NULL]);
        $this->insert('{{%_out}}',['id'=>'litianci.11@lvfu.com','time_leave'=>'2016-01-17 17:56:04','time_come'=>'2016-01-17 21:23:10','time_cancel'=>'2016-01-17 17:55:42','tel'=>'','note'=>'']);
        $this->insert('{{%_out}}',['id'=>'litianci.4@winter.com','time_leave'=>'2016-02-22 12:42:10','time_come'=>'2016-02-22 16:42:10','time_cancel'=>'2016-02-22 16:35:20','tel'=>NULL,'note'=>'sd']);
        $this->insert('{{%_out}}',['id'=>'litianci.6@winter.com','time_leave'=>'2016-02-22 12:42:10','time_come'=>'2016-02-22 16:42:10','time_cancel'=>'2016-02-22 16:35:20','tel'=>NULL,'note'=>'sd']);
        $this->insert('{{%_out}}',['id'=>'sunwukong1.6@winter.com','time_leave'=>'2016-02-22 12:42:10','time_come'=>'2016-02-22 16:42:10','time_cancel'=>'2016-02-22 16:35:20','tel'=>'','note'=>'sd']);
        $this->insert('{{%_out}}',['id'=>'sunwukong10.13@winter.com','time_leave'=>'2016-04-18 12:17:17','time_come'=>'2016-04-14 12:53:50','time_cancel'=>'2016-04-18 12:17:12','tel'=>'','note'=>'sd']);
        $this->insert('{{%_out}}',['id'=>'sunwukong11.14@winter.com','time_leave'=>'2016-04-04 21:58:28','time_come'=>'2016-04-05 01:58:28','time_cancel'=>'2016-04-08 11:02:43','tel'=>'','note'=>'sd']);
        $this->insert('{{%_out}}',['id'=>'sunwukong16.15@winter.com','time_leave'=>'2016-03-09 19:15:30','time_come'=>'2016-03-09 23:14:52','time_cancel'=>'2016-03-09 19:15:25','tel'=>'','note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong2.12@winter.com','time_leave'=>'2016-04-08 11:05:52','time_come'=>'2016-04-08 15:05:52','time_cancel'=>'2016-04-13 16:00:42','tel'=>'143','note'=>'13']);
        $this->insert('{{%_out}}',['id'=>'sunwukong3.12@winter.com','time_leave'=>'2016-04-08 11:05:52','time_come'=>'2016-04-08 15:05:52','time_cancel'=>'2016-04-13 16:00:42','tel'=>'','note'=>'13']);
        $this->insert('{{%_out}}',['id'=>'sunwukong31.8@winter.com','time_leave'=>'2016-05-08 10:10:59','time_come'=>'2016-02-29 23:13:26','time_cancel'=>'2016-05-08 10:10:56','tel'=>'','note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong32.8@winter.com','time_leave'=>'2016-02-29 19:13:26','time_come'=>'2016-02-29 23:13:26','time_cancel'=>NULL,'tel'=>NULL,'note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong33.8@winter.com','time_leave'=>'2016-02-29 19:13:26','time_come'=>'2016-02-29 23:13:26','time_cancel'=>NULL,'tel'=>NULL,'note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong34.8@winter.com','time_leave'=>'2016-02-29 19:13:26','time_come'=>'2016-02-29 23:13:26','time_cancel'=>NULL,'tel'=>NULL,'note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong35.8@winter.com','time_leave'=>'2016-02-29 19:13:26','time_come'=>'2016-02-29 23:13:26','time_cancel'=>NULL,'tel'=>NULL,'note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong36.8@winter.com','time_leave'=>'2016-02-29 19:13:26','time_come'=>'2016-02-29 23:13:26','time_cancel'=>NULL,'tel'=>NULL,'note'=>'']);
        $this->insert('{{%_out}}',['id'=>'sunwukong4.12@winter.com','time_leave'=>'2016-04-08 11:05:52','time_come'=>'2016-04-08 15:05:52','time_cancel'=>'2016-04-13 16:00:42','tel'=>NULL,'note'=>'13']);
        $this->insert('{{%_out}}',['id'=>'sunwukong9.13@winter.com','time_leave'=>'2016-02-20 15:57:28','time_come'=>'2016-02-20 15:57:28','time_cancel'=>NULL,'tel'=>NULL,'note'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_out}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

