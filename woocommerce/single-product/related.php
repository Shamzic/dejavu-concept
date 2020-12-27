<?php
/**
 * Related Products
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( $related_products ) :

	$ascend = ascend_get_options();
	if ( ! empty( $ascend['related_item_column'] ) ) {
		$product_related_column = $ascend['related_item_column'];
	} else {
		$product_related_column = '4';
	}

	$rpc = array();
	if ( $product_related_column == '2' ) {
		$rpc = ascend_carousel_columns( '2' );
	} else if ( $product_related_column == '3' ) {
		$rpc = ascend_carousel_columns( '3' );
	} else if ( $product_related_column == '6' ) {
		$rpc = ascend_carousel_columns( '6' );
	} else if ( $product_related_column == '5' ) {
		$rpc = ascend_carousel_columns( '5' );
	} else {
		$rpc = ascend_carousel_columns( '4' );
	}
	$rpc = apply_filters( 'ascend_related_products_columns', $rpc );


	if ( ! empty( $ascend['related_products_text'] ) ) {
		$relatedtext = $ascend['related_products_text'];
	} else {
		$relatedtext = __( 'Related Products', 'ascend' );
	}
	$heading = apply_filters( 'woocommerce_product_related_products_heading', $relatedtext );
	?>

	<div class="related products carousel_outerrim">
		<h3 class="kt-title"><span><?php echo esc_html( $heading ); ?></span></h3>
		<div class="related-carouselcontainer row-margin-small">
			<div id="related-product-carousel" class="products slick-slider product_related_carousel kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="1" data-slider-auto="true" data-slider-speed="9000" data-slider-xxl="<?php echo esc_attr( $rpc['xxl'] ); ?>" data-slider-xl="<?php echo esc_attr( $rpc['xl'] ); ?>" data-slider-md="<?php echo esc_attr( $rpc['md'] ); ?>" data-slider-sm="<?php echo esc_attr( $rpc['sm'] ); ?>" data-slider-xs="<?php echo esc_attr( $rpc['xs'] ); ?>" data-slider-ss="<?php echo esc_attr( $rpc['ss'] ); ?>">

					<?php foreach ( $related_products as $related_product ) : ?>

						<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

							wc_get_template_part( 'content', 'product' );
						?>

					<?php endforeach; ?>

			</div>
		</div>
	</div>
	<?php
endif;

wp_reset_postdata();
