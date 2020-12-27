<?php
/**
 * Loop Rating
 *
 * @author WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( function_exists( 'wc_review_ratings_enabled' ) ) {
	if ( ! wc_review_ratings_enabled() ) {
		return;
	}
} else if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' ) {
	return;
}
$ascend = ascend_get_options();
if ( ! isset( $ascend['shop_rating'] ) || '0' != $ascend['shop_rating'] ) {
	$rating_html = wc_get_rating_html( $product->get_average_rating() );

	if ( $rating_html ) {
		echo '<a href="' . esc_url( get_the_permalink() ) . '">' . $rating_html . '</a>';
	} else {
		echo '<a href="' . esc_url( get_the_permalink() ) . '"><span class="kt-notrated">' . esc_html__( 'not rated', 'ascend' ) . '</span></a>';
	}
}
