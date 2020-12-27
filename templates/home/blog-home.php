<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$ascend = ascend_get_options();
	// Check for Sidebar
	if(isset($ascend['home_post_column'])) {
	} 

	if(!empty($ascend['home_blog_title'])) {
		$btitle = $ascend['home_blog_title'];
	} else { 
		$btitle = '';
	}
	if(isset($ascend['home_blog_style'])) {
		$type = $ascend['home_blog_style'];
	} else {
		$type = 'grid'; 
	}
	if(isset($ascend['home_post_count'])) {
		$blogcount = $ascend['home_post_count'];
	} else {
		$blogcount = '4'; 
	}
	if(isset($ascend['home_post_column'])) {
		$blogcolumns = $ascend['home_post_column'];
	} else {
		$blogcolumns = '3'; 
	}
	if(!empty($ascend['home_post_type'])) { 
		$blog_cat = get_term_by ('id',$ascend['home_post_type'],'category');
		$blog_cat_slug = $blog_cat -> slug;
	} else {
		$blog_cat_slug = '';
	}

echo '<div class="home_blog home-margin clearfix home-padding">';
	if(!empty($btitle)) {
		echo '<div class="clearfix">';
			echo '<h3 class="hometitle">';
				echo '<span>'.esc_html($btitle).'</span>';
			echo '</h3>';
		echo '</div>';
	}
	$lay = ascend_get_postlayout($type);
	global $ascend_grid_columns, $ascend_blog_loop, $ascend_grid_carousel;
	$ascend_blog_loop['loop'] = 1;
	$ascend_grid_columns = $blogcolumns;
	$ascend_grid_carousel = false;
	$itemsize = ascend_get_post_grid_item_size($blogcolumns, false);
	 ?>
   	<div class="kt_blog_home <?php echo esc_attr($lay['pclass']); ?>">
	   	<div class="kt_archivecontent <?php echo esc_attr($lay['tclass']);?>" data-masonry-selector="<?php echo esc_attr($lay['data_selector']);?>" data-masonry-style="<?php echo esc_attr($lay['data_style']);?>"> 
		   	<?php 
			$loop = new WP_Query(array(
				'orderby' 				=> 'date',
				'order' 				=> 'DESC',
				'category_name'	 		=> $blog_cat_slug,
				'post_type' 			=> 'post',
				'ignore_sticky_posts' 	=> false,
				'posts_per_page' 		=> $blogcount
				));
		if ( $loop ) : 
			$ascend_blog_loop['count'] = $loop->post_count;

			while ( $loop->have_posts() ) : $loop->the_post();
			if($lay['sum'] == 'full'){ 
                if (has_post_format( 'quote' )) {
                    get_template_part('templates/content', 'post-full-quote'); 
                } else {
                    get_template_part('templates/content', 'post-full'); 
                }
	        } else if($lay['sum'] == 'grid') { 
	        	if($lay['highlight'] == 'true' && $ascend_blog_loop['loop'] == 1) {
                    get_template_part('templates/content', get_post_format());
                } else { ?>
                   	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
                   		<?php get_template_part('templates/content', 'post-grid'); ?>
                   	</div>
               <?php }
	        } else if($lay['sum'] == 'photo') { ?>
               	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
               		<?php get_template_part('templates/content', 'post-photo-grid'); ?>
               	</div>
	        <?php
	        } else if($lay['sum'] == 'below_title') {
	        	get_template_part('templates/content', 'post-title-above');
	        } else { 
	        	get_template_part('templates/content', get_post_format());
	        }
	        $ascend_blog_loop['loop'] ++;
        endwhile; else: ?>
			<div class="error-not-found"><?php _e('Sorry, no blog entries found.', 'ascend'); ?></div>
		<?php 
		endif; 

		wp_reset_postdata(); ?>
		</div>
	</div>
	<?php  	
	if(isset($ascend['home_post_readmore']) && $ascend['home_post_readmore'] == 1) {
		if(isset($ascend['home_post_readmore_text'])) {
			$readmore = $ascend['home_post_readmore_text'];
		} else {
			$readmore = __('Read More', 'ascend'); 
		}
		if(isset($ascend['home_post_readmore_link'])) {
			$link = $ascend['home_post_readmore_link'];
		} else {
			$link = ''; 
		}
		echo '<div class="home_blog_readmore">';
			echo '<a href="'.esc_url(get_permalink($link)).'" class="btn btn-primary">'.esc_html($readmore).'</a>';
		echo '</div>';
	}
echo '</div>';