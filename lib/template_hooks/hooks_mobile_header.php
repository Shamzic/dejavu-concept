<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action('ascend_mobile_header_left', 'ascend_mobile_left', 20);
function ascend_mobile_left() {
	$ascend = ascend_get_options();
	if(isset($ascend['mobile_header_menu']) && $ascend['mobile_header_menu'] == 'left') {
		ascend_mobile_menu_ouput('left');
	}
	if(isset($ascend['mobile_header_cart']) && $ascend['mobile_header_cart'] == 'left') {
		ascend_mobile_header_cart('left');
	}
	if(isset($ascend['mobile_header_account']) && $ascend['mobile_header_account'] == 'left')  {
		ascend_mobile_header_account('left');
	}
	if(isset($ascend['mobile_header_search']) && $ascend['mobile_header_search'] == 'left')  {
		ascend_mobile_header_search('left');
	}
	if(isset($ascend['mobile_header_layout']) && $ascend['mobile_header_layout'] == 'center') {
		// Do nothing
	} else {
		ascend_the_custom_mobile_logo();
	}
}
add_action('ascend_mobile_header_center', 'ascend_mobile_center', 20);
function ascend_mobile_center() {
	$ascend = ascend_get_options();
	if(isset($ascend['mobile_header_layout']) && $ascend['mobile_header_layout'] == 'center') {
		ascend_the_custom_mobile_logo('center');
		ascend_the_custom_mobile_logo_decoy();
	}
}
add_action('ascend_mobile_header_right', 'ascend_mobile_right', 20);
function ascend_mobile_right() {
	$ascend = ascend_get_options();
	if(isset($ascend['mobile_header_search']) && $ascend['mobile_header_search'] == 'right')  {
		ascend_mobile_header_search('right');
	}
	if(isset($ascend['mobile_header_account']) && $ascend['mobile_header_account'] == 'right')  {
		ascend_mobile_header_account('right');
	}
	if(isset($ascend['mobile_header_cart']) && $ascend['mobile_header_cart'] == 'right')  {
		ascend_mobile_header_cart('right');
	}
	if( ( isset( $ascend['mobile_header_menu'] ) && $ascend['mobile_header_menu'] == 'right' ) || ! isset( $ascend['mobile_header_menu'] ) ) {
		ascend_mobile_menu_ouput('right');
	}
}
function ascend_the_custom_mobile_logo($position = 'left') {
	$ascend = ascend_get_options();
	echo '<div id="mobile-logo" class="logocase kad-mobile-header-height kad-mobile-logo-'.esc_attr($position).'">';
		echo '<a class="brand logofont" href="'.esc_url(apply_filters('ascend_logo_link', home_url())).'">';
		$liu = '';
		if(isset($ascend['mobile_logo_switch']) && $ascend['mobile_logo_switch'] == '0') {
			if(isset($ascend['logo']['id']) && !empty($ascend['logo']['id'])) {
				if(isset($ascend['mobile_logo_width']) && !empty($ascend['mobile_logo_width'])) {
					$width = $ascend['mobile_logo_width'];
				} else {
					$width = 300;
				}
				$width = apply_filters('ascend_mobile_logo_width', $width);
				$alt = get_bloginfo('name');
				echo ascend_get_full_image_output($width, null, false, 'ascend-mobile-logo', $alt, $ascend['logo']['id'], false, false, false);
				if(isset($ascend['trans_logo']['id']) && !empty($ascend['trans_logo']['id'])) {
					$img = ascend_get_image_array($width, null, false, 'ascend-trans-logo', $alt, $ascend['trans_logo']['id'], false);
					echo '<img src="'.esc_url($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" style="max-height:'.esc_attr($img['height']).'px" alt="'.esc_attr($img['alt']).'">';
				}
				$liu = 'kad-logo-used';
			}
			if(isset($ascend['site_title']) && $ascend['site_title'] == 1) {
				echo '<span class="kad-site-title '.$liu.'">';
				echo apply_filters('kad_site_name', get_bloginfo('name')); 
				if(isset($ascend['site_tagline']) && $ascend['site_tagline'] == 1) {
					echo '<span class="kad-site-tagline">';
					echo apply_filters('kad_site_tagline', get_bloginfo('description'));
					echo '</span>';
				}
				echo '</span>';
			}
		} else {
			if(isset($ascend['mobile_logo']['id']) && !empty($ascend['mobile_logo']['id'])) {
				if(isset($ascend['mobile_logo_width']) && !empty($ascend['mobile_logo_width'])) {
					$width = $ascend['mobile_logo_width'];
				} else {
					$width = 300;
				}
				$width = apply_filters('ascend_mobile_logo_width', $width);
				$alt = get_bloginfo('name');
				echo ascend_get_full_image_output($width, null, false, 'ascend-mobile-logo', $alt, $ascend['mobile_logo']['id'], false, false, false);
				if(isset($ascend['trans_logo_mobile']['id']) && !empty($ascend['trans_logo_mobile']['id'])) {
					$img = ascend_get_image_array($width, null, false, 'ascend-mobile-trans-logo', $alt, $ascend['trans_logo_mobile']['id'], false);
					echo '<img src="'.esc_url($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" style="max-height:'.esc_attr($img['height']).'px" alt="'.esc_attr($img['alt']).'">';
				}
				$liu = 'kad-logo-used';
			}
			if(isset($ascend['mobile_site_title']) && $ascend['mobile_site_title'] == 1) {
				echo '<span class="kad-mobile-site-title '.$liu.'">';
				echo apply_filters('kad_site_name', get_bloginfo('name'));
				if(isset($ascend['mobile_site_tagline']) && $ascend['mobile_site_tagline'] == 1) {
					echo '<span class="kad-mobile-site-tagline">';
					echo apply_filters('kad_site_tagline', get_bloginfo('description'));
					echo '</span>';
				}
				echo '</span>';
			}
		}
		echo '</a>';
	echo '</div>';
}
function ascend_the_custom_mobile_logo_decoy() {
	echo '<div id="mobile-logo-placeholder" class="kad-mobile-header-height">';
	echo '</div>';
}
function ascend_mobile_menu_ouput($side = 'right') {
	if (has_nav_menu('primary_navigation') || has_nav_menu('mobile_navigation')) : ?>
        	<div class="kad-mobile-menu-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-menu-<?php echo esc_attr($side);?>">
             	<button class="mobile-navigation-toggle kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-menu" data-pop-sldr-direction="<?php echo esc_attr($side);?>" data-pop-sldr-class="sldr-menu-animi">
             		<span class="kt-mnt">
	                	<span></span>
						<span></span>
						<span></span>
					</span>
              	</button>
            </div>
   	<?php  endif; 
}
function ascend_mobile_header_cart($side = 'right') {
	if (class_exists('woocommerce'))  { ?>
      	<div class="kad-mobile-cart-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-cart-<?php echo esc_attr($side);?>">
             	<button class="kt-woo-cart-toggle kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-cart" data-pop-sldr-direction="<?php echo esc_attr($side);?>"  data-pop-sldr-class="sldr-cart-animi">
					<span class="kt-extras-label"><i class="kt-icon-shopping-bag"></i><span class="kt-cart-total"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span></span>
              	</button>
        </div>
    <?php } 
}
function ascend_mobile_header_account($side = 'right') {
	if (class_exists('woocommerce'))  { ?>
      	<div class="kad-mobile-account-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-account-<?php echo esc_attr($side);?>">
      		<?php if ( is_user_logged_in() ) { ?>
             	<button class="kt-woo-account-toggle  kt-sldr-pop-modal" rel="nofollow" data-mfp-src="#kt-mobile-account" data-pop-sldr-direction="<?php echo esc_attr($side);?>"  data-pop-sldr-class="sldr-account-animi">
					<span class="kt-extras-label header-underscore-icon"><i class="kt-icon-user"></i></span>
          		</button>
            <?php } else { ?>
            	<button class="kt-woo-account-toggle kt-pop-modal" rel="nofollow" data-mfp-src="#kt-extras-modal-login">
					<span class="kt-extras-label"><i class="kt-icon-user"></i></span>
              	</button>
             <?php 	} ?>
        </div>
    <?php } 
}
function ascend_mobile_header_search($side = 'right') {  ?>
      	<div class="kad-mobile-seearch-flex-item kad-mobile-header-height kt-mobile-header-toggle kad-mobile-search-<?php echo esc_attr($side);?>">
             	<button class="kt-search-toggle kt-pop-modal" rel="nofollow" data-mfp-src="#kt-extras-modal-search">
					<span class="kt-extras-label"><i class="kt-icon-search"></i></span>
          		</button>
        </div>
    <?php
}