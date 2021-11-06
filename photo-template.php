<?php
/*

Template Name: 文章图片

*/
get_template_part( 'header' );
?>
<style type="text/css">
/*! html */
.photo-title{
    overflow: hidden;
text-overflow:ellipsis;
white-space: nowrap;
}
.photo img{
        width: 100%;
        border-radius: 4px;
}
/*栅格*/
.frame {
  margin: 20px auto 10px;
    width: 102%;
    margin-left: -1%;}
  .frame:after {
    content: "";
    display: table;
    clear: both; }

[class*='bit-'] {
  float: left;
  padding: 1%; }
.bit-4 {
  width: 23%; }

@media (max-width: 30em) {
  .bit-4 {
    width: 48%; }
@media (min-width: 30em) and (max-width: 50em) {
  .bit-4{
    width: 48%; }

@media (min-width: 50em) and (max-width: 68.75em) {
  .bit-4 {
    width: 48%; } }

</style>
                <header>
                    <h2 class="entry-title"><?php single_post_title(); ?></h2>
                </header>


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('&paged=' . $paged);?>
<div class="entry-content"><ul class="photo frame" >
<?php
while (have_posts() ) : the_post();
    if(hui_get_thumbnail(false,true)){ ?>

<?php echo hui_get_thumbnail(false,true);?>

<?php }
endwhile;
echo '</ul></div>';
pagenavi();wp_reset_query(); ?>

<div class="clear"></div>

<?php get_template_part( 'footer' );?>
