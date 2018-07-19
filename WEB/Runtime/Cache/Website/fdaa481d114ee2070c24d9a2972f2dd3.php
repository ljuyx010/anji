<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加人员</title>
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
                        <h5><?php echo ($action); ?>人员</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Hr/people');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Hr/runadd');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">姓名</label>

                                <div class="col-sm-4">
                                    <input type="text" name="name" class="form-control" value="<?php echo ($v["name"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">部门</label>
                                <div class="col-sm-4">
                                <select class="form-control m-b" name="ks">
                                    <option <?php if($v['ks'] == 0): ?>selected<?php endif; ?> value="0">司机</option>                                    
                                    <option value="1" <?php if($v['ks'] == 1): ?>selected<?php endif; ?>>业务部</option>                                    
                                    <option value="2" <?php if($v['ks'] == 2): ?>selected<?php endif; ?>>办公室</option>                                    
                                    <option value="3" <?php if($v['ks'] == 3): ?>selected<?php endif; ?>>财务部</option>                                    
                                    <option value="4" <?php if($v['ks'] == 4): ?>selected<?php endif; ?>>机务部</option>                                    
                                    <option value="5" <?php if($v['ks'] == 5): ?>selected<?php endif; ?>>安全部</option>                                    
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">生日</label>
                                <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="brithday" id="brithday" value="<?php echo (date('Y-m-d',(isset($v["brithday"]) && ($v["brithday"] !== ""))?($v["brithday"]):time())); ?>">
                                    <span class="input-group-addon">年/月/日</span>
                                </div></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">身份证号</label>

                                <div class="col-sm-4">
                                    <input type="text" name="card" class="form-control" value="<?php echo ($v["card"]); ?>">
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机号</label>
                                <div class="col-sm-4">
                                    <input type="text" name="tel" class="form-control" value="<?php echo ($v["tel"]); ?>">
                                </div>
                            </div>                         
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">联系地址</label>

                                <div class="col-sm-4">
                                   <input type="text" name="adress" class="form-control" value="<?php echo ($v["adress"]); ?>">
                                    <input type="hidden" name="id" value="<?php echo ($v["id"]); ?>"></input>
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">入职时间</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="time" id="time" value="<?php echo (date('Y-m-d',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">合同日期</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="htime" id="htime" value="<?php echo (date('Y-m-d',(isset($v["htime"]) && ($v["htime"] !== ""))?($v["htime"]):time())); ?>">
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
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>
    <script>
        laydate({elem:"#brithday",event:"focus"});
        laydate({elem:"#time",event:"focus"});
        laydate({elem:"#htime",event:"focus"});
    </script>
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>