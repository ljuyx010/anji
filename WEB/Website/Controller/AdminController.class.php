<?php
namespace Website\Controller;
use Think\Controller;

Class AdminController extends CommonController{
	
	public function user()
	{
		# code...
	}

	public function rule (){
		$rule=M('auth_rule')->field("*,concat(sort,',',id) as paths")->where(array('status'=>1))->order('paths')->select();
		foreach($rule as $k=>$v){
			$rule[$k]['pix']=str_repeat("|--",$v['type']-1);
		}
		$this->rule=$rule;
		$this->display();
	}

	public function runadd (){
		$db = M("auth_rule"); 
		$lei = array(//自动验证
	     array('name','require','规则必填'), 
	     array('title','require','名称必填'),
	     array('type','require','level级获取失败'),
	     array('sort','require','排序获取失败')
		);

		$data['id'] = $_POST['id'];
		$data['name'] = $_POST['name'];
		$data['title'] = $_POST['title'];
		$data['type'] = I('type','',intval);
		$data['sort'] = $_POST['id'] ? $_POST['sort'] : $_POST['sort'].$_POST['fid'];

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $msg=$db->getError();
		     $cod=202;
		}else{
			if($_POST['id']){
				$rs=$db->save($data);
			}else{
				$rs=$db->add($data);
			}
			if($rs){$cod=200;}else{$msg="数据更新失败";$cod=201;}
		}

		$this->ajaxReturn(array('cod'=>$cod,'msg'=>$msg));
	}

	public function updata(){
		$id=I('id');
		$data=M('auth_rule')->where('id='.$id)->find();
		$this->ajaxReturn($data);
	}

	public function delete (){
		$id=I('id');
		if(M('auth_rule')->where(array('id'=>$id))->delete()){
			$this->success('删除成功！',U('Admin/rule'));
		}else{
			$this->error('删除失败！');
		}
	}
}
?>