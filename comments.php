<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link       https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Arke
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area wow fadeIn">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( esc_html_x( 'One Comment', 'comments title', 'arke' ), get_the_title() );
			} else {
				printf(
					esc_html( _nx(
						'%1$s Comment;',
						'%1$s Comments',
						$comments_number,
						'comments title',
						'arke'
					) ),
					esc_html( number_format_i18n( $comments_number ) ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments(array('reply_text' => '<i class="icon-reply"></i>')); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav id="comment-nav-below" class="navigation comment-navigation clear">
				<div class="nav-links">

					<div class="nav-previous">
						<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'arke' ) ); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'arke' ) ); ?>
					</div>

				</div>
			</nav>

		<?php endif; ?>

		<?php if ( ! comments_open() ) :?>

			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'arke' ); ?>
			</p>

		<?php
		endif;

	endif; 

	comment_form();
	?>

</div>
