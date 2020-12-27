<?php
/*
Template Name: Portfolio Grid
*/

get_header(); 
    /**
    * @hooked ascend_page_title - 20
    */
     do_action('ascend_page_title_container');
    ?>
	
    <div id="content" class="container <?php echo esc_attr( ascend_container_class() ); ?>">
   		<div class="row">
      		<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
      		<?php
			/**
            * @hooked ascend_page_content_wrap_before - 10
            * @hooked ascend_page_content - 20
            * @hooked ascend_page_content_wrap_after - 30
            */
            do_action('ascend_page_content');

      		global $post, $ascend_portfolio_loop, $ascend_portfolio_loop_count; 
      		$ascend = ascend_get_options();
  			$portfolio_type 		= get_post_meta( $post->ID, '_kad_portfolio_type', true );
		   	$portfolio_items 		= get_post_meta( $post->ID, '_kad_portfolio_items', true );
		   	$portfolio_order 		= get_post_meta( $post->ID, '_kad_portfolio_orderby', true );
		   	$portfolio_column 		= get_post_meta( $post->ID, '_kad_portfolio_columns', true );
		   	$portfolio_excerpt 		= get_post_meta( $post->ID, '_kad_portfolio_excerpt', true );
		   	$portfolio_item_types 	= get_post_meta( $post->ID, '_kad_portfolio_types', true );
		   	$portfolio_ratio 		= get_post_meta( $post->ID, '_kad_portfolio_ratio', true );
		   	$portfolio_style 		= get_post_meta( $post->ID, '_kad_portfolio_style', true );
		   	$portfolio_lightbox 	= get_post_meta( $post->ID, '_kad_portfolio_lightbox', true );

		   	if(!empty($portfolio_order)) {
		   		$p_orderby = $portfolio_order;
		   	} else {
		   		$p_orderby = 'menu_order';
		   	}
		   	if($p_orderby == 'menu_order' || $p_orderby == 'title') {
		   		$p_order = 'ASC';
		   	} else {
		   		$p_order = 'DESC';
		   	}
		   	if(!empty($portfolio_lightbox)) {
      			$portfolio_lightbox = $portfolio_lightbox;
      		} else {
      			$portfolio_lightbox = 'true';
      		}
      		if(!empty($portfolio_ratio)) {
      			$portfolio_ratio = $portfolio_ratio;
      		} else {
      			$portfolio_ratio = 'square';
      		}
      		if(!empty($portfolio_item_types)) {
      			$portfolio_item_types = $portfolio_item_types;
      		} else {
      			$portfolio_item_types = 'true';
      		}
      		if(!empty($portfolio_excerpt)) {
      			$portfolio_excerpt = $portfolio_excerpt;
      		} else {
      			$portfolio_excerpt = 'false';
      		}
      		if(!empty($portfolio_column)) {
      			$portfolio_column = $portfolio_column;
      		} else {
      			$portfolio_column = '3';
      		}
			if($portfolio_type == '-1' || empty($portfolio_type)) {
				$portfolio_type_slug = '';
				$portfolio_type = '';
			} else {
				$portfolio_cat = get_term_by ('id',$portfolio_type,'portfolio-type' );
				$portfolio_type_slug = $portfolio_cat -> slug;
			}
			if($portfolio_items == 'all') { 
				$portfolio_items = '-1'; 
			}
			if(!empty($portfolio_style)) {
		   		$style = $portfolio_style;
		   	} else {
		   		$style = 'default';
		   	}
		   	if($style == 'default') {
		   		if(isset($ascend['portfolio_tax_style'])) {
		   			$style = $ascend['portfolio_tax_style'];
		   		} else {
		   			$style = 'pgrid';
		   		}
		   	}
            if($style == 'poststyle') {
            	$margins 	= 'row';
            	$isoclass 	= 'init-masonry-intrinsic'; 
            } elseif($style == 'pgrid-no-margin') {
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
             	'columns' 		=> $portfolio_column,
             	'ratio' 		=> $portfolio_ratio,
             	'style' 		=> $style,
             	'carousel' 		=> 'false',
             	'tileheight' 	=> '0',
            );

            	echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($style).'">';
               		echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-masonry-selector=".p_item" data-masonry-style="masonry">';
					if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					} 
				  	$wp_query = new WP_Query(array(
						'paged' 			=> $paged,
						'orderby' 			=> $p_orderby,
						'order' 			=> $p_order,
						'post_type' 		=> 'portfolio',
						'portfolio-type'	=> $portfolio_type_slug,
						'posts_per_page' 	=> $portfolio_items
						));
					if ( $wp_query ) : 
						$ascend_portfolio_loop_count['loop'] = 1;
						$ascend_portfolio_loop_count['count'] = $wp_query->post_count;
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
									get_template_part('templates/content', 'loop-portfolio'); 
									$ascend_portfolio_loop_count['loop']++;
						endwhile; else: ?>
					 
							<div class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'ascend');?></div>
						
						<?php endif; ?>
                	</div> <!--portfoliowrapper-->
                </div> <!--portfoliowrapper-outer-->
                                    
                <?php 
                /**
                * @hooked ascend_pagination - 20
                */
                do_action('ascend_pagination');
                $wp_query = $temp;  // Reset 
                wp_reset_postdata();

                /**
                * @hooked ascend_page_comments - 20
                */
                do_action('ascend_page_footer');
                ?>
			</div><!-- /.main -->
			<?php 
			/**
		    * Sidebar
		    */
			if (ascend_display_sidebar()) : 
			      	get_sidebar();
		    endif; ?>
		</div><!-- /.row-->
	</div><!-- /.content -->
	<?php 

    get_footer(); 
