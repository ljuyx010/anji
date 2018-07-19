<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>员工管理</title>
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
                        <h5>人员管理</h5>
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
                            <a href="<?php echo U('Hr/add');?>" class="btn btn-primary "><i class="fa fa-plus"></i> 添加人员</a>
                        </div>
                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>部门</th>
                                    <th>电话</th>
                                    <th>合同日期</th>
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
    var url1="<?php echo U('Hr/updata');?>";
    var url2="<?php echo U('Hr/delete');?>";
    var bm;
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
        "sAjaxSource": "<?php echo U('Hr/fpage');?>",
        "aoColumns": [
            {"mData": "id", "bSortable": true},
            {"mData": "name", "bSortable": false},
            {"mData": "ks", "bSortable": true,"mRender": function(data) {                
                if(data==0){bm="司机";}
                if(data==1){bm="业务部";}
                if(data==2){bm="办公室";}
                if(data==3){bm="财务部";}
                if(data==4){bm="机务部";}
                if(data==5){bm="安全部";}
                return bm;
              }
            },
            {"mData": "tel","bSortable": false},
            {"mData": "htimes","bSortable": true},
            {"mData": "id","bSortable": false,"mRender": function(data) {
                return "<a href='"+url1+"/id/"+ data +"' class='btn btn-info btn-sm'><i class='fa fa-pencil'></i> 编辑 </a> <a onclick='return confirm(`确定要删除吗？`)' href='"+url2+"/id/"+ data +"' class='btn btn-warning btn-sm'><i class='fa fa-trash'></i> 删除</a>";
                }
            }
        ]
        });
    });
    </script>
</body>
</html>