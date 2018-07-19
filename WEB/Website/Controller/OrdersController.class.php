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
		case 5 : $order="money ".$px; break; 
		case 6 : $order="ordtime ".$px; break; 
		case 7 : $order="stime ".$px; break; 
		case 8 : $order="isf ".$px; break; 
		case 9 : $order="wk ".$px; break; 
		}
		if($id){$where = array('uid'=>array('exp','is not null'));}else{$where =array('uid'=>array('exp','is null'));} 		
		if($s){$where=array_merge($where,array('ordernum'=>array('like','%'.$s.'%')));}
		$article = M('orders')->field('id,title,uname,gname,edr,ordernum,num,money,zt,FROM_UNIXTIME(ordtime,"%Y-%m-%d %H:%i") as times,FROM_UNIXTIME(stime,"%Y-%m-%d") as timec,wk,isf')->where($where)->order($order)->page($p,$c)->select();
		//echo M('orders')->getLastSql();
		$count = M('orders')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function edit() {
		$id = I('id','',intval);
		$orders = M('orders')->join('LEFT JOIN lj_user on lj_orders.uid=lj_user.id')->field('lj_orders.*,lj_user.nickname,lj_user.photo')->where(array('lj_orders.id'=>$id))->find();
		$this->carnum=M('ordcar')->field('id,carnum,driver,tel,fuzhu,ftel')->where(array('ordernum'=>$orders['ordernum']))->select();
		$this->orders = $orders;
		$this->display();		
	}

	public function runedit(){
		$id=I('id','',intval);
		$cx=I('cid','',intval);
		$stime=strtotime(I('stime'));
		$dtime=strtotime(I('dtime'));
		$ord=M('orders')->field('stime,dtime,ora')->find();
		$gs=M('class')->field('classname,title,oilj,oilh,glf,lr')->where('id='.$cx)->find();
		$d=round(($dtime-$stime)/3600/24);
		if(!$d){$d=1;}
		$data=array(
			'uname'=>I('uname'),
			'utel'=>I('utel'),
			'gname' => I('gname'),
			'stime'=>$stime,
			'dtime'=>$dtime,
			'money'=>I('money'),
			'wk'=>I('wk'),
			'num'=>I('num'),
			'mark'=>I('mark'),
			'fap'=>I('fap'),
			'gl'=>I('gl')
		);
		if($_POST['zt']==0 and I('money')){
			$data['money']=I('money');
		}
		if($_POST['zt']==0 and !I('money')){
			$money=(($gs['oilj']*$gs['oilh']+$gs['glf'])+I('num')*0.43)*I('gl')*$ord['ora']+$gs['lr']*$d;
			$data['money']=round($money/100)*100;
		}
		$rs=M('orders')->where('id='.$id)->save($data);
		foreach ($_POST['car'] as $k => $v) {
			$rs2=M('ordcar')->where('id='.$k)->save($v);
		}
		if($rs||$rs2){$this->success('保存成功',U('Orders/index'));}else{$this->error('保存失败');}
	}
	
	public function sendmail (){
		$dh = I('dh');
		$send=A('Dxin');
		$rs=M('orders')->field('ordernum,uname,utel,stime,sdr,dtime,edr,ora,mark')->where(array('ordernum'=>$dh))->find();
		$rs2=M('ordcar')->field('carnum,driver,tel,fuzhu,ftel')->where(array('ordernum'=>$dh))->select();
		if($rs['ora']==1){$song="只送";}else{$song="往返";}
		$da=array('dh'=>$rs['ordernum'],'name'=>$rs['uname'],'tel'=>$rs['utel'],'stime'=>date('Y-m-d',$v['stime']),'sdr'=>$v['sdr'].",".$song,'dtime'=>date('Y-m-d',$v['dtime']),'edr'=>$v['edr']."备注:".$rs['mark']);
		$str="";
		foreach ($rs2 as $k => $v) {
			if(!$k){
				$carnum=$v['carnum'];$name=$v['driver'].",电话：".$v['tel'];
			}else{
				$name=$name.",车牌号：".$v['carnum']."姓名：".$v['driver']."电话：".$v['tel'];
			}
			if($v['ftel']){
				$js=$send->sendMsg($v['ftel'],'SMS_137673377',$da);
			}
			$js=$send->sendMsg($v['tel'],'SMS_137673377',$da);
			if($js){
				$str=$str."<br>司机：".$v['driver']."短信发送成功";
			}else{
				$str=$str."<br>司机：".$v['driver']."短信发送失败";
			}
		}
		$kh=array('name'=>$rs['uname'],'dh'=>$rs['ordernum'],'carnum'=>$carnum,'sdr'=>$rs['sdr'],'edr'=>$rs['edr'],'siji'=>$name);				
		$jg2=$send->sendMsg($rs['utel'],'SMS_138078328',$kh);
		if($jg2){
			$str=$str."<br>用户：".$rs['uname']."短信发送失败";
			M('orders')->where('ordernum='.$rs['ordernum'])->setField('zt',2);
		}else{
			$str=$str."<br>用户：".$rs['uname']."短信发送失败";
		}
		$this->ajaxReturn(array('code'=>200,'str'=>$str));
	}

	public function tk(){
		$dh=I('dh');
		Vendor('Weixinpay.Weixinpay');
		$wxpay=new \Weixinpay();		
		$data=$wxpay->refund($dh);

		if($data['info']['result_code']=="SUCCESS"){
			M('orders')->where('ordernum='.$dh)->save(array('refund_no'=>$data['refund_id'],'zt'=>-2,'backtime'=>time()));
			$this->success('退款已成功提交',U('Orders/index'));
		}else{
			if($data['info']['err_code_des']){
				$msg=$data['info']['err_code_des'];
			}else{
				$msg=$data['info']['return_msg'];
			}			
			$this->error($msg);
		}
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
		if($id){
			$lc=I('gl','',intval);
		}else{
			$lc=ceil(substr(I('gl'), 0, -2));
		}
		$db = M("orders"); 
		$lei = array(//自动验证
	     array('username','require','姓名必填'), 
	     array('utel','require','联系电话必填'),
	     array('gl','require','请正确选择接车地点和目的地')
		);
		
		$gs=M('class')->field('classname,title,oilj,oilh,glf,lr')->where('id='.$cx)->find();
		if(!$id){
			$where="zt>0 and (stime >=".$start." or stime <=".$end." or dtime >=".$start." or dtime<=".$end." or (stime<".$start." and dtime>".$end."))";
			$rs=$db->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->field('carnum,stime,dtime')->where($where)->select();
			if($rs){
				$str="(";
				$last=count($rs)-1;
				foreach ($rs as $k => $v) {
					if($k==$last){
						$str=$str."'".$v['carnum']."')";
					}else{
						$str=$str."'".$v['carnum']."',";
					}			
				}
				$where1=" and carnum not in".$str;
			}
			$where2="type=".$cx.$where1." and ((xtime>=".$start." and ktime >=".$start.") or (xtime<=".$start." and ktime <=".$start."))";
			$rs2=M('car')->field('carnum,driver,tel')->where($where2)->order('RAND()')->limit($num)->select();
			$cn=count($rs2);
			if($cn<$num){$this->error('该车型仅有'.$cn.'辆空闲，请选择'.$cn.'辆再搭配其他车型');}
		}	
		if($_POST['ordernum']){$orderSn = $_POST['ordernum'];}else{$orderSn = date('Ymd').substr(time(), -4);}//生成订单号
		if(($end-$start)>3600*24){$d=round(($end-$start)/3600/24);}else{$d=1;}
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
			'gname' => I('gname'),
			'gl' => $lc,
			'edr' => I('edr'),
			'money' => $money,
			'wk' => I('wk'),
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
			'fap' => I('fap'),
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
			  M('ordcar')->where('id='.$ko)->save($vo);
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
		$this->carnum=M('ordcar')->field('id,carnum,driver,tel,fuzhu,ftel')->where(array('ordernum'=>$orders['ordernum']))->select();
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

	public function wk(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('orders')->field('Count(id) as dd,Sum(wk) as w,FROM_UNIXTIME(stime,"%m月") as m')->where(array('wk'=>array('gt',0)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}

	public function tongji(){
		if (IS_POST) {
			$s=strtotime($_POST['start']);
			$d=strtotime($_POST['end']);
			if(($d-$s)>30*24*60*60){$this->error('查询范围不能超过30天');}
			$where=array('stime'=>array('between',array($s,$d)));
			$data=M('orders')->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->where($where)->order('stime desc')->select();
			//echo M('orders')->getLastSql();
			$this->s=$s;
			$this->d=$d;
			$this->orders=$data;
		}
		$this->display();
	}

	public function excel(){
		if(!I('s') || !I('d')){
			$this->error('请选择起止日期');
		}
		$where=array('stime'=>array('between',array(I('s'),I('d'))));
		$data=M('orders')->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')
		->field('lj_orders.ordernum,uname,gname,utel,FROM_UNIXTIME(stime,"%Y-%m-%d %H:%i") as s,sdr,FROM_UNIXTIME(dtime,"%Y-%m-%d %H:%i") as d,edr,ora,FROM_UNIXTIME(ordtime,"%Y-%m-%d %H:%i") as o,title,carnum,siji,stel,money,wk,mark')
		->where($where)->order('stime desc')->select();
		$t[0]=array('订单号','客户姓名','公司名称','客户电话','发车时间','发车地点','返程时间','返程地点','单/往返','下单时间','车型','车牌号','司机姓名','司机电话','费用','尾款','备注');
		$data=array_merge($t,$data);
		$n=date('Ymd').".xls";
		create_xls($data,$n);
	}

	public function zhid(){
		$car=I('car');
		$this->car=M('car')->field('id,driver,tel,carnum')->where(array('carnum'=>$car))->find();
		$this->display();
	}

	public function runzhid(){
		$lei = array(//自动验证
	     array('username','require','姓名必填'), 
	     array('utel','require','联系电话必填'),
	     array('money','require','订单金额必填'),
	     array('gl','require','请正确选择接车地点和目的地')
		);
		$start=strtotime(I('stime'));
		$end=strtotime(I('dtime'));
		$lc=ceil(substr(I('gl'), 0, -2));
		$orderSn = date('Ymd').substr(time(), -4);
		$car=I('carnum');
		$type=M('car')->where(array('carnum'=>$car))->getField('type');
		$gs=M('class')->field('id,classname,title')->where(array('id'=>$type))->find();
		$data = array(
			'ordernum' => $orderSn,
			'uname' => I('uname'),
			'utel' => I('utel'),
			'gl' => $lc,
			'edr' => I('edr'),
			'money' => I('money'),
			'wk' => I('wk'),
			'dtime' => $end,
			'stime' => $start,
			'ordtime' => time(),
			'utype' => I('utype'),
			'num' => 1,
			'ora' => I('ora','',intval),
			'title' => $gs['classname'],
			'des' => $gs['title'],
			'cid' => $gs['id'],
			'zt' => I('zt'),
			'type' => 0,
			'fap' => I('fap'),
			'mark' => I('mark'),
			'sdr' => I('sdr')
		);
		$data2=array(
			'ordernum'=> $orderSn,
			'carnum' => I('carnum'),
			'driver' => I('driver'),
			'tel' => I('tel'),
			'fuzhu' => I('fuzhu'),
			'ftel' => I('ftel')
		);
		$db=M('orders');
		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}
		if($db->add($data) && M('ordcar')->add($data2)){
			$this->success('任务添加成功',U('Orders/xianx'));
		}else{
			$this->error('任务添加失败');
		}

	}

}
?>