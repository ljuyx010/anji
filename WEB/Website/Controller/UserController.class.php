<?php
namespace Website\Controller;
use Think\Controller;
//会员管理控制器
class UserController extends CommonController{
	//会员管理视图
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
		case 3 : $order="regtime ".$px; break; 
		} 
		if($s){$where=array('nickname'=>array('like','%'.$s.'%'));}
		$article = M('user')->field('id,name,photo,nickname,FROM_UNIXTIME(regtime,"%Y-%m-%d %H:%i") as rtime')->where($where)->order($order)->page($p,$c)->select();
		$count = M('user')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function edit () {
		$id = I('id','',intval);
		$this->v = M('user')->where(array('id'=>$id))->find();
		$this->order=M('orders')->where(array('uid'=>$id))->select();
		$this->display();		
	}

	public function runUpdata () {
		$id = I('id','',intval);
		$mark = I('mark');

		if (M('user')->where(array('id'=>$id))->setField('mark',$mark)){
			$this->success('保存成功',U('User/edit',array('id'=>$id)));
		}else{
			$this->error('保存失败');
		}

	}

}
?>