<?php

use yii\db\Migration;

class m171212_130621__statistics_holiday extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_statistics_holiday}}', [
            'id' => "varchar(32) NOT NULL",
            'type' => "varchar(32) NULL",
            'day_total' => "int(2) NOT NULL DEFAULT '0'",
            'day_standard' => "int(2) NOT NULL DEFAULT '0'",
            'day_left' => "int(2) NOT NULL DEFAULT '0'",
            'day_left_lastyear' => "int(2) NOT NULL DEFAULT '0'",
            'day_lend_nextyear' => "int(2) NOT NULL DEFAULT '0'",
            'day_lend_nextyear_ps' => "varchar(32) NULL",
            'day_tohere' => "int(2) NOT NULL DEFAULT '0'",
            'boss_id' => "varchar(32) NULL",
            'current_h_id' => "int(11) NULL",
            'tel' => "varchar(32) NULL",
            'day_add' => "int(2) NOT NULL DEFAULT '0'",
            'day_add_is_nextyear' => "tinyint(1) NOT NULL DEFAULT '0'",
            'day_add_ps' => "varchar(256) NULL",
            'day_path' => "int(2) NOT NULL DEFAULT '0'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='假期统计表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_statistics_holiday}}',['id'=>'caocao.6@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'35','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'guanyu.6@winter.com','type'=>NULL,'day_total'=>'301','day_standard'=>'0','day_left'=>'301','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'39','tel'=>NULL,'day_add'=>'202','day_add_is_nextyear'=>'0','day_add_ps'=>'2015(怎么可能)(12)23(12)(34)(12)(123)(12)(12)(12)(12)(12)(12)(12)(12)(12)','day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'heheaaaa.6@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei.1.201201@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'42','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei.13.201610@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei.3.199001@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei.6@winter.com','type'=>'9','day_total'=>'123','day_standard'=>'0','day_left'=>'123','day_left_lastyear'=>'0','day_lend_nextyear'=>'123','day_lend_nextyear_ps'=>'有急事，借假(123)','day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'40','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei1.3.199001@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei2.3.199001@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'hepengfei3.3.199001@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'liqingzhao.6@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'31','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'12']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'litianci.3.199001@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'litianci.4@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'litianci.6@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'29','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'12']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong1.6@winter.com','type'=>'','day_total'=>'30','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong10.13@winter.com','type'=>'','day_total'=>'20','day_standard'=>'0','day_left'=>'20','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong11.14@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong12.14@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong13.14@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'40','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'37','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong14.14@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'120','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'38','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong15.14@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong16.15@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong17.15@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong18.15@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong19.15@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong2.12@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong20.15@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong21.15@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong22.15@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong23.15@winter.com','type'=>'10:16:17','day_total'=>'234','day_standard'=>'0','day_left'=>'12','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'12','day_add_is_nextyear'=>'0','day_add_ps'=>'不说啦(12)','day_path'=>'89']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong24.5@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong25.5@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong26.5@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong27.4@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong28.4@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong29.4@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong3.12@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>'41','tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong30.4@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong31.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong32.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong33.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong34.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong35.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong36.8@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong37.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong38.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong39.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong4.12@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong40.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong41.9@winter.com','type'=>'17:9:10:11:12:16:17','day_total'=>'46','day_standard'=>'0','day_left'=>'46','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'46','day_add_is_nextyear'=>'0','day_add_ps'=>'不说啦(12)可以说啦(34)','day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong42.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong43.9@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong44.16@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong45.16@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong5.12@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong6.13@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong7.13@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong8.13@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'sunwukong9.13@winter.com','type'=>'','day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        $this->insert('{{%_statistics_holiday}}',['id'=>'zhangfei.6@winter.com','type'=>NULL,'day_total'=>'0','day_standard'=>'0','day_left'=>'0','day_left_lastyear'=>'0','day_lend_nextyear'=>'0','day_lend_nextyear_ps'=>NULL,'day_tohere'=>'0','boss_id'=>NULL,'current_h_id'=>NULL,'tel'=>NULL,'day_add'=>'0','day_add_is_nextyear'=>'0','day_add_ps'=>NULL,'day_path'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_statistics_holiday}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}
