var uploader = new plupload.Uploader(
      {
		runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
		browse_button: 'btn', // 上传按钮
		url: app+"/index.php/Website/Common/upimg", //远程上传地址
		flash_swf_url: '__PUBLIC__/plupload/Moxie.swf', //flash文件地址
		silverlight_xap_url: '__PUBLIC__/plupload/Moxie.xap', //silverlight文件地址
		filters: {
			max_file_size: '2m', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
			mime_types: [//允许文件上传类型
				{title: "files", extensions: "jpg,png,gif"}
			]
     },
    multi_selection: false, //true:ctrl多文件上传, false 单文件上传
    init: {
    	BeforeUpload: function(up, file) {
               var dd = '';
        },
        FilesAdded: function(up, files) { //文件上传前
            if ($("#ul_pics").children("li").length > 30) {
                alert("您上传的图片太多了！");
                uploader.destroy();
            } else {
                
                plupload.each(files, function(file) { //遍历文件
                    dd = "<div class='progress'><span class='bar'></span><span class='percent'></span></div>";
                });
                $("#ul_pics").append(dd);
                uploader.start();
            }
        },
        UploadProgress: function(up, file) { //上传中，显示进度条
     var percent = file.percent;
            $("#" + file.id).find('.bar').css({"width": percent + "%"});
            $("#" + file.id).find(".percent").text(percent + "%");
        },
        FileUploaded: function(up, file, info) { //文件上传成功的时候触发
            var data = eval("(" + info.response + ")");
            $("#slt").html("<img src='" + data.pic + "'/>");
			//var old=$("#picsa").val();
			 $("#picsa").val(data.pic);
        },
        Error: function(up, err) { //上传出错的时候触发
            alert(err.message);
        }
    }
});
uploader.init();

var uploadat = new plupload.Uploader(
      {
		runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
		browse_button: 'bte', // 上传按钮
		url: app+"/index.php/Website/Common/upimg", //远程上传地址
		flash_swf_url: '/Public/plupload/Moxie.swf', //flash文件地址
		silverlight_xap_url: '/Public/plupload/Moxie.xap', //silverlight文件地址
		filters: {
			max_file_size: '2m', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
			mime_types: [//允许文件上传类型
				{title: "files", extensions: "jpg,png,gif"}
			]
     },
    multi_selection: true, //true:ctrl多文件上传, false 单文件上传
    init: {
        FilesAdded: function(up, files) { //文件上传前
            if ($("#ul_pic").children("li").length > 30) {
                alert("您上传的图片太多了！");
                uploadat.destroy();
            } else {
                var dd = '';
                plupload.each(files, function(file) { //遍历文件
                    dd += "<dd id='d" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></dd>";
                });
                $("#ul_pic").append(dd);
                uploadat.start();
            }
        },
        UploadProgress: function(up, file) { //上传中，显示进度条
     var percent = file.percent;
            $("#" + file.id).find('.bar').css({"width": percent + "%"});
            $("#" + file.id).find(".percent").text(percent + "%");
        },
        FileUploaded: function(up, file, info) { //文件上传成功的时候触发
           var data = eval("(" + info.response + ")");
            $("#d" + file.id).html("<img src='" + data.pic + "'/><input name='pics[]' class='dis' id='p"+file['id']+"'><p class='del'>删除</p>");
			//var old=$("#pics").val();
			 $("#p"+file.id).val(data.pic);
             $('.del').click(function(){
                $(this).parents('dd').remove();
            });
        },
        Error: function(up, err) { //上传出错的时候触发
            alert(err.message);
        }
    }
});
uploadat.init();