<?php
namespace Website\Controller;
use Think\Controller;

class SystemController extends CommonController{
    //系统设置首页视图
	public function index (){
        $this->data = F('Site','',APP_PATH.'/Data/');
        $this->display();
	}
    //系统设置用F方法写入文件
	public function updataSystem () {

		F('Site',$_POST,APP_PATH.'/Data/');

		if (F('Site','',APP_PATH.'/Data/')){
          $this->success('修改成功',U(MODULE_NAME.'/System/index'));
		}else{
		  $this->error('修改失败,请修改'.APP_PATH.'/Data/'.'Site.php的权限');
		}
	}
	//邮件与支付宝参数设置
	public function meter (){	
		$db=M('conf');
		if($_POST){
			$data=array('id' => 0,'confing' => serialize($_POST));
			if($db->save($data)){
				$this->success('修改成功',U(MODULE_NAME.'/System/meter'));
			}else{
				$this->error('修改失败!');
			}
		}else{
			$conf = $db->where(array('id' => 0))->getField('confing');
			$this->data=unserialize($conf);
            $this->display();
		}
		
	}
	//banner图首页
	public function banner () {
		$this->banner = M('banner')->order('sort ASC')->select();
		$this->display();
	}
	//添加banner视图
	public function addbanner () {
		$this->display();
	}
	//添加banner表单操作
	public function runAdd () {
		$data = array(
			'title' => $_POST['title'],
			'img' => $_POST['img'],
			'url' => $_POST['url'],
			'type' => $_POST['type']
			);
		if (M('banner')->add($data)){
			$this->success('添加成功',U(MODULE_NAME.'/System/banner'));
		}else{
			$this->error('添加失败');
		}
	} 
	//banner图排序
	public function sort () {
		$db = M('banner');

         foreach ($_POST as $id => $sort) {
         	$db->where(array('id' => $id))->setField('sort',$sort);
         }
         $this->redirect(MODULE_NAME.'/System/banner');
	}
	//修改banner视图
	public function updatabanner () {
		$id = I('id','',intval);
		$this->banner = M('banner')->where(array('id'=>$id))->select();
		$this->display(addbanner);
	}
	//修改banner表单操作
	public function runUpdata () {
		$id = I('id','',intval);
		$data = array(
			'title' => $_POST['title'],
			'img' => $_POST['img'],
			'url' => $_POST['url'],
			'type' => $_POST['type']
			);
		if (M('banner')->where(array('id'=>$id))->save($data)){
			$this->success('修改成功',U(MODULE_NAME.'/System/banner'));
		}else{
			$this->error('修改失败或数据无更新');
		}
	}
	//删除banner图
	public function delbanner () {
		$id = I('id','',intval);
		if (M('banner')->where(array('id'=>$id))->delete()){
			$this->success('删除成功',U(MODULE_NAME.'/System/banner'));
		}else{
			$this->error('删除失败');
		}
	}
	//修改用户密码
	public function userpwd () {
		$this->username = session('username');
		$this->display();
	}
	//密码修改判断入库
	public function updatapwd () {
		$password = I('password');
		$password2 = I('repassword');

		if ($password == $password2){
			$User = M('user');
			$id = session('uid');
			$password = md5($password);
			if ($User->where(array('id' => $id))->setField('password',$password)){
				$this->success('密码修改成功',U(MODULE_NAME.'/System/userpwd'));
			}else{
				$this->error('密码修改失败');
			}
		}else{
			$this->error('两次输入的密码不一致，请检查后重新输入');
		}
	}
}
?>