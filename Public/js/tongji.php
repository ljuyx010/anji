<?php
error_reporting(0);
header ( "Content-type: text/html; charset=utf-8" );
//设置数据文件路径
$file = dirname(__FILE__).'/tongji.db';
$data = unserialize(file_get_contents($file));
//设置记录键值
$total = 'total';
$month = date('Ym');
$today = date('Ymd');
$yesterday = date('Ymd',strtotime("-1 day"));
$tongji = array();
// 总访问增加
$tongji[$total] = $data[$total] + 1;
// 本月访问量增加
$tongji[$month] = $data[$month] + 1;
// 今日访问增加
$tongji[$today] = $data[$today]  + 1;
//保持昨天访问
$tongji[$yesterday] = $data[$yesterday];
//保存统计数据
file_put_contents($file, serialize($tongji));
//输出数据
$total = $tongji[$total];
$month = $tongji[$month];
$today = $tongji[$today];
$yesterday = $tongji[$yesterday]?$tongji[$yesterday]:0;
//echo  "document.write('总访问 {$total}, 本月 {$month}, 昨日 {$yesterday}, 今日 {$today}');";
echo "document.write('{$total}');";