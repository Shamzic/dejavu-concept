<?php 
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce */
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_setup_theme', 'ascend_woo_archive_support' );
function ascend_woo_archive_support() {

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    add_filter('woocommerce_show_page_title', 'ascend_remove_shop_title', 20);
    function ascend_remove_shop_title() {
    	return  false;
    }
    add_action( 'woocommerce_before_main_content', 'ascend_woo_shop_archive_title', 5 );
	function ascend_woo_shop_archive_title() {
		$ascend = ascend_get_options();
		if (is_shop()) {
				if(ascend_display_pagetitle()) {
					get_template_part('templates/shop/shop', 'page-header');
				} else {
					if( ascend_display_shop_breadcrumbs()) { 
						echo '<div class="kt_bc_nomargin">';
						ascend_breadcrumbs(); 
						echo '</div>';
					}
				}
		} else if(is_product()) {
			if(ascend_display_pagetitle()) {
				get_template_part('templates/post', 'header');
			} else {
				if( ascend_display_product_breadcrumbs()) { 
					echo '<div class="kt_bc_nomargin">';
					ascend_breadcrumbs(); 
					echo '</div>';
				}
			}
		} else {
			if(ascend_display_pagetitle()) {
				get_template_part('templates/archive', 'header');
			} else {
				if( ascend_display_archive_breadcrumbs()) { 
					echo '<div class="kt_bc_nomargin">';
					ascend_breadcrumbs(); 
					echo '</div>';
				}
			}
		}
	}
    function ascend_woo_main_wrap_content_open() {
      	echo '<div id="content" class="container"><div class="row"><div class="main '.esc_attr( ascend_main_class() ).'" role="main">';
    }
    add_action( 'woocommerce_before_main_content', 'ascend_woo_main_wrap_content_open', 10 );
   
    function ascend_woo_loop_top() {
      	echo '<div class="kad-shop-top">';
			echo '<div class="kad-top-top-item kad-woo-results-count">';
					woocommerce_result_count(); 
			echo '</div>';
			echo '<div class="kad-top-top-item kad-woo-ordering">';
						woocommerce_catalog_ordering();
			echo '</div>';
		echo '</div>';
    }
    add_action( 'woocommerce_before_shop_loop', 'ascend_woo_loop_top', 20 );

    function ascend_woo_main_wrap_content_close() {
      	echo '</div>';
		if (ascend_display_sidebar()) : 
		      	get_sidebar();
	    endif;
	   	echo '</div></div>';
    }
    add_action( 'woocommerce_after_main_content', 'ascend_woo_main_wrap_content_close', 20 );


    add_filter( 'archive_woocommerce_short_description', 'wptexturize', 10);
    add_filter( 'archive_woocommerce_short_description', 'wpautop', 10);
    add_filter( 'archive_woocommerce_short_description', 'shortcode_unautop', 10);
    add_filter( 'archive_woocommerce_short_description', 'do_shortcode', 11 );

 
    // Set the number of cross_sells columns to 3
    function ascend_woo_cross_sells_columns( $columns ) {
        return 4;
    }
    add_filter( 'woocommerce_cross_sells_columns', 'ascend_woo_cross_sells_columns', 10, 1 );

    // Limit the number of cross sells displayed to a maximum of 3
    function ascend_woo_cross_sells_total( $limit ) {
        return 4;
    }
    add_filter( 'woocommerce_cross_sells_total', 'ascend_woo_cross_sells_total', 10, 1 );
   
    // Number of products per page
    add_filter('loop_shop_per_page', 'ascend_woo_products_per_page');
    function ascend_woo_products_per_page() {
        $ascend = ascend_get_options();
        if ( isset( $ascend['products_per_page'] ) && !empty($ascend['products_per_page']) ) {
          	return $ascend['products_per_page'];
        }
    }

    // Shop Columns
    add_filter('loop_shop_columns', 'ascend_woo_loop_columns');
    function ascend_woo_loop_columns() {
        $ascend = ascend_get_options();
        if(isset($ascend['product_shop_layout']) && !empty($ascend['product_shop_layout'])) {
          	return $ascend['product_shop_layout'];
        } else {
          	return 4;
        }
    }
}


