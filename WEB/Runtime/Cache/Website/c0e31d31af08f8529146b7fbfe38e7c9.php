<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加投诉违章</title>
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
                        <h5><?php echo ($action); ?>投诉违章</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('After/tousu');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('After/runaddt');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">员工姓名</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="people" id="name" value="<?php echo ($v["people"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">车牌号</label>
                                <div class="col-sm-4" >
                                    <input type="text" class="form-control" name="carnum" id="yg" value="<?php echo ($v["carnum"]); ?>">
                                    <span class="help-block m-b-none">不是司机，可留空</span>
                                </div>
                            </div> 
                            </if>                           
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label style="margin-right:15px;"><input type="radio" <?php if(!$v['type']): ?>checked="checked"<?php endif; ?> value="0" name="type">投诉</label>
                                        <label><input type="radio" <?php if($v['type']): ?>checked="checked"<?php endif; ?> value="1" name="type">违章</label>
                                    </div>
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">事件日期</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="time" id="time" value="<?php echo (date('Y-m-d',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">事件详情</label>

                                <div class="col-sm-4">
                                    <textarea class="textarea" name="mark"><?php echo ($v["mark"]); ?></textarea>
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
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>
    <script>
    $("#name").change(function(){
        txt=$("#name").val();
        $.post("<?php echo U('Finacal/getu');?>",{name:txt},function(res){
            $("#yg").val(res);
        });
    });
    laydate({elem:"#time",event:"focus"});
    </script>
</body>
</html>