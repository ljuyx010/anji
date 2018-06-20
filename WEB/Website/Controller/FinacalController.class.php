<?php
namespace Website\Controller;
use Think\Controller;

class FinacalController extends CommonController{
	
	public function index (){
		$this->display();
	}

	public function etc (){
		$this->display();
	}

	public function fpage (){
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 0 : $order="id ".$px; break; 
		case 1 : $order="carnum ".$px; break; 
		case 3 : $order="money ".$px; break; 
		case 4 : $order="times ".$px; break; 
		} 
		$where=array();
		if($s){$where=array('siji'=>array('like','%'.$s.'%'));}
		$article = M('etc')->field('id,siji,carnum,money,FROM_UNIXTIME(time,"%Y-%m-%d") as times')->where($where)->order($order)->page($p,$c)->select();
		$count = M('etc')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function add (){
		$this->action="添加";
		$this->display();
	}

	public function getu (){
		$name=$_POST['name'];
		$carnum=M('car')->where(array('driver'=>$name))->getField('carnum');
		$this->ajaxReturn($carnum);
	}

	public function runadd (){
		$db = M("etc"); 
		$lei = array(//自动验证
	     array('siji','require','司机名称必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','时间必填'),
	     array('money','require','金额必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'siji' => $_POST['siji'],
			'money' => I('money'),
			'mark' => $_POST['mark'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Finacal/etc'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Finacal/add'));
		}
	}

	public function updata () {
    	$this->action="修改";
		$id= I('id');
		$v=M('etc')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(add);
    }

    public function delete () {
		if(M('etc')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Finacal/etc'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function gz(){
		$f=strtotime(date("Y-m-01"));
		$c=date('Y-m-d',$f);
		$l=strtotime("$c +1 month -1 day");
		$where=array('dtime'=>array('between',array($f,$l)),'zt'=>3);
		$data=M('ordcar')->join('LEFT JOIN lj_orders on lj_ordcar.ordernum=lj_orders.ordernum')
		->join('lj_car on lj_ordcar.carnum=lj_car.carnum')->field('lj_ordcar.carnum,driver,SUM(wage) as tc,Count(lj_ordcar.carnum) as ds')
		->where($where)->group('lj_ordcar.carnum')->select();
		$this->tc=$data;
		$this->display();
	}

	public function gzxq(){
		$id=I('id');
		$f=strtotime(date("Y-m-01"));
		$c=date('Y-m-d',$f);
		$l=strtotime("$c +1 month -1 day");
		$where=array('dtime'=>array('between',array($f,$l)),'zt'=>3,'lj_ordcar.carnum'=>$id);
		$xq=M('ordcar')->join('LEFT JOIN lj_orders on lj_ordcar.ordernum=lj_orders.ordernum')->field('lj_ordcar.ordernum,edr,type,stime,wage')
		->where($where)->select();
		$sum = 0;  
		foreach($xq as $v){  
		  $sum += (int) $v['wage'];  
		}
		$this->sum=$sum;
		$this->id=$id;
		$this->xq=$xq;
		$this->display();
	}

	public function ajax(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('etc')->field('Sum(money) as et,FROM_UNIXTIME(time,"%m月") as m')->where(array('time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}


}
?>