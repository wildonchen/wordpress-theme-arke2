<?php 
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-05-30 15:33:58 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:39:12
 */
?>
<?php 
$type=get_post_meta(get_the_ID(), 'type', true);
if($type){
    if($type=='song'){
        $type='<div class="music-list-info"><span class="music-list-type">单曲</span></div>';
    }
    else if($type=='list'){
        $type='<div class="music-list-info"><span class="music-list-type">歌单</span></div>';
    }
    else{
        $type='';
    }
}
else{
    $type='';
}

?>
<div class="entry-content fadeIn animated">
    <div class="music-list">
        <ul class="row">
            <?php
                if (have_posts()) :
	                while (have_posts()) :
		                the_post();
            ?>
             <li class="col sm-4 xs-6 md-3">
                <div class="music-list-con">
                    <img <?php echo $url; ?>data-src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(@$post->ID));?>?x-oss-process=image/resize,m_fill,w_256,h_256/format,webp" class="lazyload" onclick="imgLightbox.open(this)">
                    <?php echo $type; ?>
                    <div class="music-list-title">
                        <?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
                    </div>
                </div>
            </li>
            <?php
	                endwhile;
                else :
	                get_template_part('content', 'none');
                endif;
            ?>
        </ul>
    </div>

    <?php 
if (!is_single() and !is_page()) {
	if (pagenavi()!=''){
		echo '<button type="button" class="more-page" id="nextPage" onclick="nextPage(\''.pagenavi().'\')">加载更多</button>';
	}
	else{
		echo '<button type="button" class="more-page disabled" id="nextPage" disabled>没有更多了</button>';
	}
}
    ?>
</div>
<script type="text/javascript">
loadScript("/assets/css/core.min.css","css","core-css","head");
loadScript("/assets/css/music.min.css","css","music-css","head");
</script>