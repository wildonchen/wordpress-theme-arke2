/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-09-11 10:00:59 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-09-11 10:15:32
 */
function commentSubmitCheck(){
var mysubmit=document.getElementById('submit')
var submitText=mysubmit.value;
mysubmit.onclick=function(event){
    var c=document.getElementById('comment');
    var a=document.getElementById('author');
    var e=document.getElementById('email');
    var u=document.getElementById('url');
    var tip=null;
    if(c.value.length<3){
        if(c.value.length<1){
            tip="留言内容不能为空";
        }else{
            tip="留言内容太短了 :(";
        }
    }else if(a.value.length<1){
        tip="称呼不能为空";
    }else if(e.value.length<1){
        tip="邮箱不能为空";
    }
    else{
    var commentReg = new RegExp("[\\u4E00-\\u9FFF]+","g");
    var authorReg = new RegExp("[\\a-\z\A-\Z0-9\u4E00-\u9FFF\-\_]+","g");
    var emailReg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
    if(!commentReg.test(c.value)){
        tip="留言内容必须包含中文";
    }
    else if(!authorReg.test(a.value)){
        tip="称呼只能包含中、英、数、-、_";   
    }
    else if(!emailReg.test(e.value)){
        tip="请填写正确的邮箱";   
    }
    if(u.value.length>0){
        var urlReg = '^((https|http|ftp|rtsp|mms)?://)' + '?(([0-9a-z_!~*\'().&=+$%-]+: )?[0-9a-z_!~*\'().&=+$%-]+@)?' //ftp的user@ 
        + '(([0-9]{1,3}.){3}[0-9]{1,3}' // IP形式的URL- 199.194.52.184 
        + '|' // 允许IP和DOMAIN（域名） 
        + '([0-9a-z_!~*\'()-]+.)*' // 域名- www. 
        + '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z].' // 二级域名 
        + '[a-z]{2,6})' // first level domain- .com or .museum 
        + '(:[0-9]{1,4})?' // 端口- :80 
        + '((/?)|' // a slash isn't required if there is no file name 
        + '(/[0-9a-z_!~*\'().;?:@&=+$,%#-]+)+/?)$';
        var urlReg = new RegExp(urlReg);
        if(!urlReg.test(u.value)){
            tip="主页网址格式错误";
        }
    }
}
    if(tip!=null){
                event.preventDefault();
                document.getElementById('submit').value=tip;
                setTimeout(function(){document.getElementById('submit').value=submitText;},1000);
        }
        
    }
}