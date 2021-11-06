<?php
/*

Template Name: 读者排行

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
<article class="fadeInUp animated">
    <?php if(!has_post_thumbnail()){ ?>
                <header>
                    <h1 class="entry-title"><?php single_post_title(); ?></h1>
                </header>
    <?php } ?>
<div class="entry-content">
        <div class="readerswall">
            <p>取近半年的读者在此页面上作为感谢并互访交流</p>
            <ul class="row">
                <?php
                $query = "SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email,comment_ID FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 6 MONTH ) AND user_id='0' AND post_password='' AND comment_approved='1' AND comment_type='comment') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 12";
                $i=1;
                foreach ($wpdb->get_results($query) as $comment) { ?>
                <?php if($i<4){ ?>
                    <li class="col <?php if($i<4){echo 'top'.$i.' sm-12 xs-12 md-4';}else{ echo 'sm-6 xs-6 md-3';} ?>">
                    <div class="content">
                        <div class="reader">
                        <div class="reader-avatar"><?= get_avatar($comment->comment_author_email, 32); ?></div>
                        <div class="reader-info">
                        <div class="reader-name">
                        <a href="javascript:userInfo(<?= $comment->comment_ID ?>,'/api/reader/');">
                           <?= $comment->comment_author ?>
                        </a>
                        <sup title="评论条数"><?php echo $comment->cnt; ?></sup>
                        </div>
                        <?php if($i==1){ 
                            echo '<div class="top'.$i.'-name">[ 金牌读者 ]</div>';
                        }else if($i==2){
                            echo '<div class="top'.$i.'-name">[ 银牌读者 ]</div>';
                        }else if($i==3){
                            echo '<div class="top'.$i.'-name">[ 铜牌读者 ]</div>';
                        }
                        ?>
                        </div>
                        </div>
                    </div>
                    </li>
                    <?php }else{ ?>
                    <li class="col xs-6 sm-6 md-3 default">
                        <div class="content">
                            <div class="reader-avatar"><?= get_avatar($comment->comment_author_email, 32); ?></div>
                            <div class="reader-info">
                            <a href="javascript:userInfo(<?= $comment->comment_ID ?>,'/api/reader/');">
                           <?= $comment->comment_author ?>
                            </a>
                            <sup title="评论条数"><?php echo $comment->cnt; ?></sup>
                        </div>
                        </div>
                        
                    </li>
                <?php 
                    }
                    $i+=1;
                } ?>
            </ul>
        </div>
</div>
</article>
<?php
		if (!isset($_GET["pjax"]) && !post_password_required()) {
            if (comments_open() || get_comments_number()) :
                comments_template();
                wp_comment_pjax();
            endif;
            }
echo '<script type="text/javascript">loadScript("/assets/css/read-wall.min.css","css","read-wall-css","head");loadScript("/assets/css/core.min.css","css","core-css","head");</script>';
get_template_part( 'footer' );
?>