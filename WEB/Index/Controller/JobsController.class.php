<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class JobsController extends Controller{
	
	public function index () {
		$id = I('id','',intval);
		$cate = Lib\Cate::catetkd($id);
		$this->cid = $cate[0]['id'];
		$fid = $cate[0]['pid'];
		$this->title = $cate[0]['name'];
		$fcate = Lib\Cate::catetkd($fid);
		$this->fid = $fid;
		$this->fname = $fcate[0]['name'];
		$this->cname = $cate[0]['name'];
		$this->title = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Jobs'){
			$this->error('页面不存在');
		}
		$where = array('cid' => $id);
		$count = M('jobs')->where($where)->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->jobs = M('jobs')->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}
}
?>