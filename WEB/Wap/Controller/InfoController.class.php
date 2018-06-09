<?php
namespace Wap\Controller;
use Think\Controller;
use \Lib;

class InfoController extends Controller{

	public function index () {
		$id = I('id','',intval);
		$wxconfig = wx_share_init();		//微信分享jssdk初始化
		$this->assign('wxconfig', $wxconfig); //微信分享参数
		$cate = Lib\Cate::catetkd($id);
		$info = M('info')->where(array('cid'=>$id))->select();
		$this->cid = $cate[0]['id'];  //当前栏目id
		$this->fid = $cate[0]['pid']; //当前栏目父级id
		$this->name = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Info'){
			$this->error('页面不存在');
		}
		$this->title = $info[0]['title'];
		$this->content = htmlspecialchars_decode($info[0]['content']);
		$this->display();
	}
}
?>