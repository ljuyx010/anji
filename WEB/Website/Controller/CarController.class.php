<?php
namespace Website\Controller;
use Think\Controller;

/**
 * 文章管理控制器
 */
class CarController extends CommonController {

	public function index(){
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
		case 4 : $order="type ".$px; break; 
		} 
		$where=array('lj_car.id'=>array('gt',0));
		if($s){$where=array_merge($where,array('lj_car.carnum'=>array('like','%'.$s.'%')));}
		$article = M('car')->join('LEFT JOIN lj_class ON lj_car.type = lj_class.id')->field('lj_car.*,lj_class.classname as classname')->where($where)->order($order)->page($p,$c)->select();
		$count = M('car')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function addcar (){
		$this->action="添加";
		$this->class=M('class')->field('id,classname')->order('id asc')->select();
		$this->display();
	}
	
	public function runaddcar(){
		$db = M("car"); 		
		$gz = array(//自动验证
	     array('carnum','require','车牌号必填'), 
	     array('driver','require','司机名称必填'),
	     array('type','require','车型必填'),
	     array('tel','require','司机手机必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'driver' => $_POST['driver'],
			'type' => I('type','',intval),
			'tel' => I('tel')
		 );

		if (!$db->validate($gz)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Car/index'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Car/addcar'));
		}
	     
	}

	public function editcar (){
		$this->action="修改";
		$this->class=M('class')->field('id,classname')->order('id asc')->select();
		$id= I('id');
		$v=M('car')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addcar);
	}

	public function delcar (){
		if(M('car')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Car/index'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function classtype(){		
		$count=M('class')->count();
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$classtype = M('class')->field('content',true)->order('sort asc,id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->classtype=$classtype;
		$this->display();
	}

	public function addtype(){
		$this->action="添加";
		$this->display();
	}

	public function runadd(){
		$db = M("class"); 
		$lei = array(//自动验证
	     array('title','require','名称必填'), 
	     array('classname','require','座位数必填'),
	     array('oilj','require','油价参数必填'),
	     array('oilh','require','油耗参数必填'),
	     array('glf','require','过路费参数必填'),
	     array('lr','require','利润参数必填'),
		);
		$data = array(
			'id' => $_POST['id'],
			'title' => $_POST['title'],
			'classname' => $_POST['classname'],
			'sort' => I('sort','100',intval),
			'tj' => I('tj','0',intval),
			'oilj' => I('oilj'),
			'oilh' => I('oilh'),
			'glf' => I('glf'),
			'lr' => I('lr'),
			'pics' => implode("|",$_POST['pics']),
			'content' => $_POST['content']
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Car/classtype'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Car/addtype'));
		}
	     
	}

	public function edit (){
		$this->action="修改";
		$id= I('id');
		$v=M('class')->where('id='.$id)->find();
		$this->v=$v;
		$this->pics=explode('|', $v['pics']);
		$this->display(addtype);
	}

	public function delete (){
		if(M('class')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Car/classtype'));
		}else{
			$this->error('删除失败！');
		}
	}

}
?>