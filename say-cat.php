<?php 
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-06-27 17:00:13
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:39:24
 */
?>

    <div class="my-say-box">
        <ul>
            <?php
                if (have_posts()) :
	                while (have_posts()) :
		                the_post();
            ?>
         <div class="my-say fadeInUp animated">
	<div class="my-say-author">
		<div class="my-say-author-img"><?php echo get_avatar( get_the_author_email(), '23' );?></div>
		<div class="my-say-info">
			@<?php echo get_the_author() ?> · <?php echo get_the_date('Y/m/d') ?>
		<div class="my-say-title"><?php echo (get_the_tag_list()) ? 'Tag：'.get_the_tag_list('','、','') : '博主很懒，没有设置标签'; ?></div>
		</div>

	
	</div>
	<div class="entry-content">
	<?php echo apply_filters('the_content', $post->post_excerpt ?: $post->post_content); ?>
		<?php if(has_post_thumbnail()){ 
			$url='src="'.blog_theme_url('/assets/img/loading.gif').'" ';
			if(isCrawler()){
				$url='src="'.wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)).'" ';
			}?>
		<div class="list-img"><img <?php echo $url; ?>data-src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(@$post->ID));?>?x-oss-process=image/resize,m_fill,w_613/format,webp" class="lazyload" onclick="imgLightbox.open(this)"></div>
		<?php } ?>
	</div>
	
</div>   
            <?php
	                endwhile;
                else :
	                get_template_part('content', 'none');
                endif;
            ?>
        </ul>
    </div>
<?php
echo '<script  type="text/javascript">
loadScript("/assets/css/say.min.css","css","say-css","head");';
echo '</script>'; 