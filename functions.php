<?php
/*
 * @Author: Danny Cooper
 * @Date: 2021-04-02 20:49:43
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:54:37
 * @copyright Copyright (c) 2018, Danny Cooper
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

?>
<?php
/*-----------------------------------------------------------------------------------*/
/* 全局变量
/*-----------------------------------------------------------------------------------*/
function blog_url($url = '')
{
    return '//' . $_SERVER['SERVER_NAME'] . $url;
}
function blog_theme_url($url = '')
{
    return blog_url('/wp-content/themes/arke' . $url);
    //return 'https://chenqiwei.net/assets/gudu/r7'.$url;
}
function blog_title()
{
    return '孤独日记';
}
function blog_title_sub()
{
    return '孤独作声，流响十年';
}
function cat_id($name)
{
    if ($name = 'gs') {
        return 19;
    } elseif ($name = 'dt') {
        return 6;
    } elseif ($name = 'zj') {
        return 19;
    } elseif ($name = 'sd') {
        return 19;
    } elseif ($name = 'tg') {
        return 19;
    } else {
        $which_cat = get_category_by_slug($name);
        return $which_cat->term_id;
    }
}
/*-----------------------------------------------------------------------------------*/
/* SEO和顶部静态资源
/*-----------------------------------------------------------------------------------*/
function key_desc()
{
    if (is_page() or is_single()) {
        $key = get_post_meta(get_the_ID(), 'key', true);
        $desc = get_post_meta(get_the_ID(), 'desc', true);
        $content = '';
        if ($key) {
            $content .= '<meta name="keyword" content="' . $key . '">';
        }
        if ($desc) {
            $content .= '<meta name="description" content="' . $desc . '">';
        }
    }
    echo $content;
}
add_action('wp_head', 'key_desc', 1);
/*-----------------------------------------------------------------------------------*/
/* 全局底部JS脚本
/*-----------------------------------------------------------------------------------*/
function footer_assets()
{
    echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/smoothscroll.min.js') . '" id="smoothscroll-js" defer="defer"></script>';
    //echo '<link rel="stylesheet" href="'.blog_theme_url('/assets/font/font-awesome-4.7.0/css/font-awesome.min.css').'" id="font-awesome-css">';
    echo '<link rel="stylesheet" href="'.blog_theme_url('/assets/font/fontello/css/fontello.min.css').'" id="fontello-css">';
    
}
add_action('wp_footer', 'footer_assets');

/*-----------------------------------------------------------------------------------*/
/* 全局头部静态资源
/*-----------------------------------------------------------------------------------*/
/*function arke_scripts()
{
    wp_enqueue_script('load-script-js', blog_theme_url('/assets/js/load-script.min.js'));
    wp_enqueue_script('common-js', blog_theme_url('/assets/js/common.min.js'));
    wp_enqueue_script('lazyload-js', blog_theme_url('/assets/js/lazyload.min.js'));
    wp_enqueue_script('wow-js', blog_theme_url('/assets/js/wow.min.js'));
    wp_enqueue_style('commons-css', blog_theme_url('/assets/css/common.min.css'));
}
add_action('wp_enqueue_scripts', 'arke_scripts');
function header_assets(){
    echo '<script type="text/javascript">var base="'.blog_theme_url().'";</script>';
    echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/load-script.min.js') . '" id="load-script-js"></script>';
}
add_action('wp_head', 'header_assets');
/*-----------------------------------------------------------------------------------*/
/* pjax头部静态资源
/*-----------------------------------------------------------------------------------*/
function wp_header_pjax()
{
    /* css部分*/
}
/* 再执行函数之前加载js*/
function loadOneJsPre()
{
    if (!isset($_GET["pjax"])) {
        if (!function_exists('loadOneJs')) {
            function loadOneJs()
            {
                echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/load-script.min.js') . '" id="load-script-js"></script>';
                echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/common.min.js') . '" id="common-js"></script>';
                echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/lazyload.min.js') . '" id="lazyload-js"></script>';
                echo '<script type="text/javascript" src="' . blog_theme_url('/assets/js/wow.min.js') . '" id="wow-js"></script>';
            }
            loadOneJs();
        }
    }
}
/*-----------------------------------------------------------------------------------*/
/* pjax评论区静态资源
/*-----------------------------------------------------------------------------------*/
function wp_comment_pjax()
{

    if ((is_single() or is_page()) and !post_password_required()) {
        loadOneJsPre();
        $post_info = get_post(get_the_ID(), ARRAY_A);
        $comment_count = $post_info['comment_count'];
        echo '<script type="text/javascript">';
        //开启评论
        /*if(!is_user_logged_in()){
        echo 'load.comment("openComments");';
    }*/
        if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
            $comment_author_email = $_COOKIE['comment_author_email_' . COOKIEHASH];
            $comment_author_email = md5($comment_author_email);
            echo 'load.comment("openComments","' . $comment_author_email . '");';
        } else {
            echo 'load.comment("openComments");';
        }
        //如果有评论
        if ($comment_count > 0) {
            echo 'lazyload();load.content("dateFormat");load.comment("moreComments","' . $comment_count . '");load.comment("louCengStr");';
        }
        echo '</script>';
    }
}
/*-----------------------------------------------------------------------------------*/
/* pjax底部静态资源
/*-----------------------------------------------------------------------------------*/
function wp_footer_pjax()
{
    loadOneJsPre();
    echo '<script type="text/javascript">';
    //全局
    echo '';
    //如果是首页
    if (is_home()) {
         echo 'footerInfo("index");';
    }
    //文章页或者单页
    else if (is_single() or is_page()) {
        $post_con = get_the_content();
        echo 'load.content("dateFormat");';
        //如果开启导航栏
        if (get_post_meta(get_the_ID(), 'postNav', true) == 'true') {
            echo 'load.postNavShow();';
        }
        //如果有画廊
        if (strpos($post_con, 'wp:gallery') !== false) {
            echo 'load.baguetteBox(".wp-block-gallery");';
        }
        //代码高亮
        if (strpos($post_con, 'wp:code') !== false) {
            echo 'load.prettyPrint();';
        }
        //文章页
        if (is_single()) {
            echo 'load.content("morePost","' . get_the_ID() . '");';
            //如果文章页有书单内容并且是书单分类
            if (is_single() and (get_the_category()[0]->slug == 'sd')) {
                echo 'load.book("isbnImg");';
            }
            if (comments_open() and isset($_GET["pjax"])) {
                echo 'commentData("post","' . get_the_ID() . '");';
            }
        }
        //单页
        else {
            echo 'footerInfo();';
            if (comments_open() and isset($_GET["pjax"])) {
                echo 'commentData("page","' . get_the_ID() . '");';
            }
        }
    }
    //如果是分类
    else if (is_category()) {
        echo 'footerInfo();';
        //如果分类是书单
        if (get_the_category()[0]->slug == 'sd') {
            echo 'load.book("doubanUrl");';
        }
    } else {
        echo 'footerInfo();';
    }
    //使用pjax时
    if (isset($_GET["pjax"])) {
        echo 'document.title="' . blog_title_head() . '";new WOW().init();';
    }
    echo 'lazyload();';
    echo '</script><img id="last" style="display:none" src="' . blog_theme_url('/assets/img/favicon.png') . '"/>';
}

