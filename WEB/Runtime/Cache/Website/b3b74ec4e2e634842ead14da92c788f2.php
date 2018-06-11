<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>数据备份</title>
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
                        <h5>车辆管理</h5>
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
                            <a href="<?php echo U('Bak/index',array('Action'=>'backup'));?>" class="btn btn-primary "><i class="fa fa-plus"></i> 新建备份</a>
                        </div>
                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>文件名</th>
                                    <th>备份时间</th>
                                    <th>文件大小</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($lists)): foreach($lists as $key=>$row): if($key > 1): ?><tr>
										<td><?php echo ($key-1); ?></td>
										<td style="text-align: left"><a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>"><?php echo ($row); ?></a></td>
										<td><?php echo (getfiletime($row,$datadir)); ?></td>
										<td><?php echo (getfilesize($row,$datadir)); ?></td>
										<td>
											<a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>" class="btn btn-success btn-xs"><i class='fa fa-cloud-download'></i> 下载</a>
											<a onclick="return confirm('确定删除该备份文件吗？')" href="<?php echo U('Bak/index',array('Action'=>'Del','File'=>$row));?>" class="btn btn-warning btn-xs"><i class='fa fa-trash'></i> 删除</a>
										</td>
									</tr><?php endif; endforeach; endif; ?>  
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
</body>
</html>