<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// 定义时区
ini_set('date.timezone','Asia/Shanghai');

class Weixinpay {
    // 定义配置项
    private $config=array(
        'APPID'              => '', // 微信支付APPID
        'MCHID'              => '', // 微信支付MCHID 商户收款账号
        'KEY'                => '', // 微信支付KEY
        'APPSECRET'          => '',  //公众帐号secert
        'NOTIFY_URL'         => '/index.php/Index/Weixinpay/notify', // 接收支付状态的连接  改成自己的域名
        );

    // 构造函数
    public function __construct(){
        // 如果是在thinkphp中 那么需要补全/Application/Common/Conf/config.php中的配置
        // 如果不是在thinkphp框架中使用；那么注释掉下面一行代码；直接补全 private $config 即可
        $this->config=C('WEIXINPAY_CONFIG');
    }

    /**
     * 统一下单
     * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)、trade_type(类型：JSAPI，NATIVE，APP)
     */
    public function unifiedOrder($order){
        // 获取配置项
        $weixinpay_config=$this->config;
        $config=array(
            'appid'=>$weixinpay_config['APPID'],
            'mch_id'=>$weixinpay_config['MCHID'],
            'nonce_str'=>'anjilvyou',
            'spbill_create_ip'=> get_client_ip(),
            'notify_url'=>$weixinpay_config['NOTIFY_URL']
            );
        // 合并配置数据和订单数据
        $data=array_merge($order,$config);
        // 生成签名
        $sign=$this->makeSign($data);
        $data['sign']=$sign;		
        $xml=$this->toXml($data);
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';//接收xml数据的文件
        $header[] = "Content-type: text/xml";//定义content-type为xml,注意是数组
        $ch = curl_init ($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 兼容本地没有指定curl.cainfo路径的错误
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            // 显示报错信息；终止继续执行
            die(curl_error($ch));
        }
        curl_close($ch);
        $result=$this->toArray($response);
        // 显示错误信息
        if ($result['return_code']=='FAIL') {
            die($result['return_msg']);
        }
        $result['sign']=$sign;
        $result['nonce_str']='anjilvyou';
        return $result;
    }


    /**
     * 验证
     * @return array 返回数组格式的notify数据
     */
    public function notify(){
        // 获取xml
        $xml=file_get_contents('php://input', 'r'); 
        // 转成php数组
        $data=$this->toArray($xml);        
        // 保存原sign
        $data_sign=$data['sign'];
        // sign不参与签名
        unset($data['sign']);
        $sign=$this->makeSign($data);
        // 判断签名是否正确  判断支付状态
        if ($sign===$data_sign && $data['return_code']=='SUCCESS' && $data['result_code']=='SUCCESS') {
            $result=$data;
        }else{
            $result=false;
        }
        // 返回状态给微信服务器
        if ($result) {
            $str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        }else{
            $str='<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[签名失败]]></return_msg></xml>';
        }
        echo $str;
        return $result;
    }

