<?php

use yii\db\Migration;

class m171212_130621__auth_item extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_auth_item}}', [
            'name' => "varchar(64) NOT NULL",
            'type' => "int(11) NOT NULL",
            'description' => "text NULL",
            'rule_name' => "varchar(64) NULL",
            'data' => "text NULL",
            'created_at' => "int(11) NULL",
            'updated_at' => "int(11) NULL",
            'PRIMARY KEY (`name`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        
        /* 索引设置 */
        $this->createIndex('rule_name','{{%_auth_item}}','rule_name',0);
        $this->createIndex('idx-auth_item-type','{{%_auth_item}}','type',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk__auth_rule_3306_00','{{%_auth_item}}', 'rule_name', '{{%_auth_rule}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%_auth_item}}',['name'=>'/gridview/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367007','updated_at'=>'1455367007']);
        $this->insert('{{%_auth_item}}',['name'=>'/holiday/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367034','updated_at'=>'1455367034']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/delete','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369926','updated_at'=>'1455369926']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/upload','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369925','updated_at'=>'1455369925']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369925','updated_at'=>'1455369925']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/view-about-user','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369925','updated_at'=>'1455369925']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/view-all-messages','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369925','updated_at'=>'1455369925']);
        $this->insert('{{%_auth_item}}',['name'=>'/message/write','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369926','updated_at'=>'1455369926']);
        $this->insert('{{%_auth_item}}',['name'=>'/out/cancel','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367050','updated_at'=>'1455367050']);
        $this->insert('{{%_auth_item}}',['name'=>'/out/leave','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367050','updated_at'=>'1455367050']);
        $this->insert('{{%_auth_item}}',['name'=>'/out/update','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367050','updated_at'=>'1455367050']);
        $this->insert('{{%_auth_item}}',['name'=>'/out/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367050','updated_at'=>'1455367050']);
        $this->insert('{{%_auth_item}}',['name'=>'/personinfo/holiday','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/personinfo/out','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454543205','updated_at'=>'1454543205']);
        $this->insert('{{%_auth_item}}',['name'=>'/personinfo/roster','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/personinfo/update','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/personinfo/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/post/detail','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/post/home','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/ready-war/set','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/ready-war/update','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/ready-war/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'/site/*','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455369740','updated_at'=>'1455369740']);
        $this->insert('{{%_auth_item}}',['name'=>'/treemanager/node/holiday-manage','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455366990','updated_at'=>'1455366990']);
        $this->insert('{{%_auth_item}}',['name'=>'/treemanager/node/out-manage','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454545344','updated_at'=>'1454545344']);
        $this->insert('{{%_auth_item}}',['name'=>'/treemanager/node/roster-manage','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455366986','updated_at'=>'1455366986']);
        $this->insert('{{%_auth_item}}',['name'=>'/weekend/set','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367074','updated_at'=>'1455367074']);
        $this->insert('{{%_auth_item}}',['name'=>'/weekend/view','type'=>'2','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1455367129','updated_at'=>'1455367129']);
        $this->insert('{{%_auth_item}}',['name'=>'ConsoleCron','type'=>'1','description'=>'终端后台用户','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1459764901','updated_at'=>'1459764901']);
        $this->insert('{{%_auth_item}}',['name'=>'Junior','type'=>'1','description'=>'连级基层','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454542714','updated_at'=>'1454542714']);
        $this->insert('{{%_auth_item}}',['name'=>'Leader','type'=>'1','description'=>'非连级基层','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454542934','updated_at'=>'1454542934']);
        $this->insert('{{%_auth_item}}',['name'=>'OfficeMilitaryOfficer','type'=>'1','description'=>'干部科','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454542883','updated_at'=>'1454542883']);
        $this->insert('{{%_auth_item}}',['name'=>'OfficeSoldier','type'=>'1','description'=>'军务科','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1454542848','updated_at'=>'1454542848']);
        $this->insert('{{%_auth_item}}',['name'=>'Sentry','type'=>'1','description'=>'岗哨','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1460943402','updated_at'=>'1460943402']);
        $this->insert('{{%_auth_item}}',['name'=>'SuperAdmin','type'=>'1','description'=>'超级管理员','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1512886090','updated_at'=>'1512886090']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_auth_item}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

