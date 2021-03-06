<?php

use yii\db\Migration;

class m171212_130621__cities extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%_cities}}', [
            'id' => "int(4) unsigned NOT NULL AUTO_INCREMENT",
            'name' => "varchar(100) NOT NULL",
            'pid' => "int(4) unsigned NOT NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='市'");
        
        /* 索引设置 */
        $this->createIndex('id','{{%_cities}}','id, pid',1);
        
        
        /* 表数据 */
        $this->insert('{{%_cities}}',['id'=>'1','name'=>'北京市','pid'=>'1']);
        $this->insert('{{%_cities}}',['id'=>'2','name'=>'天津市','pid'=>'2']);
        $this->insert('{{%_cities}}',['id'=>'3','name'=>'石家庄市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'4','name'=>'唐山市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'5','name'=>'秦皇岛市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'6','name'=>'邯郸市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'7','name'=>'邢台市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'8','name'=>'保定市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'9','name'=>'张家口市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'10','name'=>'承德市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'11','name'=>'沧州市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'12','name'=>'廊坊市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'13','name'=>'衡水市','pid'=>'3']);
        $this->insert('{{%_cities}}',['id'=>'14','name'=>'太原市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'15','name'=>'大同市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'16','name'=>'阳泉市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'17','name'=>'长治市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'18','name'=>'晋城市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'19','name'=>'朔州市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'20','name'=>'晋中市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'21','name'=>'运城市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'22','name'=>'忻州市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'23','name'=>'临汾市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'24','name'=>'吕梁市','pid'=>'4']);
        $this->insert('{{%_cities}}',['id'=>'25','name'=>'呼和浩特市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'26','name'=>'包头市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'27','name'=>'乌海市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'28','name'=>'赤峰市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'29','name'=>'通辽市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'30','name'=>'鄂尔多斯市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'31','name'=>'呼伦贝尔市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'32','name'=>'巴彦淖尔市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'33','name'=>'乌兰察布市','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'34','name'=>'兴安盟','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'35','name'=>'锡林郭勒盟','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'36','name'=>'阿拉善盟','pid'=>'5']);
        $this->insert('{{%_cities}}',['id'=>'37','name'=>'沈阳市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'38','name'=>'大连市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'39','name'=>'鞍山市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'40','name'=>'抚顺市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'41','name'=>'本溪市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'42','name'=>'丹东市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'43','name'=>'锦州市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'44','name'=>'营口市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'45','name'=>'阜新市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'46','name'=>'辽阳市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'47','name'=>'盘锦市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'48','name'=>'铁岭市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'49','name'=>'朝阳市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'50','name'=>'葫芦岛市','pid'=>'6']);
        $this->insert('{{%_cities}}',['id'=>'51','name'=>'长春市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'52','name'=>'吉林市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'53','name'=>'四平市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'54','name'=>'辽源市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'55','name'=>'通化市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'56','name'=>'白山市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'57','name'=>'松原市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'58','name'=>'白城市','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'59','name'=>'延边朝鲜族自治州','pid'=>'7']);
        $this->insert('{{%_cities}}',['id'=>'60','name'=>'哈尔滨市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'61','name'=>'齐齐哈尔市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'62','name'=>'鸡西市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'63','name'=>'鹤岗市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'64','name'=>'双鸭山市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'65','name'=>'大庆市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'66','name'=>'伊春市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'67','name'=>'佳木斯市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'68','name'=>'七台河市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'69','name'=>'牡丹江市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'70','name'=>'黑河市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'71','name'=>'绥化市','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'72','name'=>'大兴安岭地区','pid'=>'8']);
        $this->insert('{{%_cities}}',['id'=>'73','name'=>'上海市','pid'=>'9']);
        $this->insert('{{%_cities}}',['id'=>'74','name'=>'南京市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'75','name'=>'无锡市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'76','name'=>'徐州市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'77','name'=>'常州市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'78','name'=>'苏州市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'79','name'=>'南通市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'80','name'=>'连云港市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'81','name'=>'淮安市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'82','name'=>'盐城市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'83','name'=>'扬州市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'84','name'=>'镇江市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'85','name'=>'泰州市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'86','name'=>'宿迁市','pid'=>'10']);
        $this->insert('{{%_cities}}',['id'=>'87','name'=>'杭州市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'88','name'=>'宁波市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'89','name'=>'温州市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'90','name'=>'嘉兴市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'91','name'=>'湖州市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'92','name'=>'绍兴市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'93','name'=>'金华市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'94','name'=>'衢州市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'95','name'=>'舟山市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'96','name'=>'台州市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'97','name'=>'丽水市','pid'=>'11']);
        $this->insert('{{%_cities}}',['id'=>'98','name'=>'合肥市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'99','name'=>'芜湖市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'100','name'=>'蚌埠市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'101','name'=>'淮南市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'102','name'=>'马鞍山市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'103','name'=>'淮北市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'104','name'=>'铜陵市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'105','name'=>'安庆市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'106','name'=>'黄山市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'107','name'=>'滁州市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'108','name'=>'阜阳市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'109','name'=>'宿州市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'110','name'=>'巢湖市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'111','name'=>'六安市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'112','name'=>'亳州市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'113','name'=>'池州市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'114','name'=>'宣城市','pid'=>'12']);
        $this->insert('{{%_cities}}',['id'=>'115','name'=>'福州市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'116','name'=>'厦门市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'117','name'=>'莆田市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'118','name'=>'三明市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'119','name'=>'泉州市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'120','name'=>'漳州市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'121','name'=>'南平市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'122','name'=>'龙岩市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'123','name'=>'宁德市','pid'=>'13']);
        $this->insert('{{%_cities}}',['id'=>'124','name'=>'南昌市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'125','name'=>'景德镇市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'126','name'=>'萍乡市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'127','name'=>'九江市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'128','name'=>'新余市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'129','name'=>'鹰潭市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'130','name'=>'赣州市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'131','name'=>'吉安市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'132','name'=>'宜春市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'133','name'=>'抚州市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'134','name'=>'上饶市','pid'=>'14']);
        $this->insert('{{%_cities}}',['id'=>'135','name'=>'济南市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'136','name'=>'青岛市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'137','name'=>'淄博市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'138','name'=>'枣庄市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'139','name'=>'东营市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'140','name'=>'烟台市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'141','name'=>'潍坊市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'142','name'=>'济宁市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'143','name'=>'泰安市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'144','name'=>'威海市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'145','name'=>'日照市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'146','name'=>'莱芜市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'147','name'=>'临沂市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'148','name'=>'德州市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'149','name'=>'聊城市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'150','name'=>'滨州市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'151','name'=>'菏泽市','pid'=>'15']);
        $this->insert('{{%_cities}}',['id'=>'152','name'=>'郑州市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'153','name'=>'开封市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'154','name'=>'洛阳市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'155','name'=>'平顶山市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'156','name'=>'安阳市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'157','name'=>'鹤壁市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'158','name'=>'新乡市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'159','name'=>'焦作市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'160','name'=>'济源市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'161','name'=>'濮阳市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'162','name'=>'许昌市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'163','name'=>'漯河市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'164','name'=>'三门峡市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'165','name'=>'南阳市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'166','name'=>'商丘市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'167','name'=>'信阳市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'168','name'=>'周口市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'169','name'=>'驻马店市','pid'=>'16']);
        $this->insert('{{%_cities}}',['id'=>'170','name'=>'武汉市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'171','name'=>'黄石市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'172','name'=>'十堰市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'173','name'=>'宜昌市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'174','name'=>'襄阳市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'175','name'=>'鄂州市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'176','name'=>'荆门市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'177','name'=>'孝感市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'178','name'=>'荆州市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'179','name'=>'黄冈市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'180','name'=>'咸宁市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'181','name'=>'随州市','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'182','name'=>'恩施土家族苗族自治州','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'183','name'=>'省直辖县级行政单位','pid'=>'17']);
        $this->insert('{{%_cities}}',['id'=>'184','name'=>'长沙市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'185','name'=>'株洲市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'186','name'=>'湘潭市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'187','name'=>'衡阳市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'188','name'=>'邵阳市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'189','name'=>'岳阳市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'190','name'=>'常德市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'191','name'=>'张家界市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'192','name'=>'益阳市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'193','name'=>'郴州市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'194','name'=>'永州市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'195','name'=>'怀化市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'196','name'=>'娄底市','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'197','name'=>'湘西土家族苗族自治州','pid'=>'18']);
        $this->insert('{{%_cities}}',['id'=>'198','name'=>'广州市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'199','name'=>'韶关市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'200','name'=>'深圳市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'201','name'=>'珠海市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'202','name'=>'汕头市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'203','name'=>'佛山市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'204','name'=>'江门市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'205','name'=>'湛江市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'206','name'=>'茂名市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'207','name'=>'肇庆市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'208','name'=>'惠州市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'209','name'=>'梅州市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'210','name'=>'汕尾市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'211','name'=>'河源市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'212','name'=>'阳江市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'213','name'=>'清远市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'214','name'=>'潮州市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'215','name'=>'揭阳市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'216','name'=>'云浮市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'217','name'=>'东莞市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'218','name'=>'中山市','pid'=>'19']);
        $this->insert('{{%_cities}}',['id'=>'219','name'=>'南宁市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'220','name'=>'柳州市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'221','name'=>'桂林市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'222','name'=>'梧州市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'223','name'=>'北海市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'224','name'=>'防城港市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'225','name'=>'钦州市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'226','name'=>'贵港市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'227','name'=>'玉林市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'228','name'=>'百色市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'229','name'=>'贺州市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'230','name'=>'河池市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'231','name'=>'来宾市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'232','name'=>'崇左市','pid'=>'20']);
        $this->insert('{{%_cities}}',['id'=>'233','name'=>'海口市','pid'=>'21']);
        $this->insert('{{%_cities}}',['id'=>'234','name'=>'省直辖县级行政单位','pid'=>'21']);
        $this->insert('{{%_cities}}',['id'=>'235','name'=>'三亚市','pid'=>'21']);
        $this->insert('{{%_cities}}',['id'=>'236','name'=>'重庆市','pid'=>'22']);
        $this->insert('{{%_cities}}',['id'=>'237','name'=>'成都市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'238','name'=>'自贡市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'239','name'=>'攀枝花市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'240','name'=>'泸州市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'241','name'=>'德阳市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'242','name'=>'绵阳市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'243','name'=>'广元市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'244','name'=>'遂宁市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'245','name'=>'内江市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'246','name'=>'乐山市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'247','name'=>'南充市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'248','name'=>'眉山市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'249','name'=>'宜宾市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'250','name'=>'广安市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'251','name'=>'达州市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'252','name'=>'雅安市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'253','name'=>'巴中市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'254','name'=>'资阳市','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'255','name'=>'阿坝藏族羌族自治州','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'256','name'=>'甘孜藏族自治州','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'257','name'=>'凉山彝族自治州','pid'=>'23']);
        $this->insert('{{%_cities}}',['id'=>'258','name'=>'贵阳市','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'259','name'=>'六盘水市','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'260','name'=>'遵义市','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'261','name'=>'安顺市','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'262','name'=>'铜仁地区','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'263','name'=>'黔西南布依族苗族自治州','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'264','name'=>'毕节地区','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'265','name'=>'黔东南苗族侗族自治州','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'266','name'=>'黔南布依族苗族自治州','pid'=>'24']);
        $this->insert('{{%_cities}}',['id'=>'267','name'=>'昆明市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'268','name'=>'曲靖市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'269','name'=>'玉溪市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'270','name'=>'保山市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'271','name'=>'昭通市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'272','name'=>'丽江市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'273','name'=>'普洱市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'274','name'=>'临沧市','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'275','name'=>'楚雄彝族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'276','name'=>'红河哈尼族彝族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'277','name'=>'文山壮族苗族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'278','name'=>'西双版纳傣族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'279','name'=>'大理白族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'280','name'=>'德宏傣族景颇族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'281','name'=>'怒江傈僳族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'282','name'=>'迪庆藏族自治州','pid'=>'25']);
        $this->insert('{{%_cities}}',['id'=>'283','name'=>'拉萨市','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'284','name'=>'昌都地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'285','name'=>'山南地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'286','name'=>'日喀则地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'287','name'=>'那曲地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'288','name'=>'阿里地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'289','name'=>'林芝地区','pid'=>'26']);
        $this->insert('{{%_cities}}',['id'=>'290','name'=>'西安市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'291','name'=>'铜川市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'292','name'=>'宝鸡市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'293','name'=>'咸阳市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'294','name'=>'渭南市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'295','name'=>'延安市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'296','name'=>'汉中市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'297','name'=>'榆林市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'298','name'=>'安康市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'299','name'=>'商洛市','pid'=>'27']);
        $this->insert('{{%_cities}}',['id'=>'300','name'=>'兰州市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'301','name'=>'嘉峪关市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'302','name'=>'金昌市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'303','name'=>'白银市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'304','name'=>'天水市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'305','name'=>'武威市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'306','name'=>'张掖市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'307','name'=>'平凉市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'308','name'=>'酒泉市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'309','name'=>'庆阳市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'310','name'=>'定西市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'311','name'=>'陇南市','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'312','name'=>'临夏回族自治州','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'313','name'=>'甘南藏族自治州','pid'=>'28']);
        $this->insert('{{%_cities}}',['id'=>'314','name'=>'西宁市','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'315','name'=>'海东地区','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'316','name'=>'海北藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'317','name'=>'黄南藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'318','name'=>'海南藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'319','name'=>'果洛藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'320','name'=>'玉树藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'321','name'=>'海西蒙古族藏族自治州','pid'=>'29']);
        $this->insert('{{%_cities}}',['id'=>'322','name'=>'银川市','pid'=>'30']);
        $this->insert('{{%_cities}}',['id'=>'323','name'=>'石嘴山市','pid'=>'30']);
        $this->insert('{{%_cities}}',['id'=>'324','name'=>'吴忠市','pid'=>'30']);
        $this->insert('{{%_cities}}',['id'=>'325','name'=>'固原市','pid'=>'30']);
        $this->insert('{{%_cities}}',['id'=>'326','name'=>'中卫市','pid'=>'30']);
        $this->insert('{{%_cities}}',['id'=>'327','name'=>'乌鲁木齐市','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'328','name'=>'克拉玛依市','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'329','name'=>'吐鲁番地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'330','name'=>'哈密地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'331','name'=>'昌吉回族自治州','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'332','name'=>'博尔塔拉蒙古自治州','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'333','name'=>'巴音郭楞蒙古自治州','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'334','name'=>'阿克苏地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'335','name'=>'克孜勒苏柯尔克孜自治州','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'336','name'=>'喀什地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'337','name'=>'和田地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'338','name'=>'伊犁哈萨克自治州','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'339','name'=>'塔城地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'340','name'=>'阿勒泰地区','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'341','name'=>'省直辖县级行政单位','pid'=>'31']);
        $this->insert('{{%_cities}}',['id'=>'342','name'=>'香港特别行政区','pid'=>'32']);
        $this->insert('{{%_cities}}',['id'=>'343','name'=>'澳门特别行政区','pid'=>'33']);
        $this->insert('{{%_cities}}',['id'=>'344','name'=>'台湾省','pid'=>'34']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%_cities}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

