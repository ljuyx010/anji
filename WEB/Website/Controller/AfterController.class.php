<?php
namespace Website\Controller;
use Think\Controller;

class AfterController extends CommonController{
	
	public function tousu(){		
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
			case 4 : $order="times ".$px; break; 
			} 
			$where=array();
			if($s){$where=array('people'=>array('like','%'.$s.'%'));}
			$article = M('bad')->field('id,people,carnum,type,FROM_UNIXTIME(time,"%Y-%m-%d") as times')->where($where)->order($order)->page($p,$c)->select();
			$count = M('bad')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addt(){
		$this->action="添加";
		$this->display();
	}

	public function runaddt(){
		$db = M("bad"); 
		$lei = array(//自动验证
	     array('people','require','名称必填'), 
	     array('type','require','类型必填'),
	     array('time','require','时间必填'),
	     array('mark','require','事由必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'people' => $_POST['people'],
			'type' => I('type'),
			'mark' => $_POST['mark'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/tousu'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/tousu'));
		}
	}

	public function updatat () {
    	$this->action="修改";
		$id= I('id');
		$v=M('bad')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addt);
    }

    public function deletet () {
		if(M('bad')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/tousu'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function safe(){		
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 4 : $order="times ".$px; break; 
			}
			$where=array();
			if($s){$where['people']=array('like','%'.$s.'%');$where['adress']=array('like','%'.$s.'%');$where['_logic']='or';}
			$article = M('shigu')->field('id,people,carnum,adress,FROM_UNIXTIME(time,"%Y-%m-%d") as times')->where($where)->order($order)->page($p,$c)->select();
			$count = M('shigu')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function adds(){
		$this->action="添加";
		$this->display();
	}

	public function runadds(){
		$db = M("shigu"); 
		$lei = array(//自动验证
	     array('people','require','责任人必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','时间必填'),
	     array('adress','require','地点必填'),
	     array('content','require','事发经过必填'),
	     array('end','require','处理结果必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'people' => $_POST['people'],
			'adress' => I('adress'),
			'content' => $_POST['content'],
			'end' => $_POST['end'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/safe'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/safe'));
		}
	}

	public function updatas () {
    	$this->action="修改";
		$id= I('id');
		$v=M('shigu')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(adds);
    }

    public function deletes () {
		if(M('shigu')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/safe'));
		}else{
			$this->error('删除失败！');
		}
	}

	//年审
	public function nianshen(){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 2 : $order="type ".$px; break; 
			case 3 : $order="time ".$px; break; 
			case 4 : $order="dtime ".$px; break; 
			} 
			$where=array();
			if($s){$where['carnum']=array('like','%'.$s.'%');}
			$article = M('shen')->field('money',true)->where($where)->order($order)->page($p,$c)->select();
			$count = M('shen')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
			foreach ($article as $k => $v) {
				$article[$k]['times']=date('Y-m-d', $article[$k]['time']);
				if($article[$k]['type']==0){$article[$k]['type']="保险";}else if($article[$k]['type']==1){$article[$k]['type']="营运证";}else{$article[$k]['type']="行车证";}
				if($article[$k]['dtime']<time()){$article[$k]['dtimes']="已过期";}else{$article[$k]['dtimes']=date('Y-m-d', $article[$k]['dtime']);}
			}
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addn(){
		$this->action="添加";
		$this->display();
	}

	public function runaddn(){
		$db = M("shen"); 
		$lei = array(//自动验证
	     array('type','require','类型必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','办理时间必填'),
	     array('dtime','require','过期时间必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'type' => $_POST['type'],
			'money' => I('money'),
			'mark' => $_POST['mark'],
			'dtime' => strtotime($_POST['dtime']),
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/nianshen'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/nianshen'));
		}
	}

	public function updatan () {
    	$this->action="修改";
		$id= I('id');
		$v=M('shen')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addn);
    }

    public function deleten () {
		if(M('shen')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/nianshen'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function weixiu(){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 2 : $order="type ".$px; break; 
			case 3 : $order="rq ".$px; break; 
			case 4 : $order="hours ".$px; break; 
			case 5 : $order="money ".$px; break; 
			} 
			$where=array();
			if($s){$where['carnum']=array('like','%'.$s.'%');}
			$article = M('xiu')->field('id,carnum,type,hours,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as rq,money')->where($where)->order($order)->page($p,$c)->select();
			$count = M('xiu')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addw(){
		$this->action="添加";
		$this->display();
	}

	public function runaddw(){
		$db = M("xiu"); 
		$lei = array(//自动验证
	     array('type','require','类型必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','办理时间必填'),
	     array('money','require','金额必填'),
	     array('hours','require','工时必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'type' => $_POST['type'],
			'money' => I('money'),
			'content' => $_POST['content'],
			'hours' => $_POST['hours'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($res=$db->save($data)) $this->success('保存成功！',U('After/weixiu'));
		}else{
			if($res=$db->add($data)) $this->success('添加成功！',U('After/weixiu'));
		}
		if($res){
			$ktime=strtotime($_POST['time']." +".$_POST['hours']." hours");
			$car = array('xtime'=>strtotime($_POST['time']),'ktime'=>$ktime);
			M('car')->where(array('carnum'=>$_POST['carnum']))->setField($car);
		}
	}

	public function updataw () {
    	$this->action="修改";
		$id= I('id');
		$v=M('xiu')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addw);
    }

    public function deletew () {
		if(M('xiu')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/weixiu'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function dingd (){
		M('orders')->
	}


}
?>