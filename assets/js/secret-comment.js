function secretCommentOpen(id) {
    document.body.style.overflow = "hidden";
    var box = document.createElement("div");
    box.id = "secretComment";
    box.innerHTML = "<div class=\"secret-comment-con fadeIn  animated\"><div class=\"site-content\"><h2>查看隐私评论</h2><input class=\"secret-comment-input\" id=\"secret-comment-input\" placeholder=\"输入邮箱以查看...\" ><button type=\"button\" class=\"secret-comment-button\" onclick=\"secretComment("+id+")\">查看评论</button><div class=\"secret-comment-tip\">查询权限：只支持当前评论人或被评论人的邮箱，其他人均无权查看。</div><div id=\"secret-comment-text\"></div></div></div><div class=\"secret-comment-close\" onclick=\"secretCommentClose();\">&Cross;</div>";
    document.body.appendChild(box);

}
function secretCommentClose() {
    document.body.style.overflow = "auto";
    document.body.removeChild(document.getElementById("secretComment"));
}
function secretComment(id){
    var email=document.getElementById("secret-comment-input");
    var text=document.getElementById("secret-comment-text");
    var emailReg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
    if(!emailReg.test(email.value)){
        return  text.innerHTML='<div class="secret-comment-text">请填写正确的邮箱</div>';
    }
    var emailUrl=encodeURIComponent(email.value);
    var ajax = new XMLHttpRequest();
    loading.begin();
     
    ajax.open('get', '/api/secretComment/'+ id+'/'+emailUrl);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if(eval('(' + ajax.responseText + ')').content!=''){
                text.innerHTML='<div class="secret-comment-text">隐私评论内容:<br/>'+eval('(' + ajax.responseText + ')').content+'</div>';}
            else{
                text.innerHTML='<div class="secret-comment-text">隐私评论内容:<br/>查到了，但是评论为空...</div>';
            }
            loading.end();
        }
        if (ajax.readyState == 4 && ajax.status != 200) {
            text.innerHTML='<div class="secret-comment-text">该邮箱没有权限查看当前隐私评论的权限</div>';
            loading.end();
        }
    }
}