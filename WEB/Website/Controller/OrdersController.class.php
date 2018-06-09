<?php
namespace Website\Controller;
use Think\Controller;
//会员管理控制器
class OrdersController extends CommonController{
	//会员管理视图
	public function index () {
		$id = I('id','',intval);
		switch ($id){
			case 1:
			  $msg="待付款订单";
			  break;
			case 2:
			  $msg="已付款订单";
			  break;
			case 3:
			  $msg="已发货订单";
			  break;
			case 4:
			  $msg="已收货订单";
			  break;
		}
		$this->msg=$msg;
		$this->id=$id;
		$this->display();
	}
	
	public function fpage (){
		$id = I('id','',intval);
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 0 : $order="order ".$px; break; 
		case 5 : $order="buytime ".$px; break; 
		} 
		$where = array('status'=>$id);
		if($s){$where=array_merge($where,array('pname'=>array('like','%'.$s.'%')));}
		$article = M('orders')->field(array('id','order','pname','price','num','sumprice','FROM_UNIXTIME(buytime,"%Y-%m-%d %H:%i")' =>'times','status'))->where($where)->order($order)->page($p,$c)->select();
		$count = M('orders')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function updata () {
		$id = I('id','',intval);
		$this->id = $id;
		$orders = M('orders')->where(array('id'=>$id))->select();
		$uid=$orders[0]['uid'];
		$pid=$orders[0]['pid'];
		
		$this->u=M('member')->where(array('id'=>$uid))->field('realname,QQ,usertype')->find();
		$this->p=M('goods')->where(array('id'=>$pid))->field('title,pic,price,brand,unit,weight')->find();
		$this->orders = $orders;
		$this->display();		
	}

	public function runUpdata () {
		$id = I('id','',intval);
		$price=$_POST['price'];
		$orders=M('orders')->where(array('id'=>$id))->field('order,price,num')->find();
		if($orders['price'] == $price){$sumprice=$_POST['sumprice'];}else{$sumprice=$price*$orders['num'];}
		$data = array(
			'id'=>$id,
			'order'=>$orders['order'],
			'price'=>$price,
			'status'=>$_POST['status'],
			'sumprice'=>$sumprice,
			'remark'=>$_POST['remark']
		);

		if (M('orders')->save($data)){
			$this->success('保存成功',U(MODULE_NAME.'/Orders/index'));
		}else{
			$this->error('数据未改动或者修改失败');
		}

	}
	
	public function status (){
		$id = I('id','',intval);
		if (M('orders')->where(array('id'=>$id))->setField('status',3)){
			$this->success('设置已发货成功',U(MODULE_NAME.'/Orders/index'));
		}else{
			$this->error('设置发货失败');
		}
	}

}
?>