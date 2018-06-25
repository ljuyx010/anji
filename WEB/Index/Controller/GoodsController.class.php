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
		$ora=I('ora','',intval);
		$lc=ceil(substr(I('lc'), 0, -2));//I('lc','',intval)
		$db = M("orders"); 
		$lei = array(//自动验证
	     array('uname','require','姓名必填'), 
	     array('utel','require','联系电话必填'),
	     array('gl','require','请正确选择接车地点和目的地')
		);

		$gs=M('class')->field('oilj,oilh,glf,lr')->where(array('id'=>$cx))->find();
		$where="zt>0 and (stime >=".$start." or stime <=".$end." or dtime >=".$start." or dtime<=".$end." or (stime<".$start." and dtime>".$end."))";
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
		$where2="type=".$cx.$where1." and ((xtime>=".$start." and ktime >=".$start.") or (xtime<=".$start." and ktime <=".$start."))";
		$rs2=M('car')->field('carnum')->where($where2)->order('RAND()')->limit($num)->select();
		$cn=count($rs2);
		if($cn<$num){$this->error('该车型仅有'.$cn.'辆空闲，请选择'.$cn.'辆再搭配其他车型');}
		
		if($end-$start){$d=round(($end-$start)/3600/24);}else{$d=1;}
		$money=(($gs['oilj']*$gs['oilh']+$gs['glf'])+$num*0.43)*$lc*$ora+$gs['lr']*$d;
		$money=round($money/100)*100;
		$orderSn="Y".time().rand(100,999);
		$data = array(
			'ordernum' => $orderSn,
			'uname' => I('username'),
			'utel' => I('tel'),
			'gl' => $lc,
			'edr' => I('edr'),
			'money' => $money,
			'dtime' => $end,
			'stime' => $start,
			'ordtime' => time(),
			'utype' => I('dw'),
			'num' => $num,
			'ora' => $ora,
			'title' => I('title'),
			'des' => I('des'),
			'cid' => $cx,
			'zt' => 0,
			'type' => 1,
			'uid' => session('userID'),
			'sdr' => I('sdr')
		);

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}
		foreach ($rs2 as $ke => $va) {
			$rs2[$ke]['ordernum']=$orderSn;
		}
		$jg=$db->add($data);
		$jg2=M('ordcar')->addAll($rs2);

		if($jg&&$jg2){
			$this->success('下单成功',U('Weixinpay/index',array('id'=>$orderSn)));
		}else{
			$this->error('下单失败，请稍后再试');
		}

	}	
	
	
}
?>