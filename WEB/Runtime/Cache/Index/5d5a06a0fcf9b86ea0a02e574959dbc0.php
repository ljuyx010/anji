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
            link: 'http://<?php echo ($_SERVER['SERVER_NAME']); ?>/index.php/User/index.html', // 分享链接，记得使用绝对路径，不能用document.URL
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
<?php if(CONTROLLER_NAME == 'Index'): ?><header>
    <a href="<?php echo U('Index/index');?>"><img src="/Public/images/logo.png">孝客集团安吉旅游</a>
</header>
<div class="clear h50"></div><?php endif; ?>
<div class="userbox">
	<div class="userimg"><img class="photo" src="/Public/images/logo.jpg" ><!--src="<?php echo (session('userHeadimgurl')); ?>"--><p><img src="/Public/images/icon-user-level.png"><?php if(session('name')): ?>Vip用户<?php else: ?>普通用户<?php endif; ?></p>
	<h3><?php echo (session('userNickname')); ?>大胖娃娃</h3>
	</div>
</div>
<div class="main">
   	<p class="udline">我的订单</p>
    <!-- Tab切换 S -->
	<div class="slideTxtBox">
		<div class="hd">
			<ul>
				<li><a href="#">待付款</a></li>
				<li><a href="#">已付款</a></li>
				<li><a href="#">已完成</a></li>
			</ul>
		</div>
		<div class="bd">
			<ul>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">中国打破了世界软件巨头规则</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">口语：会说中文就能说英语！</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">农场摘菜不如在线学外语好玩</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">数理化老师竟也看学习资料？</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">学英语送ipad2,45天突破听说</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">学外语，上北外！</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">那些无法理解的荒唐事</a></li>
			</ul>
			<ul>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">名师教作文：３妙招巧写高分</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">耶鲁小子：教你备考SAT</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">施强：高端专业语言教学</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">数理化老师竟也看学习资料？</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">【推荐】名校英语方法曝光！</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">2012高考“考点”大曝光!!</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">涨价仍爆棚假日旅游冰火两重天</a></li>
			</ul>
			<ul>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">澳大利亚八大名校招生说明会</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">2012世界大学排名新鲜出炉</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">新加坡留学，国际双语课程</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">高考后留学日本名校随你选</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">教育培训行业优势资源推介</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">即刻预约今年最后一场教育展</a></li>
				<li><span class="date">2011-11-11</span><a href="http://www.SuperSlide2.com" target="_blank">女友坚持警局完婚不抛弃</a></li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">jQuery(".slideTxtBox").slide();</script>
	<!-- Tab切换 E -->
<div class="clear"></div>
</div>
<!--end main-->
<p class="corpyt">湖北安吉旅游客运集团版权所有<br>技术支持：<a href="http://www.dpwl.net" target="_blank">湖北大鹏网络科技</a></p>
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
</body>
</html>