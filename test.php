<?php
$url = "http://www.xgbcw.cn/index.php/Index/Weixin/notify";  
$data = '<xml><AppId>wxf8b4f85f3a794e77</AppId><ErrorType>1001</ErrorType><Description>错误描述</Description><AlarmContent>transaction_id=33534453534</AlarmContent><TimeStamp>1393860740</TimeStamp><AppSignature>f8164781a303f4d5a944a2dfc68411a8c7e4fbea</AppSignature><SignMethod>sha1</SignMethod></xml>';  
  
$ch = curl_init();  
$header[] = "Content-type: text/xml";//定义content-type为xml  
curl_setopt($ch, CURLOPT_URL, $url); //定义表单提交地址  
curl_setopt($ch, CURLOPT_POST, 1);   //定义提交类型 1：POST ；0：GET  
curl_setopt($ch, CURLOPT_HEADER, 1); //定义是否显示状态头 1：显示 ； 0：不显示  
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义请求类型  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//定义是否直接输出返回流  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据，这里是XML文件  
$result = curl_exec($ch);  
curl_close($ch);//关闭  
