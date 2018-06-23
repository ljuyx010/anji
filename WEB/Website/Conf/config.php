<?php
return array(
	//定义模板中__public__路径
	'TMPL_PARSE_STRING'	=> array(
        '__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Website/public',
		),
	'URL_HTML_SUFFIX' => '', //定义网页后缀名

	//设置修改模板路径
	'TMPL_FILE_DEPR' => '_',
	'HTTP_CACHE_CONTROL' =>  'no-cache',  // 网页缓存控制private有缓存

	'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 2, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'lj_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'lj_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'lj_auth_rule', //权限规则表
        'AUTH_USER' => 'lj_admin'//用户信息表
    )
);
?>