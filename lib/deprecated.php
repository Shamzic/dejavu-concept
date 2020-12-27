<?php
/**
 * Deprecated functions
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Schema type
 */
function ascend_html_tag_schema() {
	$schema = 'http://schema.org/';

	if ( is_singular( 'post' ) ) {
		$type = 'WebPage';
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo apply_filters( 'ascend_html_schema', 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"' );
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * WP Body Open Pre WP 5.2 support.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}