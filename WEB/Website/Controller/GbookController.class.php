<?php
namespace Website\Controller;
use Think\Controller;

class GbookController extends CommonController{

	public function index () {
		$id = I('id','',intval);
		$this->cate=M('cate')->where(array('id'=>$id))->field('name')->find();
		$this->id = $id;
		$this->display();
	}
	
	public function fpage(){
		$id = I('id','',intval);
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 0 : $order="id ".$px; break; 
		case 2 : $order="times ".$px; break; 
		} 
		$where = array('cid'=>$id);
		if($s){$where=array_merge($where,array('title'=>array('like','%'.$s.'%')));}
		$article = M('gbook')->field(array('id','reuser','title','FROM_UNIXTIME(time,"%Y-%m-%d %H:%i")' =>'times'))->where($where)->order($order)->page($p,$c)->select();
		$count = M('gbook')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}
	
	//查看回复留言
	public function replay () {
		$id = I('id','',intval);
		$cid = I('cid','',intval);
		$this->cid=$cid;
		$this->cate=M('cate')->where(array('id'=>$cid))->field('name')->find();
		$this->gbook = M('gbook')->where(array('id'=>$id))->select();
		$this->display();
	}

	public function runUpdata () {
		$id = I('id','',intval);
		$cid = I('cid','',intval);
		$data = array(
			'retime' => time(),
			'reuser' => session('username'),
			'reply' => I('reply')
			);
		if (M('gbook')->where('id ='.$id)->save($data)){
			$this->success('回复成功',U(MODULE_NAME.'/Gbook/index',array('id'=>$cid)));
		}else{
			$this->error('回复失败');
		}
	}

	public function delete () {
		$id = I('id','',intval);
		$cid = I('cid','',intval);
		if (M('gbook')->where('id ='.$id)->delete()){
			$this->success('删除成功',U(MODULE_NAME.'/Gbook/index',array('id'=>$cid)));
		}else{
			$this->error('删除失败');
		}
	}
}
?>