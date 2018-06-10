<?php
namespace Website\Controller;
use Think\Controller;

class SystemController extends CommonController{
    //系统设置首页视图
	public function index (){
        $data=M('site')->field('value')->where(array('name'=>"basic"))->find();
        $this->v=unserialize($data['value']);
        $this->display();
	}
    //系统设置用F方法写入文件
	public function save () {

		$data=array(
			'title'=>I('title'),
			'keywords'=>I('keywords'),
			'description'=>I('description'),
			'tel'=>I('tel'),
			'adress'=>I('adress'),
			'mail'=>I('mail'),
			'QQ'=>I('QQ'),
			'content'=>I('content'),
			'js'=>I('js')
		);

		$rs=M('site')->where(array('name'=>I('name')))->setField('value',serialize($data));

		if ($rs){
          $this->success('修改成功',U('System/index'));
		}else{
		  $this->error('修改失败');
		}
	}
	//邮件与支付宝参数设置
	public function extend (){	
		$data=M('site')->field('value')->where(array('name'=>"extend"))->find();
        $this->v=unserialize($data['value']);
        $this->display();	
	}
	public function savextend () {

		$data=array(
			'AppId'=>I('AppId'),
			'AppSecret'=>I('AppSecret'),
			'mhid'=>I('mhid'),
			'apikey'=>I('apikey'),
			'client_cert'=>I('client_cert'),
			'client_key'=>I('client_key'),
			'AccessKey'=>I('AccessKey'),
			'AccessSecret'=>I('AccessSecret'),
			'qm'=>I('qm'),
			'mbid'=>I('mbid')
		);

		$rs=M('site')->where(array('name'=>I('name')))->setField('value',serialize($data));

		if ($rs){
          $this->success('修改成功',U('System/extend'));
		}else{
		  $this->error('修改失败');
		}
	}
	//banner图首页
	public function banner () {
		$count = M('banner')->count();
		$Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->banner = M('banner')->order('sort ASC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->display();
	}
	/*添加*/
    public function add () {
    	$this->action="添加";    	
    	$this->display();
    }

    /*添加表单处理*/
    public function runadd () {
    	$db = M("banner"); 		
		$gz = array(//自动验证
	     array('title','require','标题必填'), 
	     array('pic','require','图片不能空')
		);
    	$data = array(
    		'id' =>$_POST['id'],
    		'title' => $_POST['title'],
    		'url' =>$_POST['url'],
			'type' =>$_POST['type'], 
			'time' => time(),  		
    		'sort' => (int) $_POST['sort'],
    		'pic' => $_POST['pic']
    		);
		if (!$db->validate($gz)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('System/banner'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('System/banner'));
		}

    }

    //更新
    public function edit () {
    	$this->action="修改"; 
    	$id= I('id');
		$v=M('banner')->where('id='.$id)->find();
		$this->v=$v;
    	$this->display(add);
    }
	//删除banner图
	public function delete () {
		$id = I('id','',intval);
		if (M('banner')->where(array('id'=>$id))->delete()){
			$this->success('删除成功',U('System/banner'));
		}else{
			$this->error('删除失败');
		}
	}

}
?>