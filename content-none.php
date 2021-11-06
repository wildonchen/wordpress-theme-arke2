<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Arke
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<section class="no-results not-found fadeIn animated">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'arke' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				/* translators: %s: link to new post admin screen */
				printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'arke' ), array(
					'a' => array(
						'href' => array(),
					),
				) ), esc_url( admin_url( 'post-new.php' ) ) );
				?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php
				esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'arke' );
				?>
			</p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p>
				<?php
				esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'arke' );
				?>
			</p>

			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
<?php
$key = wp_specialchars($s, 1);
echo '<script>try{searchKey()}
catch(err){loadScript("'. blog_theme_url('/assets/js/search.min.js') .'","js","search-js","body");
document.getElementById("search-js").onload=function(){searchKey("'.$key.'")}}';
echo '</script>';
?>