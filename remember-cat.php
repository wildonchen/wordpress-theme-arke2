<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-10-14 21:01:11 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:39:20
 */
?>
<div class="remember-list">
    <?php
    echo pagenavi('previous');
    $num = 0;
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            if (has_post_thumbnail()) {
                $src = wp_get_attachment_url(get_post_thumbnail_id(@$post->ID));
            } else if (catch_that_image()) {
                $src = catch_that_image();
            } else {
                $src = blog_theme_url('/assets/img/default-img.png');
            }
            $loading = isCrawler() ? $src : blog_theme_url('/assets/img/loading.gif');
            $img = '<img src="' . $loading . '" data-src="' . $src . '?x-oss-process=image/resize,m_fill,h_250,w_500/format,webp" class="lazyload" onclick="imgLightbox.open(this)">';
    ?>

            <div class="remember-list-card fadeIn animated">
                <div class="remember-list-box">
                    <?php echo the_title('<h2 class="remember-list-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                    <div class="remember-list-img">
                        <?php echo $img; ?>
                    </div>
                    <div class="remember-list-con">
                        <span class="remember-list-time"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><i class="icon-clock"></i><?php echo get_the_date('Y/m/d'); ?></a></span>
                        <?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->excerpt ? $post->excerpt : $post->post_content))), 0, 120, ' ...'); ?>
                        </h2>
                    </div>

                </div>
            </div>
<?php $num += 1; ?>
<?php
        endwhile;
    else :
        get_template_part('content', 'none');
    endif;
    echo pagenavi('next');
?>

</div>
<script type="text/javascript">
    loadScript("/assets/css/remember.min.css", "css", "remember-css", "head");

    function removeBorderBootom(num=1) {
        if(num>1){
        document.getElementsByClassName("remember-list-con")[Math.ceil(num/2) - 1].className += ' remember-list-con-none-border';
        }
    }
    removeBorderBootom(<?php echo $num; ?>);
</script>