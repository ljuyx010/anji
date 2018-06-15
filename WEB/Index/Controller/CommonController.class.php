<?php
namespace Index\Controller;
use Think\Controller;

/**
* 公用控制器
*/
class CommonController extends Controller{
	//会员状态自动验证
	public function _initialize (){
		// if (strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') == false) { 
		// //判断打开方式，不是微信内就跳转
  //       $this->redirect(MODULE_NAME.'/Redirect/index');
		// }
		// //判断是否验证过
		// if(!(session("?userOpenid")&&session("?userID"))){
		// //进入验证
		// 	Check();
		// }
		$wxconfig = wx_share_init();		//微信分享jssdk初始化
		$this->assign('wxconfig', $wxconfig); //微信分享参数
	}
	
}
?>