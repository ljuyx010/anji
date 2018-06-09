function addcart(id){
	$.post("/index.php/Index/goods/cart",{'id':id},function(result){
	if(result==1){			
		alert("已加入收藏！");		
	}else{
		alert("加入收藏失败！");
	}
	});
}

function buy(id){
	var r=confirm("您确定要加入到您的借书架里吗？");
	if (r==true){
		$.post("/index.php/Index/goods/buy",{'id':id},function(result){
		if(result==0){	
			alert("借阅成功！"); 		
		}else if(result==1){
			alert("您的借阅已超过5册或此书已被借完！");			
		}else{alert("借阅失败！");}
		});
	}
}