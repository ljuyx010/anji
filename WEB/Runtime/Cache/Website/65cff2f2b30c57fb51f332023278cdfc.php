<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>轮播管理</title>
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
                    <h5>轮播管理</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo U('System/add');?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> 添加新轮播</a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <?php if(is_array($banner)): foreach($banner as $key=>$v): ?><tr>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["title"]); ?></a>
                                </td>
                                <td class="project-completion">
                                    <a href="javascript"><img alt="image" style="height: 50px;" src="<?php echo ($v["pic"]); ?>" /></a>                                  
                                </td>
                                <td class="project-completion">
                                    <small>排序：<?php echo ($v["sort"]); ?></small>
                                </td>
                                <td class="project-people">
                                 <?php echo (date('Y-m-d',$v["time"])); ?>           
                                </td>
                                <td class="project-actions">
                                    <a href="<?php echo U('System/edit',array('id'=>$v['id']));?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
                                    <a href="<?php echo U('System/delete',array('id'=>$v['id']));?>" class="btn btn-warning btn-sm" onclick="return confirm('确定要删除吗？')"><i class="fa fa-trash"></i> 删除 </a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        <div id="page"><?php echo ($page); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
<script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>