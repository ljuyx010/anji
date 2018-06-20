<?php
namespace Website\Controller;
use Think\Controller;

/**
 * 文章管理控制器
 */
class HrController extends CommonController {

	/*文章列表视图*/
	public function people (){
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
		case 2 : $order="ks ".$px; break; 
		} 
		$where=array('id'=>array('gt',0));
		if($s){$where=array_merge($where,array('name'=>array('like','%'.$s.'%')));}
		$article = M('people')->field('id,name,ks,tel')->where($where)->order($order)->page($p,$c)->select();
		$count = M('people')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}
    
    /*添加员工*/
    public function add () {
    	$this->action="添加";
    	$this->display();
    }

    /*添加表单处理*/
    public function runadd () {
		$db = M("people"); 
		$lei = array(//自动验证
	     array('name','require','名称必填'), 
	     array('card','require','身份证号必填'),
	     array('time','require','入职时间必填'),
	     array('tel','require','手机号必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'name' => $_POST['name'],
			'card' => $_POST['card'],
			'brithday' => strtotime($_POST['brithday']),
			'tel' => I('tel'),
			'adress' => $_POST['adress'],
			'ks' => $_POST['ks'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Hr/people'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Hr/add'));
		}
    }

    //更新
    public function updata () {
    	$this->action="修改";
		$id= I('id');
		$v=M('people')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(add);
    }

	//彻底删除
	public function delete () {
		if(M('people')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Hr/people'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function getel (){
		$name=$_POST['name'];
		$tel=M('people')->where(array('name'=>$name))->getField('tel');
		$this->ajaxReturn($tel);
	}
	//员工工资
	public function gongzi(){
		$this->display();
	}

	public function gpage (){
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 1 : $order="ks ".$px; break; 
		case 2 : $order="lyf ".$px; break; 
		case 3 : $order="sf ".$px; break; 
		case 4 : $order="times ".$px; break; 
		} 
		$where=array();
		if($s){$where=array_merge($where,array('name'=>array('like','%'.$s.'%')));}
		$article = M('wage')->join('INNER JOIN lj_people ON lj_wage.pid = lj_people.id')->field('lj_wage.id,lj_wage.pid,lj_wage.yf,lj_wage.sf,FROM_UNIXTIME(lj_wage.time,"%Y-%m-%d") as times,lj_people.name,lj_people.ks')->where($where)->order($order)->page($p,$c)->select();
		$count = M('wage')->join('INNER JOIN lj_people ON lj_wage.pid = lj_people.id')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function addg (){
		$this->action="添加";
		$this->display();
	}

	public function getp (){
		$name=$_POST['name'];
		$data=M('people')->where(array('name'=>$name))->getField('id,name,ks,tel');
		foreach ($data as $k => $v) {
			switch ($data[$k]['ks']) {
			case '0': $data[$k]['bm']="司机"; break;
			case '1': $data[$k]['bm']="业务部"; break;
            case '2': $data[$k]['bm']="办公室"; break;
            case '3': $data[$k]['bm']="财务部"; break;
            case '4': $data[$k]['bm']="机务部"; break;
            case '5': $data[$k]['bm']="安全部"; break;
			}
		}
		
		$this->ajaxReturn($data);
	}

	/*添加表单处理*/
    public function runaddg () {
		$db = M("wage"); 
		$lei = array(//自动验证
	     array('pid','require','必须选择员工'), 
	     array('yf','require','应发工资必填'),
	     array('sf','require','实发工资必填'),
	     array('time','require','发薪日期必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'pid' => $_POST['pid'],
			'yf' => $_POST['yf'],			
			'sf' => I('sf'),
			'mark' => $_POST['mark'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Hr/gongzi'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Hr/addg'));
		}
    }

    public function updatag() {
    	$this->action="修改";
    	$id=I('id','',intval);
    	$this->v=M('wage')->join('INNER JOIN lj_people ON lj_wage.pid = lj_people.id')->field('lj_wage.*,lj_people.name,lj_people.ks,lj_people.tel')->where('lj_wage.id='.$id)->find();
		$this->display(addg);
    }

    public function deleteg () {
		if(M('wage')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Hr/gongzi'));
		}else{
			$this->error('删除失败！');
		}
	}

    public function xiaofei(){
    	$this->display();
    }

    public function xpage (){
		$c=$_GET['iDisplayLength'];
		$s=$_GET['sSearch'];
		$p=$_GET['iDisplayStart']/$c+1;
		$px=$_GET['sSortDir_0'];
		$col=$_GET['iSortCol_0'];
		switch ($col){ 
		case 0 : $order="id ".$px; break;
		case 2 : $order="ks ".$px; break; 
		case 4 : $order="money ".$px; break; 
		case 5 : $order="times ".$px; break; 
		} 
		$where=array();
		if($s){$where['name']=array('like','%'.$s.'%');$where['title']=array('like','%'.$s.'%');$where['_logic']='or';}
		$article = M('spend')->join('LEFT JOIN lj_people ON lj_spend.pid = lj_people.id')->field('lj_spend.id,lj_spend.pid,lj_spend.title,lj_spend.money,FROM_UNIXTIME(lj_spend.time,"%Y-%m-%d") as times,lj_people.name,lj_people.ks')->where($where)->order($order)->page($p,$c)->select();
		$count = M('spend')->join('LEFT JOIN lj_people ON lj_spend.pid = lj_people.id')->where($where)->count();
		$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
		$this->ajaxReturn($data);
	}

	public function addx (){
		$this->action="添加";
		$this->display();
	}

	/*添加表单处理*/
    public function runaddx () {
		$db = M("spend"); 
		$lei = array(//自动验证
	     array('pid','require','必须选择员工'), 
	     array('title','require','审批标题必填'),
	     array('money','require','金额必填'),
	     array('time','require','日期必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'pid' => $_POST['pid'],
			'title' => $_POST['title'],			
			'money' => I('money'),
			'mark' => $_POST['mark'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过 输出错误提示信息
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('Hr/xiaofei'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('Hr/addx'));
		}
    }

    public function updatax() {
    	$this->action="修改";
    	$id=I('id','',intval);
    	$this->v=M('spend')->join('LEFT JOIN lj_people ON lj_spend.pid = lj_people.id')->field('lj_spend.*,lj_people.name,lj_people.ks,lj_people.tel')->where('lj_spend.id='.$id)->find();
		$this->display(addx);
    }

    public function deletex () {
		if(M('spend')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('Hr/xiaofei'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function ajax(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('wage')->field('Sum(sf) as gz,FROM_UNIXTIME(time,"%m月") as m')->where(array('time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}

	public function rc(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('spend')->field('Sum(money) as rc,FROM_UNIXTIME(time,"%m月") as m')->where(array('time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}

}
?>