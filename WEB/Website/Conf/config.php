<?php
$conf = M('site')->field('value')->where(array('name' => "extend"))->find();
$meter=unserialize($conf['value']);
return array(
	//定义模板中__public__路径
	'TMPL_PARSE_STRING'	=> array(
        '__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Website/public',
		),
	'URL_HTML_SUFFIX' => '', //定义网页后缀名

	//设置修改模板路径
	'TMPL_FILE_DEPR' => '_',
	'HTTP_CACHE_CONTROL' =>  'no-cache',  // 网页缓存控制private有缓存
	//微信支付配置参数
	'WEIXINPAY_CONFIG' => array(
    'APPID'              => $meter['AppId'], // 微信支付APPID
    'MCHID'              => $meter['mhid'], // 微信支付MCHID 商户收款账号
    'KEY'                => $meter['apikey'], // 微信支付KEY
    'APPSECRET'          => $meter['AppSecret'], // 公众帐号secert (公众号支付专用)
    'NOTIFY_URL'         => _URL_.'/index.php/Index/Weixin/notify', // 接收支付状态的连接
    ),
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