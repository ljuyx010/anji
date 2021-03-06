<?php
namespace Website\Controller;
use Think\Controller;

class AfterController extends CommonController{
	
	public function tousu(){		
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 3 : $order="type ".$px; break; 
			case 4 : $order="times ".$px; break; 
			} 
			$where=array();
			if($s){$where=array('people'=>array('like','%'.$s.'%'));}
			$article = M('bad')->field('id,people,carnum,type,FROM_UNIXTIME(time,"%Y-%m-%d") as times')->where($where)->order($order)->page($p,$c)->select();
			$count = M('bad')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addt(){
		$this->action="添加";
		$this->display();
	}

	public function runaddt(){
		$db = M("bad"); 
		$lei = array(//自动验证
	     array('people','require','名称必填'), 
	     array('type','require','类型必填'),
	     array('time','require','时间必填'),
	     array('mark','require','事由必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'people' => $_POST['people'],
			'type' => I('type'),
			'mark' => $_POST['mark'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/tousu'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/tousu'));
		}
	}

	public function updatat () {
    	$this->action="修改";
		$id= I('id');
		$v=M('bad')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addt);
    }

    public function deletet () {
		if(M('bad')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/tousu'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function safe(){		
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 4 : $order="times ".$px; break; 
			}
			$where=array();
			if($s){$where['people']=array('like','%'.$s.'%');$where['adress']=array('like','%'.$s.'%');$where['_logic']='or';}
			$article = M('shigu')->field('id,people,carnum,adress,FROM_UNIXTIME(time,"%Y-%m-%d") as times')->where($where)->order($order)->page($p,$c)->select();
			$count = M('shigu')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function adds(){
		$this->action="添加";
		$this->display();
	}

	public function runadds(){
		$db = M("shigu"); 
		$lei = array(//自动验证
	     array('people','require','责任人必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','时间必填'),
	     array('adress','require','地点必填'),
	     array('content','require','事发经过必填'),
	     array('end','require','处理结果必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'people' => $_POST['people'],
			'adress' => I('adress'),
			'content' => $_POST['content'],
			'end' => $_POST['end'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/safe'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/safe'));
		}
	}

	public function updatas () {
    	$this->action="修改";
		$id= I('id');
		$v=M('shigu')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(adds);
    }

    public function deletes () {
		if(M('shigu')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/safe'));
		}else{
			$this->error('删除失败！');
		}
	}

	//年审
	public function nianshen(){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 2 : $order="type ".$px; break; 
			case 3 : $order="time ".$px; break; 
			case 4 : $order="dtime ".$px; break; 
			} 
			$where=array();
			if($s){$where['carnum']=array('like','%'.$s.'%');}
			$article = M('shen')->field('money',true)->where($where)->order($order)->page($p,$c)->select();
			$count = M('shen')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
			foreach ($article as $k => $v) {
				$article[$k]['times']=date('Y-m-d', $article[$k]['time']);
				if($article[$k]['type']==0){$article[$k]['type']="保险";}else if($article[$k]['type']==1){$article[$k]['type']="营运证";}else{$article[$k]['type']="行车证";}
				if($article[$k]['dtime']<time()){$article[$k]['dtimes']="已过期";}else{$article[$k]['dtimes']=date('Y-m-d', $article[$k]['dtime']);}
			}
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addn(){
		$this->action="添加";
		$this->display();
	}

	public function runaddn(){
		$db = M("shen"); 
		$lei = array(//自动验证
	     array('type','require','类型必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','办理时间必填'),
	     array('dtime','require','过期时间必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'type' => $_POST['type'],
			'money' => I('money'),
			'mark' => $_POST['mark'],
			'pics' => implode("|",$_POST['pics']),
			'dtime' => strtotime($_POST['dtime']),
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($db->save($data)) $this->success('保存成功！',U('After/nianshen'));
		}else{
			if($db->add($data)) $this->success('添加成功！',U('After/nianshen'));
		}
	}

	public function updatan () {
    	$this->action="修改";
		$id= I('id');
		$v=M('shen')->where('id='.$id)->find();
		$this->v=$v;
		if($v['pics']){
		$this->pics=explode('|', $v['pics']);
		}
		$this->display(addn);
    }

    public function deleten () {
		if(M('shen')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/nianshen'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function weixiu(){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="id ".$px; break; 
			case 1 : $order="carnum ".$px; break; 
			case 2 : $order="type ".$px; break; 
			case 3 : $order="rq ".$px; break; 
			case 4 : $order="hours ".$px; break; 
			case 5 : $order="money ".$px; break; 
			} 
			$where=array();
			if($s){$where['carnum']=array('like','%'.$s.'%');}
			$article = M('xiu')->field('id,carnum,type,hours,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as rq,money')->where($where)->order($order)->page($p,$c)->select();
			$count = M('xiu')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function addw(){
		$this->action="添加";
		$this->display();
	}

	public function runaddw(){
		$db = M("xiu"); 
		$lei = array(//自动验证
	     array('type','require','类型必填'), 
	     array('carnum','require','车牌号必填'),
	     array('time','require','办理时间必填'),
	     array('money','require','金额必填'),
	     array('hours','require','工时必填')
		);
		$data = array(
			'id' => $_POST['id'],
			'carnum' => $_POST['carnum'],
			'type' => $_POST['type'],
			'money' => I('money'),
			'content' => $_POST['content'],
			'wxxm' => $_POST['wxxm'],
			'hours' => $_POST['hours'],
			'time' => strtotime($_POST['time'])
		 );

		if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
		}

		if($_POST['id']){
			if($res=$db->save($data)) $this->success('保存成功！',U('After/weixiu'));
		}else{
			if($res=$db->add($data)) $this->success('添加成功！',U('After/weixiu'));
		}
		if($res){
			$ktime=strtotime($_POST['time']." +".$_POST['hours']." hours");
			$car = array('xtime'=>strtotime($_POST['time']),'ktime'=>$ktime);
			M('car')->where(array('carnum'=>$_POST['carnum']))->setField($car);
		}
	}

	public function updataw () {
    	$this->action="修改";
		$id= I('id');
		$v=M('xiu')->where('id='.$id)->find();
		$this->v=$v;
		$this->display(addw);
    }

    public function deletew () {
		if(M('xiu')->where('id='.I('id'))->delete()){
			$this->success('删除成功！',U('After/weixiu'));
		}else{
			$this->error('删除失败！');
		}
	}

	public function dingd (){
		if($_GET['f']){
			$c=$_GET['iDisplayLength'];
			$s=$_GET['sSearch'];
			$p=$_GET['iDisplayStart']/$c+1;
			$px=$_GET['sSortDir_0'];
			$col=$_GET['iSortCol_0'];
			switch ($col){ 
			case 0 : $order="lj_ordcar.id ".$px; break; 
			case 1 : $order="ordernum ".$px; break; 
			case 4 : $order="ordtime ".$px; break; 
			case 5 : $order="mileage ".$px; break; 
			} 
			$where=array('zt'=>array('gt',0));
			if($s){$where['carnum']=array('like','%'.$s.'%');}
			$article = M('orders')->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->field('lj_ordcar.id,carnum,lj_ordcar.ordernum,driver,sdr,edr,zt,FROM_UNIXTIME(stime,"%Y-%m-%d %H:%i") as ctime,FROM_UNIXTIME(dtime,"%Y-%m-%d %H:%i") as otime,mileage')->where($where)->order($order)->page($p,$c)->select();
			$count = M('orders')->join('RIGHT JOIN lj_ordcar on lj_orders.ordernum=lj_ordcar.ordernum')->where($where)->count();
			$Page = new \Think\Page($count,$c);// 实例化分页类 传入总记录数和每页显示的记录数
	 		$data=array('iTotalRecords'=>$count,"iTotalDisplayRecords"=>$count,"aaData"=>$article);
			$this->ajaxReturn($data);
		}else{
			$this->display();
		}
	}

	public function finish (){
		$id=I('id');
		$this->v=M('ordcar')->join('LEFT JOIN lj_orders on lj_ordcar.ordernum=lj_orders.ordernum')->field('lj_ordcar.id,carnum,lj_ordcar.ordernum,edr,cid')->where('lj_ordcar.id='.$id)->find();
		$this->display();
	}

	public function jsuan(){
		$id=I('id');
		$cid=I('cid');
		$d=I('d','',intval);
		if($d<1){$this->error('天数不能小于1');}
		if(I('mileage',0,intval)<1){$this->error('公里数不能小于1');}
		$rs=M('class')->field('kmm')->where('id='.$cid)->find();
		$rs2=M('ordcar')->field('ordernum')->where('id='.$id)->find();
		if(I('mileage')>1600){
			$wage=$d*200;
		}elseif(I('mileage')<=300){
			$wage=ceil(I('mileage')/50)*10+$rs['kmm']+($d-1)*100;
		}else{
			$wage=ceil((I('mileage')-300)/50)*20+6*10+$rs['kmm']+($d-1)*100;
		}
		$data=array(
			'mileage'=>I('mileage'),
			'wage'=>$wage
		);
		//if(!$db->validate($lei)->create($data)){
		    // 如果创建失败 表示验证没有通过
		    //$this->error($db->getError());
		//}
		if(M('ordcar')->where('id='.$id)->save($data)){
			M('orders')->where('ordernum='.$rs2['ordernum'])->setField('zt',3);
			$this->success('保存成功',U('After/dingd'));
		}else{
			$this->error('保存失败');
		}
	}

	public function tongj (){
		$db=M('bad');
		$start=strtotime(date('Y-m-01 00:00:00'));
		$end = strtotime(date('Y-m-d H:i:s'));
		$where = array('time'=>array('between',array($start,$end)));
		$this->ts=$db->field('id,mark',true)->where(array_merge(array('type'=>0),$where))->select();
		$this->wz=$db->field('id,mark',true)->where(array_merge(array('type'=>1),$where))->select();
		$this->display();
	}

	public function ajax(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs1=M('bad')->field('Count(id) as num,FROM_UNIXTIME(time,"%m") as m')->where(array('type'=>0,'time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$new1=array();
		$new2=array();
		foreach($rs1 as $k=>$v){
			$new1=array_merge($new1,array($v['m']=>array('ts'=>$v['num'],'m'=>$v['m']."月")));
		}
		$rs2=M('bad')->field('Count(id) as wz,FROM_UNIXTIME(time,"%m") as m')->where(array('type'=>1,'time'=>array('egt',$year)))->group('m')->order('m ASC')->select();		
		foreach($rs2 as $k2=>$v2){
			$new2= array_merge(array($v2['m']=>array('wz'=>$v2['wz'],'m'=>$v2['m']."月")),$new2);
		}
		$rs=array_merge($new1,$new2);
		ksort($rs);	
		$this->ajaxReturn(array_values($rs));
	}

	public function oil(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs=M('oil')->field('SUM(oil) as oil,FROM_UNIXTIME(time,"%m月") as m')->where(array('time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$this->ajaxReturn($rs);
	}

	public function wx(){
		$year=strtotime(date('Y-01-01 00:00:00'));
		$rs1=M('xiu')->field('Sum(money) as wx,FROM_UNIXTIME(time,"%m") as m')->where(array('type'=>array('gt',0),'time'=>array('egt',$year)))->group('m')->order('m ASC')->select();
		$rs2=M('xiu')->field('Sum(money) as bao,FROM_UNIXTIME(time,"%m") as m')->where(array('type'=>0,'time'=>array('egt',$year)))->group('m')->order('m ASC')->select();

		$new1=array();
		$new2=array();
		foreach($rs1 as $k=>$v){
			if($v['m']){
			$new1=array_merge($new1,array($v['m']=>array('wx'=>$v['wx'],'m'=>$v['m']."月")));
			}
		}
		foreach($rs2 as $k2=>$v2){
			if($v2['m']){
				$k=$v2['m'];
				if($new1[$k]){
					$new2[$k] = array_merge(array('bao'=>$v2['bao'],'m'=>$v['m']."月"),$new1[$k]);
				}else{
					$new2[$k] = array('bao'=>$v2['bao'],'m'=>$v['m']."月",'wx'=>0);
				}				
			}
		}
		//p($new2);
		foreach($new2 as $k3=>$v3){
			$rs[]=$v3;
		}		
		$this->ajaxReturn($rs);	
	}

	public function oilist(){
		$time=strtotime(date('Y-m-01'));
		$rs=M('oil')->where(array('time'=>array('ELT',$time)))->field('max(id) as x')->group('carnum')->select();
		//p($rs);
		$ids=array();
		foreach($rs as $k=>$v){$ids[]=$v['x'];}
		$where['time']=array('EGT',$time);
		$where['lj_oil.id']=array('in',$ids);
		$where['_logic'] = 'OR';
		$this->yyl=M('oil')->join('INNER JOIN lj_car on lj_oil.carnum=lj_car.carnum')->field('lj_oil.carnum,Min(lic) as x,Max(lic) as d,SUM(oil) as s')
		->where($where)->group('lj_oil.carnum')->order('s desc')->select();
		//echo M('oil')->getLastSql();
		//p($yyl);die;
		$this->display();
	}

	public function addoil(){
		$db=M('oil');
		if($_POST){
			$lei = array(//自动验证
		     array('lic','require','里程必填'), 
		     array('carnum','require','车牌号必填'), 
		     array('time','require','日期必填'), 
		     array('oil','require','使用油料必填')
			);
			$data=array(
				'carnum'=>$_POST['carnum'],
				'oil'=>(int)$_POST['oil'],
				'time'=>strtotime($_POST['time'])
			);
			if($_POST['lic']){
				$data['lic']=$_POST['lic'];
			}else{
				$rs=$db->field('lic')->where(array('carnum'=>$_POST['carnum']))->order('lic DESC')->find();
				$data['lic']=$rs['lic'];
				$data['type']=1;
			}
			
			if (!$db->validate($lei)->create($data)){
		     // 如果创建失败 表示验证没有通过
		     $this->error($db->getError());
			}
			if($db->add($data)){
				$this->success('保存成功',U('After/oilist'));
			}else{
				$this->error('保存失败');
			}
		}else{
			$this->display();
		}		
	}

	public function xlist(){
		$id=I('id');
		$count=M('oil')->where(array('carnum'=>$id))->count();
		$Page = new \Think\Page($count,20);
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$show = $Page->show();
		$this->list = M('oil')->where(array('carnum'=>$id))->order('time DESC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;
		$this->carnum=$id;
		$this->display();
	}

	public function delx(){
		$id=I('id');
		$c=M('oil')->where('id='.$id)->getField('carnum');
		if(M('oil')->where('id='.$id)->delete()){
			$this->success('删除成功！',U('After/xlist',array('id'=>$c)));
		}else{
			$this->error('删除失败');
		}
	}
	
	public function daochu(){
		$this->display();
	}
	
	public function tongji(){
		$s=strtotime($_POST['start']);
		$d=strtotime($_POST['end']);
		$where=array('time'=>array('between',array(I('s'),I('d'))));
		if($_POST['type']==1){
			$data=M('oil')->field('carnum,lic,oil,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as s,type')->where($where)->order('time desc')->select();
		$t[0]=array('车牌号','加油时车辆里程','加油量(L)','加油时间','加油地点(0站内,1站外)');
		$name="加油登记".date('Ymd');
		}else if($_POST['type']==2){
			$data=M('xiu')->field('carnum,type,wxxm,hours,money,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as s,content')->where($where)->order('time desc')->select();
		$t[0]=array('车牌号','维修类型(0保养,1小修,2大修)','维修项目','工时','维修费用','维修时间','材料');
		$name="维修登记".date('Ymd');
		}else{
			$data=M('sbei')->field('name,num,jia,FROM_UNIXTIME(dtime,"%Y-%m-%d %H:%i") as s,FROM_UNIXTIME(time,"%Y-%m-%d %H:%i") as d')->where($where)->order('time desc')->select();
		$t[0]=array('设备名','数量','价格','设备过期时间','登记时间');
		$name="设备购入".date('Ymd');
		}		
		$data=array_merge($t,$data);
		$n=$name.".xls";
		create_xls($data,$n);
	}

}
?>