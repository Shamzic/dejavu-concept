<?php 
add_filter( 'cmb2_admin_init', 'ascend_post_metaboxes');
function ascend_post_metaboxes(){
	$prefix = '_kad_';
	$ascend_standard_post = new_cmb2_box( array(
		'id'         	=> 'standard_post_metabox',
		'title'      	=> __("Standard Post Options", 'ascend'),
		'object_types'  => array('post'),
		'priority'   	=> 'high',
	) );
	$ascend_standard_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __('Standard Post Default', 'ascend' ),
			'text' 			=> __('Text', 'ascend' ),
			'img_portrait' 	=> __('Portrait Image', 'ascend'),
			'img_landscape' => __('Landscape Image', 'ascend'),
			),
	) );
	// IMAGE POST //
	$ascend_image_post = new_cmb2_box( array(
		'id'         	=> 'image_post_metabox',
		'title'      	=> __("Image Post Options", 'ascend'),
		'object_types'  => array( 'post' ),
		'priority'   	=> 'high',
		) );
	
	$ascend_image_post->add_field( array(
		'name'    => __("Head Content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'image_blog_head',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Image Post Default", 'ascend' ),
			'image' 	=> __("Image", 'ascend' ),
			'none' 		=> __("None", 'ascend' ),
			),
	) );
	$ascend_image_post->add_field( array(
		'name' => __("Max Image Height", 'ascend' ),
		'desc' => __("Note: just input number, example: 350", 'ascend' ),
		'id'   => $prefix . 'image_posthead_height',
		'type' => 'text_small',
	) );
	$ascend_image_post->add_field( array(
		'name' => __("Max Image Width", 'ascend' ),
		'desc' => __("Note: just input number, example: 650", 'ascend' ),
		'id'   => $prefix . 'image_posthead_width',
		'type' => 'text_small',
	) );

	$ascend_image_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'image_post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __('Image Post Default', 'ascend' ),
			'text' 			=> __('Text', 'ascend' ),
			'img_portrait' 	=> __('Portrait Image', 'ascend'),
			'img_landscape' => __('Landscape Image', 'ascend'),
		),
	) );
	
	// NORMAL 
	$ascend_post = new_cmb2_box( array(
		'id'         	=> 'post_metabox',
		'title'      	=> __("Post Options", 'ascend'),
		'object_types'  => array( 'post'),
		'priority'   	=> 'high',
	));
	$ascend_post->add_field( array(
		'name' 		=> __('Author Info', 'ascend'),
		'desc' 		=> __('Display an author info box?', 'ascend'),
		'id'   		=> $prefix . 'blog_author',
		'type'    	=> 'select',
		'options' 	=> array(
			'default' 	=> __('Default', 'ascend'),
			'no' 		=> __('No', 'ascend'),
			'yes' 		=> __('Yes', 'ascend'),
			),
	) );
	$ascend_post->add_field( array(
		'name' 		=> __('Posts Carousel', 'ascend'),
		'desc' 		=> __('Display a carousel with similar or recent posts?', 'ascend'),
		'id'   		=> $prefix . 'blog_carousel_similar',
		'type'    	=> 'select',
		'options' 	=> array(
			'default' 	=> __('Default', 'ascend'),
			'no' 		=> __('No', 'ascend'),
			'recent' 	=> __('Yes - Display Recent Posts', 'ascend'),
			'similar' 	=> __('Yes - Display Similar Posts', 'ascend'),
			),
		
	) );

}