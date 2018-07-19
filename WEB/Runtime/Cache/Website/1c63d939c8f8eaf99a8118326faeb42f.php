<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>车辆油耗详情</title>
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
                    <h5><?php echo ($carnum); ?>油耗详情</h5>
                    <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('After/oilist');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                    </div> 
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>里程表</th>
                                <th>加油量(L)</th>
                                <th>加油类型</th>
                                <th>加油日期</th>
                            </tr>
                            <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
                                <td class="project-status">
                                            <?php echo ($v["lic"]); ?>
                                </td>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["oil"]); ?></a>
                                </td>
                                <td class="project-completion">
                                   <?php if($v['type']): ?>站外<?php else: ?>站内<?php endif; ?>                                   
                                </td>
                                <td class="project-completion">
                                    <?php echo (date('Y-m-d',$v["time"])); ?>
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