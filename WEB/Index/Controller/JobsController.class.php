<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class JobsController extends Controller{
	
	public function index () {

		$count = M('jobs')->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %DOWN_PAGE% %HEADER%');
		$show = $Page->show();
		$this->jobs = M('jobs')->field('id,title,time')->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}

	public function shows (){
		$id=I('id',0,intval);
		$data=M('jobs')->where(array('id'=>$id))->find();
		if(!$data){$this->error('未找到该信息');}
		$this->v=$data;
		$this->display();
	}
}
?>