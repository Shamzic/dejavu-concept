<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Config Sidebar
 */

function ascend_sidebar_id() {
	if ( is_front_page() ) {
		$ascend = ascend_get_options();
		if ( ! empty( $ascend['home_sidebar'] ) ) {
			$sidebar = $ascend['home_sidebar'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( class_exists( 'woocommerce' ) and ( is_shop() ) ) {
		$shopid = get_option( 'woocommerce_shop_page_id' );
		$sidebar_name = get_post_meta( $shopid, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['shop_cat_sidebar'] ) ) {
				$sidebar = $ascend['shop_cat_sidebar'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( class_exists( 'woocommerce' ) and ( is_product_category() || is_product_tag() ) ) {
		$ascend = ascend_get_options();
		if ( ! empty( $ascend['shop_cat_sidebar'] ) ) {
			$sidebar = $ascend['shop_cat_sidebar'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( class_exists( 'woocommerce' ) and is_product() ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['product_sidebar_default'] ) ) {
				$sidebar = $ascend['product_sidebar_default'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} else if ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_page() ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || 'default' == $sidebar_name ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['page_sidebar_default'] ) ) {
				$sidebar = $ascend['page_sidebar_default'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_singular( 'post' ) ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['blog_sidebar_default'] ) ) {
				$sidebar = $ascend['blog_sidebar_default'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_singular( 'portfolio' ) ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['portfolio_sidebar_default'] ) ) {
				$sidebar = $ascend['portfolio_sidebar_default'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_tax( 'portfolio-type' ) || is_tax( 'portfolio-tag' ) ) {
		$ascend = ascend_get_options();
		if ( ! empty( $ascend['portfolio_sidebar_default'] ) ) {
			$sidebar = $ascend['portfolio_sidebar_default'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_singular( 'staff' ) || is_tax( 'staff-group' ) ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['staff_sidebar_default_sidebar'] ) ) {
				$sidebar = $ascend['staff_sidebar_default_sidebar'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_singular( 'testimonial' ) || is_tax( 'testimonial-group' ) ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['testimonial_sidebar_default'] ) ) {
				$sidebar = $ascend['testimonial_sidebar_default'];
			} else {
				$sidebar = 'sidebar-primary';
			}
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_singular() ) {
		global $post;
		$sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true );
		if ( empty( $sidebar_name ) || $sidebar_name == 'default' ) {
			$sidebar = 'sidebar-primary';
		} elseif ( ! empty( $sidebar_name ) ) {
			$sidebar = $sidebar_name;
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_category() ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['blog_cat_sidebar'] ) ) {
			$sidebar = $ascend['blog_cat_sidebar'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_archive() ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['blog_cat_sidebar'] ) ) {
			$sidebar = $ascend['blog_cat_sidebar'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} elseif ( is_search() ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['search_sidebar_default'] ) ) {
			$sidebar = $ascend['search_sidebar_default'];
		} else {
			$sidebar = 'sidebar-primary';
		}
	} else {
		$sidebar = 'sidebar-primary';
	}

	return apply_filters( 'ascend_sidebar_id', $sidebar );
}


function ascend_main_class() {
	if ( ascend_display_sidebar() ) {
		// Classes on pages with the sidebar
		$side = ascend_sidebar_side();
		$class = 'col-lg-9 col-md-8 kt-sidebar kt-sidebar-' . $side;
	} else {
		// Classes on full width pages
		$class = 'col-md-12 kt-nosidebar clearfix';
	}

	return apply_filters( 'ascend_main_content_classes', $class );
}

function ascend_sidebar_side() {
	$ascend = ascend_get_options();
	if ( class_exists( 'woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		if ( isset( $ascend['shop_cat_sidebar_side'] ) && $ascend['shop_cat_sidebar_side'] == 'left' ) {
			$side = 'left';
		} else {
			$side = 'right';
		}
	} else {
		if ( isset( $ascend['sidebar_side'] ) && $ascend['sidebar_side'] == 'left' ) {
			$side = 'left';
		} else {
			$side = 'right';
		}
	}
	return apply_filters( 'ascend_sidebar_side', $side );
}

/**
 * .sidebar classes
 */
function ascend_sidebar_class() {
	return 'col-lg-3 col-md-4 kt-sidebar-container';
}

/**
 * Define which pages shouldn't have the sidebar
 */
function ascend_display_sidebar() {
		$sidebar_config = new Ascend_Sidebar(
			array(
				'ascend_sidebar_on_shop_page', // Shop Page
				'ascend_sidebar_on_shop_cat_page', // Product Categories and Tags
				'ascend_sidebar_on_product_post', // Product posts
				'ascend_sidebar_page', // Pages
				'ascend_sidebar_on_staff', // staff Posts
				'ascend_sidebar_on_staff_archive', // staff Posts
				'ascend_sidebar_on_event', // event Posts
				'ascend_sidebar_on_testimonial', // testimonial Posts
				'ascend_sidebar_on_testimonial_archive', // testimonial Posts
				'ascend_sidebar_on_portfolio', // portfolio Posts
				'ascend_sidebar_on_portfolio_archive', // portfolio Posts
				'ascend_sidebar_on_post', // Blog Posts & Other post types
				'ascend_sidebar_on_front_page', // Front Home Page
				'ascend_sidebar_on_home_page', // Home Posts Page
				'ascend_sidebar_on_search_page', // Search results
				'ascend_sidebar_on_archive', // Post archives
				'is_404', // 404
				array(
					'is_singular',
					array( 'attachment' ),
				),
			)
		);

	return apply_filters( 'ascend_display_sidebar', $sidebar_config->display );
}

function ascend_sidebar_on_shop_page() {
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() ) {
			$shopid = get_option( 'woocommerce_shop_page_id' );
			$postsidebar = get_post_meta( $shopid, '_kad_post_sidebar', true );
			if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
				return false;
			} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
				$ascend = ascend_get_options();
				if ( isset( $ascend['shop_cat_layout'] ) && $ascend['shop_cat_layout'] == 'sidebar' ) {
					return false;
				} else {
					return true;
				}
			} else {
				return true;
			}
		}
	}
}
function ascend_sidebar_on_shop_cat_page() {
	if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['shop_cat_layout'] ) && $ascend['shop_cat_layout'] == 'sidebar' ) {
			return false;
		} else {
			return true;
		}
	}
}
function ascend_sidebar_on_product_post() {
	if ( is_singular( 'product' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
			return false;
		} else if ( empty( $postsidebar ) || ! isset( $postsidebar ) || $postsidebar == 'default' ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['product_layout'] ) && $ascend['product_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}
function ascend_sidebar_page() {
	if ( is_page() && ! is_front_page() && ! is_home() ) {
		if ( class_exists( 'woocommerce' ) ) {
			if ( is_cart() || is_checkout() ) {
				global $post;
				$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
				if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
					return false;
				} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
						return true;
				} else {
					return true;
				}
			} else {
				global $post;
				$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
				if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
					return false;
				} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
					$ascend = ascend_get_options();
					if ( isset( $ascend['page_layout'] ) && $ascend['page_layout'] == 'sidebar' ) {
						return false;
					} else {
						return true;
					}
				} else {
					return true;
				}
			}
		} else {
			global $post;
			$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
			if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
				return false;
			} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
				$ascend = ascend_get_options();
				if ( isset( $ascend['page_layout'] ) && $ascend['page_layout'] == 'sidebar' ) {
					return false;
				} else {
					return true;
				}
			} else {
				return true;
			}
		}
	}
}
function ascend_sidebar_on_testimonial() {
	if ( is_singular( 'testimonial' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'no' ) {
			return true;
		} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['testimonial_layout'] ) && $ascend['testimonial_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_testimonial_archive() {
	if ( is_tax( 'testimonial-group' ) ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['testimonial_layout'] ) && $ascend['testimonial_layout'] == 'full' ) {
			return true;
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_event() {
	if ( is_singular( 'tribe_events' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'no' ) {
			return true;
		} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( apply_filters( 'ascend_event_sidebar_default', true ) ) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_staff() {
	if ( is_singular( 'staff' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'no' ) {
			return true;
		} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['staff_layout'] ) && $ascend['staff_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_staff_archive() {
	if ( is_tax( 'staff-group' ) ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['staff_layout'] ) && $ascend['staff_layout'] == 'full' ) {
			return true;
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_portfolio() {
	if ( is_singular( 'portfolio' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'yes' ) {
			return false;
		} else if ( isset( $postsidebar ) && 'default' == $postsidebar || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['portfolio_layout'] ) && 'sidebar' == $ascend['portfolio_layout'] ) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
}
function ascend_sidebar_on_portfolio_archive() {
	if ( is_tax( 'portfolio-type' ) || is_tax( 'portfolio-tag' ) ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['portfolio_layout'] ) && $ascend['portfolio_layout'] == 'sidebar' ) {
			return false;
		} else {
			return true;
		}
	}
}
function ascend_sidebar_on_post() {
	if ( is_single() && ! is_singular( 'staff' ) && ! is_singular( 'portfolio' ) && ! is_singular( 'product' ) && ! is_singular( 'tribe_events' ) && ! is_singular( 'testimonial' ) ) {
		global $post;
		$postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'no' ) {
			return true;
		} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['blog_layout'] ) && $ascend['blog_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_front_page() {
	if ( is_front_page() ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['home_sidebar_layout'] ) && $ascend['home_sidebar_layout'] == '1' ) {
			return false;
		} else {
			return true;
		}
	}
}
function ascend_sidebar_on_home_page() {
	if ( is_home() && ! is_front_page() ) {
		$homeid = get_option( 'page_for_posts' );
		$postsidebar = get_post_meta( $homeid, '_kad_post_sidebar', true );
		if ( isset( $postsidebar ) && $postsidebar == 'no' ) {
			return true;
		} else if ( isset( $postsidebar ) && $postsidebar == 'default' || empty( $postsidebar ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['blog_cat_layout'] ) && $ascend['blog_cat_layout'] == 'sidebar' ) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_search_page() {
	if ( is_search() ) {
		$ascend = ascend_get_options();
		if ( isset( $ascend['search_layout'] ) && $ascend['search_layout'] == 'full' ) {
			return true;
		} else {
			return false;
		}
	}
}
function ascend_sidebar_on_archive() {
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_archive() && ( ! is_tax( 'portfolio-type' ) && ! is_tax( 'portfolio-tag' ) && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) && ! is_tax( 'staff-group' ) && ! is_tax( 'testimonial-group' ) && ! is_shop() ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['blog_cat_layout'] ) && $ascend['blog_cat_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		}
	} else {
		if ( is_archive() && ( ! is_tax( 'portfolio-type' ) && ! is_tax( 'portfolio-tag' ) && ! is_tax( 'staff-group' ) && ! is_tax( 'testimonial-group' ) ) ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['blog_cat_layout'] ) && $ascend['blog_cat_layout'] == 'full' ) {
				return true;
			} else {
				return false;
			}
		}
	}
}


