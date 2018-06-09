<?php
namespace Website\Controller;
use Think\Controller;
//会员管理控制器
class UserController extends CommonController{
	//会员管理视图
	public function index () {
		$count = M('member')->count();
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->member = M('member')->limit($Page->firstRow.','.$Page->listRows)->select();
 		$this->page = $show;
		$this->display();
	}

	public function updata () {
		$id = I('id','',intval);
		$this->member = M('member')->where(array('id'=>$id))->select();
		$this->display();		
	}

	public function runUpdata () {
		$id = I('id','',intval);
		$state = I('state','',intval);

		if (M('member')->where(array('id'=>$id))->setField('state',$state)){
			$this->success('保存成功',U(MODULE_NAME.'/Member/index'));
		}else{
			$this->error('保存失败');
		}

	}

}
?>