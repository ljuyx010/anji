<?php
namespace Index\Model;
use Think\Model;

class GbookModel extends Model{
   protected $_validate = array(
     array('code','require','验证码必填！'), //默认情况下用正则进行验证
     array('title','require','公司名称必填！'), // 在新增的时候验证name字段是否唯一
     array('username','require','姓名必填！'), // 当值不为空的时候判断是否在一个范围内
     array('tel', '7,12', '电话号码不正确', 3,'length'), // 验证确认密码是否和密码一致
     array('content','require','详细说明不能空'), // 自定义函数验证密码格式
   );
}