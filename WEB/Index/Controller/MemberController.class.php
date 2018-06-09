<?php
namespace Index\Controller;
use Think\Controller;

/**
* 会员登录控制器
*/
class MemberController extends Controller{
	
	public function index () {
		//会员登录视图
		$this->display();
	}

	/**
    * 验证码
    */
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
	$verify->entry(3);
	}


    /**
     * 登录判断
     */
    public function login(){
     if (!IS_POST) E('页面不存在！');

     $verify = new \Think\Verify();
     if(!$verify->check($_POST['codet'],3)){
     $this->error('验证码错误');
     }
     $username = I('email');
     $password = I('password','',md5);

     $user = M('member')->where('username = "'.$username.'"')->find();
     if (!$user || $user['pass'] != $password){
    	$this->error('账号或密码错误！');
     }
     if ($user['lock'] == 2) $this->error('该账号已被锁定，请联系管理员');
     $data = array(
     	'id' => $user['id'],
     	'logintime' => time(),
     	'loginip' => get_client_ip(),
     );
     M('member')->save($data);
     session('memberid',$user['id']);
     session('uname',$user['username']);
     session('time',date('y-m-d H:i:s',$user['logintime']));
     session('ip',$user['loginip']);

     $this->redirect(MODULE_NAME.'/Index/index');
    }

    /*会员注册*/
    public function reg () {
    	$this->display();
    }

    /*会员信息入库*/
    public function add () {
    	$data = array(
    		'username' => I('username'),
    		'email' => I('email'),
			'pass' => md5(I('pass')),
			'realname' => I('realname'),
			'tel' => I('tel'),
			'QQ' => I('QQ'),
			'regtime' => time(),
			'regip' => get_client_ip()
    		);
    	if (M('member')->where(array('username'=>$_POST['username']))->select()){
    		$data['code'] = 2;
    		$this->ajaxReturn($data,'json');
    	}else{
    		if (M('member')->data($data)->add()){
    		$data['code'] = 0;
    		$this->ajaxReturn($data,'json');
	    	}else{
	    		$data['code'] =1;
	    		$this->ajaxReturn($data,'json');
	    	}
    	}
    	
    }
	
	/*会员密码找回*/
	public function forget () {
		$this->display();
	}
	
	public function apply (){
		$verify = new \Think\Verify();
		if(!$verify->check($_POST['code'],3)){
		$this->error('验证码错误');
		}
		$username=$_POST[company];
		$to=$_POST[email];
		$where=array('username'=>$username,'email'=>$to);
		if($user=M('member')->where($where)->select()){
			$uid=base64_encode($user[0][id]);
			$t=base64_encode(time());
			$url=U('member/mtpass',array('u'=>$uid,'t'=>$t),'',true);
			$title="用户账号密码找回";
			$content="点击<a href='".$url."' target='_blank'>修改密码</a>，如果点击无反应请把下面的链接复制到浏览器中<br />".$url."";
			if(SendMail($to,$title,$content)){
				$this->yan=1;
				$this->display(yan);
			}else{
				$this->yan=2;
				$this->display(yan);
			}
			
		}else{
			$this->yan=0;
			$this->display(yan);
		}
	}
	
	public function mtpass (){
		$id=base64_decode($_GET['u']);
		$date=base64_decode($_GET['t']);
		$a=time();
		$c = ceil(($a - $date)/(3600*24));
		if($c>1){
			$this->yan=0;
			$this->display();
		}else{
			$this->y=base64_encode($id+12345);
			$this->u=base64_encode($id);
			$this->yan=1;
			$this->display();
		}
	}
	
	public function uppass (){
		$paw1=I('pasw1');
		$paw2=I('pasw2');
		$y=intval(base64_decode($_GET['y']));
		$u=intval(base64_decode(I('u')))-12345;
		if($paw1!=$paw2){
			$this->error("两次输入的密码不相同");
		}else if($y!=$u){
			$this->error("参数错误,请不要试图修改系统参数");
		}else{
			$password=md5($paw1);
			$this->yan=M('member')->where(array('id' => $y))->setField('pass',$password);
			$this->display();
		}
               
	}
	
	//用户订单
	public function myorder (){
		$type = I('ordtype');
		if(!session('memberid')) $this->redirect(MODULE_NAME.'/Index/index');
		if($type=='payed'){
			$where=array('uid'=>session('memberid'),'paytime'=>array('neq',''));
		}else{
			$where=array('status'=>1,'paytime'=>array('neq',''));
		}
		$count = M('orders')->where($where)->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->orders = M('orders')->field('trade,buyer_alipay',true)->where($where)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}
	
}
?>