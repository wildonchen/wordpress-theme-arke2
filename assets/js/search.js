/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-04-10 21:01:06 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-06-20 15:35:13
 */
function keyOut(key){
    document.getElementsByClassName("search-field")[0].value = key.innerHTML;
}
function keyDel(key,i){
    var arr=getCookie("search_key").split(',');
    arr.splice(i,1);
    var year=new Date().getFullYear()+1;
    document.cookie="search_key="+arr.toString()+"; expires=Fri, 31 Dec "+year+" 23:59:59 GMT; path=/";
    document.getElementsByClassName("key"+i)[0].style.display="none";
    document.getElementsByClassName("key"+i)[1].style.display="none";
}
function searchKey(key){
    var arr = getCookie("search_key").split(',');
    if (arr[10]!=null){
        arr.pop();
    }
    var year=new Date().getFullYear()+1;
    document.cookie="search_key="+key+","+arr+"; expires=Fri, 31 Dec "+year+" 23:59:59 GMT; path=/";
    var keys = document.createElement("div");
    keys.id = "search-keys";
    keysCon=getCookie("search_key").split(',');
    for (var i=0;i<keysCon.length-1;i++) {
        if (keysCon[i]!='' && keysCon[i]!="undefined"){
        keys.innerHTML=keys.innerHTML+"<span class=\"key"+i+"\" onclick=\"keyOut(this)\">"+keysCon[i]+"</span><sup class=\"key"+i+"\" onclick=\"keyDel(this,'"+i+"')\">x</sup>";}
    }
    document.getElementsByClassName("search-form")[0].appendChild(keys);
    document.getElementsByClassName("search-field")[0].onfocus = function(){
        document.getElementById("search-keys").style.display="block";
    }
    document.getElementsByClassName("search-field")[0].onblur = function(){
        setTimeout(function(){
            document.getElementById("search-keys").style.display="none";
            },200);
        
    }
}
function getCookie(objName) {//获取指定名称的cookie的值
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == objName) return temp[1];
    }
    return "";
}		

