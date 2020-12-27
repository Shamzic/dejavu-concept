<?php
// Archive header
$ascend = ascend_get_options();

	
		if(isset($ascend['single_header_title_size'])){
			$title_data = $ascend['single_header_title_size'];
		} else {
			$title_data = '70';
		}
	
		if(isset($ascend['single_header_title_size_small'])){
			$title_small_data = $ascend['single_header_title_size_small'];
		} else {
			$title_small_data = '30';
		}
	
		if(isset($ascend['single_header_subtitle_size'])){
			$subtitle_data = $ascend['single_header_subtitle_size'];
		} else {
			$subtitle_data = '34';
		}
	
		if(isset($ascend['single_header_subtitle_size_small'])){
			$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
		} else {
			$subtitle_small_data = '15';
		}
	
	if( ascend_display_archive_breadcrumbs()) {
	 	$breadcrumb = true;
	 	$breadclass = "kt_bc_active";
	} else {
	 	$breadcrumb = false;
	 	$breadclass = "kt_bc_not_active";
	}
	?>
<div id="pageheader" class="titleclass archive-header-area <?php echo esc_attr($breadclass);?>">
<div class="header-color-overlay"></div>
<?php do_action('ascend_header_overlay'); ?>
	<div class="container">
		<div class="page-header">
			<div class="page-header-inner">
			<div class="header-case">
		  		<h1 class="entry-title" <?php echo 'data-max-size="'.esc_attr($title_data).'" data-min-size="'.esc_attr($title_small_data).'"'; ?>><?php echo wp_kses_post( ascend_title() ); ?></h1>
		  		</div>
			  	<?php if(!empty($bsub)) { echo '<div class="subtitle" data-max-size="'.esc_attr($subtitle_data).'" data-min-size="'.esc_attr($subtitle_small_data).'"> '.wp_kses_post($bsub).' </div>'; } ?>
			</div>
		</div>
	</div><!--container-->
	<?php if($breadcrumb) { ascend_breadcrumbs(); } ?>
</div><!--titleclass-->