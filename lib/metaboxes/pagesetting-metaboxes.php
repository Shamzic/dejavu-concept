<?php 
add_filter( 'cmb2_admin_init', 'ascend_pagesetting_metaboxes');
function ascend_pagesetting_metaboxes(){
	$prefix = '_kad_';

	$ascend_pagesettings = new_cmb2_box( array(
		'id'         	=> 'pagesetting_metabox',
		'title'      	=> __("Page Settings", 'ascend'),
		'object_types'  => array('page'),
		'priority'   	=> 'low',
		'context'      	=> 'side',
	) );
	
	$ascend_pagesettings->add_field( array(
		'name'    => __("Page Title Area", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_hide',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'show' 		=> __("Show", 'ascend' ),
			'hide' 		=> __("Hide", 'ascend' ),
		),
	) );
	$ascend_pagesettings->add_field( array(
		'name'    => __("Page Content Width", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'page_content_width',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'contained' => __("Contained", 'ascend' ),
			'full' 		=> __("Fullwidth", 'ascend' ),
		),
	) );


}