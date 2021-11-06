<?php
/*
 * Template Name: 邮箱订阅
 *
*/
get_template_part( 'header' );	
?>
<header>
<h1 class="entry-title"><?php single_post_title(); ?></h1>
</header>
<form id="contant-form" class="form" name="contact-form">
  <div class="form_description">
    <p>请输入必要事项后，进入确认画面。</p>
  </div>
  <fieldset class="form_group">
    <legend class="form_group-header">
      <span class="form_group-label">订阅方式</span>
    </legend>
    <div class="form_group-content">
      <ul class="form_group-list">
        <li class="form_group-list-item">
          <label class="radio" onclick="display.none('type-rss');display.block('type-mail')">
            <input class="radio_input" type="radio" name="type" value="1" checked="true">
            <span class="radio_text">邮箱</span>
          </label>
        </li>
        <li class="form_group-list-item">
          <label class="radio" onclick="display.none('type-mail');display.block('type-rss')">
            <input class="radio_input" type="radio" name="type" value="2">
            <span class="radio_text">RSS</span>
          </label>
        </li>
      </ul>
    </div>
  </fieldset>
  <div id="type-rss" class="none">
  <fieldset class="form_group">
    <legend class="form_group-header">
	  <span class="form_group-label">RSS订阅</span>
    </legend>
	<div class="form_group-content">
		  本站RSS订阅地址：<a href="<?php echo blog_url('/feed')?>" target="_blank"><?php echo blog_url('/feed')?></a><br/>
		  RSS订阅教程：<a href="//zhuanlan.zhihu.com/p/100086971" target="_blank" rel="nofollow">查看教程</a>
	  </div>
  </fieldset>
  </div>
  <div id="type-mail">
  <fieldset class="form_group">
    <legend class="form_group-header">
      <span class="form_group-label">订阅邮箱</span>
    </legend>
    <div class="form_group-content">
      <div class="form_input">
          <input id="email" class="email_body" name="email" placeholder="example@example.com"></input>
    </div>
	</fieldset>
  <fieldset class="form_group">
    <legend class="form_group-header">
		<span class="form_group-label">订阅分类</span>
    </legend>
    <div class="form_group-content">
	<ul class="form_group-list">
		  <?php
			global $wpdb;
			  $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
			  $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
			  $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
			  $request .= " ORDER BY term_id asc";
			  $categorys = $wpdb->get_results($request);
			  foreach ($categorys as $category) {
				  $cat_name = $category->name;
				  $cat_id=$category->term_id;
				  if($cat_id!=1){
				  ?>
				  <li class="form_group-list-item">
				  <label class="checkbox">
					<input class="checkbox_input" type="checkbox" name="cat" value="<?php echo $cat_id; ?>" checked="true">
					<span class="checkbox_text"><?php echo $cat_name; ?></span>
				  </label>
				</li>
				  <?php 
			  }}
			?>
      </ul>
    </div>
  </fieldset>
  <fieldset class="form_group">
    <legend class="form_group-header">
      <span class="form_group-label">订阅留言</span>
    </legend>
    <div class="form_group-content">
      <div class="form_textarea">
          <textarea id="message" class="textarea_body" name="message" placeholder="选填"></textarea>
    </div>
	</fieldset>

	<div class="form_group">
    <div class="form_group-content">
	<ul class="form_group-list">
        <li class="form_group-list-item">
          <label class="checkbox">
            <input class="checkbox_input" type="checkbox" name="cat" value="0">
            <span class="checkbox_text"><a href="">隐私政策</a>，</span>
          </label>
        </li>
	</ul>
	</div>
	</div>
  <div class="form_submit">
    <button class="button" type="submit" aria-disabled="true">发送信封</button>
  </div>
</form>

<script  type="text/javascript">
loadScript("/assets/css/subscribe.min.css","css","subscribe-css","head");
try{}
catch(err){loadScript("/assets/js/search.min.js","js","search-js","body");
document.getElementById("search-js").onload=function(){}};
</script>
<?php
get_template_part( 'footer' );
?>
