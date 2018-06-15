<?php
$conf = M('site')->field('value')->where(array('name' => "extend"))->find();
$meter=unserialize($conf['value']);
return array(
	//'配置项'=>'配置值'
	//'TMPL_EXCEPTION_FILE' => './public/error.html', //自定义错误页面和404页面

	//定义模板中__Public__路径
	'TMPL_PARSE_STRING' => array('__public__' => __ROOT__.'/Public'),
	//分页数
	'PAGE_NUM' => 10,
    'URL_ROUTER_ON'=>true, //开启超短路由
	'URL_ROUTE_RULES' => array(
	//'info/:id\d' => 'Info/index', //其中\d表示数字 正常配置c/9/
	'/^alist_(\d+)$/'=> 'Article/index?id=:1', //正则路由 c_9
	'/^ashow_(\d+)$/'=> 'Article/shows?id=:1',
	'/^plist_(\d+)$/'=> 'Atlas/index?id=:1',
	'/^pshow_(\d+)$/'=> 'Atlas/shows?id=:1',
	'/^info_(\d+)$/'=> 'Info/index?id=:1',
	'/^jobs_(\d+)$/'=> 'Jobs/index?id=:1',
	'/^goods_(\d+)$/'=> 'Goods/index?id=:1',
	'/^details_(\d+)$/'=> 'Goods/details?id=:1',
	'/^vote_(\d+)$/'=> 'Vote/index?id=:1',
	'/^cart_(\d+)$/'=> 'Goods/cart?id=:1',
	'/^buy_(\d+)$/'=> 'Goods/buy?id=:1',
	'/^gbook_(\d+)$/'=> 'Gbook/index?id=:1',
	'/^gbookdo$/' => 'Gbook/gbookDo',
	'/^votedo$/' => 'Vote/voteDo',
	'/^Search$/' => 'Search/index'
    ),

    'HTML_CACHE_ON' => false, // 开启静态缓存
    'HTML_CACHE_TIME' => 24*3600, // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.html', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(  // 定义静态缓存规则
    	'Index:index' => '{:action}',
    	'Info:index' => '{:controller}_{id}',
    	'Article:index' => '{:controller}_{:action}_{id}_{p}',
    	'Atlas:index' => '{:controller}_{:action}_{id}_{p}',
    	'Article:shows' => '{:controller}_{:action}_{id}',
    	'Atlas:shows' => '{:controller}_{:action}_{id}',
    	'Gbook:index' => '{:controller}_{:action}_{id}',
    	'Jobs:index' => '{:controller}_{:action}_{id}',
		'Vote:index' => '{:controller}_{:action}_{id}',
		'Goods:index' => '{:controller}_{:action}_{id}'
    ),
	
	// 配置邮件发送服务器
	'MAIL_SMTP'            =>  TRUE,
    'MAIL_HOST' =>$meter['MAIL_HOST'],//smtp服务器的名称
    'MAIL_SMTPAUTH' =>$meter['MAIL_SMTPAUTH'], //启用smtp认证
    'MAIL_USERNAME' =>$meter['MAIL_USERNAME'],//你的邮箱名
    'MAIL_FROM' =>$meter['MAIL_FROM'],//发件人地址
    'MAIL_FROMNAME'=>$meter['MAIL_FROMNAME'],//发件人姓名
    'MAIL_PASSWORD' =>$meter['MAIL_PASSWORD'],//邮箱密码
    'MAIL_CHARSET' =>$meter['MAIL_CHARSET'],//设置邮件编码
    'MAIL_ISHTML' =>$meter['MAIL_ISHTML'], // 是否HTML格式邮件	
	//微信配置项
	'APPID'=>$meter['AppId'],
	'APPSECRET' =>$meter['AppSecret'],
	//微信支付配置参数
	'WEIXINPAY_CONFIG' => array(
    'APPID'              => $meter['AppId'], // 微信支付APPID
    'MCHID'              => $meter['mhid'], // 微信支付MCHID 商户收款账号
    'KEY'                => $meter['apikey'], // 微信支付KEY
    'APPSECRET'          => $meter['AppSecret'], // 公众帐号secert (公众号支付专用)
    'NOTIFY_URL'         => _URL_.'/index.php/Index/weixinpay/notify', // 接收支付状态的连接
    ),
	//支付宝配置参数
	'alipay_config'=>array(
		'partner' =>$meter['partner'],   //这里是你在成功申请支付宝接口后获取到的PID；
		'key'=>$meter['key'],//这里是你在成功申请支付宝接口后获取到的Key
		'sign_type'=>strtoupper('MD5'),
		'input_charset'=> strtolower('utf-8'),
		'cacert'=> getcwd().'\\cacert.pem',
		'transport'=> 'http',
	),

	'alipay'   =>array(
		//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
		'seller_email'=>'wacode@qq.com',
	
		//这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
		'notify_url'=> U(MODULE_NAME.'/Pay/notifyurl','','',true),
	
		//这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
		'return_url'=> U(MODULE_NAME.'/Pay/returnurl','','',true),
	
		//支付成功跳转到的页面，我这里跳转到项目的Member控制器，myorder方法，并传参payed（已支付列表）
		'successpage'=>'Member/myorder/ordtype/payed',
	
		//支付失败跳转到的页面，我这里跳转到项目的Member控制器，myorder方法，并传参unpay（未支付列表）
		'errorpage'=>'Member/myorder/ordtype/unpay',
	)
);
?>