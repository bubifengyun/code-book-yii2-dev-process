<?php

use yii\db\Migration;

class m171212_130621__mil_rank extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_mil_rank}}', [
            'id' => "int(2) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(16) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='军衔表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_mil_rank}}',['id'=>'1','name'=>'兵1']);
        $this->insert('{{%_mil_rank}}',['id'=>'2','name'=>'卒2']);
        $this->insert('{{%_mil_rank}}',['id'=>'3','name'=>'炮3']);
        $this->insert('{{%_mil_rank}}',['id'=>'4','name'=>'砲4']);
        $this->insert('{{%_mil_rank}}',['id'=>'5','name'=>'馬5']);
        $this->insert('{{%_mil_rank}}',['id'=>'6','name'=>'马6']);
        $this->insert('{{%_mil_rank}}',['id'=>'7','name'=>'车7']);
        $this->insert('{{%_mil_rank}}',['id'=>'8','name'=>'車8']);
        $this->insert('{{%_mil_rank}}',['id'=>'9','name'=>'象9']);
        $this->insert('{{%_mil_rank}}',['id'=>'10','name'=>'相10']);
        $this->insert('{{%_mil_rank}}',['id'=>'11','name'=>'士11']);
        $this->insert('{{%_mil_rank}}',['id'=>'12','name'=>'仕12']);
        $this->insert('{{%_mil_rank}}',['id'=>'13','name'=>'将13']);
        $this->insert('{{%_mil_rank}}',['id'=>'14','name'=>'帅14']);
        $this->insert('{{%_mil_rank}}',['id'=>'15','name'=>'李靖15']);
        $this->insert('{{%_mil_rank}}',['id'=>'16','name'=>'曹操']);
        $this->insert('{{%_mil_rank}}',['id'=>'17','name'=>'世民']);
        $this->insert('{{%_mil_rank}}',['id'=>'18','name'=>'泽东']);
        $this->insert('{{%_mil_rank}}',['id'=>'19','name'=>'孙武']);
        $this->insert('{{%_mil_rank}}',['id'=>'20','name'=>'民']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_mil_rank}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

