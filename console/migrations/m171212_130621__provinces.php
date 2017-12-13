<?php

use yii\db\Migration;

class m171212_130621__provinces extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_provinces}}', [
            'id' => "int(4) unsigned NOT NULL AUTO_INCREMENT",
            'name' => "varchar(100) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='省'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_provinces}}',['id'=>'1','name'=>'北京市']);
        $this->insert('{{%_provinces}}',['id'=>'2','name'=>'天津市']);
        $this->insert('{{%_provinces}}',['id'=>'3','name'=>'河北省']);
        $this->insert('{{%_provinces}}',['id'=>'4','name'=>'山西省']);
        $this->insert('{{%_provinces}}',['id'=>'5','name'=>'内蒙古自治区']);
        $this->insert('{{%_provinces}}',['id'=>'6','name'=>'辽宁省']);
        $this->insert('{{%_provinces}}',['id'=>'7','name'=>'吉林省']);
        $this->insert('{{%_provinces}}',['id'=>'8','name'=>'黑龙江省']);
        $this->insert('{{%_provinces}}',['id'=>'9','name'=>'上海市']);
        $this->insert('{{%_provinces}}',['id'=>'10','name'=>'江苏省']);
        $this->insert('{{%_provinces}}',['id'=>'11','name'=>'浙江省']);
        $this->insert('{{%_provinces}}',['id'=>'12','name'=>'安徽省']);
        $this->insert('{{%_provinces}}',['id'=>'13','name'=>'福建省']);
        $this->insert('{{%_provinces}}',['id'=>'14','name'=>'江西省']);
        $this->insert('{{%_provinces}}',['id'=>'15','name'=>'山东省']);
        $this->insert('{{%_provinces}}',['id'=>'16','name'=>'河南省']);
        $this->insert('{{%_provinces}}',['id'=>'17','name'=>'湖北省']);
        $this->insert('{{%_provinces}}',['id'=>'18','name'=>'湖南省']);
        $this->insert('{{%_provinces}}',['id'=>'19','name'=>'广东省']);
        $this->insert('{{%_provinces}}',['id'=>'20','name'=>'广西壮族自治区']);
        $this->insert('{{%_provinces}}',['id'=>'21','name'=>'海南省']);
        $this->insert('{{%_provinces}}',['id'=>'22','name'=>'重庆市']);
        $this->insert('{{%_provinces}}',['id'=>'23','name'=>'四川省']);
        $this->insert('{{%_provinces}}',['id'=>'24','name'=>'贵州省']);
        $this->insert('{{%_provinces}}',['id'=>'25','name'=>'云南省']);
        $this->insert('{{%_provinces}}',['id'=>'26','name'=>'西藏自治区']);
        $this->insert('{{%_provinces}}',['id'=>'27','name'=>'陕西省']);
        $this->insert('{{%_provinces}}',['id'=>'28','name'=>'甘肃省']);
        $this->insert('{{%_provinces}}',['id'=>'29','name'=>'青海省']);
        $this->insert('{{%_provinces}}',['id'=>'30','name'=>'宁夏回族自治区']);
        $this->insert('{{%_provinces}}',['id'=>'31','name'=>'新疆维吾尔自治区']);
        $this->insert('{{%_provinces}}',['id'=>'32','name'=>'香港特别行政区']);
        $this->insert('{{%_provinces}}',['id'=>'33','name'=>'澳门特别行政区']);
        $this->insert('{{%_provinces}}',['id'=>'34','name'=>'台湾省']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_provinces}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

