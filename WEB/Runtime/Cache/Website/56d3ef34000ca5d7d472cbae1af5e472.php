<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加招聘信息</title>
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
                        <h5><?php echo ($action); ?>招聘信息</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" onclick="javascript :history.back(-1);" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Jobs/runadd');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题</label>

                                <div class="col-sm-4">
                                    <input type="text" name="title" class="form-control" value="<?php echo ($v["title"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">招聘职位</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="jobname" value="<?php echo ($v["jobname"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">工作地点</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="jobadd" value="<?php echo ($v["jobadd"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">招聘人数</label>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="qty" value="<?php echo ($v["qty"]); ?>">
                                    <span class="input-group-addon">人</span>
                                    </div>
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    工资待遇
                                </label>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="salary" value="<?php echo ($v["salary"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">有效期</label>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="useful" value="<?php echo ($v["useful"]); ?>">
                                    <span class="input-group-addon">月</span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发布时间</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" name="time" id="time" <?php if($v['time']): ?>value="<?php echo (date('Y-m-d H:i:s',$v["time"])); ?>"<?php endif; ?>>
                                </div>
                            </div>                          
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">招聘要求工作内容</label>

                                <div class="col-sm-10">
                                    <textarea class="editor" name="content"><?php echo ($v["content"]); ?></textarea>
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
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>
    <script type="text/javascript">
    var app="";
    KindEditor.ready(function(K) {
        window.editor = K.create('.editor', {
            allowFileManager : true,
            langType : 'zh-CN',
            autoHeightMode : true
        });
    });
    laydate({elem:"#time",event:"focus",format: 'YYYY-MM-DD hh:mm:ss',istime:true});
    </script>
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>