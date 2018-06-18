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
		$cx=I('cx','',intval);
		$start=strtotime(I('start'));
		$end=strtotime(I('end'));
		$num=I('num');
		$lc=ceil(substr(I('lc'), 0, -2));//I('lc','',intval)
		$db = M("orders"); 
		$lei = array(//自动验证
	     array('uname','require','姓名必填'), 
	     array('utel','require','联系电话必填'),
	     array('gl','require','请正确选择接车地点和目的地')
		);
		$data['uname'] = I('username');
		$data['utel'] = I('tel');
		$data['gl'] = $lc;
		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}
		$gs=M('class')->field('oilj,oilh,glf,lr')->where('id='.$cx)->find();
		$where="'zt>1 and (stime >=".$start." or stime <=".$end." or dtime >=".$start." or dtime<=".$end." or (stime<".$start." and dtime>".$end."))'";
		$rs=$db->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->field('carnum,stime,dtime')->where($where)->select();
		$str="(";
		$last=count($rs)-1;
		foreach ($rs as $k => $v) {
			if($k==$last){
				$str=$str.$v['carnum'].")";
			}else{
				$str=$str.$v['carnum'].",";
			}			
		}
		$where2="'type=".$cx." and carnum not in ".$str." and ((xtime>".$start." and ktime >".$start.") or (xtime<".$start." and ktime <".$start."))'";
		$rs2=M('car')->field('carnum')->where($where2)->order('RAND()')->limit($num)->select();
		$cn=count($rs2);
		if($cn<$num){$this->error('该车型仅有'.$cn.'辆空闲，请选择'.$cn.'辆再搭配其他车型');}
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -4) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));//生成订单号
		if($end-$start){$d=round(($end-$start)/3600/24);}else{$d=1;}
		$money=(($gs['oilj']*$gs['oilh']+$gs['glf'])+$num*0.43)*$lc+$gs['lr']*$d;		
		$data = array(
			'ordernum' => $orderSn,
			'edr' => I('edr'),
			'money' => $money,
			'dtime' => $end,
			'stime' => $start,
			'ordtime' => time(),
			'utype' => I('dw'),
			'num' => $num,
			'title' => I('title'),
			'des' => I('des'),
			'cid' => $cx,
			'zt' => 1,
			'type' => 1,
			'uid' => session('userID'),
			'sdr' => I('sdr')
		);
		foreach ($rs2 as $ke => $va) {
			$rs2[$ke]['ordernum']=$orderSn;
		}
		$jg=$db->add($data);
		$jg2=M('ordcar')->addAll($rs2);

		if($jg&&$jg2){
			$this->success('下单成功',U('Weixinpay/pay',array('out_trade_no'=>$orderSn)));
		}else{
			$this->error('下单失败，请稍后再试');
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