    /**
     * 输出xml字符
     * @throws WxPayException
    **/
    public function toXml($data){
        if(!is_array($data) || count($data) <= 0){
            throw new WxPayException("数组数据异常！");
        }
        $xml = "<xml>";
        foreach ($data as $key=>$val){
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml; 
    }

    /**
     * 生成签名
     * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     */
    public function makeSign($data){
        // 去空
        $data=array_filter($data);
        //签名步骤一：按字典序排序参数
        ksort($data);
        $string_a=http_build_query($data);
        $string_a=urldecode($string_a);
        //签名步骤二：在string后加入KEY
        $config=$this->config;
        $string_sign_temp=$string_a."&key=".$config['KEY'];
        //签名步骤三：MD5加密
        $sign = md5($string_sign_temp);
        // 签名步骤四：所有字符转为大写
        $result=strtoupper($sign);
        return $result;
    }

    /**
     * 将xml转为array
     * @param  string $xml xml字符串
     * @return array       转换得到的数组
     */
    public function toArray($xml){   
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $result= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        
        return $result;
    }

    /**
     * 获取jssdk需要用到的数据
     * @return array jssdk需要用到的数据
     */
    public function getParameters($dh){
        // 获取配置项
        $config=$this->config;		
		// 获取订单号
		$out_trade_no=$dh;
		$openid=session('userOpenid');
		// 订单数据  请根据订单号out_trade_no 从数据库中查出实际的body、total_fee、out_trade_no、product_id
		$dingd=M('orders')->where(array('ordernum'=>$out_trade_no))->find();
		$order=array(
			'body'=>$dingd['des'],// 商品描述（需要根据自己的业务修改）
			'total_fee'=>$dingd['money']*100,// 订单金额  以(分)为单位（需要根据自己的业务修改）
			'out_trade_no'=>$out_trade_no,// 订单号（需要根据自己的业务修改）
			'product_id'=>$dingd['cid'],// 商品id（需要根据自己的业务修改）
			'trade_type'=>'JSAPI',// JSAPI公众号支付
			'openid'=>$openid// 获取到的openid
		);
		// 统一下单 获取prepay_id
		$unified_order=$this->unifiedOrder($order);
		// 获取当前时间戳
		$time=time();
		// 组合jssdk需要用到的数据
		$data=array(
			'appId'=>$config['APPID'], //appid
			'timeStamp'=>strval($time), //时间戳
			'nonceStr'=>$unified_order['nonce_str'],// 随机字符串
			'package'=>'prepay_id='.$unified_order['prepay_id'],// 预支付交易会话标识
			'signType'=>'MD5'//加密方式
		);
		// 生成签名
		$data['paySign']=$this->makeSign($data);
		
		return $data; 
    }

    public function refund($dh) {  
        $config=$this->config;
        $dingd=M('orders')->where(array('ordernum'=>$dh))->find();
        // if($dingd['stime']-$dingd['backtime']<=86400*2){
        //     $money=$dingd['money']*0.9*100;
        // }else{
        //     $money=$dingd['money']*100;
        // }
        $money=$dingd['money']*100;
        $date = date("YmdHis");  
        $appid = $config['APPID'];  
        $mch_id = $config['MCHID'];  
        $out_trade_no = $dh;  
        $op_user_id = "";  
        $out_refund_no = $date;  
        $total_fee = $dingd['money']*100;  
        $refund_fee = $money;  
        //$transaction_id = "4009542001201706206596667604";  
        $key = "";  
        $nonce_str = $this->nonceStr();  
      
        $ref = strtoupper(md5("appid=$appid&mch_id=$mch_id&nonce_str=$nonce_str&op_user_id=$op_user_id"  
                        . "&out_refund_no=$out_refund_no&out_trade_no=$out_trade_no&refund_fee=$refund_fee&total_fee=$total_fee"  
                        . "&key=$key")); //sign加密MD5  
      
        $refund = array(  
        'appid' =>$config['APPID'], //应用ID，固定  
        'mch_id' => $config['MCHID'], //商户号，固定  
        'nonce_str' => $nonce_str, //随机字符串  
        'op_user_id' => $op_user_id, //操作员  
        'out_refund_no' => $out_refund_no, //商户内部唯一退款单号  
        'out_trade_no' => $out_trade_no, //商户订单号,pay_sn码 1.1二选一,微信生成的订单号，在支付通知中有返回  
        //'transaction_id'=>'1',//微信订单号 1.2二选一,商户侧传给微信的订单号  
        'refund_fee' => $refund_fee, //退款金额  
        'total_fee' => $total_fee, //总金额  
        'sign' => $ref//签名  
        );  
      
        $url = "https://api.mch.weixin.qq.com/secapi/pay/refund";  
        ; //微信退款地址，post请求  
        $xml = $this->toXml($refund);  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_HEADER, 1);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); //证书检查  
        if ($useCert == true) {  
            // 设置证书  
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'pem');  
            curl_setopt($ch, CURLOPT_SSLCERT, dirname(__FILE__) . '/cert/apiclient_cert.pem');  
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'pem');  
            curl_setopt($ch, CURLOPT_SSLKEY, dirname(__FILE__) . '/cert/apiclient_key.pem');  
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'pem');  
            curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cert/rootca.pem');  
        }  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);  
      
        $xml = curl_exec($ch);
      
        // 返回结果0的时候能只能表明程序是正常返回不一定说明退款成功而已  
        if ($xml) {  
            curl_close($ch);  
            // 把xml转化成数组  
            libxml_disable_entity_loader(true);  
            $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);  
            //var_dump($xmlstring);  
            $result['errNum'] = 0;  
            $result['info'] = $this->object_to_array($xmlstring);  
            //var_dump($result);  
            return $result;  
        } else {  
            $error = curl_errno($ch);  
            curl_close($ch);  
            // 错误的时候返回错误码。  
            $result['errNum'] = $error;  
            return $result;  
        }  
    }

    /**
     * 生成支付二维码
     * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)、trade_type(类型：JSAPI，NATIVE，APP)
     */
    public function pay($order){
        $result=$this->unifiedOrder($order);
        $decodeurl=urldecode($result['code_url']);
        qrcode($decodeurl);
    }

    /**
     * curl 请求http
     */
    public function curl_get_contents($url){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
        // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
        curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
        $r=curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    function object_to_array($obj) {  
        $obj = (array) $obj;  
        foreach ($obj as $k => $v) {  
            if (gettype($v) == 'resource') {  
                return;  
            }  
            if (gettype($v) == 'object' || gettype($v) == 'array') {  
                $obj[$k] = (array) object_to_array($v);  
            }  
        }  
      
      
        return $obj;  
    }

    function nonceStr() {  
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
        $str = "";  
        $length = 32;  
        for ($i = 0; $i < $length; $i++) {  
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);  
        }  
        // 随机字符串    
        return $str;  
    }  


}