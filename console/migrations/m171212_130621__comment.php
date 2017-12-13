<?php

use yii\db\Migration;

class m171212_130621__comment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_comment}}', [
            'id' => "int(11) NOT NULL AUTO_INCREMENT",
            'content' => "text NOT NULL",
            'status' => "int(11) NOT NULL",
            'create_time' => "datetime NULL",
            'author' => "varchar(128) NOT NULL",
            'email' => "varchar(128) NOT NULL",
            'url' => "varchar(128) NULL",
            'post_id' => "int(11) NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('FK_comment_post','{{%_comment}}','post_id',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk__post_3766_00','{{%_comment}}', 'post_id', '{{%_post}}', 'id', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%_comment}}',['id'=>'113','content'=>'可否评价啊。','status'=>'2','create_time'=>'2017-12-12 20:08:35','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'114','content'=>'可否评价啊。','status'=>'2','create_time'=>'2017-12-12 20:08:41','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'115','content'=>'可否评价啊。','status'=>'2','create_time'=>'2017-12-12 20:08:47','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'116','content'=>'可否评价啊。','status'=>'2','create_time'=>'2017-12-12 20:10:09','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'117','content'=>'可否评价啊。','status'=>'2','create_time'=>'2017-12-12 20:10:15','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'118','content'=>'水电费公司的风格','status'=>'2','create_time'=>'2017-12-12 20:10:23','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'119','content'=>'而问题热问题瓦尔特','status'=>'2','create_time'=>'2017-12-12 20:10:32','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'120','content'=>'而问题热问题瓦尔特','status'=>'2','create_time'=>'2017-12-12 20:11:16','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'121','content'=>'而问题热问题瓦尔特','status'=>'2','create_time'=>'2017-12-12 20:15:00','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'122','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:15:13','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'123','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:17:43','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'124','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:17:49','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'125','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:17:53','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'126','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:18:13','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'127','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:18:18','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'128','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:18:20','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'129','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:18:37','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'130','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:03','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'131','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:07','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'132','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:10','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'133','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:21','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'134','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:24','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'135','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:26','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'136','content'=>'sdfgsdfgsdfg ','status'=>'1','create_time'=>'2017-12-12 20:19:28','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'137','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:20:53','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'138','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:20:56','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'139','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:20:59','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'140','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:21:02','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'141','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:23:18','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'142','content'=>'sdfgsdfgsdfg ','status'=>'2','create_time'=>'2017-12-12 20:23:23','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'123']);
        $this->insert('{{%_comment}}',['id'=>'143','content'=>'sfdgsdfgsdfg','status'=>'2','create_time'=>'2017-12-12 20:59:33','author'=>'1@winter.com','email'=>'1@winter.com','url'=>NULL,'post_id'=>'125']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_comment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

