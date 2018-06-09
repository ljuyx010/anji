<?php
namespace Website\Controller;
use Think\Controller;
use Org\Util\Rbac;

class CommonController extends Controller {
	/*这是自动运行程序
   public function _initialize (){
   	if (!isset($_SESSION[C('USER_AUTH_KEY')])){

   		$this->redirect(MODULE_NAME.'/Login/index');
   	}
    //不进行权限验证的控制器和方法
   	$notAuth = in_array(MODULE_NAME,explode(',',C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME,explode(',',C('NOT_AUTH_ACTION')));

   	if (C('USER_AUTH_ON') && !$notAuth){
   	  Rbac::AccessDecision() || $this->error('没有权限');
   	}
    
   }*/

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