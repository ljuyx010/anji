<?php
namespace Website\Controller;
use Think\Controller;

Class CacheController extends CommonController{

	public function index () {
		 $cachedir=APP_PATH."/Html/";   //Cache文件的路径
		   if ($dh = opendir($cachedir)) {     //打开App/Html文件夹
		      while (($file = readdir($dh)) !== false) {    //遍历Cache目录
		                unlink($cachedir.$file);                //删除遍历到的每一个文件；
		      }
		      closedir($dh);
		   }
		   $this->success('清理更新成功',U(MODULE_NAME.'/Index/Index'));
	}

	public function temp () {
		$cache=APP_PATH."/Runtime/Cache/";
		 if ($dch = opendir($cache)) {     //打开App/Runtime/Cache文件夹
		      while (($file = readdir($dch)) !== false) {    //遍历Cache目录
		                unlink($cache.$file);                //删除遍历到的每一个文件；
		      }
		      closedir($dch);
		    }
		$this->success('模板重载成功',U(MODULE_NAME.'/Index/Index'));
	}
}
?>