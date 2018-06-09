<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 * 前端首页模板
	 * @return [type] [description]
	 */
    public function index(){
      $data = F('Site','',APP_PATH.'/Data/');
      $this->title = $data['title'];
      $this->keywords = $data['keywords'];
      $this->description = $data['description'];
      $this->aboutus = $data['spare'];
      $this->display();  
    }

    

}

?>