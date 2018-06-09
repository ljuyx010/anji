<?php
namespace Wap\Controller;
use Think\Controller;
use \Lib;

class GbookController extends Controller{
	//留言视图
	public function index () {
		$id = I('id','',intval);
		$cate = Lib\Cate::catetkd($id);
		$this->cid = $cate[0]['id'];
		$this->fid = $cate[0]['pid'];
		$this->title = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Gbook'){
			$this->error('页面不存在');
		}

		$where = "cid=".$id." and reply<>''";
		$count = M('gbook')->where($where)->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->gbook = M('gbook')->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
		
	}
	//验证码
	Public function verify(){
		ob_clean();
    $config = array(
        'font-size' => 10,
        'length' => 4,
        'imageW' => 180,
        'imageH' => 50,
        'useNoise' => false,
    	);
	$verify = new \Think\Verify($config);
	$verify->entry(2);
	}

	//留言入库
	public function gbookDo(){
			if (IS_POST){
			$verify = new \Think\Verify();
		     if(!$verify->check($_POST['code'],2)){
		     $this->error('验证码错误');
		     }
			$data = array(
				'username' => $_POST['username'],
				'address' => $_POST['address'],
				'tel' => $_POST['tel'],
				'email' => $_POST['email'],
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'time' => time(),
				'ip' => get_client_ip(),
				'cid' => (int)$_POST['cid']
				);
				if (M('gbook')->add($data)){
					$this->success('留言已成功,我们会尽快回复您',U(MODULE_NAME.'/Gbook/index',array('id'=>$_POST['cid'])));
				}else{
					$this->error('留言失败');
				}
			}else{
				$this->error('页面不存在');
			}
	}
	
	
}
?>