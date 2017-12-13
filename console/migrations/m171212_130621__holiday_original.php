<?php

use yii\db\Migration;

class m171212_130621__holiday_original extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_holiday_original}}', [
            'id' => "int(11) NOT NULL",
            'name' => "varchar(64) NOT NULL",
            'department' => "varchar(64) NOT NULL",
            'grade' => "varchar(64) NOT NULL",
            'hunfou' => "varchar(64) NOT NULL",
            'ParentLocation' => "varchar(64) NOT NULL",
            'WifeLocation' => "varchar(64) NOT NULL",
            'towhere' => "varchar(64) NOT NULL",
            'leavetime' => "varchar(64) NOT NULL",
            'backtime' => "varchar(64) NOT NULL",
            'waytime' => "varchar(64) NOT NULL",
            'reason' => "varchar(64) NOT NULL",
            'leaveOrback' => "varchar(64) NOT NULL",
            'section' => "varchar(64) NOT NULL",
            'backtimereal' => "varchar(64) NOT NULL",
            'consumeDays' => "int(11) NOT NULL",
            'totalDays' => "int(11) NOT NULL",
            'xiujiaday' => "int(11) NOT NULL",
            'otherday' => "int(11) NOT NULL",
            'year' => "int(11) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_holiday_original}}',['id'=>'123','name'=>'呵呵aaaa','department'=>'唐诗','grade'=>'上将','hunfou'=>'已婚','ParentLocation'=>'不可说','WifeLocation'=>'可说','towhere'=>'不可说','leavetime'=>'213124','backtime'=>'23434345','waytime'=>'34525','reason'=>'235425','leaveOrback'=>'235425','section'=>'23543453','backtimereal'=>'235435','consumeDays'=>'235425','totalDays'=>'23542','xiujiaday'=>'235425','otherday'=>'235','year'=>'3223']);
        $this->insert('{{%_holiday_original}}',['id'=>'123456','name'=>'呵呵sdfsdfsdf','department'=>'唐诗','grade'=>'中将','hunfou'=>'未婚','ParentLocation'=>'可说','WifeLocation'=>'不可说','towhere'=>'23424','leavetime'=>'235345','backtime'=>'23545','waytime'=>'235435','reason'=>'23542','leaveOrback'=>'235','section'=>'2545','backtimereal'=>'23545','consumeDays'=>'2342','totalDays'=>'34','xiujiaday'=>'34','otherday'=>'235','year'=>'2354']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_holiday_original}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

