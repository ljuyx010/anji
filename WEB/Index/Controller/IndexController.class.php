<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 * 前端首页模板
	 * @return [type] [description]
	 */
    public function index(){
      $rs=M('site')->field('value')->where(array('name'=>"basic"))->find();
      $data =unserialize($rs['value']);
      $this->title = $data['title'];
      $this->keywords = $data['keywords'];
      $this->description = $data['description'];
      $this->display();  
    }

    

}

?>