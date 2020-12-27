<?php
/**
 * Add Facet Support.
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Check for FacetWP Support
 */
function ascend_add_facetwp_support() {
	if ( class_exists( 'FacetWP' ) ) {
		add_filter( 'ascend_main_content_classes', 'ascend_add_facetwp_template_class' );
	}
}
add_action( 'init', 'ascend_add_facetwp_support' );

/**
 * Add FacetWP Template support.
 *
 * @param string $class the main class string.
 */
function ascend_add_facetwp_template_class( $class ) {
	$class .= ' facetwp-template';
	return $class;
}