/*-----------------------------------------------------------------------------------*/
/* 网站标题
/*-----------------------------------------------------------------------------------*/
function blog_title_head()
{
    if (is_single()) {
        $title = get_the_title() . ' - ' . blog_title();
    } else if (is_page()) {
        $title = get_the_title() . ' - ' . blog_title();
    } else if (is_tag()) {
        $title = '标签：' . single_tag_title('', false) . ' - ' . blog_title();
    } else if (is_category()) {
        $title = '分类：' . single_cat_title('', false) . ' - ' . blog_title();
    } else if (is_search()) {
        $title = '搜索 - ' . blog_title();
    } else if (is_date()) {
        if (is_year()) {
            $time = get_the_date('Y年');
        } else if (is_month()) {
            $time = get_the_date('Y年n月');
        } else {
            $time = get_the_date('Y年n月j日');
        }
        $title = $time . '的归档 - ' . blog_title();
    } else {
        if (strpos($_SERVER['REQUEST_URI'], '/page/') === false) {
            $title = blog_title() . ' - ' . blog_title_sub();
        } else {
            $title = '最新文章 - ' . blog_title();
        }
    }
    return $title;
}
/*-----------------------------------------------------------------------------------*/
/* 主题设置
/*-----------------------------------------------------------------------------------*/
if (!function_exists('arke_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function arke_setup()
    {
        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        /*add_theme_support( 'title-tag' );*/

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary Menu', 'arke'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add image size for blog posts, 640px wide (and unlimited height).
        //add_image_size( 'arke-blog', 640 );

        add_theme_support(
            'infinite-scroll',
            array(
                'container' => 'content-area',
                'footer'    => false,
            )
        );
    }
endif;
add_action('after_setup_theme', 'arke_setup');
/*-----------------------------------------------------------------------------------*/
/* 文章特色图片
/*-----------------------------------------------------------------------------------*/
if (!function_exists('arke_thumbnail')) :
    function arke_thumbnail($size = '')
    {
        if (has_post_thumbnail()) {
?>
            <div class="post-thumbnail">
                <?php
                $post_thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                if (!isCrawler()) {
                    the_post_thumbnail($size, array('class' => 'lazyload', 'src' => blog_theme_url('/assets/img/loading.gif'), 'data-src' => $post_thumbnail_url . '?x-oss-process=image/resize,l_662,m_mfit/format,webp', 'srcset' => ' ', 'onclick' => 'imgLightbox.open(this)'));
                } else {
                    the_post_thumbnail($size, array('class' => 'lazyload', 'src' => $post_thumbnail_url, 'srcset' => ' '));
                }
                ?>
            </div>
    <?php
        }
    }
endif;
/*-----------------------------------------------------------------------------------*/
/* 文章页码
/*-----------------------------------------------------------------------------------*/
if (!function_exists('arke_the_posts_navigation')) :
    function arke_the_posts_navigation()
    {
        $args = array(
            'prev_text'          => esc_html__('&larr; Older Posts', 'arke'),
            'next_text'          => esc_html__('Newer Posts &rarr;', 'arke'),
            'screen_reader_text' => esc_html__('Posts Navigation', 'arke'),
        );
        the_posts_navigation($args);
    }
endif;
/*-----------------------------------------------------------------------------------*/
/* 列表页码
/*-----------------------------------------------------------------------------------*/
function pagenavi($type = '')
{
    global $paged, $wp_query;
    if (!isset($max_page)) {
        $max_page = $wp_query->max_num_pages;
    }
    if ($max_page > 1 and $type == 'next') {
        /*
        echo '<div class="paged-nav">
            <div class="left">
                <span>第' . $paged . '页</span>
                <span>共' . $max_page . '页</span>
            </div>
        <div class="right">';
        previous_posts_link('上一页');
        next_posts_link('下一页');
        echo '</div>
        </div>
        <div class="clear"></div>';
        */
        if ($paged == $max_page) {

            return '<button type="button" class="more-page disabled" id="nextPage" disabled>没有更多了</button>';
        }
        $pages = $paged + 1;
        if ($pages == 1) {
            $pages = 2;
        }
        $pagenavi = get_next_posts_link('%link');
        preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i', $pagenavi, $pagenavi);
        return '<button type="button" class="more-page" id="nextPage" onclick="pagenavi(\'' . $pagenavi[1][0] . '\',\'next\')">加载第 ' . $pages . ' 页</button>';
    } else if ($paged > 0 and $type == 'previous') {
        $pages = $paged - 1;
        $pagenavi = get_previous_posts_link('%link');
        preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i', $pagenavi, $pagenavi);
        return '<button type="button" class="previous-page" id="previousPage" onclick="pagenavi(\'' . $pagenavi[1][0] . '\',\'previous\')">加载第 ' . $pages . ' 页</button>';
    } else {
        return '';
    }
}

/*
echo '<button type="button" class="more-page" id="nextPage" onclick="nextPage(\''.pagenavi().''.$type.'\')">加载更多</button>';
}
else{
echo '<button type="button" class="more-page disabled" id="nextPage" disabled>没有更多了</button>';
}/*
/*-----------------------------------------------------------------------------------*/
/* WordPress头部信息优化
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_generator'); //去掉版本信息
remove_action('wp_head', 'feed_links', 2); //移除文章和评论feed
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'wlwmanifest_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'index_rel_link'); //移除当前页面的索引
remove_action('wp_head', 'parent_post_rel_link'); //移除最开始文章的url
remove_action('wp_head', 'start_post_rel_link'); // 移除后面文章的url
remove_action('wp_head', 'adjacent_posts_rel_link'); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_resource_hints', 2); //应该是为了从s.w.org预获取表情和头像，目的是提高网页加载速度 
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //去除代码中的动态链接入口
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); //移除相邻文章的url
remove_action('template_redirect', 'wp_shortlink_header', 11, 0); //去除代码中的动态链接入口
remove_filter('the_content', 'wptexturize'); //取消标点符号转义
/*-----------------------------------------------------------------------------------*/
/* WordPress禁用Emoji表情
/*-----------------------------------------------------------------------------------*/
remove_action('admin_print_scripts',  'print_emoji_detection_script');
remove_action('admin_print_styles',  'print_emoji_styles');
remove_action('wp_head',    'print_emoji_detection_script',  7);
remove_action('wp_print_styles',  'print_emoji_styles');
remove_filter('the_content_feed',  'wp_staticize_emoji');
remove_filter('comment_text_rss',  'wp_staticize_emoji');
/*-----------------------------------------------------------------------------------*/
/* WordPress后台无用功能
/*-----------------------------------------------------------------------------------*/
function disable_dashboard_widgets()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //近期评论
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal'); //近期草稿
    remove_meta_box('dashboard_primary', 'dashboard', 'core'); //wordpress博客
    remove_meta_box('dashboard_secondary', 'dashboard', 'core'); //wordpress其它新闻
    remove_meta_box('dashboard_right_now', 'dashboard', 'core'); //wordpress概况
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core'); //wordresss链入链接
    remove_meta_box('dashboard_plugins', 'dashboard', 'core'); //wordpress链入插件
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core'); //wordpress快速发布
}
add_action('admin_menu', 'disable_dashboard_widgets');
add_filter('wp_default_scripts', 'dequeue_jquery_migrate'); //不加载jquery_migrate，这个东西导致访问首页缓慢
function dequeue_jquery_migrate(&$scripts)
{
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
    }
}
/*-----------------------------------------------------------------------------------*/
/* WordPress移除菜单的多余 CSS 选择器
/*-----------------------------------------------------------------------------------*/
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('body_class', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}
/*-----------------------------------------------------------------------------------*/
/* WordPress禁用Site Health（网站健康）检测项
/*-----------------------------------------------------------------------------------*/
function prefix_remove_site_health($tests)
{
    unset($tests['direct']['php_version']);
    unset($tests['direct']['wordpress_version']);
    unset($tests['direct']['plugin_version']);
    unset($tests['direct']['theme_version']);
    unset($tests['direct']['sql_server']);
    unset($tests['direct']['php_extensions']);
    unset($tests['direct']['utf8mb4_support']);
    unset($tests['direct']['https_status']);
    unset($tests['direct']['ssl_support']);
    unset($tests['direct']['scheduled_events']);
    unset($tests['direct']['http_requests']);
    unset($tests['direct']['is_in_debug_mode']);
    unset($tests['direct']['dotorg_communication']);
    unset($tests['direct']['background_updates']);
    unset($tests['direct']['loopback_requests']);
    unset($tests['direct']['rest_availability']);
    return $tests;
}
add_filter('site_status_tests', 'prefix_remove_site_health');
/*-----------------------------------------------------------------------------------*/
/* WordPress移除加载的JS和CSS链接中的版本号
/*-----------------------------------------------------------------------------------*/
function wpdaxue_remove_cssjs_ver($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'wpdaxue_remove_cssjs_ver', 999);
add_filter('script_loader_src', 'wpdaxue_remove_cssjs_ver', 999);
#禁用WordPress 5.5+内置的图片延迟加载功能
add_filter('wp_lazy_loading_enabled', '__return_false');
/*-----------------------------------------------------------------------------------*/
/* WordPress屏蔽 REST API
/*-----------------------------------------------------------------------------------*/
//屏蔽 REST API
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
// 移除头部 wp-json 标签和 HTTP header 中的 link
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
/*-----------------------------------------------------------------------------------*/
/* WordPress 5.0+移除 block-library CSS
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'fanly_remove_block_library_css', 100);
function fanly_remove_block_library_css()
{
    wp_dequeue_style('wp-block-library');
}
/*-----------------------------------------------------------------------------------*/
/* WordPress关闭自动加载的Open Sans字体
/*-----------------------------------------------------------------------------------*/
function remove_open_sans()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans');
/*-----------------------------------------------------------------------------------*/
/* WordPress评论区楼中楼回复加@
/*-----------------------------------------------------------------------------------*/
function idevs_comment_add_at($comment_text, $comment)
{   
    $parent_id=$comment->comment_parent;
    if ($parent_id > 0) {
        $comment_text = '<span class="comment-'.$parent_id.'">@ <a href="#comment-' . $parent_id . '">' . get_comment_author($parent_id) . '</a> </span>' . $comment_text;
    }
    return $comment_text;
}
add_filter('comment_text', 'idevs_comment_add_at', 20, 2);
/*-----------------------------------------------------------------------------------*/
/* WordPress自定义404
/*-----------------------------------------------------------------------------------*/
function the_404_template($template)
{
    if (!is_404()) return $template;
    header('HTTP/1.1 404 Not Found');
    ?>
<!DOCTYPE HTML><html><head><meta charset="UTF-8"/><meta name="robots"content="none"/><title>404 Not Found</title><style>*{font-family:"Microsoft Yahei";margin:0;font-weight:lighter;text-decoration:none;text-align:center;line-height:2.2em}html,body{height:100%}h1{font-size:100px;line-height:1em}table{width:100%;height:100%;border:0;padding:0 10%}</style></head><body><table cellspacing="0"cellpadding="0"><tr><td><table cellspacing="0"cellpadding="0"><tr><td><h1>404</h1><h3>大事不妙啦！</h3><p>你访问的页面好像不小心被博主给弄丢了~<br/><a href="<?php echo blog_url('/') ?>">惩罚博主></a></p></td></tr></table></td></tr></table></body></html>
<?php die;
}
add_filter('template_include', 'the_404_template');
/*-----------------------------------------------------------------------------------*/
/* WordPress修改两次评论的间隔时间
/*-----------------------------------------------------------------------------------*/
function suren_comment_flood_filter($flood_control, $time_last, $time_new)
{
    $seconds = 60;
    if (($time_new - $time_last) < $seconds) {
        return true;
    } else {
        return false;
    }
}
add_filter('comment_flood_filter', 'suren_comment_flood_filter', 10, 3);
/*-----------------------------------------------------------------------------------*/
/* 自定义Gravatar头像调用链接
/*-----------------------------------------------------------------------------------*/
function ssl_get_avatar($avatar)
{
    if (is_category()) {
        $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="https://sdn.geekzu.org/avatar/$1?s=$2&d=mm" width="45" height="45" class="lazyload avatar avatar-$2">', $avatar);
    } else {
        $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="https://sdn.geekzu.org/avatar/$1?s=$2&d=mm" width="43" height="43" onclick="userInfo(\'' . get_comment_ID() . '\')" class="lazyload avatar avatar-$2">', $avatar);
    }
    return $avatar;
}
add_filter('get_avatar', 'ssl_get_avatar');
/*-----------------------------------------------------------------------------------*/
/* 搜索结果伪静态
/*-----------------------------------------------------------------------------------*/
function v7v3_search_url_rewrite()
{
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
        exit();
    }
}
add_action('template_redirect', 'v7v3_search_url_rewrite');
/*-----------------------------------------------------------------------------------*/
/* 评论拦截和处理
/*-----------------------------------------------------------------------------------*/
function scp_comment_post($incoming_comment)
{
    if (!preg_match('/[一-龥]/u', $incoming_comment['comment_content'])) {
        header('HTTP/1.1 301 Moved Permanently');
        die("请重新组织语言<br><br>评论内容：<br><pre>" . $incoming_comment['comment_content'] . '</pre>');
    }
    if (preg_match('/<\/?[^>]+>/u', $incoming_comment['comment_content'])) {
        $incoming_comment['comment_content'] = preg_replace('/<\/?[^>]+>/', '', $incoming_comment['comment_content']);
    }
    if (preg_match('/\]http:/u', $incoming_comment['comment_content'])) {
        header('HTTP/1.1 301 Moved Permanently');
        die("禁止使用HTTP资源，请使用支持HTTPS协议的资源<br><br>评论内容：<br><pre>" . $incoming_comment['comment_content'] . '</pre>');
    }
    if (preg_match('/\img]\//u', $incoming_comment['comment_content']) or preg_match('/\[url=\//u', $incoming_comment['comment_content'])) {
        header('HTTP/1.1 301 Moved Permanently');
        die("链接资源请使用完整的协议头<br><br>评论内容：<br><pre>" . $incoming_comment['comment_content'] . '</pre>');
    }
    return ($incoming_comment);
}
add_filter('preprocess_comment', 'scp_comment_post');
/*-----------------------------------------------------------------------------------*/
/* 处理私密评论
/*-----------------------------------------------------------------------------------*/
function secret_comment_post($commentdata)
{
    if (isset($_POST['secret']) && $_POST['secret'] == 'secret') {
        $commentdata['comment_content'] = '[hide]' . $commentdata['comment_content'] . '[/hide]';
    }
    return ($commentdata);
}
add_filter('preprocess_comment', 'secret_comment_post');
/*-----------------------------------------------------------------------------------*/
/* 获取评论真实ip
/*-----------------------------------------------------------------------------------*/
function pre_comment_user_ip_example()
{
    $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['X_FORWARDED_FOR'])) {
        $X_FORWARDED_FOR = explode(',', $_SERVER['X_FORWARDED_FOR']);
        if (!empty($X_FORWARDED_FOR))
            $REMOTE_ADDR = trim($X_FORWARDED_FOR[0]);
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $HTTP_X_FORWARDED_FOR = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        if (!empty($HTTP_X_FORWARDED_FOR))
            $REMOTE_ADDR = trim($HTTP_X_FORWARDED_FOR[0]);
    }
    return preg_replace('/[^0-9a-f:\., ]/si', '', $REMOTE_ADDR);
}
add_filter('pre_comment_user_ip', 'pre_comment_user_ip_example');
/*-----------------------------------------------------------------------------------*/
/* WordPress评论区添加博主标识并转链接并设置等级
/*-----------------------------------------------------------------------------------*/
function loper_redirect_author_link($text = '')
{
    if(strpos($text,'href') !== false){
        $text = preg_replace('/<a[^>]*>(.*?)<\/a>/is', '<a class="a-hover-underline" href="javascript:userInfo(\'' . get_comment_ID() . '\');">$1</a>', $text);
    }
    else{
        $text = '<a class="a-hover-underline" href="javascript:userInfo(\'' . get_comment_ID() . '\');">'.$text.'</a>';
    }

    if (get_comment_author() == get_the_author() and get_comment_author_email() == get_option('admin_email')) {
        $text .= '<span class="comment-level comment-blogger" title="评论等级"><span class="hr"></span><a href="'.blog_url('/dj').'" rel="noreferrer" target="_blank"><i class="icon-vimeo" title="博主"></i><span class="num">博主</span></a><span class="hr"></span></span>';
    }
    else{
    $level = get_comment_meta('1',get_comment_author_email(), true );
    $text .= $level ? '<span class="comment-level" title="评论等级"><span class="hr"></span><a href="'.blog_url('/dj').'" rel="noreferrer" target="_blank">'.setGrade($level).'</a><span class="hr"></span></span>':NULL;
    }
    return $text;
}
add_filter('get_comment_author_link', 'loper_redirect_author_link', 5);

