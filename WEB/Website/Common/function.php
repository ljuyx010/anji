<?php
/**
 * 递归重组节点信息为多维数组
 * @param  [type]  $node [description]
 * @param  integer $pid  [description]
 * @return [type]        [description]
 */
  function node_merge($node,$access=null,$pid =0){
    $arr=array();
    foreach ($node as $v) {
    	if(is_array($access)){
    		$v[access] = in_array($v['id'], $access) ? 1 : 0;
    	}
    	if($v['pid'] == $pid){
    		$v['chlid']= node_merge($node,$access,$v['id']);
    		$arr[]=$v;
    	}
    }
    return $arr;
  }
  //根据父级id查找所有子id
  function getNode ($node,$id){
      $arr = array();
      foreach ($node as $v) {
        if ($v['pid'] == $id){
          $arr[] = $v['id'];
          $arr = array_merge($arr,getNode($node,$v['id']));
        }
      }
      return $arr;
    }

    //处理路径方法
  function rmdirr($dirname) {
      if (!file_exists($dirname)) {
          return false;
      }
      if (is_file($dirname) || is_link($dirname)) {
          return unlink($dirname);
      }
      $dir = dir($dirname);
      if ($dir) {
          while (false !== $entry = $dir->read()) {
              if ($entry == '.' || $entry == '..') {
                  continue;
              }
              //递归
              rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
          }
      }
  }

  //公共函数
  //获取文件修改时间
  function getfiletime($file, $DataDir) {
      $a = filemtime($DataDir . $file);
      $time = date("Y-m-d H:i:s", $a);
      return $time;
  }

  //获取文件的大小
  function getfilesize($file, $DataDir) {
      $perms = stat($DataDir . $file);
      $size = $perms['size'];
      // 单位自动转换函数
      $kb = 1024;         // Kilobyte
      $mb = 1024 * $kb;   // Megabyte
      $gb = 1024 * $mb;   // Gigabyte
      $tb = 1024 * $gb;   // Terabyte

      if ($size < $kb) {
          return $size . " B";
      } else if ($size < $mb) {
          return round($size / $kb, 2) . " KB";
      } else if ($size < $gb) {
          return round($size / $mb, 2) . " MB";
      } else if ($size < $tb) {
          return round($size / $gb, 2) . " GB";
      } else {
          return round($size / $tb, 2) . " TB";
      }
  }
?>