<?php 
/*
* Page Template
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
                ?>
				<?php 
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