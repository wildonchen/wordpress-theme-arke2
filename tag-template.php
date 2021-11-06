<?php
/*

Template Name: 标签列表

*/
get_template_part( 'header' );
?>
<style type="text/css">
.entry-content{position: inherit !important;min-height:160px;}
#tagsList{position:relative; margin-top:220px;}
#tagsList a{position:absolute;top:0px;left:0px;padding:3px 6px;color:#000;}
#tagsList a:hover{border:1px solid #eaeaea;background:#fff;border-radius:5px;}
</style>
<div class="fadeIn animated entry-content">
        <div id="tagsList">
        <?php wp_tag_cloud(); ?>
        </div>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (comments_open() || get_comments_number()) :
        comments_template();
        wp_comment_pjax();
    endif;
    }

?>
</div></div>

<script type="text/javascript">
try{
    tags();
}
catch(err){
    loadScript("/assets/js/taglist.min.js","js","taglist-js","body");
    document.getElementById("taglist-js").onload=function(){
        tags();
    }
}
</script>
<?php get_template_part( 'footer' );?>
