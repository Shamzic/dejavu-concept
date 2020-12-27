<?php 
global $post, $ascend_portfolio_loop, $ascend_portfolio_loop_count;
do_action('ascend_portfolio_loop_start');
	$postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );
	$crop = true;
	if( $ascend_portfolio_loop['carousel'] == 'true') {
		$class = 'portfolio_carousel_item kt-slick-slide p_item';
	} else{
		$class = 'p_item';
	}
	if ($ascend_portfolio_loop['columns'] == '2') {
	 	$itemsize 	= 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
	 	$image_width = 860;
	} else if ($ascend_portfolio_loop['columns'] == '1'){
		$itemsize = 'col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
		$image_width = 860;
	} else if ($ascend_portfolio_loop['columns'] == '3'){
		$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 600;
	} else if ($ascend_portfolio_loop['columns'] == '6'){
		$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 240;
	} else if ($ascend_portfolio_loop['columns'] == '5'){
		$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 240;
	} else {
		$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 300;
	}
    if(isset($ascend_portfolio_loop['ratio']) && !empty($ascend_portfolio_loop['ratio'])) {
    	$portfolio_ratio = $ascend_portfolio_loop['ratio'];
    } else {
		$portfolio_ratio = 'square';
    }
    if($portfolio_ratio == 'portrait') {
		$temppimgheight = $image_width * 1.35;
		$image_height = floor($temppimgheight);
	} else if($portfolio_ratio == 'landscape') {
		$temppimgheight = $image_width / 1.35;
		$image_height = floor($temppimgheight);
	} else if($portfolio_ratio == 'widelandscape') {
		$temppimgheight = $image_width / 2;
		$image_height = floor($temppimgheight);
	} else if($portfolio_ratio == 'softcrop') {
        $image_height = null;
        $crop = false; 
    } else {
		$image_height = $image_width;
	}
	$image_width = apply_filters('ascend_portfolio_grid_image_width', $image_width);
    $image_height = apply_filters('ascend_portfolio_grid_image_height', $image_height);
	
    $terms = get_the_terms( $post->ID, 'portfolio-type' );
	if ( $terms && ! is_wp_error( $terms ) ) : 
		$links = array();
		foreach ( $terms as $term ) { 
			$links[] = $term->slug;
		}
		$tax = join( " ", $links );		
	else :	
		$tax = '';	
	endif;
	?>
	<div class="<?php echo esc_attr($itemsize);?> <?php echo esc_attr($tax); ?> <?php echo esc_attr($class);?>">
		<div class="portfolio_item grid_item kt_item_fade_in" data-post-title="<?php the_title_attribute()?>">
			<div class="portfolio-loop-image-container">
            <?php 
            if ($postsummery == 'slider') {
            		$image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
            		$attachments = array_filter( explode( ',', $image_gallery ) );
                    if (!empty($attachments)) {
                        $img = ascend_get_image_array($image_width, $image_height, $crop, null, null, $attachments[0], true);
                    } else {
			            $attach_args = array('order'=> 'ASC','post_type'=> 'attachment','post_parent'=> $post->ID,'post_mime_type' => 'image','post_status'=> null,'orderby'=> 'menu_order','numberposts'=> -1);
			            $attachments_posts = get_posts($attach_args);
			            if(isset($attachments_posts[0]->ID) && !empty($attachments_posts[0]->ID) ) {
			            	$img = ascend_get_image_array($image_width, $image_height, $crop, null, null, $attachments_posts[0]->ID, true);
			            } else {
			            	$img['width'] = $image_width;
			            	$img['height'] = $image_width;
			            }
                    }
            		echo '<div class="img-hoverclass kt-intrinsic portfolio-loop-image" style="padding-bottom:'.esc_attr(($img['height']/$img['width']) * 100).'%;">';
            		echo '</div><div class="portfolio-loop-slider portfolio-light-gallery portfolio-light-gallery-'.esc_attr($post->ID).'">';
            			ascend_build_slider($post->ID, $image_gallery, $img['width'], $img['height'], 'image', 'kt-slider-same-image-ratio', 'slider', 'false', 'true', '7000', 'false', 'true', '400', rand(1, 400));
            		echo '</div>';
           	} else {
 				$img = ascend_get_image_array($image_width, $image_height, $crop, null, null, null, true);
				echo '<div class="img-hoverclass kt-intrinsic portfolio-loop-image" style="padding-bottom:'.esc_attr(($img['height']/$img['width']) * 100).'%;">';
					echo '<div class="portfolio-img-hover-inner">';
					if( ascend_lazy_load_filter() ) {
			            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
			        } else {
			            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
			        }
					echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'">';
					echo '</div>';
				echo '</div>';
			}
			echo '<div class="portfolio-hover-item">';
			echo '<div class="portfolio-overlay-color"></div>';
			echo '<div class="portfolio-overlay-border"></div>';
			echo '<a href="'.esc_url( get_the_permalink() ).'" class="portfolio-hover-item-link"></a>';
			echo '<div class="portfolio-hover-item-inner">';
                if($ascend_portfolio_loop['lightbox'] == 'true') {
                	$light_class = 'portfolio_lightbox';
                	if($postsummery == 'videolight'){
                		$video = get_post_meta( $post->ID, '_kad_post_video', true );
						if (filter_var($video, FILTER_VALIDATE_URL)) { 
		 					$light_url = $video;
		 					$light_class = 'ktvideolight mfp-iframe';
		 				} else {
		 					$light_url = $img['full'];
		 				}
                	} else if($postsummery == 'slider') {
                		$light_class = 'kt-no-lightbox portfolio-light-gallery-open';
                		$light_url = $img['full'];
                	} else {
                		$light_url = $img['full'];
                	} ?>
						<a href="<?php echo esc_url($light_url); ?>" data-gallery-id="portfolio-light-gallery-<?php echo esc_attr($post->ID);?>" class="kad_portfolio_lightbox_link <?php echo esc_attr($light_class);?>" aria-label="<?php esc_attr(the_title());?>" data-rel="lightbox">
							<i class="kt-icon-search"></i>
						</a>
				<?php 
				}
				if($ascend_portfolio_loop['style'] != "poststyle") { ?>
					<a href="<?php the_permalink() ?>" class="portfolio-inner-link">
	                    <h5 class="portfolio-loop-title"><?php the_title();?></h5>
	                    <?php if($ascend_portfolio_loop['showtypes'] == 'true') {
	                            if ( $terms && ! is_wp_error( $terms ) ) {?> 
	                               	<div class="portfolio-loop-types">
	                                    <?php 
	                                    $output = array(); 
	                                    foreach($terms as $term){ 
	                                    	$output[] = $term->name;
	                                    } 
	                                    echo esc_html(implode(' | ', $output)); ?>
	                                </div>
	                          	<?php } 
	                    } ?>
	                    </a>
						<?php if($ascend_portfolio_loop['showexcerpt'] == 'true') {?> 
	                        <div class="portfolio-loop-excerpt">
	                            <?php the_excerpt(); ?>
	                        </div>
	                    <?php } ?>
                <?php } ?>
                </div>
                </div>
			</div> 
			<?php 
            if($ascend_portfolio_loop['style'] == "poststyle" ) { ?>
            	<div class="portfolio-poststyle-content postclass">
              		<a href="<?php the_permalink() ?>" class="portfolio-poststyle-link">  
                        <h5 class="portfolio-loop-title"><?php the_title();?></h5>
                        <?php if($ascend_portfolio_loop['showtypes'] == 'true') {
                        		if ( $terms && ! is_wp_error( $terms ) ) {?> 
	                               	<div class="portfolio-loop-types">
	                                    <?php 
	                                    $output = array(); 
	                                    foreach($terms as $term){ 
	                                    	$output[] = $term->name;
	                                    } 
	                                    echo esc_html(implode(' | ', $output)); ?>
	                                </div>
	                        <?php } 
                       	} ?>
                    </a>
                    <?php 
                       	if($ascend_portfolio_loop['showexcerpt'] == 'true') { ?> 
                       		<div class="portfolio-loop-excerpt">
                       			<?php the_excerpt(); ?>
                       		</div> 
                       	<?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php 
    do_action('ascend_portfolio_loop_end');

