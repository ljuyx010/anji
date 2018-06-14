<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站设置</title>
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
                        <h5>网站设置</h5>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('System/save');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">网站标题</label>

                                <div class="col-sm-4">
                                    <input type="text" name="title" class="form-control" value="<?php echo ($v["title"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">网站关键词</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="keywords" value="<?php echo ($v["keywords"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">网站描述</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="description" value="<?php echo ($v["description"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">联系电话</label>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tel" value="<?php echo ($v["tel"]); ?>">
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">公司地址</label>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="adress" value="<?php echo ($v["adress"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">联系邮箱</label>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="mail" value="<?php echo ($v["mail"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">QQ</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="QQ" value="<?php echo ($v["QQ"]); ?>">
                                </div>
                            </div>                          
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">公司简介</label>

                                <div class="col-sm-6">
                                    <textarea class="textarea" name="content"><?php echo ($v["content"]); ?></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">第三方js</label>

                                <div class="col-sm-6">
                                    <textarea class="textarea" name="js"><?php echo ($v["js"]); ?></textarea>
                                    <input type="hidden" name="name" value="basic"></input>
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
</body>
</html>