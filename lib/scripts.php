<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and stylesheets
 */
function ascend_scripts() {
	$ascend = ascend_get_options();

	wp_enqueue_style( 'ascend_main', get_template_directory_uri() . '/assets/css/ascend.css', false, ASCEND_VERSION );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'ascend_woo', get_template_directory_uri() . '/assets/css/ascend_woo.css', false, ASCEND_VERSION );
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'ascend_rtl', get_template_directory_uri() . '/assets/css/rtl-min.css', false, ASCEND_VERSION );
	}
	if ( is_child_theme() ) {
		$child_theme   = wp_get_theme();
		$child_version = $child_theme->get( 'Version' );
		wp_enqueue_style( 'ascend_child', get_stylesheet_uri(), false, $child_version );
	}

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/min/bootstrap-min.js', array( 'jquery' ), ASCEND_VERSION, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/min/slick-min.js', array( 'jquery' ), ASCEND_VERSION, true );
	wp_enqueue_script( 'ascend_plugins', get_template_directory_uri() . '/assets/js/min/ascend-plugins-min.js', array( 'jquery', 'hoverIntent' ), ASCEND_VERSION, true );
	wp_enqueue_script( 'kadence-sticky', get_template_directory_uri() . '/assets/js/min/ascend_sticky-min.js', array( 'jquery' ), ASCEND_VERSION, true );
	wp_enqueue_script( 'ascend_main', get_template_directory_uri() . '/assets/js/min/ascend-main-min.js', array( 'jquery', 'hoverIntent', 'kadence-sticky', 'ascend_plugins', 'masonry' ), ASCEND_VERSION, true );

	if ( class_exists( 'woocommerce' ) ) {
		if ( is_product() ) {
			wp_enqueue_script( 'ascend-wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/min/kt-add-to-cart-variation-min.js', array( 'jquery' ), ASCEND_VERSION, true );
		}
		if ( isset( $ascend['product_quantity_input'] ) && 1 == $ascend['product_quantity_input'] ) {
			wp_enqueue_script( 'wcqi-js', get_template_directory_uri() . '/assets/js/min/wc-quantity-increment-min.js', array( 'jquery' ), ASCEND_VERSION, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ascend_scripts', 100 );

/**
 * Handles JavaScript detection.
 */
function ascend_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ascend_javascript_detection', 0 );

/**
 * Handles Lightbox item translations.
 */
function ascend_lightbox_text() {
	$ascend = ascend_get_options();
	if ( ! empty( $ascend['lightbox_of_text'] ) ) {
		$of_text = $ascend['lightbox_of_text'];
	} else {
		$of_text = __( 'of', 'ascend' );
	}
	if ( ! empty( $ascend['lightbox_error_text'] ) ) {
		$error_text = $ascend['lightbox_error_text'];
	} else {
		$error_text = __( 'The image could not be loaded.', 'ascend' );
	}
	echo '<script type="text/javascript">var light_error = "' . esc_attr( $error_text ) . '", light_of = "%curr% ' . esc_attr( $of_text ) . ' %total%";</script>';
}
add_action( 'wp_head', 'ascend_lightbox_text' );

/**
 * Add Respond.js for IE8 support of media queries
 */
function ascend_ie_support_scripts() {
	wp_enqueue_script( 'ascend-html5shiv', get_template_directory_uri() . '/assets/js/vendor/html5shiv.min.js', array(), ASCEND_VERSION, false );
	wp_script_add_data( 'ascend-html5shiv', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'ascend-respond', get_template_directory_uri() . '/assets/js/vendor/respond.min.js', array(), ASCEND_VERSION, false );
	wp_script_add_data( 'ascend-respond', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'ascend_ie_fallback', get_template_directory_uri() . '/assets/css/ie_fallback.css', false, ASCEND_VERSION );
	wp_style_add_data( 'ascend_ie_fallback', 'conditional', 'lt IE' );
}
add_action( 'wp_enqueue_scripts', 'ascend_ie_support_scripts' );
