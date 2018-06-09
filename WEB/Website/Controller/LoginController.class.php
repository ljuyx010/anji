<?php
namespace Website\Controller;
use Think\Controller;
use Org\Util\Rbac;
/**
 * 登录页面控制器
 */
class LoginController extends Controller {
	/**
	 * 登录视图
	 * @return [type] [description]
	 */
    Public function index(){
        
        $this->display();
    }

    /**
    * 验证码
    */
    Public function verify(){
	// 实例化Verify对象
	$verify = new \Think\Verify();
    // 配置验证码参数
	$verify->codeSet = '0123456789';
	$verify->fontttf = '4.ttf';
	$verify->fontSize = 14;     // 验证码字体大小
	$verify->length = 4;        // 验证码位数
	$verify->imageH = 36;       // 验证码高度
	$verify->useImgBg = false;   // 开启验证码背景
	$verify->useNoise = false;  // 关闭验证码干扰杂点

	$verify->entry(1);
	}


    /**
     * 登录判断
     */
    public function login(){
     if (!IS_POST) E('页面不存在！');

     $verify = new \Think\Verify();
     if(!$verify->check($_POST['verify'],1)){
     $this->error('验证码错误');
     }
     $username = I('user');
     $password = I('password','',md5);
     $user = M('user')->where('username = "'.$username.'"')->find();
     if (!$user || $user['password'] != $password){
    	$this->error('账号或密码错误！');
     }
     if ($user['lock']) $this->error('该账号已被锁定，请联系管理员');
     $data = array(
     	'id' => $user['id'],
     	'logintime' => time(),
     	'loginip' => get_client_ip(),
     );
     M('user')->save($data);
     session(C('USER_AUTH_KEY'),$user['id']);
     session('username',$user['username']);
	 session('name',$user['name']);
     session('logintime',date('y-m-d H:i:s',$user['logintime']));
     session('loginip',$user['loginip']);
     //超级管理员识别
     if ($user['username'] == C('RBAC_SUPERADMIN')){
        session(C('ADMIN_AUTH_KEY'),true);
     }
     //读取用户权限
     Rbac::saveAccessList();
	$this->success ( "登录成功", U("Index/index" ) );
    }

    //退出登录
    public function loginout(){
      session_unset();
      session_destroy();
      $this->success('安全退出',U('Login/index'));
    }

}


?>