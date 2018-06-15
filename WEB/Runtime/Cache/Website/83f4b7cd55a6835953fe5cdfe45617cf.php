<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站扩展设置</title>
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
                        <h5>网站扩展设置</h5>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('System/savextend');?>" class="form-horizontal">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                        微信公众号设置
                                    </div>
                                    <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">公众号AppId</label>

                                        <div class="col-sm-4">
                                            <input type="text" name="AppId" class="form-control" value="<?php echo ($v["AppId"]); ?>">
                                        </div>
                                    </div>                            
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">AppSecret</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" name="AppSecret" value="<?php echo ($v["AppSecret"]); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">微信支付商户号</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="mhid" value="<?php echo ($v["mhid"]); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">微信支付Api密钥</label>

                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" name="apikey" value="<?php echo ($v["apikey"]); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">微信支付apiclient_cert.pem</label>

                                        <div class="col-sm-6">
                                            <textarea class="textarea" name="client_cert"><?php echo ($v["client_cert"]); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">微信支付apiclient_key.pem</label>

                                        <div class="col-sm-6">
                                            <textarea class="textarea" name="client_key"><?php echo ($v["client_key"]); ?></textarea>                                            
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                        阿里云设置
                                    </div>
                                    <div class="panel-body">
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">AccessKeyId</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="AccessKey" value="<?php echo ($v["AccessKey"]); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">AccessKeySecret</label>

                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" name="AccessSecret" value="<?php echo ($v["AccessSecret"]); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">模板签名</label>
                                        <div class="col-sm-4">                                
                                            <input type="text" class="form-control" name="qm" value="<?php echo ($v["qm"]); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">模板id</label>
                                        <div class="col-sm-4">                                
                                            <input type="text" class="form-control" name="mbid" value="<?php echo ($v["mbid"]); ?>">
                                            <input type="hidden" name="name" value="extend"></input>
                                        </div>
                                    </div>                                                    
                                </div>    
                            </div>
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
</body>
</html>