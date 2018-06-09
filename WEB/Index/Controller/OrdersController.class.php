<?php
namespace Index\Controller;
use Think\Controller;

class OrdersController extends Controller{
	
	public function index (){
		if(!session('memberid')) $this->redirect(MODULE_NAME.'/Index/index');
		$order = I('order');
		$data = M('orders')->where(array('order'=>$order))->find();
		if($data){
			$this->u = M('member')->where(array('id'=>$data['uid']))->field('realname,tel,address')->find();
			$this->p = M('goods')->where(array('id'=>$data['pid']))->field('stock,content,click',true)->find();
			$this->v=$data;
			$this->display();
		}else{
			$this->error('参数异常，请联系管理员');
		}
	}
	
}
?>