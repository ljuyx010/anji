function animateShowTip(obj, tip) {
    obj.text(tip);
    var top = obj.attr("data-top");
    obj.animate({
        top: top,
        "height": "16px"
    },
    500)
}
function animateHideTip(obj) {
    var foot = obj.attr("data-foot");
    obj.animate({
        top: foot,
        "height": "0"		
    },
    500);
	obj.css("display","none");
}
function subcomment() {
	var zu = $('#fz').val();
    var comment = $('#nei').val();
    if (comment == "") {
        animateShowTip($('#comment_tip'), "您是不是忘了说点什么？");
        setTimeout("animateHideTip($('#comment_tip'))", 3000);
        return false
    }
//    comment = encodeURIComponent(comment);

    $.post('/index.php/Index/Comment/add', {
        fz: zu,
        nei: comment
    },
    function(data) {
		
        if(data.code==1){			
			animateShowTip($('#comment_tip'), "评论成功，审核后显示");
			setTimeout("animateHideTip($('#comment_tip'))", 3000);
			$("#nei").val("");
			return false			
		}else{
			animateShowTip($('#comment_tip'), "评论失败，请重试");
			setTimeout("animateHideTip($('#comment_tip'))", 3000);
			return false
		}        
    },"json")
}