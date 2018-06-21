<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>安吉旅游办公管理系统</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/WEB/Website/public/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/WEB/Website/public/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/WEB/Website/public/css/animate.min.css" rel="stylesheet">
    <link href="/WEB/Website/public/css/style.min862f.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" width="64" <?php if(session('user.pic')): ?>src="<?php echo ($_SESSION['user']['pic']); ?>"<?php else: ?>src="/WEB/Website/public/img/a10.jpg"<?php endif; ?> /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($_SESSION['user']['name']); ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo ($_SESSION['user']['group']); ?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?php echo U('Admin/account');?>">账号设置</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?php echo U('Login/loginout');?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">安吉</div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('System/index');?>" data-index="0">基础设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('System/extend');?>">扩展设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('System/banner');?>">轮播管理</a>
                            </li>
                        </ul>

                    </li>
					<li><a class="J_menuItem" href="<?php echo U('User/index');?>"><i class="fa fa-group"></i> <span class="nav-label">会员管理</span></a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-bus"></i> <span class="nav-label">车辆管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Car/classtype');?>">车型分类</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('Car/index');?>">车辆管理</a>
                            </li>
                           
                        </ul>
                    </li>

                    <li>
                        <a href="mailbox.html"><i class="fa fa-edit"></i> <span class="nav-label">订单管理 </span>
                        <?php if($ddm): ?><span class="label label-warning pull-right"><?php echo ($ddm); ?></span><?php endif; ?>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Orders/index');?>">线上订单</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Orders/xianx');?>">业务登记</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user"></i> <span class="nav-label">员工管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Hr/people');?>">人员管理</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Hr/gongzi');?>">工资管理</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Hr/xiaofei');?>">消费审批</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Jobs/index');?>">招聘信息</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-money"></i> <span class="nav-label">财务管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Finacal/etc');?>">ETC充值</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Finacal/gz');?>">司机月工资</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Finacal/index');?>">财务统计</a>
                            </li>                            
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">维保售后</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('After/dingd');?>">完成订单</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('After/weixiu');?>">维修登记</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('After/tousu');?>">投诉违章</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('After/nianshen');?>">年审保险</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('After/safe');?>">事故登记</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('After/tongj');?>">售后统计</a>
                            </li>                                                  
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">设备管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Outfit/index');?>">设备购入</a></li>
                            <li><a class="J_menuItem" href="<?php echo U('Outfit/car');?>">随车设备</a></li>
                        </ul>
                    </li>     
                    <li><a class="J_menuItem" href="<?php echo U('Article/index');?>"><i class="fa fa-book"></i> <span class="nav-label">文章管理</span></a></li>
                    <li>
                        <a href="#"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">权限管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Admin/user');?>">用户管理</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Admin/group');?>">用户组</a>
                            </li>
                            <li><a class="J_menuItem" href="<?php echo U('Admin/rule');?>">权限列表</a>
                            </li>
						</ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">系统工具 </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?php echo U('Bak/index');?>">数据备份</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="<?php echo U('Index/search');?>">
                            <div class="form-group">
                                <input type="text" placeholder="快速搜索" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
						<li><a class="dropdown-toggle count-info" href="/" target="_blank">
                                <i class="fa fa-home"></i>前台首页
                            </a>
						</li>                        
						<li><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
							<ul class="dropdown-menu dropdown-alerts">
                                <li><a href="<?php echo U('Cache/index');?>">清除缓存</a></li>
                                <li><a href="<?php echo U('Cache/temp');?>">重载模板</a></li>
							</ul>
						</li>
						<li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>
                                <?php if($num): ?><span class="label label-danger"><?php echo ($num); ?></span><?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                            <?php if(is_array($dd)): foreach($dd as $key=>$v): ?><li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-tags fa-fw"></i> <?php echo ($v["ordernum"]); ?>
                                            <span class="pull-right text-muted small"><?php echo (date('m-d H:i',$v["ordtime"])); ?></span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li><?php endforeach; endif; ?>
                            <?php if(is_array($shen)): foreach($shen as $key=>$s): ?><li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-warning fa-fw"></i> <?php echo ($s["carnum"]); ?> | <?php if($s['type'] == 1): ?>营运证<?php elseif($s['type'] == 2): ?>行车证<?php else: ?>保险<?php endif; ?>
                                            <span class="pull-right text-muted small">过期：<?php echo (date('Y-m-d',$s["dtime"])); ?></span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li><?php endforeach; endif; ?>    
                            </ul>
                        </li>
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="0">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo U('Login/loginout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/welcom');?>" frameborder="0" data-id="0" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">Copyright © 2018 dpwl Powered by <a href="http://www.dpwl.net" target="_blank">湖北大鹏网络科技有限公司</a>.</div>
            </div>
            <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--右侧边栏结束-->
        </div>        
    </div>
    <script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/WEB/Website/public/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/WEB/Website/public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/WEB/Website/public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/WEB/Website/public/js/plugins/layer/layer.min.js"></script>
    <script src="/WEB/Website/public/js/hplus.min.js?v=4.1.0"></script>
    <script type="text/javascript" src="/WEB/Website/public/js/contabs.min.js"></script>
    <script src="/WEB/Website/public/js/plugins/pace/pace.min.js"></script>
</body>
</html>