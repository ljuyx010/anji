<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加订单任务</title>
    <link rel="shortcut icon" href="favicon.ico">
	<link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
	<link rel="stylesheet" href="/WEB/Website/public/css/diy.css" />
    <link href="/WEB/Website/public/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cRIblrzawnZeT319eL3dLssL"></script>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo ($car["carnum"]); ?>添加任务</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Car/diaodu');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                    <div id="l-map"></div>
                        <form method="post" action="<?php echo U('Orders/runzhid');?>" class="form-horizontal">
                            <div class="hr-line-dashed"></div>                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户姓名</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="uname" value="">
                                </div>
                                <label class="col-sm-2 control-label">联系电话</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="utel" value="">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户类型</label>
                                <div class="col-sm-4">
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" checked="" name="utype">团体</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="2" name="utype">旅行社</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" name="utype">个人</label>
                                </div>
                                <label class="col-sm-2 control-label">车程类型</label>
                                <div class="col-sm-2">
                                    <label class="checkbox-inline">
                                        <input type="radio"  value="1" name="ora">单送</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" checked="" value="2" name="ora">往返</label>                              
                                </div>
                            </div>                         
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">接车地址</label>
                                <div class="col-sm-4">                                
                                <input type="text" class="form-control" id="suggestId" name="sdr" value="" >
                                <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>                             
                                </div>
                                <label class="col-sm-2 control-label">目的地</label>
                                <div class="col-sm-4">                                
                                <input type="text" class="form-control" id="suggestId2" name="edr" value="">
                                <div id="searchResultPanel2" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>
                                </div>                                
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">启程日期</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="stime" id="stime" value="<?php echo (date('Y-m-d H:i:s',(isset($orders["stime"]) && ($orders["stime"] !== ""))?($orders["stime"]):time())); ?>">
                                </div>
                                <label class="col-sm-2 control-label">返程日期</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="dtime" id="dtime" value="<?php echo (date('Y-m-d H:i:s',(isset($orders["dtime"]) && ($orders["dtime"] !== ""))?($orders["dtime"]):time())); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">预算里程</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" id="lc" name="gl" value="">
                                    <span class="input-group-addon">公里</span>
                                    </div>                                    
                                </div>
                                <label class="col-sm-2 control-label">订单状态</label>
                                <div class="col-sm-4">
                                    <label class="checkbox-inline">
                                        <input type="radio" checked="" value="0" name="zt">待支付</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" name="zt">已支付</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="3" name="zt">已完成</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订单金额</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="money" value="">
                                    <span class="input-group-addon">元</span>
                                    </div>
                                    <span class="help-block m-b-none">指定车辆需手动填写订单金额</span>                                    
                                </div>
                                <label class="col-sm-2 control-label">尾款</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="wk" value="">
                                    <span class="input-group-addon">元</span>
                                    </div>
                                    <span class="help-block m-b-none">有尾款未收,则填写</span>                                    
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订购数量</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="num" readonly="1" value="1">
                                    <span class="input-group-addon">辆</span>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">车辆配置</label>
                                <div class="col-sm-6">
                                    <div class="row">                                                                    
                                    <div class="form-group" id="s<?php echo ($car["id"]); ?>">                                    
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="carnum" value="<?php echo ($car["carnum"]); ?>">
                                    </div>
                                    <div class="col-sm-2">
                                    <input type="text" class="form-control" name="driver" value="<?php echo ($car["driver"]); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tel" value="<?php echo ($car["tel"]); ?>">
                                    </div>
                                    <div class="col-sm-2 btn btn-info" id="b<?php echo ($car["id"]); ?>" onclick="fuzhu(<?php echo ($car["id"]); ?>)">添加辅助司机</div>
                                    </div>
                                    </div>                        
                                </div>                                
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发票信息</label>
                                <div class="col-sm-4">
                                    <textarea class="textarea" name="fap"></textarea>                                   
                                </div>
                                <label class="col-sm-2 control-label">备注信息</label>
                                <div class="col-sm-4">
                                    <textarea class="textarea" name="mark"></textarea>                                   
                                </div>
                            </div>                                                      
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/WEB/Website/public/js/plugins/iCheck/icheck.min.js"></script>
	<script src="/WEB/Website/public/js/content.min.js?v=1.0.0"></script>
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>    
    <script src="/WEB/Website/public/js/plugins/toastr/toastr.min.js"></script>
    <script src="/public/js/map.js"></script>
    <script>
    $(function(){
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "progressBar": true,
          "positionClass": "toast-top-center",
          "onclick": null,
          "showDuration": "400",
          "hideDuration": "1000",
          "timeOut": "7000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
    }); 
    function fuzhu(id){
        var html="<div class='form-group' id='f"+id+"'><div class='col-sm-2'><p class='form-control-static'>辅助司机:</p></div><div class='col-sm-3'><input type='text' class='form-control' name='fuzhu'></div><div class='col-sm-3'><input type='text' class='form-control' name='ftel'></div><div class='col-sm-1 btn btn-info' onclick='del("+id+")'>删除</div></div>";
        $("#s"+id).after(html);
        $("#b"+id).remove();
    }
    function del(id){
        $("#f"+id).remove();
    }
    laydate({elem:"#stime",event:"focus",format:"YYYY-MM-DD hh:mm:ss",istime: true});
    laydate({elem:"#dtime",event:"focus",format:"YYYY-MM-DD hh:mm:ss",istime: true});
    </script>
</body>
</html>