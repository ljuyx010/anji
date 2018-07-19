<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>司机提成详情</title>
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
                    <h5><?php echo (date('Y年m月',(isset($v["time"]) && ($v["time"] !== ""))?($v["time"]):time())); echo ($id); ?>订单提成详情</h5> 
                    <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Finacal/gz');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                    </div>                   
                </div>
                <div class="ibox-content">
                    
                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>订单号</th>
                                <th>类型</th>
                                <th>订单日期</th>
                                <th>目的地</th>
                                <th>提成</th>
                            </tr>
                            <?php if(is_array($xq)): foreach($xq as $key=>$v): ?><tr>
                                <td class="project-status">
                                            <span class="label label-primary"><?php echo ($v["ordernum"]); ?></span>
                                </td>
                                <td class="project-title">
                                    <?php if($v['type']): ?>线上<?php else: ?>线下<?php endif; ?>
                                </td>
                                <td class="project-completion">
                                    <?php echo (date('Y-m-d',$stime)); ?>                                  
                                </td>
                                <td class="project-people">
                                    <?php echo ($v["edr"]); ?>                             
                                </td>
                                <td class="project-actions">
                                    <?php echo ($v["wage"]); ?>元
                                </td>
                            </tr><?php endforeach; endif; ?>
                            <tr>
                                <td colspan="5"><label class="pull-right"><strong><?php echo ($sum); ?>元</strong></label></td>
                            </tr>
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