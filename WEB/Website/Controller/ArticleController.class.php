<?php
namespace Website\Controller;
use Think\Controller;

/**
 * 文章管理控制器
 */
class ArticleController extends CommonController {

	/*文章列表视图*/
	public function index (){
		$this->display();
	}
	
	public function fpage (){
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 0 : $order="id ".$px; break; 
		case 2 : $order="rq ".$px; break; 
		case 3 : $order="click ".$px; break; 
		} 
		$where = array();
		if($s){$where=array_merge($where,array('title'=>array('like','%'.$s.'%')));}
		$article = M('article')->field('id,title,click,pic,tj,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as rq')->where($where)->order($order)->page($p,$c)->select();
		$count = M('article')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}
    
    /*添加文章*/
    public function add () {
    	$this->action="添加";    	
    	$this->display();
    }

    /*添加文章表单处理*/
    public function runadd () {
    	$db = M("article"); 		
		$gz = array(//自动验证
	     array('title','require','标题必填'), 
	     array('content','require','内容不能空')
		);
		$ms=$_POST['description'] ? $_POST['description'] : cutStr(strip_tags($_POST['content']),100);
    	$data = array(
    		'id' =>$_POST['id'],
    		'title' => $_POST['title'],
    		'keywords' => $_POST['keywords'],
    		'description' => $ms,
    		'content' =>$_POST['content'],
			'author' =>$_POST['author'], 
			'time' => $_POST['time'] ? strtotime($_POST['time']) : time(),  		
    		'cid' => (int) $_POST['cid'],
    		'tj' => (int) $_POST['tj'],
    		'pic' => $_POST['pic'],
    		);
		if (!$db->validate($gz)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Article/index'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Article/add'));
		}

    }

    //更新文章
    public function edit () {
    	$this->action="修改"; 
    	$id= I('id');
		$v=M('article')->where('id='.$id)->find();
		$this->v=$v;
    	$this->display(add);
    }
    
	//彻底删除
	public function delete () {
		$id = I('id','',intval);
		$data = array('id'=>$id);
		if (M('article')->where($data)->delete()){
			$this->success('删除成功',U('Article/index'));
		}else{
			$this->error('删除失败');
		}
	}

}
?>