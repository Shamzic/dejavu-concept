<?php
/**
 * Post Header
 *
 * @package Ascend Theme
 */

global $post;
$ascend = ascend_get_options();
if ( isset( $ascend['single_header_title_size'] ) ) {
	$title_data = $ascend['single_header_title_size'];
} else {
	$title_data = '70';
}

if ( isset( $ascend['single_header_title_size_small'] ) ) {
	$title_small_data = $ascend['single_header_title_size_small'];
} else {
	$title_small_data = '30';
}

if ( isset( $ascend['single_header_subtitle_size'] ) ) {
	$subtitle_data = $ascend['single_header_subtitle_size'];
} else {
	$subtitle_data = '40';
}

if ( isset( $ascend['single_header_subtitle_size_small'] ) ) {
	$subtitle_small_data = $ascend['single_header_subtitle_size_small'];
} else {
	$subtitle_small_data = '20';
}


// Single Product.
if ( is_singular( 'product' ) ) {
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['product_post_title_content'] ) && 'custom' === $ascend['product_post_title_content'] ) {
		if ( isset( $ascend['product_header_title_text'] ) ) {
			$page_title_title = $ascend['product_header_title_text'];
		} else {
			$page_title_title = '';
		}
		if ( ! empty( $ascend['product_header_subtitle_text'] ) ) {
			$bsub = $ascend['product_header_subtitle_text'];
		}
	} elseif ( isset( $ascend['product_post_title_content'] ) && 'category' === $ascend['product_post_title_content'] ) {
		$main_term = ascend_get_primary_term( $post->ID, 'product_cat' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = '';
		}
	} else {
		$page_title_title = get_the_title();
	}
	if ( ascend_display_product_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'portfolio' ) ) {
	// Single Portfolio.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['portfolio_post_title_content'] ) && 'custom' === $ascend['portfolio_post_title_content'] ) {
		if ( isset( $ascend['portfolio_header_title_text'] ) ) {
			$page_title_title = $ascend['portfolio_header_title_text'];
		} else {
			$page_title_title = '';
		}
		if ( ! empty( $ascend['portfolio_header_subtitle_text'] ) ) {
			$bsub = $ascend['portfolio_header_subtitle_text'];
		}
	} elseif ( isset( $ascend['portfolio_post_title_content'] ) && 'portfolio-type' === $ascend['portfolio_post_title_content'] ) {
		$main_term = ascend_get_primary_term( $post->ID, 'portfolio-type' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = '';
		}
	} else {
		$page_title_title = get_the_title();
	}
	if ( ascend_display_portfolio_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'post' ) ) {
	// Blog Post.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'custom' === $ascend['blog_post_title_content'] ) {
		if ( isset( $ascend['blog_header_title_text'] ) ) {
			$page_title_title = $ascend['blog_header_title_text'];
		} else {
			$page_title_title = '';
		}
		if ( ! empty( $ascend['blog_header_subtitle_text'] ) ) {
			$bsub = $ascend['blog_header_subtitle_text'];
		}
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} else {
		$main_term = ascend_get_primary_term( $post->ID, 'category' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = '';
		}
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'event' ) ) {
	// Events.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} else {
		$main_term = ascend_get_primary_term( $post->ID, 'event-category' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = __( 'Event', 'ascend' );
		}
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'tribe_events' ) ) {
	// Tribe.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'category' === $ascend['blog_post_title_content'] ) {
		$main_term = ascend_get_primary_term( $post->ID, 'tribe_events_cat' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = tribe_get_event_label_singular();
		}
	} else {
		$page_title_title = tribe_get_event_label_singular();
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'podcast' ) ) {
	// Podcast.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} else {
		$main_term = ascend_get_primary_term( $post->ID, 'series' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = '';
		}
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'course' ) ) {
	// Course.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} else {
		$main_term = ascend_get_primary_term( $post->ID, 'course_cat' );
		if ( $main_term ) {
			$page_title_title = $main_term->name;
		} else {
			$page_title_title = '';
		}
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_singular( 'lesson' ) ) {
	// lesson.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} elseif ( isset( $ascend['blog_post_title_content'] ) && 'posttitle' === $ascend['blog_post_title_content'] ) {
		$page_title_title = get_the_title();
	} else {
		$parent_course = get_post_meta( $post->ID, '_llms_parent_course', true );
		if ( $parent_course ) {
			$page_title_title = get_the_title( $parent_course );
		} else {
			$page_title_title = '';
		}
	}
	if ( ascend_display_post_breadcrumbs() ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} elseif ( is_attachment() ) {
	$page_title_title = get_the_title();
	if ( apply_filters( 'ascend_attachment_breadcrumbs', false ) ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
} else {
	// Other singe post.
	if ( ! empty( $post_header_title ) ) {
		$page_title_title = $post_header_title;
	} else {
		$page_title_title = get_the_title();
	}
	if ( apply_filters( 'ascend_custom_post_type_breadcrumbs', false, $post ) ) {
		$breadcrumb = true;
		$breadclass = 'kt_bc_active';
	} else {
		$breadcrumb = false;
		$breadclass = 'kt_bc_not_active';
	}
}

?>
	<div id="pageheader" class="titleclass post-header-area <?php echo esc_attr( $breadclass ); ?>">
	<div class="header-color-overlay"></div>
	<?php do_action( 'ascend_header_overlay' ); ?>
		<div class="container">
			<div class="page-header">
				<div class="page-header-inner">
					<?php
					do_action( 'ascend_above_post_title' );
					$title_tag = apply_filters( 'ascend_post_title_tag', 'h1' );
					echo '<' . esc_attr( $title_tag ) . ' class="post_head_title top-contain-title entry-title" data-max-size="' . esc_attr( $title_data ) . '" data-min-size="' . esc_attr( $title_small_data ) . '">' . wp_kses_post( $page_title_title ) . ' </' . esc_attr( $title_tag ) . '>';

					if ( ! empty( $bsub ) ) {
						echo '<p class="subtitle" data-max-size="' . esc_attr( $subtitle_data ) . '" data-min-size="' . esc_attr( $subtitle_small_data ) . '"> ' . do_shortcode( $bsub ) . ' </p>';
					}
					do_action( 'ascend_below_post_title' );
					?>
				</div>
			</div>
		</div><!--container-->
		<?php
		if ( $breadcrumb ) {
			ascend_breadcrumbs(); }
		?>
	</div><!--titleclass-->
