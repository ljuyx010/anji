<?php
namespace Website\Controller;
use Think\Controller;

class OutfitController extends CommonController{
	
	public function index(){		
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 3 : $order="type ".$px; break; 
			case 4 : $order="time ".$px; break; 
			} 
			$where=array('del' => 0);
			if($s){$where=array_merge($where,array('name'=>array('like','%'.$s.'%')));}
			$article = M('sbei')->where($where)->order($order)->page($p,$c)->select();
			$count = M('sbei')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
			foreach ($article as $k => $v) {
				$article[$k]['times']=date('Y-m-d', $article[$k]['time']);
				if($article[$k]['dtime']>0 and $article[$k]['dtime']<time()){$article[$k]['dtimes']="已过期";}else if($article[$k]['dtime']){$article[$k]['dtimes']=date('Y-m-d', $article[$k]['dtime']);}else{$article[$k]['dtimes']="永久有效";}
			}
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function add(){
		$this->action="添加";
		$this->display();
	}

	public function runadd(){
		$db = M("sbei"); 
		$lei = array(//自动验证
	     array('name','require','名称必填'), 
	     array('jia','require','单价必填'),
	     array('time','require','购入日期必填'),
	     array('num','require','数量必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'name' => $_POST['name'],
			'jia' => $_POST['jia'],
			'num' => I('num','',intval),
			'dtime' => $_POST['dtime'] ? strtotime($_POST['dtime']) : 0,
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Outfit/index'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Outfit/add'));
		}
	}

	public function updata () {
    	$this->action="修改";
		$id= I('id');
		$v=M('sbei')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(add);
    }

    public function delete () {
		if(M('sbei')->where('id='.I('id'))->setField('del',1)){
			$this->success('删除成功！',U('Outfit/index'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function car (){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			} 
			$where=array();
			if($s){$where=array_merge($where,array('carnum'=>array('like','%'.$s.'%')));}
			$article = M('car')->join('LEFT JOIN lj_sbeic ON lj_car.carnum = lj_sbeic.carnum')->field('lj_car.id,lj_car.carnum,sum(lj_sbeic.num) as sums')->where($where)->group('lj_car.id')->order($order)->page($p,$c)->select();
			foreach ($article as $k => $v) {
				$article[$k]['zl']=M('sbeic')->join('LEFT JOIN lj_sbei ON lj_sbeic.sid = lj_sbei.id')->field('lj_sbei.name')->where(array('carnum'=>$article[$k]['carnum']))->group('sid')->select();				
			}
			$count = M('car')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function updatas (){
		$car=I('id');
		$this->car=$car;
		$this->sb=M('sbei')->field('id,name,FROM_UNIXTIME(time,"%y年%m月%d") as times')->where(array('del'=>0))->order('time desc')->select();
		$this->list=M('sbeic')->join('LEFT JOIN lj_sbei ON lj_sbeic.sid = lj_sbei.id')->field('lj_sbei.name,lj_sbei.time,lj_sbei.dtime,lj_sbei.del,lj_sbeic.id,lj_sbeic.atime,lj_sbeic.num,lj_sbeic.loss')->where(array('lj_sbeic.carnum'=>$car,'lj_sbei.del'=>0))->order('loss asc,time desc')->select();
		$this->display();
	}

	public function adds(){
	$sid=$_POST['sid'];
	$num=I('num',0,intval);	
	if($num>0){	
		if($_POST['loss']){$num=-$num;}
		$rs=M('sbeic')->add(array('carnum'=>$_POST['carnum'],'sid' =>$sid,'num'=>$num,'loss'=>$_POST['loss'],'atime'=>strtotime($_POST['time'])));
		if($rs){$cod=200;}else{$msg="数据更新失败";$cod=201;}
	}else{
		$msg="设备数量不能小于等于0";
		$cod=202;
	}
	$this->ajaxReturn(array('cod'=>$cod,'msg'=>$msg));
	}

	public function deletes (){
		$id=I('id');
		$car=I('carnum');
		if(M('sbeic')->where(array('id'=>$id,'carnum'=>$car))->delete()){
			$this->success('删除成功！',U('Outfit/updatas',array('id' =>$car)));
		}else{
			$this->error('删除失败！');
		}
	}

}
?>