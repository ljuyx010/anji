// 百度地图API功能
    function G(id) {
        return document.getElementById(id);
    }

    var map = new BMap.Map("l-map");
    map.centerAndZoom("孝感",12);                   // 初始化地图,设置城市和地图级别。
    var startaddPonit;
    var endaddPonit;
    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
        {"input" : "suggestId"
        ,"location" : map
    });

    var ac2 = new BMap.Autocomplete(    //建立一个自动完成的对象
        {"input" : "suggestId2"
        ,"location" : map
    });

    ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
    var str = "";
        var _value = e.fromitem.value;
        var value = "";
        if (e.fromitem.index > -1) {
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }    
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }    
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        G("searchResultPanel").innerHTML = str;
    });

    ac2.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
    var str = "";
        var _value = e.fromitem.value;
        var value = "";
        if (e.fromitem.index > -1) {
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }    
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }    
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        G("searchResultPanel2").innerHTML = str;
    });

    var myValue;
    ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
        myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

        //setPlace();
    });

    var myValue2;
    ac2.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
        myValue2 = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        G("searchResultPanel2").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue2;

        //setPlace2();
          getPoint();
        //getduration();
    });

    function setPlace(){
        map.clearOverlays();    //清除地图上所有覆盖物
        function myFun(){
            var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
            startaddPonit = pp;
            map.centerAndZoom(pp, 18);
            map.addOverlay(new BMap.Marker(pp));    //添加标注
        }
        var local = new BMap.LocalSearch(map, { //智能搜索
          onSearchComplete: myFun
        });
        local.search(myValue);
    }

    function geocodeSearch(add,i){

    }
    function getPoint(){
        var myGeo = new BMap.Geocoder();
        var points = [];
        myGeo.getPoint(myValue, function(point){
            if (point) {
               //document.getElementById("result").innerHTML +=  myValue + ":" + point.lng + "," + point.lat + "</br>";
                var address = new BMap.Point(point.lng, point.lat);
                var marker = new BMap.Marker(address);
                map.addOverlay(marker);
                marker.setLabel(new BMap.Label("1:"+myValue,{offset:new BMap.Size(20,-10)}));
                points[0] = address;
                //console.log(address);
                //console.log(i);
                myGeo.getPoint(myValue2, function(point){
                    if (point) {
                        //document.getElementById("result").innerHTML +=  myValue2 + ":" + point.lng + "," + point.lat + "</br>";
                        var address = new BMap.Point(point.lng, point.lat);
                        var marker = new BMap.Marker(address);
                        points[1] = address;
                        map.addOverlay(marker);
                        marker.setLabel(new BMap.Label("2:"+myValue2,{offset:new BMap.Size(20,-10)}));
                        console.log(points);
                        getduration(points[0],points[1]);
                    }
                }, "孝感市");
            }
        }, "孝感市");
    }


    function getduration(point1,point2){
        //var startdm = G("suggestId").innerHTML;
        //var enddm = G("suggestId2").innerHTML;
        var output = "";
        var searchComplete = function (results){
            if (transit.getStatus() != BMAP_STATUS_SUCCESS){
                return ;
            }
            var plan = results.getPlan(0);
            //output += plan.getDuration(true) + "\n";                //获取时间
            //output += "总路程为：" ;
            output += plan.getDistance(true);             //获取距离
            G("lc").value =output;
        }
        var transit = new BMap.DrivingRoute(map, {renderOptions: {map: map},
            onSearchComplete: searchComplete,
            onPolylinesSet: function(){        
                //setTimeout(function(){alert(output)},"1000");
        }});
        transit.search(point1, point2);
    }