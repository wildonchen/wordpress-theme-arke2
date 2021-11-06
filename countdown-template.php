<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-08-15 12:29:50
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:37:34
 * Template Name: 日期倒计时
 */
get_template_part( 'header' );
?>
<?php

if ( is_page() and has_post_thumbnail()){
    $sub=get_post_meta(get_the_ID(), 'sub', true);
    if(!$sub){
        $sub='添加了特殊图片，记得添加sub自定义字段哦';
    }
	echo '<div class="page-banner" style="background:url(\''.wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)).'?x-oss-process=image/resize,m_fill,h_120,w_662/format,webp\') center;background-size: cover;"><h1>'.get_the_title().'</h1><div class="page-banner-desc"><p class="entry-info">'.$sub.'</p></div></div>';
}

?>
<div class="fadeInUp animated">
    <?php if(!has_post_thumbnail()){ ?>
                <header>
                    <h1 class="entry-title"><?php single_post_title(); ?></h1>
                </header>
    <?php } ?>

                    <h3>节日倒计时</h3>
                    <p id="date"></p>
                    <h4>公历节日</h4>
                    <p id="gl"></p>
                    <h4>农历节日</h4>
                    <p id="nl"></p>

            <!--div id="calen"></div-->
  
        <h3>时间倒计时</h3>
        <p id="hours"></p>
        <div class="jdt-box"> <div class="jdt" id="hours-jdt"></div></div>
        <p id="weeks"></p>
        <div class="jdt-box"> <div class="jdt" id="weeks-jdt"></div></div>
        <p id="day"></p>
        <div class="jdt-box"> <div class="jdt" id="day-jdt"></div></div>
        <p id="month"></p>
        <div class="jdt-box"> <div class="jdt" id="month-jdt"></div></div>
        <h3>重要的日子</h3>
        <table>
            <tr><td>他的生日：农历九月二十九 (<span id="he-day"></span>)</td><td>情人节：2月14日 (<span id="qrj-day"></span>)</td></tr>
            <tr><td>她的生日：1月1日  (<span id="she-day"></span>)</td><td>七夕节：农历七月初七 (<span id="cn-qrj-day"></span>)</td></tr>
            <tr><td>恋爱纪念日：农历七月初七 (<span id="love-day"></span>)</td><td>网络情人节：5月20日 (<span id="wl-qrj-day"></span>)</td></tr>
        </table>
        

</div>


</div>    
<?php
		if (!isset($_GET["pjax"]) && !post_password_required()) {
            if (comments_open() || get_comments_number()) :
                comments_template();
                wp_comment_pjax();
            endif;
            }
echo '<script type="text/javascript">

loadScript("/assets/css/countdown.min.css","css","countdown-css","head");
try{
    daoJiShi();
}
catch(err){
    loadScript("/assets/js/countdown/toLunar.min.js","js","toLunar-js","body");
        document.getElementById("toLunar-js").onload=function(){
            loadScript("/assets/js/countdown/countdown.min.js","js","countdown-js","body");
            document.getElementById("countdown-js").onload=function(){
                daoJiShi();
            }
            
        }
}
</script>';
get_template_part( 'footer' );
?>