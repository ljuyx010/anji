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

  /**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
        $data = array(
            array(NULL, 2010, 2011, 2012),
            array('Q1',   12,   15,   21),
            array('Q2',   56,   73,   86),
            array('Q3',   52,   61,   69),
            array('Q4',   30,   32,    0),
           );
 */
function create_xls($data,$filename='simple.xls'){
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}
?>