<?php

use yii\db\Migration;

class m171212_130621__auth_assignment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_auth_assignment}}', [
            'item_name' => "varchar(64) NOT NULL",
            'user_id' => "varchar(64) NOT NULL",
            'created_at' => "int(11) NULL",
            'PRIMARY KEY (`item_name`,`user_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        
        /* 索引设置 */
        
        /* 外键约束设置 */
        $this->addForeignKey('fk__auth_item_3205_00','{{%_auth_assignment}}', 'item_name', '{{%_auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%_auth_assignment}}',['item_name'=>'ConsoleCron','user_id'=>'admin@love.com','created_at'=>'1476751948']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'1@winter.com','created_at'=>'1464786155']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'10@winter.com','created_at'=>'1464786166']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'11@winter.com','created_at'=>'1464786167']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'12@winter.com','created_at'=>'1464786168']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'13@winter.com','created_at'=>'1464786169']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'14@winter.com','created_at'=>'1464786170']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'15@winter.com','created_at'=>'1464786172']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'16@winter.com','created_at'=>'1464786173']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'17@winter.com','created_at'=>'1464786174']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'18@winter.com','created_at'=>'1464786175']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'2@winter.com','created_at'=>'1464786156']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'3@winter.com','created_at'=>'1464786157']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'4@winter.com','created_at'=>'1464786159']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'5@winter.com','created_at'=>'1464786160']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'6@winter.com','created_at'=>'1464786161']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'7@winter.com','created_at'=>'1464786162']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'8@winter.com','created_at'=>'1464786163']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'Junior','user_id'=>'9@winter.com','created_at'=>'1464786165']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'OfficeMilitaryOfficer','user_id'=>'ganbuke@v5.com','created_at'=>'1466237128']);
        $this->insert('{{%_auth_assignment}}',['item_name'=>'OfficeSoldier','user_id'=>'junwuke@v5.com','created_at'=>'1464788233']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_auth_assignment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

