<?php

use yii\db\Migration;

class m171212_130621__unit extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_unit}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'old_id' => "int(11) NULL",
            'root' => "int(11) NULL",
            'lft' => "int(11) NOT NULL",
            'rgt' => "int(11) NOT NULL",
            'lvl' => "smallint(5) NOT NULL",
            'name' => "varchar(60) NOT NULL",
            'short_name' => "varchar(15) NULL",
            'icon' => "varchar(255) NULL",
            'icon_type' => "tinyint(1) NOT NULL DEFAULT '1'",
            'active' => "tinyint(1) NOT NULL DEFAULT '1'",
            'selected' => "tinyint(1) NOT NULL DEFAULT '0'",
            'disabled' => "tinyint(1) NOT NULL DEFAULT '0'",
            'readonly' => "tinyint(1) NOT NULL DEFAULT '0'",
            'visible' => "tinyint(1) NOT NULL DEFAULT '1'",
            'collapsed' => "tinyint(1) NOT NULL DEFAULT '0'",
            'movable_u' => "tinyint(1) NOT NULL DEFAULT '1'",
            'movable_d' => "tinyint(1) NOT NULL DEFAULT '1'",
            'movable_l' => "tinyint(1) NOT NULL DEFAULT '1'",
            'movable_r' => "tinyint(1) NOT NULL DEFAULT '1'",
            'removable' => "tinyint(1) NOT NULL DEFAULT '1'",
            'removable_all' => "tinyint(1) NOT NULL DEFAULT '0'",
            'is_limited' => "tinyint(1) NOT NULL DEFAULT '0'",
            'type' => "tinyint(1) NOT NULL DEFAULT '0'",
            'base_level' => "tinyint(1) NOT NULL DEFAULT '0'",
            'count_total' => "int(11) NOT NULL DEFAULT '0'",
            'count_officer' => "int(11) NOT NULL DEFAULT '0'",
            'count_soldier' => "int(11) NOT NULL DEFAULT '0'",
            'count_senior_soldier' => "int(11) NOT NULL DEFAULT '0'",
            'duty_officer' => "varchar(32) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='部别表'");
        
        /* 索引设置 */
        $this->createIndex('tbl_tree_NK1','{{%_unit}}','root',0);
        $this->createIndex('tbl_tree_NK2','{{%_unit}}','lft',0);
        $this->createIndex('tbl_tree_NK3','{{%_unit}}','rgt',0);
        $this->createIndex('tbl_tree_NK4','{{%_unit}}','lvl',0);
        $this->createIndex('tbl_tree_NK5','{{%_unit}}','active',0);
        
        
        /* 表数据 */
        $this->insert('{{%_unit}}',['id'=>'1','old_id'=>NULL,'root'=>'1','lft'=>'1','rgt'=>'40','lvl'=>'0','name'=>'武林大会','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'2','count_total'=>'54','count_officer'=>'38','count_soldier'=>'16','count_senior_soldier'=>'2','duty_officer'=>'水果']);
        $this->insert('{{%_unit}}',['id'=>'2','old_id'=>NULL,'root'=>'1','lft'=>'2','rgt'=>'19','lvl'=>'1','name'=>'餐饮部','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'1','count_total'=>'28','count_officer'=>'28','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'3','old_id'=>NULL,'root'=>'1','lft'=>'3','rgt'=>'4','lvl'=>'2','name'=>'川菜','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'5','count_officer'=>'5','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'4','old_id'=>NULL,'root'=>'1','lft'=>'5','rgt'=>'6','lvl'=>'2','name'=>'粤菜','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'4','count_officer'=>'4','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'5','old_id'=>NULL,'root'=>'1','lft'=>'7','rgt'=>'8','lvl'=>'2','name'=>'湘菜','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'3','count_officer'=>'3','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'6','old_id'=>NULL,'root'=>'1','lft'=>'9','rgt'=>'18','lvl'=>'2','name'=>'唐诗','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'1','count_total'=>'16','count_officer'=>'16','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'7','old_id'=>NULL,'root'=>'1','lft'=>'10','rgt'=>'11','lvl'=>'3','name'=>'黄鹤楼','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'3','count_officer'=>'3','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'8','old_id'=>NULL,'root'=>'1','lft'=>'12','rgt'=>'13','lvl'=>'3','name'=>'乐山大佛','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'1','count_officer'=>'1','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'9','old_id'=>NULL,'root'=>'1','lft'=>'14','rgt'=>'15','lvl'=>'3','name'=>'南充丝绸','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'7','count_officer'=>'7','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'10','old_id'=>NULL,'root'=>'1','lft'=>'16','rgt'=>'17','lvl'=>'3','name'=>'黄山不老松','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'3','count_officer'=>'3','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'11','old_id'=>NULL,'root'=>'1','lft'=>'20','rgt'=>'27','lvl'=>'1','name'=>'清洁部','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'1','count_total'=>'15','count_officer'=>'2','count_soldier'=>'13','count_senior_soldier'=>'2','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'12','old_id'=>NULL,'root'=>'1','lft'=>'21','rgt'=>'22','lvl'=>'2','name'=>'拖把','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'4','count_officer'=>'0','count_soldier'=>'4','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'13','old_id'=>NULL,'root'=>'1','lft'=>'23','rgt'=>'24','lvl'=>'2','name'=>'抹布','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'6','count_officer'=>'2','count_soldier'=>'4','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'14','old_id'=>NULL,'root'=>'1','lft'=>'25','rgt'=>'26','lvl'=>'2','name'=>'毛巾','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'5','count_officer'=>'0','count_soldier'=>'5','count_senior_soldier'=>'2','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'15','old_id'=>NULL,'root'=>'1','lft'=>'28','rgt'=>'37','lvl'=>'1','name'=>'舞蹈部','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'1','count_total'=>'10','count_officer'=>'7','count_soldier'=>'3','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'16','old_id'=>NULL,'root'=>'1','lft'=>'29','rgt'=>'30','lvl'=>'2','name'=>'跑步','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'2','count_officer'=>'2','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'17','old_id'=>NULL,'root'=>'1','lft'=>'31','rgt'=>'32','lvl'=>'2','name'=>'小道','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'0','count_officer'=>'0','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'18','old_id'=>NULL,'root'=>'1','lft'=>'33','rgt'=>'34','lvl'=>'2','name'=>'跬步','short_name'=>NULL,'icon'=>'','icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'0','count_officer'=>'0','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'']);
        $this->insert('{{%_unit}}',['id'=>'19','old_id'=>NULL,'root'=>'1','lft'=>'35','rgt'=>'36','lvl'=>'2','name'=>'跳跃','short_name'=>NULL,'icon'=>NULL,'icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'1','type'=>'0','base_level'=>'0','count_total'=>'0','count_officer'=>'0','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>'不知道哦']);
        $this->insert('{{%_unit}}',['id'=>'20','old_id'=>NULL,'root'=>'1','lft'=>'38','rgt'=>'39','lvl'=>'1','name'=>'12','short_name'=>NULL,'icon'=>NULL,'icon_type'=>'1','active'=>'1','selected'=>'0','disabled'=>'0','readonly'=>'0','visible'=>'1','collapsed'=>'0','movable_u'=>'1','movable_d'=>'1','movable_l'=>'1','movable_r'=>'1','removable'=>'1','removable_all'=>'0','is_limited'=>'0','type'=>'0','base_level'=>'0','count_total'=>'0','count_officer'=>'0','count_soldier'=>'0','count_senior_soldier'=>'0','duty_officer'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_unit}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

