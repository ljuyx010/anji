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
            link: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index.php/Index/details_1.html', // 分享链接，记得使用绝对路径，不能用document.URL
            imgUrl: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/Public/images/logo.jpg', // 分享图标，记得使用绝对路径  
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
</head>
<body>
<link rel="stylesheet" href="/Public/css/pickout.css">
<!-- banner -->
<div id="focus" class="focus">
	<div class="bd">
		<ul>			
			<?php if(is_array($data['pics'])): foreach($data['pics'] as $key=>$v): ?><li><a class="pic" href="javascript:;"><img src="<?php echo ($v); ?>"/></a></li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="hd">
		<ul></ul>
	</div>
</div>
<script type="text/javascript">
	TouchSlide({ 
		slideCell:"#focus",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul", 
		effect:"leftLoop", 
		autoPlay:true,//自动播放
		autoPage:true, //自动分页
		switchLoad:"_src" //切换加载，真实图片路径为"_src" 
	});
</script>
<!-- banner end-->
<div class="main">
	<h3><?php echo ($data["title"]); ?></h3>
	<p>车型：<?php echo ($data["classname"]); ?></p>
	<p class="udline"><b>车辆详情</b></p>
	<div class="newsshow_ctt">
		<?php echo ($data["content"]); ?>
	</div>
</div>
<!--end main-->
<div class="cd-bouncy-nav-modal">
	<nav>
		<ul class="cd-bouncy-nav">
			<li><a href="#">首页</a></li>
			<li><a href="#s">jQuery</a></li>
			<li><a href="#">PHP</a></li>
			<li><a href="#">模板</a></li>
			<li><a href="#">网址</a></li>
			<li><a href="#">工具</a></li>
		</ul>
	</nav>
	<a href="#0" class="cd-close">Close modal</a>
</div>
<div class="h75"></div>
<!--footer-->
<footer>
	<div class="bottom3">
		<a class="sy" href="<?php echo U('Index/index');?>"><em><img src="/Public/images/home.png"></em>返回首页</a>
		<div class="xd cd-bouncy-nav-trigger">立即下单预定此车型</div>
	</div>
</footer>
<script src="/Public/js/pickout.js"></script>
</body>
</html>