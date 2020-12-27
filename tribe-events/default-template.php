<?php 
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


    get_header(); 

	/**
    * @hooked asencd_single_post_header - 20
    */
    do_action('ascend_post_header');
    ?>
    <div id="content" class="container">
   		<div class="row">
	      	<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
                <div id="tribe-events-pg-template">
					<?php 
						tribe_events_before_html(); 
						tribe_get_view(); 
						tribe_events_after_html(); 
						?>
				</div> <!-- #tribe-events-pg-template -->
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