<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 6px; }
.message{width: 400px;height: 200px;margin:auto;border:1px solid #1B8F24; border-radius:3px; margin-top: 50px;}
.head{width: 100%;height: 40px;line-height:40px;font-size:16px;font-weight:500;background:#dff0d8;text-align: center;}
.content{height: 120px;width: 100%;}
.content em{font-size:16px; font-weight:600;font-style:normal;}
.success ,.error{ font-size: 14px; text-align: center;margin-top: 30px;}
.success{color:#5cb85c;}.error{color:#d9534f;}
.jump{text-align: center;margin-top: 20px;}
.jump a{ color: #333;}
</style>
</head>
<body>
<div class="message">
<div class="head"><span>系统提示信息:</span></div>
<div class="content">
<?php if(isset($message)) {?>
<p class="success"><em>√</em> <?php echo($message); ?></p>
<?php }else{?>
<p class="error"><em>！</em> <?php echo($error); ?></p>
<?php }?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
var time = --wait.innerHTML;
if(time <= 0) {
location.href = href;
clearInterval(interval);
};
}, 1000);
})();
</script>
</body>
</html>