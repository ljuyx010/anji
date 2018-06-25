<?php
namespace TagLib;
use Think\Template\TagLib;
use \Lib;
defined('THINK_PATH') or exit();
/*
*自定义标签库
 */
class TagLibLj extends TagLib{

	protected $tags = array(
	'com'=>array('attr'=>'name','close'=>0),
	'list' => array('attr' => 'id,tj,img,limit,order','close' =>1),// attr 属性列表close 是否闭合（0 默认为1，0表示闭合）
	'pist' => array('attr' => 'id,tj,img,limit,order','close' =>1),// attr 属性列表close 是否闭合（0 默认为1，0表示闭合）
	'borl' => array('attr' => 'name,limit,order,type')
	);

	//读取站点信息
	public function _com($tag,$content){
		$name = $tag['name']; //获取字段名
		$str=<<<str
<?php
		\$data = M('site')->field('value')->where(array('name'=>"basic"))->find();
		\$value = unserialize(\$data['value']);
		echo \$value['$name'];
?>
str;
     return $str;
	}
//读取特定栏目文章列表
	public function _list ($tag,$content){
		$id =$tag['id']; //栏目id

		if ($tag['img']){$where = "array('pic'=>array('neq',''))";}
		if($tag['tj']){$where="array_merge(".$where.",array('tj'=>1))";}

		$limit = $tag['limit'];//输出几条
        $order = $tag['order'];//排序方式 ASC or DESC
        $str = '<?php ';

        $str .= '$field=array("id","title","description","pic","time","click");';

		$str .= '$_list_news=M("article")->where('.$where.')->field($field)->limit("'.$limit.'")->order("'.$order.'")->select();';

    	$str .= 'foreach ($_list_news as $k=>$_list_value) : ';

        $str .= 'extract($_list_value);';

        $str .= '$url=U("/".MODULE_NAME."/ashow_".$id); ?>';

        $str .= $content;

        $str .='<?php endforeach; ?>';
        
        return $str;
	}
	//读取特定栏目产品列表
	public function _pist ($tag,$content){
		if($tag['img']){$where = "array('pics'=>array('neq',''))";}
		if($tag['tj']){$where="array_merge(".$where.",array('tj'=>1))";}
		$limit = $tag['limit'];//输出几条
        $order = $tag['order'];//排序方式 ASC or DESC
		
        $str = '<?php ';

        $str .= '$field=array("id","title","classname","pics");';                
        
		$str .= '$_pist_news=M("class")->field($field)->where('.$where.')->limit("'.$limit.'")->order("'.$order.'")->select();';
		$str .= 'foreach ($_pist_news as $k=>$_pist_value) : ';

		$str .= 'extract($_pist_value);';
		
		$str .= '$url=U("/".MODULE_NAME."/details_".$id); ?>';//自定义产品生成路径$url
				
		$str .= $content;

		$str .='<?php endforeach; ?>';        

       return $str;
	}
//读取友情链接
	public function _borl($tag,$content) {
		$name = $tag['name'];
		$limit = $tag['limit'];
		$order = $tag['order'];
		$type = $tag['type'];
		$where = "type=".$type." and pic<>''";
		$str = <<<str
<?php
    \$_link_data = M('{$name}')->where("{$where}")->order("{$order}")->limit("{$limit}")->select();
    foreach(\$_link_data as \$k=>\$_link_v) :
    	extract(\$_link_v);
?>
str;
		$str .= $content;
		$str .= '<?php endforeach; ?>';
		return $str;
	}

}
?>