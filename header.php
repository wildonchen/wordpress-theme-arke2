<?php
/*
 * @Author: Danny Cooper
 * @Date: 2021-04-02 20:49:43
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 21:02:03
 * @copyright Copyright (c) 2018, Danny Cooper
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/
?>
<?php
if (isset($_GET["pjax"])) {
  header("Content-type: text/html; charset=utf-8");
  wp_header_pjax();
} else {
?>
  <!DOCTYPE html>
  <html lang="zh-CN">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#D5E0EB">
    <meta name="msapplication-navbutton-color" content="#D5E0EB">
    <meta name="apple-mobile-web-app-status-bar-style" content="#D5E0EB">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo blog_title(); ?>">
    <meta name="application-name" content="<?php echo blog_title(); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title><?php echo blog_title_head(); ?></title>
    <link rel="dns-prefetch" href="//chenqiwei.net">
    <link rel="manifest" href="/api/manifest.json">
    <link rel="prefetch" href="/api/manifest.json">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo blog_theme_url('/assets/img/favicon-192.png'); ?>">
    <link rel="apple-touch-icon" sizes="512x512" href="<?php echo blog_theme_url('/assets/img/favicon-512.png'); ?>">
    <!-- <script src="https://www.jq22.com/jquery/jquery-3.3.1.js"></script> -->
    <?php /*if (!is_single() and !is_page()) { ?>
      <link rel="preload" href="<?php echo blog_theme_url('/assets/css/content.min.css'); ?>" as="style">
      <link rel="preload" href="<?php echo blog_theme_url('/assets/css/library.min.css'); ?>" as="style">
    <?php } ?>
    <?php*/
    // 头部资源
    wp_head();
    wp_header_pjax();
    ?>
    <script type="text/javascript">
      var base = '<?php echo blog_theme_url(); ?>';
      /* 网页动态加载资源函数 */
      function loadScript(url, type, id, where) {
        /*  地址，类型，id，位置*/
        if (!document.getElementById(id)) {
          if (url.substring(0, 2) != '//') {
            url = base + url;
          }
          if (type == 'css') {
            var load = document.createElement("link");
            load.rel = "stylesheet";
            load.href = url;
          } else {
            var load = document.createElement("script");
            load.type = "text/javascript";
            load.src = url;
          }
          load.id = id;
          if (where == 'head') {
            document.head.appendChild(load);
          } else {
            document.body.appendChild(load);
          }
        }
      }
    </script>
    <style type="text/css">
      .loading {
        position: fixed;
        width: 2.5em;
        height: 2.5em;
        transform: rotate(165deg);
        top: calc(50% - 1.25em);
        left: calc(50% - 1.25em);
        z-index: 100000;
      }

      .loading:before,
      .loading:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        display: block;
        width: 0.5em;
        height: 0.5em;
        border-radius: 0.25em;
        transform: translate(-50%, -50%);
      }

      .loading:before {
        animation: before 2s infinite;
      }

      .loading:after {
        animation: after 2s infinite;
      }

      @keyframes before {
        0% {
          width: 0.5em;
          box-shadow: 1em -0.5em rgba(225, 20, 98, 0.75), -1em 0.5em rgba(111, 202, 220, 0.75);
        }

        35% {
          width: 2.5em;
          box-shadow: 0 -0.5em rgba(225, 20, 98, 0.75), 0 0.5em rgba(111, 202, 220, 0.75);
        }

        70% {
          width: 0.5em;
          box-shadow: -1em -0.5em rgba(225, 20, 98, 0.75), 1em 0.5em rgba(111, 202, 220, 0.75);
        }

        100% {
          box-shadow: 1em -0.5em rgba(225, 20, 98, 0.75), -1em 0.5em rgba(111, 202, 220, 0.75);
        }
      }

      @keyframes after {
        0% {
          height: 0.5em;
          box-shadow: 0.5em 1em rgba(61, 184, 143, 0.75), -0.5em -1em rgba(233, 169, 32, 0.75);
        }

        35% {
          height: 2.5em;
          box-shadow: 0.5em 0 rgba(61, 184, 143, 0.75), -0.5em 0 rgba(233, 169, 32, 0.75);
        }

        70% {
          height: 0.5em;
          box-shadow: 0.5em -1em rgba(61, 184, 143, 0.75), -0.5em 1em rgba(233, 169, 32, 0.75);
        }

        100% {
          box-shadow: 0.5em 1em rgba(61, 184, 143, 0.75), -0.5em -1em rgba(233, 169, 32, 0.75);
        }
      }

      .loading+#paper {
        pointer-events: none;
        opacity: 0.8;
      }

      html,
      body {
        height: 100%;
      }

      body {
        color: #404040;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 15px;
        line-height: 1.7;
        overflow-wrap: break-word;
        text-shadow: 0px 0px 1px rgb(0 0 0 / 10%);
        margin: 0 auto;

      }

      #paper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
      }

      input,
      button,
      a {
        outline: 0 none !important;
      }

      img {
        -webkit-user-drag: none;
      }

      a {
        background-color: transparent;
      }

      ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
      }

      ::-webkit-scrollbar-thumb {
        background-color: #dddddd;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 3px solid transparent;
        border-radius: 5px;
        position: absolute;
      }

      h1 {
        font-size: 2em;
        margin: 0.67em 0;
      }

      .none {
        display: none;
      }

      .block {
        display: block;
      }

      img {
        border: 0;
      }

      ul,
      li {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      figure {
        margin: 1em 40px;
      }

      hr {
        box-sizing: content-box;
        height: 0;
      }

      .entry-title {
        font-size: 1.25em;
      }

      .entry-title a {
        color: #000;
      }

      .list .entry-title,
      .list .entry-time {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .list .entry-time {
        visibility: hidden;
        height: 0;
      }

      @media screen and (min-width: 720px) {
        .list .entry-title {
          max-width: 480px;
          float: left;
        }

        .list .entry-time {
          max-width: 170px;
          float: right;
          font-size: 13px;
          color: darkgray;
        }

        .list article:hover .entry-time {
          visibility: visible;
          height: 56px;
          line-height: 56px;
          animation-duration: 0.8s;
          animation-name: entry-time;
        }
      }

      @keyframes entry-time {
        from {
          width: 0px;
        }

        to {
          width: 86.88px;
        }
      }

      .list .entry-content-img {
        position: absolute;
        top: 0;
        right: 0;
      }

      .list .entry-content {
        position: relative;
      }

      button,
      input[type="button"],
      input[type="reset"],
      input[type="submit"] {
        cursor: pointer;
      }

      /*--------------------------------------------------------------
## Links
--------------------------------------------------------------*/
      a {
        color: steelblue;
        text-decoration: none;
      }

      a:focus {
        outline: thin dotted;
      }

      a:hover,
      a:active {
        outline: 0;
      }

      .site-content,
      .fix-width {
        max-width: 720px;
        min-width: 320px;
        margin: 0 auto;
      }


      .left {
        float: left;
        width: 50%;
        text-align: left;
      }

      .right {
        float: right;
        width: 50%;
        text-align: right;
      }

      .clear {
        height: 0;
        font-size: 0;
        clear: both;
        overflow: hidden;
      }


      /*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
      .site-header {
        position: absolute;
        width: 100%;
        left: 0;
        box-shadow: 0 0 0.6rem 0 #d0d0d0;
        background: #fff;
        z-index: 1000;
        height: 54px;
        line-height: 54px;
      }

      .site-title {
        margin: 0;
        line-height: 54px;
        font-size: 14px;
        font-weight: normal;
      }

      .site-title a {
        text-decoration: none;
        color: #2d2e33;
      }

      .site-title img {
        width: 24px;
        height: 24px;
        vertical-align: middle;
        border-radius: 6px;
      }

      .site-title-img-a::after {
        position: relative !important;
      }

      .site-branding {
        float: left;
        height: 54px;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 65px;
      }

      .site-content {
        margin-top: 70px;
        flex: 1;
      }

      header.fixed {
        position: fixed;
        background: #fff;
        top: 0;
      }

      /*--------------------------------------------------------------
# Primary Nav
--------------------------------------------------------------*/

      .menu-1 {
        font-size: 14px;
        display: block;
        float: right;
        line-height: 54px;
      }

      .menu-1 ul {
        list-style: none;
        margin: 0;
        padding-left: 0;
      }

      .menu-1 li {
        display: inline-block;
        position: relative;
        line-height: normal;
        margin-left: 20px;
        padding: 17px 0;
      }

      .menu-1 a {
        display: block;
        text-decoration: none;
        color: #525252;
      }

      .menu-1 ul ul {
        position: fixed;
        padding: 4px 2px 6px;
        display: none;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 4px;
        z-index: 10000;
        margin: 8px 0 0;
      }

      .menu-1 ul ul li {
        padding: 0;
        margin: 0;
        display: list-item;
        padding: 6px 10px 6px;
      }
      .menu-1 li+li+li:hover ul {
        display: block;
      }

      .menu-1 li+li:hover ul {
        display: block;
      }

      .menu-0 li:hover ul {
        display: block;
      }

      .menu-0 {
        float: left !important;
      }

      .menu-0 li {
        padding-left: 0;
      }

      .menu-more {
        margin: 0 10px;
        display: inline-block;
      }

      .site-content {
        width: 100%;
        box-sizing: border-box;
      }

      @media screen and (max-width: 760px) {

        .site-content,
        .fix-width {
          padding: 0 5%;

        }

        .mobile-css .left,
        .mobile-css .right {
          width: 100%;
          float: none;
          text-align: left;
        }
      }


      /*列表*/
      .paged-nav {
        font-size: 14px;
        margin-top: -5px;
      }

      .paged-nav a {
        color: #000;
      }

      .list .entry-title {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .paged-nav .left span+span,
      .paged-nav .right a+a {
        margin-left: 10px;
      }

      .paged-nav .left,
      .paged-nav .right {
        margin-bottom: 4px;
      }

      article {
        border-top: 2px dashed #eaeaea;
        padding-bottom: 25px;
        padding-top: 8px;
      }

      article:first-child {
        border-top: none;
        padding-top: 0;
      }

      article:first-of-type {
        border-top: none;
      }

      article .entry-content-img {
        width: 89px;
        max-height: 89px;
        overflow: hidden;
        border: 1px solid #eaeaea;
        padding: 3px;
        border-radius: 50%;
        min-height: 89px;
        min-width: 89px;
      }

      article .entry-content-img img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        cursor: -moz-zoom-in;
        cursor: -webkit-zoom-in;
        cursor: zoom-in;
      }

      article:hover .entry-content-img {
        border: 1px solid #2f2f2f;
        animation-name: entry-content-img;
        animation-duration: 1s;
      }

      @keyframes entry-content-img {
        from {
          border: 1px solid #eaeaea;
        }

        to {
          border: 1px solid #2f2f2f;
        }
      }

      @media screen and (min-width: 480px) {
        article .entry-header-info {
          line-height: 63.13px;
          font-size: 14px;
          color: gray;
        }

        article .l4 {
          max-height: 100px;
          min-height: 100px;
          margin-right: 100px;
          overflow: hidden;
          display: block;
          display: -webkit-box;
          -webkit-line-clamp: 4;
          -webkit-box-orient: vertical;
          text-overflow: ellipsis;
        }

        article .l3 {
          max-height: 100px;
          overflow: hidden;
        }
      }

      @media screen and (max-width: 480px) {
        article .l4 {
          max-height: 75px;
          margin-right: 75px;
          min-height: 75px;
          overflow: hidden;
          display: block;
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;
          text-overflow: ellipsis;
        }

        article .l3 {
          max-height: 75px;
          overflow: hidden;
          min-height: 75px;
        }

        article .entry-content-img {
          width: 67px;
          max-height: 67px;
          min-height: 67px;
          min-width: 67px;
        }
      }

      .entry-header-info {
        display: none;
      }

      /*搜索*/
      .search-form input {
        outline: none;
        height: 29px;
        line-height: 28px;
        border-radius: 3px;
        font-size: 15px;
        border: 1px solid #eaeaea;
      }

      .page-title {
        font-size: 1.2em;
      }

      .search-form input.search-field {
        max-width: 30%;
        padding: 0 6px;
      }

      .search-form input.search-submit {
        width: 50px;
        padding: 0;
      }

      .search-box {
        padding: 20px 0 0;
      }

      .search-box form {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      .search-box .screen-reader-text {
        padding-left: 10px;
      }

      /* 首页底部 */
      .footer {
        font-size: 14px;
        margin-top: 50px;
        padding: 15px 0 12px;
        width: 100%;
        box-shadow: 0 0 0.1rem 0 #dadada;
        background: #fff;
        position: relative;
      }

      .footer .left a,
      .footer .right a {
        color: #000;
      }

      .footer .left,
      .footer .right {
        width: 50%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      .footer-info-text {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 100%;
        margin-right: 43px;
      }

      .footer-info-top {
        position: absolute;
        text-align: right;
        right: 0;
      }

      .footer-info {
        display: inline-flex;
        width: 100%;
        position: relative;
      }

      .list article:last-of-type {
        padding-bottom: 0;
      }

      /* ajax 404 提示 */
      #tip-404 {
        background: #fff0f0;
        border: 1px solid #ffd6d6;
        border-radius: 4px;
        position: fixed;
        z-index: 100000;
        width: 220px;
        padding: 4px 10px;
        top: 10%;
        left: 50%;
        margin-left: -120px;
        animation-duration: 0.5s;
        animation-fill-mode: both;
        animation-name: fadeRoute;
        text-align: center;
      }

      ::-webkit-input-placeholder {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      input:-moz-placeholder {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }

      .menu-1 .more {
        cursor: pointer;
      }

      .menu-1 .more>a {
        pointer-events: none;
      }


      /* 说说 */
      .list-img {
        height: 150px;
        overflow: hidden;
        border-radius: 4px;
        margin: 18px 0px 12px;
      }

      .list-img img {
        width: 100%;
        transition: all 1s cubic-bezier(0.2, 0.6, 0.4, 1);
        transform: translateY(-40%);
        cursor: -moz-zoom-in;
        cursor: -webkit-zoom-in;
        cursor: zoom-in;
      }

      .list-img img:hover {
        transform: translateY(-30%);
      }

      /* 搜索关键字 */
      #search-keys sup {
        cursor: pointer;
      }

      #search-keys span {
        cursor: pointer;
        display: inline-block;
        background: #e5e5e5;
        padding: 2px 10px;
        border-radius: 4px;
        max-width: 150px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        margin: 10px 0 10px 10px;
      }

      #search-keys {
        margin-left: -10px;
        white-space: nowrap;
        overflow: overlay;
        width: 100%;
        font-size: 13px;
        display: none;
      }

      /* 放大 */
      #imgLightbox {
        position: fixed;
        top: 0%;
        left: 0%;
        background-color: black;
        color: white;
        width: 100%;
        height: 100%;
        text-align: center;
        cursor: pointer;
        z-index: 1000;
      }

      #imgLightbox td {
        border: none;
        padding: 0;
        margin: 0;
      }

      #imgLightbox img {
        max-width: 100%;
        width: auto;
        height: auto;
        max-height: 100%;
        position: relative;
      }

      #imgLightbox-button {
        cursor: pointer;
        display: inline-block;
        filter: alpha(opacity=70);
        -moz-opacity: 0.7;
        opacity: 0.7;
        position: fixed;
        right: 15px;
        top: 0px;
        color: white;
        font-size: 40px;
        z-index: 9999999;
      }

      #imgLightbox-button:hover {
        filter: alpha(opacity=100);
        -moz-opacity: 1;
        opacity: 1;
      }

      .site-header a,
      .footer a,
      .entry-title a,
      .paged-nav a,
      .info-list-con a,
      .a-hover-underline {
        position: relative;
      }

      .site-header a::after,
      .footer a::after,
      .entry-title a:after,
      .paged-nav a::after,
      .info-list-con a::after,
      .a-hover-underline::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #333333;
        visibility: hidden;
        transform: scaleX(0);
        transition: transform 200ms ease-in-out;
      }

      .site-header a:hover::after,
      .footer a:hover::after,
      .entry-title a:hover::after,
      .paged-nav a:hover::after,
      .info-list-con a:hover::after,
      .a-hover-underline:hover::after {
        visibility: visible;
        transform: scaleX(1);
      }

      /*加载更多*/
      .more-page,
      .previous-page {
        border: 1px solid #eaeaea;
        border-radius: 17px;
        text-align: center;
        background: 0 0;
        width: 60%;
        padding: 6px 0;
        color: #333;
        font-size: 15px;
        display: block;
        margin: 30px auto 0;
      }

      button.disabled {
        color: #ddd;
        cursor: unset;
        display: none;
      }

      .post-title-tag {
        background: #eaeaea;
        font-size: 12px;
        font-weight: normal;
        line-height: 22px;
        height: 21px;
        padding: 0 6px;
        margin: 5px 7px 0 0;
        border-radius: 4px;
        float: left;
      }

      /* 首页 */
      .home-banner {
        height: 180px;
        width: 100%;
        border-radius: 4px;
        margin: 20px 0 10px;
        -webkit-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: center;
        color: #fff;
      }

      .home-banner-date {
        padding-top: 40px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
      }

      .home-banner-say {
        height: 100px;
        padding: 0 15px 15px;
        text-align: center;
        z-index: 100;
      }

      .home-banner-text {
        position: relative;
        overflow: hidden;
        max-height: 50px;
      }

      .home-banner-more a {
        border-bottom: 1px dashed #ffffff;
        color: #fff;
        font-size: 13px;
      }

      h2.cat {
        margin-top: 0;
        padding-top: 10px;
        margin-bottom: 0;
        padding-bottom: 5px;
      }

      .post-banner h1,
      .page-banner h1 {
        font-size: 18px;
        color: #fff;
        position: absolute;
        margin: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        padding: 30px 15px 0;
        height: 120px;
        box-sizing: border-box;
      }

      .post-banner-desc,
      .page-banner-desc {
        position: absolute;
        margin-top: 55px;
        z-index: 100;
        max-height: 40px;
        padding: 0 15px;
      }

      .post-banner-desc .entry-info,
      .page-banner-desc .entry-info {
        color: #fff;
        font-size: 13px;
        margin: 10px 0 0;
      }

      .post-banner-desc a {
        color: #fff;
        border-bottom: 1px dashed #ffffff;
      }

      .post-banner,
      .page-banner {
        margin-bottom: 15px;
        display: block;
        overflow: hidden;
        transition: all 1s cubic-bezier(0.2, 0.6, 0.4, 1);
      }

      /*.post-banner:hover,
.page-banner {
  transform: translateY(40%);
}*/

      .cat-banner,
      .tag-banner,
      .new-banner,
      .post-banner,
      .page-banner {
        width: 100%;
        height: 120px;
        border-radius: 4px;
        position: relative;
        margin-top: 20px;
      }

      .cat-banner h1,
      .tag-banner h1,
      .new-banner h1 {
        font-size: 18px;
        color: #fff;
        position: absolute;
        margin: 0;
        margin-top: 30px;
        margin-left: 15px;
        background: rgba(0, 0, 0, 0.1);
        padding: 0 10px;
      }

      .cat-banner-desc {
        position: absolute;
        margin-top: 70px;
        z-index: 100;
        color: rgba(0, 0, 0, 0.5);
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5);
        font-size: 13px;
        max-height: 40px;
        overflow: hidden;
        padding: 0 15px;
      }

      .cat-banner-desc p {
        margin: unset;
        display: contents;
      }

      .tag-banner,
      .new-banner {
        height: 100px;
      }

      .tag-banner h1,
      .new-banner h1 {
        margin-top: 35px;
      }

      /* 自适应显示 */
      @media screen and (max-width: 320px) {
        .s-none {
          display: none;
        }
      }

      @media screen and (max-width: 375px) {
        .m-none {
          display: none;
        }
      }

      @media screen and (max-width: 425px) {
        .l-none {
          display: none;
        }
      }

      @media screen and (min-width: 320px) {
        .s-none-b {
          display: none;
        }
      }

      @media screen and (min-width: 375px) {
        .m-none-b {
          display: none;
        }
      }

      @media screen and (min-width: 425px) {
        .l-none-b {
          display: none;
        }
      }

      @-webkit-keyframes fadeInUp {
        0% {
          opacity: 0;
          -webkit-transform: translateY(20px);
          transform: translateY(20px);
        }

        100% {
          opacity: 1;
          -webkit-transform: translateY(0);
          transform: translateY(0);
        }
      }

      @keyframes fadeInUp {
        0% {
          opacity: 0;
          -webkit-transform: translateY(20px);
          -ms-transform: translateY(20px);
          transform: translateY(20px);
        }

        100% {
          opacity: 1;
          -webkit-transform: translateY(0);
          -ms-transform: translateY(0);
          transform: translateY(0);
        }
      }

      .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
      }

      @-webkit-keyframes fadeIn {
        0% {
          opacity: 0;
        }

        100% {
          opacity: 1;
        }
      }

      @keyframes fadeIn {
        0% {
          opacity: 0;
        }

        100% {
          opacity: 1;
        }
      }

      .fadeIn {
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;
      }

      .animated,
      .animated-05 {
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
      }

      .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
      }

      .animated-05 {
        -webkit-animation-duration: 0.5s;
        animation-duration: 0.5s;
      }

      @-webkit-keyframes fadeInDown {
        0% {
          opacity: 0;
          -webkit-transform: translateY(-20px);
          transform: translateY(-20px);
        }

        100% {
          opacity: 1;
          -webkit-transform: translateY(0);
          transform: translateY(0);
        }
      }

      @keyframes fadeInDown {
        0% {
          opacity: 0;
          -webkit-transform: translateY(-20px);
          -ms-transform: translateY(-20px);
          transform: translateY(-20px);
        }

        100% {
          opacity: 1;
          -webkit-transform: translateY(0);
          -ms-transform: translateY(0);
          transform: translateY(0);
        }
      }

      .fadeInDown {
        -webkit-animation-name: fadeInDown;
        animation-name: fadeInDown;
      }
    </style>

  </head>

  <body>
    <noscript>
      <p>访问本站需要浏览器支持（启用）JavaScript :(</p>
    </noscript>
    <div id="loading" class="loading"></div>
    <div id="paper">
      <header class="site-header">
        <div class="fix-width">
          <div class="site-branding">
            <?php
            // 区分首页和非首页的导航标题
            if (is_front_page() && is_home()) : ?>
              <h1 class="site-title">
                <a href="<?php echo blog_url('/'); ?>" rel="home" class="site-title-img-a"><img src="<?php echo blog_theme_url('/assets/img/logo-24.png'); ?>" width="24px" height="24px" /></a>&nbsp;
                <span class="l-none"><a href="<?php echo blog_url('/'); ?>" rel="home"><?php echo blog_title(); ?></a></span>
              </h1>
            <?php
            else :
            ?>
              <p class="site-title">
                <a href="<?php echo blog_url('/'); ?>" rel="home" class="site-title-img-a"><img src="<?php echo blog_theme_url('/assets/img/logo-24.png'); ?>" width="24px" height="24px" /></a>&nbsp;
                <span class="l-none"><a href="<?php echo blog_url('/'); ?>" rel="home"><?php echo blog_title(); ?></a></span>
              </p>
            <?php
            endif;
            ?>
          </div>
          <?php
          //占用太多查询次数，直接写成html
          /*wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'site-menu',
					'depth'          => 1,
					'fallback_cb'    => false,
				) );
				*/
          ?>
          <nav class="menu-1">
            <div class="menu-menu-1-container">
              <ul id="site-menu" class="menu">
                <li><a href="<?php echo blog_url('/dt'); ?>">动态</a></li>
                <li class="more"><a href="#">分类</a>
                  <ul>
                    <li><a href="<?php echo blog_url('/gs'); ?>">孤独说</a></li>
                    <li><a href="<?php echo blog_url('/sh'); ?>">生活圈</a></li>
                    <li><a href="<?php echo blog_url('/cy'); ?>">菜园子</a></li>
                    <li><a href="<?php echo blog_url('/jd'); ?>">宅基地</a></li>
                    <li><a href="<?php echo blog_url('/zj'); ?>">足迹图</a></li>
                    <!--li><a href="<?php echo blog_url('/sd'); ?>">读书单</a></li-->
                    <li><a href="<?php echo blog_url('/tg'); ?>">听歌单</a></li>
                    <li><a href="<?php echo blog_url('/xc'); ?>">相册集</a></li>
                    <li><a href="<?php echo blog_url('/jn'); ?>">纪念册</a></li>
                  </ul>
                </li>
                <li class="more"><a href="#">发现</a>
                  <ul>
                    <li><a href="<?php echo blog_url('/bq'); ?>">标签聚合</a></li>
                    <li><a href="<?php echo blog_url('/yy'); ?>">我的音乐</a></li>
                    <li><a href="<?php echo blog_url('/cj'); ?>">本站插件</a></li>
                    <li><a href="<?php echo blog_url('/rz'); ?>">网站日志</a></li>
                    <li><a href="<?php echo blog_url('/ph'); ?>">读者排行</a></li>
                    <li><a href="<?php echo blog_url('/gd'); ?>">文章归档</a></li>
                    <!--li><a href="<?php echo blog_url('/js'); ?>">日期倒计时</a><li-->
                    <li><a href="<?php echo blog_url('/ss'); ?>">搜索一下</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo blog_url('/ly'); ?>">留言</a></li>
                <li><a href="<?php echo blog_url('/lj'); ?>">邻居</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <div class="clear"></div>
      <div class="site-content" id="site-content">
      <?php } ?>