<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>安吉旅游办公管理系统 - 登录</title>
    <link href="/WEB/Website/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/login.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/diy.css" rel="stylesheet">
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/jr.js"></script>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
        var verifyUrl = '<?php echo U('Login/verify','','');?>';
        function change_code(obj){
            $("#code").attr("src",verifyUrl+'/'+Math.random());
            return false;
        }
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>安吉旅游</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>安吉旅游办公管理系统</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 服务群众</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 诚信为本</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 扎实工作</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 科学管理</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 安全第一</li>
                    </ul>
                    <small>技术支持：<a class="white" target="_blank" href="http://www.dpwl.net">湖北大鹏网络</a></small><br>
                    <small>服务热线：400-6688-605</small>
                </div>
            </div>
            <div class="col-sm-5">
                <form method="post" action="<?php echo U('Login/login');?>" method="post">
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录到系统后台</p>
                    <input type="text" class="form-control uname" name="account" placeholder="账号" />
                    <input type="password" class="form-control pword m-b" name="password" placeholder="密码" />
                    <a href="javascript:void(change_code(this));"><img src="<?php echo U(MODULE_NAME.'/Login/verify');?>" id="code"></a>
                    <input type="text" class="form-control code m-b" name="code" placeholder="验证码" />
                    <div class="clearfix"></div>
                    <button type="submit" class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2018 All Rights Reserved 安吉旅游客运集团.
            </div>
        </div>
    </div>
</body>
</html>