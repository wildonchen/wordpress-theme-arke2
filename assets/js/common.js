/*!
 * @Author: chenqiwei.net
 * @Date: 2021-04-04 00:14:01
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-27 21:38:06
 */
/*
(function () {
var url=window.location.pathname;
var urlf=url.substring(1);
var urlg=urlf.replace(/\//g,'-');
if(urlg.substr(urlg.length-1, 1) =='-'){urlg=urlg.substr(0,urlg.length-1)};
if (urlg){urlg='\u0023' + urlg};
Array.from(document.querySelectorAll('a')).forEach(each => each.setAttribute('href', each.getAttribute("href") + urlg));
}
)();*/
/* 处理异步加载ajax */
function AjaxJs(ajaxjs) {
    var regDetectJs = /<script(.|\n)*?>(.|\n|\r\n)*?<\/script>/gi;
    var jsContained = ajaxjs.match(regDetectJs);
    if (jsContained) {
        // 分段取出js正则
        var regGetJS = /<script(.|\n)*?>((.|\n|\r\n)*)?<\/script>/im; // 按顺序分段执行js
        var jsNums = jsContained.length;
        for (var i = 0; i < jsNums; i++) {
            var jsSection = jsContained[i].match(regGetJS);
            if (jsSection[2]) {
                if (window.execScript) {
                    // 给IE的特殊待遇
                    window.execScript(jsSection[2]);
                } else {
                    // 给其他大部分浏览器用的
                    window.eval(jsSection[2]);
                }
            }



        }
    }

}
/* 异步加载函数 */
function openAjax(url, type = "1") {
    //if(url.substr(url.length-1,1)!='/'){ /* 判断url斜杠避免301重定向 */
    //  url=url+'/';
    //}
    var urlGet = '';
    if (type != "comment") {
        loading.begin();
        if (url.indexOf("?pjax") == -1) {
            urlGet = '?pjax'
        }
    }
    var ajax = new XMLHttpRequest();
    ajax.open("get", url + urlGet);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {

            if (type == "comment") {
                /*var load = document.createElement("div");
                                load.id = "comment-area";
                                load.innerHTML=ajax.responseText;
                                var doc=document.getElementsByClassName('home-footer')[0];
                                document.getElementsByClassName('content-area')[0].insertBefore(load,doc);*/
                document
                    .getElementsByTagName("article")[0]
                    .insertAdjacentHTML("afterEnd", ajax.responseText);
            } else {


                //document.getElementsByClassName('site-content')[0].insertAdjacentHTML("afterEnd",ajax.responseText);
                document.getElementsByClassName("site-content")[0].innerHTML = ajax.responseText;
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                loading.end('last');
            }
            new WOW().init();
            changeA();
            AjaxJs(ajax.responseText);
        } else if (ajax.status == 404) {
            loading.end();
            var tip = document.createElement("div");
            tip.id = "tip-404";
            tip.innerHTML = "404：找不到您要访问的页面 :(";
            document.body.appendChild(tip);
            setTimeout(function () {
                document.body.removeChild(document.getElementById("tip-404"));
            }, 2000);

        } else if (ajax.status == 500) {
            loading.end();
            location.reload();
        }
    };
}
/* a标签事件处理函数 */
function changeA() {
    var a = document
        .getElementById("paper")
        .getElementsByTagName("a"); /* 针对nav和conten的a标签生效 */
    /* 取消a标签点击事件函数 */
    function stop(event) {
        event =
            event || window.event; /* IE和Chrome下是window.event 火狐下是event */
        if (event.preventDefault) {
            /*event.preventDefault(); 取消事件的默认动作*/
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
    }
    /* 阻止a链接跳转，并异步加载a链接资源 */
    for (var i = 0; i < a.length; i++) {
        a[i].onclick = function (e) {
            var ahref = "2" + this.getAttribute("href") + "2";
            if (ahref != "2null2") {
                //this.getAttribute('href').indexOf("%23") ==-1 &&
                if (
                    this.getAttribute("href").indexOf("#") == -1 &&
                    this.getAttribute("href").indexOf("(") == -1 &&
                    this.getAttribute("href").indexOf(window.location.host) != -1
                ) {
                    /*  #后参数 */
                    var urlf = window.location.pathname.substring(1);
                    var urlg = urlf.replace(/\//g, "-");
                    if (urlg.substr(urlg.length - 1, 1) == "-") {
                        urlg = urlg.substr(0, urlg.length - 1);
                    }
                    var top = findPosY(this);

                    window.history.replaceState("", "", window.location.href + "#" + top);
                    /* 修改地址栏url */
                    stop(e); /* 阻止跳转 */

                    openAjax(this.getAttribute("href"));
                    window.history.pushState(
                        "",
                        "",
                        this.getAttribute("href") + "#" + urlg
                    );
                    return false;
                }
            }
        };
    }
}

/* 调用a标签事件处理函数 */
window.addEventListener("DOMContentLoaded", function () {
    changeA();
    new WOW().init();
});
function commentData(type, id) {
    openAjax("/api/comment/" + type + "/" + id, "comment");
}
/* 全局监听返回事件，异步刷新页面 */
window.addEventListener(
    "popstate",
    function (e) {
        openAjax(window.location.pathname);
        var hash = window.location.hash.match(/\#\d+(\.\d+)?/g);
        var str = window.location.hash.match(/\#\d+(\.\d+)?/g).pop();
        var url = str.substr(1, str.length - 1);
        Bounding(url);
    },
    false
);
//获取元素距离顶部的距离
function findPosY(obj) {
    //obj为所要计算的元素,可用id或class获取
    var top = 0;
    if (obj.offsetParent) {
        do {
            top += obj.offsetTop;
        } while ((obj = obj.offsetParent));
        return [top];
    }
}
var imgLightbox = (function openImgBox() {
    return {
        open: function (e) {
            loading.begin();
            //处理oss缩略图
            if (e.src.indexOf("?x-oss-process") == -1) {
                var src = e.src;
            } else {
                var src = e.src.substring(0, e.src.indexOf("?"));
            }
            var box = document.createElement("div");
            var imgBox = document.documentElement.clientHeight;
            box.id = "Lightbox";
            box.innerHTML =
                '<div id="imgLightbox"  onclick="imgLightbox.close();"><form style="width:100% ;height:100%"><table border=0 cellpadding=0 cellspacing=0 style="width:100% ;height:100%"><tr><td style="width:100%;" align="center" valign="middle"><img id="imgLightImg" style="max-height:' +
                imgBox +
                'px;" src="' +
                src +
                '" onerror="this.src=base+\'/assets/img/no-img.jpg\'"/></td></tr></table></form></div><div id="imgLightbox-button" onclick="imgLightbox.close();">&Cross;</div>';
            document.body.appendChild(box);
            loading.end("imgLightImg");
        },
        close: function () {
            document.body.removeChild(document.getElementById("Lightbox"));
        },
    };
})();

var display = (function displayDis() {
    return {
        none: function (e) {
            document.getElementById(e).classList.add("none");
        },
        block: function (e) {
            document.getElementById(e).classList.remove("none");
        },
        auto: function (e) {
            if (
                ("" + document.getElementById(e).className + "").indexOf(
                    "" + "none" + ""
                ) > -1
            ) {
                document.getElementById(e).classList.remove("none");
            } else {
                document.getElementById(e).classList.add("none");
            }
        },
    };
})();


var loading = (function loadingBox() {
    return {
        begin: function (e) {
            document.getElementById('loading').classList.add('loading');
        },
        end: function (e = '') {
            if (e != '') {
                document.getElementById(e).onload = function () {
                    document.getElementById('loading').classList.remove('loading');
                };
            }
            else {
                document.getElementById('loading').classList.remove('loading');
            }
        }
    };
})();

function footerInfo(type = "") {
    if (type == "index") {
        return createFooter(
            '<div class="icp"><div class="wow-footer fadeIn left"><a href="//beian.miit.gov.cn" rel="noreferrer" target="_blank">蜀ICP备20000904号-3</a></div><div class="wow-footer fadeIn right"><a href="//www.beian.gov.cn/portal/registerSystemInfo?recordcode=51012202000902" rel="noreferrer" target="_blank">川公网安备51012202000902号</a></div></div>'
        );
    } else {
        var endTime =
            parseInt(new Date().getTime() / 1000) -
            new Date("2021-01-17 00:00:00").getTime() / 1000;
        var timeDay = parseInt(endTime / 60 / 60 / 24);
        return createFooter(
            '<div class="copy"><div class="wow-footer fadeIn left">&copy; 2021 <a href="/">孤独日记</a><span class="l-none"> All Rights Reserved</span></div><div class="wow-footer fadeIn right">由 <a href="/go#cn.wordpress.org" rel="nofollow" target="_blank">Wordpress</a> 强力驱动<span class="l-none">, 已运行 <span title="始于 2021-01-17">' +
            timeDay +
            "</span> 天</span></div></div>"
        );
    }

}
function createFooter(con = "") {
    con = '<div class="fix-width">' + con + '</div>';
    if (document.getElementById("footer")) {
        document.getElementById("footer").innerHTML = con;
    } else {
        var footer = document.createElement("footer");
        footer.className = "footer";
        footer.id = "footer";
        footer.innerHTML = con;
        document.getElementById("paper").appendChild(footer);
    }
    var wow = new WOW({
        boxClass: "wow-footer",
    });
    wow.init();
}
function pagenavi(url, type) {
    var ajax = new XMLHttpRequest();
    var urlGet = '';
    if (url.indexOf("?pjax") == -1) {
        urlGet = '?pjax'
    }
    ajax.open("get", url + urlGet);
    ajax.send();
    loading.begin();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var content = ajax.responseText;
            var next = document.getElementsByClassName("content-area")[0];
            content =
                content.substring(
                    content.indexOf('<div class="content-area list">'),
                    content.indexOf("</script>")
                ) + "</script>";
            //console.log(content);
            content = content.replace('<div class="content-area list">', "");
            content = content.replace("</div><button", "<button");
            var getList = document.getElementsByClassName("list")[0];
            if (type == "next") {
                next.insertAdjacentHTML("beforeEnd", content);
                getList.removeChild(document.getElementById("nextPage"));
                if (document.getElementsByClassName("previous-page")[1]) {
                    getList.removeChild(
                        document.getElementsByClassName("previous-page")[1]
                    );
                } else {
                    getList.removeChild(document.getElementById("previousPage"));
                }
            } else if (type == "previous") {
                document
                    .getElementById("previousPage")
                    .insertAdjacentHTML("afterEnd", content);
                getList.removeChild(document.getElementsByClassName("more-page")[0]);
                getList.removeChild(document.getElementById("previousPage"));
            }

            var urlf = window.location.pathname.substring(1);
            var urlg = urlf.replace(/\//g, "-");
            if (urlg.substr(urlg.length - 1, 1) == "-") {
                urlg = urlg.substr(0, urlg.length - 1);
            }
            url = url.split('?');
            url = url[0];
            window.history.pushState("", "", url + "#" + urlg);
            changeA();
            AjaxJs(ajax.responseText);
            //document.getElementsByClassName('content-area')[0].insertBefore(load,next);
            loading.end();
        }
    };
}

//滚动条跳转到指定位置
function Bounding(cheight) {
    var height = document.body.clientHeight;
    var number = 0; //控制结束累加器
    var length = cheight; //控制每次翻滚长度
    var frequency = 1; //控制总时间
    var time = setInterval(function () {
        number += 1;
        if (number == frequency + 1) {
            clearInterval(time);
        } else {
            //length += height / frequency;
            document.documentElement.scrollTop = length;
        }
    }, 500); //每隔500MS翻滚一次
}

document.body.onload = function () {
    loading.end();
}
/*
window.addEventListener('scroll', function(e){
    // 页面总高
    var totalH = document.body.scrollHeight || document.documentElement.scrollHeight

// 可视高
var clientH = window.innerHeight || document.documentElement.clientHeight
    // 计算有效高
    var validH = totalH - clientH

    // 滚动条卷去高度
    var scrollH = document.body.scrollTop || document.documentElement.scrollTop

    // 百分比
    var result = (scrollH/validH*100).toFixed(0);
    if(result>100){
        result=100;
    }
})
*/

var p = 0,
    t = 0;
window.addEventListener("scroll", function (e) {
    var here = document.getElementsByClassName("site-header")[0];
    p = document.body.scrollTop || document.documentElement.scrollTop;
    if (t <= p || p <= 1) {
        here.classList.remove("fixed", "fadeInDown"); //向下滚
    } else {
        here.classList.add("fixed", "animated-05", "fadeInDown"); //向上滚
    }
    t = p;
});
/*
function setHeaderNav(a,b){
    //a 1=分类，2=发现，3=专题
    var aAry=[];
    aAry[0]=[""];
    aAry[1]=["<a>分类</a>","动态说","孤独说","生活圈","菜园子","宅基地","足迹图"];
    aAry[2]=["<a>发现</a>","标签聚合","我的音乐","本站插件","读者排行","文章归档"];
    aAry[3]=["<a>专题</a>","留言","关于","邻居"];
    var aStr='<nav class="menu-1 menu-0"><ul class="menu"><li>'+aAry[a][0]+'<ul>';
    for(j = 1,len=aAry.length; j < len; j++) {
        if(j!=a){
            aStr+='<li>'+aAry[j][0]+'</li>';
        }
    }
    aStr+='</li></ul></nav><div class="menu-more"><i class="icon-chevron-right"></i></div>';
    var bStr='<ul><li>'+aAry[a][b]+'</li>';
    for(j = 1,len=aAry[a].length; j < len; j++) {
        if(j!=b){
            bStr+='<li>'+aAry[a][j]+'</li>';
        }
    }
    bStr+='</ul>';
    document.getElementsByTagName('header')[0].innerHTML='<div class="fix-width">'+aStr+'</div>';
}
setHeaderNav('1','3');
*/