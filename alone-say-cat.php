<?php 
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-05-30 15:33:58 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-09-25 17:51:10
 */
?>

    <div class="say-see"">
        <ul>
            <?php
                if (have_posts()) :
	                while (have_posts()) :
		                the_post();
            ?>
             <li class="say-see-list fadeInUp animated">
                <div class="say-see-time">
                    <div class="say-see-time-year"><?php echo get_the_date('Y年'); ?></div>
                    <div class="say-see-time-day"><?php echo get_the_date('d'); ?></div>
                    <div class="say-see-time-month"><?php echo get_the_date('m月'); ?></div>
                </div>
                <div class="say-see-list-con">
                <?php echo strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_excerpt ?: $post->post_content))); ?>
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

<script type="text/javascript">
loadScript("/assets/css/alone-say.min.css","css","alone-say-css","head");
</script>