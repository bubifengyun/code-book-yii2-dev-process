<?php

use yii\db\Migration;

class m171212_130621__personbye extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_personbye}}', [
            'id' => "varchar(32) NOT NULL",
            'name' => "varchar(64) NOT NULL",
            'namepinyin' => "varchar(128) NULL",
            'sex' => "enum('男','女') NOT NULL",
            'is_married' => "enum('是','否') NOT NULL",
            'is_with_spouse' => "enum('是','否') NOT NULL",
            'property' => "enum('党员','团员','群众') NULL",
            'photo' => "varchar(64) NULL",
            'can_home_weekend' => "enum('是','否') NOT NULL",
            'birthdate' => "date NOT NULL",
            'armydate' => "date NOT NULL",
            'current_mil_rank_date' => "date NULL",
            'next_mil_rank_date' => "date NULL",
            'current_techgrade_date' => "date NULL",
            'next_techgrade_date' => "date NULL",
            'current_other_date' => "date NULL",
            'next_other_date' => "date NULL",
            'status' => "int(2) NOT NULL DEFAULT '0'",
            'mil_rank' => "int(2) NOT NULL",
            'unit_code' => "int(11) NOT NULL",
            'tech_grade' => "varchar(32) NULL",
            'job' => "varchar(32) NOT NULL",
            'tel' => "varchar(32) NULL",
            'myhome_province' => "int(4) NULL",
            'myhome_city' => "int(4) NULL",
            'myhome_district' => "int(4) NULL",
            'parentshome_province' => "int(4) NULL",
            'parentshome_city' => "int(4) NULL",
            'parentshome_district' => "int(4) NULL",
            'hometown' => "varchar(56) NULL",
            'qrcode' => "varchar(256) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='离去人员信息表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_personbye}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

