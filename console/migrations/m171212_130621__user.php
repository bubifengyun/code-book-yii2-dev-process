<?php

use yii\db\Migration;

class m171212_130621__user extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_user}}', [
            'id' => "varchar(64) NOT NULL",
            'username' => "varchar(255) NOT NULL",
            'auth_key' => "varchar(32) NOT NULL",
            'access_token' => "varchar(255) NULL",
            'password_hash' => "varchar(255) NOT NULL",
            'password_reset_token' => "varchar(255) NULL",
            'created_at' => "datetime NULL",
            'updated_at' => "datetime NULL",
            'last_login_at' => "datetime NULL",
            'this_login_at' => "datetime NULL",
            'last_login_ip4' => "varchar(15) NULL",
            'this_login_ip4' => "varchar(15) NULL",
            'email' => "varchar(255) NULL",
            'role' => "tinyint(2) NOT NULL",
            'job' => "varchar(32) NULL",
            'see_unit' => "int(11) NULL",
            'own_unit' => "int(11) NULL",
            'profile' => "varchar(18) NULL",
            'status' => "tinyint(2) NOT NULL",
            'is_backend' => "tinyint(4) NOT NULL DEFAULT '0'",
            'avatar' => "varchar(24) NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表'");
        
        /* 索引设置 */
        $this->createIndex('access_token','{{%_user}}','access_token',1);
        $this->createIndex('email','{{%_user}}','email',1);
        $this->createIndex('password_reset_token','{{%_user}}','password_reset_token',1);
        
        
        /* 表数据 */
        $this->insert('{{%_user}}',['id'=>'00000000@00.00','username'=>'终端后台','auth_key'=>'RVxh_M3Ub2sb9YZnZ1TXYKs_7QZOV0Wh','access_token'=>NULL,'password_hash'=>'$2y$13$GoUU6IowoKjjejsllTWTeOlbKchInHep/5dLY8JnTTz1ZO5lDmzOi','password_reset_token'=>NULL,'created_at'=>'2016-06-24 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'00000000@00.00','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>NULL,'profile'=>NULL,'status'=>'0','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'10@winter.com','username'=>'黄山不老松','auth_key'=>'x7v6PFG1KR3m4O7mLnUOI-I-V7Tgtr0d','access_token'=>NULL,'password_hash'=>'$2y$13$z7A1BDfcC4dYD93NRetwU.zCn/zqs0nPY3IxHpapyl54PF.UiTvUm','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2017-11-21 21:47:44','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'undefined','email'=>'10@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'10','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>'user4-128x128.jpg']);
        $this->insert('{{%_user}}',['id'=>'11@winter.com','username'=>'清洁部','auth_key'=>'ZJPCPR_aH7Ktl8L4d6LU4SMJq2liak8N','access_token'=>NULL,'password_hash'=>'$2y$13$ru5CKgi9BEwcvKPzTYVMUePuW.nmmB/EwSa.p.G6m4Ke0BBUGuUPy','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'11@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'11','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'12@winter.com','username'=>'拖把','auth_key'=>'9QDVd4MrjqJUQDIza2O7kNEsrnb06fze','access_token'=>NULL,'password_hash'=>'$2y$13$jVZOpmewOxy7mjmjlnk4GOBQJeW5FNUl/Ljbe1okXHmaDk9a3N3o.','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'12@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'12','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'13@winter.com','username'=>'抹布','auth_key'=>'AMQ5qRurj0sX-UI8o_dXCGE1YDxL-CzL','access_token'=>NULL,'password_hash'=>'$2y$13$j8YlJdffCBK.VbCLldna/efU/G1R6WBNLQSW0sfUcaD0RTGWjbCZ.','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'13@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'13','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'14@winter.com','username'=>'毛巾','auth_key'=>'FHqQWhyKG7FpZQSoGdVpHuaToIH8Yh6Z','access_token'=>NULL,'password_hash'=>'$2y$13$0XIH7a7EVib4K5Ddg2rel.HgYlv.i4QeDVyJrp1nARwtrMbTT1vhe','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'14@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'14','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'15@winter.com','username'=>'舞蹈部','auth_key'=>'fytWI18iAkV3j9sAvYQVStQ-NYwKL60n','access_token'=>NULL,'password_hash'=>'$2y$13$PB1CkJN4zR/mhk6/c2BNlO3bF4x/BHTJ0diQX0BeXHFwilOPqqcMS','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'15@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'15','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'16@winter.com','username'=>'跑步','auth_key'=>'uIlLu5SOqq8rVsY_g18WzAY0zcNxkBY_','access_token'=>NULL,'password_hash'=>'$2y$13$PYXjdSGtkuCzeDtttb7VwegKYs3/Rve4EH2rO6xjfqdVc6b7seAUi','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'16@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'16','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'17@winter.com','username'=>'小道','auth_key'=>'Zzl6f7jcvnTHYI6LhCoOscwruXWfkBO5','access_token'=>NULL,'password_hash'=>'$2y$13$eZevAqBY7FsnajBfxCWH1eebWzz1Bv31f/xakJXNoj3VWTzt2aU/m','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'17@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'17','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'18@winter.com','username'=>'跬步','auth_key'=>'xATre2IbeO0ACQ9iQqG5r9OEBHyyNQYq','access_token'=>NULL,'password_hash'=>'$2y$13$bF4sa1OToyX.hD7ppZlJN.r3O633y/CauWsGI/dqllM2VIiq5QCTG','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'18@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'18','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'1@winter.com','username'=>'舞林大会','auth_key'=>'8rvgYOJ0GlKRPpJUoFRkU4FrQcbrdFmP','access_token'=>NULL,'password_hash'=>'$2y$13$Znqq0jZylAO79bHzcAQDju4kOn/hINx8v0npOCT/VTqqI.3VlOIcS','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2017-12-12 20:03:03','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'192.168.0.181','email'=>'1@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>'1','profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>'photo3.jpg']);
        $this->insert('{{%_user}}',['id'=>'2@winter.com','username'=>'餐饮部','auth_key'=>'8eMjvnPm4u0B-GOd5uO-1lrBwtO_-pUc','access_token'=>NULL,'password_hash'=>'$2y$13$W/0ig4N1ex5OT.zb.Cni5uB200DqmcYO.YNcycvPBTs0s6LAeIdI.','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2016-10-17 17:17:46','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'192.168.1.108','this_login_ip4'=>'undefined','email'=>'2@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'2','own_unit'=>'2','profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>'user_9.jpg']);
        $this->insert('{{%_user}}',['id'=>'3@winter.com','username'=>'川菜','auth_key'=>'QLUVk3Og7mI1fL6uKugmcY5aa6xYIDXU','access_token'=>NULL,'password_hash'=>'$2y$13$pYnbuOQM2s2HjjnlW4DbLuZaNvTUc.bRZ.gGybegJ27ba0vw.5CVm','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'3@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'3','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'4@winter.com','username'=>'粤菜','auth_key'=>'cB4OF4VDFAvgKEPG6bVULUYeOwX-TDe0','access_token'=>NULL,'password_hash'=>'$2y$13$UDrKnfN2w5HMJdB/SMZGEujdl0Pl1Wc8XQIRhJYgxM/LdkcwMyNAq','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'4@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'4','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'5@winter.com','username'=>'湘菜','auth_key'=>'C7dCF3Z-vmOWW5koyGDWmAw_RxcuXJyU','access_token'=>NULL,'password_hash'=>'$2y$13$dMurOyEEvK1/QoAEKRgYbOQEZopj4uE9Psge0uO0R63z7eZYD4xcy','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'5@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'5','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'6@winter.com','username'=>'唐诗','auth_key'=>'VpOWyod4kY004qbwvhnVUF01CV6Cb06B','access_token'=>NULL,'password_hash'=>'$2y$13$5HAGL4DyHrd6Vn98EW4/HeCw3wKDnNGPhinvTOcqw5ka2vRiFgR0i','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'6@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'6','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'7@winter.com','username'=>'黄鹤楼','auth_key'=>'pykQGDG1_sqmhck6eKnmf8_W6j9cL8N7','access_token'=>NULL,'password_hash'=>'$2y$13$dk4dya2u.6J/ew.zhelKZeTN229ezlWHnqGLvuiw.jOU4kp21xegy','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2017-11-24 17:20:05','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'192.168.0.163','this_login_ip4'=>'192.168.0.163','email'=>'7@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'7','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'8@winter.com','username'=>'乐山大佛','auth_key'=>'-tpX76bj7S82q_M6d7lcsyYx3C_KJXIw','access_token'=>NULL,'password_hash'=>'$2y$13$xZKOGcR5c94afPgelYa6q.pS8qciMFL.uGa5.Bjs5SyCCLCdH7SIq','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2016-10-17 17:18:19','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'undefined','email'=>'8@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'8','own_unit'=>'8','profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>'user_59.jpg']);
        $this->insert('{{%_user}}',['id'=>'9@winter.com','username'=>'南充丝绸','auth_key'=>'Xtw6ywqir5qXVLGeRlVNdd3HfXWsuaqv','access_token'=>NULL,'password_hash'=>'$2y$13$4SpArimt09I7H4PciKKxv.MdlW1u0cSCqlaMTynXwtlO3yzZrLnaq','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'9@winter.com','role'=>'1','job'=>NULL,'see_unit'=>'9','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'admin@love.com','username'=>'后台管理员','auth_key'=>'LVSA7Dtes4i_sJqu9p8BoU3e9BMPAlJY','access_token'=>NULL,'password_hash'=>'$2y$13$s3Pq9ySyDFqERmqqrVG2Lewm4.ANzMGvdxbEzlixFB3UAb3V71UPW','password_reset_token'=>NULL,'created_at'=>'2016-10-18 08:52:27','updated_at'=>'2017-12-10 14:06:34','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'undefined','email'=>'admin@love.com','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>'1','profile'=>NULL,'status'=>'10','is_backend'=>'1','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'ganbuke@v5.com','username'=>'干部科','auth_key'=>'Upco-kDKAIyqAq3fWbj1OfbVCPojojb0','access_token'=>NULL,'password_hash'=>'$2y$13$GrVvVbR2d68GzWpBxY.1XOJ9RgRfE8fKBlPhPFofpHE2Kp3yqhkIK','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'2017-11-22 16:47:25','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'undefined','email'=>'ganbuke@v5.com','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'junwuke@v5.com','username'=>'傻瓜','auth_key'=>'ZX6diIr6qhOeBUAjELvrwmvoHYkQdNq4','access_token'=>NULL,'password_hash'=>'$2y$13$HR1Lf4711rHA1B5dycK/peIDydqp8rbGXddmd2KXmIOOo1zwqjq3S','password_reset_token'=>NULL,'created_at'=>'2016-06-20 00:00:00','updated_at'=>'2017-11-30 14:39:48','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'undefined','this_login_ip4'=>'undefined','email'=>'junwuke@v5.com','role'=>'1','job'=>'不能说','see_unit'=>'1','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>'photo1.png']);
        $this->insert('{{%_user}}',['id'=>'sentry01@seeyou.com','username'=>'南天门','auth_key'=>'Qf1ityu0_GFRz2hbTc2KNdU1MUb-c95A','access_token'=>'','password_hash'=>'$2y$13$SgxnB9/kYWJ9xgxNKnxZu.UWicvLiqxfzdrgtLMYB6wKncf/rJYnK','password_reset_token'=>'','created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'::1','this_login_ip4'=>'::1','email'=>'sentry01@seeyou.com','role'=>'1','job'=>'岗哨呀','see_unit'=>'1','own_unit'=>NULL,'profile'=>'','status'=>'10','is_backend'=>'0','avatar'=>'']);
        $this->insert('{{%_user}}',['id'=>'sentry02@seeyou.com','username'=>'岗哨02','auth_key'=>'UetbtlJ-rSXIHCPbA17kQ3Y3L-7ao9o3','access_token'=>NULL,'password_hash'=>'$2y$13$uTkyUgbDzEG18FIfymkGKu9eYUM23M3FS9pzpp9h9wl54BJw8ovDe','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>NULL,'this_login_ip4'=>NULL,'email'=>'sentry02@seeyou.com','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        $this->insert('{{%_user}}',['id'=>'sentry03@seeyou.com','username'=>'岗哨03','auth_key'=>'JXy1Su5RMfsgerZZbmE0Qh-hQRZDLr-S','access_token'=>NULL,'password_hash'=>'$2y$13$x.e1A0cmvpQk5kGgMzLq8eu28FzSWb/1VRQiiPqvGBftwIIlO48pO','password_reset_token'=>NULL,'created_at'=>'0000-00-00 00:00:00','updated_at'=>'0000-00-00 00:00:00','last_login_at'=>NULL,'this_login_at'=>NULL,'last_login_ip4'=>'127.0.0.1','this_login_ip4'=>'127.0.0.1','email'=>'sentry03@seeyou.com','role'=>'1','job'=>NULL,'see_unit'=>'1','own_unit'=>NULL,'profile'=>NULL,'status'=>'10','is_backend'=>'0','avatar'=>NULL]);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_user}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

