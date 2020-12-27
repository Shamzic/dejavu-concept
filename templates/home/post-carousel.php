<?php  
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
    $ascend = ascend_get_options();

        if(isset($ascend['home_carousel_height'])) {
        	$slideheight = $ascend['home_carousel_height'];
        } else { 
        	$slideheight = 400; 
        }
        $type = 'post';
        if(isset($ascend['slider_transtime'])) {
        	$transtime = $ascend['slider_transtime'];
        } else {
        	$transtime = '400';
        }
        if(isset($ascend['home_post_carousel_items'])) {
        	$items = $ascend['home_post_carousel_items'];
        } else {
        	$items = '8';
        }
        if(isset($ascend['home_post_carousel_orderby'])) {
        	$orderby = $ascend['home_post_carousel_orderby'];
        } else {
        	$orderby = 'date';
        }
        if(isset($ascend['home_post_carousel_order'])) {
        	$order = $ascend['home_post_carousel_order'];
        } else {
        	$order = 'DESC';
        }
        
    	if(isset($ascend['home_post_carousel_post_cat'])) {
        	$cat = $ascend['home_post_carousel_post_cat'];
        } else {
        	$cat = '';
        }
        if(isset($ascend['slider_autoplay']) && $ascend['slider_autoplay'] == "1" ) {
        	$autoplay ='true';
        } else {
        	$autoplay = 'false';
        }
        if(isset($ascend['slider_pausetime'])) {
        	$pausetime = $ascend['slider_pausetime'];
    	} else {
    		$pausetime = '7000';
    	}
		$class = 'kt-h-basic-carousel-'.esc_attr($type);
        ?>
<div class="sliderclass basic-post-carousel kt_desktop_slider home-sliderclass clearfix">
	<?php 
		ascend_build_post_carousel(null, $slideheight, $class, $type, $cat, $items, $orderby, $order, null, $autoplay, $pausetime, 'true', $transtime); 
  	 ?>
</div><!--sliderclass-->