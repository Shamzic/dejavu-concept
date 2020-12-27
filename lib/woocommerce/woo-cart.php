<?php 

 /**
   * Custom Woocommerce Account Functions 2.6
   */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

add_action('woocommerce_before_cart', 'ascend_woo_cart_form_wrap_before');
function ascend_woo_cart_form_wrap_before() {
    echo '<div class="kt-woo-cart-form-wrap">';
}

add_action('woocommerce_after_cart', 'ascend_woo_cart_form_wrap_after');
function ascend_woo_cart_form_wrap_after() {
    echo '</div>';
}

add_action('woocommerce_before_cart_table', 'ascend_woo_cart_summary_title');
function ascend_woo_cart_summary_title() {
    echo '<div class="cart-summary"><h2>'.__('Cart Summary', 'ascend').'</h2></div>';
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); 
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' ); 
