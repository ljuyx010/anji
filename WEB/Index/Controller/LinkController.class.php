<?php
namespace Index\Controller;
use Think\Controller;
//页面跳转控制器
class LinkController extends Controller{
	//转向链接
	public function index (){

		$id = I('id','',intval);
	    $cate = Index\Cate::catetkd($id);
	    $link = $cate['link'];
	    redirect($link);
	}

}
?>