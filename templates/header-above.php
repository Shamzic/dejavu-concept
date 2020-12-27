<?php 
$ascend = ascend_get_options();
if(isset($ascend['above_header_style']) && $ascend['above_header_style'] == 'center_menu') {
	$headerclass = 'kt-header-layout-center-menu';
} elseif( isset($ascend['above_header_style']) && $ascend['above_header_style'] == 'center' ) {
	$headerclass = 'kt-header-layout-center-logo';
} elseif( isset($ascend['above_header_style']) && $ascend['above_header_style'] == 'bylogo' ) {
	$headerclass = 'kt-header-layout-lgmenu';
} elseif( isset($ascend['above_header_style']) && $ascend['above_header_style'] == 'center_below' ) {
	$headerclass = 'kt-header-layout-below-lg';
} else {
	$headerclass = 'kt-header-layout-standard';
}
if(isset($ascend['sticky_header_parts'])) {
	$sticky = $ascend['sticky_header_parts'];
} else {
	$sticky = 'none';
}
if(isset($ascend['shrinking_header']) && $ascend['shrinking_header'] == 1 && ($ascend['sticky_header_parts'] == 'header' || $ascend['sticky_header_parts'] == 'header_all' || $ascend['sticky_header_parts'] == 'header_top')) {
	$shrink = '1';
} else {
	$shrink = '0';
}
if(isset($ascend['above_header_shrunk_height'])) {
	$shrunk_height = $ascend['above_header_shrunk_height'];
} else {
	$shrunk_height = '120';
}
if(isset($ascend['above_header_height'])) {
	$height = $ascend['above_header_height'];
} else {
	$height = '120';
}
if(isset($ascend['above_header_height'])) {
	$height = $ascend['above_header_height'];
} else {
	$height = '120';
}
?>
<header id="kad-header-menu" class="headerclass-outer kt-header-position-above <?php echo esc_attr($headerclass);?> clearfix" data-sticky="<?php echo esc_attr($sticky);?>" data-reappear="300" data-shrink="<?php echo esc_attr($shrink);?>" data-start-height="<?php echo esc_attr($height);?>" data-shrink-height="<?php echo esc_attr($shrunk_height);?>">
	<div class="outside-top-headerclass">
	<div class="kad-header-topbar-primary-outer">
 	<?php
 	   	/* 
        * Hooked ascend_top_bar 20
        */
        do_action('ascend_before_above_header');
	?>	<div class="outside-headerclass">
		<div class="kad-header-menu-outer headerclass">
		    <div class="kad-header-menu-inner container">
		    	<?php 
		        if($headerclass == 'kt-header-layout-center-logo') { ?>
		        	<div class="kad-header-flex kad-header-height">
			        	<div class="kad-left-header kt-header-flex-item header-sidewidth">
			        		<?php 
			        		/* 
					        * Hooked ascend_left_header_menu 10
					        */
					        do_action('ascend_center_logo_header_left'); ?>
			           	</div> <!-- Close left header-->
			            <div class="kad-center-header kt-header-flex-item header-logo-width">
			            	<?php 
			        		/* 
					        * Hooked ascend_the_custom_logo 20
					        */
					        do_action('ascend_center_logo_header_center'); ?>
			            </div>  <!-- Close center header-->
			            <div class="kad-right-header kt-header-flex-item header-sidewidth">
			            	<?php 
			        		/* 
			        		* Hooked ascend_right_header_menu 10
					        * Hooked ascend_header_extras 20
					        */
					        do_action('ascend_center_logo_header_right'); ?>
					    </div>  <!-- Close right header-->
			        </div>  <!-- Close container--> 
		    	<?php 
		    	} else if($headerclass == 'kt-header-layout-below-lg') { ?>
			        <div class="kad-header-flex kad-header-height">
			        	<div class="kad-left-header kt-header-flex-item header-sidewidth">
			        		<?php 
			        		/* 
					        * Hooked ascend_second_header_extras 10
					        */
					        do_action('ascend_below_logo_header_left'); ?>
			           	</div> <!-- Close left header-->
			            <div class="kad-center-header kt-header-flex-item header-logo-width">
			            	<?php 
			        		/* 
					        * Hooked ascend_the_custom_logo 20
					        */
					        do_action('ascend_below_logo_header_center'); ?>
			            </div>  <!-- Close center header-->
			            <div class="kad-right-header kt-header-flex-item header-sidewidth">
			            	<?php 
			        		/* 
					        * Hooked ascend_header_extras 20
					        */
					        do_action('ascend_below_logo_header_right'); ?>
					    </div>  <!-- Close right header-->
					</div>
					<div class="menu_below_container">
					    <div class="kad-below-header kt-header-flex-item">
			            	<?php 
			        		/* 
					        * Hooked ascend_primary_menu_area 20
					        */
					        do_action('ascend_below_logo_header_below'); ?>
					    </div>  <!-- Close right header-->
			        </div>  <!-- Close container--> 
		        <?php 
		        } else { ?>
			        <div class="kad-header-flex kad-header-height">
			        	<div class="kad-left-header kt-header-flex-item">
			        		<?php 
			        		/* 
					        * Hooked ascend_the_custom_logo 20
					        */
					        do_action('ascend_header_left'); ?>
			           	</div> <!-- Close left header-->
			            <div class="kad-center-header kt-header-flex-item">
			            	<?php 
			        		/* 
					        * Hooked ascend_primary_menu_area 20
					        */
					        do_action('ascend_header_center'); ?>
			            </div>  <!-- Close center header-->
			            <div class="kad-right-header kt-header-flex-item">
			            	<?php 
			        		/* 
					        * Hooked ascend_header_extras 20
					        */
					        do_action('ascend_header_right'); ?>
					    </div>  <!-- Close right header-->
			        </div>  <!-- Close container--> 
	        	<?php }  ?>
	   		</div> <!-- close header innner -->
		</div>
		</div>
	</div>
	</div>
    <?php 
	/* 
    * Hooked ascend_secondary_menu 20
    */
    do_action('ascend_after_above_header'); 
    ?>
</header>