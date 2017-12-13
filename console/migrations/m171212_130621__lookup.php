<?php

use yii\db\Migration;

class m171212_130621__lookup extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_lookup}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(128) NOT NULL",
            'code' => "int(11) NOT NULL",
            'type' => "varchar(128) NOT NULL",
            'position' => "int(11) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_lookup}}',['id'=>'1','name'=>'草稿','code'=>'1','type'=>'PostStatus','position'=>'1']);
        $this->insert('{{%_lookup}}',['id'=>'2','name'=>'已发布','code'=>'2','type'=>'PostStatus','position'=>'2']);
        $this->insert('{{%_lookup}}',['id'=>'3','name'=>'已归档','code'=>'3','type'=>'PostStatus','position'=>'3']);
        $this->insert('{{%_lookup}}',['id'=>'4','name'=>'待审核','code'=>'1','type'=>'CommentStatus','position'=>'1']);
        $this->insert('{{%_lookup}}',['id'=>'5','name'=>'已审核','code'=>'2','type'=>'CommentStatus','position'=>'2']);
        $this->insert('{{%_lookup}}',['id'=>'6','name'=>'最基层主官','code'=>'1','type'=>'Role','position'=>'1']);
        $this->insert('{{%_lookup}}',['id'=>'7','name'=>'非最基层主官','code'=>'2','type'=>'Role','position'=>'2']);
        $this->insert('{{%_lookup}}',['id'=>'8','name'=>'特务科','code'=>'3','type'=>'Role','position'=>'3']);
        $this->insert('{{%_lookup}}',['id'=>'9','name'=>'锦衣卫','code'=>'4','type'=>'Role','position'=>'4']);
        $this->insert('{{%_lookup}}',['id'=>'10','name'=>'东厂','code'=>'5','type'=>'Role','position'=>'5']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_lookup}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