function setGrade($level){
        if($level<1){
            return '<i class="icon-vimeo"></i><span class="num">0</span>';
        }elseif ($level<5 && $level>0) {
            return '<i class="icon-vimeo"></i><span class="num">1</span>';
        }elseif ($level<10 && $level>=5) {
            return '<i class="icon-vimeo"></i><span class="num">2</span>';
        }elseif ($level<15 && $level>=10) {
            return '<i class="icon-vimeo"></i><span class="num">3</span>';
        }elseif ($level<20 && $level>=15) {
            return '<i class="icon-vimeo"></i><span class="num">4</span>';
        }elseif ($level<25 && $level>=20) {
            return '<i class="icon-vimeo"></i><span class="num">5</span>';
        }elseif ($level>=25) {
            return '<i class="icon-vimeo"></i><span class="num">6</span>';
    }
}
/*-----------------------------------------------------------------------------------*/
/* WordPress评论隐藏内容
/*-----------------------------------------------------------------------------------*/
function loper_redirect_comment_hide($content,$id='',$email='')
{
    if (strpos($content, '[/hide]') !== false) {
        $comment_author_email = '';
        if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
            $comment_author_email = $_COOKIE['comment_author_email_' . COOKIEHASH];
        }
        $comment_id=get_comment_ID();
        $comment_email=get_comment_author_email();
         //处理下userinfo api的逻辑
         if($id){
             $comment_id=$id;
         }
         if($email){
             $comment_email=$email;
         }
         //处理完毕
        if ($comment_email != $comment_author_email) {
            $content = '<p class="secret-comment" id="secret-'. $comment_id.'"><i class="icon-lock"></i> 该评论为私密评论，<a href="javascript:secretCommentShow(\'' . $comment_id . '\');">点击查看</a></p>';
        } else {
            $content = str_replace("[hide]", "<p class=\"secret-comment\">", $content);
            $content = str_replace("[/hide]", "</p>", $content);
        }
    }
    return $content;
}
add_filter('comment_text', 'loper_redirect_comment_hide', 99);
/*-----------------------------------------------------------------------------------*/
/* WordPress评论UBB转换
/*-----------------------------------------------------------------------------------*/
function comment_ubb($content)
{
    //处理 img
    if (strpos($content, '[/img]') !== false) {
        $content = str_replace("[img]", "<img data-src=\"", $content);
        $content = str_replace("[/img]", "\" class=\"lazyload\" onclick=\"imgLightbox.open(this)\" onerror=\"this.src=base+'/assets/img/no-img.jpg'\"/>", $content);
    }
    //处理 url
    if (strpos($content, '[url]') !== false) {
        preg_match_all('/\[url\](.*?)\[\/url\]/', $content, $matches);
        if ($matches) {
            foreach ($matches[1] as $val) {
                $val2=$val;
                $val3 = mb_strimwidth($val, 0, 60, "..."); 
                if (strpos($val, 'http') !== false) {
                    $val2 = str_replace("http://", "", $val);
                }
                if (strpos($val, 'https') !== false) {
                    $val2 = str_replace("https://", "", $val);
                }
                if(strpos($val, blog_url()) === false){
                    $content = str_replace("$val", "<a href=\"" . blog_url('/') . "go#$val2\" rel=\"noopener\" target=\"_blank\">$val3</a>", $content);
                }
                else{
                    $content = str_replace("$val", "<a href=\"//" . $val2 . "\" rel=\"noopener\" target=\"_blank\">$val3</a>", $content);
                }
            }
            $content = str_replace("[url]", "", $content);
            $content = str_replace("[/url]", "", $content);
        }
    }
    return $content;
}
add_filter('comment_text', 'comment_ubb', 99);
/*-----------------------------------------------------------------------------------*/
/* 文章内外链添加 go 跳转
/*-----------------------------------------------------------------------------------*/
function the_content_nofollow($content)
{
    preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/', $content, $matches);
    if ($matches) {
        foreach ($matches[2] as $val) {
            if (strpos($val, '://') !== false && strpos($val, blog_url()) === false) {
                if (strpos($val, 'http') !== false) {
                    $val2 = str_replace("http://", "", $val);
                }
                if (strpos($val, 'https') !== false) {
                    $val2 = str_replace("https://", "", $val);
                }
                $content = str_replace("href=\"$val\"", "href=\"" . blog_url('/') . "go#$val2\" target=\"_blank\"", $content);
            }
        }
    }
    return $content;
}
add_filter('the_content', 'the_content_nofollow', 999);
/*-----------------------------------------------------------------------------------*/
/* 自定义短代码
/*-----------------------------------------------------------------------------------*/
function meting_js($atts)
{
    extract(shortcode_atts(array(
        'server' => 'netease',
        'type' => 'song',
        'id' => '493458612',
        'loop' => 'none',
        'volume' => '0.5',
        'order' => 'false',
        'listmaxheight' => '340px',
    ), $atts));
    $con = '<div class="aplayer" data-id="' . $id . '" data-server="' . $server . '" data-type="' . $type . '" data-loop="' . $loop . '" data-volume="' . $volume . '"  data-order="' . $order . '"  data-list-max-height="' . $listmaxheight . '"></div>';
    if (!function_exists('con_js')) {
        function con_js()
        {
            echo '<script type="text/javascript">
            loadScript("/assets/css/APlayer.min.css","css","APlayer-css","head");
            try{
                loadMeting(); 
            }
            catch(err){
                loadScript("/assets/js/APlayer.min.js","js","APlayer-js","head");
                document.getElementById("APlayer-js").onload=function(){
                    loadScript("/assets/js/Meting.min.js","js","Meting-js","body");
                    document.getElementById("Meting-js").onload=function(){
                        loadMeting();
                    }
                }
            }
            </script>';
        }
        $con .= con_js();
    }
    return $con;
}
function cqw_download($atts)
{
    extract(shortcode_atts(array(
        'url' => '',
        'by' => '',
    ), $atts));
    if ($by == '') {
        $fr = explode("/", $url);
        $count = count($fr) - 1; //文件名 $fr[$count]
        $header_array = get_headers($url, true);
        $size = round($header_array['Content-Length'] / 1024, 2); //文件大小，单位kb $size
        $headInf = get_headers($url, 1);
        $time = date("Y-m-d H:i:s", strtotime($headInf['Last-Modified']) + 8 * 60 * 60); //文件修改日期 $time
        $con = '<div class="post-file-down">';
        $con .= '<div class="post-file-info"><span class="f">' . $fr[$count] . '</span>/<span>' . $size . 'KB</span><div class="sm-none">/<span><time datetime="' . $time . '"></time></span></div><div class="post-file-btn"><a href= "' . $url . '">点击下载</a></div></div><div class="clear"></div>';
        $con .= '</div>';
    }
    return $con;
}

