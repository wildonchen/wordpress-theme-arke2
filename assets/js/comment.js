/*!
 * @Author: chenqiwei.net
 * @Date: 2021-04-05 10:50:40
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-12 22:51:19
 */
function comment(e, id) {
  if (e == "openComments") {
    commentsOrDiv(id);
    preRepAvatar(id);
    commentUbb();
    secretComment();
    qwqIn();
    openComments();
    
  }
  else if (e == 'louCengStr') {
    louCengStr();
  }
  else if (e == "moreComments") {
    moreComments(id);
    rmoveChildrenfirstAt();
  }
}
function secretComment(){
  var secret = document.createElement("p");
  secret.id = "secret";
  secret.classList = "comment-tool";
  secret.innerHTML ='<input class="checkbox_input" type="checkbox" id="secretCheckBox" name="secret" value="secret" onclick="secretCommentCheckBox()"><label for="secretCheckBox"><a><i class="icon-user-secret"></i> 私密</a></label>';
  document.getElementById("commentform").appendChild(secret);
}
function commentUbb(){
  var ubb =  document.createElement("p");
  ubb.id = "ubbImg";
  ubb.classList = "comment-tool";
  ubb.innerHTML ='<a href="javascript:ubbOut(\'[img]图片地址[/img]\')"><i class="icon-picture"></i> 图片</a>';
  document.getElementById("commentform").appendChild(ubb);
  var ubb2 =  document.createElement("p");
  ubb2.id = "ubbUrl";
  ubb2.classList = "comment-tool";
  ubb2.innerHTML ='<a href="javascript:ubbOut(\'[url]链接地址[/url]\')"><i class="icon-link"></i> 链接</a>';
  document.getElementById("commentform").appendChild(ubb2);
}
function ubbOut(Outs) {
  document.getElementById("comment").value = document.getElementById("comment").value + Outs;
    document.getElementById('comment').focus();
}
function secretCommentCheckBox(){
  if (document.getElementById('secretCheckBox').checked == 1){
    document.getElementById('comment').style.background='whitesmoke';
    commentTip('勾选后，只有评论者和被评论者以及博主才有权查看。评论者邮箱作为查看凭证。');
  }
  else{
    document.getElementById('comment').style.background='';
    commentTip('remove');
  }
}
function commentTip(content=''){
  if(content!='remove'){
    content='<i class="icon-info-circled"></i>&nbsp;'+content;
  if(document.getElementById('commentTip')){
    document.getElementById("commentTip").innerHTML=content;
  }
  else{
  var tip = document.createElement("div");
  tip.id = "commentTip";
  tip.innerHTML =content;
  document.getElementById("respond").appendChild(tip);
  }
}
  else{
    if(document.getElementById('commentTip')){
    document.getElementById("commentTip").remove();
    }
  }
}
function commentsOrDiv(e) {
  var mycomment = document.getElementById("comment");
  var id = document.getElementById("comments-bg");
  var box = document.getElementById("respond");
  if (e == "none") {
    id.style.display = "none";
    /* 初始化 */
    mycomment.focus();
    mycomment.setAttribute("placeholder", "开始撰写...");
  } else if (e == "show") {
    mycomment.setAttribute("style", "");
    commentTip('remove');
    id.style.display = "inline-block";
    /* 初始化 */
    mycomment.value = "";
    mycomment.setAttribute("placeholder", "");
    box.classList.remove("comment-form-show");
    box.classList.remove("comment-btn-show");
  } else {
    var div = document.createElement("div");
    div.id = "comments-bg";
    div.innerHTML =
      '<div id="respond-avatar">' + getRepAvatar(e) + '</div></div><div class="respond-text">点击开始撰写你的评论...</div>';
    document.getElementsByClassName("comment-form-comment")[0].append(div);
    mycomment.value = '';
    div.onclick = function () {
      commentsOrDiv("none");
    };
  }
}
function preRepAvatar(e){;
  var email=document.getElementById("email");
  var emailValue=email.value;
  var pre = document.createElement("p");
  pre.id = "pre-avatar";
  pre.classList = "comment-tool";
  pre.innerHTML ='<a href="javascript:editRep();">'+getRepAvatar(e)+'</a>';
  document.getElementById("commentform").appendChild(pre);
  function preTmp(){
    if (emailValue!=email.value){
    var imgSrc=getRepAvatar(md5(email.value));
    document.getElementById("pre-avatar").innerHTML=imgSrc;
    emailValue=document.getElementById("email").value;
    document.getElementById("respond-avatar").innerHTML=imgSrc;
    }
  }
  email.onblur = function () {
    try{
      preTmp();
    }
    catch(err){
      loadScript(
        "/assets/js/md5.min.js",
        "js",
        "md5-js",
        "body"
      );
    document.getElementById("md5-js").addEventListener("load", function () {
      preTmp();
    });
  };
  };
}
function getRepAvatar(e){
  if (e) { return '<img src="//sdn.geekzu.org/avatar/' + e + '?s=40&d=mm" width="40" height="40"/>'; }
    else {
      return'<img src="' + base + '/assets/img/avatar.png" width="40" height="40" />';
    }
  
}
function editRep(){
  var box = document.getElementById("respond");
  if (
    ("" + box.className + "").indexOf(
        "" + "comment-form-show" + ""
    ) > -1
) {
  box.classList.remove("comment-form-show");
} else {
  box.classList.add("comment-form-show");
}
}
function openComments() {
  loadScript(
    "/assets/css/comment-open.min.css",
    "css",
    "comment-open-css",
    "head"
  );
  loadScript(
    "/assets/js/comment-reply.min.js",
    "js",
    "comment-reply-js",
    "body"
  );
  var mysubmit = document.getElementById("submit");
  var mycomment = document.getElementById("comment");
  var email=document.getElementById("email");
  var box = document.getElementById("respond");
  try {
    document.getElementById("wp-comment-cookies-consent").checked = true;
    document.getElementById("author").setAttribute("placeholder", "「怎么称呼」");
    document.getElementById("email").setAttribute("placeholder", "「留下邮箱」");
    document.getElementById("url").setAttribute("placeholder", "「主页」选填");
  } catch (err) {}
  document.getElementById("comment").onkeydown = function () {
    if (this.value.length > 1) {
        secretCommentCheckBox();
      if(email.value){
        box.classList.add("comment-btn-show");
      }
      else{
        
        box.classList.add("comment-form-show");
      }
    } else {
      mycomment.setAttribute("style", "");
      display.none('qwq-show');
      commentTip('remove');
      if(email.value){
        box.classList.remove("comment-btn-show");
      }
      else{
        box.classList.remove("comment-form-show");
      }
    }
  };
  mycomment.onblur = function () {
    if (this.value.length < 1) {
      commentsOrDiv("show");
    }
  };
  mycomment.onfocus = function () {
    commentsOrDiv("none");
    try {
      commentSubmitCheck();
    } catch (err) {
      loadScript(
        "/assets/js/comment-submit-check.min.js",
        "js",
        "commtent-submit-check",
        "body"
      );
      document
        .getElementById("commtent-submit-check")
        .addEventListener("load", function () {
          commentSubmitCheck();
        });
    }
  };
}
function louCengStr() {
  /* 楼层 */
  var louCengName = ['沙发', '板凳', '地板', '天花板', '站票', '挂票', '地下室'];
  var depth = document.getElementsByClassName("comment-list")[0].getElementsByClassName("depth-1");
  var count2=-1;
  for (var i = depth.length-1; i >=0; i--) {
    count2+=1;
    var con = depth[count2].getElementsByClassName("reply")[0];
    if (i < 7) {
      louCeng = louCengName[i];
    }
    else {
      louCeng = (i+1) + 'F';
    }
    con.innerHTML = '<span class="louceng l-none">' + louCeng + '</span>' + con.innerHTML;
  }
}
function rmoveChildrenfirstAt(){
  if(document.getElementsByClassName('children')){
    var c=document.getElementsByClassName('children');
    for (var i = 0 ; i <=c.length-1; i++) {
      var id=c[i].parentNode.getAttribute("id")
      if(document.getElementsByClassName(id)[0]){
        document.getElementsByClassName(id)[0].style.display="none";
      }
    }
  }
}
function moreComments(num) {
  /* 汉化评论条数 */
  var num2 = convertToChinaNum(num);
  document.getElementsByClassName("comments-title")[0].innerText =
    num2 + "条评论";
  var a = document.getElementById("reply-title").innerHTML;
  document.getElementById("reply-title").innerHTML = a.replace(/进行回复/, "");
}
function convertToChinaNum(num) {
  var arr1 = new Array(
    "零",
    "一",
    "二",
    "三",
    "四",
    "五",
    "六",
    "七",
    "八",
    "九"
  );
  var arr2 = new Array("", "十", "百");
  if (!num || isNaN(num)) {
    return "零";
  }
  var english = num.toString().split("");
  var result = "";
  for (var i = 0; i < english.length; i++) {
    var des_i = english.length - 1 - i;
    result = arr2[i] + result;
    var arr1_index = english[des_i];
    result = arr1[arr1_index] + result;
  }
  if (result == "二") {
    result = "两";
  } else {
    result = result.replace(/零$/, "");
    result = result.replace(/一十/g, "十");
  }
  return result;
}
/* 颜文字标签 */
function qwqIn() {
  var on = ' onclick="qwqOut(this)"';
  var qwq = document.createElement("p");
  qwq.id = "qwq";
  qwq.classList = "comment-tool";
  qwq.innerHTML =
    '<div class="qwq-on"><a href="javascript:display.auto(\'qwq-show\');"><i class="icon-smile"></i> 表情</a></div><div class="qwq-show none" id="qwq-show"><span' +
    on +
    ">OωO</span><span" +
    on +
    ">( ゜- ゜)つロ</span><span" +
    on +
    ">_(:з」∠)_</span><span" +
    on +
    ">（￣▽￣）</span><span" +
    on +
    ">(=・ω・=)</span><span" +
    on +
    ">(*°▽°*)八(*°▽°*)♪</span><span" +
    on +
    ">(¦3【▓▓】</span><span" +
    on +
    ">(ಡωಡ)</span><span" +
    on +
    ">_(≧∇≦」∠)_</span><span" +
    on +
    ">━━━∑(ﾟ□ﾟ*川━</span><span" +
    on +
    ">(｀・ω・´)</span><span" +
    on +
    ">✧(≖ ◡ ≖✿)</span><span" +
    on +
    ">╮(￣▽￣)╭</span><span" +
    on +
    ">(ﾟДﾟ≡ﾟдﾟ)!?</span><span" +
    on +
    ">( ´･･)ﾉ(._.`)</span><span" +
    on +
    ">Σ(ﾟдﾟ;)</span><span" +
    on +
    ">(｡･ω･｡)</span><span" +
    on +
    ">(´･_･`)</span><span" +
    on +
    ">（￣へ￣）</span><span" +
    on +
    ">(￣ε(#￣)</span><span" +
    on +
    "> Σ(╯°口°)╯(┴—┴</span><span" +
    on +
    ">ヽ(`Д´)ﾉ</span><span" +
    on +
    '>("▔□▔)/</span><span' +
    on +
    ">(๑>؂<๑）</span><span" +
    on +
    ">｡ﾟ(ﾟ´Д｀)ﾟ｡</span><span" +
    on +
    ">(┯_┯)</span><span" +
    on +
    ">Σ_(꒪ཀ꒪」∠)</span></div>";
  document.getElementById("commentform").appendChild(qwq);
}
function qwqOut(qwqOuts) {
  document.getElementById("comment").value =
    document.getElementById("comment").value + qwqOuts.innerHTML;
    display.none('qwq-show');
    document.getElementById('comment').focus();
}
function userInfo(id) {
  try {
    userInfoOpen(id);
  } catch (err) {
    loadScript("/assets/css/user-info.min.css", "css", "user-info-css", "head");
    loadScript("/assets/js/user-info.min.js", "js", "user-info-js", "body");
    document.getElementById("user-info-js").addEventListener("load", function () {
      userInfoOpen(id);
    })
  }
}
function secretCommentShow(id) {
  try {
    secretCommentOpen(id);
  } catch (err) {
    loadScript("/assets/css/secret-comment.min.css", "css", "secret-comment-css", "head");
    loadScript("/assets/js/secret-comment.min.js", "js", "secret-comment-js", "body");
    document.getElementById("secret-comment-js").addEventListener("load", function () {
      secretCommentOpen(id);
    })
  }
}