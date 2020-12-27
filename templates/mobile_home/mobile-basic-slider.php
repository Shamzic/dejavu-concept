<?php  
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
    $ascend = ascend_get_options();

        if(isset($ascend['mobile_slider_size'])) {
        	$slideheight = $ascend['mobile_slider_size'];
        } else { 
        	$slideheight = 400; 
        }
        if(isset($ascend['mobile_slider_size_width'])) {
        	$slidewidth = $ascend['mobile_slider_size_width'];
        } else { 
        	$slidewidth = 1140; 
        }
        if(isset($ascend['mobile_slider_captions']) && $ascend['mobile_slider_captions'] == 1) {
         	$captions = 'true'; 
     	} else {
     		$captions = 'false';
     	}
        if(isset($ascend['home_mobile_basic_slider'])) {
        	$slides = $ascend['home_mobile_basic_slider'];
		} else {
			$slides = '';
		}
        if(isset($ascend['home_mobile_basic_slider_type'])) {
        	$type = $ascend['home_mobile_basic_slider_type'];
        } else {
        	$type = 'equal-ratio';
        }
        if(isset($ascend['mobile_trans_type']) && $ascend['mobile_trans_type'] == 'false') {
        	$transtype = 'false';
        } else {
        	$transtype = 'true';
        }
        if(isset($ascend['mobile_slider_transtime'])) {
        	$transtime = $ascend['mobile_slider_transtime'];
        } else {
        	$transtime = '400';
        }
        if(isset($ascend['mobile_slider_autoplay']) && $ascend['mobile_slider_autoplay'] == "1" ) {
        	$autoplay ='true';
        } else {
        	$autoplay = 'false';
        }
        if(isset($ascend['mobile_slider_pausetime'])) {
        	$pausetime = $ascend['mobile_slider_pausetime'];
    	} else {
    		$pausetime = '7000';
    	}
    	if(isset($ascend['home_mobile_page_title_align']) && !empty($ascend['home_mobile_page_title_align'])) {
			$talign = $ascend['home_mobile_page_title_align'];
		} else {
			$talign = 'center';
		}
    	if(!empty($ascend['home_mobile_page_title_max_size'])) {
			$title_data = $ascend['home_mobile_page_title_max_size'];
		} else {
			if(isset($ascend['single_header_title_size'])){
				$title_data = $ascend['single_header_title_size'];
			} else {
				$title_data = '70';
			}
		}
		if(!empty($ascend['home_mobile_page_title_min_size'])) {
			$title_small_data = $ascend['home_mobile_page_title_min_size'];
		} else {
			if(isset($ascend['single_header_title_size_small'])){
				$title_small_data = $ascend['single_header_title_size_small'];
			} else {
				$title_small_data = '30';
			}
		}
		if(!empty($ascend['home_mobile_page_subtitle_max_size'])) {
			$subtitle_data = $ascend['home_mobile_page_subtitle_max_size'];
		} else {
			if(isset($ascend['single_header_subtitle_size'])){
				$subtitle_data = $ascend['single_header_subtitle_size'];
			} else {
				$subtitle_data = '40';
			}
		}
		if(!empty($ascend['home_mobile_page_subtitle_min_size'])) {
			$subtitle_small_data = $ascend['home_mobile_page_subtitle_min_size'];
		} else {
		if(isset($ascend['single_header_subtitle_size_small'])){
				$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
			} else {
				$subtitle_small_data = '20';
			}
		}
		$class = 'kt-h-basic-'.esc_attr($type);
		$id = 'kt_slider_mhome';
        ?>
<div class="sliderclass kt_mobile_slider mobile-basic-slider clearfix">
	<?php if($type == 'fullwidth' ) {
		ascend_build_slider_home_fullwidth($slides, $slidewidth, $slideheight, $class, $id, $type, $captions, $autoplay, $pausetime, 'true', $transtype, $transtime, $title_data, $title_small_data, $subtitle_data, $subtitle_small_data, $talign); 
	} else if($type == 'carousel') {
		ascend_build_slider_home($slides, $slidewidth, $slideheight, $class, $id, $type, $captions, $autoplay, $pausetime, 'true', $transtype, $transtime, $title_data, $title_small_data, $subtitle_data, $subtitle_small_data, $talign); 
	} else {
  		echo '<div id="imageslider" class="container">';
  			ascend_build_slider_home($slides, $slidewidth, $slideheight, $class, $id, $type, $captions, $autoplay, $pausetime, 'true', $transtype, $transtime, $title_data, $title_small_data, $subtitle_data, $subtitle_small_data, $talign); 
  		echo '</div><!--Container-->';
  	} ?>
</div><!--sliderclass-->