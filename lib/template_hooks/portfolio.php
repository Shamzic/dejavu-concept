<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'ascend_portfolio_header', 'ascend_single_portfolio_header', 20 );
function ascend_single_portfolio_header() {
	if(ascend_display_pagetitle()) {
		get_template_part('templates/post', 'header');
	} else {
		if( ascend_display_portfolio_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin">';
			ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}

add_action( 'ascend_single_portfolio_content_after', 'ascend_wp_link_pages', 10 );

function ascend_portfolio_nav() { 
	global $post; 
	$ascend = ascend_get_options();
	if(isset($ascend['portfolio_single_nav']) && $ascend['portfolio_single_nav'] == 1) {
		echo '<div class="post-footer-section">';
			echo '<div class="kad-post-navigation portfolio-nav clearfix">';
				$prev_post = get_adjacent_post(false, null, true);
				if ( !empty( $prev_post ) ) : 
		        	echo '<div class="alignleft kad-previous-link">';
		        		echo '<a href="'.esc_url( get_permalink( $prev_post->ID ) ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Previous Project', 'ascend').'</span><span class="kt_postlink_title">'. esc_html($prev_post->post_title).'</span></a>';
		        	echo '</div>';
		        endif; 
		        if(isset($ascend['portfolio_link_type']) && $ascend['portfolio_link_type'] == 'type') {
		        	$main_term = ascend_get_primary_term( $post->ID, 'portfolio-type' );
		        	if ( $main_term ) {
                    	echo '<div class="kad-grid-link">';
                    	echo '<a href="'.esc_url( get_term_link( $main_term->slug, 'portfolio-type' ) ).'" class="kt_color_gray"><i class="kt-icon-th-large"></i></a>';
                    	echo '</div>';
                    }
		        } else if(isset($ascend['portfolio_link_type']) && $ascend['portfolio_link_type'] == 'page') {
		        	$parent_id = $ascend['portfolio_link'];
				   	if( !empty($parent_id)) {
				   		echo '<div class="kad-grid-link">';
				   		echo '<a href="'.esc_url( get_page_link($parent_id) ).'" class="kt_color_gray"><i class="kt-icon-th-large"></i></a>';
				   		echo '</div>';
				   	}
				}
		   		$next_post = get_adjacent_post(false, null, false);
		   		if ( !empty( $next_post ) ) :
		   			echo '<div class="alignright kad-next-link">';
		        		echo '<a href="'.esc_url( get_permalink( $next_post->ID ) ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Next Project', 'ascend').'</span><span class="kt_postlink_title">'. esc_html($next_post->post_title).'</span></a>';
		        	echo '</div>';
		        endif; 
			echo '</div> <!-- end navigation -->';
		echo '</div>';
	}
}
add_action( 'ascend_single_portfolio_footer', 'ascend_portfolio_nav', 20 );

function ascend_portfolio_bottom_carousel() { 
	global $post;
	$ascend = ascend_get_options();
	$portfolio_carousel = get_post_meta( $post->ID, '_kad_portfolio_carousel', true ); 
	if (empty($portfolio_carousel) || $portfolio_carousel == 'default')  { 
		if(isset($ascend['portfolio_bottom_carousel']) && $ascend['portfolio_bottom_carousel'] != 'none') {
			get_template_part('templates/content', 'single-portfolio-bottom-carousel'); 
		}
	} else if($portfolio_carousel != 'none'){
		get_template_part('templates/content', 'single-portfolio-bottom-carousel'); 
	}
}

add_action( 'ascend_single_portfolio_after', 'ascend_portfolio_bottom_carousel', 30 );

function ascend_portfolio_comments() { 
	$ascend = ascend_get_options();
	if(isset($ascend['portfolio_comments']) && $ascend['portfolio_comments'] == 1) { 
    	comments_template('/templates/comments.php'); 
	} 
}
add_action( 'ascend_single_portfolio_after', 'ascend_portfolio_comments', 40 );

add_filter( 'ascend_single_portfolio_image_height', 'ascend_portfolio_single_image_height', 10 );
function ascend_portfolio_single_image_height() {
	$ascend = ascend_get_options();
	if(isset($ascend['portfolio_header_single_image_height']) && $ascend['portfolio_header_single_image_height'] == 1 ) {
		return null;
	} else {
		return 450;
	}
}
function ascend_portfolio_single_layout() {
	global $post;
	$layout = get_post_meta( $post->ID, '_kad_ppost_layout', true ); 
    if(empty($layout) || $layout == 'default') {
    	$ascend = ascend_get_options();
    	if(isset($ascend['project_layout_default'])) {
    		$layout = $ascend['project_layout_default'];
    	} else {
    		$layout = 'beside';
    	}
    } 
    return $layout;
}
function ascend_portfolio_slider_width() {
	$layout = ascend_portfolio_single_layout();
    $maxwidth = ascend_max_width();
    if( $layout == 'above' ||  $layout == 'three'){
	    if($maxwidth == 'none') {
	        $width = 1800;
	    } else if($maxwidth == '940') {
	        $width = 940;
	    } else if($maxwidth == '1470') {
	        $width = 1440;
	    } else if($maxwidth == '1770') {
	        $width = 1740;
	    } else {
	        $width = 1140;
	    }
	} else if( $layout == 'besidesmall') {
		if($maxwidth == 'none') {
	        $width = 1400;
	    } else if($maxwidth == '940') {
	        $width = 620;
	    } else if($maxwidth == '1470') {
	        $width = 960;
	    } else if($maxwidth == '1770') {
	        $width = 1170;
	    } else {
	        $width = 780;
	    }
	} else {
		if($maxwidth == 'none') {
	        $width = 1400;
	    } else if($maxwidth == '940') {
	        $width = 520;
	    } else if($maxwidth == '1470') {
	        $width = 840;
	    } else if($maxwidth == '1770') {
	        $width = 1040;
	    } else {
	        $width = 660;
	    }
	}

    return $width;
}
function ascend_portfolio_single_project_output() { 
	get_template_part('templates/content', 'single-portfolio-project'); 
}
add_action( 'ascend_single_portfolio_project', 'ascend_portfolio_single_project_output', 20 );
