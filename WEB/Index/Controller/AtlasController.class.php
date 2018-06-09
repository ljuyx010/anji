<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class AtlasController extends Controller{
	
	public function index () {
		$id = I('id','',intval);
		$ch=M('cate')->where(array('pid'=>$id))->select();
		if($ch){
			$ids = array();
			foreach ($ch as $value){
			 $ids[]=$value['id'];
			 }
			$cids=implode(',', $ids);
		$where = "cid in (".$cids.") and del=0";
		}else{
			$where = array('cid'=>$id,'del'=>0);
		}
		$cate = Lib\Cate::catetkd($id);
		$this->cid = $cate[0]['id'];
		$fid = $cate[0]['pid'];
		$fcate = Lib\Cate::catetkd($fid);
		$this->fid = $fid;
		$this->fname = $fcate[0]['name'];
		$this->title = $cate[0]['name'];
		$this->cname = $cate[0]['name'];
		$this->keywords = $cate[0]['keywords'];
		$this->description = $cate[0]['description'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		if ($cate[0]['model'] !== 'Atlas'){
			$this->error('页面不存在');
		}
		$field = array('del','keywords','description','content');		
		$count = M('article')->where($where)->count();
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show=$Page->show();
		$this->article = M('article')->field($field,true)->where($where)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}

	public function shows () {
		$id = I('id','',intval);
		$db = M('article');		
		$data = $db->where(array('id'=>$id))->select();
		$cid =$data[0]['cid'];
		$this->sid = $id;
		$this->title = $data[0]['title'];
		$this->keywords = $data[0]['keywords'];
		$this->description = $data[0]['description'];
		$this->p = $data[0]['pic'];
		$this->time = $data[0]['time'];
		$this->content = stripslashes($data[0]['content']);
		$this->tel = $data[0]['tel'];
		$this->address = $data[0]['address'];
		
		//评论列表
		$fz="Atlas_".$id;
		$this->counts=M('ping')->where(array('fz'=>$fz,'dis'=>1))->count();
		$ping=M('ping')->where(array('fz'=>$fz,'_string'=>'dis=1 or hfid <>0'))->join('LEFT JOIN lj_member ON lj_ping.mid = lj_member.id')->field('lj_ping.*,lj_member.username')->order('lj_ping.id DESC')->select();
		$this->ping = Lib\Category::unlimitedForping($ping);
		$this->fz=$fz;

		$cate = Lib\Cate::catetkd($cid);
		$this->cid = $cid;
		$fid = $cate[0]['pid'];
		$this->cname = $cate[0]['name'];
		$fcate = Lib\Cate::catetkd($fid);
		$this->fid = $fid;
		$this->fname = $fcate[0]['name'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		$this->img = M('atlas')->where(array('aid'=>$id))->select();

		$last_rs = $db->where(array('id'=>array('GT',$id),'del'=>0,'cid'=>$cid))->order('id ASC')->limit(1)->find(); //GT =>'小于'
		$next_rs = $db->where(array('id'=>array('LT',$id),'del'=>0,'cid'=>$cid))->order('id DESC')->limit(1)->find(); //LT => '大于'
        
        if ( !empty($last_rs) ) 
        {
            $last = "上一篇：<a href=";
            $last .= U('/'.MODULE_NAME.'/pshow_'.$last_rs['id']);
            $last .= "'>{$last_rs['title']}</a>";
        }
        else 
        {
            $last = "上一篇：已是第一篇";
        }
        if ( !empty($next_rs) )
        {
            $next = "下一篇：<a href='";
            $next .= U('/'.MODULE_NAME.'/pshow_'.$next_rs['id']);
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
}
?>