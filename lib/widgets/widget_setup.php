<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Register sidebars and widgets
 */
function ascend_sidebar_list() {
	global $ascend; 
  	$all_sidebars= array(
		array('name'=>__('Primary Sidebar', 'ascend'), 'id'=>'sidebar-primary')
		);
  	if(isset($ascend['cust_sidebars'])) {
  		if (is_array($ascend['cust_sidebars'])) {
	    	$i = 1;
	  		foreach($ascend['cust_sidebars'] as $sidebar){
	    		if(empty($sidebar)) {$sidebar = 'sidebar'.$i;}
	    		$all_sidebars[]=array('name'=>$sidebar, 'id'=>'sidebar'.$i);
	    		$i++;
	  		}
	 	}
	}
  	return $all_sidebars;
}
function ascend_register_sidebars(){
  	$sidebars = ascend_sidebar_list();
  	if (function_exists('register_sidebar')){
    	foreach($sidebars as $side){
      		ascend_register_sidebar($side['name'], $side['id']);    
    	}
  	}
}
function ascend_register_sidebar($name, $id){
  	register_sidebar(array('name'=>$name,
    	'id' => $id,
    	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    	'after_widget' => '</div></section>',
    	'before_title' => '<h4 class="widget-title"><span>',
    	'after_title' => '</span></h4>',
  	));
}
add_action('widgets_init', 'ascend_register_sidebars');

function ascend_widgets_init() {
	global $ascend; 
	// Header Widget area.
  	register_sidebar(array(
    	'name'          => __('Header Extras Widget Area', 'ascend'),
    	'id'            => 'header_extras_widget',
	    'before_widget' => '<div id="%1$s" class="kt-above-lg-widget-area %2$s"><div class="widget-inner">',
	    'after_widget'  => '</div></div>',
	    'before_title'  => '<h4 class="header-widget-title"><span>',
	    'after_title'   => '</span></h4>',
  	));
  	register_sidebar(array(
    	'name'          => __('Topbar Widget Area', 'ascend'),
    	'id'            => 'topbar_widget',
	    'before_widget' => '<div id="%1$s" class="kt-below-lg-widget-area %2$s"><div class="widget-inner">',
	    'after_widget'  => '</div></div>',
	    'before_title'  => '<span class="topbar-header-widget-title"><span>',
	    'after_title'   => '</span></span>',
  	));
    // Footer 
    register_sidebar(array(
        'name' => __('Footer Column 1', 'ascend'),
        'id' => 'footer_1',
        'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<div class="footer-widget-title"><span>',
        'after_title' => '</span></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column 2', 'ascend'),
        'id' => 'footer_2',
        'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<div class="footer-widget-title"><span>',
        'after_title' => '</span></div>',
    ));
    if(isset($ascend['footer_layout'])) {
        $footer_layout = $ascend['footer_layout'];
    } else {
        $footer_layout = "fourc";
    }
    if ($footer_layout == "fourc" || $footer_layout == "four_single" || $footer_layout == "threec" || $footer_layout == "three_single") {
        register_sidebar(array(
            'name' => __('Footer Column 3', 'ascend'),
            'id' => 'footer_3',
            'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<div class="footer-widget-title"><span>',
            'after_title' => '</span></div>',
        ));
    }
    if ($footer_layout == "fourc" || $footer_layout == "four_single") {
        register_sidebar(array(
            'name' => __('Footer Column 4', 'ascend'),
            'id' => 'footer_4',
            'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<div class="footer-widget-title"><span>',
            'after_title' => '</span></div>',
        ));
    }

      // Widgets
    register_widget('ascend_contact_widget');
    register_widget('ascend_social_widget');
    register_widget('ascend_recent_posts_widget');
    register_widget('ascend_post_grid_widget');
    register_widget('ascend_image_widget');
}
add_action('widgets_init', 'ascend_widgets_init');

/**
 * Tag Cloud Adjustments
 */
function ascend_widget_tag_cloud_args( $args ) {
    $args['largest'] = 13;
    $args['smallest'] = 13;
    $args['unit'] = 'px';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'ascend_widget_tag_cloud_args' );
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'ascend_widget_tag_cloud_args' );
