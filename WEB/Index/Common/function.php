<?php
/** 
 * 微信分享初始化 
 * @return array 
 * @author simon <vsiryxm@qq.com> 
 */  
if (!function_exists('wx_share_init')) {  
    function wx_share_init() {  
        $wxconfig = array();  
        vendor('Wxshare.class#jssdk');  
        $config = array('APPID'=>C('APPID'),'APPSECRET'=>C('APPSECRET')); //这里配置了微信公众号的AppId和AppSecret  
        $jssdk = new JSSDK($config['APPID'], $config['APPSECRET']);  
        $wxconfig = $jssdk->GetSignPackage();  
        return $wxconfig;  
    }  
} 
//检测用户信息
	function Check(){
		if(!session("?userOpenid")){
			$data=getOpenid();
			session('userOpenid',$data);
		}else{
			$data=session('userOpenid');
		}
		//设置临时变量
		if(!session("?status")){
			unset($_GET['code']);
			session("status","1");				
		}
		if($rst=M('user')->where(array('openid'=>$data))->find()){
			if(time()-$rst['logintime']>864000){
				updateUser(1);
			}else{
				M('user')->where(array('openid'=>$data))->setField('logintime',time());
			}
			setSession($rst);
			//设置SESSION
			return true;
		}else{
			//获取用户所以信息
			updateUser();
		}		
	}

	//获取用户openid
	function getOpenid(){
		if(!$_GET['code']){
			//获取当前的url地址
			if(I('id')){
				$rUrl=_URL_.__ACTION__.'/id/'.I('id').'.html';
			}else{
				$rUrl=_URL_.__ACTION__.'.html';
			}
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".C('APPID')."&redirect_uri=".$rUrl."&response_type=code&scope=snsapi_base&state=123456#wechat_redirect";
			//跳转页面
			redirect($url,0);
		}else{
			$aUrl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('APPID')."&secret=".C('APPSECRET')."&code=".$_GET['code']."&grant_type=authorization_code";
			//获取网页授权access_token和openid等
			$data=getHttp($aUrl);
			return $data['openid'];
		}
	}

	//获取用户详细信息
	function getUserInfo(){
		if(!$_GET['code']){
			//获取当前的url地址
			$rUrl=_URL_.__ACTION__.'/id/'.I('id',0,intval).'.html';
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".C('APPID')."&redirect_uri=".$rUrl."&response_type=code&scope=snsapi_userinfo&state=123456#wechat_redirect";
			//跳转页面
			redirect($url,0);
		}else{
			$getOpenidUrl="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('APPID')."&secret=".C('APPSECRET')."&code=".$_GET['code']."&grant_type=authorization_code";
			//获取网页授权access_token和openid等
			$data=file_get_contents($getOpenidUrl);
			$arr = json_decode($data,true);
			$getUserInfoUrl="https://api.weixin.qq.com/sns/userinfo?access_token=".$arr['access_token']."&openid=".$arr['openid']."&lang=zh_CN";
			//获取用户数据
			$json=file_get_contents($getUserInfoUrl);
			$userInfo=json_decode($json,true);
			return	$userInfo;
			session("status",null);
		}
	}
	
	//更新用户微信信息
	function updateUser($id){
		$userInfo=getUserInfo();
		$mode=M('user');
		if($id){
			$stu=$mode->field('id')->where(array('openid'=>$userInfo['openid']))->find();
			$sj=array('id'=>$stu['id'],'openid'=>$userInfo['openid'],'nickname'=>$userInfo['nickname'],'sex'=>$userInfo['sex'],'photo'=>$userInfo['headimgurl'],'logintime'=>time());
			$mode->save($sj);
		}else{
			$sj=array('openid'=>$userInfo['openid'],'nickname'=>$userInfo['nickname'],'sex'=>$userInfo['sex'],'photo'=>$userInfo['headimgurl'],'logintime'=>time(),'regtime'=>time());
			$mid=$mode->data($sj)->add();				
			if($mid){
			$userInfo['stuID'] = $mid;
			setSession($userInfo);
			}
		}
	}

	//设置SESSION
	function setSession($data){
		session('userOpenid',$data['openid']);		
		session('userSex',$data['sex']);
		session('name',$data['name']);
		session('userNickname',$data['nickname']);
		if($data['headimgurl']){session('userHeadimgurl',$data['headimgurl']);}else{session('userHeadimgurl',$data['photo']);}
		if($data['stuID']){session('userID',$data['stuID']);}else{session('userID',$data['id']);}	
	}

	//获取access_token
	function getAccess_token(){
		//URL
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".C('APPID')."&secret=".C('APPSECRET');
		//get请求
		$data=getHttp($url);
		//缓存access_token
		S('access_token',$data['access_token'],7000);
		return $data['access_token'];
	}

	//get请求
	function getHttp($url){
		$ch=curl_init();
		//设置传输地址
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置以文件流形式输出
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//接收返回数据
		$data=curl_exec($ch);
		curl_close($ch);
		$jsonInfo=json_decode($data,true);
		return $jsonInfo;
	}
	
	//post请求
	function postHttp($url,$json){
		$ch=curl_init();
		//设置传输地址
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置以文件流形式输出
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//设置已post方式请求
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	//设置post文件
 	 	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		$data=curl_exec($ch);
		curl_close($ch);
		$jsonInfo=json_decode($data,true);
		return $jsonInfo;
	}
	
	function request_post($url = '', $param = '')  
    {  
        if (empty($url) || empty($param)) {  
            return false;  
        }  
        $postUrl = $url;  
        $curlPost = $param;  
        $ch = curl_init(); //初始化curl  
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页  
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);  
        $data = curl_exec($ch); //运行curl  
        curl_close($ch);  
        return $data;  
    }  
	

	function orderhandle($parameter){
		if($parameter['trade_status']){
			$data=array(
			'order' => $parameter['out_trade_no'],
			'trade' => $parameter['trade_no'],
			'buyer_alipay' => $parameter['buyer_email'],
			'total_fee' => $parameter['total_fee'],
			'trade_status' => $parameter['trade_status'],
			'status' => 2,
			'paytime' => $parameter['notify_time']
			);
		}	
		
		M('orders')->where(array('order'=>$parameter['out_trade_no']))->save($data);
	} 
	/** 
     * 发送自定义的模板消息 
     */  
    function doSend($touser, $template_id, $url, $data, $topcolor = '#0D89C4'){  
        $template = array(  
            'touser' => $touser,  
            'template_id' => $template_id,  
            'url' => $url,  
            'topcolor' => $topcolor,  
            'data' => $data  
        );  
        $json_template = json_encode($template);
		if(S('access_token')){$accessToken=S('access_token');}else{$accessToken=getAccess_token();}
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;  
        $dataRes = request_post($url, urldecode($json_template));
        if ($dataRes['errcode'] == 0) {  
            return true;  
        } else {  
            return false;  
        }  
    } 


?>