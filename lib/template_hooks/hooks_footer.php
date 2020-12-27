<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'ascend_footer', 'ascend_footer_markup', 10 );
function ascend_footer_markup() {
	get_template_part('templates/footer');
}
add_action('wp_footer', 'ascend_header_extras_login_modal', 20);
function ascend_header_extras_login_modal() {
	$ascend = ascend_get_options();
		if(isset($ascend['header_extras']['login']) && $ascend['header_extras']['login'] == '1' || isset($ascend['topbar_account']) && $ascend['topbar_account'] != 'none' || (isset($ascend['mobile_header_account']) && ($ascend['mobile_header_account'] == 'right' || $ascend['mobile_header_account'] == 'left') ) && !is_user_logged_in() ){ ?>
	        	<div class="mag-pop-modal mfp-hide mfp-with-anim kt-loggin-modal" id="kt-extras-modal-login" tabindex="-1" role="dialog" aria-hidden="true">
	                <div class="pop-modal-content">
	                    <div class="pop-modal-body">
	                        <?php 
	                        	if (class_exists('woocommerce'))  {
	                        		wc_get_template( 'myaccount/form-login.php' );
	                        	} else {
	                        		wp_login_form();
	                        		wp_register('<p>'.__("Don't have an account?", "ascend"), '</p>');
	                        	}
	                        ?>
	                    </div>
	                </div>
		        </div>
	        <?php
	    }
}
add_action('wp_footer', 'ascend_header_extras_search_modal', 20);
function ascend_header_extras_search_modal() {
	$ascend = ascend_get_options();
		if((isset($ascend['header_extras']['search']) && $ascend['header_extras']['search'] == '1') || (isset($ascend['mobile_header_search']) && $ascend['mobile_header_search'] != 'none') || (isset($ascend['topbar_search']) && $ascend['topbar_search'] != 'none')) { ?>
    		<div class="mag-pop-modal mfp-hide mfp-with-anim kt-search-modal" id="kt-extras-modal-search" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="pop-modal-content">
	                <div class="pop-modal-body">
                        <?php
                        if(class_exists('woocommerce') && isset($ascend['header_extras_search_woo']) && $ascend['header_extras_search_woo'] == '1') { 
							get_product_search_form();
			        	} else { 
			              	get_search_form();
			            } ?>
	                </div>
	            </div>
	        </div>
	   	<?php 
	   }
}

add_action('wp_footer', 'ascend_mobile_menu_sldr', 30);
function ascend_mobile_menu_sldr() {
	$ascend = ascend_get_options(); ?>
    		<div class="mag-pop-sldr mfp-hide mfp-with-anim kt-mobile-menu" id="kt-mobile-menu" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="pop-modal-content">
	                <div class="pop-modal-body">
                    <?php do_action('ascend_mobile_menu_before'); 
                  	if(has_nav_menu('mobile_navigation')) {
                  		$menu_location = 'mobile_navigation';
                  	} else {
                  		$menu_location = 'primary_navigation';
                  	}
                  	if(isset($ascend['mobile_menu_search']) && $ascend['mobile_menu_search'] == '1') { 
	                  	if(class_exists('woocommerce') && isset($ascend['mobile_menu_search_woo']) && $ascend['mobile_menu_search_woo'] == '1') { 
	            			get_product_search_form();
			          	} else { 
			              	get_search_form();
			            } 
                  	} 
                  	if(has_nav_menu($menu_location)) {
	                  	if(isset($ascend['mobile_submenu_collapse']) && $ascend['mobile_submenu_collapse'] == '1') {
	                    	wp_nav_menu( array('theme_location' => $menu_location,'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'kad-mobile-nav', 'walker' => new ascend_mobile_walker()));
	                  	} else {
	                    	wp_nav_menu( array('theme_location' => $menu_location,'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'kad-mobile-nav'));
	                  	} 
	                }
                  	do_action('ascend_mobile_menu_after'); ?>
	                </div>
	            </div>
	        </div>
	   	<?php 
	   
}
add_action( 'wp_footer', 'ascend_mobile_cart_sldr', 30 );
function ascend_mobile_cart_sldr() { 
	if ( class_exists( 'woocommerce' ) )  { 
		$ascend = ascend_get_options();  
		if(isset($ascend['mobile_header_cart']) && ($ascend['mobile_header_cart'] == 'right' || $ascend['mobile_header_cart'] == 'left'))  {?>
    		<div class="mag-pop-sldr mfp-hide mfp-with-anim kt-mobile-cart" id="kt-mobile-cart" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="pop-modal-content">
	                <div class="pop-modal-body">
                    <?php do_action( 'ascend_mobile_cart_before' ); ?>
                  	<ul class="kt-mobile-cart-contain">
	                  	<li class="kt-mini-cart-refreash">
							<?php woocommerce_mini_cart(); ?>
						</li>
					</ul>
                  	<?php do_action('ascend_mobile_cart_after'); ?>
	                </div>
	            </div>
	        </div>
	   	<?php 
	   }
	}
}
add_action('wp_footer', 'ascend_mobile_account_sldr', 30);
function ascend_mobile_account_sldr() { 
	if (class_exists('woocommerce'))  { 
		$ascend = ascend_get_options();  
		if(isset($ascend['mobile_header_account']) && ($ascend['mobile_header_account'] == 'right' || $ascend['mobile_header_account'] == 'left') ) {
			if(is_user_logged_in()) {?>
    		<div class="mag-pop-sldr mfp-hide mfp-with-anim kt-mobile-account" id="kt-mobile-account" tabindex="-1" role="dialog" aria-hidden="true">
	            <div class="pop-modal-content">
	                <div class="pop-modal-body">
                    <?php do_action('ascend_mobile_account_before'); ?>
                  	<?php 
			            wc_get_template( 'myaccount/navigation.php' );
			            ?>
                  	<?php do_action('ascend_mobile_account_after'); ?>
	                </div>
	            </div>
	        </div>
	   		<?php 
		  	}
	   	}
	}
}