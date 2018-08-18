<?php
namespace Index\Controller;
use Think\Controller;

class WeixinController extends Controller{
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
			'out_refund_no'=>$result['transaction_id'],
			'zt'=>1,
			);
			$c=M('orders')->where(array('ordernum'=>$dh,'zt'=>0))->save($jj);			
		}
		if($c){	 
			$or=M('orders')->where(array('ordernum'=>$dh))->find();
			M('user')->where(array('id'=>$or['uid']))->save(array('gname'=>$or['gname'],'name'=>$or['uname'],'tel'=>$or['utel']));
			$openid=M('user')->where(array('id'=>$or['uid']))->getField('openid');
			$data=array(  
			   'first'=>array('value'=>urlencode("尊敬的用户，您已下单成功"),'color'=>"#333"),  
			   'keyword1'=>array('value'=>urlencode($or['ordernum']),'color'=>'#ED1B28'),  
			   'keyword2'=>array('value'=>urlencode(date('Y-m-d H:i',$or['ordtime'])),'color'=>'#333'),     
			   'keyword3'=>array('value'=>urlencode($or['title']),'color'=>'#333'),     
			   'keyword4'=>array('value'=>urlencode(date('Y-m-d H:i',$or['stime'])),'color'=>'#333'),     
			   'keyword5'=>array('value'=>urlencode(date('Y-m-d H:i',$or['dtime'])),'color'=>'#333'),     
			   'remark'=>array('value'=>urlencode("感谢您对安吉旅游的支持！服务热线：0712-2467890")),  
			);
			$data1=array(
				'first'=>array('value'=>urlencode("亲，您有新的已支付订单"),'color'=>"#333"),
				'keyword1'=>array('value'=>urlencode($or['ordernum']),'color'=>'#ED1B28'),  
			    'keyword2'=>array('value'=>urlencode(date('Y-m-d H:i',$or['ordtime'])),'color'=>'#333'),     
			    'keyword3'=>array('value'=>urlencode($or['title']),'color'=>'#333'),     
			    'keyword4'=>array('value'=>urlencode(date('Y-m-d H:i',$or['stime'])),'color'=>'#333'),     
			    'keyword5'=>array('value'=>urlencode(date('Y-m-d H:i',$or['dtime'])),'color'=>'#333'),
				'remark'=>array('value'=>urlencode("请尽快到系统后台处理。")), 
			);
			//发送付款成功通知
			doSend($openid,'xyrjKQgTFBxdcewTu0Z3kc9WVqGoTDyIPwqzKsFyE3Y',_URL_,$data);
			doSend('ovmP91UWPl4682pCJuJSSET1n22Y','xyrjKQgTFBxdcewTu0Z3kc9WVqGoTDyIPwqzKsFyE3Y','http://www.xgbcw.cn/index.php/Website',$data1);
		}
	}
}