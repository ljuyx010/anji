<?php
namespace Website\Controller;
use Think\Controller;

Class AdminController extends CommonController{
	
	public function user()
	{
		# code...
	}

	public function rule (){
		$this->rule=M('auth_rule')->order('sort asc,id asc')->select();
		$this->display();
	}
}
?>