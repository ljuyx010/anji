<?php
function say(){
	echo "hello word!";
}

function orderhandle($parameter){
	if($parameter['trade_status']){
		$data=array(
		'order' => $parameter['out_trade_no'],
		'trade' => $parameter['trade_no'],
		'buyer_alipay' => $parameter['buyer_email'],
		'total_fee' => $parameter['total_fee'],
		'trade_status' => $parameter['trade_status'],
		'status' => 2,
		'paytime' => $parameter['notify_time']
		);
	}	
	
	M('orders')->where(array('order'=>$parameter['out_trade_no']))->save($data);
} 
?>