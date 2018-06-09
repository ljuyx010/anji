<?php
function say(){
	echo "hello word!";
}

/** 
 * 微信分享初始化 
 * @return array 
 * @author simon <vsiryxm@qq.com> 
 */  
if (!function_exists('wx_share_init')) {  
    function wx_share_init() {  
        $wxconfig = array();  
        vendor('Wxshare.class#jssdk');  
        $config = array('APPID'=>C("APPID"),'APPSECRET'=>C("APPSECRET")); //这里配置了微信公众号的AppId和AppSecret  
        $jssdk = new JSSDK($config['APPID'], $config['APPSECRET']);  
        $wxconfig = $jssdk->GetSignPackage();  
        return $wxconfig;  
    }  
} 
?>