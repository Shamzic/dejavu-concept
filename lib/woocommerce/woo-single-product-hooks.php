<?php
/*
 This theme supports WooCommerce */
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ascend_single_woocommerce_support() {
	if ( class_exists( 'woocommerce' ) ) {
		$ascend = ascend_get_options();
		function product_layout_post_class( $classes ) {
				$ascend = ascend_get_options();
			if ( is_singular( 'product' ) ) {
				if ( isset( $ascend['product_content_layout'] ) && $ascend['product_content_layout'] == 'large-image' ) {
					$classes[] = 'kt-product-style-large-image';
				}
			}
				return $classes;
		}
		add_filter( 'body_class', 'product_layout_post_class' );

		function single_product_post_class( $classes ) {
			if ( is_singular( 'product' ) ) {
				global $product;
				$attachment_ids = $product->get_gallery_image_ids();
				if ( ! $attachment_ids ) {
					$classes[] = 'kt-product-no-thumbnail-images';
				}
			}
			return $classes;
		}
		add_filter( 'post_class', 'single_product_post_class' );
		// Add Product Nav above title
		function ascend_woo_product_navigation() {
			$ascend = ascend_get_options();
			if ( isset( $ascend['product_single_nav'] ) && $ascend['product_single_nav'] == '1' ) {
				echo '<div class="post-footer-section post-product-nav-section">';
					echo '<div class="kad-post-navigation product-nav clearfix">';
						$prev_post = get_adjacent_post( true, null, true, 'product_cat' );
				if ( ! empty( $prev_post ) ) :
					echo '<div class="alignleft kad-previous-link">';
						echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '"><span class="kt_postlink_meta kt_color_gray">' . __( 'Previous Product', 'ascend' ) . '</span><span class="kt_postlink_title">' . esc_html( $prev_post->post_title ) . '</span></a>';
					echo '</div>';
						endif;
						$next_post = get_adjacent_post( true, null, false, 'product_cat' );
				if ( ! empty( $next_post ) ) :
					echo '<div class="alignright kad-next-link">';
						echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '"><span class="kt_postlink_meta kt_color_gray">' . __( 'Next Product', 'ascend' ) . '</span><span class="kt_postlink_title">' . esc_html( $next_post->post_title ) . '</span></a>';
					echo '</div>';
						endif;
					echo '</div> <!-- end navigation -->';
				echo '</div>';
			}

		}
		add_action( 'woocommerce_after_single_product_summary', 'ascend_woo_product_navigation', 12 );
		function ascend_woo_product_title_cat() {
			global $post;
			$ascend = ascend_get_options();
			if ( isset( $ascend['product_cat_above_title'] ) && $ascend['product_cat_above_title'] == '1' ) {
				echo '<div class="product_title_cat">';
						$main_term = ascend_get_primary_term( $post->ID, 'product_cat' );
				if ( $main_term ) {
					echo esc_html( $main_term->name );
				}
				echo '</div>';
			}
		}
		add_action( 'woocommerce_single_product_summary', 'ascend_woo_product_title_cat', 4 );

		if ( isset( $ascend['product_post_title_inpost'] ) && $ascend['product_post_title_inpost'] == 0 ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		}

		/**
		 * Function to filter how many related posts show.
		 *
		 * @param array $args current args.
		 */
		function ascend_product_related_products_limit( $args ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['related_item_column'] ) ) {
				$args['columns'] = $ascend['related_item_column'];
			}
			$args['posts_per_page'] = 8;

			return $args;
		}
		add_filter( 'woocommerce_output_related_products_args', 'ascend_product_related_products_limit' );

		// Display product tabs?
		add_action( 'wp_head', 'ascend_woo_tab_check' );
		function ascend_woo_tab_check() {
			$ascend = ascend_get_options();
			if ( isset( $ascend['product_tabs'] ) && $ascend['product_tabs'] == 'none' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			} elseif ( isset( $ascend['product_tabs'] ) && $ascend['product_tabs'] == 'list' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
				add_action( 'woocommerce_after_single_product_summary', 'ascend_woo_output_product_tabs_list', 10 );
			}
		}
		function ascend_woo_output_product_tabs_list() {
			$tabs = apply_filters( 'woocommerce_product_tabs', array() );

			if ( ! empty( $tabs ) ) : ?>
				<div class="kt-custom-row-full-stretch">
					<div class="woocommerce-tabs-list">
						<?php foreach ( $tabs as $key => $tab ) : ?>
							<div class="woocommerce-Tabs-panel-list list-woocommerce-tab-panel-<?php echo esc_attr( $key ); ?> entry-content wc-tab" id="list-tab-<?php echo esc_attr( $key ); ?>">
								<div class="container tab-list-container">
									<?php call_user_func( $tab['callback'], $key, $tab ); ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<?php
			endif;
		}
		// Display related products?
		add_action( 'wp_head', 'ascend_woo_related_products' );
		function ascend_woo_related_products() {
			$ascend = ascend_get_options();
			if ( isset( $ascend['related_products'] ) && $ascend['related_products'] == '0' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
		}

		// Change the tab title
		add_filter( 'woocommerce_product_tabs', 'ascend_woo_rename_tabs', 98 );
		function ascend_woo_rename_tabs( $tabs ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['description_tab_text'] ) && ! empty( $tabs['description']['title'] ) ) {
				$tabs['description']['title'] = $ascend['description_tab_text'];}
			if ( ! empty( $ascend['additional_information_tab_text'] ) && ! empty( $tabs['additional_information']['title'] ) ) {
				$tabs['additional_information']['title'] = $ascend['additional_information_tab_text'];}
			if ( ! empty( $ascend['reviews_tab_text'] ) && ! empty( $tabs['reviews']['title'] ) ) {
				$tabs['reviews']['title'] = $ascend['reviews_tab_text'];}

			return $tabs;
		}

		// Change the tab description heading
		add_filter( 'woocommerce_product_description_heading', 'ascend_description_tab_heading', 10, 1 );
		function ascend_description_tab_heading( $title ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['description_header_text'] ) ) {
				$title = $ascend['description_header_text'];
			}
			return $title;
		}

		// Change the tab aditional info heading
		add_filter( 'woocommerce_product_additional_information_heading', 'ascend_additional_information_tab_heading', 10, 1 );
		function ascend_additional_information_tab_heading( $title ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['additional_information_header_text'] ) ) {
				$title = $ascend['additional_information_header_text'];
			}
			return $title;
		}
		add_filter( 'woocommerce_product_tabs', 'ascend_woo_reorder_tabs', 98 );
		function ascend_woo_reorder_tabs( $tabs ) {
			$ascend = ascend_get_options();
			if ( isset( $ascend['ptab_description'] ) ) {
				$dpriority = $ascend['ptab_description'];
			} else {
				$dpriority = 10;}
			if ( isset( $ascend['ptab_additional'] ) ) {
				$apriority = $ascend['ptab_additional'];
			} else {
				$apriority = 20;}
			if ( isset( $ascend['ptab_reviews'] ) ) {
				$rpriority = $ascend['ptab_reviews'];
			} else {
				$rpriority = 30;}

			if ( ! empty( $tabs['description'] ) ) {
				$tabs['description']['priority'] = $dpriority;      // Description
			}
			if ( ! empty( $tabs['additional_information'] ) ) {
				$tabs['additional_information']['priority'] = $apriority; // Additional information
			}
			if ( ! empty( $tabs['reviews'] ) ) {
				$tabs['reviews']['priority'] = $rpriority;     // Reviews
			}

			return $tabs;
		}

		add_action( 'woocommerce_before_single_product_summary', 'ascend_woocommerce_image_wrap_start', 1 );
		function ascend_woocommerce_image_wrap_start() {
			echo '<div class="row single-product-row clearfix">';
			echo '<div class="col-lg-4 col-md-5 col-sm-4 product-img-case">';
		}
		add_action( 'woocommerce_before_single_product_summary', 'ascend_woocommerce_image_wrap_end', 50 );
		function ascend_woocommerce_image_wrap_end() {
			echo '</div>';
			echo '<div class="col-lg-8 col-md-7 col-sm-8 product-summary-case">';
		}
		add_action( 'woocommerce_single_product_summary', 'ascend_woocommerce_summary_wrap_end', 100 );
		function ascend_woocommerce_summary_wrap_end() {
			echo '</div>';
			echo '</div>';
		}
		add_filter( 'woocommerce_reset_variations_link', 'ascend_woocommerce_reset_variations_text' );
		function ascend_woocommerce_reset_variations_text( $html ) {
			$ascend = ascend_get_options();
			if ( ! empty( $ascend['wc_clear_placeholder_text'] ) ) {
				$cleartext = $ascend['wc_clear_placeholder_text'];
			} else {
				$cleartext = __( 'Clear selection', 'ascend' );
			}
			$html = '<a class="reset_variations" href="#">' . esc_html( $cleartext ) . '</a>';
			return $html;
		}
	}
}
add_action( 'after_setup_theme', 'ascend_single_woocommerce_support' );


