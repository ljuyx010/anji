<?php
namespace Website\Controller;
use Think\Controller;
use Lib;
use Org\Util\Auth;

/**
* Auth控制器
*/
class AuthController extends CommonController{
	//权限列表
  	public function index () {
  		$cate = M('cate')->order('sort ASC')->field('id,pid,name,model')->select();
        $this->cate = Lib\Category::unlimitedForlevel($cate,'&nbsp;');
  		$this->display();
  	}

  	//添加权限表单
  	public function add () {
  		//重组二维数组
  		$f=array();
		foreach($_POST as $b=>$c){
		    foreach($c as $d=>$e){
		        $f[$d][]=$e;
		    }
		}
        //遍历数组入库
        foreach ($f as $v){
        	$data['name'] = $v[0];
        	$data['title'] = $v[1];
        	M('auth_rule')->data($data)->add();
        }  
  	}

  	//添加用户组
  	public function group () {
  		$this->auth = M('auth_rule')->select();
  		$this->display();
  	}

  	//用户组表单处理
  	public function addGroup () {
  		$title = $_POST['title'];
  		$rules = 0;
  		foreach ($_POST['rules'] as $v){
  			$rules .= ','.$v;
  		}
  		$data = array('title'=>$title,'rules'=>$rules);
  		M('auth_group')->add($data);
  	}

  	/*//进行权限验证的实例
  	public function explore () {
  		//要在控制器顶端用use 命名空间来引入Auth类
  		$auth = new Auth();

   		if(!$auth->check(ACTION_NAME.'_'.$id,session('uid'))){
            $this->error('你没有权限');
       		}
  	}*/
  			
}
?>