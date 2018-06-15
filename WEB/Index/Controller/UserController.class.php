<?php
namespace Index\Controller;
use Think\Controller;

/**
* 会员登录控制器
*/
class UserController extends CommonController{
	
	public function index () {
		//会员视图
		$this->display();
	}
	
	//用户订单
	public function myorder (){
		$type = I('ordtype');
		if(!session('memberid')) $this->redirect(MODULE_NAME.'/Index/index');
		if($type=='payed'){
			$where=array('uid'=>session('memberid'),'paytime'=>array('neq',''));
		}else{
			$where=array('status'=>1,'paytime'=>array('neq',''));
		}
		$count = M('orders')->where($where)->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->orders = M('orders')->field('trade,buyer_alipay',true)->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}
	
}
?>