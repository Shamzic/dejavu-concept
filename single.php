<?php
/**
* Single Template
*/
	/**
    * Header
    */
	get_header(); 

		/**
	    * @hooked asencd_single_post_header - 20
	    */
	    do_action('ascend_post_header');

		/**
	    * @hooked ascend_single_post_upper_headcontent - 10
	    */
	    do_action( 'ascend_single_post_begin' ); 
	    ?>
		<div id="content" class="container clearfix">
    		<div class="row single-article">
    			<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
			    	<?php 
					/**
				    * Content
				    */
					if (has_post_format( 'quote' )) {
						get_template_part('templates/content', 'single-quote'); 
					} else {
						get_template_part('templates/content', 'single'); 
					}
					?>
				</div><!-- /.main-->

				<?php
				/**
			    * Sidebar
			    */
				if (ascend_display_sidebar()) : 
				      	get_sidebar();
			    endif; ?>
    		</div><!-- /.row-->
    	</div><!-- /#content -->
    	<?php 
    /**
    * Footer
    */
	get_footer(); ?>