<?php 

global $post, $ascend_has_sidebar, $ascend_grid_columns;
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

	$image_width = apply_filters( 'ascend_post_grid_image_width', $image_width );
	$image_height = apply_filters( 'ascend_post_grid_image_height', $image_height );

	if ( isset( $ascend['postexcerpt_hard_crop'] ) && $ascend['postexcerpt_hard_crop'] == 1 ) {
		// do nothing
		$image_crop = true;
	} else {
		$image_height = null;
		$image_crop = false;
	}

    $postsummery = ascend_get_postsummary();
    ?>
    <article id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in grid_item kt-post-summary-<?php echo esc_attr($postsummery);?>">
    <?php 
    if($postsummery == 'img_landscape' || $postsummery == 'img_portrait') { ?>
        <div class="imghoverclass img-margin-center blog-grid-media">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <?php
                echo ascend_get_full_image_output($image_width, $image_height, $image_crop, 'attachment-thumb wp-post-image kt-image-link', null, null, true, false, true); 
               	?>
            </a> 
        </div>
    <?php 
    } elseif($postsummery == 'slider_landscape' || $postsummery == 'slider_portrait' || $postsummery == 'gallery_grid') { 
        echo '<div class="blog-grid-media">';
            $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
            $attachments = array_filter( explode( ',', $image_gallery ) );
            if (!empty($attachments)) {
                $img = ascend_get_image_array($image_width, $image_height, $image_crop, null, null, $attachments[0], true);
            } else {
	            $attach_args = array('order'=> 'ASC','post_type'=> 'attachment','post_parent'=> $post->ID,'post_mime_type' => 'image','post_status'=> null,'orderby'=> 'menu_order','numberposts'=> -1);
	            $attachments_posts = get_posts($attach_args);
	            if(isset($attachments_posts[0]->ID) && !empty($attachments_posts[0]->ID) ) {
	            	$img = ascend_get_image_array($image_width, $image_height, $image_crop, null, null, $attachments_posts[0]->ID, true);
	            } else {
	            	$img['width'] = $image_width;
	            	$img['height'] = $image_width;
	            }
            }
            ascend_build_slider($post->ID, $image_gallery, $img['width'], $img['height'], 'post', 'kt-slider-same-image-ratio');
        echo '</div>';

    } elseif($postsummery == 'video') {
        echo '<div class="blog-grid-media">';
            get_template_part('templates/post', 'video-output');
        echo '</div>';
    }?>

    <div class="postcontent">
        <?php 
        /**
        * @hooked ascend_post_header_meta_categories - 20
        */
        do_action( 'ascend_post_grid_excerpt_before_header' );
        ?>
        <header>
            <?php 
            /**
            * @hooked ascend_post_grid_excerpt_header_title - 10
            * @hooked ascend_post_grid_header_meta - 20
            */
            do_action( 'ascend_post_grid_excerpt_header' );
            ?>
        </header>
        <div class="entry-content">
             <?php 
             do_action( 'ascend_post_grid_excerpt_content_before' );

             the_excerpt();

             do_action( 'ascend_post_grid_excerpt_content_after' );
            ?>
        </div>

        <footer>
        <?php 
        /**
        * @hooked ascend_post_footer_tags - 10
        */
        do_action( 'ascend_post_grid_excerpt_footer' );
        ?>
        </footer>
    </div><!-- Text size -->
    <?php 
    /**
    * 
    */
    do_action( 'ascend_post_grid_excerpt_after_footer' );
    ?>
</article> <!-- Blog Item -->