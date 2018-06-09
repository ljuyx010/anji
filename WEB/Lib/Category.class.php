<?php
namespace Lib;
defined('THINK_PATH') or exit();
/**
* 递归读取栏目列表类
*/
class Category {
	//组合一维数组level 级判断子分类
	Static public function unlimitedForlevel ($cate,$html = '&nbsp;&nbsp;',$pid = 0,$level = 0)	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid){
				$v['level'] = $level+1;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr,self::unlimitedForlevel($cate,$html,$v['id'],$level+1));
			}

		}
		return $arr;
	}
    //子分类组合多维数组
	static public function unlimitedForLayer($cate,$name='child',$pid=0){
		$arr = array();
		foreach ($cate as $v) {
			if($v['pid'] == $pid){
				$v[$name] = self::unlimitedForLayer($cate,$name,$v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}
	//根据子分类id查找所有父级
	static public function getParents ($cate,$id) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id){
				$arr[] = $v;
				$arr = array_merge(self::getParents($cate,$v['pid']),$arr);
			}
		}
		return $arr;
	}

	//根据子分类id查找上一级父id和名称
	static public function getParentsId($cate,$id){
		    $arr = array();
		    foreach ($cate as $v){
		    	if ($v['id'] == $id){
		    		$pid = $v['pid'];

		    		foreach ($cate as $value){
		    			if ($value['id'] == $pid){
		    				$arr[] = $value;
		    			}
		    		}
		    	}
		    }
		return $arr;
	}
	//传递一个父级id返回所有子级id
	static public function getChildsId ($cate,$pid){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid){
				$arr[] = $v['id'];
				$arr = array_merge($arr,self::getChildsId($cate,$v['id']));
			}
		}
		return $arr;
	}
	
	//评论组合多维数组
	static public function unlimitedForping($ping,$name='hf',$hf=0){
		$arr = array();
		foreach ($ping as $v) {
			if($v['hfid'] == $hf){
				$v[$name] = self::unlimitedForping($ping,$name,$v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}
	
}

?>