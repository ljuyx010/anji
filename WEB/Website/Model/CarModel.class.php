<?php
namespace Website\Model;
use Think\Model;

class CarModel extends Model{
   
   $lei = array(
     array('title','require','名称必填'), //默认情况下用正则进行验证
     array('classname','require','座位数必填')
	);
}

?>