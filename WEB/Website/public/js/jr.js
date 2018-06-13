/*
IE浏览器版本检测
*/
var user_agent = navigator.userAgent.toLowerCase();
var b = false;
var c = '';

if (user_agent.indexOf("msie 9.0")>-1&&user_agent.indexOf("trident/6.0")>-1){
    //IE10（兼容模式）
    b = false;
    c = 'IE10（兼容模式）';
}else if (user_agent.indexOf("msie 8.0")>-1&&user_agent.indexOf("trident/6.0")>-1){
    //IE10（兼容模式）
    b = false;
    c = 'IE10（兼容模式）';
}else if (user_agent.indexOf("msie 7.0")>-1&&user_agent.indexOf("trident/6.0")>-1){
    //IE10（兼容模式）
    b = false;
    c = 'IE10（兼容模式）';
}else if(user_agent.indexOf("msie 9.0")>-1) {
    //IE9
    b = false;
    c = 'IE9';
}else if (user_agent.indexOf("msie 7.0")>-1&&user_agent.indexOf("trident/5.0")>-1){
    //IE9（兼容模式）
    b = false;
    c = 'IE9（兼容模式）';
}else if (user_agent.indexOf("msie 8.0")>-1&&user_agent.indexOf("trident/5.0")>-1){
    //IE9（兼容模式）
    b = false;
    c = 'IE9（兼容模式）';
}else if(user_agent.indexOf("msie 8.0")>-1) {
    //IE8
    b = true;
    c = 'IE8';
}else if(user_agent.indexOf("msie 7.0")>-1&&user_agent.indexOf("trident/4.0")>-1){
    //IE8（兼容模式）
    b = true;
    c = 'IE8（兼容模式）';
}else if(user_agent.indexOf("msie 7.0")>-1){
    //IE7
    b = true;
    c = 'IE7';
}else if(user_agent.indexOf("msie 6.0")>-1){
    //IE6
    b = true;
    c = 'IE6';
}          

if(b){
    if(confirm('提示：您当前IE浏览器版本为'+c+'，为获取更好展示效果，建议升级至IE9或使用360浏览器极速模式访问')){
        window.open('http://rj.baidu.com/soft/detail/23356.html?ald');
    }
}