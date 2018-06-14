<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class ArticleController extends Controller{
	
	public function index () {
		$field = array('del','keywords','content');
		$count = M('article')->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %DOWN_PAGE% %HEADER%');
		$show = $Page->show();
		$this->article = M('article')->field($field,true)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();	
	}

	public function shows () {
		$id = I('id','',intval);
		$db = M('article');
		$data = $db->where(array('id'=>$id))->find();
		if(!$data){$this->error('未找到该信息');}
		$this->title = $data['title'];
		$this->keywords = $data['keywords'];
		$this->descriptions = $data['description'];
		$this->time = $data['time'];
		$this->content = stripslashes($data['content']);
		$this->timg = $data['pic'];
		$this->author=$data['author'];
		$this->sid=$id;

		$last_rs = $db->where(array('id' => array('GT',$id), 'del' => 0, 'cid' =>$cid))->order(array('id'=>'ASC'))->limit(1)->find(); //GT =>'小于'
		$next_rs = $db->where(array('id' => array('LT',$id), 'del' => 0, 'cid' =>$cid))->order(array('id'=>'DESC'))->limit(1)->find(); //LT => '大于'
        
        if ( !empty($last_rs) ) 
        {
            $last = "上一篇：<a href='";
            $last .= U(MODULE_NAME.'/ashow_'.$last_rs['id']);
            $last .= "'>{$last_rs['title']}</a>";
        }
        else 
        {
            $last = "上一篇：已是第一篇";
        }
        if ( !empty($next_rs) )
        {
            $next = "下一篇：<a href='";
            $next .= U(MODULE_NAME.'/ashow_'.$next_rs['id']);
            $next .= "'>{$next_rs['title']}</a>";
        }
        else
        {
            $next = "下一篇：已是最后一篇";
        }
        $this->prev = $last;
        $this->next = $next;
		$this->display();
	}

	public function getclick () {
		$id = (int) $_GET['id'];
		$where = array('id'=>$id);
		M('article')->where($where)->setInc('click');
		$click = M('article')->where($where)->getField('click');		
		echo 'document.write('.$click.')';
	}
}
?>