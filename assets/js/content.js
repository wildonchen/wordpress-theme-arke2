/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-06-01 21:33:17 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 12:31:44
 */
function content(e,id){
if(e=='dateFormat'){dateFormat(e);}
else if(e=='morePost'){morePost(id);}
}
function dateFormat(){
    if(document.getElementsByTagName("time")[0]){
    var time = document.getElementsByTagName("time");
    var now = new Date(new Date().getTime());
    for( var i=0; i<time.length; i++ ){
        var old = new Date(time[i].getAttribute("datetime"));
        time[i].innerHTML=getDuration(now-old)+'前';
    }
    function getDuration(my_time){
        var year = Math.floor(my_time / 1000 / 60 / 60 / 24 / 30 / 12);
        var month = Math.floor(my_time / 1000 / 60 / 60 / 24 / 30);
        var day = Math.floor(my_time / 1000 / 60 / 60 / 24);
        var hour = Math.floor(my_time / 1000 / 60 / 60 - 24 * day);
        var minute = Math.floor(my_time / 1000 / 60 - 24 * 60 * day - 60 * hour);
        var seconds = Math.round(my_time / 1000 - 24 * 60 * 60 * day - 60 * 60 * hour - 60 * minute);
        var time = "";
        if(year){
            time = year + "年"
        }else if(month){
            time = month + "月";
        }else if (day) {
            time = day + "天";
        } else if (hour) {
            time = hour + "小时";
        } else if (minute) {
            time = minute + "分钟";
        } else if (seconds) {
            time = seconds + "秒";
        }
        return time;
    }
    }
}
function morePost(id='1'){
    var ajax = new XMLHttpRequest();
    ajax.open('get','/api/morePost/'+id);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState==4 && ajax.status==200) {
            createFooter(eval('(' + ajax.responseText + ')').html);
            changeA();
        }
    }
}
// 收录ajax
/*
function indexed(){
var urlStr=window.location.pathname.substr(1)
var hostStr=window.location.hostname;
var ajax = new XMLHttpRequest();
ajax.open('post','/api/indexed/'+urlStr);
ajax.send();
ajax.onreadystatechange = function () {
    if (ajax.readyState==4 && ajax.status==200) {
        var baidu=eval('(' + ajax.responseText + ')').baidu;
        var bing=eval('(' + ajax.responseText + ')').bing;
        var html='';
            if(baidu=='true'){
                html+='，百度 <a href="https://www.baidu.com/s?wd=site%3A'+hostStr+'+'+urlStr+'" target="_blank">已收录</a>'
            }
            if(bing=='true'){
                html+='，必应 <a href="https://cn.bing.com/search?q=site%3A'+hostStr+'+'+urlStr+'" target="_blank">已收录</a>'
            }
            var load = document.createElement("span");
            load.id = "indexed";
            load.innerHTML=html;
            document.getElementsByClassName('entry-info')[0].appendChild(load);       
    }
}
}*/