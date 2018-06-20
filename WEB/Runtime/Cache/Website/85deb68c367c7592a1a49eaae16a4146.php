<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投诉违章统计</title>
    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-sm-12">
            <p>系统会自动把本年内的投诉和违章记录进行统计，下表为当月的投诉和违章记录。
            </p>
        </div>

    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">            
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>本年违章、投诉统计</h5>
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

                        <div class="echarts" id="echarts-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>本月投诉记录</h5>
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
                        <div class="project-list">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>车牌号</th>
                                <th>司机姓名</th>
                                <th>时间</th>
                            </tr>
                            <?php if(is_array($ts)): foreach($ts as $key=>$v): ?><tr>
                                <td class="project-status">
                                            <span class="label label-primary"><?php echo ($v["carnum"]); ?></span>
                                </td>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["people"]); ?></a>
                                </td>
                                <td class="project-completion">
                                    <?php echo (date('Y-m-d',$v["time"])); ?>                                   
                                </td>                                
                            </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>本月违章记录</h5>
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
                       <div class="project-list">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>车牌号</th>
                                <th>司机姓名</th>
                                <th>时间</th>
                            </tr>
                            <?php if(is_array($wz)): foreach($wz as $key=>$v): ?><tr>
                                <td class="project-status">
                                            <span class="label label-primary"><?php echo ($v["carnum"]); ?></span>
                                </td>
                                <td class="project-title">
                                    <a href="JavaScript:;"><?php echo ($v["people"]); ?></a>
                                </td>
                                <td class="project-completion">
                                    <?php echo (date('Y-m-d',$v["time"])); ?>                                   
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
    <script src="/WEB/Website/public/js/plugins/echarts/echarts-all.js"></script>
    <script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script>
        var myChart = echarts.init(document.getElementById('echarts-bar-chart'));
         // 显示标题，图例和空的坐标轴
         myChart.showLoading();    //数据加载完之前先显示一段简单的loading动画
         var names=[];    //类别数组（实际用来盛放X轴坐标值）
         var ts=[];    //销量数组（实际用来盛放Y坐标值）
         var wz=[];
         $.ajax({
         type : "post",
         async : true,            //异步请求（同步请求将会锁住浏览器，用户其他操作必须等待请求完成才可以执行）
         url : "<?php echo U('After/ajax');?>",    //请求发送到TestServlet处
         data : {},
         dataType : "json",        //返回数据形式为json
         success : function(result) {
             //请求成功时执行该函数内容，result即为服务器返回的json对象
             if (result) {
                console.log(result);
                    for(var i=0;i<result.length;i++){       
                       names.push(result[i].m);    //取出ts的月份
                     }
                     console.log(names);
                    for(var i=0;i<result.length;i++){       
                        ts.push(result[i].ts);    //挨个取出ts量
                      }
                      console.log(ts);
                    for(var i=0;i<result.length;i++){       
                        wz.push(result[i].wz);    //挨个取出wz量
                      }
                      console.log(wz);
                    myChart.hideLoading();    //隐藏加载动画
                    myChart.setOption({ 
                        title: {
                             text: '本年违章量和投诉量'
                         },
                         tooltip: {},
                         legend: {
                             data:["违章量", "投诉量"]
                         },
                         xAxis: {
                             data: names
                         },
                         yAxis: {},       //加载数据图表
                        series: [{
                            name: "违章量",
                            type: "bar",
                            data: wz ,
                            markPoint: {
                                data: [{
                                    type: "max",
                                    name: "最大值"
                                },
                                {
                                    type: "min",
                                    name: "最小值"
                                }]
                            }                          
                        },
                        {
                            name: "投诉量",
                            type: "bar",
                            data: ts                            
                        }]
                    });
             }
         
        },
         error : function(errorMsg) {
             //请求失败时执行该函数
         alert("图表请求数据失败!");
         myChart.hideLoading();
         }
    }); 
    </script>
</body>
</html>