<?php
namespace Index\Controller;
use Think\Controller;

class WeixinpayController extends CommonController{

	public function index(){
		$id=I('id');
		$data=M('orders')->where(array('ordernum'=>$id,'uid'=>session('userID')))->find();
		if($data){
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -4) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));//生成订单号
			M('orders')->where(array('ordernum'=>$id))->setField('ordernum',$orderSn);
			M('ordcar')->where(array('ordernum'=>$id))->setField('ordernum',$orderSn);
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
		$where=array('id'=>$id,'uid'=>session('userID'));
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
		if(M('orders')->where(array('id'=>$id,'uid'=>session('userID')))->save($data)){
			$this->success('已申请取消订单',U('User/index'));
		}else{
			$this->error('申请失败请联系管理员');
		}
	}

	public function qxsq(){
		$id=I('id','',intval);
		if(M('orders')->where(array('id'=>$id,'uid'=>session('userID')))->setField('zt',1)){
			$this->success('已取消申请',U('User/index'));
		}else{
			$this->error('取消申请失败');
		}
	}
	
}
?>