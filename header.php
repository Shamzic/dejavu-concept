<?php
/**
 * DO NOT ADD SCRIPTS HERE (USE THEME OPTIONS)
 *
 * Note: wp_head(); is called in the head template.
 *
 * @package Ascend Theme
 */

/* Load Scripts meta */
get_template_part( 'templates/head' );
?>
<body <?php body_class(); ?>>
	<?php
	/**
	 * Hook for adding Google tag Manager
	 */
	do_action( 'ascend_after_body_open' );

	wp_body_open();
	?>
	<div id="wrapper" class="container">
	<?php
		do_action( 'ascend_beforeheader' );

			do_action( 'ascend_header' );

		do_action( 'ascend_header_after' );
	?>

	<div id="inner-wrap" class="wrap clearfix contentclass hfeed" role="document">
	<?php
	/**
	 * Hook for top of inner wrap.
	 */
	do_action( 'kt_content_top' );