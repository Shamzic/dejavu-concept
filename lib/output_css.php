<?php
/**
 * Get all ascend custom css output.
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Get all ascend custom css output.
 */
function ascend_custom_css() {

	$ascend = ascend_get_options();

	if ( isset( $ascend['primary_color'] ) && ! empty( $ascend['primary_color'] ) ) {
		$primary_color = 'a, .primary-color, .postlist article .entry-content a.more-link:hover,.widget_price_filter .price_slider_amount .button, .product .product_meta a:hover, .star-rating, .above-footer-widgets a:not(.button):hover, .sidebar a:not(.button):hover, .footerclass a:hover, .posttags a:hover, .tagcloud a:hover, .kt_bc_nomargin #kadbreadcrumbs a:hover, #kadbreadcrumbs a:hover, .wp-pagenavi a:hover, .woocommerce-pagination ul.page-numbers li a:hover, .woocommerce-pagination ul.page-numbers li span:hover, .has-ascend-primary-color {color:' . esc_attr( $ascend['primary_color'] ) . ';} .comment-content a:not(.button):hover, .entry-content p a:not(.button):not(.select2-choice):not([data-rel="lightbox"]):hover, .kt_product_toggle_outer .toggle_grid:hover, .kt_product_toggle_outer .toggle_list:hover, .kt_product_toggle_outer .toggle_grid.toggle_active, .kt_product_toggle_outer .toggle_list.toggle_active, .product .product_meta a, .product .woocommerce-tabs .wc-tabs > li.active > a, .product .woocommerce-tabs .wc-tabs > li.active > a:hover, .product .woocommerce-tabs .wc-tabs > li.active > a:focus, #payment ul.wc_payment_methods li.wc_payment_method input[type=radio]:first-child:checked+label, .kt-woo-account-nav .woocommerce-MyAccount-navigation ul li.is-active a, a.added_to_cart, .widget_pages ul li.kt-drop-toggle > .kt-toggle-sub, .widget_categories ul li.kt-drop-toggle > .kt-toggle-sub, .widget_product_categories ul li.kt-drop-toggle > .kt-toggle-sub, .widget_recent_entries ul li a:hover ~ .kt-toggle-sub, .widget_recent_comments ul li a:hover ~ .kt-toggle-sub, .widget_archive ul li a:hover ~ .kt-toggle-sub, .widget_pages ul li a:hover ~ .kt-toggle-sub, .widget_categories ul li a:hover ~ .kt-toggle-sub, .widget_meta ul li a:hover ~ .kt-toggle-sub, .widget_product_categories ul li a:hover ~ .kt-toggle-sub,.kt-tabs.kt-tabs-style2 > li > a:hover, .kt-tabs > li.active > a, .kt-tabs > li.active > a:hover, .kt-tabs > li.active > a:focus, .kt_bc_nomargin #kadbreadcrumbs a:hover, #kadbreadcrumbs a:hover, .footerclass .menu li a:hover, .widget_recent_entries ul li a:hover, .posttags a:hover, .tagcloud a:hover,.widget_recent_comments ul li a:hover, .widget_archive ul li a:hover, .widget_pages ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_product_categories ul li a:hover, .box-icon-item .icon-container .icon-left-highlight,.box-icon-item .icon-container .icon-right-highlight, .widget_pages ul li.current-cat > a, .widget_categories ul li.current-cat > a, .widget_product_categories ul li.current-cat > a, #payment ul.wc_payment_methods li.wc_payment_method input[type=radio]:first-child:checked + label:before, .wp-pagenavi .current, .wp-pagenavi a:hover, .kt-mobile-header-toggle .header-underscore-icon [class*=kt-icon-], .woocommerce-pagination ul.page-numbers li a.current, .woocommerce-pagination ul.page-numbers li span.current, .woocommerce-pagination ul.page-numbers li a:hover, .woocommerce-pagination ul.page-numbers li span:hover, .widget_layered_nav ul li.chosen a, .widget_layered_nav_filters ul li a, .widget_rating_filter ul li.chosen a, .variations .kad_radio_variations label.selectedValue, .variations .kad_radio_variations label:hover{border-color:' . esc_attr( $ascend['primary_color'] ) . ';} .kt-header-extras span.kt-cart-total, .btn, .button, .submit, button, input[type="submit"], .portfolio-loop-image-container .portfolio-hover-item .portfolio-overlay-color, .kt_product_toggle_outer .toggle_grid.toggle_active, .kt_product_toggle_outer .toggle_list.toggle_active, .product .woocommerce-tabs .wc-tabs > li.active > a, .product .woocommerce-tabs .wc-tabs > li.active > a:hover, .product .woocommerce-tabs .wc-tabs > li.active > a:focus, .product .woocommerce-tabs .wc-tabs:before, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-noreviews, p.no-comments, .widget_pages ul li ul li.current-cat > a:before, .widget_categories ul li ul li.current-cat > a:before, .widget_product_categories ul li ul li.current-cat > a:before, .widget_pages ul li ul li a:hover:before, .widget_categories ul li ul li a:hover:before, .widget_product_categories ul li ul li a:hover:before, .kadence_recent_posts a.posts_widget_readmore:hover:before, .kt-accordion > .panel h5:after, .kt-tabs:before, .image_menu_overlay, .kadence_social_widget a:hover, .kt-tabs > li.active > a, .kt-tabs > li.active > a:hover, .kt-tabs > li.active > a:focus, .widget_pages ul li.current-cat > .count, .widget_categories ul li.current-cat > .count, .widget_product_categories ul li.current-cat > .count, .widget_recent_entries ul li a:hover ~ .count, .widget_recent_comments ul li a:hover ~ .count, .widget_archive ul li a:hover ~ .count, .widget_pages ul li a:hover ~ .count, .widget_categories ul li a:hover ~ .count, .widget_meta ul li a:hover ~ .count, .widget_product_categories ul li a:hover ~ .count, #payment ul.wc_payment_methods li.wc_payment_method input[type=radio]:first-child:checked + label:before, .select2-results .select2-highlighted, .wp-pagenavi .current, .kt-header-extras span.kt-cart-total, .kt-mobile-header-toggle span.kt-cart-total, .woocommerce-pagination ul.page-numbers li a.current, .woocommerce-pagination ul.page-numbers li span.current,.widget_price_filter .ui-slider .ui-slider-handle, .widget_layered_nav ul li.chosen span.count, .widget_layered_nav_filters ul li span.count, .variations .kad_radio_variations label.selectedValue, .box-icon-item .menu-icon-read-more .read-more-highlight, p.demo_store, .has-ascend-primary-background-color {background:' . esc_attr( $ascend['primary_color'] ) . ';}@media (max-width: 767px){.filter-set li a.selected {background:' . esc_attr( $ascend['primary_color'] ) . ';}} .has-ascend-primary-light-color {color:' . esc_attr( ascend_adjust_brightness( $ascend['primary_color'], 20 ) ) .'} .has-ascend-primary-light-background-color{ background-color: ' . esc_attr( ascend_adjust_brightness( $ascend['primary_color'], 20 ) ) . '}';
	} else {
		$primary_color = '';
	}
	if(isset($ascend['mobile_switch']) && $ascend['mobile_switch'] == '1') {
		if(isset($ascend['mobile_tablet_show']) && $ascend['mobile_tablet_show'] == '1') {
			$mobile_slider = '@media (max-width: 991px){.kt_mobile_slider {display:block;} .kt_desktop_slider {display:none;}}@media only screen and (max-device-width: 1024px) {.kt_mobile_slider {display:block;} .kt_desktop_slider {display:none;}}';
		} else {
			$mobile_slider = '@media (max-width: 767px){.kt_mobile_slider {display:block;} .kt_desktop_slider {display:none;}}';
		}
	} else {
		$mobile_slider = '';
	}
	if(!empty($ascend['header_background_choice']) && $ascend['header_background_choice'] == 'simple' && !empty($ascend['header_background_color'])) {
	    $head_bgcolor = ascend_hex2rgb( $ascend['header_background_color'] ); 
	  	$hbg_color = '.headerclass, .mobile-headerclass, .kad-fixed-vertical-background-area{background: rgba('.esc_attr($head_bgcolor[0]).', '.esc_attr($head_bgcolor[1]).', '.esc_attr($head_bgcolor[2]).', '.esc_attr($ascend['header_background_transparency']).');}';
	  	if( $head_bgcolor[0] + $head_bgcolor[1] + $head_bgcolor[2] < 382 ){
		  // this is dark colour!
	  		$social_border = '.kt-header-extras .kadence_social_widget a {border-color: rgba(255,255,255,.2);}';
		} else {
			$social_border = '';
		}
	} else {
	  	$hbg_color = '';
	  	$social_border = '';
	}
	if(!empty($ascend['dropdown_background_color'])) {
	    $drop_bgcolor = ascend_hex2rgb($ascend['dropdown_background_color']); 
		if($drop_bgcolor[0] + $drop_bgcolor[1] + $drop_bgcolor[2] < 382){
		  // this is dark colour!
	  		$dbg_color = '.sf-menu.sf-menu-normal>li.kt-lgmenu>ul>li>a:before, .sf-menu.sf-vertical>li.kt-lgmenu>ul>li>a:before {background: rgba(255,255,255,.1);}';
		} else {
			$dbg_color = '';
		}
	} else {
	  	$dbg_color = '';
	}
	if(!empty($ascend['trans_header_background_transparency']) && $ascend['trans_header_background_transparency'] != '0') {
		if(isset($ascend['header_background_color']) && !empty($ascend['header_background_color']) ){
	    	$head_bgcolor = ascend_hex2rgb($ascend['header_background_color']); 
	  		$trans_hbg_color = 'body.trans-header div:not(.is-sticky)>.headerclass-outer div:not(.is-sticky)>.kad-header-topbar-primary-outer div:not(.is-sticky)>.headerclass, body.trans-header div:not(.is-sticky)>.mobile-headerclass {background: rgba('.esc_attr($head_bgcolor[0]).', '.esc_attr($head_bgcolor[1]).', '.esc_attr($head_bgcolor[2]).', '.esc_attr($ascend['trans_header_background_transparency']).');}';
	  	} else {
	  		$trans_hbg_color = 'body.trans-header div:not(.is-sticky)>.headerclass-outer div:not(.is-sticky)>.kad-header-topbar-primary-outer div:not(.is-sticky)>.headerclass, body.trans-header div:not(.is-sticky)>.mobile-headerclass {background: rgba(255,255,255,'.esc_attr($ascend['trans_header_background_transparency']).');}';
	  	}
	  	if(isset($ascend['second_menu_background']) && !empty($ascend['second_menu_background']['background-color']) ){
	    	$second_bgcolor = ascend_hex2rgb($ascend['second_menu_background']['background-color']); 
	  		$trans_second_color = 'body.trans-header div:not(.is-sticky)>.headerclass-outer div:not(.is-sticky)>.second-navclass, body.trans-header div:not(.is-sticky)>.second-navclass {background: rgba('.esc_attr($second_bgcolor[0]).', '.esc_attr($second_bgcolor[1]).', '.esc_attr($second_bgcolor[2]).', '.esc_attr($ascend['trans_header_background_transparency']).');}';
	  	} else {
	  		$trans_second_color = 'body.trans-header div:not(.is-sticky)>.headerclass-outer div:not(.is-sticky)>.second-navclass, body.trans-header div:not(.is-sticky)>.second-navclass {background: rgba(255,255,255,'.$ascend['trans_header_background_transparency'].');}';
	  	}
	} else {
	  	$trans_hbg_color = '';
	  	$trans_second_color = '';
	}
	if(isset($ascend['product_add_to_cart_show']) && $ascend['product_add_to_cart_show'] == '0') {
		$product_button = '.product_item .button {opacity: 1;}.product_item .product_action_wrap {opacity: 1;visibility: visible; position: relative; bottom: 0;} .product_item:hover .product_action_wrap:before{display:none;}';
	} else {
		$product_button = '';
	}
	if(isset($ascend['dropdown_menu_font_size']) && !empty($ascend['dropdown_menu_font_size']['color'])) {
		$dropdown_font = '.kt-header-extras #kad-head-cart-popup ul a:not(.remove), .kt-header-extras #kad-head-cart-popup .woocommerce-mini-cart__empty-message, .kt-header-extras #kad-head-cart-popup ul .quantity, .kt-header-extras #kad-head-cart-popup ul li.empty, .kad-header-menu-inner .kt-header-extras .kt-woo-account-nav h5, .kad-relative-vertical-content .kt-header-extras .kt-woo-account-nav h5 {color:'.esc_attr($ascend['dropdown_menu_font_size']['color']).';}';
	} else {
		$dropdown_font = '';
	}
	if(isset($ascend['font_primary_menu']) && !empty($ascend['font_primary_menu']['color'])) {
		$menu_font_color = '.kt-header-extras .kadence_social_widget a, .mobile-header-container .kt-mobile-header-toggle button {color:'.esc_attr($ascend['font_primary_menu']['color']).';} button.mobile-navigation-toggle .kt-mnt span {background:'.esc_attr($ascend['font_primary_menu']['color']).';} .kt-header-extras .kadence_social_widget a:hover{color:#fff;}';
	} else {
		$menu_font_color = '';
	}
	if(isset($ascend['font_secondary_menu']) && !empty($ascend['font_secondary_menu']['color'])) {
		$secondmenu_font_color = '.second-navclass .sf-menu>li:after {background:'.esc_attr($ascend['font_secondary_menu']['color']).';}';
	} else {
		$secondmenu_font_color = '';
	}
	if(isset($ascend['font_mobile_menu']) && !empty($ascend['font_mobile_menu']['color'])) {
		$font_mobile_menu_placeholder = '.pop-modal-body .kt-woo-account-nav .kad-customer-name h5, .pop-modal-body .kt-woo-account-nav a, .pop-modal-body ul.product_list_widget li a:not(.remove), .pop-modal-body ul.product_list_widget {color:'.$ascend['font_mobile_menu']['color'].';} .kt-mobile-menu form.search-form input[type="search"]::-webkit-input-placeholder {color:'.$ascend['font_mobile_menu']['color'].';}.kt-mobile-menu form.search-form input[type="search"]:-ms-input-placeholder {color:'.$ascend['font_mobile_menu']['color'].';}.kt-mobile-menu form.search-form input[type="search"]::-moz-placeholder {color:'.$ascend['font_mobile_menu']['color'].';}';
	} else {
		$font_mobile_menu_placeholder = '';
	}
	if(isset($ascend['site_layout']) && $ascend['site_layout'] != 'above' ) {
		$hd_height = 0;
		$tb_height = 0;
		$header_height = '';
		if(isset($ascend['beside_header_width'])) {
			$header_width = '.kad-vertical-menu, .kad-fixed-vertical-background-area {width:'.esc_attr($ascend['beside_header_width']).'px;}@media (min-width: 993px) {.kad-header-position-left #wrapper {padding-left: '.esc_attr($ascend['beside_header_width']).'px;}.kad-header-position-right #wrapper {padding-right: '.esc_attr($ascend['beside_header_width']).'px;}} @media (min-width: '.esc_attr(floor(1470 + $ascend['beside_header_width'] + 40)).'px) {.kad-header-position-left.kt-width-large.body-style-boxed #wrapper, .kad-header-position-left.kt-width-xlarge.body-style-boxed #wrapper, .kad-header-position-right.kt-width-xlarge.body-style-boxed #wrapper, .kad-header-position-right.kt-width-large.body-style-boxed #wrapper {max-width: '.esc_attr(floor(1470 + $ascend['beside_header_width'])).'px;}}@media (min-width: '.esc_attr(floor(1770 + $ascend['beside_header_width'] + 40)).'px) {.kad-header-position-left.kt-width-xlarge.body-style-boxed #wrapper, .kad-header-position-right.kt-width-xlarge.body-style-boxed #wrapper{max-width: '.esc_attr(floor(1770 + $ascend['beside_header_width'])).'px;}}';

			if($ascend['beside_header_width'] < '120') {
				$header_width .= '.kt-header-extras .sf-vertical.kt-search-and-cart li.menu-cart-icon-kt, .kt-header-extras .sf-vertical.kt-search-and-cart li.menu-search-icon-kt {width: 100%;text-align: center;float:none;border-right: 0;}';
			}
		} else {
		  	$header_width = '';
		}
	} else {
		if(isset($ascend['above_header_height'])) {
			$header_height = '.kad-header-height {height:'.esc_attr($ascend['above_header_height']).'px;}';
			$hd_height = $ascend['above_header_height'];
		} else {
		  	$header_height = '.kad-header-height {height:100px;}';
		  	$hd_height = 100;
		}
		if(isset($ascend['topbar_enable']) && $ascend['topbar_enable'] == '1') {
			if(isset($ascend['topbar_height'])) {
				$tb_height = $ascend['topbar_height'];
			} else {
				$tb_height = 36;
			}
		} else {
			$tb_height = 0;
		}

		$header_width = '';
	}
	if(isset($ascend['pagetitle_uppercase']) && $ascend['pagetitle_uppercase'] == '1') {
	    $title_uppercase = '.titleclass .entry-title, .titleclass h1 {text-transform:uppercase;}'; 
	} else {
	    $title_uppercase = '';
	}
	if(isset($ascend['pagesubtitle_uppercase']) && $ascend['pagesubtitle_uppercase'] == '1') {
	    $subtitle_uppercase = '.titleclass .subtitle {text-transform:uppercase;}'; 
	} else {
	    $subtitle_uppercase = '';
	}
	if(isset($ascend['mobile_submenu_collapse_subitems']) && $ascend['mobile_submenu_collapse_subitems'] == '1') {
	    $mobile_subnav = '.kad-mobile-nav li .kad-submenu-accordion {width:100%;text-align:right;}'; 
	} else {
	    $mobile_subnav = '';
	}
	if(isset($ascend['hide_author']) && $ascend['hide_author'] == '0') {
	    $post_author = '.kt-post-author {display:none;}'; 
	} else {
	    $post_author = '';
	}
	if(isset($ascend['hide_categories']) && $ascend['hide_categories'] == '0') {
	    $post_cats = '.kt-post-cats {display:none;}'; 
	} else {
	    $post_cats = '';
	}
	if(isset($ascend['hide_comments']) && $ascend['hide_comments'] == '0') {
	    $post_comments = '.kt-post-comments {display:none;}'; 
	} else {
	    $post_comments = '';
	}
	if(isset($ascend['hide_postdate']) && $ascend['hide_postdate'] == '0') {
	    $post_postdate = '.kt-post-date {display:none;}'; 
	} else {
	    $post_postdate = '';
	}
	if(isset($ascend['logo']['id']) && !empty($ascend['logo']['id']) && isset($ascend['trans_logo']['id']) && !empty($ascend['trans_logo']['id'])) {
	    $logo_switch = 'body.trans-header div:not(.is-sticky) > .headerclass-outer div:not(.is-sticky) > .kad-header-topbar-primary-outer div:not(.is-sticky) > .headerclass .ascend-trans-logo {display: block;}body.trans-header div:not(.is-sticky) > .headerclass-outer div:not(.is-sticky) > .kad-header-topbar-primary-outer div:not(.is-sticky) > .headerclass .ascend-logo,body.trans-header div:not(.is-sticky) > .headerclass-outer div:not(.is-sticky) > .kad-header-topbar-primary-outer div:not(.is-sticky) > .headerclass .ascend-mobile-logo{display: none;}'; 
	} else {
	    $logo_switch = '';
	}
	if(isset($ascend['mobile_logo_switch']) && $ascend['mobile_logo_switch'] == '1' && isset($ascend['mobile_logo']['id']) && !empty($ascend['mobile_logo']['id']) && isset($ascend['trans_logo_mobile']['id']) && !empty($ascend['trans_logo_mobile']['id'])) {
	    $mobile_logo_switch = 'body.trans-header div:not(.is-sticky) > .mobile-headerclass .ascend-mobile-trans-logo {display: block;}body.trans-header div:not(.is-sticky) > .mobile-headerclass .ascend-mobile-logo {display: none;}'; 
	} else {
	    $mobile_logo_switch = '';
	}
	
	if(isset($ascend['topbar_height'])) {
	    $tbheight = '.kad-topbar-height {min-height:'.esc_attr($ascend['topbar_height']).'px;}'; 
	} else {
	    $tbheight = '';
	}
	if (has_nav_menu('secondary_navigation')) {
		$sc_height = 64;
	} else {
		$sc_height = 0;
	}
	if(isset($ascend['mobile_header_height'])) {
	    $mhheight = '.kad-mobile-header-height {height:'.esc_attr($ascend['mobile_header_height']).'px;}'; 
	    $mhd_height = $ascend['mobile_header_height'];
	} else {
	    $mhheight = '.kad-mobile-header-height {height:60px;}';
	    $mhd_height = 60;
	}
	if(ascend_trans_header()) {
		$title_padding = '.titleclass {padding-top:'.esc_attr(floor($hd_height + $tb_height + $sc_height)).'px;}@media (max-width: 991px){.titleclass {padding-top:'.esc_attr($mhd_height).'px;}}';
	} else {
		$title_padding = '';
	}
	// For the really small mobile header 
	if(isset($ascend['mobile_header_height']) && $ascend['mobile_header_height'] <= 40) {
		$mhheight_items = '.kt-mnt {height: 18px;width: 24px;}.kt-mnt span{height:3px}.kt-mnt span:nth-child(2){top:6px}.kt-mnt span:nth-child(3){top:12px}.kt-mobile-header-toggle .kt-extras-label{line-height:20px}.kt-mobile-header-toggle [class*="kt-icon-"]{line-height:20px;font-size:16px}.kt-mobile-header-toggle span.kt-cart-total{top:-6px;width:13px;height:13px;line-height:13px;font-size:9px}.kt-mobile-header-toggle .kt-extras-label .kt-icon-search{font-size:16px}.kt-mobile-header-toggle .header-underscore-icon [class*="kt-icon-"]{font-size:16px;line-height:22px;width:20px;height:22px;border-bottom-width:1px}';
	} else {
		$mhheight_items = '';
	}
	if(isset($ascend['above_header_style']) && ($ascend['above_header_style'] == 'center' || $ascend['above_header_style'] == 'center_below' ) ) {
		if(isset($ascend['above_header_logo_width'])) {
				$sidewidth = (100 - $ascend['above_header_logo_width']) / 2;
				$header_logo_width = '.kt-header-position-above .header-sidewidth {width:'.esc_attr($sidewidth).'%;} .kt-header-position-above .header-logo-width {width:'.esc_attr($ascend['above_header_logo_width']).'%;}';
		} else {
		  	$header_logo_width = '';
		}
	} else if(isset($ascend['above_header_style']) && $ascend['above_header_style'] == 'center_menu') {
		if(isset($ascend['above_header_logo_width'])) {
				$header_logo_width = '.kt-header-layout-center-menu .kad-center-header.kt-header-flex-item {padding-left:'.esc_attr($ascend['above_header_logo_width']).'%; padding-right:'.esc_attr($ascend['above_header_logo_width']).'%;}';
		} else {
		  	$header_logo_width = '';
		}
	} else {
		$header_logo_width = '';
	}
	$titlecss = '';
	$mobile_height_small = '';
	$mobile_height 	= '';
	if(is_front_page()) {
			if(isset($ascend['home_page_title_max_size']) ) {
				$t_large_size 	= $ascend['home_page_title_max_size'];
			} else {
				$t_large_size 	= '';
			}
			if(isset($ascend['home_page_title_min_size'])) {
				$t_small_size 	= $ascend['home_page_title_min_size'];
			} else {
				$t_small_size 	= '';
			}
			if(isset($ascend['home_page_subtitle_max_size'])) {
				$s_large_size 	= $ascend['home_page_subtitle_max_size'];
			} else {
				$s_large_size 	= '';
			}
			if(isset($ascend['home_page_subtitle_min_size'])) {
				$s_small_size 	= $ascend['home_page_subtitle_min_size'];
			} else {
				$s_small_size 	= '';
			}
			if(isset($ascend['home_page_title_height'])) {
				$height 		= $ascend['home_page_title_height'];
			} else {
				$height 		= '';
			}
			if(isset($ascend['home_page_title_height_min'])) {
				$height_small 	= $ascend['home_page_title_height_min'];
			} else {
				$height_small 	= '';
			}
			if(isset($ascend['home_mobile_page_title_height'])) {
				$mobile_height 	= '.titleclass.kt_mobile_slider .page-header  {height:'.esc_attr($ascend['home_mobile_page_title_height']).'px;}';
			}
			if(isset($ascend['home_mobile_page_title_height_min'])) {
				$mobile_height_small =  '@media (max-width: 768px) {.titleclass.kt_mobile_slider .page-header {height:'.esc_attr($ascend['home_mobile_page_title_height_min']).'px;}}';
			} 

	} 
	if(!empty($t_large_size)) {
		$titlecss .= '.titleclass .entry-title{font-size:'.esc_attr($t_large_size).'px;}';
	} elseif(isset($ascend['single_header_title_size'])) {
		$titlecss .= '.titleclass .entry-title{font-size:'.esc_attr($ascend['single_header_title_size']).'px;}';
	}
	if(!empty($t_small_size)) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .entry-title{font-size:'.esc_attr($t_small_size).'px;}}';
	} elseif(isset($ascend['single_header_title_size_small'])) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .entry-title{font-size:'.esc_attr($ascend['single_header_title_size_small']).'px;}}';
	}
	if(!empty($s_large_size)) {
		$titlecss .= '.titleclass .subtitle{font-size:'.esc_attr($s_large_size).'px;}';
	} elseif(isset($ascend['single_header_subtitle_size'])) {
		$titlecss .= '.titleclass .subtitle{font-size:'.esc_attr($ascend['single_header_subtitle_size']).'px;}';
	}
	if(!empty($s_small_size)) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .subtitle{font-size:'.esc_attr($s_small_size).'px;}}';
	} elseif(isset($ascend['single_header_subtitle_size_small'])) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .subtitle{font-size:'.esc_attr($ascend['single_header_subtitle_size_small']).'px;}}';
	}
	if(!empty($height)) {
		$titlecss .= '.titleclass .page-header {height:'.esc_attr($height).'px;}';
	} elseif(isset($ascend['page_title_height'])) {
		$titlecss .= '.titleclass .page-header  {height:'.esc_attr($ascend['page_title_height']).'px;}';
	}
	if(!empty($height_small)) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .page-header {height:'.esc_attr($height_small).'px;}}';
	} elseif(isset($ascend['page_title_height_min'])) {
		$titlecss .= '@media (max-width: 768px) {.titleclass .page-header {height:'.esc_attr($ascend['page_title_height_min']).'px;}}';
	}
	if(isset($ascend['pagetitle_align'])) {
	    $titlealign = '.page-header {text-align:'.esc_attr($ascend['pagetitle_align']).';}'; 
	} else {
	   	$titlealign = '.page-header {text-align:center;}';
	}
	if(isset($ascend['shop_title_min_height'])) {
	    $stminheight = '.product_item .product_archive_title {min-height:'.esc_attr($ascend['shop_title_min_height']).'px;}'; 
	} else {
	   	$stminheight = '';
	}
	if (isset($ascend['notavailable_placeholder_text']) && !empty($ascend['notavailable_placeholder_text']) ) {
		$notavailable_placeholder_text = '.variations .kad_radio_variations label.kt_disabled:after {content: '.esc_attr($ascend['notavailable_placeholder_text']).';}';
	} else {
		$notavailable_placeholder_text = '';
	}
	if ( ! empty( $ascend['custom_css'] ) ) {
		$custom_css = wp_kses_post( $ascend['custom_css'] );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
	} else {
		$custom_css = '';
	}

	$kad_custom_css  = '<style type="text/css" id="kt-custom-css">';
	$kad_custom_css .= $primary_color . $header_height . $header_width . $header_logo_width . $mobile_subnav . $mobile_slider . $tbheight . $mhheight . $mhheight_items . $hbg_color . $trans_hbg_color . $trans_second_color . $titlecss . $stminheight . $mobile_height . $mobile_height_small . $secondmenu_font_color . $font_mobile_menu_placeholder . $menu_font_color . $titlealign . $dropdown_font . $social_border . $dbg_color . $product_button . $title_padding . $notavailable_placeholder_text . $logo_switch . $mobile_logo_switch . $title_uppercase . $subtitle_uppercase . $post_author . $post_cats . $post_comments . $post_postdate . $custom_css;
	$kad_custom_css .= '</style>';

	echo $kad_custom_css;
}
add_action( 'wp_head', 'ascend_custom_css' );

