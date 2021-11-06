<?php
/*
* @Author: Danny Cooper
* @Date: 2021-04-02 20:49:43
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 12:09:35
* @copyright Copyright (c) 2018, Danny Cooper
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/
?>
<?php
//全局头部
get_template_part('header');
// 根据不同类型的页面，添加不同的class
if (is_single()) {
	$type = 'single';
} else if (is_page()) {
	$type = 'page';
} else if (is_tag()) {
	$type = 'list';
} else if (is_category()) {
	$type = 'list';
} else {
	$type = 'list';
}
//home
if (is_home()) {
	//首页列表第一页显示大banner
	if (strpos($_SERVER['REQUEST_URI'], '/page/') === false) {
		$bg = '/api/bing/' . date('Y-m-d', time()) . '.jpg';
		$posts2 = $posts;
		$args = array(
			'posts_per_page' => 1,
			'cat' => [19, 6],
			'order' => 'desc',
		);
		$posts = get_posts($args);
		foreach ($posts as $post) { ?>
			<?php if (has_post_thumbnail()) {
				$bg = wp_get_attachment_url(get_post_thumbnail_id(@$post->ID));
			} ?>
			<div class="home-banner fadeIn animated" id="banner" style="background:url('<?php echo $bg; ?>') center;background-size: cover;">
				<div class="home-banner-date"><?php echo get_the_date('Mj，') . get_the_category()[0]->cat_name; ?></div>
				<div class="home-banner-say">
					<div class="home-banner-text"><?php echo strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_excerpt ?: $post->post_content))); ?></div>
					<div class="home-banner-more"><?php echo '<a href="' . get_category_link(get_the_category()[0]->cat_ID) . '">查看更多</a>'; ?></div>
				</div>
			</div>
		<?php
		}
		$posts = $posts2;
	}
	//首页列表非第二页显示小banner
	else {
		?>
		<div class="new-banner" style="background:url('<?php echo blog_theme_url('/assets/img/banner/new.jpg'); ?>') center;background-size: cover;">
			<h1>📃 最新文章</h1>
		</div>
		<div class="banner-end"></div>
	<?php
	}
	function get_the_template()
	{
		get_template_part('content');
	}
}
//page
else if (is_page()) {
	function get_the_template()
	{
		get_template_part('content');
	}
}

//post
else if (is_single()) {
	function get_the_template()
	{
		get_template_part('content');
	}
}

//cat
else if (is_category()) {
	$slug = get_the_category()[0]->slug;
	//分类描述
	$description = get_the_category()[0]->description;
	if ($description == '') {
		$description = '博主很懒，没有写分类描述';
	}
	//拥有多个分类时，特殊处理
	$catNum = count(get_the_category());
	if ($catNum > 1) {
		$url = $_SERVER["REQUEST_URI"];
		foreach ((get_the_category()) as $category) {
			$slugName = $category->slug;
			if (strpos($url, $slugName) !== false) {
				$slug = $slugName;
			}
		}
	}
	//分类banner
	echo '<div class="cat-banner" style="background:url(\'' . blog_theme_url('/assets/img/banner/' . $slug . '.jpg') . '\') center;background-size: cover;"><h1>📚 ' . single_cat_title('', false) . '</h1><div class="cat-banner-desc">“ ' . $description . '”</div></div>';
	echo '<div class="content-area ' . $type . '">';
	echo pagenavi('previous');
	switch ($slug) {
			//足迹模板
		case "zj":
			get_template_part('map-cat');
			break;
			//书单模板
		case "sd":
			get_template_part('book-cat');
			break;
			//孤独说模板
		case "gs":
			get_template_part('alone-say-cat');
			break;
			//动态模板
		case "dt":
			get_template_part('say-cat');
			break;
			//听歌模板
		case "tg":
			get_template_part('music-cat');
			break;
			//纪念册模板
		case "jn":
			get_template_part('remember-cat');
			break;
			//相册模板
		case "xc":
			get_template_part('album-cat');
			break;
			//默认模板
		default:
			function get_the_template()
			{
				get_template_part('content');
			}
	}
	echo pagenavi('next');
	echo '</div>';
}

//tag
else if (is_tag()) {
	$name = single_tag_title('', false);
	echo '<div class="tag-banner" style="background:url(\'' . blog_theme_url('/assets/img/banner/tag.jpg') . '\') center;background-size: cover;"><h1>🔖 ' . $name . '</h1></div>';
	if (strpos($name, '月说') !== false) {
		echo '<div class="content-area ' . $type . '">';
		get_template_part('say-cat');
		echo '</div>';
	} else {
		function get_the_template()
		{
			get_template_part('content');
		}
	}
}

//date
else if (is_date()) {
	if (is_year()) {
		$name = get_the_date('Y年');
	} else if (is_month()) {
		$name = get_the_date('Y年n月');
	} else {
		$name = get_the_date('Y年n月j日');
	}
	echo '<div class="tag-banner" style="background:url(\'' . blog_theme_url('/assets/img/banner/date.jpg') . '\') center;background-size: cover;"><h1>🔖 ' . $name . '</h1></div>';
	function get_the_template()
	{
		get_template_part('content');
	}
}

//search
else if (is_search()) {
	?>
	<div class="new-banner" style="background:url('<?php echo blog_theme_url('/assets/img/banner/search.jpg'); ?>') center;background-size: cover;">
		<h1>🔍 搜索一下</h1>
	</div>
	<div class="banner-end"></div>
	<?php
	$allsearch = new WP_Query("s=$s&showposts=-1");
	$key = wp_specialchars($s, 1);
	$count = $allsearch->post_count;
	//如果有搜索关键字
	if ($count > 0) {
		if (strlen(preg_replace('/\s+/u', '', $key)) == 0) {
			$key2 = '所有';
		} else {
			$key2 = $key;
		}
	?>
		<div class="search-box">
			<form role="search" method="get" class="search-form" action="<?php echo blog_url('/'); ?>/">
				<label>
					<input type="search" class="search-field" placeholder="搜索…" value="<?php echo $key; ?>" name="s">
					<input type="submit" class="search-submit" value="搜索">
					<span class="screen-reader-text"><?php echo '搜索 <u>' . $key2 . '</u> 共有 ' . $count . '</em> 条记录'; ?></span>
				</label>
			</form>
		</div>
<?php
		echo '<script  type="text/javascript">';
		echo 'try{searchKey()}
			catch(err){loadScript("' . blog_theme_url('/assets/js/search.min.js') . '","js","search-js","body");
    		document.getElementById("search-js").onload=function(){searchKey("' . $key . '")}}';
		echo '</script>';
	}
	function get_the_template()
	{
		get_template_part('content');
	}
}

//默认内容模板
if (function_exists('get_the_template')) {
	echo '<div class="content-area ' . $type . '">';
	if (!is_single() and !is_page()) {
		echo pagenavi('previous');
	}
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			get_the_template();
			if (!isset($_GET["pjax"]) && !post_password_required()) {
				if (comments_open() || get_comments_number()) :
					comments_template();
					wp_comment_pjax();
				endif;
			}
		endwhile;
	else :
		get_template_part('content', 'none');
	endif;
	//分页异步加载
	if (!is_single() and !is_page()) {
		echo pagenavi('next');
	}
	echo '</div><div class="clear"></div>';
}
//全局底部
get_template_part('footer');
