<?php
/*
* @Author: Danny Cooper
* @Date: 2021-04-02 20:49:43
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:37:41
* @copyright Copyright (c) 2018, Danny Cooper
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/
?>
<?php
if (is_single()) {
	$post_id = get_the_ID();
	if (isset($_COOKIE['views' . $post_id . COOKIEHASH]) && $_COOKIE['views' . $post_id . COOKIEHASH] == '1') {
	} else {
		setPostViews($post_id);
		@setcookie('views' . $post_id . COOKIEHASH, '1', time() + 36000, COOKIEPATH, COOKIE_DOMAIN); //设置时间间隔
	}
	// 字数
	$word = get_post_meta($post_id, 'post_words_number', true);
	if (!$word) {
		$word = mb_strlen(preg_replace('/\s/', '', html_entity_decode(strip_tags($post->post_content))));
		delete_post_meta($post_id, 'post_words_number');
		add_post_meta($post_id, 'post_words_number', $word, 'UTF-8');
	}
	$word = '<span><i class="icon-font"></i> ' . $word . ' 字</span>';
	// 时间
	$time = '<span><i class="icon-clock"></i> <a href="' . get_month_link(get_the_date('Y'), get_the_date('m')) . '" title="' . get_the_date('Y/m/d') . '"><time datetime="' . get_the_date('Y/m/d H:i:s') . '"></time></a></span>';
	// 更新时间，默认NULL，存在更新时间重新赋值
	//$update=(get_the_date('Y/m/d') != get_the_modified_time('Y/m/d')) ? '<i class="icon-edit"></i> <a href="'.get_month_link(get_the_modified_time('Y'),get_the_modified_time('m')).'" title="'.get_the_modified_time('Y/m/d').'"><time datetime="'.get_the_modified_time('Y/m/d H:i:s').'"></a>，' : null ;
	$update = '';
	// 分类
	$cat = '';
	foreach ((get_the_category()) as $category) {
		$cat .= '<span><a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a></span>';
	}
	$catIcon = count(get_the_category()) > 1 ? '<i class="icon-tags"></i> ' : '<i class="icon-tag"></i> ';
	$cat = '<span class="entry-cat">' . $catIcon . $cat . '</span>';
	// 热度
	$view = '<span><i class="icon-fire"></i> ' . getPostViews(get_the_ID()) . '℃</span>';
	$postInfo = '<div class="entry-info">' . $word . $time . $update . $cat . $tag . $view . '</div>';
}
?>
<?php

//普通文章或通用页面
//如果有特色图片

//banner逻辑：如果文章有特色图片，则在banner显示特色图片，显示文章标题和文章信息。如果没有，则正常显示标题和文章信息
if (is_single() and has_post_thumbnail()) {
	echo '<div class="post-banner" style="background:url(\'' . wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)) . '?x-oss-process=image/resize,m_fill,h_120,w_662/format,webp\') center;background-size: cover;"><h1>' . get_the_title() . '</h1><div class="post-banner-desc">' . $postInfo . '</div></div>';
} else if (is_page() and has_post_thumbnail()) {
	echo '<div class="page-banner" style="background:url(\'' . wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)) . '?x-oss-process=image/resize,m_fill,h_120,w_662/format,webp\') center;background-size: cover;"><h1>' . get_the_title() . '</h1><div class="page-banner-desc"></div></div>';
}


?>
<article class="fadeInUp animated">
	<?php
	if (!is_single() or !has_post_thumbnail()) {
	?>
		<header class="entry-header">
			<?php
			// 判断文章是否置顶
			$sticky = is_sticky() ? '<div class="post-title-tag"><i class="icon-anchor"></i></div>' : null;
			// 判断文章是否密码保护
			if ($post->post_password) {
				if (post_password_required()) {
					$password = '<div class="post-title-tag"><i class="icon-lock"></i></div>';
				} else {
					$password = '<div class="post-title-tag"><i class="icon-lock-open"></i></div>';
				}
			}
			// 区分页面给文章标题加上超链接
			if (is_single() or is_page()) :
				the_title('<h1 class="entry-title">' . $sticky . $password, '</h1>');
			else :
				the_title('<h1 class="entry-title">' . $sticky . $password . '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1><div class="entry-time"><i class="icon-clock"></i> ' . get_the_date('Y/m/d') . '</div>');
			endif;
			?>

		</header>
		<div class="clear"></div>

		<?php
		// 在文章页显示文章信息
		if (is_single() and !has_post_thumbnail()) :
			echo $postInfo;
		endif;
	}

	//文章内容是否被密码保护
	if (post_password_required()) {
		echo '<div class="entry-content">';
		if (is_single() or is_single()) {
			the_content(esc_html__('Continue reading &rarr;', 'arke'));
			echo '<div class="post-password-naughty"></div>';
		} else {
			echo '此内容受密码保护。如需查阅，请到内容页面输入密码查看。';
		}
		echo '</div>';
	} else {

		//处理书单
		if (is_single() && get_the_category()[0]->slug == 'sd') {
			echo '<div class="isbn-desc"><div class="isbn-info" id="isbn-info">';
			$isbn = get_post_meta(get_the_ID(), 'isbn', true);
			$douban = get_post_meta(get_the_ID(), 'douban', true);
			if ($isbn) {
				echo '<pre class="pre">' . $isbn . '</pre>';
			} else {
				echo '该书单缺少ISBN信息，或博主忘了设置';
			}
			if ($douban) {
				echo '<div><a id="douban" data-id="' . $douban . '" href="//book.douban.com/subject/' . $douban . '/" target="_blank" rel="noreferrer">去豆瓣查看本书更多信息 >></a></div>';
			}
			echo '</div><div class="isbn-img" id="isbn-img">';
			if (has_post_thumbnail()) {
				$url = 'src="' . blog_theme_url('/assets/img/loading.gif') . '" ';
				if (isCrawler()) {
					$url = 'src="' . catch_that_image() . '" ';
				}
		?>
				<img <?php echo $url; ?>data-src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)); ?>?x-oss-process=image/resize,m_fill,w_613/format,webp" width="100%" height="100%" class="lazyload" onclick="imgLightbox.open(this)">
		<?php
			} else {
				echo '你敢信？一个书单没有图片？赶紧添加特色图片作为书单图片';
			}
			echo '</div></div>';
			$content = get_post_meta(get_the_ID(), 'content', true);
			$catalog = get_post_meta(get_the_ID(), 'catalog', true);
			if ($content or $catalog) {
				echo '<div class="book-content-dis" onclick="display.block(\'book-content\')">查看书单简介和目录</div><div id="book-content"><div class="book-content">';
				if ($content) {
					echo '<div class="book-content-title">内容简介</div><pre class="book-content-text pre">' . $content . '</pre>';
				}
				if ($catalog) {
					echo '<div class="book-content-title">书单目录</div><pre class="book-content-text pre">' . $catalog . '</pre>';
				}
				echo '</div><div class="book-content-no"><a><span onclick="javascript:display.block(\'book-content\')">折叠显示内容的 ∧</span></a></div></div>';
			}
		}
		?>
		<?php
		if (is_single() or is_page()) {
			$excerpt = $post->post_excerpt;
			if ($excerpt) {
				echo '<div class="entry-excerpt"><div class="entry-excerpt-con">' . $excerpt . '</div><div class="entry-excerpt-desc">摘要</div></div>';
			}
		}
		?>
		<div class="entry-content">
			<?php
			// 内容按页面区分显示
			if (is_single() or is_page()) {
				the_content(esc_html__('Continue reading &rarr;', 'arke'));
				//分页显示
				if (get_post_meta(get_the_ID(), 'page', true)) {
					$post_data = get_post($post->ID, ARRAY_A)['post_name'];
					echo '<div class="post-page">';
					$arr = explode(",", get_post_meta(get_the_ID(), 'page', true));
					$num = 1;
					$page_num = substr(strrchr($_SERVER["REQUEST_URI"], "/"), 1);
					foreach ($arr as $value) {
						$status = null;
						if (preg_match("/^[1-9][0-9]*$/", $page_num)) {
							if ($page_num == $num) {
								$status = ' class="active"';
							}
						} else if ($num == 1) {
							$status = ' class="active"';
						}
						echo '<span>第' . $num . '页：<a' . $status . ' href="/' . $post_data . '/' . $num . '">' . $value . '</a></span>';
						$num += 1;
					}
					echo '</div>';
				} else if (substr_count($post->post_content, '/wp:nextpage') + 1 > 1) {
					$page = substr_count($post->post_content, '/wp:nextpage') + 1;
					$post_data = get_post($post->ID, ARRAY_A)['post_name'];
					echo '<div class="post-page">分页：';
					$arr = explode(",", get_post_meta(get_the_ID(), 'page', true));
					$num = 1;
					$page_num = substr(strrchr($_SERVER["REQUEST_URI"], "/"), 1);
					while ($num <= $page) {
						$status = null;
						if (preg_match("/^[1-9][0-9]*$/", $page_num)) {
							if ($page_num == $num) {
								$status = ' class="active"';
							}
						} else if ($num == 1) {
							$status = ' class="active"';
						}
						echo '<a' . $status . ' href="/' . $post_data . '/' . $num . '">第' . $num . '页</a>';
						$num += 1;
					}
					echo '</div>';
				}
			} else {
				// 列表页有特色图片显示
				if (has_post_thumbnail()) {
			?>
					<div class="entry-content-haveimg">
						<div class="more l4">
							<?php echo '<a href="' . get_category_link(get_the_category()[0]->cat_ID) . '">@' . get_the_category()[0]->cat_name . '</a>' . mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 340, ' ...'); ?>
						</div>
					</div>
					<div class="entry-content-img">
						<?php
						$url = 'src="' . blog_theme_url('/assets/img/loading.gif') . '" ';
						if (isCrawler()) {
							$url = 'src="' . wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)) . '" ';
						}
						?>
						<img <?php echo $url; ?>data-src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)); ?>?x-oss-process=image/resize,m_fill,h_89,w_89/format,webp" width="89" height="89" class="lazyload" onclick="imgLightbox.open(this)">
					</div>
				<?php
				} else if (catch_that_image()) {
				?>
					<div class="entry-content-haveimg">
						<div class="more l4">
							<?php echo '<a href="' . get_category_link(get_the_category()[0]->cat_ID) . '">@' . get_the_category()[0]->cat_name . '</a>' . mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 340, ' ...'); ?>
						</div>
					</div>
					<div class="entry-content-img">
						<?php
						$url = 'src="' . blog_theme_url('/assets/img/loading.gif') . '" ';
						if (isCrawler()) {
							$url = 'src="' . catch_that_image() . '" ';
						}
						?>
						<img <?php echo $url; ?>data-src="<?php echo catch_that_image(); ?>?x-oss-process=image/resize,m_fill,h_89,w_89/format,webp" width="89" height="89" class="lazyload" onclick="imgLightbox.open(this)">
					</div>
				<?php
				} else {
				?>
					<?php echo '<div class="more l3"><a href="' . get_category_link(get_the_category()[0]->cat_ID) . '">@' . get_the_category()[0]->cat_name . '</a>' . mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 340, ' ...') . '</div>'; ?>
			<?php }
			} ?>
		</div>
		<?php
		if (is_single()) {
			echo get_the_tag_list() ? '<div class="entry-tag">' . get_the_tag_list('<span>', '</span><span>', '</span>') . '</div>' : null;
			$city = get_post_meta(get_the_ID(), 'city', true);
			echo $city ? '<div class="entry-location"><i class="icon-location"></i> <a class="a-hover-underline" href="' . blog_url('/zj#location=' . $city) . '">' . $city . '</a></div>' : NULL;
		}
		?>
	<?php } ?>
</article>