<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class InfoController extends Controller{

	public function index () {
		$id = I('id','',intval);
		$cate = Lib\Cate::catetkd($id);
		$info = M('info')->where(array('cid'=>$id))->select();				
		$cid = $cate[0]['id'];  //当前栏目id
		$this->cid = $cid;
		$fid = $cate[0]['pid'];
		$fcate = Lib\Cate::catetkd($fid);
		$this->fid = $fid;
		$this->fname = $fcate[0]['name'];
		$this->fid = $cate[0]['pid']; //当前栏目父级id
		$this->cname = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Info'){
			$this->error('页面不存在');
		}
		$this->title = $info[0]['title'];
		$this->content = stripslashes(htmlspecialchars_decode($info[0]['content']));		
		$this->display();
		
	}
}
?>