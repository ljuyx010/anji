<?php
namespace Website\Controller;
use Think\Controller;
use Think\Auth;

class CommonController extends Controller {
	 //这是自动运行程序
   public function _initialize (){
   	if (!isset($_SESSION['user'])){
      $this->error('未登录或登录超时，请重新登录', U('Login/index'));
    }
    $auth=new \Think\Auth();
    //session存在时，不需要验证的权限  
    $rule_name=CONTROLLER_NAME.'/'.ACTION_NAME;
    //当前操作的请求                 模块名/方法名

    $result=$auth->check($rule_name,$_SESSION['user']['id']);
    if(!$result){
      $this->error('您没有权限访问');
    }
    
   }

   //题图上传
   public function upimg(){
       $config = array(
            'rootPath'      =>  './Upload/', //保存根路径
            'savePath'      =>  'image/', //保存路径
            );
       $up=new \Think\Upload($config);
       $rup=$up->upload($_FILES);
      
      $a="";
      foreach($rup as $v){
         $name='./Upload/'.$v['savepath'].$v['savename'];
         $url='/Upload/'.$v['savepath'].$v['savename'];
                        
         list($width, $height, $type, $attr) = getimagesize($name);
         
           if($width > 0){
            echo json_encode(array("error"=>"0","pic"=>$url));
         }else{
           echo json_encode(array("error"=>"上传有误，清检查服务器配置！"));   
         }
         
      }     
   
   }
}
?>