<?php
namespace Index\Controller;
use Think\Controller;

class SearchController extends Controller{

	public function index () {
		$str = I('str');
		if(!mb_check_encoding($str, 'utf-8')){
		$str= iconv('gbk', 'utf-8', $str);
		}
		if(!$str){$this->error('关键字不能为空');}
		$where = "del=0 and title LIKE '%".$str."%'";
		$field = array('del','keywords','description','content');
		$count = M('article')->where($where)->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->search = M('article')->field($field,true)->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->str = $str;
		$this->display();

	}
}


?>