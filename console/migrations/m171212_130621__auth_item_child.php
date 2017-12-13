<?php

use yii\db\Migration;

class m171212_130621__auth_item_child extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_auth_item_child}}', [
            'parent' => "varchar(64) NOT NULL",
            'child' => "varchar(64) NOT NULL",
            'PRIMARY KEY (`parent`,`child`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        
        /* 索引设置 */
        $this->createIndex('child','{{%_auth_item_child}}','child',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk__auth_item_3384_00','{{%_auth_item_child}}', 'parent', '{{%_auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        $this->addForeignKey('fk__auth_item_3385_01','{{%_auth_item_child}}', 'child', '{{%_auth_item}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/gridview/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/delete']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/upload']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/view-about-user']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/view-all-messages']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/message/write']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/out/cancel']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/out/leave']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/out/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/out/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/personinfo/out']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/personinfo/roster']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/personinfo/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/personinfo/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/post/detail']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/post/home']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/site/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/treemanager/node/out-manage']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Junior','child'=>'/treemanager/node/roster-manage']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'Leader','child'=>'Junior']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/gridview/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/holiday/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/delete']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/upload']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/view-about-user']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/view-all-messages']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/message/write']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/personinfo/holiday']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/personinfo/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/personinfo/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/post/detail']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/post/home']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/ready-war/set']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/ready-war/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/ready-war/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/site/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/treemanager/node/holiday-manage']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/weekend/set']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeMilitaryOfficer','child'=>'/weekend/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/gridview/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/holiday/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/delete']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/upload']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/view-about-user']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/view-all-messages']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/message/write']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/personinfo/holiday']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/personinfo/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/personinfo/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/post/detail']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/post/home']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/ready-war/set']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/ready-war/update']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/ready-war/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/site/*']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/treemanager/node/holiday-manage']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/weekend/set']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'OfficeSoldier','child'=>'/weekend/view']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'ConsoleCron']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'Junior']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'Leader']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'OfficeMilitaryOfficer']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'OfficeSoldier']);
        $this->insert('{{%_auth_item_child}}',['parent'=>'SuperAdmin','child'=>'Sentry']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_auth_item_child}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

