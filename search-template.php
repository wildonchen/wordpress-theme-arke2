<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-06-20 14:26:14 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-09-26 22:32:31
 */
/*

Template Name: 搜索一下

*/
get_template_part( 'header' );
?>
<h2>你想搜索什么...</h2>
<div class="entry-content fadeIn animated">
    <div class="search-page">
        <?php get_search_form(); ?>
    </div>
</div>
<?php

$key = wp_specialchars($s, 1);
echo '<script type="text/javascript">try{searchKey()}catch(err){loadScript("/assets/js/search.min.js","js","search-js","body");document.getElementById("search-js").onload=function(){searchKey("'.$key.'")}}loadScript("/assets/css/search-page.min.css","css","search-page-css","head")</script>';
get_template_part( 'footer' );
?>