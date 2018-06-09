<?php
namespace Wap\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 * 前端首页模板
	 * @return [type] [description]
	 */
    public function index(){
      $data = F('Site','',APP_PATH.'/Data/');
      $this->title = $data['title'];
      $this->keywords = $data['keywords'];
      $this->description = $data['description'];
      $this->aboutus = $data['spare'];
	  $wxconfig = wx_share_init();		//微信分享jssdk初始化
	  $this->assign('wxconfig', $wxconfig); //微信分享参数
      $this->display();  
    }

    

}

?>