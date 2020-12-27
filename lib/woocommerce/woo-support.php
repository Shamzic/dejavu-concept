<?php
/**
 * Woocommerce Support.
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Add theme supports WooCommerce
 */
function ascend_woocommerce_support() {
	add_theme_support( 'woocommerce' );

	if ( class_exists( 'woocommerce' ) ) {
		$ascend = ascend_get_options();

		if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['product_gallery_zoom'] ) && 1 == $ascend['product_gallery_zoom'] ) {
				add_theme_support( 'wc-product-gallery-zoom' );
			}
			if ( isset( $ascend['product_gallery_slider'] ) && 1 == $ascend['product_gallery_slider'] ) {
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

		// Disable WooCommerce Lightbox if theme lightbox enabled.
		if ( get_option( 'woocommerce_enable_lightbox' ) == true ) {
			if ( isset( $ascend['kadence_themes_lightbox'] ) && 0 == $ascend['kadence_themes_lightbox'] ) {
				update_option( 'woocommerce_enable_lightbox', false );
			}
		}

		/**
		 * Add Woocommerce Notices.
		 */
		function ascend_wc_print_notices() {
			if ( ! is_shop() && ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
				echo '<div class="container kt-woo-messages-none-woo-pages">';
					echo do_shortcode( '[woocommerce_messages]' );
				echo '</div>';
			}
		}
		add_action( 'ascend_archive_title_container', 'ascend_wc_print_notices', 40 );
		add_action( 'ascend_page_title_container', 'ascend_wc_print_notices', 40 );
		add_action( 'ascend_post_header', 'ascend_wc_print_notices', 40 );
		add_action( 'ascend_portfolio_header', 'ascend_wc_print_notices', 40 );
		add_action( 'ascend_front_page_title_container', 'ascend_wc_print_notices', 40 );

		/**
		 * Add Woocommerce Notices.
		 *
		 * @param array $fragments the cart frag.
		 */
		function ascend_get_refreshed_fragments( $fragments ) {
			// Get mini cart.
			ob_start();

			woocommerce_mini_cart();

			$mini_cart = ob_get_clean();

			// Fragments and mini cart are returned.
			$fragments['li.kt-mini-cart-refreash'] = '<li class="kt-mini-cart-refreash">' . $mini_cart . '</li>';

			return $fragments;

		}
		if ( ( isset( $ascend['mobile_header_cart'] ) && ( 'right' === $ascend['mobile_header_cart'] || 'left' === $ascend['mobile_header_cart'] ) ) || ( isset( $ascend['header_extras'] ) && isset( $ascend['header_extras']['cart'] ) && '1' === $ascend['header_extras']['cart'] ) || ( isset( $ascend['topbar_cart'] ) && 'right' === $ascend['topbar_cart'] ) || ( isset( $ascend['topbar_cart'] ) && 'left' === $ascend['topbar_cart'] ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', 'ascend_get_refreshed_fragments' );
		}

		if ( ( isset( $ascend['header_extras'] ) && isset( $ascend['header_extras']['cart'] ) && '1' === $ascend['header_extras']['cart'] ) || ( isset( $ascend['mobile_header_cart'] ) && 'left' === $ascend['mobile_header_cart'] ) || ( isset( $ascend['mobile_header_cart'] ) && 'right' === $ascend['mobile_header_cart'] ) || ( isset( $ascend['topbar_cart'] ) && 'right' === $ascend['topbar_cart'] ) || ( isset( $ascend['topbar_cart'] ) && 'left' === $ascend['topbar_cart'] ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', 'ascend_get_refreshed_fragments_number' );
		}
		/**
		 * Refresh the cart for ajax adds.
		 *
		 * @param object $fragments the cart object.
		 */
		function ascend_get_refreshed_fragments_number( $fragments ) {
			// Get mini cart.
			ob_start();

			?><span class="kt-cart-total"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span> <?php

			$fragments['span.kt-cart-total'] = ob_get_clean();

			return $fragments;

		}
	}

}
add_action( 'after_setup_theme', 'ascend_woocommerce_support' );
