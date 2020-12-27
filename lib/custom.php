<?php
/**
 * Custom functions
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Hex to RGB
 *
 * @param string $hex string hex code.
 */
function ascend_hex2rgb( $hex ) {
	$hex = str_replace( '#', '', $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb;
}

/**
 * Hex adjust brightness
 *
 * @param string $hex string hex code.
 * @param int    $steps adjustment steps.
 */
function ascend_adjust_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter.
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string.
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B.
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal.
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color.
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code.
	}

	return $return;
}

/**
 * Get Primary Term
 *
 * @param string $taxonomy string term name.
 * @param string $post_id string post id.
 */
function ascend_get_taxonomy_main( $taxonomy, $post_id ) {
	$main_term = '';
	$terms     = wp_get_post_terms(
		$post_id,
		$taxonomy,
		array(
			'orderby' => 'parent',
			'order'   => 'DESC',
		)
	);
	if ( $terms && ! is_wp_error( $terms ) ) {
		if ( is_array( $terms ) ) {
			$main_term = $terms[0];
		}
	}
	return $main_term;
}

/**
 * Get Primary Term
 *
 * @param string $post_id string post id.
 * @param string $term string term name.
 */
function ascend_get_primary_term( $post_id, $term ) {
	$main_term = '';
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		$wpseo_term = new WPSEO_Primary_Term( $term, $post_id );
		$wpseo_term = $wpseo_term->get_primary_term();
		$wpseo_term = get_term( $wpseo_term );
		if ( is_wp_error( $wpseo_term ) ) {
			$main_term = ascend_get_taxonomy_main( $term, $post_id );
		} else {
			$main_term = $wpseo_term;
		}
	} elseif ( class_exists( 'RankMath' ) ) {
		$wpseo_term = get_post_meta( $post_id, 'rank_math_primary_category', true );
		if ( $wpseo_term ) {
			$wpseo_term = get_term( $wpseo_term );
			if ( is_wp_error( $wpseo_term ) ) {
				$main_term = ascend_get_taxonomy_main( $term, $post_id );
			} else {
				$main_term = $wpseo_term;
			}
		} else {
			$main_term = ascend_get_taxonomy_main( $term, $post_id );
		}
	} else {
		$main_term = ascend_get_taxonomy_main( $term, $post_id );
	}

	return $main_term;
}
