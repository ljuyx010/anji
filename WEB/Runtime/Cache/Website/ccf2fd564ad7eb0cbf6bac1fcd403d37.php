<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加轮播</title>
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
                        <h5><?php echo ($action); ?>轮播</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('System/banner');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('System/runadd');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">轮播标题</label>

                                <div class="col-sm-4">
                                    <input type="text" name="title" class="form-control" value="<?php echo ($v["title"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['type'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="type">电脑</label>
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['type'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="type">手机</label>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-10">
                                    <a class="btn btn-primary upimgs" id="btn">选择图片</a> 最大2M，支持jpg，gif，png格式。
                                    <dl id="ul_pics" class="ul_pics clearfix"><dd id='slt'><?php if($v['pic']): ?><img src="<?php echo ($v["pic"]); ?>"><?php endif; ?></dd></dl>
                                    <input name="pic" id="picsa" style="display: none;" value="<?php echo ($v["pic"]); ?>">
                                </div>
                            </div>   
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">转向链接</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="url" value="<?php echo ($v["url"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>

                                <div class="col-sm-2">
                                    <input type="text" name="sort" class="form-control" value="<?php echo ((isset($v["sort"]) && ($v["sort"] !== ""))?($v["sort"]):100); ?>">
                                    <input type="hidden" name="id" value="<?php echo ($v["id"]); ?>"></input>
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
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script type="text/javascript">var app="";</script>
    <script src="/WEB/Website/public/plupload/upload.js"></script>
</body>
</html>