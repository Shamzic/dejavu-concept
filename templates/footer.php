<?php
	$ascend = ascend_get_options();

	do_action('ascend_before_footer');
?>
<footer id="containerfooter" class="footerclass">
  <div class="container">
  	<div class="row">
  		<?php if(isset($ascend['footer_layout'])) { $footer_layout = $ascend['footer_layout']; } else { $footer_layout = 'fourc'; }
  			if ($footer_layout == "fourc") {
  				if (is_active_sidebar('footer_1') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div> 
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol4">
					<?php dynamic_sidebar('footer_4'); ?>
					</div> 
		        <?php }; ?>
		    <?php } else if($footer_layout == "threec") {
		    	if (is_active_sidebar('footer_1') ) { ?> 
					<div class="col-md-4 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="col-md-4 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="col-md-4 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div> 
	            <?php }; ?>
	         <?php } else if($footer_layout == "three_single") {
		    	if (is_active_sidebar('footer_1') ) { ?> 
					<div class="col-md-12 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="col-md-6 col-sm-6 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="col-md-6 col-sm-6 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div> 
	            <?php }; ?>
			<?php } else if($footer_layout == "four_single") {
		    	if (is_active_sidebar('footer_1') ) { ?> 
					<div class="col-md-12 col-sm-12 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="col-md-4 col-sm-4 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="col-md-4 col-sm-4 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div> 
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?> 
					<div class="col-md-4 col-sm-4 footercol4">
					<?php dynamic_sidebar('footer_4'); ?>
					</div> 
		        <?php }; ?>
			<?php } else {
					if (is_active_sidebar('footer_1') ) { ?>
					<div class="col-md-6 col-sm-6 footercol1">
					<?php dynamic_sidebar('footer_1'); ?> 
					</div> 
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_2') ) { ?>
					<div class="col-md-6 col-sm-6 footercol2">
					<?php dynamic_sidebar('footer_2'); ?> 
					</div> 
		            <?php }; ?>
		        <?php } ?>
        </div> <!-- Row -->
        </div>
        <div class="footerbase">
        	<div class="container">
        		<div class="footercredits clearfix">
    		
		    		<?php if (has_nav_menu('footer_navigation')) : ?>
		    			<div class="footernav clearfix">
		    			<?php 
		              		wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));
		            	?>
		            	</div>
		            <?php
		        	endif;
		        	?>
		        	<p>
		        		<?php 
		        		if(isset($ascend['footer_text'])) {
		        			$footertext = $ascend['footer_text']; 
		        		} else {
		        			$footertext = ''; 
		        		}
		        		$footertext = str_replace('[copyright]','&copy;',$footertext);
		        		$footertext = str_replace('[the-year]',date('Y'),$footertext);
		        		$footertext = str_replace('[site-name]',get_bloginfo('name'),$footertext);
		        		$footertext = str_replace( '[theme-credit]', '- WordPress Theme by <a rel="nofollow" href="https://www.kadencewp.com/" target="_blank">Kadence WP</a>', $footertext );

		        		echo do_shortcode($footertext); ?>
		        	</p>

    			</div><!-- credits -->
    		</div><!-- container -->
    </div><!-- footerbase -->
</footer>
