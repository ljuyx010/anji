<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class GoodsController extends CommonController{
	
	public function index () {
		
		$field = array('id','classname','sort','title','pics');
		$count = M('class')->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %DOWN_PAGE% %HEADER%');
		$show = $Page->show();
		$this->goods = M('class')->field($field)->order('sort ASC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;			
		$this->display();		
	}

	public function details () {
		$id = I('id','',intval);
		$data=M('class')->field('id,title,classname,pics,content')->where(array('id'=>$id))->find();
		if(!$data){$this->error("没有相关信息");}
		$data['pics']=explode('|', $data['pics']);
		$this->data=$data;
		$this->title=$data['title'];
		$this->display();
	}
	
	//商品预订
	public function reser(){
		if(!$_POST['uname']) $this->error('姓名不能为空');
		if(!$_POST['address']) $this->error('地址不能为空');
		if(!$_POST['tel']) $this->error('电话不能为空');
		if(!$_POST['num'] && $_POST['num'] >= 1) $this->error('订购数量不能为空且要大于1');
		$pid = (int) $_POST['pid'];
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,isdis')->find();
		$price=$gata['price'];
		$msg= ($gata['isdis']) ? "政府补贴" : "暂无" ;
		$sumprice=$_POST['num']*$price;
		$h=time();
		$dh="A".date("y",time()).substr($h, -8).date("md",time());
		$data = array(
			'uid' => $_POST['uid'],
			'uname' => $_POST['uname'],
			'tel' => $_POST['tel'],
			'address' => $_POST['address'],
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => $_POST['num'],
			'sumprice' => $sumprice,
			'buytime' => $h,
			'remark' => $_POST['remark'],
			'status' => 1
		);
		
		$to="sales@hubeishunye.com";
		$title="您有新订单".$dh;
		$content="<strong>订单详细信息</strong><br />订单号:".$dh."<br />商品名称:".$gata['title']."<br />优惠活动:".$msg."<br />订购数量:".$_POST['num']."<br />单价:".$price."<br />总价：".$sumprice."<br />订购者名称:".$_POST['uname']."<br />订购者电话:".$_POST['tel']."<br />订购地址:".$_POST['address']."<br />下单时间:".date('Y-m-d H:i:s',$h)."<br />备注信息:".$_POST['remark']."<br/><br /><br/>本邮件为系统邮件，请勿回复!";
		
		SendMail($to,$title,$content);
		if(M('orders')->add($data)){
			$this->success('商品预订成功');
		}else{
			$this->error('商品预订失败');
		}
	}
	
	//放入购物车页面
	public function cart (){
		if(!session('memberid')){$this->redirect(MODULE_NAME.'/Member/index','', 3, '请先登录...');}
		$uid=session('memberid');
		$pid=(int) $_GET['id'];
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,isdis')->find();
		if($gata['isdis']){$price=$gata['memprice'];}else{$price=$gata['price'];}
		$h=time();
		$dh="A".date("y",time()).substr($h, -8).date("md",time());
		$data = array(
			'uid' => $uid,
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => 1,
			'sumprice' => $price,
			'buytime' => $h,
			'status' => 0
		);
		if(M('orders')->add($data)){
			$this->success('商品已加入购物车');
		}else{
			$this->error('加入购物车失败');
		}

	}
		
	//下单页面
	public function buy (){
		if(!session('memberid')){$this->redirect(MODULE_NAME.'/Member/index','', 3, '请先登录...');}
		$h=time();
		$dh="B".date("y",time()).substr($h, -8).date("md",time());
		$uid=session('memberid');
		$pid=(int) $_GET['id'];
		if($pid !== (int) $_POST['pid']){$this->error('参数错误');}
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,stock,isdis')->find();
		if($gata['stock']<$_POST['num']){$this->error('购买数量大于库存，请修改');}else{$num = (int) $_POST['num'];}
		if($gata['isdis']){$price=$gata['memprice'];}else{$price=$gata['price'];}
		$data = array(
			'uid' => $uid,
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => $num,
			'sumprice' => $price*$num,
			'buytime' => $h,
			'status' => 1
		);
		if(M('orders')->add($data)){
			$this->success('下单成功',U(MODULE_NAME.'/Orders/index',array('order',$dh)));
		}else{
			$this->error('下单失败');
		}
	}
	
	
}
?>