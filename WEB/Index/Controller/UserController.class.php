<?php
namespace Index\Controller;
use Think\Controller;

/**
* 会员登录控制器
*/
class UserController extends CommonController{
	
	public function index () {
		//会员视图
		$this->dfk=M('orders')->where(array('zt'=>0,'uid'=>session('userID')))->select();
		$this->yzf=M('orders')->where('zt in (1,2,-1) and uid='.session('userID'))->select();
		$this->ywc=M('orders')->where('zt in (-2,3) and uid='.session('userID'))->select();
		$this->display();
	}
	
}
?>