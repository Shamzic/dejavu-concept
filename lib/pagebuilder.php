<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Extend - Site Origin Panels 
 */
add_filter('siteorigin_panels_full_width_container', 'ascend_fullwidth_container_id');
function ascend_fullwidth_container_id($tag) {
	if($tag == 'body') {
		$tag = '#inner-wrap';
	}
	return $tag;
}

