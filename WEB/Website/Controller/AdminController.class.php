<?php
namespace Website\Controller;
use Think\Controller;

Class AdminController extends CommonController{
	
	public function user()
	{
		$this->user=D('admin')->relation(true)->field('password',true)->select();
		$this->groupname=M('auth_group')->field('id,title')->select();
		$this->display();
	}

	public function runaddu (){
		$db = D("admin");
		$lei = array(//自动验证
	     array('name','require','用户名字必填'), 
	     array('account','require','账号必填'),
	     array('password1','require','密码必填'),
	     //array('password','length','密码长度6-12位','6,12'),
	     array('password2','password1','确认密码不正确',0,'confirm')
		);

		$data['id'] = $_POST['id'];
		$data['name'] = $_POST['name'];
		$data['account'] = $_POST['account'];
		$data['password1'] = $_POST['password'];
		$data['password2'] = $_POST['password2'];
		$data['password']=I('password','',md5);
		$data['logintime'] = time();
		$gid = $_POST['group_id'];
		if($_POST['id']){
			if($_POST['password'] and $_POST['password']==$_POST['password2']){
				unset($data['password2']);
				unset($data['password1']);
			}elseif ($_POST['password']<>$_POST['password2']) {
				$this->ajaxReturn(array('cod'=>202,'msg'=>"验证密码不正确"));
				$this->error('错误中断');
			}else{
				unset($data['password2']);
				unset($data['password1']);
				unset($data['password']);
			}
			$rs1=$db->save($data);
			$rs2=M('auth_group_access')->where('uid='.$_POST['id'])->setField('group_id',$gid);
			$rs=$rs1 || $rs2;
		}else{
			if (!$db->validate($lei)->create($data)){
			     // 如果创建失败 表示验证没有通过
			     $msg=$db->getError();
			     $cod=202;
			}else{
				unset($data['password2']);
				unset($data['password1']);	
				$uid=$db->add($data);
				$rs=M('auth_group_access')->add(array('uid'=>$uid,'group_id'=>$gid));
			}			
		}
		if($rs){$cod=200;}else{$msg="数据更新失败";$cod=201;}
		$this->ajaxReturn(array('cod'=>$cod,'msg'=>$msg));
	}

	public function updatau(){
		$id=I('id');
		$data=M('admin')->field('password',true)->where('id='.$id)->find();
		$this->ajaxReturn($data);
	}

	public function deleteu(){
		$id=I('id');
		if(M('admin')->where(array('id'=>$id))->delete()){
			M('auth_group_access')->where('uid='.$_POST['id'])->delete();
			$this->success('删除成功！',U('Admin/rule'));
		}else{
			$this->error('删除失败！');
		}
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

	public function group (){
		$this->group=M('auth_group')->field('id,title')->select();
		$this->display();
	}

	public function runaddg (){
		$db = M("auth_group"); 
		$lei = array(//自动验证
	     array('title','require','用户组名必填')
		);

		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
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

	public function updatag(){
		$id=I('id');
		$data=M('auth_group')->field('id,title')->where('id='.$id)->find();
		$this->ajaxReturn($data);
	}

	public function deleteg (){
		$id=I('id');
		if(M('auth_group')->where(array('id'=>$id))->delete()){
			$this->success('删除成功！',U('Admin/group'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function setaccess(){
		if(IS_POST){
            $map=array(
            	'id'=>$_POST['id'],
            	'rules'=>implode(',', $_POST['rule_ids'])
            );
            $result=M('auth_group')->save($map);
            if ($result) {
                $this->success('保存成功',U('Admin/group'));
            }else{
                $this->error('保存失败');
            }
        }else{
		$group=M('auth_group')->field('id,title,rules')->where('id='.I('id'))->find();
		$group['rules']=explode(',', $group['rules']);
		$this->rule=M('auth_rule')->field("id,title,type,concat(sort,',',id) as paths")->where(array('status'=>1))->order('paths')->select();
		$this->group=$group;
		$this->display();
		}
	}
}
?>