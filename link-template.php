<?php
/*

Template Name: 友情链接

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
function getLink($site,$desc,$img,$url){
    $con='<li class="link-item col sm-12 xs-12 md-4"><div class="link-con"><div class="link-logo"><img src="'.$img.'" width="48" height="48"></div><div class="link-info"><div class="blog-name"><a href="'.$url.'" target="_blank" rel="noopener"><h2>'.$site.'</h2></a></div><div class="blog-desc"><p>'.$desc.'</p></div></div></div></li>';
    return $con;
}
$linkAry=array();
$linkAry[0]=getLink('牧羊人','The Lonely Shepherd',blog_theme_url('/assets/img/link/www.shephe.com.png?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//www.shephe.com');
$linkAry[1]=getLink('狡猫三窝','狡猾的小猫咪',blog_theme_url('/assets/img/link/slykiten.com.jpeg?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//slykiten.com');
$linkAry[2]=getLink('北枫','记录一个人的生活点滴',blog_theme_url('/assets/img/link/beifeng.me.jpg?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//beifeng.me');
$linkAry[3]=getLink('森木志','等风来，希望雨别下',blog_theme_url('/assets/img/link/imxxz.cn.png?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//imxxz.cn');
$linkAry[4]=getLink('大雄','时间是个残忍的坏蛋',blog_theme_url('/assets/img/link/199508.com.jpg?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//199508.com');
$linkAry[5]=getLink('猫鱼的小窝','记录猫鱼生活的琐碎',blog_theme_url('/assets/img/link/2cat.net.jpg?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//2cat.net');
$linkAry[6]=getLink('彼岸临窗','用文字记录生活',blog_theme_url('/assets/img/link/blog.luziyang.cn.png?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//blog.luziyang.cn');
$linkAry[7]=getLink('邹江博客','邹江个人博客',blog_theme_url('/assets/img/link/zoujiang.com.jpg?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//www.zoujiang.com');
$linkAry[8]=getLink('多吉冲浪','在网上没人知道这是只Doge',blog_theme_url('/assets/img/link/www.netdoge.com.png?x-oss-process=image/resize,m_fill,h_48,w_48/format,webp'),'//www.netdoge.com');
?>


<article class="fadeInUp animated">
    <?php if(!has_post_thumbnail()){ ?>
                <header>
                    <h1 class="entry-title"><?php single_post_title(); ?></h1>
                </header>
    <?php } ?>

<div class="entry-content">
<div class="link-box">
<ul class="row" id="link-list">

<?php
shuffle($linkAry);
foreach ($linkAry as $linkList) {
    echo $linkList;
}
?>

</ul>
</div>
 
<?php the_content(); ?>
</div>


</article>

<?php

if (!isset($_GET["pjax"]) && !post_password_required()) {
    if (comments_open() || get_comments_number()) :
        comments_template();
        wp_comment_pjax();
    endif;
    }

?>
<script type="text/javascript">
<?php
echo 'loadScript("/assets/css/link.min.css","css","link-css","head");loadScript("/assets/css/core.min.css","css","core-css","head");';
?>

</script>
<?php get_template_part( 'footer' );?>
