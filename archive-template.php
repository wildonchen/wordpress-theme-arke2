<?php
/**
 * Template Name: Archive Template
 *
 * @package    Arke
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
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
    <?php if(!has_post_thumbnail()){ ?>
			<header>
					<h2 class="entry-title"><?php single_post_title(); ?></h2>
				</header>
    <?php } ?>
				
<form role="search" method="get" class="search-form" action="<?php echo blog_url('/'); ?>">
				<label>
					<span class="screen-reader-text">搜索：</span>
					<input type="search" class="search-field" placeholder="搜索…" value=""  name="s">
				</label>
				<input type="submit" class="search-submit" value="搜索">
			</form>
				<?php

				$args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
				);

				$arke_posts = new WP_Query( $args );

				if ( $arke_posts->have_posts() ) :

					echo '<ul class="archives__list fadeIn animated">';

					while ( $arke_posts->have_posts() ) :
						$arke_posts->the_post();

						echo '<li><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a><span>' . esc_attr( get_the_time( 'Y/m/d' ) ) . '</span></li><hr>';

					endwhile;

					echo '</ul>';

					wp_reset_postdata();

				else :
						echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'arke' ) . '</p>';
				endif;
				?>

<?php
$key = wp_specialchars($s, 1);
echo '<script  type="text/javascript">
loadScript("/assets/css/archive.min.css","css","archive-css","head");
try{searchKey()}
catch(err){loadScript("/assets/js/search.min.js","js","search-js","body");
document.getElementById("search-js").onload=function(){searchKey("'.$key.'")}}';
echo '</script>'; 
get_template_part( 'footer' );
?>
