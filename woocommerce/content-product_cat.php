<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;
$ascend = ascend_get_options();
	if(is_shop() || is_product_category() || is_product_tag()) {
		if(isset($ascend['product_cat_layout']) && !empty($ascend['product_cat_layout'])) {
			$product_cat_column = $ascend['product_cat_layout'];
		} else {
			$product_cat_column = 4;
		}
		$woocommerce_loop['columns'] = $product_cat_column;
	} else {
		if ( empty( $woocommerce_loop['columns'] ) ) {
			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
		}
		$product_cat_column = $woocommerce_loop['columns'];
	}

	if ($product_cat_column == '1') {
		$itemsize = 'col-md-12 col-sm-12 col-xs-12 col-ss-12';
	} else if ($product_cat_column == '2') {
 		$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
 	} else if ($product_cat_column == '3'){ 
 		$itemsize = 'col-xxl-3 col-xl-3 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
 	} else if ($product_cat_column == '6'){
 		$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6'; 
 	} else if ($product_cat_column == '5'){ 
 		$itemsize = 'col-xxl-2 col-xl-25 col-md-25 col-sm-3 col-xs-4 col-ss-6';
 	} else {
 		$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-6'; 
 	}


	?> 

<div class="<?php echo esc_attr($itemsize); ?> kad_product">
	<div <?php wc_product_cat_class('product-category product_item grid_item', $category ); ?>>

	<?php 
		/**
		 * woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category );

		/**
		 * woocommerce_before_subcategory_title hook.
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );

	    /**
		 * woocommerce_shop_loop_subcategory_title hook.
		 *
		 * @hooked woocommerce_template_loop_category_title - 10
		 */
		do_action( 'woocommerce_shop_loop_subcategory_title', $category );

		/**
		 * woocommerce_after_subcategory_title hook.
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );

		/**
		 * woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category ); ?>

	</div>
</div>