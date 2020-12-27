<?php 
add_filter( 'cmb2_admin_init', 'ascend_blog_page_metaboxes');
function ascend_blog_page_metaboxes(){
	$prefix = '_kad_';
	$ascend_blog_page = new_cmb2_box( array(
		'id'         	=> 'blog_template_metabox',
		'title'      	=> __('Blog Options', 'ascend'),
		'object_types'  => array('page'),
		'show_on' 		=> array('key' => 'blog-page'),
		'priority'   	=> 'high',
	) );
	$ascend_blog_page->add_field( array(
		'name' => __('Blog Category', 'ascend'),
		'desc' 	=> __('Select all blog posts or a specific category to show', 'ascend'),
		'id'   	=> $prefix . 'blog_cat',
		'type' => 'kt_select_category',
	) );
	$ascend_blog_page->add_field( array(
		'name'    => __('Order Items By', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'blog_order',
		'type'    => 'select',
		'default' => '',
		'options' => array(
			'date' 			=> __('Date', 'ascend' ),
			'menu_order' 	=> __('Menu Order', 'ascend' ),
			'title' 		=> __('Title', 'ascend' ),
			'rand' 			=> __('Random', 'ascend' ),
		),
	) );
	$ascend_blog_page->add_field( array(
		'name'    => __('How Many Posts Per Page', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'blog_items',
		'type'    => 'select',
		'default' => '10',
		'options' => array(
			'all' 	=> __('All', 'ascend' ),
			'2' 	=> __('2', 'ascend' ),
			'3' 	=> __('3', 'ascend' ),
			'4' 	=> __('4', 'ascend' ),
			'5' 	=> __('5', 'ascend' ),
			'6' 	=> __('6', 'ascend' ),
			'7' 	=> __('7', 'ascend' ),
			'8' 	=> __('8', 'ascend' ),
			'9' 	=> __('9', 'ascend' ),
			'10' 	=> __('10', 'ascend' ),
			'11' 	=> __('11', 'ascend' ),
			'12' 	=> __('12', 'ascend' ),
			'13' 	=> __('13', 'ascend' ),
			'14' 	=> __('14', 'ascend' ),
			'15' 	=> __('15', 'ascend' ),
			'16' 	=> __('16', 'ascend' ),
			'17' 	=> __('17', 'ascend' ),
			'18' 	=> __('18', 'ascend' ),
			'19' 	=> __('19', 'ascend' ),
			'20' 	=> __('20', 'ascend' ),
		),
	) );
	$ascend_blog_page->add_field( array(
		'name'    => __('Post output style', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'blog_type',
		'type'    => 'select',
		'default' => 'normal',
		'options' => array(
			'normal' 		=> __('Standard', 'ascend' ),
			'below_title' 	=> __('Standard with image below title', 'ascend' ),
			'full' 			=> __('Full Post', 'ascend' ),
			'grid' 			=> __('Grid', 'ascend' ),
			'grid_standard' => __('Grid with first post as standard', 'ascend' ),
			'photo' 		=> __('Photo', 'ascend' ),
		),
	) );
	$ascend_blog_page->add_field( array(
		'name'    => __('If grid or photo layout choose columns:', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'blog_columns',
		'type'    => 'select',
		'options' => array(
			'4' 	=> __('Four Columns', 'ascend' ),
			'3' 	=> __('Three Columns', 'ascend' ),
			'2' 	=> __('Two Columns', 'ascend' ),
		),
	) );
}