function bilibili($atts)
{
    extract(shortcode_atts(array(
        'av' => '',
        'p' => '',
    ), $atts));
    $con = '<iframe id="bilibili" src="//player.bilibili.com/player.html?bvid=' . $av . '&page=' . $p . '" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>
    <script>
    document.getElementById("bilibili").setAttribute("style", "height:"+((document.getElementsByClassName("entry-content")[0].offsetWidth)/16*9)+"px");
    </script>';
    return $con;
}
function copyright(){
    $con='<div class="entry-copyright">作者: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a><br/>出处: <a href="'.get_permalink().'">'.get_permalink().'</a><br/>声明: 本文版权归作者所有，欢迎转载，但未经作者同意必须保留此段声明，且在页面明显位置给出原文链接</div>';
    return $con;
}
function register_shortcodes()
{
    add_shortcode('meting', 'meting_js');
    add_shortcode('bilibili', 'bilibili');
    add_shortcode('download', 'cqw_download');
    add_shortcode('copyright', 'copyright');
}
add_action('init', 'register_shortcodes');

/*-----------------------------------------------------------------------------------*/
/* 替换文章关键内容
/*-----------------------------------------------------------------------------------*/
function replace_text_wps($text)
{
    $replace = array(
        // '关键词' => '替换的关键词'
        // 替换缩略图
        //'" alt=""' => '?x-oss-process=image/quality,Q_20/blur,r_33,s_9" alt=""',
        // 延迟加载
        // 灯箱
        //'loading' => 'onclick="imgOpen()"  loading',
        // 代码高亮
        '<code>' => '<code class="prettyprint">',
    );
    // 判断是否是爬虫做src替换
    if (!isCrawler()) {
        $text = str_replace(array_keys($replace), $replace, $text);
        if (strpos(get_the_content(), 'wp:gallery') !== false) {
            $text = preg_replace('/<img.*?src="(.*?)".*?class="(.*?)".*?>/is', '<a href="$1"><img class="$2 lazyload" src="' . blog_theme_url('/assets/img/loading.gif') . '" data-src="$1?x-oss-process=image/resize,l_662,m_mfit/format,webp"></a>', $text);
        } else {
            $text = preg_replace('/<img.*?src="(.*?)".*?class="(.*?)".*?/is', '<img class="$2 lazyload" src="' . blog_theme_url('/assets/img/loading.gif') . '"width="100%" height="100%" data-src="$1?x-oss-process=image/resize,l_662,m_mfit/format,webp" onclick="imgLightbox.open(this)"', $text);
        }
    } else {
        $text = str_replace(array_keys($replace), $replace, $text);
    }
    return $text;
}
add_filter('the_content', 'replace_text_wps');
/*-----------------------------------------------------------------------------------*/
/* 列表过滤短代码
/*-----------------------------------------------------------------------------------*/
function wpjam_remove_shortcode_from_archive($content)
{
    $category = get_the_category();
    if (!is_single() and !is_page()) {
        $content = strip_shortcodes($content);
    }
    return $content;
}
add_filter('the_content', 'wpjam_remove_shortcode_from_archive');
/*-----------------------------------------------------------------------------------*/
/* 获取文章第一张图片
/*-----------------------------------------------------------------------------------*/
function catch_that_image()
{
    global $post;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post->post_content), $matches);
    if (empty($output)) {
        //如果没有图就会显示默认的图
        $first_img = "";
    } else {
        $first_img = $matches[1][0];
    }
    return $first_img;
}
/*-----------------------------------------------------------------------------------*/
/* 所有回复都发邮件
/*-----------------------------------------------------------------------------------*/
function comment_mail_notify($comment_id)
{
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
        $message = '<table cellpadding="0" cellspacing="0" class="email-container" align="center" width="550" style="font-size: 15px; font-weight: normal; line-height: 22px; text-align: left; border: 1px solid rgb(177, 213, 245); width: 550px;">
            <tbody>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" class="padding" width="100%" style="padding-left: 40px; padding-right: 40px; padding-top: 30px; padding-bottom: 35px;">
                            <tbody>
                                <tr class="logo">
                                    <td align="center">
                                        <table class="logo" style="margin-bottom: 10px;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span style="font-size: 22px;padding: 10px 20px;margin-bottom: 5%;color: #65c5ff;border: 1px solid;box-shadow: 0 5px 20px -10px;border-radius: 2px;display: inline-block;">' . get_option("blogname") . '</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="content">
                                    <td>
                                        <hr style="height: 1px;border: 0;width: 100%;background: #eee;margin: 15px 0;display: inline-block;">
                                        <p>Hi ' . trim(get_comment($parent_id)->comment_author) . '!<br>Your comment by "' . get_the_title($comment->comment_post_ID) . '":</p>
                                        <p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim(get_comment($parent_id)->comment_content) . '</p>
                                        <p>' . $comment->comment_author . ' give you reply:</p>
                                        <p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim($comment->comment_content) . '</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table cellpadding="12" border="0" style="font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 25px; color: #444444; text-align: left;">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a target="_blank" style="color: #fff;background: #65c5ff;box-shadow: 0 5px 20px -10px #44b0f1;border: 1px solid #44b0f1;width: 200px;font-size: 14px;padding: 10px 0;border-radius: 2px;margin: 10% 0 5%;text-align:center;display: inline-block;text-decoration: none;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">Now Reply</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" align="center" class="footer" style="max-width: 550px; font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 22px; color: #444444; text-align: left; padding: 20px 0; font-weight: normal;">
            <tbody>
                <tr>
                    <td align="center" style="text-align: center; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: normal; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
                        <p>本邮件由系统自动发送，请不要回复此邮件。当然，您也可以回复，但我不一定能看见。</p>
                        <p>© ' . date("Y") . ' <a name="footer_copyright" href="' . home_url() . '" style="color: rgb(43, 136, 217); text-decoration: underline;" target="_blank">' . get_option("blogname") . '</a></p>
                    </td>
                </tr>
            </tbody>
        </table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}
