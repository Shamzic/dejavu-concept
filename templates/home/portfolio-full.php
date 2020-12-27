<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $ascend_portfolio_loop, $ascend_portfolio_loop_count;
$ascend = ascend_get_options();
	if(!empty($ascend['portfolio_full_title'])) {
		$btitle = $ascend['portfolio_full_title'];
	} else { 
		$btitle = '';
	}
	if(isset($ascend['home_portfolio_full_show_type']) && $ascend['home_portfolio_full_show_type'] == '0') {
		$portfolio_item_types = 'false';
	} else {
		$portfolio_item_types = 'true';
	}
	if(isset($ascend['home_portfolio_full_order'])) {
		$p_orderby = $ascend['home_portfolio_full_order'];
	} else {
		$p_orderby = 'menu_order';
	}
	if($p_orderby == 'menu_order' || $p_orderby == 'title') {
   		$p_order = 'ASC';
   	} else {
   		$p_order = 'DESC';
   	}
	if(isset($ascend['home_portfolio_full_show_excerpt']) && $ascend['home_portfolio_full_show_excerpt'] == '1') {
		$portfolio_excerpt = 'true';
	} else {
		$portfolio_excerpt = 'false';
	}
	if(isset($ascend['home_portfolio_full_show_lightbox']) && $ascend['home_portfolio_full_show_lightbox'] == '0') {
		$portfolio_lightbox = 'false';
	} else {
		$portfolio_lightbox = 'true';
	}
	if(isset($ascend['home_portfolio_full_style']) ) {
		$portfolio_style = $ascend['home_portfolio_full_style'];
	} else {
   		if(isset($ascend['portfolio_tax_style'])) {
   			$portfolio_style = $ascend['portfolio_tax_style'];
   		} else {
   			$portfolio_style = 'pgrid';
   		}
	}
	if(isset($ascend['home_portfolio_full_ratio']) ) {
		$portfolio_ratio = $ascend['home_portfolio_full_ratio'];
	} else {
		$portfolio_ratio = 'square';
	}
	if(isset($ascend['home_portfolio_full_columns']) ) {
        $ascend_grid_columns = $ascend['home_portfolio_full_columns'];
    } else {
        $ascend_grid_columns = '4';
    }
    if(isset($ascend['home_portfolio_full_count']) ) {
        $portfolio_items = $ascend['home_portfolio_full_count'];
    } else {
        $portfolio_items = '8';
    }
    if(!empty($ascend['home_portfolio_full_type'])) { 
		$portfolio_type = get_term_by ('id',$ascend['home_portfolio_full_type'],'portfolio-type');
		$portfolio_type_slug = $portfolio_type->slug;
		$portfolio_type_id = $portfolio_type->id;
	} else {
		$portfolio_type_slug = '';
		$portfolio_type_id = '';
	}
    if($portfolio_style == 'poststyle') {
    	$margins 	= 'row';
    	$isoclass 	= 'init-masonry-intrinsic'; 
    } elseif($portfolio_style == 'pgrid-no-margin') {
    	$margins 	= 'row-nomargin';
    	$isoclass 	= 'init-masonry-intrinsic'; 
    } else {
    	$isoclass 	= 'init-masonry-intrinsic'; 
    	$margins 	= 'rowtight';
    }

    $ascend_portfolio_loop = array(
     	'lightbox' 		=> $portfolio_lightbox,
     	'showexcerpt' 	=> $portfolio_excerpt,
     	'showtypes' 	=> $portfolio_item_types,
     	'columns' 		=> $ascend_grid_columns,
     	'ratio' 		=> $portfolio_ratio,
     	'style' 		=> $portfolio_style,
     	'carousel' 		=> 'false',
     	'tileheight' 	=> '0',
    );
    
    echo '<div class="home-portfolio-full home-margin home-padding">';
		if(!empty($btitle)) {
			echo '<div class="clearfix">';
				echo '<h3 class="hometitle">';
					echo '<span>'.esc_html($btitle).'</span>';
				echo '</h3>';
			echo '</div>';
		}	
		echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($portfolio_style).'">';
            echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-masonry-selector=".p_item" data-masonry-style="masonry">';
				
			  	$loop = new WP_Query(array(
					'paged' 			=> $paged,
					'orderby' 			=> $p_orderby,
					'order' 			=> $p_order,
					'post_type' 		=> 'portfolio',
					'portfolio-type'	=> $portfolio_type_slug,
					'posts_per_page' 	=> $portfolio_items
					));
				
				if ( $loop ) : 
					$ascend_portfolio_loop_count['loop'] = 1;
					$ascend_portfolio_loop_count['count'] = $loop->post_count;
					while ( $loop->have_posts() ) : $loop->the_post();
								get_template_part('templates/content', 'loop-portfolio'); 
								$ascend_portfolio_loop_count['loop']++;
					endwhile; else: ?>
				 
						<div class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'ascend');?></div>
					
				<?php endif; ?>
            </div> <!--portfoliowrapper-->
        </div> <!--portfoliowrapper-outer-->
    </div> <!--home-portfolio-full -->
	<?php  
            wp_reset_postdata(); 
