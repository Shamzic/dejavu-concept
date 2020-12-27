<?php 
global $post;
	$ascend = ascend_get_options();
	$ascend_project = get_post_meta( $post->ID, '_kad_ppost_type', true );
	$imgheight 	= get_post_meta( $post->ID, '_kad_portfolio_slider_height', true );
	$imgwidth 	= get_post_meta( $post->ID, '_kad_portfolio_slider_width', true );
   	if (!empty($imgheight)) {
		$slideheight = $imgheight;
	} else { 
		$slideheight = apply_filters('ascend_single_portfolio_image_height', null); 
	} 
	if (!empty($imgwidth)) {
		$slidewidth = $imgwidth;
	} else {
		$slidewidth = ascend_portfolio_slider_width();
		$slidewidth = apply_filters('ascend_single_portfolio_image_width', $slidewidth); 
	}
    if(empty($ascend_project)) {
    	$ascend_project = 'image';
    }

    if ($ascend_project == 'flex') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, $slidewidth, $slideheight, 'image', 'kt-slider-same-image-ratio');
        echo '</section>';

    } else if ($ascend_project == 'carouselslider') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, null, $slideheight, 'image', 'kt-slider-different-image-ratio');
        echo '</section>';
        
    } else if ($ascend_project == 'thumbslider') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, $slidewidth, $slideheight, 'image', 'kt-slider-same-image-ratio-thumb', 'thumb');
        echo '</section>'; 

    } else if ($ascend_project == 'imagegrid') { 

        $image_gallery 	= get_post_meta( $post->ID, '_kad_image_gallery', true );
       	$columns 		= get_post_meta( $post->ID, '_kad_portfolio_img_grid_columns', true );
       	if(empty($columns)) {$columns = '4';}
        echo '<section class="postfeat">';
            echo do_shortcode('[gallery ids="'.esc_attr($image_gallery).'" columns="'.esc_attr($columns).'"]');
        echo '</section>'; 

    } else if ($ascend_project == 'collage') { 
    		global $ascend_has_sidebar;
    		$ascend_has_sidebar = 'false';
            echo '<section class="postfeat">';
                ascend_build_image_collage($post->ID, 'image', $ascend_has_sidebar);
            echo '</section>';

    } else if ($ascend_project == 'video') { 

            echo '<section class="postfeat">';
                echo '<div style="max-width:'.esc_attr($slidewidth).'px; margin:0 auto;">';
                            get_template_part('templates/post', 'video-output');
                echo '</div>';
            echo '</section>';

    } else if ($ascend_project == 'image') {
        if (has_post_thumbnail( $post->ID ) ) {          
            $image_id = get_post_thumbnail_id();
            $img = ascend_get_image_array($slidewidth, $slideheight, true, null, get_the_title(), $image_id, false);
            if( ascend_lazy_load_filter() ) {
                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
            } else {
                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
            }
                   ?>
            <div class="imghoverclass postfeat post-single-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <a href="<?php echo esc_url($img['full']); ?>" data-rel="lightbox">
                    <img <?php echo $image_src_output; ?> itemprop="contentUrl" alt="<?php esc_attr($img['alt']); ?>" width="<?php echo esc_attr($img['width']);?>" height="<?php echo esc_attr($img['height']);?>" <?php echo $img['srcset'];?> />
                    <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
                    <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>px">
                    <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>px">
                </a>
            </div>
        <?php
        } 
    }  else if ($ascend_project == 'imgcarousel') { ?>
        <section class="postfeat kt-upper-head-content post-carousel-upper">
            <div class="slick-slider kad-light-gallery kt-slickslider kt-image-carousel loading" data-slider-speed="7000" data-slider-anim-speed="400" data-slider-fade="false" data-slider-type="carousel" data-slider-auto="true" data-slider-arrows="true">
                    <?php
                    $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                    if(!empty($image_gallery)) {
                        $attachments = array_filter( explode( ',', $image_gallery ) );
                        if ($attachments) {
                            foreach ($attachments as $attachment) {
                                $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                                $img = ascend_get_image_array(null, $slideheight, true, null, $alt, $attachment, false);
                                if( ascend_lazy_load_filter() ) {
                                    $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                                } else {
                                    $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                                }
                                echo '<div class="kt-slick-slide">';
                                    echo '<a href="'.esc_url($img['full']).'" data-rel="lightbox">';
                                        echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" itemprop="image" '.$img['srcset'].'/>';
                                    echo '</a>';
                                echo '</div>';
                            }
                        }
                    } ?>                        
            </div> <!--Image Slider-->
        </section>
<?php } 