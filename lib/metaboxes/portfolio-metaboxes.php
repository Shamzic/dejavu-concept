<?php 
add_filter( 'cmb2_admin_init', 'ascend_portfolio_template_metaboxes');
function ascend_portfolio_template_metaboxes(){
	$prefix = '_kad_';
	$ascend_portfolio_page = new_cmb2_box( array(
		'id'         	=> 'portfolio_page_metabox',
		'title'      	=> __("Portfolio Options", 'ascend'),
		'object_types'  => array('page'),
		'show_on'      	=> array( 'key' => 'page-template', 'value' => 'template-portfolio-grid.php' ),
		'priority'   	=> 'high',
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Portfolio Style", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_style',
		'type'    => 'select',
		'default' => 'portfolio-grid',
		'options' => array(
			'pgrid' 			=> __("Normal Grid", 'ascend' ),
			'pgrid-no-margin' 	=> __("Grid without margin between items", 'ascend' ),
			'poststyle' 		=> __("Post style", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Image Ratio", 'ascend' ),
		'desc'    => __("This doens't apply when using mosaic or tiles style.", 'ascend' ),
		'id'      => $prefix . 'portfolio_ratio',
		'type'    => 'select',
		'default' => 'square',
		'options' => array(
			'square' 		=> __("Square", 'ascend' ),
			'portrait' 		=> __("Portrait", 'ascend' ),
			'landscape' 	=> __("Landscape", 'ascend' ),
			'widelandscape' => __("Wide Landscape", 'ascend' ),
			'softcrop' 		=> __("Inherit from uploaded image", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Columns", 'ascend' ),
		'desc'    => __("This doens't apply when using mosaic or tiles style.", 'ascend' ),
		'id'      => $prefix . 'portfolio_columns',
		'type'    => 'select',
		'default' => '3',
		'options' => array(
			'2' 	=> __("Two Columns", 'ascend' ),
			'3' 	=> __("Three Columns", 'ascend' ),
			'4' 	=> __("Four Columns", 'ascend' ),
			'5' 	=> __("Five Columns", 'ascend' ),
			'6' 	=> __("Six Columns", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name' 		=> __('Portfolio Type', 'ascend'),
		'desc' 		=> '',
		'id'   		=> $prefix . 'portfolio_type',
		'type' 		=> 'kt_select_type',
		'taxonomy' 	=> 'portfolio-type',
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Items per Page", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_items',
		'type'    => 'select',
		'default' => '-1',
		'options' => array(
			'-1' 	=> __("All", 'ascend' ),
			'2' 	=> __("2", 'ascend' ),
			'3' 	=> __("3", 'ascend' ),
			'4' 	=> __("4", 'ascend' ),
			'5' 	=> __("5", 'ascend' ),
			'6' 	=> __("6", 'ascend' ),
			'7' 	=> __("7", 'ascend' ),
			'8' 	=> __("8", 'ascend' ),
			'9' 	=> __("9", 'ascend' ),
			'10' 	=> __("10", 'ascend' ),
			'11' 	=> __("11", 'ascend' ),
			'12' 	=> __("12", 'ascend' ),
			'13' 	=> __("13", 'ascend' ),
			'14' 	=> __("14", 'ascend' ),
			'15' 	=> __("15", 'ascend' ),
			'16' 	=> __("16", 'ascend' ),
			'17' 	=> __("17", 'ascend' ),
			'18' 	=> __("18", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Order by", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_orderby',
		'type'    => 'select',
		'default' => 'menu_order',
		'options' => array(
			'menu_order' 	=> __("Menu Order", 'ascend' ),
			'date' 			=> __("Date", 'ascend' ),
			'title' 		=> __("Title", 'ascend' ),
			'rand' 			=> __("Random", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Show Type?", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_types',
		'type'    => 'select',
		'default' => 'true',
		'options' => array(
			'true' 	=> __("Yes, enabled", 'ascend' ),
			'false' => __("No, disabled", 'ascend' ),
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Show Excerpt?", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_excerpt',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' )
		),
	) );
	$ascend_portfolio_page->add_field( array(
		'name'    => __("Add lightbox link?", 'ascend' ),
		'desc'    => __("This adds a lightbox icon to post.", 'ascend' ),
		'id'      => $prefix . 'portfolio_lightbox',
		'type'    => 'select',
		'default' => 'true',
		'options' => array(
			'true' 	=> __("Yes, enabled", 'ascend' ),
			'false' => __("No, disabled", 'ascend' ),
		),
	) );
}