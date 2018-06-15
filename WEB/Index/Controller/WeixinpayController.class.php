<?php
namespace Index\Controller;
use Think\Controller;

class WeixinpayController extends Controller{
	/**
	 * 公众号支付 必须以get形式传递 out_trade_no 参数
	 * 中的wexinpay_js方法
	 */
	public function pay(){
		if(empty($_GET['uname']) || empty($_GET['tel']) || empty($_GET['adress'])){
			$this->error('请把联系人信息填写完整！');
		}
		// 导入微信支付sdk
		Vendor('Weixinpay.Weixinpay');
		$wxpay=new \Weixinpay();
		// 获取jssdk需要用到的数据
		$order=I('out_trade_no');		
		if(I('sumprice')<I('fx')){
			$dd= array(
			'sumprice'=>0,
			'dk'=>I('sumprice'),
			'paytime'=>time(),
			'status'=>2,
			'total_fee'=>0,
			'uname'=>I('uname'),
			'tel'=>I('tel'),
			'adress'=>I('adress'),
			'remark'=>I('remark')
			);
			if(M('orders')->where(array('id'=>I('oid')))->save($dd)){
				M('member')->where('id='.session('userID'))->setDec('fx',I('sumprice'));
				$jf=array('mid'=>session('userID'),'stutas'=>0,'jf'=>I('sumprice'),'gid'=>I('pid'),'beizhu'=>"购买商品：".I('pname')."抵扣",'time'=>time());
				M('jf')->data($jf)->add();
				redirect(MODULE_NAME.'/member/orders');
			}else{
				$this->error('交易失败');
			}
		}else{
			//重新生成订单号
			$orders=substr($order,0,strlen($order)-2).rand(10,99);			
			$dd=array(
			'order'=>$orders,
			'uname'=>I('uname'),
			'tel'=>I('tel'),
			'adress'=>I('adress'),
			'remark'=>I('remark'),
			'dk'=> I('fx'),			
			'total_fee'=>I('total_fee')
			);
			M('orders')->where(array('id'=>I('oid'),'order'=>$order))->save($dd);
			$data=$wxpay->getParameters($orders);
			// 将数据分配到前台页面
			$assign=array(
				'data'=>json_encode($data)
				);
			$this->assign($assign);
			$this->display();
		}
	}
	
	/**
	 * notify_url接收页面
	 */
	public function notify(){
		Vendor('Weixinpay.Weixinpay');
		$wxpay=new \Weixinpay();
		$result=$wxpay->notify();
		if ($result){
			// 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
			$dh=$result['out_trade_no'];
			$jj=array(
			'paytime'=>time(),
			'status'=>2,
			);
			$c=M('orders')->where(array('order'=>$dh,'status'=>array('LT',2)))->save($jj);			
		}
		if($c){	 
			$or=M('orders')->where(array('order'=>$dh))->find();
			$openid=M('member')->where(array('id'=>$or['uid']))->getField('openid');
			$conf=F('Site','',APP_PATH.'/Data/');
			$pz=M('conf')->where(array('id' => 0))->getField('confing');
			if($or['pcid']==4){$open=$pz['openid1'];}
			if($or['pcid']==6){$open=$pz['openid2'];}
			if($or['pcid']==7){$open=$pz['openid3'];}
			$data=array(  
			   'first'=>array('value'=>urlencode("尊敬的客户，您已下单成功"),'color'=>"#00CD00"),  
			   'keyword1'=>array('value'=>urlencode($or['pname']),'color'=>'#00CD00'),  
			   'keyword2'=>array('value'=>urlencode("单号".$dh),'color'=>'#EE5C42'),     
			   'remark'=>array('value'=>urlencode("如有疑问可致电：".$conf['contact']),'color'=>'#030303'),  
			);
			$data2=array(  
			   'first'=>array('value'=>urlencode("您有新订单需处理"),'color'=>"#EE5C42"),  
			   'keyword1'=>array('value'=>urlencode("环保云管家商城有一个新订单已下单"),'color'=>'#030303'),  
			   'keyword2'=>array('value'=>urlencode(date("Y-m-d h:i",time())),'color'=>'#030303'),     
			   'keyword3'=>array('value'=>urlencode("单号:".$dh),'color'=>'#00CD00'),     
			   'remark'=>array('value'=>urlencode("请尽快登录网站后台处理！"),'color'=>'#030303'),  
			);
			//发送付款成功通知
			doSend($openid,'Uugs60RrAwUFQQaBBi8jU0tuWismOrr4fmex1CLLc2U','http://yunguanjia.35xg.com/index.php/Index/member/index/',$data); 			
			doSend($open,'zJ3zwVzMUmTL5s6zWcQ5XcxH2jzulDFCOU1ABrK86jQ','http://yunguanjia.35xg.com/',$data2); 			
			if($or['dk']>0){//分销提成抵扣
				M('member')->where('id='.$or['uid'])->setDec('fx',$or['dk']);
				$jf=array('mid'=>$or['uid'],'stutas'=>0,'jf'=>$or['dk'],'gid'=>$or['pid'],'beizhu'=>"购买商品：".$or['pname']."抵扣",'time'=>time());
				M('jf')->data($jf)->add();
			}
			if($or['trade']){
			//分销提成计算
			$fx=$or['total_fee']*$conf['fx'];
			M('member')->where('id='.$or['trade'])->setInc('fx',$fx);
			$jf=array('mid'=>$or['trade'],'stutas'=>1,'jf'=>$fx,'gid'=>$or['pid'],'beizhu'=>"推荐用户id:".$or['uid'].",购买商品：".$or['pname'],'time'=>time());
			M('jf')->data($jf)->add();
			}
		}
	}
}
?>