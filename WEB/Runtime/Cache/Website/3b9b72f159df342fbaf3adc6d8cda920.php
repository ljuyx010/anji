<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>司机提成统计</title>
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
                    <h5><?php echo (date('Y年m月',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); ?>司机提成统计</h5>                    
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>司机姓名</th>
                                <th>本月完成订单数量</th>
                                <th>本月辅助司机次数</th>
                                <th>本月提成</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($tc)): foreach($tc as $key=>$v): ?><tr>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["driver"]); ?></a>
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v["ds"]); ?>                                   
                                </td>
                                <td class="project-completion">
                                    <?php echo ($v["fds"]); ?>                                   
                                </td>
                                <td class="project-people">
                                    <?php echo ($v['tc']+$v['ftc']); ?>                             
                                </td>
                                <td class="project-actions">
                                    <a href="<?php echo U('Finacal/gzxq',array('id'=>$v['driver']));?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> 详情 </a>
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
<script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
<script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
</body>
</html>