add_action('comment_post', 'comment_mail_notify');
/*-----------------------------------------------------------------------------------*/
/* 列表内容过滤
/*-----------------------------------------------------------------------------------*/
function SearchFilter($query)
{
    //仅搜索时
    //if($query->is_search){
    //if (!is_page() and !is_single()) {
    //设定指定的文章类型，这里仅搜索文章
    // $query->set('post_type', 'post');
    //指定文章和自定义类型
    //$query->set('post_type', array('post','custom-post-type'));
    //排除指定的文章ID号
    //$query-->set('post__not_in', array(10,11,20,105));
    //搜索指定的类型
    //$query->set('cat','8,15');
    //搜索条件....
    //}
    if (!is_admin()) {
        if ($query->is_home) {
            //6 动态,19孤独说,27相册集,28纪念册
            $query->set('cat', '-6, -19, -27,-28');
            $query->set('post_type', 'post');
        } else if ($query->is_search) {
            $query->set('cat', '-6, -19, -27,-28');
            $query->set('post_type', 'post');
        } else if ($query->is_archive) {
            if ($query->is_month or $query->is_day or $query->is_year)
            $query->set('cat', '-6, -19, -27,-28');
        }
        return $query;
    }
}
add_filter('pre_get_posts', 'SearchFilter');


