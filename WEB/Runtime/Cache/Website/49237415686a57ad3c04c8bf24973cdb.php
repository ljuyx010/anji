<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--360浏览器优先以webkit内核解析-->
    <title>欢迎页</title>

    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    

</head>

<body class="gray-bg">
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-sm-3">
            <h2>欢迎使用</h2>
        </div>
        <div class="col-sm-5">
        
        </div>
        <div class="col-sm-4">
           
        </div>

    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">当天</span>
                        <h5>订单</h5>
                    </div>
                    <div class="ibox-content">
                        <p>订单量</p>
                        <h1 class="no-margins"><?php echo ($d[0]['ds']); ?></h1>                        
                        <p><br></p>
                        <p><br></p>                       
                        <small>订单总额</small>
                        <h1 class="no-margins"><?php if($d[0]['dq']): echo ($d[0]['dq']); else: ?>0<?php endif; ?></h1>                        
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">本月</span>
                        <h5>订单</h5>
                    </div>
                    <div class="ibox-content">
                        <p>订单量</p>
                        <h1 class="no-margins"><?php echo ($m[0]['ms']); ?></h1>                        
                        <p><br></p>
                        <p><br></p>                       
                        <small>订单总额</small>
                        <h1 class="no-margins"><?php if($m[0]['mq']): echo ($m[0]['mq']); else: ?>0<?php endif; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">当天</span>
                        <h5>会员</h5>
                    </div>
                    <div class="ibox-content">
                        <p>新会员</p>
                        <h1 class="no-margins"><?php echo ($dn); ?></h1>                        
                        <p><br></p>
                        <p><br></p>                       
                        <small>活跃会员</small>
                        <h1 class="no-margins"><?php echo ($dh); ?></h1>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">本月</span>
                        <h5>会员</h5>
                    </div>
                    <div class="ibox-content">
                        <p>新会员</p>
                        <h1 class="no-margins"><?php echo ($mn); ?></h1>                        
                        <p><br></p>
                        <p><br></p>                       
                        <small>活跃会员</small>
                        <h1 class="no-margins"><?php echo ($mh); ?></h1>
                    </div>
                </div>
            </div>
			<div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>注册会员</h5>
                    </div>
                    <div class="ibox-content">
                        <p>会员总数</p>
                        <h1 class="no-margins"><?php echo ($zs); ?></h1>                        
                        <p><br></p>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>技术支持</h5>

                    </div>
                    <div class="ibox-content">
                        <p><i class="fa fa-send-o"></i> 网址：<a href="http://www.dpwl.net/" target="_blank">http://www.dpwl.net</a>
                        </p>
                        <p><i class="fa fa-qq"></i> QQ：<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=528051088&amp;site=qq&amp;menu=yes" target="_blank">528051088</a>
                        </p>
                        <p><i class="fa fa-weixin"></i> 微信：<p><img src="/WEB/Website/public/img/ewm.jpg" width="120"/><a href="javascript:;">dpwl365</a></p>
                        </p>
                        <p><i class="fa fa-globe"></i> 地址：<a href="javascript:;" >孝南区乾坤大道馨都上层1单元2201</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/WEB/Website/public/js/plugins/layer/layer.min.js"></script>
    <script src="/WEB/Website/public/js/content.min.js"></script>
    <script src="/WEB/Website/public/js/welcome.min.js"></script>
</body>
</html>