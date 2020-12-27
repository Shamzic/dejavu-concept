<?php
/*
Template Name: Blog
*/
get_header(); 

global $post, $ascend_grid_carousel;
	$post_id = $post->ID;
    $ascend_grid_carousel = false;
    $blog_type 		= get_post_meta( $post_id, '_kad_blog_type', true );
    $blog_columns 	= get_post_meta( $post_id, '_kad_blog_columns', true );
    $blog_category 	= get_post_meta( $post_id, '_kad_blog_cat', true );
	$blog_order 	= get_post_meta( $post_id, '_kad_blog_order', true );
	$blog_items 	= get_post_meta( $post_id, '_kad_blog_items', true );
	$blog_cat 		= get_term_by ( 'id',$blog_category,'category' );
	if( $blog_category == '-1' || $blog_category == '' ) {
		$blog_cat_slug = '';
	} else {
		$blog_cat = get_term_by ( 'id',$blog_category,'category' );
		$blog_cat_slug = $blog_cat -> slug;
	} 
	if( $blog_items == 'all' ) {
		$blog_items = '-1';
	} 
	if( isset( $blog_order ) ) {
		$b_orderby = $blog_order;
   	} else {
   		$b_orderby = 'date';
   	}
	if( $b_orderby == 'menu_order' || $b_orderby == 'title' ) {
		$b_order = 'ASC';
	} else {
		$b_order = 'DESC';
	}
    $ascend_blog_loop['loop'] = 1;
    $paged = ( get_query_var( 'paged') ) ? get_query_var( 'paged' ) : 1;
    $lay = ascend_get_postlayout( $blog_type );

    $ascend_grid_columns 		= $blog_columns ? absint( $blog_columns ) : 3;
    if( ascend_display_sidebar() ) {
        $fullclass 		= '';
        $ascend_has_sidebar = true;
    } else {
        $fullclass 		= 'fullwidth';
        $ascend_has_sidebar = false;
    }
    $itemsize = ascend_get_post_grid_item_size( $ascend_grid_columns, $ascend_has_sidebar );

    /**
    * @hooked ascend_page_title - 20
    */
     do_action( 'ascend_page_title_container' );
    ?>
	
	<div id="content" class="container <?php echo esc_attr( ascend_container_class() ); ?>">
		<div class="row">
  			<div class="main <?php echo esc_attr( ascend_main_class() );?> <?php echo esc_attr( $lay['pclass'] ); ?>" id="ktmain" role="main">
	  			<?php 
                /**
                * @hooked ascend_page_content_wrap_before - 10
                * @hooked ascend_page_content - 20
                * @hooked ascend_page_content_wrap_after - 30
                */
                do_action('ascend_page_content');
                ?>
				<div class="kt_archivecontent <?php echo esc_attr( $lay['tclass'] ); ?>" data-masonry-selector="<?php echo esc_attr( $lay['data_selector'] );?>" data-masonry-style="<?php echo esc_attr( $lay['data_style'] );?>"> 
	  				<?php
	  				if( isset( $wp_query ) ) {
						$temp = $wp_query;
					} else {
						$temp = null;
					} 
	  				$args = array(
						'paged'		 	 	=> $paged,
						'orderby' 			=> $b_orderby,
						'order' 			=> $b_order,
						'category_name'	 	=> $blog_cat_slug,
						'posts_per_page' 	=> $blog_items
						);			
					$wp_query = new WP_Query( $args );
					if ( $wp_query ) : 
						$ascend_blog_loop['count'] = $wp_query->post_count;
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
					 	if($lay['sum'] == 'full'){ 
			                if ( has_post_format( 'quote' ) ) {
			                    get_template_part( 'templates/content', 'post-full-quote' ); 
			                } else {
			                    get_template_part( 'templates/content', 'post-full' ); 
			                }
				        } else if( $lay['sum'] == 'grid' ) { 
				        	if($lay['highlight'] == 'true' && $ascend_blog_loop['loop'] == 1 && $paged == 1) {
		                        get_template_part( 'templates/content', get_post_format() );
		                    } else { ?>
		                       	<div class="<?php echo esc_attr( $itemsize );?> b_item kad_blog_item">
		                       		<?php get_template_part( 'templates/content', 'post-grid' ); ?>
		                       	</div>
		                   <?php }
				        } else if( $lay['sum'] == 'photo' ) { ?>
			               	<div class="<?php echo esc_attr( $itemsize );?> b_item kad_blog_item">
	                       		<?php get_template_part( 'templates/content', 'post-photo-grid' ); ?>
	                       	</div>
				        <?php
				        } else if($lay['sum'] == 'below_title') {
				        	get_template_part( 'templates/content', 'post-title-above' );
				        } else { 
				        	get_template_part( 'templates/content', get_post_format() );
				        }
				        $ascend_blog_loop['loop'] ++;
	                endwhile; else: ?>
						<div class="error-not-found"><?php _e( 'Sorry, no blog entries found.', 'ascend' ); ?></div>
					<?php 
					endif; 
            		?>
            	 </div><!-- /.archive content -->
            	 <?php 
		    		/**
	                * @hooked ascend_pagination - 20
	                */
	                do_action( 'ascend_pagination' );
	                $wp_query = $temp;  // Reset 
                	wp_reset_postdata();
	                /**
	                * @hooked ascend_page_comments - 20
	                */
	                do_action( 'ascend_page_footer' );
	                ?>		
			</div><!-- /.main -->
			<?php
				/**
			    * Sidebar
			    */
				if ( ascend_display_sidebar() ) : 
				      	get_sidebar();
			    endif; ?>
    		</div><!-- /.row-->
    	</div><!-- /.content -->
    	<?php 

		get_footer(); 