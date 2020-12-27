<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function ascend_lazy_load_filter() {
  	$lazy = false;
  	return apply_filters('ascend_lazy_load', $lazy);
}

add_filter( 'max_srcset_image_width','ascend_srcset_max');
function ascend_srcset_max($string) {
  	return 2300;
}

function ascend_get_options_placeholder_image() {
    $ascend = ascend_get_options();
    if(isset($ascend['default_placeholder_image']) && isset($ascend['default_placeholder_image']['id']) && !empty($ascend['default_placeholder_image']['id'])){
        return $ascend['default_placeholder_image']['id'];
    } else {
        return '';
    }
}

function ascend_default_placeholder_image_url() {
    return apply_filters('ascend_default_placeholder_image_url', get_template_directory_uri() . '/assets/img/placeholder-min.jpg');
}

function ascend_basic_image_sizes() {

	$sizes = array('full' => 'Full Size');

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[$_size]  = $_size .' - '. get_option( "{$_size}_size_w" ).'x'.get_option( "{$_size}_size_h" );
		} 
	}
	$sizes['custom'] = 'Custom';

	return $sizes;
}


function ascend_get_image_array($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false) {
    if(empty($id)) {
        $id = get_post_thumbnail_id();
    }
    if(empty($id)){
        if($placeholder == true) {
            $id = ascend_get_options_placeholder_image();
        }
    }
    if(!empty($id)) {
        $Ascend_Get_Image = Ascend_Get_Image::getInstance();
        $image = $Ascend_Get_Image->process( $id, $width, $height);
        if(empty($alt)) {
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        }
        $return_array = array(
            'src' => $image[0],
            'width' => $image[1],
            'height' => $image[2],
            'srcset' => $image[3],
            'class' => $class,
            'alt' => $alt,
            'full' => $image[4],
        );
    } else if(empty($id) && $placeholder == true) {
    	if(empty($height)){
    		$height = $width;
    	}
    	if(empty($width)){
    		$width = $height;
    	}
        $return_array = array(
            'src' => ascend_default_placeholder_image_url(),
            'width' => $width,
            'height' => $height,
            'srcset' => '',
            'class' => $class,
            'alt' => $alt,
            'full' => ascend_default_placeholder_image_url(),
        );
    } else {
        $return_array = array(
            'src' => '',
            'width' => '',
            'height' => '',
            'srcset' => '',
            'class' => '',
            'alt' => '',
            'full' => '',
        );
    }

    return $return_array;
}
function ascend_get_full_image_output($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false, $lazy = false, $schema = true, $extra = null) {
    $img = ascend_get_image_array($width, $height, $crop, $class, $alt, $id, $placeholder);
    if($lazy) {
        if( ascend_lazy_load_filter() ) {
            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
        } else {
            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
        }
    } else {
        $image_src_output = 'src="'.esc_url($img['src']).'"'; 
    }
    $extras = '';
    if(is_array($extra)) {
    	foreach ($extra as $key => $value) {
    		$extras .= esc_attr($key).'="'.esc_attr($value).'" ';
    	}
    } else {
    	$extras = $extra;	
    }
    if(!empty($img['src']) && $schema == true) {
        $output = '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
        $output .='<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'" '.$extras.'>';
        $output .= '<meta itemprop="url" content="'.esc_url($img['src']).'">';
        $output .= '<meta itemprop="width" content="'.esc_attr($img['width']).'px">';
        $output .= '<meta itemprop="height" content="'.esc_attr($img['height']).'px">';
        $output .= '</div>';
      	return $output;

    } elseif(!empty($img['src'])) {
        return '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'" '.$extras.'>';
    } else {
        return null;
    }
}
