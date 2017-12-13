<?php

use yii\db\Migration;

class m171212_130621__follow extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_follow}}', [
            'uid' => "varchar(64) NOT NULL",
            'fid' => "varchar(64) NOT NULL",
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_follow}}',['uid'=>'litianci.canyinbu@wuzhishan.jail','fid'=>'nigulasi.wubu@youare.com']);
        $this->insert('{{%_follow}}',['uid'=>'litianci.canyinbu@wuzhishan.jail','fid'=>'12@winter.com']);
        $this->insert('{{%_follow}}',['uid'=>'litianci.canyinbu@wuzhishan.jail','fid'=>'13@winter.com']);
        $this->insert('{{%_follow}}',['uid'=>'litianci.canyinbu@wuzhishan.jail','fid'=>'16@winter.com']);
        $this->insert('{{%_follow}}',['uid'=>'8@winter.com','fid'=>'sentry03@seeyou.com']);
        $this->insert('{{%_follow}}',['uid'=>'8@winter.com','fid'=>'sentry01@seeyou.com']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_follow}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

