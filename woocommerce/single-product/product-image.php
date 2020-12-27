<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$ascend = ascend_get_options();
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title      = get_post_field( 'post_excerpt', $post_thumbnail_id );
if(!empty($image_title)) {
	$light_title  = $image_title;
} else {
	$light_title  = get_the_title($post_thumbnail_id);
}
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'kad-light-gallery',
) );
if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
	if(isset($ascend['product_gallery_slider']) && 1 == $ascend['product_gallery_slider']) {
		$galleryslider = 'woo_product_slider_enabled';
		$galslider = true;
	} else {
		$galleryslider = 'woo_product_slider_disabled';
		$galslider = false;
	}
	if(isset($ascend['product_gallery_zoom']) && 1 == $ascend['product_gallery_zoom']) {
		$galleryzoom = 'woo_product_zoom_enabled';
		$galzoom = true;
	} else {
		$galleryzoom= 'woo_product_zoom_disabled';
		$galzoom = false;
	}
} else {
	$galleryslider = 'woo_product_slider_disabled';
	$galslider = false;
	$galleryzoom = 'woo_product_zoom_disabled';
	$galzoom = false;
}
if(isset($ascend['product_simg_resize']) && 0 == $ascend['product_simg_resize']) {
	$presizeimage = 0;
} else {
	$presizeimage = 1;
		if(isset($ascend['shop_img_ratio'])) { 
			$img_ratio = $ascend['shop_img_ratio']; 
		} else {
			$img_ratio = 'square';
		}
		if(ascend_display_sidebar()) { 
			$productimgwidth = 360; 
		} else {
			$productimgwidth = 460; 
		}
		$image_crop = true;
		if($img_ratio == 'portrait') {
			$tempproductimgheight = $productimgwidth * 1.35;
			$productimgheight = floor($tempproductimgheight);
		} else if($img_ratio == 'landscape') {
			$tempproductimgheight = $productimgwidth / 1.35;
			$productimgheight = floor($tempproductimgheight);
		} else if($img_ratio == 'widelandscape') {
			$tempproductimgheight = $productimgwidth / 2;
			$productimgheight = floor($tempproductimgheight);
		} else if($img_ratio == 'softcrop') {
            $productimgheight = null;
            $image_crop = false;
        } else {
			$productimgheight = $productimgwidth;
		}
		$productimgwidth = apply_filters('ascend_product_single_image_width', $productimgwidth);
        $productimgheight = apply_filters('ascend_product_single_image_height', $productimgheight);

}
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr($galleryslider.' '.$galleryzoom);?>">
			<?php
			if(! $galslider) {
				echo '<div class="product_image">';
			}
			$attributes = array(
				'title'                   => $image_title,
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			if ( has_post_thumbnail() ) {
				if($presizeimage == 1){
					$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
						$html .= '<a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= ascend_get_full_image_output($productimgwidth, $productimgheight, $image_crop, 'attachment-shop_single shop_single wp-post-image', $light_title, $post_thumbnail_id, false, false, false, $attributes);
					$html .= '</a>';
					$html .= '</div>';
				} else {
					$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );
				}
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'ascend' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
			
			if ( ! $galslider ) {
				echo '</div>';
			}	
		if(! $galslider) {
			echo '<div class="product_thumbnails thumbnails">';
		}
		do_action( 'woocommerce_product_thumbnails' );
		if(! $galslider) {
			echo '</div>';
		}
		?>
	</figure>
</div>

