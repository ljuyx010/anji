<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class CommentController extends CommonController{
	
	public function add (){
		$nei=I('nei');
		if(!$nei){$this->ajaxReturn(array('code'=>0,'msg'=>"内容没有填写"));}
		$data=array(
		'fz' => I('fz'),
		'hfid' => I('hid'),
		'neir' => I('nei'),
		'mid' => session('memberid'),
		'time' => time()
		);
		if(M('ping')->add($data)){
			$this->ajaxReturn(array('code'=>1,'msg'=>"发布成功"));
		}else{
			$this->ajaxReturn(array('code'=>0,'msg'=>"发布失败"));
		}
	}
	
	public function cist (){
		$fz=I('fz');
		$ping=M('ping')->where(array('fz'=>$fz,'_string'=>'dis=1 or hfid <>0'))->order('id ASC')->select();
		$this->ping = Lib\Category::unlimitedForping($ping);
		$this->display();
	}
}
?>