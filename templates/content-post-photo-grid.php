<?php 

global $post, $ascend_has_sidebar, $ascend_grid_columns, $ascend_grid_carousel;
	$ascend = ascend_get_options();
    if($ascend_has_sidebar) {
        if(!empty($ascend_grid_columns)) {
            if($ascend_grid_columns == '3') {
                $image_width = 420;
                $image_height = 280;
            } else if($ascend_grid_columns == '2') {
                $image_width = 660;
                $image_height = 440;
            } else {
                $image_width = 360;
                $image_height = 240;
            }
        } else {
            $image_width = 360;
            $image_height = 240;
        }
    } else {
        if(!empty($ascend_grid_columns)) {
            if($ascend_grid_columns == '3') {
                $image_width = 480;
                $image_height = 320;

            } else if($ascend_grid_columns == '2') {
                $image_width = 660;
                $image_height = 440;
            } else {
                $image_width = 360;
                $image_height = 240;
            }
        } else {
            $image_width = 360;
            $image_height = 240;
        }
    }

    $image_width = apply_filters('ascend_post_grid_image_width', $image_width);
    $image_height = apply_filters('ascend_post_grid_image_height', $image_height);
    if ( isset( $ascend_grid_carousel ) && $ascend_grid_carousel != true) {
	    if ( isset( $ascend['postexcerpt_hard_crop']) && $ascend['postexcerpt_hard_crop'] == 1) {
	        $image_crop = true;
	    } else {
	        $image_height = null;
	        $image_crop = false;
	    }
	} else {
		$image_crop = true;
	}
    ?>
    <article id="post-<?php the_ID(); ?>" class="blog_item blog_photo_item kt_item_fade_in grid_item">
        <div class="imghoverclass img-margin-center blog-grid-photo">
        <?php 
        $img = ascend_get_image_array( $image_width, $image_height, $image_crop, null, null, null, true );
        if( ascend_lazy_load_filter() ) {
            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
        } else {
            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
        }
        ?>
            <div class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr(($img['height']/$img['width']) * 100);?>%;">
                <?php 
                echo '<div>';
                    echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'">';
                echo '</div>';
               ?>
            </div> 
        </div>
        <div class="photo-postcontent">
            <div class="photo-post-bg">
            </div>
            <div class="photo-postcontent-inner">
                <?php 
                /**
                *
                */
                do_action( 'ascend_post_photo_grid_excerpt_before_header' );
                ?>
                <header>
                    <?php 
                    /**
                    * @hooked ascend_post_grid_excerpt_header_title - 10
                    */
                    do_action( 'ascend_post_photo_grid_excerpt_header' );
                    ?>
                </header>
                <div class="kt-post-photo-added-content">
                    <?php 
                    /**
                    * @hooked ascend_post_header_meta_categories - 20
                    */
                    do_action( 'ascend_post_photo_grid_excerpt_after_header' );
                    ?>
                </div>
            </div>
            <a href="<?php the_permalink() ?>" class="photo-post-link">
            </a>
        </div><!-- Text size -->
        <?php 
        /**
        * 
        */
        do_action( 'ascend_post_grid_excerpt_after_footer' );
        ?>
    </article> <!-- Blog Item -->