<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	$ascend = ascend_get_options();

	if(!empty($ascend['img_menu_height'])) {
		$height = $ascend['img_menu_height'];
	} else {
		$height = 210;
	}
	if(!empty($ascend['img_menu_height_setting'])) {
		$type = $ascend['img_menu_height_setting'];
	} else {
		$type = 'normal';
	} 
    $slides = $ascend['home_image_menu'];

    if(!empty($ascend['home_image_menu_column'])) {
    	$columnsize = $ascend['home_image_menu_column'];
    } else {
    	$columnsize = 3;
    }
    if ($columnsize == '2') {
    	$itemsize = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
    } else if ($columnsize == '1'){
    	$itemsize = 'col-ss-12';
    } else if ($columnsize == '3'){
    	$itemsize = 'col-lg-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
    } else if ($columnsize == '6'){
    	$itemsize = 'col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
    } else if ($columnsize == '5'){
    	$itemsize = 'col-lg-25 col-md-25 col-sm-3 col-xs-4 col-ss-6';
    } else {
    	$itemsize = 'col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
    }             
	?>
<div class="home-padding home-margin image-menu-modual">
	<div class="rowtight">
	<?php $counter = 1;
	if(!empty($slides)) {
		foreach ($slides as $slide) :
			echo '<div class="'.esc_attr($itemsize).' outer-image-menu">';
				if(!empty($slide['target']) && $slide['target'] == 1) {
					$target = '_blank';
				} else {
					$target = '_self';
				}
				$class = 'home-image-menu-'.$counter;
				if(isset($slide['attachment_id'])) {
					$id = $slide['attachment_id'];
				} else {
					$id = '';
				}
				if(isset($slide['url'])) {
					$image_uri = $slide['url'];
				} else {
					$image_uri = '';
				}
				if(isset($slide['link'])) {
					$link = $slide['link'];
				} else {
					$link = '';
				}
				if(isset($slide['title'])) {
					$title = $slide['title'];
				} else {
					$title = '';
				}
				if(isset($slide['description'])) {
					$subtitle = $slide['description'];
				} else {
					$subtitle = '';
				}
			echo ascend_build_image_menu( $id, $type, $height, $link, $target, $title, $subtitle, 'left', 'bottom', $class, $image_uri);
			echo '</div>';
			$counter ++;

		endforeach;
	} ?>
	</div> <!--homepromo -->
</div> <!--home padding -->