/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-05-30 15:03:35 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-08-28 23:00:00
 */
function book(e){
    if(e=='isbnImg'){isbnImg();}
    else if(e=='doubanUrl'){doubanUrl();}
}
// 书单图片高度
function isbnImg(){
    document.getElementById("isbn-img").getElementsByTagName("img")[0].style.height = document.getElementById("isbn-info").offsetHeight+'px';
}
function doubanUrl(){
if(document.getElementById("douban")){
    var id = document.getElementById("douban").dataset.id
    var content = document.getElementsByClassName('entry-content')[0];
    var article = content.innerHTML.replace(/(<h2>读书摘录<\/h2>|<h2>读书书评<\/h2>)/gi, function ($0, $1) {
       return {
        "<h2>读书摘录</h2>": '<h2>读书摘录</h2><a class="book-douban-more" href="//book.douban.com/subject/'+id+'/blockquotes" target="_blank" rel="nofollow">查看瓣友的摘录 >></a>',
        "<h2>读书书评</h2>": '<h2>读书书评</h2><a class="book-douban-more" href="//book.douban.com/subject/'+id+'/comments" target="_blank" rel="nofollow">查看瓣友的书评 >></a>',
       }[$1];
    });
    content.innerHTML=article;
}
}


// 说明 ：用 Javascript 实现锚点(Anchor)间平滑跳转 
// 来源 ：ThickBox 2.1 
// 整理 ：Yanfu Xie [xieyanfu@yahoo.com.cn] 
// 网址 ：http://www.codebit.cn 
// 日期 ：07.01.17 

// 转换为数字 
function intval(v) 
{ 
    v = parseInt(v); 
    return isNaN(v) ? 0 : v; 
} 

// 获取元素信息 
function getPos(e) 
{ 
    var l = 0; 
    var t  = 0; 
    var w = intval(e.style.width); 
    var h = intval(e.style.height); 
    var wb = e.offsetWidth; 
    var hb = e.offsetHeight; 
    while (e.offsetParent){ 
        l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0); 
        t += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0); 
        e = e.offsetParent; 
    } 
    l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0); 
    t  += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0); 
    return {x:l, y:t, w:w, h:h, wb:wb, hb:hb}; 
} 

// 获取滚动条信息 
function getScroll()  
{ 
    var t, l, w, h; 
     
    if (document.documentElement && document.documentElement.scrollTop) { 
        t = document.documentElement.scrollTop; 
        l = document.documentElement.scrollLeft; 
        w = document.documentElement.scrollWidth; 
        h = document.documentElement.scrollHeight; 
    } else if (document.body) { 
        t = document.body.scrollTop; 
        l = document.body.scrollLeft; 
        w = document.body.scrollWidth; 
        h = document.body.scrollHeight; 
    } 
    return { t: t, l: l, w: w, h: h }; 
} 

// 锚点(Anchor)间平滑跳转 
function scroller(el, duration) 
{ 
    if(typeof el != 'object') { el = document.getElementById(el); } 

    if(!el) return; 

    var z = this; 
    z.el = el; 
    z.p = getPos(el); 
    z.s = getScroll(); 
    z.clear = function(){window.clearInterval(z.timer);z.timer=null}; 
    z.t=(new Date).getTime(); 

    z.step = function(){ 
        var t = (new Date).getTime(); 
        var p = (t - z.t) / duration; 
        if (t >= duration + z.t) { 
            z.clear(); 
            window.setTimeout(function(){z.scroll(z.p.y, z.p.x)},13); 
        } else { 
            st = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.y-z.s.t) + z.s.t; 
            sl = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.x-z.s.l) + z.s.l; 
            z.scroll(st, sl); 
        } 
    }; 
    z.scroll = function (t, l){window.scrollTo(l, t)}; 
    z.timer = window.setInterval(function(){z.step();},13); 
} 
