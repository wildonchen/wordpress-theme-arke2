<?php 
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-05-30 15:33:58 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:37:52
 */
?>
<div class="entry-content fadeIn animated">
    <div class="book-list">
        <ul class="row">
            <?php
                if (have_posts()) :
	                while (have_posts()) :
		                the_post();
            ?>
             <li class="col sm-6 xs-6 md-3">
                <div class="book-list-con">
                    <img <?php echo $url; ?>data-src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(@$post->ID));?>?x-oss-process=image/resize,m_fill,w_613/format,webp" class="lazyload" onclick="imgLightbox.open(this)">
                    <div class="book-list-info">
                        <?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
                        <span>
                            <?php
                                $author=get_post_meta(get_the_ID(), 'author', true);
                                if($author){
                                    echo $author;
                                }
                                else{
                                    echo '博主忘了加作者了';
                                }
                            ?>
                        </span>
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

</div>
<script type="text/javascript">
loadScript("/assets/css/core.min.css","css","core-css","head");
</script>