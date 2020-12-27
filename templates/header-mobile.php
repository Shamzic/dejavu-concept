<?php 
$ascend = ascend_get_options();

  	if(isset($ascend['mobile_header_sticky']) && 1 == $ascend['mobile_header_sticky']) {
    	$sticky = '1'; 
  	} else {
    	$sticky = '0';
  	}
?>
<div id="kad-mobile-banner" class="banner mobile-headerclass" data-mobile-header-sticky="<?php echo esc_attr($sticky);?>">
<?php 
        do_action('ascend_mobile_header_top');
	?>
  <div class="container mobile-header-container kad-mobile-header-height">
        <?php 
        /* 
        * Hooked ascend_mobile_left 20
        */
        do_action('ascend_mobile_header_left');

        /* 
        * Hooked ascend_mobile_center 20
        */
        do_action('ascend_mobile_header_center');

        /* 
        * Hooked ascend_mobile_right 20
        */
        do_action('ascend_mobile_header_right'); 

        ?>
    </div> <!-- Close Container -->
</div>