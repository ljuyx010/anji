<?php
namespace Website\Controller;
use Think\Controller;
use Aliyun\Core\Config;  
use Aliyun\Core\Profile\DefaultProfile;  
use Aliyun\Core\DefaultAcsClient;  
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest; 

class DxinController extends CommonController {
	
	public function sendMsg($tel,$code,$nei){
    require_once '/Api/alidy/vendor/autoload.php'; //此处为你放置API的路径
    Config::load(); //加载区域结点配置	

	$rs=M('site')->field('value')->where(array('name'=>"extend"))->find();
    $data =unserialize($rs['value']);
	
    $accessKeyId = $data['AccessKey'];
    $accessKeySecret = $data['AccessSecret'];
	
    $templateCode = $data['mbid'];   //短信模板ID
    //短信API产品名（短信产品名固定，无需修改）
    $product = "Dysmsapi";
    //短信API产品域名（接口地址固定，无需修改）
    $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
    $region = "cn-hangzhou";
    // 初始化用户Profile实例
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient = new DefaultAcsClient($profile);
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置短信接收号码
    $request->setPhoneNumbers($mobile);    //$moblie是我前台传入的电话
    // 必填，设置签名名称
    $request->setSignName($data['qm']);      //此处需要填写你在阿里上创建的签名
    // 必填，设置模板CODE
    $request->setTemplateCode($code);    //短信模板编号
	$smsData = $nei;    //所使用的模板若有变量 在这里填入变量的值  我的变量名为username此处也为username
    $request->setTemplateParam(json_encode($smsData));   
    //发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);
    //返回请求结果
    $result = json_decode(json_encode($acsResponse), true);
    if($result){$this->ajaxReturn("短信已发送");}else{$this->ajaxReturn("发送失败请重试");}
	}
	
}
?>