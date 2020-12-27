<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

	global $woocommerce_loop;
	$ascend = ascend_get_options();

		if(!empty($ascend['home_featured_title'])) {
			$featured_title = $ascend['home_featured_title'];
		} else {
			$featured_title = __('Featured', 'ascend');
		}
		if(!empty($ascend['home_best_title'])) {
			$best_title = $ascend['home_best_title'];
		} else {
			$best_title = __('Best Selling', 'ascend');
		}
		if(!empty($ascend['home_sale_title'])) {
			$sale_title = $ascend['home_sale_title'];
		} else {
			$sale_title = __('On Sale', 'ascend');
		}
		if(!empty($ascend['home_latest_title'])) {
			$latest_title = $ascend['home_latest_title'];
		} else {
			$latest_title = __('Latest', 'ascend');
		}
		if(!empty($ascend['home_product_tabs'])) {
			$product_tabs = $ascend['home_product_tabs'];
		} else {
			$product_tabs = array('featured' => '1', 'best' => '1', 'sale' => '1', 'latest' => '1');
		}
		if(!empty($ascend['home_product_tabs_column'])) {
			$product_columns = $ascend['home_product_tabs_column'];
		} else {
			$product_columns = '4';
		}
		if(!empty($ascend['home_product_count'])) {
			$items = $ascend['home_product_count'];
		} else {
			$items = '8';
		}
		if(isset($ascend['home_product_auto']) && $ascend['home_product_auto'] == '0') {
			$auto = 'false';
		} else {
			$auto = 'true';
		}
		if(!empty($ascend['home_product_speed'])) {
			$speed = $ascend['home_product_speed'].'000';
		} else {
			$speed = '9000';
		} 
		if(isset($ascend['home_product_scroll']) && $ascend['home_product_scroll'] == 'all' ) {
			$scroll = '';
		} else {
			$scroll = '1';
		}
		echo '<div class="home-product-carousel home-margin home-padding">';
		 	if (isset($product_tabs)) :
    		echo '<ul class="nav kt-tabs kt-sc-tabs kt-tabs-style2">';
			 	$i = 1;
				foreach ($product_tabs as $key=>$value) {
					if($value == 1) {
						if($i == '1'){
							$class = 'active'; 
						} else {
							$class = '';
						}
						echo '<li class="'.esc_attr($class).'"><a href="#pt-'.esc_attr($key).'">';
							if($key == 'latest') {
								echo $latest_title;
							} elseif($key == 'sale') {
								echo $sale_title;
							} elseif($key == 'best') {
								echo $best_title;
							} else {
								echo $featured_title;
							}
						echo '</a></li>';
						$i ++;
					}
				}
				echo '</ul>';
     
	    		echo '<div class="kt-tab-content postclass kt-tab-content-style2">';
	    		$i = 1;
				foreach ($product_tabs as $key=>$value) {
					if($value == 1) {
						if($i == '1'){
							$class = 'active'; 
						} else {
							$class = '';
						}
						echo '<div class="tab-pane clearfix '.esc_attr($class).'" id="pt-'.esc_attr($key).'">';
							ascend_build_post_content_carousel($key, $product_columns, 'product', null, $items, 'menu_order', 'ASC', 'products', null, $auto, $speed, $scroll, 'true', '400', $key ); 
						echo '</div>';
						$i ++;
					}
				}
				echo '</div>';
			endif;
		echo '</div>';