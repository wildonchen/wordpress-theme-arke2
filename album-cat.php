<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-10-16 09:30:18 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:37:55
 */
?>
<div class="album-list">
    <?php
    echo pagenavi('previous');
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            echo '<div class="album-box">';
            if (@$once != get_the_date('Y-m')) {
                echo '<div class="album-list-time"><a class="a-hover-underline" href="' . get_month_link(get_the_date('Y'), get_the_date('m')) . '">' . get_the_date('Y年m月') . '</a></div>';
                $once = get_the_date('Y-m');
            }
            the_title('<h2 class="album-list-title album-' . get_the_ID() . '">', '</h2>');
            $post_con = get_the_content();
            if (strpos($post_con, 'wp:gallery') !== false) {
                preg_match_all('/<figure class="wp-block-gallery.*>.*<\/ul><\/figure>/iU', wp_unslash($post_con), $matches);
                $matches[0] = preg_replace('/<img.*?src="(.*?)".*?class="(.*?)".*?>/is', '<img class="$2 lazyload" src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="$1?x-oss-process=image/resize,w_300,m_mfit/format,webp" onclick="albumLightbox.open(this)" data-id="album-' . get_the_ID() . '">', $matches[0]);
                foreach ($matches[0] as $img) {
                    echo $img;
                }
            } else if (strpos($post_con, 'img') !== false) {

                preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post_con), $matches);
                $columns = count($matches[0]);
                if (count($matches[0]) >= 3) {
                    $columns = 3;
                }
                $matches[0] = preg_replace('/<img.*?src="(.*?)".*?class="(.*?)".*?>/is', '<img class="$2 lazyload" src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="$1?x-oss-process=image/resize,w_720,m_mfit/format,webp" onclick="albumLightbox.open(this)" data-id="album-' . get_the_ID() . '">', $matches[0]);
                echo '<figure class="wp-block-gallery columns-' . $columns . '"><ul class="blocks-gallery-grid">';
                foreach ($matches[0] as $img) {
                    echo '<li class="blocks-gallery-item"><figure>' . $img . '</figure></li>';
                }
                echo '</ul></figure>';
            } else {
                $img = '<img class="lazyload" src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="' . blog_theme_url('/assets/img/default-img.png') . '?x-oss-process=image/resize,w_720,m_mfit/format,webp" onclick="albumLightbox.open(this)" data-id="album-' . get_the_ID() . '">';
                echo '<figure class="wp-block-gallery columns-1"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure>' . $img . '</figure></li></ul></figure>';
            }
            echo '<div class="album-list-con album-' . get_the_ID() . '"><span class="album-title"><a href="' . esc_url(get_permalink()) . '" rel="noreferrer" target="_blank">@' . get_the_title() . '</a></span> ' . mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post_con))), 0, 340, ' ...') . '</div>';
            echo '</div>';
        endwhile;
    else :
        get_template_part('content', 'none');
    endif;

    echo pagenavi('next');
    ?>

</div>
<script type="text/javascript">
    loadScript("/assets/css/album.min.css", "css", "album-css", "head");
    loadScript("/assets/css/library.min.css", "css", "library-css", "head");
    loadScript("/assets/js/album-lightbox.min.js", "js", "album-lightbox-js", "body");
</script>