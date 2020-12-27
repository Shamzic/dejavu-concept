<?php
/**
 * Initial setup functions
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Initial setup
 */
function ascend_setup() {
	global $pagenow;
	$ascend = ascend_get_options();
	if ( isset( $ascend['above_header_style'] ) && 'center' === $ascend['above_header_style'] && isset( $ascend['site_layout'] ) && 'above' === $ascend['site_layout'] ) {
		register_nav_menus(array(
			'left_navigation'      => __( 'Left Navigation', 'ascend' ),
			'right_navigation'     => __( 'Right Navigation', 'ascend' ),
			'secondary_navigation' => __( 'Secondary Navigation', 'ascend' ),
			'mobile_navigation'    => __( 'Mobile Navigation', 'ascend' ),
			'topbar_navigation'    => __( 'Topbar Navigation', 'ascend' ),
			'footer_navigation'    => __( 'Footer Navigation', 'ascend' ),
		));
	} else {
		register_nav_menus(array(
			'primary_navigation'   => __( 'Primary Navigation', 'ascend' ),
			'secondary_navigation' => __( 'Secondary Navigation', 'ascend' ),
			'mobile_navigation'    => __( 'Mobile Navigation', 'ascend' ),
			'topbar_navigation'    => __( 'Topbar Navigation', 'ascend' ),
			'footer_navigation'    => __( 'Footer Navigation', 'ascend' ),
		));
	}

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'quote' ) );
	add_theme_support( 'automatic-feed-links' );
	add_editor_style( '/assets/css/kt-editor-style.css' );
	add_post_type_support( 'attachment', 'page-attributes' );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'custom-logo', array(
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'custom-background' );
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	define( 'ASCEND_VERSION', '1.4.6' );
	// Square.
	add_image_size( 'ascend-600x600', 600, 600, true );
	// portrait.
	add_image_size( 'ascend-540x620', 540, 620, true );
	// landscape.
	add_image_size( 'ascend-720x480', 720, 480, true );
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary Color', 'ascend' ),
			'slug'  => 'ascend-primary',
			'color' => ( isset( $ascend['primary_color'] ) && ! empty( $ascend['primary_color'] ) ? $ascend['primary_color'] : '#16A085' ),
		),
		array(
			'name'  => esc_html__( 'Lighter Primary Color', 'ascend' ),
			'slug'  => 'ascend-primary-light',
			'color' => ( isset( $ascend['primary_color'] ) && ! empty( $ascend['primary_color'] ) ? ascend_adjust_brightness( $ascend['primary_color'], 20 ) : ascend_adjust_brightness( '#16A085', 20 ) ),
		),
		array(
			'name'  => esc_html__( 'Very light gray', 'ascend' ),
			'slug'  => 'very-light-gray',
			'color' => '#eee',
		),
		array(
			'name'  => esc_html__( 'White', 'ascend' ),
			'slug'  => 'white',
			'color' => '#fff',
		),
		array(
			'name'  => esc_html__( 'Very dark gray', 'ascend' ),
			'slug'  => 'very-dark-gray',
			'color' => '#444',
		),
		array(
			'name'  => esc_html__( 'Black', 'ascend' ),
			'slug'  => 'black',
			'color' => '#000',
		),
	) );
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'ascend_setup' );


/**
 * Page titles
 */
function ascend_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			$title = get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			$title = __( 'Latest Posts', 'ascend' );
		}
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	} elseif ( is_search() ) {
		/* translators: %s: search term */
		$title = sprintf( __( 'Search Results for %s', 'ascend' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = __('Not Found', 'ascend');
	} else {
		$title = get_the_title();
  	}
	return apply_filters( 'ascend_title', $title );
}
add_filter( 'get_the_archive_title', 'ascend_filter_archive_title' );
function ascend_filter_archive_title( $title ){
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		/* translators: %s: author name */
		$title = sprintf( __( 'Author: %s', 'ascend' ), get_the_author() );
	} elseif ( is_day() ) {
		/* translators: %s: day */
		$title = sprintf( __( 'Day: %s', 'ascend' ), get_the_date() );
	} elseif ( is_month() ) {
		/* translators: %s: month */
		$title = sprintf( __( 'Month: %s', 'ascend' ), get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		/* translators: %s: year */
		$title = sprintf( __( 'Year: %s', 'ascend' ), get_the_date( 'Y' ) );
	} elseif ( is_tax( array( 'product_cat', 'product_tag' ) ) ) {
		$title = single_term_title( '', false );
	} elseif ( $term ) {
		$title = $term->name;
	} elseif ( function_exists( 'is_bbpress' ) ) {
		if ( is_bbpress() ) {
			$title = bbp_title();
		}
	} elseif ( function_exists( 'tribe_is_month') ) {
		if( tribe_is_month() ) {
			$title = tribe_get_event_label_plural();
		}
	}
	return $title;
}

require_once trailingslashit( get_template_directory() ) . 'lib/schema-functions.php'; // Add Schema Functions.
require_once trailingslashit( get_template_directory() ) . 'lib/deprecated.php'; // Add Deprecated Functions.
require_once trailingslashit( get_template_directory() ) . 'lib/plugin-support/facet-wp.php'; // Add Facet Support.
require_once trailingslashit( get_template_directory() ) . 'lib/plugin-support/lifterlms.php'; // Add Lifter Support.
