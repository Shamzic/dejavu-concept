<?php
/**
 * Single Content
 *
 * @package Ascend Theme
 */

global $post, $ascend_feat_width, $ascend_has_sidebar;

if ( ascend_display_sidebar() ) {
	$ascend_feat_width  = apply_filters( 'ascend_blog_full_image_width_sidebar', ascend_post_sidebar_image_width() );
	$ascend_has_sidebar = true;
} else {
	$ascend_feat_width  = apply_filters( 'ascend_blog_full_image_width', ascend_post_image_width() );
	$ascend_has_sidebar = false;
}
$postclass          = array( 'postclass' );
$ascend_headcontent = ascend_get_post_head_content();
if ( 'none' !== $ascend_headcontent ) {
	$postclass[] = 'kt_post_header_content-' . $ascend_headcontent;
} else {
	$postclass[] = 'kt_no_post_header_content';
}
while ( have_posts() ) :
	the_post();

	do_action( 'ascend_single_post_before' );

	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( $postclass ); ?>>
			<?php
			/**
			 * Ascend Single Post Before Header
			 *
			 * @hooked ascend_single_post_headcontent - 10
			 * @hooked ascend_post_header_meta_categories - 20
			 */
			do_action( 'ascend_single_post_before_header' );
			?>
				<header>
				<?php
				/**
				 * Ascend Single Post Header
				 *
				 * @hooked ascend_post_header_title - 20
				 * @hooked ascend_single_post_meta_date_author - 30
				 */
				do_action( 'ascend_single_post_header' );
				?>
				</header>
				<div class="entry-content clearfix" itemprop="description articleBody">
					<?php
					do_action( 'ascend_single_post_content_before' );

						the_content();

					do_action( 'ascend_single_post_content_after' );
					?>
				</div>
				<footer class="single-footer">
				<?php
				/**
				 * Ascend Single Post Footer
				 *
				 * @hooked ascend_post_footer_pagination - 10
				 * @hooked ascend_post_footer_tags - 20
				 * @hooked ascend_post_footer_meta - 30
				 * @hooked ascend_post_nav - 40
				 */
				do_action( 'ascend_single_post_footer' );
				?>
				</footer>
			</article>
			<?php
			/**
			 * Ascend Single Post After Footer
			 *
			 * @hooked ascend_post_authorbox - 20
			 * @hooked ascend_post_bottom_carousel - 30
			 * @hooked ascend_post_comments - 40
			 */
			do_action( 'ascend_single_post_after' );

			endwhile;

	do_action( 'ascend_single_post_end' );
