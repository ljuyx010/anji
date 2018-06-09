<?php
return array(
	//定义模板中__public__路径
	'TMPL_PARSE_STRING'	=> array(
        '__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Website/public',
		),
	'URL_HTML_SUFFIX' => '', //定义网页后缀名

	//设置修改模板路径
	'TMPL_FILE_DEPR' => '_',
	'HTTP_CACHE_CONTROL' =>  'no-cache',  // 网页缓存控制private有缓存

	//'AUTOLOAD_NAMESPACE' => array('Lib' => APP_PATH.'/Lib',), //自定义扩展类库

	//'SHOW_PAGE_TRACE' => true,  //调试选项
	
    'RBAC_SUPERADMIN' => 'lj_admin',   //指定超级管理员名称

	'ADMIN_AUTH_KEY' => 'superadmin', //超级管理员识别号
	'USER_AUTH_ON' => true, //是否开启权限验证
	'USER_AUTH_TYPE' => 1, //验证类型(1.登录验证2.时时验证)
	'USER_AUTH_KEY' => 'uid', //用户认证识别号
	'NOT_AUTH_MODULE' => 'Index,Common,Cache,System',//无需认证的控制器
	'NOT_AUTH_ACTION' => 'index,addUserHandle,addRoleHandle,addNodeHande,setAccess,runAdd,runUpdata,updatapwd,addCateHandle,addAttrHandle,deli,fpage',//无需认证的方法
	'RBAC_ROLE_TABLE' => 'lj_role', //角色表名称
	'RBAC_USER_TABLE' => 'lj_role_user',//角色与用户中间表
	'RBAC_ACCESS_TABLE' => 'lj_access',//权限表名称
	'RBAC_NODE_TABLE' => 'lj_node',//节点表名称

	/*'AUTH_CONFIG'=>array( //auth权限验证 配置项
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'lj_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'lj_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'lj_auth_rule', //权限规则表
        'AUTH_USER' => 'lj_user'//用户信息表
    )*/
);
?>