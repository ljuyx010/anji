<?php
namespace Website\Controller;
use Think\Controller;

class JobsController extends CommonController{

	public function index () {
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
		case 2 : $order="times ".$px; break; 
		case 3 : $order="qty ".$px; break; 
		} 
		$where = array();
		if($s){$where=array_merge($where,array('title'=>array('like','%'.$s.'%')));}
		$article = M('jobs')->field(array('id','jobname','title','qty','FROM_UNIXTIME(time,"%Y-%m-%d %H:%i")' =>'times'))->where($where)->order($order)->page($p,$c)->select();
		$count = M('jobs')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function add () {
		$this->action="添加";
		$this->display();
	}

	public function runadd () {		
		$db = M("jobs"); 
		$lei = array(//自动验证
	     array('title','require','标题必填'), 
	     array('jobname','require','职位必填'),
	     array('time','require','发布日期必填'),
	     array('useful','require','有效期必填'),
	     array('qty','require','招聘人数必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'title' => $_POST['title'],
    		'jobname' => $_POST['jobname'],
    		'jobadd' => $_POST['jobadd'],
    		'qty' => $_POST['qty'],
    		'salary' =>$_POST['salary'],
    		'time' => $_POST['time'] ? strtotime($_POST['time']) : time(),
    		'cid' => (int) $_POST['cid'],
    		'useful' => $_POST['useful'],
			'content' => $_POST['content']
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Jobs/index'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Jobs/add'));
		}
	}

	public function edit () {
		$id = I('id','',intval);
		$this->action="修改";
		$this->v = M('jobs')->where(array('id'=>$id))->find();
		$this->display(add);
	}


	public function delete () {
		$id = I('id','',intval);
		if (M('jobs')->where(array('id'=>$id))->delete()){
			$this->success('删除成功',U('Jobs/index'));
		}else{
			$this->error('删除失败');
		}
	}
}
?>