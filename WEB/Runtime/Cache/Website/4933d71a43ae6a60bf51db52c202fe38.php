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
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cRIblrzawnZeT319eL3dLssL"></script>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo ($action); ?>订单</h5> 
                        <div class="gohome">
                        <a class="animated bounceInUp" href="<?php echo U('Orders/xianx');?>" title="返回"><i class="fa fa-mail-reply-all"></i></a>
                        </div>                 
                    </div>
                    <div class="ibox-content">
                        <div id="l-map"></div>
                        <form method="post" action="<?php echo U('Orders/runaddx');?>" class="form-horizontal">
                            <?php if($orders['ordernum']): ?><div class="form-group">
                                <label class="col-sm-2 control-label">订单号</label>
                                <div class="col-sm-4">
                                    <p class="form-control-static"><strong><?php echo ($orders["ordernum"]); ?></strong></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div><?php endif; ?>                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">用户姓名</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="uname" value="<?php echo ($orders["uname"]); ?>">
                                    <input type="hidden" class="form-control" name="ordernum" value="<?php echo ($orders["ordernum"]); ?>">
                                </div>
                                <label class="col-sm-2 control-label">联系电话</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="utel" value="<?php echo ($orders["utel"]); ?>">
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户类型</label>
                                <div class="col-sm-4">
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['utype'] == 1): ?>checked=""<?php endif; ?> value="1" name="utype">团体</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['utype'] == 2): ?>checked=""<?php endif; ?> value="2" name="utype">旅行社</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if(!$orders['utype']): ?>checked=""<?php endif; ?> value="0" name="utype">个人</label>
                                </div>
                                <label class="col-sm-2 control-label">订购车型</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="type">
                                    <?php if(is_array($class)): foreach($class as $key=>$c): ?><option <?php if($orders['cid'] == $c['id']): ?>selected<?php endif; ?> value="<?php echo ($c["id"]); ?>"><?php echo ($c["classname"]); ?></option><?php endforeach; endif; ?>                                   
                                    </select>
                                </div>
                            </div>                         
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">接车地址</label>
                                <div class="col-sm-4">
                                <?php if($orders['sdr']): ?><input type="text" class="form-control" name="sdr" value="<?php echo ($orders["sdr"]); ?>">
                                <?php else: ?>
                                <input type="text" class="form-control" id="suggestId" name="sdr" ><?php endif; ?>                                    
                                    <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>
                                </div>
                                <label class="col-sm-2 control-label">目的地</label>
                                <div class="col-sm-4">
                                <?php if($orders['edr']): ?><input type="text" class="form-control" name="edr" value="<?php echo ($orders["edr"]); ?>">
                                <?php else: ?>
                                <input type="text" class="form-control" id="suggestId2" name="edr" value=""><?php endif; ?>
                                    
                                    <div id="searchResultPanel2" style="border:1px solid #C0C0C0;width:100%;display: none;"></div>
                                </div>                                
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">启程日期</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="stime" id="stime" value="<?php echo (date('Y-m-d',(isset($orders["stime"]) && ($orders["stime"] !== ""))?($orders["stime"]):time())); ?>">
                                </div>
                                <label class="col-sm-2 control-label">返程日期</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="dtime" id="dtime" value="<?php echo (date('Y-m-d',(isset($orders["dtime"]) && ($orders["dtime"] !== ""))?($orders["dtime"]):time())); ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">预算里程</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="text" class="form-control" id="lc" name="gl" value="<?php echo ($orders["gl"]); ?>">
                                    <span class="input-group-addon">公里</span>
                                    </div>                                    
                                </div>
                                <label class="col-sm-2 control-label">订单状态</label>
                                <div class="col-sm-4">
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['zt'] == 1): ?>checked=""<?php endif; ?> value="1" name="zt">待支付</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['zt'] == 2): ?>checked=""<?php endif; ?> value="2" name="zt">已支付</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if(!$orders['zt']): ?>checked=""<?php endif; ?> value="0" name="zt">已完成</label>
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
                                    <span class="help-block m-b-none">留空系统自动计算</span>                                    
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">车程类型</label>
                                <div class="col-sm-4">
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['ora'] == 1): ?>checked=""<?php endif; ?> value="1" name="ora">单程</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" <?php if($orders['ora'] == 2): ?>checked=""<?php endif; ?> value="2" name="ora">双程</label>
                                </div>
                                <label class="col-sm-2 control-label">车辆配置</label>
                                <div class="col-sm-4">
                                    <?php if(is_array($carnum)): foreach($carnum as $key=>$v): ?><input type="text" class="form-control" name="car[<?php echo ($v["id"]); ?>]" value="<?php echo ($v["carnum"]); ?>"><?php endforeach; endif; ?>
                                </div>                                
                            </div>                                                 
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">                                
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
                                <?php if($orders['zt'] == 2): ?><div class="col-sm-4">
                                    <a href="<?php echo U('Orders/sendmaill',array('dh'=>$orders.ordernum));?>" class="btn btn-warning">下发短信通知</a>
                                </div><?php endif; ?>
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
    <script src="/public/js/map.js"></script>
    <script>
    laydate({elem:"#stime",event:"focus"});
    laydate({elem:"#dtime",event:"focus"});
    </script>
</body>
</html>