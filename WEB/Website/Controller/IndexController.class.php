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
    	$day=strtotime(date('Y-m-d 00:00:00'));
    	$where=array('type'=>1,'zt'=>1,'ordtime'=>array('egt',$day));
    	$this->dd=M('orders')->field('id,ordernum,ordtime')->where($where)->select();
    	$ddm=M('orders')->where($where)->count();
    	$this->shen=M('shen')->field('carnum,type,dtime')->where(array('dtime'=>array('elt',time())))->select();
    	$sm=M('shen')->where(array('dtime'=>array('elt',time())))->count();
    	$this->num=$ddm+$sm;
    	$this->ddm=$ddm;
        $this->display();
    }
	
	public function welcom(){
		$day=strtotime(date('Y-m-d 00:00:00'));
		$month=strtotime(date('Y-m-01 00:00:00'));
		$this->d=M('orders')->field('count(id) as ds,Sum(money) as dq')->where(array('zt'=>array('gt',0),'ordtime'=>array('egt',$day)))->select();
		$this->m=M('orders')->field('count(id) as ms,Sum(money) as mq')->where(array('zt'=>array('gt',0),'ordtime'=>array('egt',$month)))->select();
		$this->dn=M('user')->where(array('regtime'=>array('egt',$day)))->count();
		$this->mn=M('user')->where(array('regtime'=>array('egt',$month)))->count();
		$this->dh=M('user')->where(array('logintime'=>array('egt',$day)))->count();
		$this->mh=M('user')->where(array('logintime'=>array('egt',$month)))->count();
		$this->zs=M('user')->count();
		$this->display();
	}

    //全站搜索
    public function search () {
		$str = I('keyword');
		$where = "title LIKE '%".$str."%'";
		$field = array('id,title,description,time');
		$count = M('article')->where($where)->count();
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->search = M('article')->field($field)->where($where)->order('time DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
	    $this->str=$str;
	    $this->count=$count;
        $this->display();
    }
	
	public function close(){
		$this->display();
	}
    
}