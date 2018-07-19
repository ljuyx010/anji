<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>油耗统计</title>
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
                    <h5>油耗统计</h5>
                    <div class="ibox-tools">
                        <a href="<?php echo U('After/addoil');?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> 加油登记</a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>车牌号</th>
                                <th>本月里程</th>
                                <th>本月加油</th>
                                <th>油耗</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($yyl)): foreach($yyl as $key=>$v): ?><tr>
                                <td class="project-status">
                                            <span class="label label-primary"><?php echo ($v["carnum"]); ?></span>
                                </td>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v['d']-$v['x']); ?></a>
                                </td>
                                <td class="project-completion">
                                   <?php echo ($v["s"]); ?>                                   
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v['s']/($v['d']-$v['x'])); ?>L/公里
                                </td>
                                <td>
                                    <a href="<?php echo U('After/xlist',array('id'=>$v['carnum']));?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> 查看</a>
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