/*
*
* WOO ARCHIVE Product Hooks
*
*/
function ascend_woo_archive_hooks_output() {

	/**
	 * Product Class output
	 *
	 * @param mixed $classes the added classes.
	 */
	function ascend_add_product_loop_classes( $classes = array() ) {
		global $product, $post, $woocommerce_loop, $ascend;
		// Store column count for displaying the grid.
		if ( empty( $woocommerce_loop['columns'] ) ) {
			$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
		}

		$product_column = $woocommerce_loop['columns'];

		if ( '1' == $product_column ) {
			$itemsize = 'col-md-12 col-sm-12 col-xs-12 col-ss-12';
		} elseif ( '2' == $product_column ) {
			$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
		} elseif ( '3' == $product_column ) {
			$itemsize = 'col-xxl-25 col-xl-3 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		} elseif ( '6' == $product_column ) {
			$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		} elseif ( '5' == $product_column ) {
			$itemsize = 'col-xxl-2 col-xl-25 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		} else {
			$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-6';
		}
		$classes[] = $itemsize;
		$terms = get_the_terms( $post->ID, 'product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$links = array();
			foreach ( $terms as $term ) {
				$links[] = $term->slug;
			}
			$links = preg_replace( '/[^a-zA-Z 0-9]+/', '-', $links );
			$tax = join( ' ', $links );
		} else {
			$tax = '';
		}
		$classes[] = $tax;
		$classes[] = 'kad_product';
		return array_filter( array_unique( $classes ) );
	}
	add_filter( 'kadence_woo_ele_product_loop_classes', 'ascend_add_product_loop_classes' );
	/*
	* woocommerce_before_shop_loop_item
	*/
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );    

    /*
	* woocommerce_before_shop_loop_item_title
	*/
	function ascend_woocommerce_image_link_open() {
        echo  '<a href="'.esc_url( get_the_permalink() ).'" class="product_item_link product_img_link">';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'ascend_woocommerce_image_link_open', 2 );


    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    function ascend_woocommerce_template_loop_product_thumbnail() {
        global $product, $woocommerce_loop, $post;
        $ascend = ascend_get_options();
        
        $product_column = $woocommerce_loop['columns'];

        if ($product_column == '1') {
        	$productimgwidth = 300;
        }	else if ($product_column == '2') {
        	$productimgwidth = 300;
        } else if ($product_column == '3'){
          	$productimgwidth = 400;
      	} else if ($product_column == '6'){ 
      		$productimgwidth = 240;
      	} else if ($product_column == '5'){ 
      		$productimgwidth = 240;
      	} else { 
      		$productimgwidth = 300;
      	}

        if ( isset( $ascend['product_img_resize'] ) && $ascend['product_img_resize'] == 0 ) {
          	$resizeimage = 0;
        } else {
        	$image_crop = true;
          	$resizeimage = 1;
            if(isset($ascend['shop_img_ratio'])) {
            	$img_ratio = $ascend['shop_img_ratio'];
            } else {
            	$img_ratio = 'square';
            }
            if($img_ratio == 'portrait') {
                  $tempproductimgheight = $productimgwidth * 1.35;
                  $productimgheight = floor($tempproductimgheight);
            } else if($img_ratio == 'landscape') {
                $tempproductimgheight = $productimgwidth / 1.35;
                $productimgheight = floor($tempproductimgheight);
            } else if($img_ratio == 'widelandscape') {
                $tempproductimgheight = $productimgwidth / 2;
               	$productimgheight = floor($tempproductimgheight);
            } else if($img_ratio == 'softcrop') {
                $productimgheight = null;
                $image_crop = false;
            } else {
                $productimgheight = $productimgwidth;
            }
        }
        $productimgwidth = apply_filters( 'ascend_product_catelog_image_width', $productimgwidth );
        if ( ! empty( $productimgheight ) ) {
        	$productimgheight = apply_filters( 'ascend_product_catelog_image_height', $productimgheight );
        }
        if ( empty( $productimgheight ) ) {
        	$ratio_height = $productimgwidth;
        	$ratio_class = 'kt-product-softcrop';
        } else {
        	$ratio_height = $productimgheight;
        	$ratio_class = 'kt-product-hardcrop';
        }
        if ( $resizeimage == 1 ) {
            if ( has_post_thumbnail() ) {
                $image_id = get_post_thumbnail_id( $post->ID );
                $img = ascend_get_image_array($productimgwidth, $productimgheight, $image_crop, 'attachment-shop_catalog wp-post-image', null, $image_id, $placeholder = false);              
            } else {
            	$image_id = null;
                $img = array(
                	'src' => wc_placeholder_img_src(),
                	'alt'	=> get_the_title(),
               		'srcset' => '',
               		'class' => 'attachment-shop_catalog wp-post-image',
               		'width' => $productimgwidth,
               		'height' => $productimgheight,
               		);
            } 
            if( ascend_lazy_load_filter() ) {
	            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
	        } else {
	            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
	        }

            echo '<div class="kad-product-noflipper '.esc_attr($ratio_class).' kt-product-intrinsic" style="padding-bottom:'. esc_attr(($ratio_height/$productimgwidth) * 100 ).'%;">';
            	echo '<div class="kt-product-animation-contain">';
	                ob_start(); 	
	                	echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).' size-'.esc_attr($img['width'].'x'.$img['height']).'" alt="'.esc_attr($img['alt']).'">';
	                echo apply_filters('post_thumbnail_html', ob_get_clean(), $post->ID, $image_id, array($productimgwidth, $productimgheight), $attr = '');
	            echo '</div>';
            echo '</div>';
        } else { 
            echo '<div class="kad-woo-image-size">';
                echo woocommerce_template_loop_product_thumbnail();
            echo '</div>';
        }
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'ascend_woocommerce_template_loop_product_thumbnail', 10 );

    function ascend_woocommerce_image_link_close() {
        echo '</a>';
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'ascend_woocommerce_image_link_close', 50 );

    /*
	* woocommerce_shop_loop_item_title
	*/

    function ascend_woocommerce_archive_content_wrap_start() {
    	echo '<div class="details_product_item">';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_content_wrap_start', 5 );
	function ascend_woocommerce_archive_title_wrap_start() {
		echo '<div class="product_details">';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_title_wrap_start', 6 );
	function ascend_woocommerce_archive_title_link_start() {
				echo '<a href="'.esc_url( get_the_permalink() ).'" class="product_item_link">';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_title_link_start', 7 );

    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

    function ascend_woocommerce_template_loop_product_title() {
        echo '<h3 class="product_archive_title">'.get_the_title().'</h3>';
    }
    add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_template_loop_product_title', 10);

	function ascend_woocommerce_archive_title_link_end() {
				echo '</a>';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_title_link_end', 15 );

	function ascend_woocommerce_archive_excerpt() {
		global $post;
		$ascend = ascend_get_options();
		if(isset($ascend['shop_excerpt']) && 0 == $ascend['shop_excerpt']) {
			echo '<div class="product_excerpt">';
				if ($post->post_excerpt){
					echo apply_filters( 'archive_woocommerce_short_description', $post->post_excerpt );
				} else {
					the_excerpt();
				}
			echo '</div>';
		}
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_excerpt', 20 );
	function ascend_woocommerce_archive_title_wrap_end() {
    	echo '</div>';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'ascend_woocommerce_archive_title_wrap_end', 50 );

	/*
	* woocommerce_after_shop_loop_item_title
	*/
	function ascend_woocommerce_archive_content_wrap_end() {
    	echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'ascend_woocommerce_archive_content_wrap_end', 50 );
	/*
	* woocommerce_after_shop_loop_item
	*/
	function ascend_woocommerce_archive_action_wrap_start() {
    	echo '<div class="product_action_wrap">';
	}
	add_action( 'woocommerce_after_shop_loop_item', 'ascend_woocommerce_archive_action_wrap_start', 5 );
	function ascend_woocommerce_archive_action_wrap_end() {
    	echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item', 'ascend_woocommerce_archive_content_wrap_end', 20 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action( 'init', 'ascend_woo_archive_hooks_output');


function ascend_woo_archive_cat_hooks_output() {  
    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title', 'ascend_woocommerce_template_loop_category_title', 10 );

    function ascend_woocommerce_template_loop_category_title( $category ) {
    	echo '<div class="product-cat-title-area">';
        	echo '<h3 class="product_archive_title">';
            	echo $category->name;
                if ( $category->count > 0 ) {
                    echo apply_filters( 'woocommerce_subcategory_count_html', ' <small class="count">(' . esc_html($category->count) . ')</small>', $category );
                }
        	echo '</h3>';
        	echo '</div>';
    }

    remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
    remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );
    add_action( 'woocommerce_before_subcategory', 'ascend_woocommerce_template_loop_category_link_open', 10 );
    add_action( 'woocommerce_after_subcategory', 'ascend_woocommerce_template_loop_category_link_close', 10 );

    function ascend_woocommerce_template_loop_category_link_open( $category ) {
        echo '<a href="' . esc_url( get_term_link( $category->slug, 'product_cat' ) ) . '">';
    }
    function ascend_woocommerce_template_loop_category_link_close() {
        echo '</a>';
    }
}
add_action( 'init', 'ascend_woo_archive_cat_hooks_output');
    
/*
*
* WOO ARCHIVE CAT IMAGES
*
*/
function ascend_woo_archive_cat_image_output() {
    remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
    add_action( 'woocommerce_before_subcategory_title', 'ascend_woocommerce_subcategory_thumbnail', 10 );
    function ascend_woocommerce_subcategory_thumbnail($category) {
        global $woocommerce_loop;
        $ascend = ascend_get_options();
        if(is_shop() || is_product_category() || is_product_tag()) {
            if(isset($ascend['product_cat_layout']) && !empty($ascend['product_cat_layout'])) {
                $product_cat_column = $ascend['product_cat_layout'];
            } else {
                $product_cat_column = 4;
            }
        } else {
            if ( empty( $woocommerce_loop['columns'] ) ) {
                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
            }
            $product_cat_column = $woocommerce_loop['columns'];
        }

        if ($product_cat_column == '1') {
            $catimgwidth = 600;
        } else if ($product_cat_column == '2') {
            $catimgwidth = 600;
        } else if ($product_cat_column == '3'){
            $catimgwidth = 400;
        } else if ($product_cat_column == '6'){
            $catimgwidth = 240;
        } else if ($product_cat_column == '5'){ 
            $catimgwidth = 240;
        } else {
            $catimgwidth = 300;
        }

        if(isset($ascend['product_cat_img_ratio'])) {
            $img_ratio = $ascend['product_cat_img_ratio'];
        } else {
            $img_ratio = 'square';
        }

        if($img_ratio == 'portrait') {
                $tempcatimgheight = $catimgwidth * 1.35;
                $catimgheight = floor($tempcatimgheight);
        } else if($img_ratio == 'landscape') {
                $tempcatimgheight = $catimgwidth / 1.35;
                $catimgheight = floor($tempcatimgheight);
        } else if($img_ratio == 'square') {
                $catimgheight = $catimgwidth;
        } else {
                $tempcatimgheight = $catimgwidth / 2;
                $catimgheight = floor($tempcatimgheight);
        }
        // OUTPUT 

        if($img_ratio == 'off') {
                woocommerce_subcategory_thumbnail($category);
        } else {
            $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true  );
            if ( $thumbnail_id ) {
            	$img = ascend_get_image_array( $catimgwidth, $catimgheight, true, 'attachment-shop_catalog wp-post-image', null, $thumbnail_id, true);
            } else {
                $img = array(
                	'src' => wc_placeholder_img_src(),
                	'alt'	=> get_the_title(),
               		'srcset' => '',
               		'class' => 'attachment-shop_catalog wp-post-image',
               		'width' => $catimgwidth,
               		'height' => $catimgheight,
               		);
            }
            if( ascend_lazy_load_filter() ) {
	            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
	        } else {
	            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
	        }

            echo '<div class="kt-cat-intrinsic kt-product-intrinsic" style="padding-bottom:'. ($img['height']/$img['width']) * 100 .'%;">';
	                	echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).' size-'.esc_attr($img['width'].'x'.$img['height']).'" alt="'.esc_attr($img['alt']).'">';
            echo '</div>';
        }

    }
}
add_action( 'init', 'ascend_woo_archive_cat_image_output');