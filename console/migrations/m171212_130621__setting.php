<?php

use yii\db\Migration;

class m171212_130621__setting extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_setting}}', [
            'key' => "varchar(255) NOT NULL",
            'value' => "text NOT NULL",
            'PRIMARY KEY (`key`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_setting}}',['key'=>'age_older_unmarried','value'=>'28']);
        $this->insert('{{%_setting}}',['key'=>'current_update_time','value'=>'2016-10-01']);
        $this->insert('{{%_setting}}',['key'=>'day_can_lend_nextyear','value'=>'50']);
        $this->insert('{{%_setting}}',['key'=>'day_holiday','value'=>'30']);
        $this->insert('{{%_setting}}',['key'=>'day_home_weekend','value'=>'20']);
        $this->insert('{{%_setting}}',['key'=>'day_married','value'=>'30']);
        $this->insert('{{%_setting}}',['key'=>'day_officer_min_holiday','value'=>'2']);
        $this->insert('{{%_setting}}',['key'=>'day_older_unmarried','value'=>'10']);
        $this->insert('{{%_setting}}',['key'=>'day_soldier_min_holiday','value'=>'7']);
        $this->insert('{{%_setting}}',['key'=>'day_unreturn_notify','value'=>'5']);
        $this->insert('{{%_setting}}',['key'=>'dir_where2read','value'=>'/media/backup/']);
        $this->insert('{{%_setting}}',['key'=>'email.hostname','value'=>'winter.com']);
        $this->insert('{{%_setting}}',['key'=>'receiver_set_nextyear_lawholiday','value'=>'junwuke@v5.com']);
        $this->insert('{{%_setting}}',['key'=>'receiver_soldier','value'=>'junwuke@v5.com']);
        $this->insert('{{%_setting}}',['key'=>'site_name','value'=>'人员在位动态管理']);
        $this->insert('{{%_setting}}',['key'=>'site_title','value'=>'会飞的狼']);
        $this->insert('{{%_setting}}',['key'=>'status_current_here','value'=>'0:1:3:4:6:7:11']);
        $this->insert('{{%_setting}}',['key'=>'status_here','value'=>'0:1:3:4:6:7:10:11:12:13:14:15:16:17']);
        $this->insert('{{%_setting}}',['key'=>'task_mode','value'=>'0']);
        $this->insert('{{%_setting}}',['key'=>'version','value'=>'0.0.4内测版']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_setting}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

