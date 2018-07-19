<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加油料</title>
    <link rel="shortcut icon" href="favicon.ico">
	<link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
	<link rel="stylesheet" href="/WEB/Website/public/css/diy.css" />
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加油料记录</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('After/oilist');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('After/addoil');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">车牌号</label>
                                <div class="col-sm-4">
                                    <input type="text" name="carnum" id="name" class="form-control" value="<?php echo ($v["carnum"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">里程</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="lic" id="name" value="<?php echo ($v["lic"]); ?>">
                                    <span class="help-block m-b-none">站内加油必填此值，站外加油可留空。</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">加油量</label>

                                <div class="col-sm-4">
                                   <div class="input-group">
                                        <input type="text" class="form-control" name="oil" value="<?php echo ($v["oil"]); ?>">
                                        <span class="input-group-addon">升</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">加油日期</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="time" id="time" value="<?php echo (date('Y-m-d',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>">  
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
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>
    <script>
    laydate({elem:"#time",event:"focus"});
    </script>
</body>
</html>