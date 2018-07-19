<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发票信息</title>
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
                        <h5>发票信息</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Finacal/fap');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Finacal/frun');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户姓名</label>

                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["uname"]); ?></strong></p>
                                </div>
                                <label class="col-sm-2 control-label">客户电话</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["utel"]); ?></strong></p>
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订单号码</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["ordernum"]); ?></strong></p>
                                </div>
                                <label class="col-sm-2 control-label">出发日期</label>

                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo (date("Y-m-d H:i",$v["stime"])); ?></strong></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">目的地</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["edr"]); ?></strong></p>
                                </div>
                                <label class="col-sm-2 control-label">费用</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["money"]); ?>元</strong></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发票状态</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['ftype'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="ftype">未开</label>
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['ftype'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="ftype">已开</label>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">尾款</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($v["wk"]); ?>元</strong></p>
                                </div>
                            </div>                                                      
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发票信息</label>
                                <div class="col-sm-4">
                                    <textarea class="textarea" name="fap"><?php echo ($v["fap"]); ?></textarea>
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
    <script>
    $("#name").change(function(){
        txt=$("#name").val();
        $.post("<?php echo U('Hr/getel');?>",{name:txt},function(result){
            $("#tel").val(result);
        });
    });
    </script>
</body>
</html>