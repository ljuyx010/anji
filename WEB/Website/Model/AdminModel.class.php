<?php
namespace Website\Model;
use Think\Model\RelationModel;

class AdminModel extends RelationModel{
   
   //定义主表名称
	Protected $tableName = 'admin';
   //定义关联关系
	Protected $_link = array(
       'auth_group' => array(
       	  //关联关系MANY_TO_MANY多对多，HAS_ONE一对一，HAS_MANY一对多
          'mapping_type' => self::HAS_ONE,
          //要关联的模型类名
          'class_name' => 'auth_group', 
          //主表外键
          'foreign_key' => 'id',
          //关联表外键
          'relation_foreign_key' => 'group_id',
          //中间表名
          'relation_table' => 'lj_auth_group_access',
          //关联表读取字段名
          'as_fields' => 'id:gid,title',
       	  )
		);

}

?>