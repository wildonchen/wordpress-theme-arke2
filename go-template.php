<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-04-03 15:46:53 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-06-02 21:26:43
 * Template Name: 外链跳转
 */
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <link href="<?php echo blog_theme_url('/assets/img/favicon.png'); ?>" rel="shortcut icon" type="image/x-icon" />
        <meta name="robots" content="none" />
        <title>站外链接</title>
        <style>
            body{font-family:"Microsoft Yahei";margin:0;font-weight:lighter;text-align:center;line-height:2.2em;}
            html,body{height:100%;}
            h1{font-size:40px;line-height:2em;font-weight:nomarl}
            h3{font-weight:nomarl}
            table{width:100%;height:100%;border:0;}
            a{text-decoration:none}
        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <h1>跳转</h1>
                    <h3>请手动点击确定访问</h3>
                    <p>正在访问站外网址 <span id="url"></span> ~<br/><a id="gourl" href="">立即前往</a></p>
                </td>
            </tr>
        </table>
    </body>
    <script type="text/javascript">
        var href=window.location.href;
        var url=href.substring(href.indexOf("#"),href.length).substr(1).toLowerCase();
        var gourl;
        if (href.indexOf("#") != -1 && url.length > 5 && url.indexOf(".") !=-1){
            if (url.indexOf("http://") !=-1 || url.indexOf("https://")){
                gourl='//'+url
            }
            if(gourl.substr(gourl.length-1,1)!='/'){
                var f='/';
            }
            else{
                var f='';
                url=url.slice(0,url.length-1);
            }
            gourl=gourl+f+'?from='+window.location.host
        }else{
            gourl=url='//'+window.location.host;
        }
        document.getElementById('url').innerHTML=url;
        document.getElementById('gourl').href=gourl;
    </script>
</html>