// function com($comment_id){
//     if(isset($_COOKIE['user_info'])){
//         global $wpdb;
//         $arr = explode(",",$_COOKIE['user_info']);  
//         if ($arr[0]){
//             $wpdb->query( "update wp_comments set system='".$arr[0]."' where comment_ID=".$comment_id );
//         }
//         if ($arr[1]){
//             $wpdb->query( "update wp_comments set browser='".$arr[1]."' where comment_ID=".$comment_id );
//         }
//         if ($arr[2]){
//             $wpdb->query( "update wp_comments set address='".$arr[2]."' where comment_ID=".$comment_id );
//         }
//     }
// }

// add_filter('comment_post', 'com');

/* 判断是否是爬虫 */
if (!function_exists('isCrawler')) {
    //提取自 WP-PostViews 插件 https://wordpress.org/plugins/wp-postviews
    function isCrawler()
    {
        if (empty($_COOKIE['is_crawler'])) {
            $bots = array(
                'Google Bot' => 'google', 'MSN' => 'msnbot', 'Alex' => 'ia_archiver', 'Lycos' => 'lycos', 'Ask Jeeves' => 'jeeves', 'Altavista' => 'scooter', 'AllTheWeb' => 'fast-webcrawler', 'Inktomi' => 'slurp@inktomi', 'Turnitin.com' => 'turnitinbot', 'Technorati' => 'technorati', 'Yahoo' => 'yahoo', 'Findexa' => 'findexa', 'NextLinks' => 'findlinks', 'Gais' => 'gaisbo', 'WiseNut' => 'zyborg', 'WhoisSource' => 'surveybot', 'Bloglines' => 'bloglines', 'BlogSearch' => 'blogsearch', 'PubSub' => 'pubsub', 'Syndic8' => 'syndic8', 'RadioUserland' => 'userland', 'Gigabot' => 'gigabot', 'Become.com' => 'become.com', 'Baidu' => 'baiduspider', 'so.com' => '360spider', 'Sogou' => 'spider', 'soso.com' => 'sosospider', 'Yandex' => 'yandex'
            );
            $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            foreach ($bots as $name => $lookfor) {
                if (!empty($useragent) && (false !== stripos($useragent, $lookfor))) {
                    return true;
                } else {
                    setcookie('is_crawler', 'false', time() + 1 * 30 * 24 * 3600, '/');
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
add_filter('locale', function ($locale) {
    $locale = (is_admin()) ? $locale : 'zh_CN';
    return $locale;
});

add_filter('get_site_icon_url', function () {
    // 支持任意图片，图片只要路径正确即可
    if (!is_admin()) {
        $favicon = blog_theme_url('/assets/img/favicon.png');
        return $favicon;
    }
});
/*-----------------------------------------------------------------------------------*/
/* 评论框顺序修改
/*-----------------------------------------------------------------------------------*/
function recover_comment_fields($comment_fields)
{
    $comment = array_shift($comment_fields);
    $comment_fields = array_merge($comment_fields, array('comment' => $comment));
    return $comment_fields;
}

add_filter('comment_form_fields', 'recover_comment_fields');
//add by charleswu
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
#移除/修改标题前的私密和密码保护
function wpdaxue_private_title_format( $format ) {
	return '%s';
}
add_filter( 'private_title_format', 'wpdaxue_private_title_format' );
add_filter( 'protected_title_format', 'wpdaxue_private_title_format' );

/*
function markdownToHtml($data , $postarr){
    
    
    if (strpos($data, '[/md') !== false) {
        include_once 'parsedown.php';
        $Parsedown = new Parsedown();
        preg_match_all('/[md]([\w\W]*)[\/md]/', $data, $matches);
        if ($matches) {
            foreach ($matches[1] as $val) {
                $data= str_replace($val, $Parsedown->text($val),  $data);
            }
            
            //$data = str_replace("[md]", "<!-- wp:html -->",  $data );
            //$data = str_replace("[/md]", "<!-- /wp:html -->", $data);
        }
    }
    
    return $data;
    //$post = str_replace("[md]", "<!-- wp:html -->",  $post );
      //      $post = str_replace("[/md]", "<!-- /wp:html -->", $post);
}
add_filter( 'wp_insert_post_data','markdownToHtml','99', 2 );
*/