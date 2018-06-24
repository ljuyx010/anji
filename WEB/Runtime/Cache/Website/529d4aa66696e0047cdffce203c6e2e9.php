<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分配权限</title>
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
                        <h5>为<?php echo ($group["title"]); ?>分配权限</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Admin/group');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content timeline">
                        <form method="post" class="form-horizontal">
                        <?php if(is_array($rule)): foreach($rule as $k=>$v): if($v['type'] == 1 and $k == 0): ?><div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-2 text-navy">
                                <label class="checkbox-inline"><input type="checkbox" <?php if(in_array($v['id'],$group['rules'])): ?>checked="checked"<?php endif; ?> value="<?php echo ($v["id"]); ?>" name="rule_ids[]" onclick="checkAll(this)"><h5><?php echo ($v["title"]); ?></h5></label>
                                </div>
                                <div class="col-xs-6 content">
                        <?php elseif($v['type'] == 1): ?>
                                </div>
                            </div> 
                            </div>
                            <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-2 text-navy">
                                <label class="checkbox-inline"><input type="checkbox" <?php if(in_array($v['id'],$group['rules'])): ?>checked="checked"<?php endif; ?> value="<?php echo ($v["id"]); ?>" name="rule_ids[]" onclick="checkAll(this)"><h5><?php echo ($v["title"]); ?></h5></label>
                                </div>
                                <div class="col-xs-6 content">
                        <?php else: ?>                            
                                <label class="checkbox-inline"><input type="checkbox" <?php if(in_array($v['id'],$group['rules'])): ?>checked="checked"<?php endif; ?> value="<?php echo ($v["id"]); ?>" name="rule_ids[]"><?php echo ($v["title"]); ?></label><?php endif; endforeach; endif; ?>
                                </div>
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input name="id" type="hidden" value="<?php echo ($group["id"]); ?>" />
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
    <script src="/WEB/Website/public/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script src="/WEB/Website/public/js/demo/peity-demo.min.js"></script>
    <script>
    function checkAll(obj){
        $(obj).parents('.timeline-item').eq(0).find("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
    }
    </script>
</body>
</html>