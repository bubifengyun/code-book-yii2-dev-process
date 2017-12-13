<?php

use yii\db\Migration;

class m171212_130621__cronjob extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_cronjob}}', [
            'id' => "varchar(32) NOT NULL",
            'line' => "varchar(256) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%_cronjob}}',['id'=>'379117732002e3c3e1e7481470533c7f','line'=>'0 2 * * * /opt/lampp/htdocs/www/wuzhishan/backupmysql.sh']);
        $this->insert('{{%_cronjob}}',['id'=>'3a205c08a1a11b78ddce55855916be4f','line'=>'30 1 1 1 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/year-delete-and-set-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'7786aacb89605e76373f7e41d8645a8c','line'=>'20 0 * * 0-4 /opt/lampp/htdocs/www/wuzhishan/yii crontab/day-unreturn-notify-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'87005eb19e2b386bda296747bfa7ed1d','line'=>'0 3 1 1 * /opt/lampp/htdocs/www/wuzhishan/rmoldmysql.sh']);
        $this->insert('{{%_cronjob}}',['id'=>'cfb337b974b9db9114e568a43418e1a3','line'=>'0 1 1 9-12 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/year-notify-add-law-holiday-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'ready-war-begin','line'=>'36 16 01 06 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/start-ready-war-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'ready-war-end','line'=>'59 16 01 06 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/stop-ready-war-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'weekend-begin','line'=>'17 18 08 06 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/start-weekend-cron']);
        $this->insert('{{%_cronjob}}',['id'=>'weekend-end','line'=>'20 18 08 06 * /opt/lampp/htdocs/www/wuzhishan/yii crontab/stop-weekend-cron']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_cronjob}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

