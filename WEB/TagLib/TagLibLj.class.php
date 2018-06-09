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
	'list' => array('attr' => 'id,attrid,img,flag,limit,order','close' =>1),// attr 属性列表close 是否闭合（0 默认为1，0表示闭合）
	'pist' => array('attr' => 'id,img,limit,order','close' =>1),// attr 属性列表close 是否闭合（0 默认为1，0表示闭合）
	'navi' => array('attr' => 'limit,order'),
	'borl' => array('attr' => 'name,limit,order,type'),
	'fav' => array('attr' => 'id'),
	'gbook' => array('attr' => 'id,limit'),
	'crumb' => array('attr' => 'id','close'=>0)
	);

	//读取站点信息
	public function _com($tag,$content){
		$name = $tag['name']; //获取字段名
		$str=<<<str
<?php
		\$data = F('Site','',APP_PATH.'/Data/');
		echo \$data['$name'];
?>
str;
     return $str;
	}
//读取特定栏目文章列表
	public function _list ($tag,$content){
		$id =$tag['id']; //栏目id
		if ($tag['img']){
			$where = "cid in (".$id.") and del=0 and pic<>''";
		}else{
			$where = "cid in (".$id.") and del=0";
		}

		$attrid =$tag['attrid']; //文章属性是否推荐
		

		$limit = $tag['limit'];//输出几条
        $order = $tag['order'];//排序方式 ASC or DESC
        $flag = $tag['flag']; //文章还是图集
        $str = '<?php ';

        $str .= '$field=array("id","title","description","content","pic","time","click");';
                
        if ($attrid){

			$str .= '$_list_news=M("article")->join("lj_article_attr ON lj_article.id = lj_article_attr.artid")->where("'.$where.'")->field($field)->limit("'.$limit.'")->order("'.$order.'")->select();';

        	$str .= 'foreach ($_list_news as $k=>$_list_value) : ';

	        $str .= 'extract($_list_value);';

	        if ($flag == 'p'){
	        	$str .= '$url=U("/".MODULE_NAME."/pshow_".$id); ?>';//自定义文章生成路径$url
	        }else{
	        	$str .= '$url=U("/".MODULE_NAME."/ashow_".$id); ?>';
	        }
	        
	        $str .= $content;

	        $str .='<?php endforeach; ?>';

        }else{
			$str .= '$_list_news=D("article")->field($field)->where("'.$where.'")->relation(true)->limit("'.$limit.'")->order("'.$order.'")->select();';
        	$str .= 'foreach ($_list_news as $k=>$_list_value) : ';

	        $str .= 'extract($_list_value);';

	        if ($flag == 'p'){
	        	$str .= '$url=U("/".MODULE_NAME."/pshow_".$id); ?>';//自定义文章生成路径$url
	        }else{
	        	$str .= '$url=U("/".MODULE_NAME."/ashow_".$id); ?>';
	        }
	        
	        $str .= $content;

	        $str .='<?php endforeach; ?>';
        }
        

       return $str;
	}
	//读取特定栏目产品列表
	public function _pist ($tag,$content){
		$id =$tag['id']; //栏目id
		if ($tag['img']){
			$where = "cid in (".$id.") and del=0 and pic<>''";
		}else{
			$where = "cid in (".$id.") and del=0";
		}
		

		$limit = $tag['limit'];//输出几条
        $order = $tag['order'];//排序方式 ASC or DESC
		
        $str = '<?php ';

        $str .= '$field=array("id","title","description","content","pic","time","click");';                
        
		$str .= '$_pist_news=M("Goods")->field($field)->where("'.$where.'")->limit("'.$limit.'")->order("'.$order.'")->select();';
		$str .= 'foreach ($_pist_news as $k=>$_pist_value) : ';

		$str .= 'extract($_pist_value);';
		
		$str .= '$url=U("/".MODULE_NAME."/details_".$id); ?>';//自定义产品生成路径$url
				
		$str .= $content;

		$str .='<?php endforeach; ?>';        

       return $str;
	}
