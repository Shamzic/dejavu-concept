<?php
/*
* Standard post Archive
*
*/

    get_header(); 
    global $ascend_has_sidebar, $ascend_grid_columns, $ascend_blog_loop, $ascend_grid_carousel; 
    $ascend 				= ascend_get_options();
    $ascend_grid_carousel 		= false;
    $ascend_blog_loop['loop'] 	= 1;
    $paged 					= ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    if(isset($ascend['category_post_summary'])) {
    	$layout = $ascend['category_post_summary'];
    } else {
    	$layout = 'normal';
    }
    $lay 	= ascend_get_postlayout($layout);
    if(isset($ascend['category_post_grid_column'])) {
        $ascend_grid_columns = $ascend['category_post_grid_column'];
    } else {
        $ascend_grid_columns = '3';
    } 
    if(ascend_display_sidebar()) {
        $fullclass 			= '';
        $ascend_has_sidebar 	= true;
    } else {
        $fullclass 			= 'fullwidth';
        $ascend_has_sidebar 	= false;
    }
    $itemsize = ascend_get_post_grid_item_size( $ascend_grid_columns, $ascend_has_sidebar );
    /**
    * @hooked ascend_archive_title - 20
    */
     do_action('ascend_archive_title_container');
    ?>
<div id="content" class="container clearfix">
    <div class="row">
        <div class="main <?php echo esc_attr( ascend_main_class() ); ?>  <?php echo esc_attr( $lay[ 'pclass' ] ) .' '. esc_attr( $fullclass ); ?> clearfix" role="main">

        <?php if (!have_posts()) : ?>
            <div class="error-not-found">
                <?php esc_html_e( 'Sorry, no results were found.', 'ascend' ); ?>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
            <div class="kt_archivecontent <?php echo esc_attr($lay['tclass']); ?>" data-masonry-selector="<?php echo esc_attr($lay['data_selector']);?>" data-masonry-style="<?php echo esc_attr($lay['data_style']);?>"> 
                <?php 
                $ascend_blog_loop['count'] = $wp_query->post_count;
                while (have_posts()) : the_post();
	                if($lay['sum'] == 'full'){ 
	                    if (has_post_format( 'quote' )) {
	                        get_template_part('templates/content', 'post-full-quote'); 
	                    } else {
	                        get_template_part('templates/content', 'post-full'); 
	                    }
	                } else if($lay['sum'] == 'grid') { 
	                    if($lay['highlight'] == 'true' && $ascend_blog_loop['loop'] == 1 && $paged == 1) {
	                        get_template_part('templates/content', get_post_format());
	                    } else { ?>
	                        <div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
	                            <?php get_template_part( 'templates/content', 'post-grid' ); ?>
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
	            endwhile;
	            ?>
	            </div><!-- /.archive content -->
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

    get_footer(); 
