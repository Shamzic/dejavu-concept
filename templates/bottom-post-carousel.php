<?php 
/* 
 * Template Bottom Post Carousel
 */

global $post, $ascend_has_sidebar, $ascend_grid_columns, $ascend_bottom_carousel, $ascend_grid_carousel;
$ascend = ascend_get_options();
		if(isset($ascend['post_carousel_columns']) ) {
            $ascend_grid_columns = $ascend['post_carousel_columns'];
        } else {
            $ascend_grid_columns = '3';
        }
        if(ascend_display_sidebar()) {
            $ascend_has_sidebar = true;
        } else {
            $ascend_has_sidebar = false;
        }
        $ascend_grid_carousel = true;
        if($ascend_bottom_carousel == 'similar') {
            $default_title = __('Similar Posts', 'ascend');
            $categories = get_the_category($post->ID);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category){
                    $category_ids[] = $individual_category->term_id;
                }
            }
            $args = array(
                    'orderby' => 'rand',
                    'category__in' => $category_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=> 8
                    );
        } else {
            $default_title = __('Recent Posts', 'ascend');
            $args = array(
                    'post__not_in'   => array($post->ID),
                    'posts_per_page' => 8
                    );
        }
        $bc = array();
        $itemsize = ascend_get_post_grid_item_size($ascend_grid_columns, $ascend_has_sidebar);
        $bc = ascend_carousel_columns($ascend_grid_columns, $ascend_has_sidebar);
        $bc = apply_filters('ascend_bottom_post_carousel_columns', $bc);
        $title = apply_filters( 'ascend_bottom_post_title', $default_title );

?>
<div id="blog_carousel_container" class="carousel_outerrim post-footer-section">
	<?php
        echo '<h4 class="kt-title bottom-carousel-title post-carousel-title"><span>'.esc_html($title).'</span></h4>'; ?>

    <div class="blog-bottom-carousel">
		<div class="blog-carouselcontainer row-margin-small">
    		<div id="blog-recent-carousel" class="slick-slider blog_carousel kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="1" data-slider-auto="true" data-slider-speed="9000" data-slider-xxl="<?php echo esc_attr($bc['xxl']);?>" data-slider-xl="<?php echo esc_attr($bc['xl']);?>" data-slider-md="<?php echo esc_attr($bc['md']);?>" data-slider-sm="<?php echo esc_attr($bc['sm']);?>" data-slider-xs="<?php echo esc_attr($bc['xs']);?>" data-slider-ss="<?php echo esc_attr($bc['ss']);?>">
            <?php
				$bpc = new WP_Query(apply_filters('ascend_bottom_posts_carousel_args', $args));
				if ( $bpc ) : while ( $bpc->have_posts() ) : $bpc->the_post(); ?>
				    <div class="<?php echo esc_attr($itemsize);?> blog_carousel_item kt-slick-slide">
                    <?php get_template_part('templates/content', 'post-photo-grid'); ?>
                    </div>
				
                <?php endwhile; else: ?>
				    <div class="error-not-found"><?php _e('Sorry, no blog entries found.', 'ascend');?></div>

				<?php endif; 
				wp_reset_postdata(); ?>								
			</div>
        </div>
    </div>
</div><!-- Blog Container-->				