<?php
namespace Index\Controller;
use Think\Controller;
use \Lib;

class GoodsController extends Controller{
	
	public function index () {
		
		$field = array('id','classname','sort','title','pics');
		$count = M('class')->count();
		$Page = new \Think\Page($count,C('PAGE_NUM'));// 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header','共%TOTAL_ROW%条');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','共%TOTAL_PAGE%页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST% %UP_PAGE% %DOWN_PAGE% %HEADER%');
		$show = $Page->show();
		$this->goods = M('class')->field($field)->order('sort ASC,id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->page = $show;			
		$this->display();		
	}

	public function details () {
		$id = I('id','',intval);
		$db = M('goods');
		$data = $db->where(array('id'=>$id))->find();
		$cid = $data['cid'];
		$clas = $data['classid'];
		$this->title = $data['title'];
		$this->keywords = $data['keywords'];
		$this->descriptions = $data['description'];
		$this->time = $data['time'];
		$this->content = stripslashes($data['content']);
		$this->timg = $data['pic'];
		$this->g = $data;

		$this->clas = M('class')->where(array('id'=>$clas))->find();
		//评论列表
		$fz="Goods_".$id;
		$this->counts=M('ping')->where(array('fz'=>$fz,'dis'=>1))->count();
		$ping=M('ping')->where(array('fz'=>$fz,'_string'=>'dis=1 or hfid <>0'))->join('LEFT JOIN lj_member ON lj_ping.mid = lj_member.id')->field('lj_ping.*,lj_member.username')->order('lj_ping.id DESC')->select();
		$this->ping = Lib\Category::unlimitedForping($ping);
		$this->fz=$fz;
		
		$cate = Lib\Cate::catetkd($cid);
		$this->sid = $id;
		$this->cid = $cid;
		$this->fid = $cate[0]['pid'];
		$this->name = $cate[0]['name'];
		$this->pic = $cate[0]['pic'];
		$this->model = $cate[0]['model'];
		$this->img = M('atlas')->where(array('gid'=>$id))->select();

		$last_rs = $db->where(array('id' => array('GT',$id), 'del' => 0, 'cid' =>$cid))->order(array('id'=>'ASC'))->limit(1)->find(); //GT =>'小于'
		$next_rs = $db->where(array('id' => array('LT',$id), 'del' => 0, 'cid' =>$cid))->order(array('id'=>'DESC'))->limit(1)->find(); //LT => '大于'
        
        if ( !empty($last_rs) ) 
        {
            $last = "上一篇：<a href=";
            $last .= U(MODULE_NAME.'/details_'.$last_rs['id']);
            $last .= "'>{$last_rs['title']}</a>";
        }
        else 
        {
            $last = "上一篇：已是第一篇";
        }
        if ( !empty($next_rs) )
        {
            $next = "下一篇：<a href='";
            $next .= U(MODULE_NAME.'/details_'.$next_rs['id']);
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
		M('goods')->where($where)->setInc('click');
		$click = M('goods')->where($where)->getField('click');		
		echo 'document.write('.$click.')';
	}
	
	//商品预订
	public function reser(){
		if(!$_POST['uname']) $this->error('姓名不能为空');
		if(!$_POST['address']) $this->error('地址不能为空');
		if(!$_POST['tel']) $this->error('电话不能为空');
		if(!$_POST['num'] && $_POST['num'] >= 1) $this->error('订购数量不能为空且要大于1');
		$pid = (int) $_POST['pid'];
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,isdis')->find();
		$price=$gata['price'];
		$msg= ($gata['isdis']) ? "政府补贴" : "暂无" ;
		$sumprice=$_POST['num']*$price;
		$h=time();
		$dh="A".date("y",time()).substr($h, -8).date("md",time());
		$data = array(
			'uid' => $_POST['uid'],
			'uname' => $_POST['uname'],
			'tel' => $_POST['tel'],
			'address' => $_POST['address'],
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => $_POST['num'],
			'sumprice' => $sumprice,
			'buytime' => $h,
			'remark' => $_POST['remark'],
			'status' => 1
		);
		
		$to="sales@hubeishunye.com";
		$title="您有新订单".$dh;
		$content="<strong>订单详细信息</strong><br />订单号:".$dh."<br />商品名称:".$gata['title']."<br />优惠活动:".$msg."<br />订购数量:".$_POST['num']."<br />单价:".$price."<br />总价：".$sumprice."<br />订购者名称:".$_POST['uname']."<br />订购者电话:".$_POST['tel']."<br />订购地址:".$_POST['address']."<br />下单时间:".date('Y-m-d H:i:s',$h)."<br />备注信息:".$_POST['remark']."<br/><br /><br/>本邮件为系统邮件，请勿回复!";
		
		SendMail($to,$title,$content);
		if(M('orders')->add($data)){
			$this->success('商品预订成功');
		}else{
			$this->error('商品预订失败');
		}
	}
	
	//放入购物车页面
	public function cart (){
		if(!session('memberid')){$this->redirect(MODULE_NAME.'/Member/index','', 3, '请先登录...');}
		$uid=session('memberid');
		$pid=(int) $_GET['id'];
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,isdis')->find();
		if($gata['isdis']){$price=$gata['memprice'];}else{$price=$gata['price'];}
		$h=time();
		$dh="A".date("y",time()).substr($h, -8).date("md",time());
		$data = array(
			'uid' => $uid,
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => 1,
			'sumprice' => $price,
			'buytime' => $h,
			'status' => 0
		);
		if(M('orders')->add($data)){
			$this->success('商品已加入购物车');
		}else{
			$this->error('加入购物车失败');
		}

	}
		
	//下单页面
	public function buy (){
		if(!session('memberid')){$this->redirect(MODULE_NAME.'/Member/index','', 3, '请先登录...');}
		$h=time();
		$dh="B".date("y",time()).substr($h, -8).date("md",time());
		$uid=session('memberid');
		$pid=(int) $_GET['id'];
		if($pid !== (int) $_POST['pid']){$this->error('参数错误');}
		$gata=M('goods')->where(array('id'=>$pid))->field('title,price,memprice,stock,isdis')->find();
		if($gata['stock']<$_POST['num']){$this->error('购买数量大于库存，请修改');}else{$num = (int) $_POST['num'];}
		if($gata['isdis']){$price=$gata['memprice'];}else{$price=$gata['price'];}
		$data = array(
			'uid' => $uid,
			'pid' => $pid,
			'pname' => $gata['title'],
			'order' => $dh,
			'price' => $price,
			'num' => $num,
			'sumprice' => $price*$num,
			'buytime' => $h,
			'status' => 1
		);
		if(M('orders')->add($data)){
			$this->success('下单成功',U(MODULE_NAME.'/Orders/index',array('order',$dh)));
		}else{
			$this->error('下单失败');
		}
	}
	
	
}
?>