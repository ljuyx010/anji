/* This file is created by MySQLReback 2018-06-10 17:05:07 */
 /* 创建表结构 `lj_admin` */
 DROP TABLE IF EXISTS `lj_admin`;/* MySQLReback Separation */ CREATE TABLE `lj_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `name` varchar(20) NOT NULL COMMENT '名称',
  `logintime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
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
 INSERT INTO `lj_article` VALUES ('1','文章内容管理测试','阿斯顿发','按时噶事嘎嘎嘎','撒发嘎嘎三个阿斯钢阿斯钢暗关','1528732800','0','0','1','/Upload/image/2018-06-04/5b150d82b37a6.jpg','周博'),('2','发生发生了法法师','','们恐怕是开放老妈说佛叫司法局','们恐怕是开放老妈说佛叫司法局','1528279154','0','0','0','','');/* MySQLReback Separation */
 /* 创建表结构 `lj_auth_group` */
 DROP TABLE IF EXISTS `lj_auth_group`;/* MySQLReback Separation */ CREATE TABLE `lj_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `describe` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `lj_auth_rule` */
 DROP TABLE IF EXISTS `lj_auth_rule`;/* MySQLReback Separation */ CREATE TABLE `lj_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `lj_bad` */
 DROP TABLE IF EXISTS `lj_bad`;/* MySQLReback Separation */ CREATE TABLE `lj_bad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `carnum` char(8) DEFAULT NULL COMMENT '车辆id',
  `people` varchar(10) NOT NULL COMMENT '姓名',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '类型：0投诉1违章',
  `mark` text COMMENT '详情',
  `time` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_bad` */
 INSERT INTO `lj_bad` VALUES ('1','鄂k8541zx','胡一刀','1','开车玩手机','1528214400');/* MySQLReback Separation */
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_banner` */
 INSERT INTO `lj_banner` VALUES ('1','/Upload/image/2018-06-10/5b1ce953acbd0.jpg','轮播测试','','0','0','1528621403');/* MySQLReback Separation */
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
  `pid` int(10) DEFAULT '0' COMMENT '上级id',
  `sort` int(11) DEFAULT '100' COMMENT '排序',
  `title` varchar(30) NOT NULL COMMENT '产品标题',
  `pics` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `content` text COMMENT '车辆详情',
  `canshu` float(5,2) NOT NULL COMMENT '参数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lj_class` */
 INSERT INTO `lj_class` VALUES ('1','宇通35座','0','99','舒适豪华旅游大巴','/Upload/image/2018-06-02/5b125c5f48c2d.jpg','<span style=\"color:#444444;font-family:Tahoma, Helvetica, SimSun, sans-serif, Hei;font-size:14px;background-color:#FFFFFF;\"> 湖北的旅游车有一个共同特性，那就是正规旅游车都是LY和LV开头的，所以通过车牌很容易识别是否为旅游车，另一般旅游车车身都有湖北旅游客运字样，如出租车一样，出租车也是属于不同公司，武汉旅游车也是一样，分布于26家旅游车队，每家车队都有不同车辆车型，但每家车型和业务量以及业务类型都有很大差别，这样在旅游高峰期就导致很多人租车都进入一个误区，感觉没有车，其实并不一定是那样，车队里面的车很大一部分都是私人挂靠在车队，同一个车队也有不同业务系统，最终导致资源信息不对称，就给大家造成一个假象，包括很多旅行社都进去这个误区了。</span>','2.30');/* MySQLReback Separation */
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
 /* 创建表结构 `lj_jsuan` */
 DROP TABLE IF EXISTS `lj_jsuan`;/* MySQLReback Separation */ CREATE TABLE `lj_jsuan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordid` int(10) NOT NULL COMMENT '订单id',
  `ordernum` varchar(20) NOT NULL COMMENT '订单编号',
  `payment` decimal(10,2) DEFAULT NULL COMMENT '尾款',
  `mileage` float(10,1) DEFAULT NULL COMMENT '总里程',
  `wage` decimal(10,2) DEFAULT NULL COMMENT '司机提成',
  `park` decimal(4,2) DEFAULT NULL COMMENT '停车费',
  `zhusu` decimal(4,2) DEFAULT NULL COMMENT '住宿费',
  `meals` decimal(5,2) DEFAULT NULL COMMENT '餐费',
  `oil` decimal(5,2) DEFAULT NULL COMMENT '油费',
  `oilm` float(5,1) DEFAULT NULL COMMENT '加油量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `lj_orders` */
 DROP TABLE IF EXISTS `lj_orders`;/* MySQLReback Separation */ CREATE TABLE `lj_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordernum` varchar(20) NOT NULL COMMENT '订单号',
  `carid` int(10) NOT NULL COMMENT '车辆id',
  `uname` varchar(10) NOT NULL COMMENT '客户姓名',
  `utel` char(12) NOT NULL COMMENT '用户电话',
  `adress` varchar(30) NOT NULL COMMENT '接车地址',
  `ordtime` int(10) NOT NULL COMMENT '下单时间',
  `stime` int(10) NOT NULL COMMENT '出发时间',
  `dtime` int(10) NOT NULL COMMENT '结束时间',
  `money` decimal(10,2) NOT NULL COMMENT '费用',
  `mark` text COMMENT '备注',
  `utype` int(1) NOT NULL DEFAULT '0' COMMENT '用户类型：0个人1团队2旅行社',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
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
 INSERT INTO `lj_session` VALUES ('thoqaogsctvd0ikg0b8c8nq3o0','1528628704',''),('fv1qdfr7b4o6rfui2u56gcns27','1528627169','');/* MySQLReback Separation */
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
 INSERT INTO `lj_site` VALUES ('1','basic','a:9:{s:5:\"title\";s:24:\"安吉旅游客运公司\";s:8:\"keywords\";s:25:\"湖北安吉,安吉旅游\";s:11:\"description\";s:93:\"湖北安吉旅游客运公司是一家出租旅游大巴为主营业务的旅游客运公司\";s:3:\"tel\";s:0:\"\";s:6:\"adress\";s:0:\"\";s:4:\"mail\";s:0:\"\";s:2:\"QQ\";s:0:\"\";s:7:\"content\";s:0:\"\";s:2:\"js\";s:0:\"\";}'),('2','extend','a:10:{s:5:\"AppId\";s:18:\"wxf4b529aff196b633\";s:9:\"AppSecret\";s:32:\"bc39bb16b85d9fcd64e2c8bb0e5ce825\";s:4:\"mhid\";s:0:\"\";s:6:\"apikey\";s:0:\"\";s:11:\"client_cert\";s:0:\"\";s:10:\"client_key\";s:0:\"\";s:9:\"AccessKey\";s:0:\"\";s:12:\"AccessSecret\";s:0:\"\";s:2:\"qm\";s:0:\"\";s:4:\"mbid\";s:0:\"\";}');/* MySQLReback Separation */
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
  `sex` int(1) NOT NULL COMMENT '性别0女1男',
  `name` varchar(20) NOT NULL,
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `tel` char(11) DEFAULT NULL COMMENT '电话',
  `mark` text COMMENT '备注',
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