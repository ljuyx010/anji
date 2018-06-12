<?php
namespace Website\Model;
use Think\Model\RelationModel;

class AdminModel extends RelationModel{
   
   //定义主表名称
	//Protected $tableName = 'admin';
   //定义关联关系
	Protected $_link = array(
       'auth_group' => array(//这里的就是要被连接的表的名称
       	  //关联关系MANY_TO_MANY多对多，HAS_ONE一对一，HAS_MANY一对多
          'mapping_type' => self::MANY_TO_MANY,
          //中间表名
          'relation_table' => 'lj_auth_group_access',
          //主表外键用中间表关联主表的id,如果不写，那就默认是(表名_id)
          'foreign_key' => 'uid',
          //关联表外键用中间表关联从表的id,如果不写，那就默认是(表名_id)
          'relation_foreign_key' => 'group_id',
          //关联表读取字段名
          'mapping_fields' => 'id,title',
       	  )
		);

}

?>