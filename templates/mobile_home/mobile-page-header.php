<?php
	// Front Page Header
	$ascend = ascend_get_options();
	if(isset($ascend['home_mobile_page_title_typed_text']) && $ascend['home_mobile_page_title_typed_text'] == '1') {
		if(isset($ascend['home_mobile_page_title_typed_text_loop']) && $ascend['home_mobile_page_title_typed_text_loop'] == '1') {
			$loop = 'true';
		} else {
			$loop = 'false';
		}
		if(isset($ascend['home_mobile_page_title_typed_text_delay']) && !empty($ascend['home_mobile_page_title_typed_text_delay']) ) {
			$delay = $ascend['home_mobile_page_title_typed_text_delay'];
		} else {
			$delay = '500';
		}
		$home_page_title = '<span class="kt_typed_element"';
		$i = 0;
		foreach ($ascend['home_mobile_page_title_typed'] as $text) {
			$i ++;
			if($i == 1) {
				$data = 'first';
			} else if($i == 2) {
				$data = 'second';
			} else if($i == 3) {
				$data = 'third';
			} else if($i == 4) {
				$data = 'fourth';
			}
			$home_page_title .= 'data-'.esc_attr($data).'-sentence="'.esc_attr($text).'"';
			if($i == 4) {
				break;
			}
		}
		$home_page_title  .= 'data-sentence-count="'.esc_attr($i).'" data-loop="'.esc_attr($loop).'" data-speed="40" data-start-delay="500" data-back-delay="'.esc_attr($delay).'"></span>';
	} else {
		if(isset($ascend['home_mobile_page_title'])) {
			$home_page_title = $ascend['home_mobile_page_title'];
		} else {
			$home_page_title = '';
		}
	}
	if(isset($ascend['home_mobile_page_sub_title'])) {
		$bsub = $ascend['home_mobile_page_sub_title'];
	} else {
		$bsub = '';
	} 
	if(isset($ascend['home_mobile_page_title_align']) && !empty($ascend['home_mobile_page_title_align'])) {
		$talign = 'text-align:'.$ascend['home_mobile_page_title_align'];
	} else {
		$talign = '';
	}
	if(isset($ascend['home_mobile_page_title_height'])) {
		$titleheight = 'height:'.$ascend['home_mobile_page_title_height'].'px;';
	} else {
		$titleheight = '';
	}
	if(!empty($ascend['home_mobile_page_title_color'])) {
		$tcolor = 'color:'.$ascend['home_mobile_page_title_color'].';';
	} else {
		$tcolor = '';
	}
	if(!empty($ascend['home_mobile_page_subtitle_color'])) {
		$scolor = 'color:'.$ascend['home_mobile_page_subtitle_color'].';';
	} else {
		$scolor = '';
	}
	if(!empty($ascend['home_mobile_page_title_max_size'])) {
			$title_data = $ascend['home_mobile_page_title_max_size'];
	} else {
		if(isset($ascend['single_header_title_size'])){
			$title_data = $ascend['single_header_title_size'];
		} else {
			$title_data = '70';
		}
	}
	if(!empty($ascend['home_mobile_page_title_min_size'])) {
		$title_small_data = $ascend['home_mobile_page_title_min_size'];
	} else {
		if(isset($ascend['single_header_title_size_small'])){
			$title_small_data = $ascend['single_header_title_size_small'];
		} else {
			$title_small_data = '30';
		}
	}
	if(!empty($ascend['home_mobile_page_subtitle_max_size'])) {
		$subtitle_data = $ascend['home_mobile_page_subtitle_max_size'];
	} else {
		if(isset($ascend['single_header_subtitle_size'])){
			$subtitle_data = $ascend['single_header_subtitle_size'];
		} else {
			$subtitle_data = '40';
		}
	}
	if(!empty($ascend['home_mobile_page_subtitle_min_size'])) {
		$subtitle_small_data = $ascend['home_mobile_page_subtitle_min_size'];
	} else {
		if(isset($ascend['single_header_subtitle_size_small'])){
			$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
		} else {
			$subtitle_small_data = '20';
		}
	}
	if(!empty($ascend['home_mobile_pagetitle_background']['background-image'])) {
		$bg_img = 'url('.$ascend['home_mobile_pagetitle_background']['background-image'].')';
		$bg_repeat = 'background-repeat: ' . $ascend['home_mobile_pagetitle_background']['background-repeat'].';';
		$bg_size = 'background-size: ' .$ascend['home_mobile_pagetitle_background']['background-size'].';';
		$bg_position = 'background-position: ' .$ascend['home_mobile_pagetitle_background']['background-position'].';';
		$bg_attachment = 'background-attachment: ' .$ascend['home_mobile_pagetitle_background']['background-attachment'].';';
	} else {
		$bg_img = '';
		$bg_repeat = '';
		$bg_size = '';
		$bg_position = '';
		$bg_attachment = '';
	}
	if(!empty($ascend['home_mobile_pagetitle_background']['background-color'])) {
		$bgcolor = $ascend['home_mobile_pagetitle_background']['background-color'];
	} else {
		$bgcolor = '';
	}
	if(!empty($bgcolor) || !empty($bg_img)) {
		$bg_style = 'background:'.$bgcolor.' '.$bg_img.';';
	} else {
		$bg_style = '';
	}
	?>
	<div id="pageheader" class="titleclass kt_mobile_slider post-header-area kt_bc_not_active" style="<?php echo esc_attr($bg_style).' '.esc_attr($bg_position).' '.esc_attr($bg_size).' '.esc_attr($bg_repeat).' '.esc_attr($bg_attachment);?>">
	<div class="header-color-overlay"></div>
	<?php do_action('ascend_header_overlay'); ?>
		<div class="container">
			<div class="page-header" style="<?php echo esc_attr($talign);?>">
				<div class="page-header-inner">
					<h1 class="page_head_title home_head_title entry-title" itemprop="name" <?php echo 'data-max-size="'.esc_attr($title_data).'" data-min-size="'.esc_attr($title_small_data).'"'; ?>>
						<?php echo do_shortcode($home_page_title); ?>
					</h1>
					<?php if(!empty($bsub)) { echo '<p class="subtitle" data-max-size="'.esc_attr($subtitle_data).'" data-min-size="'.esc_attr($subtitle_small_data).'"  style="'.esc_attr($scolor).'"> '.do_shortcode($bsub).' </p>'; } ?>
				</div>
			</div>
		</div><!--container-->
	</div><!--titleclass-->