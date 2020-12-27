<?php 
/* 
* Front Page Template
*/
    get_header(); 

    /**
    * @hooked ascend_front_page_header - 20
    */
    do_action('ascend_front_page_title_container');                

?>
    <div id="content" class="container homepagecontent <?php echo esc_attr( ascend_container_class() ); ?>">
   		<div class="row">
        	<div class="main <?php echo esc_attr(ascend_main_class()); ?>" role="main">
          		<div class="entry-content" itemprop="mainContentOfPage">

		      	<?php
		      	$ascend = ascend_get_options();
		      	if(isset($ascend['homepage_layout'])) { 
		      		$layout = array();
		      		foreach ($ascend['homepage_layout'] as $key => $value) {
		      			if($value == 1) {
		      				$layout[$key] = $value;
		      			}
		      		}
		  		} else {
		  			// Default layout show content
		  			$layout = array("block_one" => "1");
		  		}

				if ($layout):

					foreach ($layout as $key=>$value) {

					    switch($key) {

					    	case 'block_one':
						    	// Page Content
						    	if(is_home()) {
						    		get_template_part('templates/home/blog', 'main-loop');
						    	} else {
						    		/**
					                * @hooked ascend_page_content_wrap_before - 10
					                * @hooked ascend_page_content - 20
					                * @hooked ascend_page_content_wrap_after - 30
					                */
					                do_action('ascend_page_content');
						    	}
						    break;
						    case 'block_two': 
						    	// latest posts
						    	get_template_part('templates/home/blog', 'home'); 
					    		
						    break;
							case 'block_three':
								// product carousel
								if (class_exists('woocommerce'))  {
									get_template_part('templates/home/product', 'carousel');
								}
							break;
							case 'block_four':
								// image menu
								get_template_part('templates/home/image', 'menu');
							break;
							case 'block_five':
							// Icon menu
								 	get_template_part('templates/home/icon', 'menu');	
							break;
							case 'block_six':
							// portfolio carousel
									get_template_part('templates/home/portfolio', 'carousel');		 
							break; 
							case 'block_seven':
							// portfolio main loop
								get_template_part('templates/home/portfolio', 'full');			 
							break;
						}
					}
				endif; ?>   
				</div>
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