//读取主导航
	public function _navi($tag,$content){
		$limit = $tag['limit'];
		$order = $tag['order'];
		$str = <<<str
<?php
  \$_navi_cate = M('cate')->where(array('stauts'=>0))->order("{$order}")->limit({$limit})->select();
  \$_navi_cate = Lib\Category::unlimitedForLayer(\$_navi_cate);
  foreach (\$_navi_cate as \$k=>\$_navi_v) :
  	extract(\$_navi_v);
  	switch (\$_navi_v['model']){
		case 'Article' : \$url = U("/".MODULE_NAME."/alist_".\$id);
		 break; 
		case 'Info' : \$url = U("/".MODULE_NAME."/info_".\$id);
		 break;
		case 'Atlas' : \$url = U("/".MODULE_NAME."/plist_".\$id);
		 break;
		case 'Gbook' : \$url = U("/".MODULE_NAME."/gbook_".\$id);
		 break;
		case 'Slink' : \$url = \$_navi_v['link'];
		 break;
		case 'Jobs' : \$url = U("/".MODULE_NAME."/jobs_".\$id);
		 break;
		case 'Goods' : \$url = U("/".MODULE_NAME."/goods_".\$id);
		 break;
  	}
?>
str;
		$str .= $content;
		$str .= '<?php endforeach; ?>';
		return $str;
	}
//读取友情链接
	public function _borl($tag,$content) {
		$name = $tag['name'];
		$limit = $tag['limit'];
		$order = $tag['order'];
		$type = $tag['type'];
		if ($name == "link"){
			$where = "array('stauts'=>0)";
		}else{
			$where = "'type=".$type." and img is not null'";
		}
		

		$str = <<<str
<?php
    \$_link_data = M('{$name}')->where({$where})->order("{$order}")->limit("{$limit}")->select();
    foreach(\$_link_data as \$k=>\$_link_v) :
    	extract(\$_link_v);
?>
str;
		$str .= $content;
		$str .= '<?php endforeach; ?>';
		return $str;
	}

	//读取留言表单
	public function _gbook($tag,$content) {
		$id = $tag['id'];
		$limit = $tag['limit'];
		$where = 'cid = '.$id.' and reply is not null';

		$str = <<<str
<?php
    \$_gbook_data = M('gbook')->where("{$where}")->order("id DESC")->limit("{$limit}")->select();
    foreach(\$_gbook_data as \$_gbook_v) :
    	extract(\$_gbook_v);
?>
str;
		$str .= $content;
		$str .= '<?php endforeach; ?>';
		return $str;
	}

//根据父级id返回所有子级
	public function _fav($tag,$content){
		$id = $tag['id'];
		$where = "array('stauts'=>0,'pid'=>".$id.")";
		$str = <<<str
<?php
  \$_fav_cate = M('cate')->where({$where})->order('sort ASC,id ASC')->select();
  foreach (\$_fav_cate as \$_fav_v) :
  	extract(\$_fav_v);
  	switch (\$_fav_v['model']){
		case 'Article' : \$url = U("/".MODULE_NAME."/alist_".\$id);
		 break; 
		case 'Info' : \$url = U("/".MODULE_NAME."/info_".\$id);
		 break;
		case 'Atlas' : \$url = U("/".MODULE_NAME."/plist_".\$id);
		 break;
		case 'Gbook' : \$url = U("/".MODULE_NAME."/gbook_".\$id);
		 break;
		case 'Slink' : \$url = \$_fav_v['link'];
		 break;
		case 'Jobs' : \$url = U("/".MODULE_NAME."/jobs_".\$id);
		 break;
		case 'Goods' : \$url = U("/".MODULE_NAME."/goods_".\$id);
		 break;
  	}
?>
str;
		$str .= $content;
		$str .= '<?php endforeach;?>';
		return $str;

	}
//面包屑导航
	public function _crumb($tag,$content){
		$id = $tag['id'];
		$str = <<<str
<?php
	    \$_crumb_cate = M('cate')->select();
	    \$_crumb_cate = Lib\Category::getParents(\$_crumb_cate,{$id});
    
		foreach (\$_crumb_cate as \$_crumb_v){
			extract(\$_crumb_v);
			switch (\$_crumb_v['model']){
				case 'Article' : \$url = U("/".MODULE_NAME."/alist_".\$id);
				 break; 
				case 'Info' : \$url = U("/".MODULE_NAME."/info_".\$id);
				 break;
				case 'Atlas' : \$url = U("/".MODULE_NAME."/plist_".\$id);
				 break;
				case 'Gbook' : \$url = U("/".MODULE_NAME."/gbook_".\$id);
				 break;
				case 'Slink' : \$url = \$_crumb_v['link'];
				 break;
				case 'Jobs' : \$url = U("/".MODULE_NAME."/jobs_".\$id);
				 break;
				case 'Goods' : \$url = U("/".MODULE_NAME."/goods_".\$id);
				break;
		  	}
		echo "<li>&gt;&gt;&nbsp;<a href='".\$url."'>";
		echo \$name;
		echo "</a></li>";
		}
?>
str;
  		 return $str;
	}


}
?>