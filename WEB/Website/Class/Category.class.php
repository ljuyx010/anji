<?php
namespace Website\Class\Category;
/**
* 递归读取栏目列表类
*/
class Category {
	
	Static public function unlimitedForlevel ($cate,$html = '———',$pid = 0,$level = 0)	{
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid){
				$v['level'] = $level+1;
				$['html'] = str_replace($html,$level);
				$arr[] = $v;
				$arr = array_merge($arr,self::unlimitedForlevel($cate,$html,$v['id'],$level+1));
			}

		}
		return $arr;
	}
}

?>