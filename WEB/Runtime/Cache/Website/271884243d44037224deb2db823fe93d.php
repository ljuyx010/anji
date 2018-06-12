<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
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
                    <h5>用户管理</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> 添加新用户</a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th class="project-title">
                                    <a href="JavaScript:;">用户名</a>
                                </th> 
                                <th class="project-completion">
                                    账号                                  
                                </th>
                                <th class="project-completion">
                                    用户组                                  
                                </th>
                                <th class="project-completion">
                                    登录时间                                  
                                </th>                          
                                <th class="project-actions">
                                 操作
                                </th>
                            </tr>
                            <?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
                                <td class="project-title">
                                    <?php if($v['pic']): ?><img alt="image" class="img-circle" src="<?php echo ($v["pic"]); ?>" /><?php endif; ?> <?php echo ($v["name"]); ?>
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v["account"]); ?>                                  
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v["title"]); ?>                                  
                                </td>
                                <td class="project-completion">
                                    <?php echo (date('Y-m-d H:i',$v["logintime"])); ?>
                                </td>                                
                                <td class="project-actions">                                
                                <a data-toggle="modal" data-target="#myModal" onclick="edit(<?php echo ($v["id"]); ?>,<?php echo ($v["gid"]); ?>)" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> 修改 </a>                                
                                <a href="<?php echo U('Admin/deleteu',array('id'=>$v['id']));?>" class="btn btn-warning btn-sm" onclick="return confirm('确定要删除吗？')"><i class="fa fa-trash"></i> 删除 </a>
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
                <h4 class="modal-title">添加新用户</h4>
            </div>
            <form id="qx">
            <div class="modal-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-6">                                
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">账号</label>
                    <div class="col-sm-6">                                
                        <input type="text" class="form-control" id="zh" name="account" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-6">                                
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-6">                                
                        <input type="password" class="form-control" name="password2" value="">
                        <input type="hidden" class="form-control" name="id" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户组</label>
                    <div class="col-sm-6">                                
                        <select class="form-control m-b" name="group_id">
                        <?php if(is_array($groupname)): foreach($groupname as $key=>$g): ?><option value="<?php echo ($g["id"]); ?>"><?php echo ($g["title"]); ?></option><?php endforeach; endif; ?>                                   
                        </select>
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
    function edit(id,gid){
        $('.modal-title').html("修改用户信息");  
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "<?php echo U('Admin/updatau');?>" ,//url
            data: {id:id},
            success: function (result) {
                if (result.id == id) {
                    $(".m-b").val(gid);
                    $('input[name=name]').val(result.name);
                    $('input[name=account]').val(result.account);
                    $("#zh").attr("readOnly","true");
                    $('input[name=id]').val(id);
                }else{
                    alert("数据错误");
                }
            },
            error : function() {
                alert("网络异常！");
            }
        }); 
    }
    function save (){
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "<?php echo U('Admin/runaddu');?>" ,//url
            data: $('#qx').serialize(),
            success: function (result) {
                // console.log(result);//打印服务端返回的数据(调试用)
                if (result.cod == 200) {
                    window.location.reload();
                }else{
                    alert(result.msg);
                }
            },
            error : function() {
                alert("网络异常！");
            }
        });
    }
</script>
</body>
</html>