<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>车辆调度管理</title>
    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/WEB/Website/public/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/diy.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>车辆调度查询</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>                            
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                        <form method="post" action="<?php echo U('Car/diaodu');?>" class="form-horizontal">
                            <div class="form-group" id="data_5">
                                <label class="col-sm-1 control-label">选择日期</label>
                                <div class="col-sm-3">
                                <div class="input-group date">                                
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="<?php echo (date('Y-m-d',(isset($time) && ($time !== ""))?($time):time())); ?>">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-3"><button class="btn btn-primary" type="submit">查询</button></div>
                            </div>
                        </form>
                        </div>
                        <div class="row">
                        <?php if(is_array($kx)): foreach($kx as $key=>$v): ?><div class="col-sm-3">
                        <?php if($v['xtime'] <= $time && $v['ktime'] >= $time): ?><div class="btn btn-w100 btn-danger">
                            <p>维修中</p>
                            <p>维修时间：<?php echo (date('Y/m/d H:i',$v["xtime"])); ?>--<?php echo (date('Y/m/d H:i',$v["ktime"])); ?></p>
                            <p><?php echo ($v["carnum"]); ?></p>  
                            <p><?php echo ($v["classname"]); ?></p>  
                            </div>
                        <?php else: ?>
                            <div class="btn btn-w100 btn-white">
                            <a href="<?php echo U('Orders/zhid',array('car'=>$v['carnum']));?>">
                            <p><?php echo ($v["carnum"]); ?></p>  
                            <p><?php echo ($v["classname"]); ?></p>
                            </a>
                            </div><?php endif; ?>                            
                        </div><?php endforeach; endif; ?>
                        <?php if(is_array($rw)): foreach($rw as $k=>$r): ?><div class="col-sm-3">
                            <div class="btn btn-w100 btn-info">
                                <p><?php echo ($k); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($r[0]['title']); ?></p>  
                                <?php if(is_array($r)): foreach($r as $key=>$c): ?><p><?php echo ($c["driver"]); ?>(<?php echo ($c["tel"]); ?>)<?php if($c['fuzhu']): ?>|辅助:<?php echo ($c["fuzhu"]); ?>(<?php echo ($c["ftel"]); ?>)<?php endif; ?><br/>
                                <?php echo (date('Y/m/d H:i',$c["stime"])); ?>至<?php echo (date('Y/m/d H:i',$c["dtime"])); ?><br/>
                                <?php echo ($c["edr"]); ?></p><?php endforeach; endif; ?>
                            </div>
                        </div><?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/WEB/Website/public/js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="/WEB/Website/public/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/WEB/Website/public/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script src="/WEB/Website/public/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function () {
    $("#data_5 .input-daterange").datepicker({keyboardNavigation:!1,forceParse:!1,autoclose:!0});
});
</script>
</body>
</html>