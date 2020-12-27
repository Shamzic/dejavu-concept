<?php 
add_filter( 'cmb2_admin_init', 'ascend_postheader_metaboxes');
function ascend_postheader_metaboxes(){
	$prefix = '_kad_';

	$ascend_postheader = new_cmb2_box( array(
		'id'         	=> 'post_header_metabox',
		'title'      	=> __("Post Title and Subtitle", 'ascend'),
		'object_types'  => array( 'product', 'post', 'portfolio', 'tribe_events', 'recipe'),
		'priority'   	=> 'default',
	) );
	
	$ascend_postheader->add_field( array(
		'name'    => __("Hide Page Title Area", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_hide',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'show' 		=> __("Show", 'ascend' ),
			'hide' 		=> __("Hide", 'ascend' ),
		),
	) );

}