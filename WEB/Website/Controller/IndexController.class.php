<?php
namespace Website\Controller;
use Think\Controller;
use Lib;
/**
 *后台首页控制器
 */
class IndexController extends CommonController {
	/**
	 * 后台首页视图
	 * @return [type] [description]
	 */
    public function index (){
        $this->display();
    }
	
	public function welcom(){
		$this->display();
	}

    //全站搜索
    public function search () {
		$str = I('keyword');
		$where = "title LIKE '%".$str."%'";
		$field = array('id,title,description,time');
		$count = M('article')->where($where)->count();
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->search = M('article')->field($field)->where($where)->order('time DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
	    $this->str=$str;
	    $this->count=$count;
        $this->display();
    }
	
	
    
}