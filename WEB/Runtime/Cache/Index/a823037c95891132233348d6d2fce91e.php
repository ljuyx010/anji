<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="<?php echo ($keywords); ?>">
<meta name="description" content="<?php echo ($description); ?>">
<link rel="stylesheet" href="/Public/css/Style.css"/>
<script src="/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Public/js/TouchSlide.1.0.js"></script>
<script src="/Public/js/jquery.SuperSlide.2.1.1.js"></script>
</head>
<body>
<?php echo W('bann/banner');?>
<div class="gsjj">
	<div class="menu"><h3>公司简介</h3><p>About us</p></div>
	<img src="/Public/images/jj.jpg">
	<?php
 $data = M('site')->field('value')->where(array('name'=>"basic"))->find(); echo unserialize($data['value'])['content']; ?>
	<div class="clear"></div>
</div>
<div class="proudct">
	<div class="menu"><h3>产品推荐</h3><p>Product recommendations</p></div>
	<ul>
	<?php $field=array("id","title","classname","pics");$_pist_news=M("class")->field($field)->where(array_merge(array('pics'=>array('neq','')),array('tj'=>1)))->limit("4")->order("id desc")->select();foreach ($_pist_news as $k=>$_pist_value) : extract($_pist_value);$url=U("/".MODULE_NAME."/details_".$id); ?><li><a href="<?php echo ($url); ?>"><div><img <?php if(strstr($pics,'|')): ?>src="<?php echo substr($pics,0,strpos($pics, '|'));?>" <?php else: ?>src="<?php echo ($pics); ?>"<?php endif; ?>></div><p><?php echo ($title); ?></p></a></li><?php endforeach; ?>
	</ul>
</div>
<div class="h75"></div>
<!--footer-->
<footer>
	<div class="bottom3">
		<a <?php if(CONTROLLER_NAME == 'Index'): ?>class="hover"<?php endif; ?> href="<?php echo U('Index/index');?>"><em><img <?php if(CONTROLLER_NAME == 'Index'): ?>src="/Public/images/rhome.png"<?php else: ?>src="/Public/images/home.png"<?php endif; ?>></em>首页</a>
		<a <?php if(CONTROLLER_NAME == 'Goods'): ?>class="hover"<?php endif; ?> href="<?php echo U('Goods/index');?>"><em><img <?php if(CONTROLLER_NAME == 'Goods'): ?>src="/Public/images/rcar.png"<?php else: ?>src="/Public/images/car.png"<?php endif; ?>></em>订车</a>
		<a href="tel:<?php
 $data = M('site')->field('value')->where(array('name'=>"basic"))->find(); echo unserialize($data['value'])['tel']; ?>"><em><img src="/Public/images/kf.png"></em>客服</a>
		<a <?php if(CONTROLLER_NAME == 'User'): ?>class="hover"<?php endif; ?> href="<?php echo U('User/index');?>"><em><img <?php if(CONTROLLER_NAME == 'User'): ?>src="/Public/images/ruser.png"<?php else: ?>src="/Public/images/user.png"<?php endif; ?>></em>我的</a>
	</div>
</footer>
<!--footer end-->
<script src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>  
<script>  
    wx.config({  
        debug: false, // 是否开启调试模式  
        appId: '<?php echo ($wxconfig["appId"]); ?>', // 必填，微信号AppID  
        timestamp: <?php echo ($wxconfig["timestamp"]); ?>, // 必填，生成签名的时间戳  
        nonceStr: '<?php echo ($wxconfig["nonceStr"]); ?>', // 必填，生成签名的随机串  
        signature: '<?php echo ($wxconfig["signature"]); ?>',// 必填，签名，见附录1  
        jsApiList: ['onMenuShareTimeline', //分享到朋友圈  
        'onMenuShareAppMessage', //分享给朋友  
        'onMenuShareQQ' //分享到QQ  
        ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2  
    });  
  
    wx.ready(function(){  
        var options = {  
            title: '<?php echo ($title); ?>', // 分享标题  
            link: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index.php', // 分享链接，记得使用绝对路径，不能用document.URL
            imgUrl: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Public/wap/images/logo.jpg', // 分享图标，记得使用绝对路径  
            desc: '<?php echo ($description); ?>', // 分享描述  
            success: function () {  
                console.info('分享成功！');  
                // 用户确认分享后执行的回调函数  
            },  
            cancel: function () {  
                console.info('取消分享！');  
                // 用户取消分享后执行的回调函数  
            }  
        }  
        wx.onMenuShareTimeline(options); // 分享到朋友圈  
        wx.onMenuShareAppMessage(options); // 分享给朋友  
        wx.onMenuShareQQ(options); // 分享到QQ  
    });  
</script>
</body>
</html>