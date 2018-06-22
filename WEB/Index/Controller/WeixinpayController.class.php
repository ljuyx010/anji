<?php
namespace Index\Controller;
use Think\Controller;

class WeixinpayController extends CommonController{

	public function index(){
		$id=I('id','',intval);
		$data=M('orders')->where(array('id'=>$id,'uid'=>session('stuID')))->find();
		if($data){
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -4) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));//生成订单号
			M('orders')->where(array('id'=>$id))->setField('ordernum',$orderSn);
			$this->odr=$orderSn;
			$this->v=$data;
			$this->display();
		}else{
			$this->error('没有这个订单');
		}
	}
	/**
	 * 公众号支付 必须以get形式传递 out_trade_no 参数
	 * 中的wexinpay_js方法
	 */
	public function pay(){
		// 导入微信支付sdk
		Vendor('Weixinpay.Weixinpay');
		$wxpay=new \Weixinpay();
		// 获取jssdk需要用到的数据
		$order=I('out_trade_no');
		
		$data=$wxpay->getParameters($order);
		// 将数据分配到前台页面
		$assign=array(
			'data'=>json_encode($data)
			);
		$this->assign($assign);
		$this->display();
	}

	public function del(){
		$id=I('id','',intval);
		$where=array('id'=>$id,'uid'=>session('stuID'));
		$rs=M('orders')->field('ordernum')->where($where)->find();
		if(M('orders')->where($where)->delete()){
			M('ordcar')->where(array('ordernum'=>$rs['ordernum']))->delete();
			$this->success('订单已取消',U('User/index'));
		}else{
			$this->error('订单取消失败');
		}
	}

	public function sq(){
		$id=I('id','',intval);
		$data=array('zt'=>-1,'backtime'=>time());
		if(M('orders')->where(array('id'=>$id,'uid'=>session('stuID')))->save($data)){
			$this->success('已申请取消订单',U('User/index'));
		}else{
			$this->error('申请失败请联系管理员');
		}
	}

	public function qxsq(){
		$id=I('id','',intval);
		if(M('orders')->where(array('id'=>$id,'uid'=>session('stuID')))->setField('zt',1)){
			$this->success('已取消申请',U('User/index'));
		}else{
			$this->error('取消申请失败');
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
			'out_refund_no'=>$result['transaction_id'],
			'zt'=>1,
			);
			$c=M('orders')->where(array('ordernum'=>$dh,'zt'=>0))->save($jj);			
		}
		if($c){	 
			$or=M('orders')->where(array('ordernum'=>$dh))->find();
			M('user')->where(array('id'=>$or['uid']))->save(array('name'=>$or['uname'],'tel'=>$or['utel']));
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
			//发送付款成功通知
			doSend($openid,'xyrjKQgTFBxdcewTu0Z3kc9WVqGoTDyIPwqzKsFyE3Y',"http://".$_SERVER['SERVER_NAME'],$data); 						
		}
	}
}
?>