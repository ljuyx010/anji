<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加分类</title>
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
                        <h5><?php echo ($action); ?>分类</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Car/classtype');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Car/runadd');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题</label>

                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" value="<?php echo ($v["title"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">车型</label>
                                <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="classname" value="<?php echo ($v["classname"]); ?>">
                                    <span class="input-group-addon">例如:7座金杯</span>
                                </div></div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图片</label>

                                <div class="col-sm-10">
                                    <a class="btn btn-primary upimgs" class="upimgs" id="bte">选择图片</a> 最大2M，支持jpg，gif，png格式。按CTRL多选(最多传10张)
                                    <dl id="ul_pic" class="ul_pic clearfix">
                                        <?php if(is_array($pics)): foreach($pics as $key=>$p): ?><dd><img src="<?php echo ($p); ?>"><p><a href="javascript:void(0);" onclick="deli(this);">删除</a></p>
                                        <input name='pics[]' class='dis' value="<?php echo ($p); ?>">
                                        </dd><?php endforeach; endif; ?>                                
                                    </dl>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">推荐</label>
                                <div class="col-sm-4">
                                    <div class="radio">
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['tj'] == 0): ?>checked="checked"<?php endif; ?> value="0" name="tj">否</label>
                                        <label class="checkbox-inline"><input type="radio" <?php if($v['tj'] == 1): ?>checked="checked"<?php endif; ?> value="1" name="tj">是</label>
                                    </div>
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">定价标准：</label>
                                <div class="col-sm-4">
                                   <label class="control-label"> [（ 油价 X 油耗 + 过路费 ）+ 司机个数 X 司机成本 ] X 公里数+利润 X 天数</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">油价参数</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="oilj" value="<?php echo ($v["oilj"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">油耗参数</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="oilh" value="<?php echo ($v["oilh"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">过路费参数</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="glf" value="<?php echo ($v["glf"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">利润参数</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="lr" value="<?php echo ($v["lr"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">司机50KM薪酬</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="kmm" value="<?php echo ($v["kmm"]); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>

                                <div class="col-sm-2">
                                    <input type="text" name="sort" class="form-control" value="<?php echo ($v["sort"]); ?>">
                                </div>
                            </div>                                                     
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">内容</label>

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
    <script src="/WEB/Website/public/plupload/plupload.full.min.js"></script>
    <script type="text/javascript">
    var app="";
    KindEditor.ready(function(K) {
        window.editor = K.create('.editor', {
            allowFileManager : true,
            langType : 'zh-CN',
            autoHeightMode : true
        });
    });
    function deli(that) {
        $(that).closest("dd").remove();
    }
    </script>
    <script src="/WEB/Website/public/plupload/upload.js"></script>
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>