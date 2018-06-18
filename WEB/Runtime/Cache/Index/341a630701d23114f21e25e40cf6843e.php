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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cRIblrzawnZeT319eL3dLssL"></script>
<link href="/Web/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
<link href="/Web/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
<link href="/Web/Website/public/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/Web/Website/public/css/animate.min.css" rel="stylesheet">
<link href="/Web/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
<style type="text/css">
.modal-backdrop {  z-index: 140!important;}
.modal { z-index: 200!important;}
#l-map{display:none;}
.tangram-suggestion-main{z-index: 210;}
</style>
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
<!--model-->
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">汽车租赁订单</h4>
                <small class="font-bold">车型：<?php echo ($data["classname"]); ?></small>
            </div>
            <div class="modal-body">
            	<div id="l-map"></div>
                <div class="form-group">
                    <label class="font-noraml">您的姓名</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-noraml">联系电话</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                        <input type="text" class="form-control" name="tel" value="">
                    </div>
                </div>
				<div class="form-group">
                    <label class="font-noraml">租赁类型</label>
                    <div class="input-group">
                        <label class="checkbox-inline">
                        	<input type="radio" name="dw" checked value="1" >团体
                        </label>
                        <label class="checkbox-inline">
                        	<input type="radio" name="dw" value="2" >旅行社
                        </label>
                        <label class="checkbox-inline">
                        	<input type="radio" name="dw" value="0" >个人
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-noraml">租赁数量</label>
                    <div class="input-group m-b">
                    	<span class="input-group-addon"><i class="fa fa-cab"></i></span>
                        <select class="form-control" name="num">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select> 
                        <span class="input-group-addon">辆</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-noraml">接车地点</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                        <input type="text" class="form-control" id="suggestId" name="sdr" value="">						
                    </div>
                    <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>
                </div>

                <div class="form-group">
                    <label class="font-noraml">目的地</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input type="text" class="form-control" id="suggestId2" name="edr" value="">                        
                        <input type="hidden" class="form-control" id="lc" name="lc" value="">                        
                    </div>
                    <div id="searchResultPanel2" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>
                    <span class="help-block m-b-none">根据输入提示,从下拉框中选择所需要的地址,如果没有你所需要的地址,则选择离你最近的下拉框中的地址</span>
                </div>
                <div class="form-group" id="data_5">
                    <label class="font-noraml">时间安排</label>
                    <div class="input-group date">
                    	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="input-sm form-control" name="start" value="<?php echo (date('Y-m-d',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>">
                        <span class="input-group-addon">到</span>
                        <input type="text" class="input-sm form-control" name="end" value="<?php echo (date('Y-m-d',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>">
                    	</div>
                    </div>
                </div>                	
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary">提交订单</button>
            </div>
        </div>
    </div>
</div>
<!--model end-->
<div class="h75"></div>
<!--footer-->
<footer>
	<div class="bottom3">
		<a class="sy" href="<?php echo U('Index/index');?>"><em><img src="/Public/images/home.png"></em>返回首页</a>
		<div class="xd cd-bouncy-nav-trigger" data-toggle="modal" data-target="#myModal5" >立即下单预定此车型</div>
	</div>
</footer>
<script src="/Web/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Web/Website/public/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function () {
	$("#data_5 .input-daterange").datepicker({keyboardNavigation:!1,forceParse:!1,autoclose:!0});
});
</script>
</body>
</html>
<script src="/Public/js/map.js"></script>