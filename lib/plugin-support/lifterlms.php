<?php
/**
 * Lifter LMS support
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Declare explicit theme support for LifterLMS course and lesson sidebars
 *
 * @return   void
 */
function ascend_llms_theme_support() {
	add_theme_support( 'lifterlms-sidebars' );
}
add_action( 'after_setup_theme', 'ascend_llms_theme_support' );


/**
 * LifterLMS Remove title from inside content.
 *
 * @param boolean $enable show the title.
 */
function ascend_lifterlms_remove_inner_title( $enable ) {
	return false;
}
add_filter( 'lifterlms_show_page_title', 'ascend_lifterlms_remove_inner_title' );

/**
 * Display LifterLMS Course and Lesson sidebars
 * on courses and lessons in place of the sidebar returned by
 * this function
 *
 * @param    string $id    default sidebar id (an empty string).
 * @return   string
 */
function ascend_llms_sidebar_function( $id ) {
	$my_sidebar_id = 'primary-sidebar'; // replace this with your theme's sidebar ID.
	return $my_sidebar_id;
}
add_filter( 'llms_get_theme_default_sidebar', 'ascend_llms_sidebar_function' );

remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar', 10 );
/**
 * LifterLMS support
 */
function ascend_lifterlms_output_content_wrapper() {
	/**
	 * Ascend Page Title
	 *
	 * @hooked ascend_page_title - 20
	 */
	do_action( 'kadence_page_title_container' );
	?>
	<div id="content" class="container <?php echo esc_attr( ascend_container_class() ); ?>">
		<div class="row">
			<div class="main <?php echo esc_attr( ascend_main_class() ); ?>" id="ktmain" role="main">
	<?php
}
/**
 * LifterLMS support
 */
function ascend_lifterlms_output_content_wrapper_end() {
	?>
			</div><!-- /.main -->
			<?php
			/**
			 * Sidebar
			 */
			if ( ascend_display_sidebar() ) :
				get_sidebar();
			endif;
			?>
		</div><!-- /.row-->
	</div><!-- /.content -->
	<?php
}
remove_action( 'lifterlms_before_main_content', 'lifterlms_output_content_wrapper', 10 );
remove_action( 'lifterlms_after_main_content', 'lifterlms_output_content_wrapper_end', 10 );
add_action( 'lifterlms_before_main_content', 'ascend_lifterlms_output_content_wrapper', 10 );
add_action( 'lifterlms_after_main_content', 'ascend_lifterlms_output_content_wrapper_end', 10 );

