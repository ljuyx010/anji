	//更新验证码
	function change_code(obj){
	$("#code").attr("src",verifyUrl+'/'+Math.random());
	return false;
    }

$(document).ready(function() {

	// 输入框激活焦点、移除焦点
	jQuery.focusblur = function(focusid) {
		var focusblurid = $(focusid);
		var defval = focusblurid.val();
		focusblurid.focus(function() {
			var thisval = $(this).val();
			if (thisval == defval) {
				$(this).val("");
			}
		});
		focusblurid.blur(function() {
			var thisval = $(this).val();
			if (thisval == "") {
				$(this).val(defval);
			}
		});

	};
	/* 下面是调用方法 */
	$.focusblur("#email");
	$.focusblur("#password");
	$.focusblur("#codet");

	// 输入框激活焦点、溢出焦点的渐变特效
	if ($("#email").val()) {
		$("#email").prev().fadeOut();
	}

	if ($("#password").val()) {
		$("#password").prev().fadeOut();
	}

	if ($("#codet").val()) {
		$("#codet").prev().fadeOut();
	}

	$("#email").focus(function() {
		$(this).prev().fadeOut();
	});
	$("#email").blur(function() {
		if (!$("#email").val()) {
			$(this).prev().fadeIn();
		}
	});
	$("#password").focus(function() {
		$(this).prev().fadeOut();
	});
	$("#password").blur(function() {
		if (!$("#password").val()) {
			$(this).prev().fadeIn();
		}
	});
	$("#codet").focus(function() {
		$(this).prev().fadeOut();
	});
	$("#codet").blur(function() {
		if (!$("#codet").val()) {
			$(this).prev().fadeIn();
		}
	});
});
