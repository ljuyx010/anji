<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>订单管理</title>
    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/WEB/Website/public/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>订单统计查询</h5>
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
                        <form method="post" action="<?php echo U('Orders/tongji');?>" class="form-horizontal">
                            <div class="form-group" id="data_5">
                                <label class="col-sm-1 control-label">起止日期</label>
                                <div class="col-sm-3">
                                <div class="input-group date">                                
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="<?php echo (date('Y-m',(isset($s) && ($s !== ""))?($s):time())); ?>-01">
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="input-sm form-control" name="end" value="<?php echo (date('Y-m',(isset($d) && ($d !== ""))?($d):time())); ?>-30">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-3"><button class="btn btn-primary" type="submit">查询</button></div>
                                <div class="col-sm-1"><a class="pull-right btn btn-primary" href="<?php echo U('orders/excel',array('s'=>$s,'d'=>$d));?>">导出EXcel</a></div>
                            </div>
                        </form>
                        </div>
                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>车型</th>
                                    <th>车牌号</th>
                                    <th>司机</th>
                                    <th>出发日期</th>
                                    <th>目的地</th>
                                    <th>返程日期</th>
                                    <th>客户姓名</th>
                                    <th>客户电话</th>
                                    <th>金额</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tr>
                                    <td><?php echo ($v["ordernum"]); ?></td>
                                    <td><?php echo ($v["title"]); ?></td>
                                    <td><?php echo ($v["carnum"]); ?></td>
                                    <td><?php echo ($v["siji"]); ?></td>
                                    <td><?php echo (date("Y-m-d",$v["stime"])); ?></td>
                                    <td><?php echo ($v["edr"]); ?></td>
                                    <td><?php echo (date("Y-m-d",$v["dtime"])); ?></td>
                                    <td><?php echo ($v["uname"]); ?></td>
                                    <td><?php echo ($v["utel"]); ?></td>
                                    <td><?php echo ($v["money"]); ?></td>
                                </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>

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