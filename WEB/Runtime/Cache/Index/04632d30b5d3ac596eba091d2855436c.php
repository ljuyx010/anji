<?php if (!defined('THINK_PATH')) exit();?><!-- banner -->
<div id="focus" class="focus">
	<div class="bd">
		<ul>			
			<?php
 $_link_data = M('banner')->where("type=1 and pic<>''")->order("id DESC,sort ASC")->limit("5")->select(); foreach($_link_data as $k=>$_link_v) : extract($_link_v); ?><li><a class="pic" href="javascript:;"><img src="<?php echo ($pic); ?>"/></a></li><?php endforeach; ?>
		</ul>
	</div>
	<div class="hd">
		<ul></ul>
	</div>
</div>
<script type="text/javascript">
	TouchSlide({ 
		slideCell:"#focus",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul", 
		effect:"leftLoop", 
		autoPlay:true,//自动播放
		autoPage:true, //自动分页
		switchLoad:"_src" //切换加载，真实图片路径为"_src" 
	});
</script>
<!-- banner end-->