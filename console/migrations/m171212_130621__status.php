<?php

use yii\db\Migration;

class m171212_130621__status extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_status}}', [
            'id' => "int(2) NOT NULL",
            'name' => "varchar(16) NOT NULL",
            'is_occupied_day' => "tinyint(1) NOT NULL DEFAULT '0'",
            'local' => "tinyint(4) NOT NULL DEFAULT '0'",
            'officer' => "tinyint(4) NOT NULL DEFAULT '0'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在位状态表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_status}}',['id'=>'0','name'=>'在队','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'1','name'=>'公差勤务','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'2','name'=>'驻地休息','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'3','name'=>'临时外出','is_occupied_day'=>'0','local'=>'0','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'4','name'=>'地面观察','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'5','name'=>'出差','is_occupied_day'=>'0','local'=>'1','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'6','name'=>'住院','is_occupied_day'=>'0','local'=>'1','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'7','name'=>'借调','is_occupied_day'=>'0','local'=>'0','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'8','name'=>'学习','is_occupied_day'=>'0','local'=>'1','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'9','name'=>'疗养','is_occupied_day'=>'0','local'=>'1','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'10','name'=>'探亲休假','is_occupied_day'=>'1','local'=>'0','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'11','name'=>'事假','is_occupied_day'=>'1','local'=>'0','officer'=>'2']);
        $this->insert('{{%_status}}',['id'=>'12','name'=>'外出','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'13','name'=>'回家休息','is_occupied_day'=>'0','local'=>'0','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'14','name'=>'逾假（休假）','is_occupied_day'=>'0','local'=>'0','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'15','name'=>'逾假（外出）','is_occupied_day'=>'0','local'=>'0','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'16','name'=>'转业待安置','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        $this->insert('{{%_status}}',['id'=>'17','name'=>'退休待移交','is_occupied_day'=>'0','local'=>'1','officer'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_status}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

