<?php
$conf = M('conf')->where(array('id' => 0))->getField('confing');
$meter=unserialize($conf);
return array(
	//'配置项'=>'配置值'
	'TMPL_EXCEPTION_FILE' => './public/error.html',//自定义错误页面和404页面
	'URL_CASE_INSENSITIVE' =>true, //url地址不区分大小写

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
	'/^gbook_(\d+)$/'=> 'Gbook/index?id=:1',
	'/^goods_(\d+)$/' => 'Goods/index?id=:1',
	'/^details_(\d+)$/' => 'Goods/details?id=:1',	
	'/^gbookDo$/' => 'Gbook/gbookDo',
	'/^glist_(\d+)$/' => 'Gbook/glist?id=:1',
	'/^Search$/' => 'Search/index'	
    ),
	
	//微信配置项
	'APPID'=>$meter['Appid'],
	'APPSECRET' =>$meter['AppSecret'],

    'HTML_CACHE_ON' => false, // 开启静态缓存
    'HTML_CACHE_TIME' => 24*3600, // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.html', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(  // 定义静态缓存规则
    	'Index:index' => 'W_{:action}',
    	'Info:index' => 'W_{:controller}_{id}',
    	'Article:index' => 'W_{:controller}_{:action}_{id}',
    	'Atlas:index' => 'W_{:controller}_{:action}_{id}',
    	'Article:shows' => 'W_{:controller}_{:action}_{id}',
    	'Atlas:shows' => 'W_{:controller}_{:action}_{id}',
    	'Gbook:index' => 'W_{:controller}_{:action}_{id}',
    	'Jobs:index' => 'W_{:controller}_{:action}_{id}'
    	)
);
?>