var d = new Date();	

var weekday = new Array(7);
weekday[0] = "星期日";
weekday[1] = "星期一";
weekday[2] = "星期二";
weekday[3] = "星期三";
weekday[4] = "星期四";
weekday[5] = "星期五";
weekday[6] = "星期六";
var m = d.getMonth() + 1;
//显示当前时间
function CurentTime()
{
    var now = new Date();
    var hh = now.getHours();
    var mm = now.getMinutes();
    var ss = now.getTime() % 60000;
    ss = (ss - (ss % 1000)) / 1000;
    var clock = hh+':';
    if (mm < 10) clock += '0';
    clock += mm+':';
    if (ss < 10) clock += '0';
    clock += ss;
    return(clock);
}

function refreshCalendarClock() //
{
 document.all.ClockTime.innerHTML = CurentTime();
}
//显示当前时间
document.write("欢迎访问咕噜熊绘本馆！"+" 今天是:"+d.getFullYear()+"年"+m+"月"+d.getDate()+"日 "+weekday[d.getDay()]+"&nbsp;<font id=ClockTime></font>");

setInterval('refreshCalendarClock()',1000);//1秒钟刷新1次当前时间