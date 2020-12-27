<?php 
  	get_header(); 
    /**
    * @hooked ascend_archive_title - 20
    */
     do_action('ascend_archive_title_container');
    ?>
	
    <div id="content" class="container clearfix">
   		<div class="row">
      		<div class="main <?php echo esc_attr( ascend_main_class() ); ?>" role="main">
      			<div class="entry-content">
      				<?php echo category_description(); ?>
      			</div>
				<?php if ( ! have_posts() ) : ?>
		            <div class="error-not-found entry-content">
		                <h5><?php esc_html_e( 'Sorry, no results were found.', 'ascend' ); ?></h5>
		                <?php get_search_form(); ?>
		            </div>
				<?php endif; 
				global $ascend_portfolio_loop, $ascend_portfolio_loop_count;
				$ascend = ascend_get_options();
				if( isset( $ascend[ 'portfolio_tax_show_type'] ) && $ascend['portfolio_tax_show_type'] == '0' ) {
					$portfolio_item_types = 'false';
				} else {
					$portfolio_item_types = 'true';
				}
				if( isset( $ascend['portfolio_tax_show_excerpt'] ) && $ascend['portfolio_tax_show_excerpt'] == '1' ) {
					$portfolio_excerpt = 'true';
				} else {
					$portfolio_excerpt = 'false';
				}
				if(isset($ascend['portfolio_tax_show_lightbox']) && $ascend['portfolio_tax_show_lightbox'] == '0' ) {
					$portfolio_lightbox = 'false';
				} else {
					$portfolio_lightbox = 'true';
				}
				if(isset($ascend['portfolio_tax_style']) ) {
					$portfolio_style = $ascend['portfolio_tax_style'];
				} else {
			   		$portfolio_style = 'pgrid';
				}
				if(isset($ascend['portfolio_tax_ratio']) ) {
					$portfolio_ratio = $ascend['portfolio_tax_ratio'];
				} else {
					$portfolio_ratio = 'square';
				}
				if(isset($ascend['portfolio_tax_column']) ) {
			        $ascend_grid_columns = $ascend['portfolio_tax_column'];
			    } else {
			        $ascend_grid_columns = '4';
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
			    
					echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($portfolio_style).'">';
			            echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-masonry-selector=".p_item" data-masonry-style="masonry">';
							
							global $wp_query;							
							if ( $wp_query ) : 
								$ascend_portfolio_loop_count['loop'] = 1;
								$ascend_portfolio_loop_count['count'] = $wp_query->post_count;
								while ( $wp_query->have_posts() ) : $wp_query->the_post();
											get_template_part('templates/content', 'loop-portfolio'); 
											$ascend_portfolio_loop_count['loop']++;
								endwhile;
							endif; ?>
			            </div> <!--portfoliowrapper-->
			        </div> <!--portfoliowrapper-outer-->
                
                <?php 
                	/**
	                * @hooked ascend_pagination - 20
	                */
	                do_action('ascend_pagination');
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
/**
* Footer
*/
get_footer(); ?>