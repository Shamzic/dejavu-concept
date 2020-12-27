 <?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

$ascend = ascend_get_options();
if ( version_compare( WC_VERSION, '3.3', '>' ) ) {
	$product_columns =  wc_get_loop_prop( 'columns' );

} else {
	global $woocommerce_loop;
	if ( empty( $woocommerce_loop['columns'] ) ) {
	 	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}
	$product_columns = $woocommerce_loop['columns'];
}

if ( ascend_display_sidebar() ) {
	$columns = "shopcolumn".$product_columns." shopsidebarwidth"; 
} else {
	$columns = "shopcolumn".$product_columns." shopfullwidth"; 
}
if ( is_cart() ) {
	$columns = "shopcolumn-cart".$product_columns." shopfullwidth";
}
if ( isset( $ascend['product_img_resize'] ) && 0 == $ascend['product_img_resize'] ) { 
	$isoclass = 'init-masonry';
} else { 
	$isoclass = 'init-masonry-intrinsic';
}
if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' && isset( $ascend['shop_rating'] ) && $ascend['shop_rating'] != '0' ) {
	$ratingclass = 'kt-show-rating';
} else {
	$ratingclass = 'kt-hide-rating';
}
?>
<ul class="products kad_product_wrapper rowtight <?php echo esc_attr($columns); ?> <?php echo esc_attr($isoclass); ?> <?php echo esc_attr($ratingclass); ?> reinit-masonry" data-masonry-selector=".kad_product" data-masonry-style="masonry">