<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
    $ascend = ascend_get_options();
    
    $icons = $ascend['icon_menu']; 
    if(!empty($ascend['home_icon_menu_column'])) {
        $columns = $ascend['home_icon_menu_column'];
    } else {
        $columns = 3;
    }
    if ($columns == '2') {
        $itemsize = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
    } else if ($columns == '3'){
        $itemsize = 'col-lg-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
    } else if ($columns == '6'){
        $itemsize = 'col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
    } else if ($columns == '5'){
        $itemsize = 'col-lg-25 col-md-25 col-sm-3 col-xs-4 col-ss-6';
    } else {
        $itemsize = 'col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ss-12';
    }
    if(!empty($ascend['home_icon_menu_btn'])) {
        $readmore = $ascend['home_icon_menu_btn'];
    } else {
        $readmore = '';
    }
    echo '<div class="home-margin home-padding kt-home-icon-menu">';
        echo '<div class="rowtight homepromo clearfix kt-home-iconmenu-container" data-equal-height="1">';
        $counter = 1;
        if($icons){
			foreach ($icons as $icon) :
                if(!empty($icon['target']) && $icon['target'] == 1) {
        			$target = '_blank';
    			} else {
    				$target = '_self';
    			} 
    			if(isset($icon['attachment_id'])) {
					$id = $icon['attachment_id'];
				} else {
					$id = '';
				}
				if(isset($icon['icon_o'])) {
					$icon_o = $icon['icon_o'];
				} else {
					$icon_o = '';
				}
				if(isset($icon['link'])) {
					$link = $icon['link'];
				} else {
					$link = '';
				}
				if(isset($icon['title'])) {
					$title = $icon['title'];
				} else {
					$title = '';
				}
				if(isset($icon['description'])) {
					$subtitle = $icon['description'];
				} else {
					$subtitle = '';
				}
                echo '<div class="'.esc_attr($itemsize).' box-iconmenu iconitemcount'.esc_attr($counter).'">';
    				ascend_icon_menu_output($icon_o, $id, $link, $target, $title, $subtitle, $readmore);
    			echo '</div>';
                $counter ++;
            endforeach; 
        }
        echo '</div>';
    echo '</div>';
   
