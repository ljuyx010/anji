<?php
namespace Website\Controller;
use Think\Controller;
//会员管理控制器
class OrdersController extends CommonController{
	//会员管理视图
	public function index () {
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
		case 0 : $order="ordernum ".$px; break; 
		case 3 : $order="money ".$px; break; 
		case 4 : $order="ordtime ".$px; break; 
		}
		if($id){$where = array('uid'=>array('exp','is not null'));}else{$where =array('uid'=>array('exp','is null'));} 		
		if($s){$where=array_merge($where,array('ordernum'=>array('like','%'.$s.'%')));}
		$article = M('orders')->field('id,title,ordernum,num,money,zt,FROM_UNIXTIME(ordtime,"%Y-%m-%d %H:%i") as times')->where($where)->order($order)->page($p,$c)->select();
		//echo M('orders')->getLastSql();
		$count = M('orders')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function edit() {
		$id = I('id','',intval);
		$orders = M('orders')->jion('LEFT JOIN lj_user on lj_orders.uid==lj_user.id')->field('lj_orders.*,lj_user.nickname,lj_user.photo')->where(array('id'=>$id))->find();
		$this->carnum=M('ordcar')->field('id,carnum')->where(array('ordernum'=>$orders['ordernum']))->select();
		$this->orders = $orders;
		$this->display();		
	}

	public function runedit(){
		$id=I('id','',intval);
		$data=array(
			'uname'=>I('uname'),
			'utel'=>I('utel'),
			'money'=>I('money'),
			'num'=>I('num'),
			'mark'=>I('mark'),
			'gl'=>I('gl')
		);
		$rs=M('orders')->where('id='.$id)->save($data);
		foreach ($_POST['car'] as $k => $v) {
			M('ordcar')->where('id='.$k)->setField('carnum',$v);
		}
		if($rs){$this->success('保存成功',U('Orders/index'));}else{$this->error('保存失败');}
	}
	
	public function sendmail (){
		$dh = I('dh');
		
	}

	public function xianx (){
		$this->display();
	}

	public function add (){
		$this->action="添加";
		$this->class=M('class')->field('id,classname')->select();
		$this->display();
	}

	public function runaddx(){
		$cx=I('type','',intval);
		$id=I('id','',intval);
		$start=strtotime(I('stime'));
		$end=strtotime(I('dtime'));
		$num=I('num');
		$ora=I('ora','',intval);
		$lc=ceil(substr(I('gl'), 0, -2));//I('lc','',intval)
		$db = M("orders"); 
		$lei = array(//自动验证
	     array('username','require','姓名必填'), 
	     array('utel','require','联系电话必填'),
	     array('gl','require','请正确选择接车地点和目的地')
		);
		
		$gs=M('class')->field('classname,title,oilj,oilh,glf,lr')->where('id='.$cx)->find();
		if(!$id){
			$where="zt>1 and (stime >=".$start." or stime <=".$end." or dtime >=".$start." or dtime<=".$end." or (stime<".$start." and dtime>".$end."))";
			$rs=$db->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->field('carnum,stime,dtime')->where($where)->select();
			if($rs){
				$str="(";
				$last=count($rs)-1;
				foreach ($rs as $k => $v) {
					if($k==$last){
						$str=$str.$v['carnum'].")";
					}else{
						$str=$str.$v['carnum'].",";
					}			
				}
				$where1=" and carnum not in".$str;
			}
			$where2="type=".$cx.$where1." and ((xtime>".$start." and ktime >".$start.") or (xtime<".$start." and ktime <".$start."))";
			$rs2=M('car')->field('carnum')->where($where2)->order('RAND()')->limit($num)->select();
			$cn=count($rs2);
			if($cn<$num){$this->error('该车型仅有'.$cn.'辆空闲，请选择'.$cn.'辆再搭配其他车型');}
		}	
		if($_POST['ordernum']){$orderSn = $_POST['ordernum'];}else{$orderSn = date('Ymd').substr(time(), -4);}//生成订单号
		if($end-$start){$d=round(($end-$start)/3600/24);}else{$d=1;}
		if(I('money')){
			$money=I('money');
		}else{
			$money=(($gs['oilj']*$gs['oilh']+$gs['glf'])+$num*0.43)*$lc*$ora+$gs['lr']*$d;
			$money=round($money/100)*100;
		}
		$data = array(
			'ordernum' => $orderSn,
			'uname' => I('uname'),
			'utel' => I('utel'),
			'gl' => $lc,
			'edr' => I('edr'),
			'money' => $money,
			'dtime' => $end,
			'stime' => $start,
			'ordtime' => time(),
			'utype' => I('utype'),
			'num' => $num,
			'ora' => $ora,
			'title' => $gs['classname'],
			'des' => $gs['title'],
			'cid' => $cx,
			'zt' => I('zt'),
			'type' => 0,
			'mark' => I('mark'),
			'sdr' => I('sdr')
		);

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}
		
		if($id){
			$jg=$db->where('id='.$id)->save($data);
			foreach ($_POST['car'] as $ko => $vo) {
			  M('ordcar')->where('id='.$ko)->setField('carnum',$vo);
			}
		}else{
			foreach ($rs2 as $ke => $va) {
			$rs2[$ke]['ordernum']=$orderSn;
			}
			$jg=$db->add($data);
			M('ordcar')->addAll($rs2);
		}
		

		if($jg){
			$this->success('保存成功',U('Orders/xianx'));
		}else{
			$this->error('保存失败');
		}
	}

	public function editx() {
		$id = I('id','',intval);
		$orders = M('orders')->where(array('id'=>$id))->find();
		$this->class=M('class')->field('id,classname')->select();
		$this->carnum=M('ordcar')->field('id,carnum')->where(array('ordernum'=>$orders['ordernum']))->select();
		$this->orders = $orders;
		$this->action="修改";
		$this->display(add);		
	}

	public function del(){
		$id=I('id','',intval);
		$where=array('id'=>$id);
		$rs=M('orders')->field('ordernum')->where($where)->find();
		if(M('orders')->where($where)->delete()){
			M('ordcar')->where(array('ordernum'=>$rs['ordernum']))->delete();
			$this->success('订单已删除',U('Orders/xianx'));
		}else{
			$this->error('订单删除失败');
		}
	}

	public function ajax(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('orders')->field('Count(id) as dd,Sum(money) as je,FROM_UNIXTIME(stime,"%m月") as m')->where(array('zt'=>3,'stime'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}

}
?>