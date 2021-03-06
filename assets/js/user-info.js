/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-05-29 19:20:09 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 12:29:36
 */
function userInfoOpen(id) {
    var ajax = new XMLHttpRequest();
    loading.begin();
    ajax.open('get', '/api/reader/' + id);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            //document.getElementById("paper").style.display="none";
            document.body.style.overflow = "hidden";
            var siteUrl = '';
            if (eval('(' + ajax.responseText + ')').siteUrl != '') {
                siteUrl = "<div class=\"site-url\">TA的主页: <a href=\"" + eval('(' + ajax.responseText + ')').siteUrl + "\" target=\"_blank\" rel=\"noopener\">" + eval('(' + ajax.responseText + ')').siteUrl + "</a></div>";
            }
            var box = document.createElement("div");
            box.id = "userInfoBox";
            var innerHTML = "<div id=\"userInfo\" class=\"fadeIn  animated\"><div class=\"site-content\"><div class=\"user-desc\"><img id=\"user-info-avatar\" src=\"" + eval('(' + ajax.responseText + ')').avatarUrl + "\" width=\"100\" height=\"100\" /><h2>" + eval('(' + ajax.responseText + ')').nickName + "</h2><div>" + eval('(' + ajax.responseText + ')').location + " ( " + eval('(' + ajax.responseText + ')').system + " / " + eval('(' + ajax.responseText + ')').browser + " )</div>" + siteUrl + "<div class=\"user-info-colse-a\"><button type=\"button\" class=\"user-info-colse-btn\" onclick=\"userInfoClose()\">关闭本页</button></div></div>";
            var more = "TA的最新评论";
            if (eval('(' + ajax.responseText + ')').commentList.length > 20) {
                more = "最新二十条评论";
            }
            innerHTML += "<div class=\"info-list-title\">" + more + "<span>共留下" + convertToChinaNum(eval('(' + ajax.responseText + ')').commentCount) + "条评论</span></div><ul>";
            for (var i = 0, l = eval('(' + ajax.responseText + ')').commentList.length; i < l; i++) {
                innerHTML += "<li><time title=\"" + eval('(' + ajax.responseText + ')').commentList[i].date + "\" datetime=\"" + eval('(' + ajax.responseText + ')').commentList[i].date + "\"></time> 在 <a href=\"" + eval('(' + ajax.responseText + ')').commentList[i].url + "#comment-" + id + "\" target=\"_blank\">" + eval('(' + ajax.responseText + ')').commentList[i].title + "</a> 留下评论：<div class=\"info-list-con\">" + eval('(' + ajax.responseText + ')').commentList[i].content + "</div></li>";
            }
            innerHTML += "</ul><div class=\"avatar-info\">评论者头像来自 <a href=\"http://cn.gravatar.org/\" target=\"_blank\">Gravatar</a>， 创建头像 <a href=\"https://baike.baidu.com/item/Gravatar/10996811\" target=\"_blank\">教程</a></div></div><div id=\"userInfoClose-button\" onclick=\"userInfoClose();\">&Cross;</div>";
            box.innerHTML = innerHTML;
            document.body.appendChild(box);
            loading.end('user-info-avatar');
            dateFormat();
            lazyload();
        }
    }
}
function userInfoClose() {
    document.body.style.overflow = "auto";
    document.body.removeChild(document.getElementById("userInfoBox"));
}