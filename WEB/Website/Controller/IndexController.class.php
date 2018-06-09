<?php
namespace Website\Controller;
use Think\Controller;
use Lib;
/**
 *后台首页控制器
 */
class IndexController extends CommonController {
	/**
	 * 后台首页视图
	 * @return [type] [description]
	 */
    public function index (){
		/*$where = array('del'=>0);
		$this->mon = M('article')->where($where)->count();
		$this->sum = M('goods')->where($where)->count();
		$this->works = M('Article')->where(array('del'=>0))->limit(9)->order('time desc')->field('id,cid,title,time')->select();*/
        $this->display();
    }
	
	public function welcom(){
		$this->display();
	}

    //全站搜索
    public function search () {
	  $str = I('keyword');
	  $where = "title LIKE '%".$str."%'";
	  $field = array('id,title,cid,time');
	  $searcha = M('article')->field($field)->where($where)->order('id DESC')->select();
	  $searchg = M('goods')->field($field)->where($where)->order('id DESC')->select();
	  $searchk = M('gbook')->field($field)->where($where)->order('id DESC')->select();
	  $searchj = M('jobs')->field($field)->where($where)->order('id DESC')->select();
	  $this->str = $str;
	  $this->searcha = $searcha;
	  $this->searchg = $searchg;
	  $this->searchk = $searchk;
	  $this->searchj = $searchj;
	  
      $this->display();
    }
	
	
    
}