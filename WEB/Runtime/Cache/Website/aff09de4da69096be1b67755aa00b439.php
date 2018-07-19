<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单详情</title>
    <link rel="shortcut icon" href="favicon.ico">
	<link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
	<link rel="stylesheet" href="/WEB/Website/public/css/diy.css" />
    <link href="/WEB/Website/public/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo ($orders["ordernum"]); ?>订单详情</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Orders/index');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo U('Orders/runedit');?>" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户头像</label>
                                <div class="col-sm-4">
                                    <img width="60" class="img-circle" src="<?php echo ($orders["photo"]); ?>" />
                                </div>
                                <label class="col-sm-2 control-label">用户昵称</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><?php echo ($orders["nickname"]); ?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户姓名</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="uname" value="<?php echo ($orders["uname"]); ?>">
                                </div>
                                <label class="col-sm-2 control-label">联系电话</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="utel" value="<?php echo ($orders["utel"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户类型</label>
                                <div class="col-sm-1">
                                    <p class="form-control-static"><?php if($orders['utype'] == 1): ?>团体<?php elseif($orders['utype'] == 2): ?>旅行社<?php else: ?>个人<?php endif; ?></p>
                                </div>
                                <label class="col-sm-2 control-label">公司名称</label>
                                <div class="col-sm-3">
                                    <p class="form-control-static"><?php echo ($orders["gname"]); ?></p>
                                </div>                                
                                <label class="col-sm-2 control-label">订购车型</label>
                                <div class="col-sm-2">
                                    <p class="form-control-static"><?php echo ($orders["title"]); ?></p>
                                    <input type="hidden" name="cid" value="<?php echo ($orders["cid"]); ?>"></input>
                                    <input type="hidden" name="zt" value="<?php echo ($orders["zt"]); ?>"></input>
                                </div>
                            </div>                         
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">接车地址</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><?php echo ($orders["sdr"]); ?></p>
                                </div>
                                <label class="col-sm-2 control-label">出发日期</label>
                                <div class="col-sm-4">
                                <input class="form-control layer-date" name="stime" id="start" value="<?php echo (date('Y-m-d H:i:s',$orders["stime"])); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">目的地</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><?php echo ($orders["edr"]); ?></p>
                                </div>
                                <label class="col-sm-2 control-label">返程日期</label>
                                <div class="col-sm-4">
                                <input  class="form-control layer-date" name="dtime" id="end" value="<?php echo (date('Y-m-d H:i:s',$orders["dtime"])); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">预算里程</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="gl" value="<?php echo ($orders["gl"]); ?>">
                                    <span class="input-group-addon">公里</span>
                                    </div>                                    
                                </div>
                                <label class="col-sm-2 control-label">订单状态</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static">
                                    <?php switch($orders["zt"]): case "-2": ?>已退款，付款时间：<?php echo (date('Y-m-d H:i',$orders["paytime"])); ?>,退款时间：<?php echo (date('Y-m-d H:i',$orders["backtime"])); break;?>
                                        <?php case "-1": ?>申请退款，付款时间：<?php echo (date('Y-m-d H:i',$orders["paytime"])); ?>,申请退款时间：<?php echo (date('Y-m-d H:i',$orders["backtime"])); break;?>
                                        <?php case "0": ?>待付款<?php break;?>
                                        <?php case "1": ?>已付款，付款时间：<?php echo (date('Y-m-d H:i',$orders["paytime"])); break;?>
                                        <?php case "3": ?>已完成，付款时间：<?php echo (date('Y-m-d H:i',$orders["paytime"])); break; endswitch;?>
                                    <?php if($orders['refund_no']): ?>退款单号：<?php echo ($orders["refund_no"]); endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订购数量</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="num" value="<?php echo ($orders["num"]); ?>">
                                    <span class="input-group-addon">辆</span>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">订单金额</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="money" value="<?php echo ($orders["money"]); ?>">
                                    <span class="input-group-addon">元</span>
                                    </div>                                    
                                </div>
                            </div>                                                 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">车程类型</label>
                                <div class="col-sm-2">
                                    <p class="form-control-static"><?php if($orders['ora'] == 1): ?>单送<?php else: ?>往返<?php endif; ?></p>                                  
                                </div>
                                <label class="col-sm-2 control-label">车辆配置</label>
                                <div class="col-sm-6">
                                    <div class="row">                                                                    
                                    <?php if(is_array($carnum)): foreach($carnum as $key=>$v): ?><div class="form-group" id="s<?php echo ($v["id"]); ?>">                                    
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="car[<?php echo ($v["id"]); ?>]['carnum']" value="<?php echo ($v["carnum"]); ?>">
                                    </div>
                                    <div class="col-sm-2">
                                    <input type="text" class="form-control" name="car[<?php echo ($v["id"]); ?>]['driver']" value="<?php echo ($v["driver"]); ?>">
                                    </div>
                                    <div class="col-sm-4">
                                    <input type="text" class="form-control" name="car[<?php echo ($v["id"]); ?>]['tel']" value="<?php echo ($v["tel"]); ?>">
                                    </div>
                                    <?php if($orders['zt'] == 0 || $orders['zt'] == 1): ?><div class="col-sm-2 btn btn-info" id="b<?php echo ($v["id"]); ?>" onclick="fuzhu(<?php echo ($v["id"]); ?>)">添加辅助司机</div><?php endif; ?>
                                    </div>
                                    <?php if($v['fuzhu']): ?><div class='form-group' id='f<?php echo ($v["id"]); ?>'>
                                    <div class='col-sm-2'><p class='form-control-static'>辅助司机:</p></div>
                                    <div class='col-sm-3'><input type='text' id="fuzhu<?php echo ($v["id"]); ?>" class='form-control' name="car[<?php echo ($v["id"]); ?>]['fuzhu']" value="<?php echo ($v["fuzhu"]); ?>"></div>
                                    <div class='col-sm-3'><input id="ftel<?php echo ($v["id"]); ?>" type='text' class='form-control' name="car[<?php echo ($v["id"]); ?>]['ftel']" value="<?php echo ($v["ftel"]); ?>"></div>
                                    <div class='col-sm-1 btn btn-info' onclick='qingk(<?php echo ($v["id"]); ?>)'>删除</div>
                                    </div><?php endif; endforeach; endif; ?>
                                    </div> 
                                    <span class="help-block m-b-none">系统默认无辅助司机，添加辅助司机需手动修改价格</span>                         
                                </div>                                
                            </div> 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发票信息</label>
                                <div class="col-sm-4">
                                    <textarea class="textarea" name="fap"><?php echo ($orders["fap"]); ?></textarea>                                   
                                </div>
                                <label class="col-sm-2 control-label">备注信息</label>
                                <div class="col-sm-4">
                                    <textarea class="textarea" name="mark"><?php echo ($orders["mark"]); ?></textarea>                                   
                                </div>
                            </div>                                                      
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo ($orders["id"]); ?>">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>                                
                                <div class="col-sm-4">
                                <?php if($orders['zt'] == 1): ?><input type="button" onclick="send()" class="btn btn-warning" value="下发短信通知"></input><?php endif; ?>
                                <?php if(!$orders['refund_no'] && $orders['zt'] == -1): ?><a href="<?php echo U('Orders/tk',array('dh'=>$orders['ordernum']));?>" class="btn btn-warning" >同意退款</a><?php endif; ?>
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
    <script src="/WEB/Website/public/js/plugins/toastr/toastr.min.js"></script>
    <script src="/WEB/Website/public/js/plugins/layer/laydate/laydate.js"></script>
    <script>
    laydate({elem:"#start",event:"focus",format:"YYYY-MM-DD hh:mm:ss",istime: true});
    laydate({elem:"#end",event:"focus",format:"YYYY-MM-DD hh:mm:ss",istime: true}); 
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
    function send(){
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "<?php echo U('Orders/sendmail',array('dh'=>$orders['ordernum']));?>" ,//url
            data: "",
            success: function (result) {
                console.log(result);//打印服务端返回的数据(调试用)
                if (result.code == 200){
                   toastr.success(result.str);
                }
            },
            error : function() {
                alert("异常！");
            }
        });
    }
    function fuzhu(id){
        var html="<div class='form-group' id='f"+id+"'><div class='col-sm-2'><p class='form-control-static'>辅助司机:</p></div><div class='col-sm-3'><input type='text' class='form-control' name='car["+id+"]['fuzhu']'></div><div class='col-sm-3'><input type='text' class='form-control' name='car["+id+"]['ftel']'></div><div class='col-sm-1 btn btn-info' onclick='del("+id+")'>删除</div></div>";
        $("#s"+id).after(html);
        $("#b"+id).remove();
    }
    function del(id){
        $("#f"+id).remove();
    }
    function qingk(id){
        $("#fuzhu"+id).val("");      
        $("#ftel"+id).val(""); 
        $("#f"+id).css('display','none');
    }
    </script>
</body>
</html>