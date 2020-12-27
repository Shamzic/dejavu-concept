<?php
/**
 * Display breadcrumbs
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Display breadcrumbs
 */
function ascend_display_page_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['show_breadcrumbs_page'] ) ) {
		if ( '1' === $ascend['show_breadcrumbs_page'] ) {
			$showbreadcrumbs = true;
		} else {
			$showbreadcrumbs = false;
		}
	} else {
		$showbreadcrumbs = false;
	}
	return $showbreadcrumbs;
}
/**
 * Check to Display breadcrumbs
 */
function ascend_display_archive_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) ) {
		if ( isset( $ascend['show_breadcrumbs_shop'] ) ) {
			if ( '1' == $ascend['show_breadcrumbs_shop'] ) {
				$showbreadcrumbs = true;
			} else {
				$showbreadcrumbs = false;
			}
		} else {
			$showbreadcrumbs = true;
		}
	} else {
		if ( isset( $ascend['show_breadcrumbs_archive'] ) ) {
			if ( '1' == $ascend['show_breadcrumbs_archive'] ) {
				$showbreadcrumbs = true;
			} else {
				$showbreadcrumbs = false;
			}
		} else {
			$showbreadcrumbs = true;
		}
	}
	return $showbreadcrumbs;
}
/**
 * Check to Display breadcrumbs
 */
function ascend_display_post_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['show_breadcrumbs_post'] ) ) {
		if ( '1' == $ascend['show_breadcrumbs_post'] ) {
			$showbreadcrumbs = true;
		} else {
			$showbreadcrumbs = false;
		}
	} else {
		$showbreadcrumbs = true;
	}
	return $showbreadcrumbs;
}
/**
 * Check to Display breadcrumbs
 */
function ascend_display_shop_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['show_breadcrumbs_shop'] ) ) {
		if ( '1' == $ascend['show_breadcrumbs_shop'] ) {
			$showbreadcrumbs = true;
		} else {
			$showbreadcrumbs = false;
		}
	} else {
		$showbreadcrumbs = true;
	}
	return $showbreadcrumbs;
}
/**
 * Check to Display breadcrumbs
 */
function ascend_display_product_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['show_breadcrumbs_product'] ) ) {
		if ( '1' == $ascend['show_breadcrumbs_product'] ) {
			$showbreadcrumbs = true;
		} else {
			$showbreadcrumbs = false;
		}
	} else {
		$showbreadcrumbs = true;
	}
	return $showbreadcrumbs;
}
/**
 * Check to Display breadcrumbs
 */
function ascend_display_portfolio_breadcrumbs() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['show_breadcrumbs_portfolio'] ) ) {
		if ( '1' == $ascend['show_breadcrumbs_portfolio'] ) {
			$showbreadcrumbs = true;
		} else {
			$showbreadcrumbs = false;
		}
	} else {
		$showbreadcrumbs = true;
	}
	return $showbreadcrumbs;
}

if ( ! function_exists( 'ascend_breadcrumbs' ) ) {
	/**
	 * Ascend Breadcrumbs
	 *
	 * @param string $color here you can defined an in line color.
	 */
	function ascend_breadcrumbs( $color = null ) {
		global $ascend;
		if ( ! empty( $ascend['home_breadcrumb_text'] ) ) {
			$home = $ascend['home_breadcrumb_text'];
		} else {
			$home = __( 'Home', 'ascend' );
		}
		if ( ! empty( $ascend['blog_link'] ) ) {
			$blog_link = $ascend['blog_link'];
		} else {
			$blog_link = '';
		}
		if ( ! empty( $ascend['portfolio_link'] ) ) {
			$portfolio_link = $ascend['portfolio_link'];
		} else {
			$portfolio_link = '';
		}
		if ( ! empty( $ascend['staff_link'] ) ) {
			$staff_link = $ascend['staff_link'];
		} else {
			$staff_link = '';
		}
		if ( ! empty( $ascend['testimonial_link'] ) ) {
			$testimonial_link = $ascend['testimonial_link'];
		} else {
			$testimonial_link = '';
		}
		if ( isset( $ascend['shop_breadcrumbs'] ) && '1' == $ascend['shop_breadcrumbs'] ) {
			$show_shop = true;
		} else {
			$show_shop = false;
		}
		if ( ! empty( $color ) ) {
			$color_style = $color;
		} else {
			$color_style = '';
		}
		$args = array(
			'home_title'     => $home,
			'404_title'      => __( 'Error 404', 'ascend' ),
			'search_title'   => __( 'Search results for', 'ascend' ),
			'page'           => __( 'Page', 'ascend' ),
			'show_shop'      => $show_shop,
			'color_style'    => $color_style,
			'blog_id'        => $blog_link,
			'portfolio_id'   => $portfolio_link,
			'staff_id'       => $staff_link,
			'testimonial_id' => $testimonial_link,
		);
		if ( class_exists( 'Kadence_Breadcrumbs' ) ) {
			$breadcrumbs = Kadence_Breadcrumbs::get_instance();
			echo wp_kses_post( $breadcrumbs->get_breadcrumb( $args ) );
		}
	}
}
