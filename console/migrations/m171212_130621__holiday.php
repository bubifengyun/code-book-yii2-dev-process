<?php

use yii\db\Migration;

class m171212_130621__holiday extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_holiday}}', [
            'h_id' => "int(11) NOT NULL AUTO_INCREMENT",
            'id' => "varchar(32) NOT NULL",
            'date_leave' => "date NOT NULL",
            'which_year' => "year(4) NULL",
            'date_come' => "date NULL",
            'date_latest' => "date NULL",
            'date_cancel' => "date NULL",
            'boss_id' => "varchar(32) NULL",
            'where_leave' => "varchar(32) NOT NULL",
            'tel' => "varchar(32) NOT NULL",
            'kind' => "int(2) NOT NULL",
            'paper' => "varchar(64) NULL",
            'report_month' => "tinyint(1) NOT NULL DEFAULT '0'",
            'ps' => "varchar(32) NULL",
            'PRIMARY KEY (`h_id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='在外表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_holiday}}',['h_id'=>'23','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-26','which_year'=>'2016','date_come'=>NULL,'date_latest'=>NULL,'date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'sdfsfd','tel'=>'13333333333','kind'=>'3','paper'=>NULL,'report_month'=>'4','ps'=>'事假']);
        $this->insert('{{%_holiday}}',['h_id'=>'24','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-15','which_year'=>'2016','date_come'=>'2016-01-21','date_latest'=>NULL,'date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'回家','tel'=>'13333333333','kind'=>'13','paper'=>NULL,'report_month'=>'4','ps'=>'不告诉你']);
        $this->insert('{{%_holiday}}',['h_id'=>'25','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-15','which_year'=>'2016','date_come'=>'2016-01-21','date_latest'=>NULL,'date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'回家','tel'=>'13333333333','kind'=>'13','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'26','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-26','which_year'=>'2016','date_come'=>'2016-01-28','date_latest'=>NULL,'date_cancel'=>'2016-01-26','boss_id'=>NULL,'where_leave'=>'hometown','tel'=>'13333333333\'','kind'=>'9','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'27','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-26','which_year'=>'2016','date_come'=>'2016-01-30','date_latest'=>NULL,'date_cancel'=>'2016-01-29','boss_id'=>NULL,'where_leave'=>'sdfsfdsdf','tel'=>'13333333333\'','kind'=>'14','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'28','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-26','which_year'=>'2016','date_come'=>'2016-01-26','date_latest'=>NULL,'date_cancel'=>'2016-01-26','boss_id'=>NULL,'where_leave'=>'sdfsdsdf','tel'=>'13333333333\'','kind'=>'3','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'29','id'=>'litianci.6@winter.com','date_leave'=>'2016-01-26','which_year'=>'2016','date_come'=>'2016-01-26','date_latest'=>NULL,'date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'dsdfs','tel'=>'13333333333\'','kind'=>'3','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'30','id'=>'liqingzhao.6@winter.com','date_leave'=>'2016-02-01','which_year'=>'2016','date_come'=>'2016-02-20','date_latest'=>'2017-02-01','date_cancel'=>'2016-02-13','boss_id'=>NULL,'where_leave'=>'偶ihkj ','tel'=>'18817559557\'','kind'=>'10','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'31','id'=>'liqingzhao.6@winter.com','date_leave'=>'2016-02-13','which_year'=>'2016','date_come'=>'2016-02-28','date_latest'=>'2016-03-04','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'老家','tel'=>'18817559557\'','kind'=>'4','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'32','id'=>'caocao.6@winter.com','date_leave'=>'2016-04-15','which_year'=>'2016','date_come'=>'2016-09-23','date_latest'=>'2016-06-06','date_cancel'=>'2016-04-16','boss_id'=>NULL,'where_leave'=>'老家','tel'=>'18817559557','kind'=>'10','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'33','id'=>'caocao.6@winter.com','date_leave'=>'2016-04-28','which_year'=>'2016','date_come'=>'2016-04-29','date_latest'=>'2016-07-24','date_cancel'=>'2016-04-29','boss_id'=>NULL,'where_leave'=>'asdfasf','tel'=>'18817559557','kind'=>'9','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'34','id'=>'caocao.6@winter.com','date_leave'=>'2016-04-28','which_year'=>'2016','date_come'=>'2016-04-30','date_latest'=>'2016-07-23','date_cancel'=>'2016-05-01','boss_id'=>NULL,'where_leave'=>'sdfasdf','tel'=>'18817559557','kind'=>'9','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'35','id'=>'caocao.6@winter.com','date_leave'=>'2015-09-17','which_year'=>'2015','date_come'=>'2015-09-18','date_latest'=>'2015-12-09','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'sadfsdf','tel'=>'18817559557','kind'=>'9','paper'=>NULL,'report_month'=>'4','ps'=>'']);
        $this->insert('{{%_holiday}}',['h_id'=>'36','id'=>'guanyu.6@winter.com','date_leave'=>'2016-05-10','which_year'=>'2016','date_come'=>NULL,'date_latest'=>'2017-05-10','date_cancel'=>'2016-05-12','boss_id'=>NULL,'where_leave'=>'sdfasdf','tel'=>'18817559557\'','kind'=>'15','paper'=>NULL,'report_month'=>'5','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'37','id'=>'sunwukong13.14@winter.com','date_leave'=>'2016-05-10','which_year'=>'2016','date_come'=>'2016-05-15','date_latest'=>'2016-06-18','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'花果山','tel'=>'18817559557\'','kind'=>'9','paper'=>NULL,'report_month'=>'5','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'38','id'=>'sunwukong14.14@winter.com','date_leave'=>'2016-05-10','which_year'=>'2016','date_come'=>'2016-05-12','date_latest'=>'2016-09-06','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'花果山','tel'=>'18817559557\'','kind'=>'9','paper'=>NULL,'report_month'=>'5','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'39','id'=>'guanyu.6@winter.com','date_leave'=>'2016-05-12','which_year'=>'2016','date_come'=>'2016-05-14','date_latest'=>'2017-05-12','date_cancel'=>'2016-05-15','boss_id'=>NULL,'where_leave'=>'南充阆中','tel'=>'18817559557\'','kind'=>'16','paper'=>NULL,'report_month'=>'5','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'40','id'=>'hepengfei.6@winter.com','date_leave'=>'2016-06-02','which_year'=>'2016','date_come'=>'2016-08-06','date_latest'=>'2016-10-02','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'南充阆中','tel'=>'18817559557\'','kind'=>'9','paper'=>NULL,'report_month'=>'6','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'41','id'=>'sunwukong3.12@winter.com','date_leave'=>'2016-06-02','which_year'=>'2016','date_come'=>'2016-06-03','date_latest'=>'2016-06-03','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'花果山','tel'=>'18817559557\'','kind'=>'11','paper'=>NULL,'report_month'=>'6','ps'=>NULL]);
        $this->insert('{{%_holiday}}',['h_id'=>'42','id'=>'hepengfei.1.201201@winter.com','date_leave'=>'2016-10-18','which_year'=>'2016','date_come'=>'2016-10-20','date_latest'=>'2016-10-20','date_cancel'=>NULL,'boss_id'=>NULL,'where_leave'=>'weeeewwew','tel'=>'qweqwe','kind'=>'5','paper'=>NULL,'report_month'=>'3','ps'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_holiday}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

