<?php
namespace Website\Widget;
use Think\Controller;
use Lib;

class MenuWidget extends Controller{
	
	//栏目主菜单
    public function mau () {
        $cate = M('cate')->order('sort ASC,id ASC')->field('id,pid,name,model')->select();
        $this->cate = Lib\Category::unlimitedForlevel($cate,'&nbsp;');
		$this->display('Menu:mau');
	}
}
?>