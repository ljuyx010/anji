<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>权限管理</title>
    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/diy.css" rel="stylesheet">


</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>权限管理</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" onclick="add(0)" data-target="#myModal" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> 添加权限</a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th class="project-title">
                                    权限名
                                </th>
                                <th class="project-completion">
                                    权限规则                                  
                                </th>
                                <th class="project-completion">
                                    level级                                  
                                </th>
                                <th class="project-actions">
                                 操作
                                </th>
                            </tr>
                            <?php if(is_array($rule)): foreach($rule as $key=>$v): ?><tr>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["title"]); ?></a>
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v["name"]); ?>                                   
                                </td>
                                <td class="project-completion">
                                    <small><?php echo ($v["type"]); ?></small>                                    
                                </td>
                                <td class="project-actions">
                                <a data-toggle="modal" data-target="#myModal" onclick="add(<?php echo ($v["type"]); ?>)" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> 添加子项</a>
                                <a data-toggle="modal" data-target="#myModal" onclick="edit(<?php echo ($v["id"]); ?>)" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
                                <a href="<?php echo U('Admin/delete',array('id'=>$v['id']));?>" class="btn btn-warning btn-sm" onclick="return confirm('确定要删除吗？')"><i class="fa fa-trash"></i> 删除 </a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">添加权限</h4>
            </div>
            <form id="qx">
            <div class="modal-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限名</label>
                    <div class="col-sm-6">                                
                        <input type="text" class="form-control" name="title" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限规则</label>
                    <div class="col-sm-6">                                
                        <input type="text" class="form-control" name="name" value="">
                        <input type="hidden" class="form-control" name="type" value="">
                        <input type="hidden" class="form-control" name="id" value="">
                        <span class="help-block m-b-none">输入控制器/方法即可 例如:Rule/index</span>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="save()">保存</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
<script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
<script type="text/javascript">
    function add(type){
        type=type+1;
        $('input[name=type]').val(type);
    }
</script>
</body>
</html>