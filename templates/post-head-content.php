<?php 
global $post, $ascend_feat_width, $ascend_has_sidebar;
	$ascend = ascend_get_options();
    if (has_post_format( 'gallery' )) {
        $swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true ); 
        $height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
        if (!empty($height)) {
            $slideheight = $height;
            $imageheight = $height;
        } else {
            $slideheight = 400;
            $imageheight = apply_filters('ascend_single_post_image_height', 400); 
        }
        if (!empty($swidth)) {
            $slidewidth = $swidth;
        } else {
            $slidewidth = $ascend_feat_width;
        } 
    } elseif (has_post_format( 'image' )) {
        $swidth = get_post_meta( $post->ID, '_kad_image_posthead_width', true );
        $height = get_post_meta( $post->ID, '_kad_image_posthead_height', true );
        if (!empty($height)) {
            $imageheight = $height;
        } else {
            $imageheight = apply_filters('ascend_single_post_image_height', 400); 
        }
        if (!empty($swidth)) {
            $slidewidth = $swidth;
        } else {
            $slidewidth = $ascend_feat_width;
        }
    } elseif (has_post_format( 'video' )) {
        $swidth = get_post_meta( $post->ID, '_kad_video_posthead_width', true );
        if (!empty($swidth)) {
            $slidewidth = $swidth;
        } else {
            $slidewidth = $ascend_feat_width;
        }
    }

    $ascend_headcontent = ascend_get_post_head_content();

    if ($ascend_headcontent == 'flex') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, $slidewidth, $slideheight, 'image', 'kt-slider-same-image-ratio');
        echo '</section>';

    } else if ($ascend_headcontent == 'carouselslider') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, null, $slideheight, 'image', 'kt-slider-different-image-ratio');
        echo '</section>';
        
    } else if ($ascend_headcontent == 'thumbslider') { 

        $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
        echo '<section class="postfeat">';
            ascend_build_slider($post->ID, $image_gallery, $slidewidth, $slideheight, 'image', 'kt-slider-same-image-ratio-thumb', 'thumb');
        echo '</section>'; 

    } else if ($ascend_headcontent == 'gallery') { 

            echo '<section class="postfeat">';
            	ascend_build_image_collage($post->ID, 'image', $ascend_has_sidebar);
            echo '</section>';

    } else if ($ascend_headcontent == 'video') { 

            echo '<section class="postfeat">';
                echo '<div style="max-width:'.esc_attr($slidewidth).'px; margin:0 auto;">';
                            get_template_part('templates/post', 'video-output');
                echo '</div>';
            echo '</section>';

    } else if ($ascend_headcontent == 'image') {
        if (has_post_thumbnail( $post->ID ) ) {          
            $image_id = get_post_thumbnail_id();
            $img = ascend_get_image_array($slidewidth, $height, true, null, get_the_title(), $image_id, false);
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
    }