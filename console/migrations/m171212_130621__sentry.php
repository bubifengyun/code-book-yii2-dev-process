<?php

use yii\db\Migration;

class m171212_130621__sentry extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_sentry}}', [
            'id' => "int(2) NOT NULL",
            'user_id' => "varchar(64) NOT NULL",
            'name' => "varchar(32) NOT NULL",
            'host' => "varchar(32) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='岗哨表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_sentry}}',['id'=>'0','user_id'=>'sentry01@seeyou.com','name'=>'南天门','host'=>'哪吒']);
        $this->insert('{{%_sentry}}',['id'=>'1','user_id'=>'sentry02@seeyou.com','name'=>'西天门','host'=>'接引道人']);
        $this->insert('{{%_sentry}}',['id'=>'2','user_id'=>'sentry03@seeyou.com','name'=>'岗哨03','host'=>'二郎神']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_sentry}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

