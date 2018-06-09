<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE' => 'Index',//默认项目组
	'DEFAULT_CONTROLLER' => 'Index', //默认控制器
	'DEFAULT_ACTION' => 'index', // 默认操作名称
    'MODULE_ALLOW_LIST' => array('Index','Wap','Website'), //模块列表
	//数据库连接参数设置
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_USER' => 'root',
	'DB_PWD' => 'root',
	'DB_NAME' => 'anji',
	'DB_PREFIX' => 'lj_',
	'DB_CHARSET' => 'utf8',
	'DB_FIELDS_CACHE' => false,

	//点语法默认解析
	'TMPL_VAR_IDENTIFY' => 'array',

	//自定义session数据库存储
	'SESSION_OPTIONS' => array('type'=>'db','expire'=>7200),
	//自定义扩展类库
    'AUTOLOAD_NAMESPACE' => array('Lib' => APP_PATH.'Lib'),
    
    'TAGLIB_LOAD' => true,//加载自定义标签库打开
    
    'TAGLIB_PRE_LOAD' => 'html,TagLib\TagLibLj',

	'TAGLIB_BUILD_IN' =>'Cx,Html,TagLib\TagLibLj',
	'LOG_RECORD'            =>  false,   // 默认不记录日志
	'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
	'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
	'LOG_EXCEPTION_RECORD'  =>  false,    // 是否记录异常信息日志

);

?>