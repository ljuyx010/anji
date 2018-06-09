<?php
namespace Lib;
defined('THINK_PATH') or exit();

Class Cate{

	static public function catetkd($id){
		$cate = M('cate')->where(array('id'=>$id))->select();
		return $cate;
	}
}
?>
