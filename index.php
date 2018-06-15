<?php
  header( 'Content-Type:text/html;charset=utf-8 ');
  define('APP_NAME','WEB');
  define('APP_PATH','./WEB/');
  define('APP_DEBUG',true);
  define('_URL_',"http://".$_SERVER['SERVER_NAME']);
  require dirname( __FILE__).'/Core/Thinkphp.php';
?>