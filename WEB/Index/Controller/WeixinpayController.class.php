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
			'zt'=>2,
			);
			$c=M('orders')->where(array('order'=>$dh,'zt'=>1))->save($jj);			
		}
		if($c){	 
			$or=M('orders')->where(array('order'=>$dh))->find();
			$openid=M('user')->where(array('id'=>$or['uid']))->getField('openid');
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
		}
	}
}
?>