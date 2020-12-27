<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function ascend_wp_link_pages() {
	wp_link_pages(
		array(
			'before' => '<nav class="pagination kt-pagination">',
			'after' => '</nav>',
			'link_before' => '<span>',
			'link_after' => '</span>',
		)
	);
}

add_action( 'ascend_page_content', 'ascend_page_content_wrap_before', 10 );
function ascend_page_content_wrap_before() {
	echo '<div class="entry-content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">';
}
add_action( 'ascend_page_content', 'ascend_page_content', 20 );
function ascend_page_content() {
	get_template_part( 'templates/content', 'page' );
}
add_action( 'ascend_page_content', 'ascend_page_content_wrap_after', 30 );
function ascend_page_content_wrap_after() {
	echo '</div>';
}

add_action( 'ascend_page_footer', 'ascend_page_comments', 20 );
function ascend_page_comments() {
		comments_template( '/templates/comments.php' );
}

add_action( 'ascend_page_title_container', 'ascend_page_title', 20 );
function ascend_page_title() {
	if ( ascend_display_pagetitle() ) {
		get_template_part( 'templates/page', 'header' );
	} else {
		if ( ascend_display_page_breadcrumbs() ) {
			echo '<div class="kt_bc_nomargin kt_bread_container">';
			ascend_breadcrumbs();
			echo '</div>';
		}
	}
}
add_action( 'ascend_front_page_title_container', 'ascend_front_page_header', 20 );
function ascend_front_page_header() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['mobile_switch'] ) && $ascend['mobile_switch'] == 1 ) {
		if ( isset( $ascend['home_mobile_header'] ) ) {
			$m_home_header = $ascend['home_mobile_header'];
		} else {
			$m_home_header = 'none';
		}
		if ( $m_home_header == 'basic' ) {
			get_template_part( 'templates/mobile_home/mobile', 'basic-slider' );
		} else if ( $m_home_header == 'pagetitle' ) {
			get_template_part( 'templates/mobile_home/mobile', 'page-header' );
		}
	}
	if ( isset( $ascend['home_header'] ) ) {
		$home_header = $ascend['home_header'];
	} else {
		$home_header = 'pagetitle';
	}
	if ( $home_header == 'basic' ) {
		get_template_part( 'templates/home/basic', 'slider' );
	} else if ( $home_header == 'basic_post_carousel' ) {
		get_template_part( 'templates/home/post', 'carousel' );
	} else if ( $home_header == 'pagetitle' ) {
		get_template_part( 'templates/home/home', 'page-header' );
	}
}
if ( ! function_exists( 'ascend_icon_menu_output' ) ) {
	function ascend_icon_menu_output( $icon = 'kt-icon-cogs', $imageid = null, $link = null, $target = null, $title = null, $description = null, $readmore = null, $iconcolor = null, $iconbackground = null, $iconborder = null, $iconsize = null, $textcolor = null, $highlight = null ) {
		if ( ! empty( $target ) ) {
			$target = $target;
		} else {
			$target = '_self';
		}
		if ( ! empty( $iconbackground ) ) {
			$iconbackground = 'background-color:' . $iconbackground;
		} else {
			$iconbackground = '';
		}
		if ( ! empty( $iconsize ) ) {
			$iconsize = 'font-size:' . $iconsize . 'px';
		} else {
			$iconsize = '';
		}
		if ( ! empty( $iconcolor ) ) {
			$iconcolor = 'color:' . $iconcolor;
		} else {
			$iconcolor = '';
		}
		if ( ! empty( $iconborder ) ) {
			$iconborder = 'border-color:' . $iconborder;
		} else {
			$iconborder = '';
		}
		if ( ! empty( $textcolor ) ) {
			$textcolor = 'color:' . $textcolor;
		} else {
			$textcolor = '';
		}
		if ( ! empty( $highlight ) ) {
			$highlight_border = 'border-color:' . $highlight;
			$highlight_bg = 'background-color:' . $highlight;
		} else {
			$highlight_border = '';
			$highlight_bg = '';
		}
		if ( ! empty( $icon ) ) {
			$icon = $icon;
		} else {
			$icon = 'kt-icon-cogs';
		}
		if ( ! empty( $link ) ) {
			echo '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '"  title="' . esc_attr( $title ) . '" class="box-icon-item">';
		} else {
			echo '<div class="box-icon-item">';
		}
				echo '<div class="icon-container" style="' . esc_attr( $iconbackground ) . ' ' . esc_attr( $iconcolor ) . ' ' . esc_attr( $iconborder ) . '">';
					echo '<span class="icon-left-highlight icon-heighlight" style="' . esc_attr( $highlight_border ) . '"></span>';
					echo '<span class="icon-right-highlight icon-heighlight" style="' . esc_attr( $highlight_border ) . '"></span>';
		if ( ! empty( $imageid ) ) {
			echo wp_get_attachment_image( $imageid, 'full' );
		} else {
			echo '<i class="' . esc_attr( $icon ) . '" style="' . esc_attr( $iconsize ) . '"></i>';
		}
				echo '</div>';
		if ( ! empty( $title ) ) {
			echo '<h4 style="' . esc_attr( $textcolor ) . '">' . esc_html( $title ) . '</h4>';
		}
		if ( ! empty( $description ) ) {
			echo '<div class="menu-icon-description" style="' . esc_attr( $textcolor ) . '">' . wp_filter_kses( $description ) . '</div>';
		}
		if ( ! empty( $readmore ) ) {
			echo '<div class="menu-icon-read-more" style="' . esc_attr( $textcolor ) . '"><span class="read-more-highlight" style="' . esc_attr( $highlight_bg ) . '"></span>' . esc_html( $readmore ) . '</div>';
		}
		if ( ! empty( $link ) ) {
			echo '</a>';
		} else {
			echo '</div>';
		}
	}
}
if ( ! function_exists( 'ascend_build_image_menu' ) ) {
	function ascend_build_image_menu( $imageid = null, $type = 'fixed_height', $height = '220', $link = null, $target = '_self', $title = null, $subtitle = null, $align = 'left', $valign = 'center', $class = null ) {
		if ( empty( $imageid ) ) {
			return;
		}
		ob_start();
		if ( $type == 'image_height' ) {
			$csstype = 'image-menu-image-size';
		} else {
			$csstype = 'image-menu-fixed-height';
		}
			$image = wp_get_attachment_image_src( $imageid, 'full' );
			$alt = get_post_meta( $imageid, '_wp_attachment_image_alt', true );
		?>
			<div class="<?php echo esc_attr( $csstype ); ?> image-menu_item <?php echo esc_attr( $class ); ?>">
				<?php
				if ( ! empty( $link ) ) {
					echo '<a href="' . esc_url( $link ) . '" class="image_menu_item_link" target="' . esc_attr( $target ) . '">';
				} else {
					echo '<div class="image_menu_item_link">';
				}
				?>
					<?php if ( $type == 'image_height' ) { ?>
						<img src="<?php echo esc_url( $image['0'] ); ?>" width="<?php echo esc_attr( $image['1'] ); ?>" height="<?php echo esc_attr( $image['2'] ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
					<?php } else { ?>
							<div class="image_menu-bg-item" style="background: url(<?php echo esc_url( $image['0'] ); ?>) center center no-repeat; height:<?php echo esc_attr( $height ); ?>px; background-size:cover;">
						</div>
					<?php } ?>
					<div class="image_menu_overlay"></div>
					<div class="image_menu_message  <?php echo 'imt-align-' . esc_attr( $align ); ?> <?php echo 'imt-valign-' . esc_attr( $valign ); ?>">
						<div class="image_menu_message_inner">
							<?php
							if ( ! empty( $title ) ) {
								echo '<h4>' . esc_html( $title ) . '</h4>';
							}
							if ( ! empty( $subtitle ) ) {
								echo '<h5>' . esc_html( $subtitle ) . '</h5>';
							}
							?>
						</div>
					</div>
				<?php
				if ( ! empty( $link ) ) {
					echo '</a>';
				} else {
					echo '</div>';
				}
				?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}
}
if ( ! function_exists( 'ascend_build_post_content_carousel' ) ) {
	function ascend_build_post_content_carousel( $id = 'content_carousel', $columns = '4', $type = 'post', $cat = null, $items = 8, $orderby = null, $order = null, $class = null, $offset = null, $auto = 'true', $speed = '9000', $scroll = '1', $arrows = 'true', $trans_speed = '400', $productargs = null, $xxlcol = null, $xlcol = null, $mdcol = null, $smcol = null, $xscol = null, $sscol = null ) {
		$cc = array();
		if ( $columns == '2' ) {
			$cc = ascend_carousel_columns( '2' );
		} else if ( $columns == '3' ) {
			$cc = ascend_carousel_columns( '3' );
		} else if ( $columns == '6' ) {
			$cc = ascend_carousel_columns( '6' );
		} else if ( $columns == '5' ) {
			$cc = ascend_carousel_columns( '5' );
		} else {
			$cc = ascend_carousel_columns( '4' );
		}
		$cc = apply_filters( 'ascend_carousel_columns', $cc, $id );
		if ( ! empty( $xxlcol ) ) {
			$cc['xxl'] = $xxlcol;
		}
		if ( ! empty( $xlcol ) ) {
			$cc['xl'] = $xlcol;
		}
		if ( ! empty( $mdcol ) ) {
			$cc['md'] = $mdcol;
		}
		if ( ! empty( $smcol ) ) {
			$cc['sm'] = $smcol;
		}
		if ( ! empty( $xscol ) ) {
			$cc['xs'] = $xscol;
		}
		if ( ! empty( $sscol ) ) {
			$cc['ss'] = $sscol;
		}
		$post_type = $type;
		$extraargs = array();
		if ( $type == 'portfolio' ) {
			$tax = 'portfolio-type';
			$margin = 'row-margin-small';
			global $ascend_portfolio_loop;
			$ascend_portfolio_loop = array(
				'lightbox'      => 'true',
				'showexcerpt'   => 'false',
				'showtypes'     => 'true',
				'columns'       => $columns,
				'ratio'         => 'square',
				'style'         => 'pgrid',
				'carousel'      => 'true',
				'tileheight'    => '',
			);
			if ( empty( $orderby ) ) {
				$orderby = 'menu_order';
			}
			if ( empty( $order ) ) {
				$order = 'ASC';
			}
		} elseif ( $type == 'product' ) {
			global $woocommerce_loop;
			$margin = 'row-margin-small';
			if ( empty( $orderby ) ) {
				$orderby = 'menu_order';
			}
			if ( empty( $order ) ) {
				$order = 'ASC';
			}
			if ( $columns == 1 ) {
				$woocommerce_loop['columns'] = 3;
			} else {
				$woocommerce_loop['columns'] = $columns;
			}
			if ( $productargs == 'featured' ) {
				if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
					$meta_query  = WC()->query->get_meta_query();
					$tax_query   = WC()->query->get_tax_query();
					$tax_query[] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
					$extraargs = array(
						'meta_query'          => $meta_query,
						'tax_query'           => $tax_query,
					);
				} else {
					$meta_query   = WC()->query->get_meta_query();
					$meta_query[] = array(
						'key'   => '_featured',
						'value' => 'yes',
					);

					$extraargs = array(
						'meta_query'     => $meta_query,
					);
				}
			} else if ( 'best' === $productargs || 'best-products' === $productargs ) {
				$extraargs = array(
					'meta_key' => 'total_sales',
					'orderby'  => 'meta_value_num',
					'order'    => 'DESC',
				);
			} else if ( 'sale' === $productargs ) {
				if ( class_exists( 'woocommerce' ) ) {
					$extraargs = array(
						'meta_query' => WC()->query->get_meta_query(),
						'post__in'   => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
						'tax_query'  => WC()->query->get_tax_query(),
					);
				}
			} else if ( $productargs == 'latest' ) {
					$extraargs = array(
						'orderby'   => 'date',
						'order'     => 'DESC',
					);
			}
			$tax = 'product_cat';
		} else if ( $type == 'staff' ) {
			$margin = 'rowtight';
			$tax = 'staff-group';
			if ( empty( $orderby ) ) {
				$orderby = 'menu_order';
			}
			if ( empty( $order ) ) {
				$order = 'ASC';
			}
		} else if ( $type == 'testimonal' ) {
			$margin = 'rowtight';
			$tax = 'testimonal-group';
			if ( empty( $orderby ) ) {
				$orderby = 'menu_order';
			}
			if ( empty( $order ) ) {
				$order = 'ASC';
			}
		} else {
			$post_type = 'post';
			global $ascend_grid_columns, $ascend_grid_carousel;
			$ascend_grid_columns = $columns;
			$ascend_grid_carousel = true;
			$margin = 'rowtight';
			$tax = 'category';
			if ( empty( $orderby ) ) {
				$orderby = 'date';
			}
			if ( empty( $order ) ) {
				$order = 'DESC';
			}
			if ( $ascend_grid_columns == '2' ) {
				$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
			} else if ( $ascend_grid_columns == '3' ) {
				$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
			} else {
				$itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
			}
		}
		$args = array(
			'orderby'           => $orderby,
			'order'             => $order,
			'post_type'         => $post_type,
			'offset'            => $offset,
			'post_status'       => 'publish',
			'posts_per_page'    => $items,
		);
		$args = array_merge( $args, $extraargs );
		if ( ! empty( $cat ) ) {
			if ( 'product' == $post_type ) {
				if ( empty( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					array(
						'taxonomy' => $tax,
						'terms'    => array_map( 'sanitize_title', explode( ',', $cat ) ),
						'field'    => 'slug',
					),
				);
			} else {
				$ccat = array( $tax => $cat );
				$args = array_merge( $args, $ccat );
			}
		}
		echo '<div class="carousel_outerrim">';
		echo '<div class="carouselcontainer ' . esc_attr( $margin ) . '">';
		echo '<div id="kadence-carousel-' . esc_attr( $id ) . '" class="slick-slider ' . esc_attr( $class ) . ' carousel_shortcode kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="' . esc_attr( $trans_speed ) . '" data-slider-scroll="' . esc_attr( $scroll ) . '" data-slider-auto="' . esc_attr( $auto ) . '" data-slider-speed="' . esc_attr( $speed ) . '" data-slider-xxl="' . esc_attr( $cc['xxl'] ) . '" data-slider-xl="' . esc_attr( $cc['xl'] ) . '" data-slider-md="' . esc_attr( $cc['md'] ) . '" data-slider-sm="' . esc_attr( $cc['sm'] ) . '" data-slider-xs="' . esc_attr( $cc['xs'] ) . '" data-slider-ss="' . esc_attr( $cc['ss'] ) . '">';
			$loop = new WP_Query( $args );
			if ( $loop ) :
				if ( 'portfolio' === $type ) {
					while ( $loop->have_posts() ) :
						$loop->the_post();
						get_template_part( 'templates/content', 'loop-portfolio' );
					endwhile;
				} elseif ( 'product' === $type ) {
					while ( $loop->have_posts() ) :
						$loop->the_post();
						wc_get_template_part( 'content', 'product' );
					endwhile;
				} elseif ( 'post_photo' === $type ) {
					while ( $loop->have_posts() ) :
						$loop->the_post();
						echo '<div class="' . esc_attr( $itemsize ) . ' b_item kad_blog_item">';
							get_template_part( 'templates/content', 'post-photo-grid' );
						echo '</div>';
					endwhile;
				} else {
					while ( $loop->have_posts() ) :
						$loop->the_post();
						echo '<div class="' . esc_attr( $itemsize ) . ' b_item kad_blog_item">';
							get_template_part( 'templates/content', 'post-grid' );
						echo '</div>';
					endwhile;
				}
				wp_reset_postdata();
			endif;
			echo '</div>';
			echo '</div>';
			echo '</div> <!--Carousel-->';
	}
}

/**
 * Page Navigation
 */
function ascend_pagination() {

	$args['mid_size'] = 3;
	$args['end_size'] = 1;
	$args['prev_text'] = '<i class="kt-icon-chevron-left"></i>';
	$args['next_text'] = '<i class="kt-icon-chevron-right"></i>';

	echo '<div class="wp-pagenavi">';
			the_posts_pagination( $args );
	echo '</div>';
}
add_action( 'ascend_pagination', 'ascend_pagination', 10 );
