<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>关闭当前页</title>
	<script src="/WEB/Website/public/js/jquery.min.js?v=2.1.4"></script>
	<script>
		$(function(){
			$('.page-tabs-content .active', window.parent.document).remove();
			$('.J_menuTab:first', window.parent.document).addClass('active');
			$('.J_iframe:eq(0)', window.parent.document).css('display','block');			
		});
	</script>
</head>
<body>
</body>
</html>