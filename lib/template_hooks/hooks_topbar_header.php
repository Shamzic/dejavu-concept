<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action('ascend_before_above_header', 'ascend_topbar', 20);
function ascend_topbar() {
	$ascend = ascend_get_options();
	if(isset($ascend['topbar_enable']) && $ascend['topbar_enable'] == '1') {
		get_template_part('templates/header', 'topbar');
	}
}
add_action('ascend_header_topbar_left', 'ascend_topbar_left', 20);
function ascend_topbar_left() {
	$ascend = ascend_get_options();
	if(isset($ascend['topbar_search']) && $ascend['topbar_search'] == 'left')  {
		ascend_topbar_search('left');
	}
	if(isset($ascend['topbar_menu_location']) && $ascend['topbar_menu_location'] == 'left') {
		ascend_topbar_menu('left');
	}
	if(isset($ascend['topbar_account']) && $ascend['topbar_account'] == 'left')  {
		ascend_topbar_account('left');
	}
	if(isset($ascend['topbar_cart']) && $ascend['topbar_cart'] == 'left') {
		ascend_topbar_cart('left');
	}
	if(isset($ascend['topbar_widget_area']) && $ascend['topbar_widget_area'] == 'left') {
		ascend_topbar_widget_area('left');
	}
}
add_action('ascend_header_topbar_right', 'ascend_topbar_right', 20);
function ascend_topbar_right() {
	$ascend = ascend_get_options();
	if(isset($ascend['topbar_search']) && $ascend['topbar_search'] == 'right')  {
		ascend_topbar_search('right');
	}
	if(isset($ascend['topbar_menu_location']) && $ascend['topbar_menu_location'] == 'right') {
		ascend_topbar_menu('right');
	}
	if(isset($ascend['topbar_account']) && $ascend['topbar_account'] == 'right')  {
		ascend_topbar_account('right');
	}
	if(isset($ascend['topbar_widget_area']) && $ascend['topbar_widget_area'] == 'right') {
		ascend_topbar_widget_area('right');
	}
	if(isset($ascend['topbar_cart']) && $ascend['topbar_cart'] == 'right')  {
		ascend_topbar_cart('right');
	}
}
function ascend_topbar_menu($side = 'left') {
	if (has_nav_menu('topbar_navigation')) : ?>
        	<div class="kad-topbar-flex-item kad-topbar-menu kad-topbar-item-<?php echo esc_attr($side);?>">
             	<?php 
             		wp_nav_menu(array('theme_location' => 'topbar_navigation', 'menu_class' => 'sf-menu sf-menu-normal')); 
             	?>
            </div>
   	<?php  endif; 
}
function ascend_topbar_cart($side = 'right') {
	if (class_exists('woocommerce'))  { 
		$ascend = ascend_get_options(); ?>
      	<div class="kad-topbar-flex-item kad-topbar-cart kt-header-extras kad-topbar-item-<?php echo esc_attr($side);?>">
	      	<ul class="sf-menu sf-menu-normal">
			  	<li class="menu-cart-icon-kt sf-dropdown">
					<a class="menu-cart-btn" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			  			<div class="kt-top-extras-label">
			  			<?php if(isset($ascend['topbar_cart_label']) && !empty($ascend['topbar_cart_label'])) { 
	          				if(isset($ascend['tl_cart']) && !empty($ascend['tl_cart'])) {
			                   	$title =  $ascend['tl_cart'];
			                } else {
			                	$title =  __('Cart', 'ascend');
			                }?>
	          				<span class="cart-extras-title"><?php echo esc_html($title);?></span>
	          			<?php } ?>
	          			 <i class="kt-icon-shopping-bag"></i><span class="kt-cart-total"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span></div>
					</a>
					<ul id="topbar-kad-head-cart-popup" class="sf-dropdown-menu kad-head-cart-popup">
			    		<li class="kt-mini-cart-refreash">
			    			<?php woocommerce_mini_cart(); 
			    				do_action( 'ascend_cart_menu_popup_after' ); ?>
			    		</li>
			  		</ul>
				</li>
			</ul>
        </div>
    <?php } 
}
function ascend_topbar_account($side = 'right') {
	if (class_exists('woocommerce'))  { 
		$ascend = ascend_get_options(); ?>
	<div class="kad-topbar-flex-item kad-topbar-account kt-header-extras kad-topbar-item-<?php echo esc_attr($side);?>">
	      	<ul class="sf-menu sf-menu-normal">
		    	<li class="menu-account-icon-kt sf-dropdown">
		        	<?php if ( is_user_logged_in() ) { 
		        		if(isset($ascend['tl_my_account']) && !empty($ascend['tl_my_account'])) {
		                   	$title =  $ascend['tl_my_account'];
		                }  else {
		                	$title = get_the_title(get_option('woocommerce_myaccount_page_id'));
		                }?>
			            <a class="menu-account-btn" href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
			                <div class=" kt-top-extras-label"><span><?php echo esc_html($title);?></span></div>
			            </a>
			            <ul id="topbar-kad-head-my-account-menu" class="sf-dropdown-menu kad-head-my-account-menu">
			            <?php 
			            wc_get_template( 'myaccount/navigation.php' );
			            ?>
			            </ul>
		        	<?php } else { 
		                if(isset($ascend['tl_login_signup']) && !empty($ascend['tl_login_signup'])) {
		                   	$title =  $ascend['tl_login_signup'];
		                } else if(get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes') {
		                   	$title =  __('Login/Signup', 'ascend');
		                } else {
		                    $title =  __('Login', 'ascend');
		                } ?>
		         		<a class="menu-account-btn kt-pop-modal" data-mfp-src="#kt-extras-modal-login">
		            		<div class="kt-extras-label"><span><?php echo esc_html($title);?></span></div>
		        		</a>

		          	<?php  } ?>
		    	</li>
		    </ul>
        </div>
    <?php
    }  
}
function ascend_topbar_search($side = 'right') {  ?>
      	<div class="kad-topbar-flex-item kad-topbar-search kad-topbar-item-<?php echo esc_attr($side);?>">
      		<ul class="sf-menu">
      			<li>
	             	<a class="kt-menu-search-btn kt-pop-modal" data-mfp-src="#kt-extras-modal-search" href="<?php echo esc_url(home_url().'/?s='); ?>">
						<div class="kt-extras-label"><i class="kt-icon-search"></i></div>
					</a>
				</li>
			</ul>
        </div>
    <?php
}
function ascend_topbar_widget_area($side = 'right') { ?>
	<div class="kad-topbar-flex-item kad-topbar-widget-area kad-topbar-item-<?php echo esc_attr($side);?>">
	<?php 
		if(is_active_sidebar('topbar_widget')) {
			dynamic_sidebar('topbar_widget');
		}
	?>
	</div>
	<?php 
}