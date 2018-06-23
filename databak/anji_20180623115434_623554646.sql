/* This file is created by MySQLReback 2018-06-23 11:54:34 */
 /* 创建表结构 `lj_admin` */
 DROP TABLE IF EXISTS `lj_admin`;/* MySQLReback Separation */ CREATE TABLE `lj_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `name` varchar(20) NOT NULL COMMENT '名称',
  `logintime` int(10) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_admin` */
 INSERT INTO `lj_admin` VALUES ('1','dpwl_lj','b2c07ad92393f08b7b5acc539bd9e03b','李俊','1529723667','/Upload/image/2018-06-23/5b2da3622873f.jpg');/* MySQLReback Separation */
 /* 创建表结构 `lj_article` */
 DROP TABLE IF EXISTS `lj_article`;/* MySQLReback Separation */ CREATE TABLE `lj_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `keywords` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `content` text,
  `time` int(10) unsigned NOT NULL,
  `click` int(10) unsigned DEFAULT '0',
  `cid` int(10) DEFAULT NULL,
  `tj` int(10) unsigned DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_article` */
 INSERT INTO `lj_article` VALUES ('1','文章内容管理测试','阿斯顿发','按时噶事嘎嘎嘎','撒发嘎嘎三个阿斯钢阿斯钢暗关','1528732800','1','0','1','/Upload/image/2018-06-04/5b150d82b37a6.jpg','周博'),('2','发生发生了法法师','','们恐怕是开放老妈说佛叫司法局','们恐怕是开放老妈说佛叫司法局','1528279154','0','0','0','','');/* MySQLReback Separation */
 /* 创建表结构 `lj_auth_group` */
 DROP TABLE IF EXISTS `lj_auth_group`;/* MySQLReback Separation */ CREATE TABLE `lj_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '规则id',
  `describe` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_auth_group` */
 INSERT INTO `lj_auth_group` VALUES ('1','超级管理员','1','1,2,10,11,12,13,14,15,18,19,20,22,16,17,21,69,23,24,25,26,27,28,29,30,43,44,3,4,5,31,32,33,34,35,36,37,38,39,40,41,42,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,6,7,8,9,60,61,62,63,64,65,66,67,68,70,71,72,73,74,75,76,77,78,87,79,80,81,82,83,84,85,86',''),('2','办公室','1','1,2,31,32,33,34,35,36,37,38,46,47,48,49','');/* MySQLReback Separation */
 /* 创建表结构 `lj_auth_group_access` */
 DROP TABLE IF EXISTS `lj_auth_group_access`;/* MySQLReback Separation */ CREATE TABLE `lj_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_auth_group_access` */
 INSERT INTO `lj_auth_group_access` VALUES ('1','1');/* MySQLReback Separation */
 /* 创建表结构 `lj_auth_rule` */
 DROP TABLE IF EXISTS `lj_auth_rule`;/* MySQLReback Separation */ CREATE TABLE `lj_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'level等级',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `sort` varchar(30) NOT NULL DEFAULT '0' COMMENT '排序规则',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_auth_rule` */
 INSERT INTO `lj_auth_rule` VALUES ('1','Index/index','后台首页','1','1','','0'),('2','Index/welcom','欢迎页','2','1','','0,1'),('3','User/index','会员管理','1','1','','0'),('4','User/edit','查看会员信息','2','1','','0,3'),('5','User/runUpdata','修改会员信息','2','1','','0,3'),('6','Car/classtype','车型管理','1','1','','0'),('7','Car/addtype','添加车型','2','1','','0,6'),('8','Car/edit','修改车型','2','1','','0,6'),('9','Car/delete','删除车型','2','1','','0,6'),('10','Car/index','车辆管理','1','1','','0'),('11','Car/addcar','添加车辆','2','1','','0,10'),('12','Car/editcar','修改车辆','2','1','','0,10'),('13','Car/delcar','删除车辆','2','1','','0,10'),('14','Orders/index','订单管理','1','1','','0'),('15','Orders/xianx','业务登记','2','1','','0,14'),('16','Orders/edit','查看订单详情','2','1','','0,14'),('17','Orders/runedit','修改线上订单','2','1','','0,14'),('18','Orders/add','添加线下订单','3','1','','0,14,15'),('19','Orders/editx','修改线下订单','3','1','','0,14,15'),('20','Orders/del','删除线下订单','3','1','','0,14,15'),('21','Orders/sendmail','发送短信通知','2','1','','0,14'),('22','Orders/tk','同意退款','3','1','','0,14,15'),('23','Hr/people','员工管理','1','1','','0'),('24','Hr/add','添加员工','2','1','','0,23'),('25','Hr/updata','修改员工信息','2','1','','0,23'),('26','Hr/delete','删除员工','2','1','','0,23'),('27','Hr/gongzi','员工工资管理','1','1','','0'),('28','Hr/addg','添加工资记录','2','1','','0,27'),('29','Hr/updatag','修改工资记录','2','1','','0,27'),('30','Hr/deleteg','删除工资记录','2','1','','0,27'),('31','Hr/xiaofei','消费审批管理','1','1','','0'),('32','Hr/addx','添加消费审批','2','1','','0,31'),('33','Hr/updatax','修改消费审批','2','1','','0,31'),('34','Hr/deletex','删除消费审批','2','1','','0,31'),('35','Jobs/index','招聘信息','1','1','','0'),('36','Jobs/add','添加招聘信息','2','1','','0,35'),('37','Jobs/edit','修改招聘信息','2','1','','0,35'),('38','Jobs/delete','删除招聘信息','2','1','','0,35'),('39','Finacal/etc','ETC充值管理','1','1','','0'),('40','Finacal/add','添加充值记录','2','1','','0,39'),('41','Finacal/updata','修改充值记录','2','1','','0,39'),('42','Finacal/delete','删除充值记录','2','1','','0,39'),('43','Finacal/gz','司机月提成统计','2','1','','0,27'),('44','Finacal/gzxq','提成详情','3','1','','0,27,43'),('45','Finacal/index','财务统计','1','1','','0'),('46','Article/index','文章管理','1','1','','0'),('47','Article/add','添加文章','2','1','','0,46'),('48','Article/edit','修改文章','2','1','','0,46'),('49','Article/delete','删除文章','2','1','','0,46'),('50','Admin/user','系统用户管理','1','1','','0'),('51','Admin/runaddu','添加修改系统用户','2','1','','0,50'),('52','Admin/deleteu','删除系统用户','2','1','','0,50'),('53','Admin/group','用户组管理','1','1','','0'),('54','Admin/runaddg','添加修改用户组','2','1','','0,53'),('55','Admin/setaccess','分配权限','2','1','','0,53'),('56','Admin/deleteg','删除用户组','2','1','','0,53'),('57','Admin/rule','权限列表','1','1','','0'),('58','Admin/runadd','添加修改权限','2','1','','0,57'),('59','Admin/delete','删除权限','2','1','','0,57'),('60','Bak/index','备份数据','1','1','','0'),('61','Outfit/index','设备管理','1','1','','0'),('62','Outfit/add','添加设备','2','1','','0,61'),('63','Outfit/updata','修改设备','2','1','','0,61'),('64','Outfit/delete','删除设备','2','1','','0,61'),('65','Outfit/car','随车设备','2','1','','0,61'),('66','Outfit/updatas','管理随车设备','2','1','','0,61'),('67','Outfit/deletes','删除随车设备','3','1','','0,61,66'),('68','Outfit/adds','添加设备/遗失设备','3','1','','0,61,66'),('69','After/dingd','完成订单','2','1','','0,14'),('70','After/finish','车辆返回里程油料登记','1','1','','0'),('71','After/weixiu','车辆维修保养管理','1','1','','0'),('72','After/addw','添加维修保养','2','1','','0,71'),('73','After/updataw','修改维修保养记录','2','1','','0,71'),('74','After/deletew','删除维修保养记录','2','1','','0,71'),('75','After/tousu','投诉/违章管理','1','1','','0'),('76','After/addt','添加投诉违章','2','1','','0,75'),('77','After/updatat','修改投诉违章','2','1','','0,75'),('78','After/deletet','删除投诉违章','2','1','','0,75'),('79','After/nianshen','车辆年审保险管理','1','1','','0'),('80','After/addn','添加年审保险','2','1','','0,79'),('81','After/updatan','修改年审保险','2','1','','0,79'),('82','After/deleten','删除年审保险','2','1','','0,79'),('83','After/safe','事故管理','1','1','','0'),('84','After/adds','添加事故','2','1','','0,83'),('85','After/updatas','修改事件记录','2','1','','0,83'),('86','After/deletes','删除事故记录','2','1','','0,83'),('87','After/tongj','违章投诉统计','2','1','','0,75');/* MySQLReback Separation */
 /* 创建表结构 `lj_bad` */
 DROP TABLE IF EXISTS `lj_bad`;/* MySQLReback Separation */ CREATE TABLE `lj_bad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) DEFAULT NULL COMMENT '车辆id',
  `people` varchar(10) NOT NULL COMMENT '姓名',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '类型：0投诉1违章',
  `mark` text COMMENT '详情',
  `time` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_bad` */
 INSERT INTO `lj_bad` VALUES ('1','鄂k8541zx','胡一刀','1','开车玩手机','1528214400'),('2','鄂k8541zx','胡一刀','0','测试投诉记录','1529424000');/* MySQLReback Separation */
 /* 创建表结构 `lj_banner` */
 DROP TABLE IF EXISTS `lj_banner`;/* MySQLReback Separation */ CREATE TABLE `lj_banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pic` varchar(100) NOT NULL,
  `title` varchar(30) NOT NULL,
  `url` varchar(60) DEFAULT NULL,
  `type` int(1) NOT NULL COMMENT '0pc 1wap',
  `sort` int(3) DEFAULT '100' COMMENT '排序',
  `time` int(10) DEFAULT NULL COMMENT '添加日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_banner` */
 INSERT INTO `lj_banner` VALUES ('2','/Upload/image/2018-06-14/5b2207b0dc13e.jpg','一起去旅行','','1','100','1528956853');/* MySQLReback Separation */
 /* 创建表结构 `lj_car` */
 DROP TABLE IF EXISTS `lj_car`;/* MySQLReback Separation */ CREATE TABLE `lj_car` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车牌号码',
  `driver` varchar(10) NOT NULL COMMENT '司机',
  `type` int(5) NOT NULL COMMENT '车型',
  `tel` char(12) NOT NULL COMMENT '司机电话',
  `state` int(1) DEFAULT '0' COMMENT '状态0正常，1检修',
  `xtime` int(10) DEFAULT NULL COMMENT '维修日期',
  `ktime` int(10) DEFAULT NULL COMMENT '微信完成日期',
  PRIMARY KEY (`id`,`carnum`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_car` */
 INSERT INTO `lj_car` VALUES ('1','鄂k8541zx','胡一刀','1','15819861243','0','1528357620','1528368420');/* MySQLReback Separation */
 /* 创建表结构 `lj_class` */
 DROP TABLE IF EXISTS `lj_class`;/* MySQLReback Separation */ CREATE TABLE `lj_class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) NOT NULL COMMENT '分类名',
  `kmm` int(10) DEFAULT '0' COMMENT '司机单程里程薪资',
  `sort` int(11) DEFAULT '100' COMMENT '排序',
  `title` varchar(30) NOT NULL COMMENT '产品标题',
  `pics` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `content` text COMMENT '车辆详情',
  `oilj` float(3,2) NOT NULL COMMENT '油价参数',
  `oilh` float(3,2) NOT NULL COMMENT '油耗参数',
  `glf` float(3,2) NOT NULL COMMENT '过路费参数',
  `lr` int(5) NOT NULL COMMENT '利润参数',
  `tj` int(1) NOT NULL DEFAULT '0' COMMENT '推荐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_class` */
 INSERT INTO `lj_class` VALUES ('1','宇通35座','70','99','舒适豪华旅游大巴','/Upload/image/2018-06-02/5b125c5f48c2d.jpg','<span style=\"color:#444444;font-family:Tahoma, Helvetica, SimSun, sans-serif, Hei;font-size:14px;background-color:#FFFFFF;\"> 湖北的旅游车有一个共同特性，那就是正规旅游车都是LY和LV开头的，所以通过车牌很容易识别是否为旅游车，另一般旅游车车身都有湖北旅游客运字样，如出租车一样，出租车也是属于不同公司，武汉旅游车也是一样，分布于26家旅游车队，每家车队都有不同车辆车型，但每家车型和业务量以及业务类型都有很大差别，这样在旅游高峰期就导致很多人租车都进入一个误区，感觉没有车，其实并不一定是那样，车队里面的车很大一部分都是私人挂靠在车队，同一个车队也有不同业务系统，最终导致资源信息不对称，就给大家造成一个假象，包括很多旅行社都进去这个误区了。</span>','6.44','0.23','1.20','900','0');/* MySQLReback Separation */
 /* 创建表结构 `lj_etc` */
 DROP TABLE IF EXISTS `lj_etc`;/* MySQLReback Separation */ CREATE TABLE `lj_etc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车牌号',
  `siji` varchar(10) NOT NULL COMMENT '司机',
  `money` decimal(5,2) NOT NULL COMMENT '充值金额',
  `time` int(10) NOT NULL COMMENT '时间',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_etc` */
 INSERT INTO `lj_etc` VALUES ('1','鄂k8541zx','胡一刀','200.00','1528214400','去宜昌过路费');/* MySQLReback Separation */
 /* 创建表结构 `lj_jobs` */
 DROP TABLE IF EXISTS `lj_jobs`;/* MySQLReback Separation */ CREATE TABLE `lj_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '标题',
  `jobname` varchar(20) NOT NULL COMMENT '招聘职位',
  `jobadd` varchar(255) DEFAULT NULL COMMENT '工作地点',
  `qty` varchar(10) NOT NULL DEFAULT '1' COMMENT '招聘人数',
  `salary` varchar(100) DEFAULT NULL COMMENT '工资待遇',
  `time` int(12) unsigned NOT NULL COMMENT '发布时间',
  `cid` int(10) unsigned DEFAULT NULL COMMENT '栏目id',
  `useful` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效期',
  `content` text COMMENT '招聘要求',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_jobs` */
 INSERT INTO `lj_jobs` VALUES ('1','高薪招聘java高级开发工程师','工程师','武汉','5','8000-10000','1528128000','0','1','<span style=\"color:#333333;font-family:arial, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, Î¢ÈíÑÅºÚ, ËÎÌå, Tahoma, Arial, Helvetica, STHeiti;font-size:14px;background-color:#FFFFFF;\">1.本科以上学历，计算机相关专业，5年以上B/S架构、基于Java技术的业务系统或网站的分析、设计、开发经验，有过大数据量、大并发的系统的设计和开发经验者优先，对人工智能感兴趣者优先；2.具备较强的需求分析、架构搭建、产品设计、团队管理等能力3.男女不限，23岁以上，35岁以下，性格开朗，有责任感，具有创业期艰苦奋斗的精神4.精通javascript,css,html,ajax,springMVC等前端技术；5.精通JAVA,J2EE体系，熟练运用Struts2、Spring、Hibernate等主流开源框架；6.精通Mysql数据库系统，能进行数据库安装、性能分析和调优；7.精通Unix/Linux操作系统等技术者优先；8.熟练运用常用集成开发环境（如：Eclipse，精通版本管理工具，如：vss，cvs，svn等；9.熟悉多种应用服务器如：Tomcat、BEA Weblogic等。10.喜欢钻研各种开发技术、喜欢研究开源代码，有良好的沟通、团队协作能力，责任心强，性格稳定，能够承受一定的工作压力。岗位职责：1、参与系统开发、部署和集成，负责设计和搭建软件开发项目系统架构（平台、数据库、接口和应用框架等），解决开发中各种系统构架问题，保证技术领先性，稳定性；2、参与系统概要设计，详细升级的编制，根据公司技术文档规范要求编写相应的技术文档等；3、负责组织技术架构，解决方案的评审。待遇：面议。据个人工作能力而定。福利待遇：五险，生日奖金，过节费，工作满一年以上的员工，可享受带薪婚假，产假，陪产假等等。升职空间：技术主管、技术总监，升职另有岗位津贴</span>');/* MySQLReback Separation */
 /* 创建表结构 `lj_ordcar` */
 DROP TABLE IF EXISTS `lj_ordcar`;/* MySQLReback Separation */ CREATE TABLE `lj_ordcar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordernum` varchar(20) NOT NULL COMMENT '订单号',
  `carnum` char(8) NOT NULL COMMENT '车牌号',
  `mileage` float(10,1) DEFAULT NULL COMMENT '实际里程',
  `wage` decimal(10,2) DEFAULT NULL COMMENT '司机提成',
  `oil` float(5,1) DEFAULT NULL COMMENT '油料',
  `addoil` decimal(10,2) DEFAULT NULL COMMENT '加油登记',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_ordcar` */
 INSERT INTO `lj_ordcar` VALUES ('1','201806198055','鄂k8541zx','','','','');/* MySQLReback Separation */
 /* 创建表结构 `lj_orders` */
 DROP TABLE IF EXISTS `lj_orders`;/* MySQLReback Separation */ CREATE TABLE `lj_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `ordernum` varchar(20) NOT NULL COMMENT '订单号',
  `uname` varchar(10) NOT NULL COMMENT '客户姓名',
  `utel` char(12) NOT NULL COMMENT '用户电话',
  `edr` varchar(40) NOT NULL COMMENT '目的地',
  `sdr` varchar(40) NOT NULL COMMENT '接车地址',
  `ordtime` int(10) NOT NULL COMMENT '下单时间',
  `stime` int(10) NOT NULL COMMENT '出发时间',
  `dtime` int(10) NOT NULL COMMENT '结束时间',
  `gl` int(5) NOT NULL COMMENT '公里数',
  `money` decimal(10,2) NOT NULL COMMENT '费用报价',
  `mark` text COMMENT '备注',
  `utype` int(1) NOT NULL DEFAULT '0' COMMENT '用户类型：0个人1团队2旅行社',
  `zt` int(2) NOT NULL DEFAULT '1' COMMENT '状态：0待支付1已支付2任务中3已完成-1申请退款-2已退款',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '类型：1线上0线下',
  `title` varchar(30) DEFAULT NULL COMMENT '商品标题',
  `des` varchar(30) DEFAULT NULL COMMENT '商品描述',
  `num` int(2) NOT NULL COMMENT '商品数量',
  `cid` int(10) NOT NULL COMMENT '商品id',
  `paytime` int(10) DEFAULT NULL COMMENT '支付时间',
  `ora` int(1) NOT NULL COMMENT '单双程',
  `backtime` int(10) DEFAULT NULL COMMENT '退款时间',
  `out_refund_no` varchar(32) DEFAULT NULL COMMENT '微信支付流水号',
  `refund_no` varchar(20) DEFAULT NULL COMMENT '退款单号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_orders` */
 INSERT INTO `lj_orders` VALUES ('1','','201806198055','李俊','15871295812','宜昌市夷陵区三峡大坝旅游景区','孝感市孝南区乾坤购物','1529636154','1529337600','1529337600','0','1995.14','测试订单号','0','1','0','宇通35座','舒适豪华旅游大巴','1','1','','2','','','');/* MySQLReback Separation */
 /* 创建表结构 `lj_people` */
 DROP TABLE IF EXISTS `lj_people`;/* MySQLReback Separation */ CREATE TABLE `lj_people` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL COMMENT '姓名',
  `card` char(18) NOT NULL COMMENT '身份证号',
  `brithday` int(10) DEFAULT NULL COMMENT '生日',
  `tel` char(12) NOT NULL COMMENT '联系电话',
  `adress` varchar(30) DEFAULT NULL COMMENT '联系地址',
  `ks` int(2) NOT NULL COMMENT '科室0司机1业务2办公室3财务4机务5安全',
  `time` int(10) NOT NULL COMMENT '入职时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_people` */
 INSERT INTO `lj_people` VALUES ('1','胡一刀','611651613516516516','550249200','15819861243','孝南区孝柴小区','5','1429113600'),('2','肖静','611651613516516516','158342400','13636014027','宜昌市交通大道','2','1199116800');/* MySQLReback Separation */
 /* 创建表结构 `lj_sbei` */
 DROP TABLE IF EXISTS `lj_sbei`;/* MySQLReback Separation */ CREATE TABLE `lj_sbei` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '设备名',
  `num` int(2) NOT NULL COMMENT '数量',
  `jia` decimal(5,2) NOT NULL COMMENT '单价',
  `dtime` int(10) DEFAULT NULL COMMENT '过期时间',
  `time` int(10) NOT NULL COMMENT '登记日期',
  `del` int(1) NOT NULL DEFAULT '0' COMMENT '是否过期被删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_sbei` */
 INSERT INTO `lj_sbei` VALUES ('1','干粉灭火器','60','80.00','1559923200','1528387200','0'),('2','破窗锤','60','10.00','0','1528387200','0');/* MySQLReback Separation */
 /* 创建表结构 `lj_sbeic` */
 DROP TABLE IF EXISTS `lj_sbeic`;/* MySQLReback Separation */ CREATE TABLE `lj_sbeic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车牌号',
  `sid` int(10) NOT NULL COMMENT '设备id',
  `num` int(5) NOT NULL COMMENT '设备数量',
  `atime` int(10) DEFAULT NULL COMMENT '添加日期',
  `loss` int(1) NOT NULL DEFAULT '0' COMMENT '丢失',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_sbeic` */
 INSERT INTO `lj_sbeic` VALUES ('4','鄂k8541zx','1','1','1528473600','0'),('6','鄂k8541zx','2','-1','1528473600','1'),('5','鄂k8541zx','2','4','1528473600','0');/* MySQLReback Separation */
 /* 创建表结构 `lj_session` */
 DROP TABLE IF EXISTS `lj_session`;/* MySQLReback Separation */ CREATE TABLE `lj_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_session` */
 INSERT INTO `lj_session` VALUES ('q2p6fivujhujkc8rbvs05o2ea4','1529733271','user|a:7:{s:2:\"id\";s:1:\"1\";s:7:\"account\";s:7:\"dpwl_lj\";s:8:\"password\";s:32:\"b2c07ad92393f08b7b5acc539bd9e03b\";s:4:\"name\";s:6:\"李俊\";s:9:\"logintime\";s:10:\"1529718365\";s:3:\"pic\";s:42:\"/Upload/image/2018-06-23/5b2da3622873f.jpg\";s:5:\"group\";s:15:\"超级管理员\";}'),('f3ld7hrepfeqm4hcd5evr044r3','1529730756','user|a:7:{s:2:\"id\";s:1:\"1\";s:7:\"account\";s:7:\"dpwl_lj\";s:8:\"password\";s:32:\"b2c07ad92393f08b7b5acc539bd9e03b\";s:4:\"name\";s:6:\"李俊\";s:9:\"logintime\";s:10:\"1529717780\";s:3:\"pic\";s:42:\"/Upload/image/2018-06-23/5b2da3622873f.jpg\";s:5:\"group\";s:15:\"超级管理员\";}');/* MySQLReback Separation */
 /* 创建表结构 `lj_shen` */
 DROP TABLE IF EXISTS `lj_shen`;/* MySQLReback Separation */ CREATE TABLE `lj_shen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车辆id',
  `type` int(1) NOT NULL COMMENT '类型：0保险1营运证2行车证',
  `money` decimal(5,2) DEFAULT NULL COMMENT '费用',
  `dtime` int(10) NOT NULL COMMENT '过期时间',
  `time` int(10) NOT NULL COMMENT '登记日期',
  `mark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_shen` */
 INSERT INTO `lj_shen` VALUES ('1','鄂k8541zx','0','999.99','1525622400','1494086400','平安交强险一年'),('2','鄂k8541zx','1','0.00','1559836800','1496764800','');/* MySQLReback Separation */
 /* 创建表结构 `lj_shigu` */
 DROP TABLE IF EXISTS `lj_shigu`;/* MySQLReback Separation */ CREATE TABLE `lj_shigu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车辆id',
  `people` varchar(10) NOT NULL COMMENT '责任人',
  `time` int(10) NOT NULL COMMENT '事故时间',
  `adress` varchar(100) NOT NULL COMMENT '地点',
  `content` text NOT NULL COMMENT '事发经过',
  `end` varchar(255) NOT NULL COMMENT '处理结果',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_shigu` */
 INSERT INTO `lj_shigu` VALUES ('1','鄂k8541zx','胡一刀','1528214400','宜昌市交通大道','车子被其他车辆刮擦','对方赔偿补漆费用');/* MySQLReback Separation */
 /* 创建表结构 `lj_site` */
 DROP TABLE IF EXISTS `lj_site`;/* MySQLReback Separation */ CREATE TABLE `lj_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_site` */
 INSERT INTO `lj_site` VALUES ('1','basic','a:9:{s:5:\"title\";s:24:\"安吉旅游客运公司\";s:8:\"keywords\";s:25:\"湖北安吉,安吉旅游\";s:11:\"description\";s:93:\"湖北安吉旅游客运公司是一家出租旅游大巴为主营业务的旅游客运公司\";s:3:\"tel\";s:11:\"07122467890\";s:6:\"adress\";s:0:\"\";s:4:\"mail\";s:0:\"\";s:2:\"QQ\";s:0:\"\";s:7:\"content\";s:424:\"孝感汽车客运集团有限公司安吉旅游分公司办公室地址位于中国孝文化之乡，中国一座以孝命名的地级城市--孝感，孝感 孝感市槐荫大道108号，于2005年06月03日在孝感市工商行政管理局注册成立，在公司发展壮大的13年里，我们始终为客户提供好的产品和技术支持、健全的售后服务，我公司主要经营旅游客运及代理服务。\";s:2:\"js\";s:0:\"\";}'),('2','extend','a:10:{s:5:\"AppId\";s:18:\"wxc4a049363bf99e96\";s:9:\"AppSecret\";s:32:\"3662edee7ad938c7cc990ab5dad6fcee\";s:4:\"mhid\";s:10:\"1486817992\";s:6:\"apikey\";s:32:\"881681fdc74eb8d71ad7917e0c8a01e6\";s:11:\"client_cert\";s:1616:\"-----BEGIN CERTIFICATE-----
MIIEaTCCA9KgAwIBAgIEAWHYiDANBgkqhkiG9w0BAQUFADCBijELMAkGA1UEBhMC
Q04xEjAQBgNVBAgTCUd1YW5nZG9uZzERMA8GA1UEBxMIU2hlbnpoZW4xEDAOBgNV
BAoTB1RlbmNlbnQxDDAKBgNVBAsTA1dYRzETMBEGA1UEAxMKTW1wYXltY2hDQTEf
MB0GCSqGSIb3DQEJARYQbW1wYXltY2hAdGVuY2VudDAeFw0xNzA4MDIxMDEwMjFa
Fw0yNzA3MzExMDEwMjFaMIGYMQswCQYDVQQGEwJDTjESMBAGA1UECBMJR3Vhbmdk
b25nMREwDwYDVQQHEwhTaGVuemhlbjEQMA4GA1UEChMHVGVuY2VudDEOMAwGA1UE
CxMFTU1QYXkxLTArBgNVBAMUJOWtneaEn+axvei9puWuoui/kOmbhuWbouaciemZ
kOWFrOWPuDERMA8GA1UEBBMIMzk5OTc0ODEwggEiMA0GCSqGSIb3DQEBAQUAA4IB
DwAwggEKAoIBAQCvF6S4YMTgW7habWcQd8b7bhztoNPKK7SguwBH2Wl7bT4Dn/QG
HVtLqx43wLmr0LO0rC7E1wEBvv4VNyCHK5b9rdQeUs9MzTNEUvrz/KzVAat0yMZz
cIYBZlBu5oAyRtEwhPr60DLdAXouP93kcIKbTHuxoXSvPbXlrThY6LZvWUCUtrYT
zjFWTzHCCLvh/3jG1R8AjXlVZIFoOeTozXRojJalMg+9gI0jkxGlxTvqseWWUHtT
gBX/dO4cz5+uK1Xog9Jxd5YpY3fLuxr/xzvIy14NKhkQVAM86ISaBxdi2vslEMcG
O4BAI42ml4ya0naLY8v7jJjxhxAXFtJnp/fzAgMBAAGjggFGMIIBQjAJBgNVHRME
AjAAMCwGCWCGSAGG+EIBDQQfFh0iQ0VTLUNBIEdlbmVyYXRlIENlcnRpZmljYXRl
IjAdBgNVHQ4EFgQU4AeYcuq3Tj4EGfUFAveQawr1S6owgb8GA1UdIwSBtzCBtIAU
PgUm9iJitBVbiM1kfrDUYqflhnShgZCkgY0wgYoxCzAJBgNVBAYTAkNOMRIwEAYD
VQQIEwlHdWFuZ2RvbmcxETAPBgNVBAcTCFNoZW56aGVuMRAwDgYDVQQKEwdUZW5j
ZW50MQwwCgYDVQQLEwNXWEcxEzARBgNVBAMTCk1tcGF5bWNoQ0ExHzAdBgkqhkiG
9w0BCQEWEG1tcGF5bWNoQHRlbmNlbnSCCQC7VJcrvADoVzAOBgNVHQ8BAf8EBAMC
BsAwFgYDVR0lAQH/BAwwCgYIKwYBBQUHAwIwDQYJKoZIhvcNAQEFBQADgYEANKX6
oruToY3bE3bTvgg7k2S+QqwTu2C+R4TLkW+V5wQJ0kkG+OscJzkHpcO9TK994win
Cva+vJ0DSIE8xq0fontG1ciVgvGteAi7d8nzg8h1kqoIc/7pkrqQLEj7em6/og2U
0r7TDSUD7SGeDKnthbRwA7iseqV68Gk8HsJtjJk=
-----END CERTIFICATE-----
\";s:10:\"client_key\";s:1730:\"-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCvF6S4YMTgW7ha
bWcQd8b7bhztoNPKK7SguwBH2Wl7bT4Dn/QGHVtLqx43wLmr0LO0rC7E1wEBvv4V
NyCHK5b9rdQeUs9MzTNEUvrz/KzVAat0yMZzcIYBZlBu5oAyRtEwhPr60DLdAXou
P93kcIKbTHuxoXSvPbXlrThY6LZvWUCUtrYTzjFWTzHCCLvh/3jG1R8AjXlVZIFo
OeTozXRojJalMg+9gI0jkxGlxTvqseWWUHtTgBX/dO4cz5+uK1Xog9Jxd5YpY3fL
uxr/xzvIy14NKhkQVAM86ISaBxdi2vslEMcGO4BAI42ml4ya0naLY8v7jJjxhxAX
FtJnp/fzAgMBAAECggEAS3oatKxqUfjX2ItOoWewrBQEfl8UzRLYE21pKo/LC7zE
vdVG4Rfokg7awNfgcfNOdDTBGHNCaNlHOCgCaqJcvVAgn029NPNEBVDsAx9J9ax5
l6cw/PRln9bWF2hfnMywQoUgl9wGAQUxARzg7yec9Ysbyy+5WA13CuIH5zOx6P9O
35t4Ac73O+DSAEJlMW7buzrfXiKyvdACGlwncFjoL+I/ZcaBiCbk5IeOmzNHf43s
7ysfB6h/AYPls3yrHnA+WQL5oId9JjbzXzMuX66GAaGPvHmCqao+Gf9FuzFLkCgr
c+flykHcRqd1wLe7B2+HYZdJYyB99kCOtEPo4SOgyQKBgQDZ04vsqjCWbn9qbqh1
BtUVB0AvC9QXG2MuzhJFL5lIjSLISUUPu6bI+PtxIWvQH3Afx1DFgkIIR4JTSxEz
gSw3agmD+0I1eft7OkTaydAS0VewLvJpWQrSOS0J1Uui8U+S8eOWpQO3Xi4a9gAd
4T7xuXpRA49dxzMdY9hsmXak1wKBgQDNxuZpRndBg5Sbd3lYoKUnsjgvqLuWN7Jc
RICAjlSB5iyxIpf/yvg2gt3YJgTQvfNbppoE0+I1PskZvfV+XtwB22SLMn+9g+He
hLwAhJN1MQ0uBrrVhPxVNq621XNhgnuwSyQvOj880k18sTZgMET5bIP0Pupmds/5
lF1+8SOGRQKBgHuArCclX6MLR4bq8uxXUV043TVPeZMYXiXdhRJhKIGwM/ZnRJbl
CG2ObdH45w37pTD/a1Zwwku7b7MWLsyLAqzwnDCOtz1myiVWJk/+eNESjKtCEwOU
DsSe0mBu5RGfzEQ+jZGOQgsnhPCYZfyLB4s6ZJWmdRTwqpSRVdZNNK3FAoGBAMW3
iQg6NrfyL8W5ZBTuNgIQUcApRiSt22igQUBEgZpWiTah4J5cbWYjE/ltfk77VGsJ
hw+AbuduLlfXl5wWlRoLrW251ddIcqwVqXZt7Ck8OkexG6+xGare4by3Fyfn8eSQ
LnJaawyLnPxkYbTGbF+kDp2OHjbZjjdmgPdJxzJpAoGARS78FemEEPigER3Q5hxN
ZJPv7nroAmz4CBEdtu0MlrNHuoFNI1akAN9fQ190vkFfKK2nF9Cjn0jfpkXO8cAE
GDiyQlGGRjyH7F6u3QQMMMs7enP+y+QTxz7sLgf0norvtqxn3TwwEL5V9GEFbnR+
AP57Ay3DOSkL3nHZiiWSgh0=
-----END PRIVATE KEY-----\";s:9:\"AccessKey\";s:16:\"LTAIuzWfEeBBW5cV\";s:12:\"AccessSecret\";s:30:\"z2uZsfktrQEiaOyOxbOr3lZip7WPwr\";s:2:\"qm\";s:12:\"安吉旅游\";s:4:\"mbid\";s:13:\"SMS_137657874\";}');/* MySQLReback Separation */
 /* 创建表结构 `lj_spend` */
 DROP TABLE IF EXISTS `lj_spend`;/* MySQLReback Separation */ CREATE TABLE `lj_spend` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '员工id',
  `title` varchar(60) NOT NULL COMMENT '业务名称',
  `money` decimal(5,2) NOT NULL COMMENT '金额',
  `time` int(10) NOT NULL COMMENT '时间',
  `mark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_spend` */
 INSERT INTO `lj_spend` VALUES ('1','1','出差报销','200.00','1528214400','去宜昌出差报销差旅费200元');/* MySQLReback Separation */
 /* 创建表结构 `lj_user` */
 DROP TABLE IF EXISTS `lj_user`;/* MySQLReback Separation */ CREATE TABLE `lj_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` char(28) NOT NULL,
  `name` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `sex` int(1) NOT NULL COMMENT '性别0女1男',
  `nickname` varchar(20) NOT NULL COMMENT '用户昵称',
  `photo` varchar(50) DEFAULT NULL COMMENT '头像',
  `tel` char(11) DEFAULT NULL COMMENT '电话',
  `mark` text COMMENT '备注',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `regtime` int(10) NOT NULL COMMENT '注册日期',
  `logintime` int(10) DEFAULT NULL COMMENT '登录日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `lj_wage` */
 DROP TABLE IF EXISTS `lj_wage`;/* MySQLReback Separation */ CREATE TABLE `lj_wage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '员工id',
  `yf` decimal(10,2) NOT NULL COMMENT '应发工资',
  `sf` decimal(10,2) NOT NULL COMMENT '实发工资',
  `time` int(10) NOT NULL COMMENT '发工资日期',
  `mark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_wage` */
 INSERT INTO `lj_wage` VALUES ('1','1','4000.00','3800.00','1528128000','迟到两次，闯红灯1次，罚款200元');/* MySQLReback Separation */
 /* 创建表结构 `lj_xiu` */
 DROP TABLE IF EXISTS `lj_xiu`;/* MySQLReback Separation */ CREATE TABLE `lj_xiu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) NOT NULL COMMENT '车辆id',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '维修类型：0保养，1小修2大修',
  `content` varchar(255) DEFAULT NULL COMMENT '材料',
  `hours` float(3,1) NOT NULL COMMENT '工时',
  `money` decimal(5,2) NOT NULL COMMENT '费用',
  `time` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_xiu` */
 INSERT INTO `lj_xiu` VALUES ('1','鄂k8541zx','0','','5.0','100.00','1528357620');/* MySQLReback Separation */