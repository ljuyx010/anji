<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>账号设置</title>
    <link rel="shortcut icon" href="favicon.ico">
	<link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
	<link rel="stylesheet" href="/WEB/Website/public/css/diy.css" />
	<link rel="stylesheet" href="/WEB/Website/public/kindeditor/themes/default/default.css" />
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>账号设置</h5>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Admin/modify');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户名</label>

                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" readonly value="<?php echo ($_SESSION['user']['name']); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">账号</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="account" readonly value="<?php echo ($_SESSION['user']['account']); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    头像
                                </label>
                                <div class="col-sm-10">
                                    <a class="btn btn-primary upimgs" id="btn">选择图片</a> 头像尺寸100像素X100像素。
                                    <dl id="ul_pics" class="ul_pics clearfix"><dd id='slt'><?php if(session('user.pic')): ?><img src="<?php echo ($_SESSION['user']['pic']); ?>"><?php endif; ?></dd></dl>
                                    <input name="pic" id="picsa" style="display: none;" value="<?php echo ($_SESSION['user']['pic']); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password2" value="">
                                    <input type="hidden" name="id" value="<?php echo ($_SESSION['user']['id']); ?>"></input>
                                </div>
                            </div>                                        
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/WEB/Website/public/js/plugins/iCheck/icheck.min.js"></script>
	<script src="/WEB/Website/public/kindeditor/kindeditor-all.js"></script>
	<script src="/WEB/Website/public/kindeditor/lang/zh-CN.js"></script>
    <script src="/WEB/Website/public/plupload/plupload.full.min.js"></script>
    <script src="/WEB/Website/public/plupload/upload.js"></script>
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>