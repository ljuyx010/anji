<?php
namespace Index\Controller;
use Think\Controller;

/**
* 公用控制器
*/
class ClassName extends AnotherClass{
	//会员状态自动验证
	public function _initialize (){

		if (!isset($_SESSION['memberid'])){
   		$this->redirect(MODULE_NAME.'/Member/index');
   		}
	}
	
}
?>