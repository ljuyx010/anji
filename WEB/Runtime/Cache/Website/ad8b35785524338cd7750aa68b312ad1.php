<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>完成订单</title>
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
                        <h5>完成订单</h5>
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
                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>订单号</th>
                                    <th>车牌号</th>
                                    <th>状态</th>
                                    <th>下单时间</th>
                                    <th>总里程</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
    <script>
    var url="<?php echo U('After/finish');?>";
    jQuery(document).ready(function() {
        $('#editable').dataTable({
        "bServerSide": true,
        "bStateSave": true,
        "bPaginate": true, //是否分页
        "bAutoWidth": false,
        "bProcessing": true, //datatable获取数据时候是否显示正在处理提示信息。
        "iDisplayLength": 20, //每页显示10条记录
        "aaSorting": [[ 0, "desc" ]],
        'bFilter': true, //是否使用内置的过滤功能
        "sAjaxSource": "<?php echo U('After/dingd',array('f'=>1));?>",
        "aoColumns": [
            {"mData": "id", "bSortable": true},
            {"mData": "ordernum","bSearchable": true},
            {"mData": "carnum", "bSortable": false},
            {"mData": "zt","bSortable": false,"mRender": function(data) {
                if(data==1){return "已支付";}
                if(data==2){return "任务中";}
                if(data==3){return "已完成";}
            }},
            {"mData": "otime","bSortable": true},
            {"mData": "mileage","bSortable": true},
            {"mData": "id","bSortable": false,"mRender": function(data) {
                return "<a href='"+url+"/id/"+ data +"' class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> 编辑 </a> ";
                }
            }
        ]
        });
    });
    </script>
</body>
</html>