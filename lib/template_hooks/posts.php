<?php
/**
 * Post Actions
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Single Post Header
 */
function ascend_single_post_header() {
	if ( ascend_display_pagetitle() ) {
		get_template_part( 'templates/post', 'header' );
	} else {
		if ( is_attachment() ) {
			if ( apply_filters( 'ascend_attachment_breadcrumbs', false ) ) {
				echo '<div class="kt_bc_nomargin">';
				ascend_breadcrumbs();
				echo '</div>';
			}
		} elseif ( get_post_type() != 'post' ) {
			if ( apply_filters( 'ascend_custom_post_type_breadcrumbs', false, $post ) ) {
				echo '<div class="kt_bc_nomargin">';
				ascend_breadcrumbs();
				echo '</div>';
			}
		} else {
			if ( ascend_display_post_breadcrumbs() ) {
				echo '<div class="kt_bc_nomargin">';
				ascend_breadcrumbs();
				echo '</div>';
			}
		}
	}
}
add_action( 'ascend_post_header', 'ascend_single_post_header', 20 );

/**
 * Post Image Height
 */
function ascend_post_header_single_image_height() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['post_header_single_image_height'] ) && '1' === $ascend['post_header_single_image_height'] ) {
		return null;
	} else {
		return 400;
	}
}
add_filter( 'ascend_single_post_image_height', 'ascend_post_header_single_image_height', 10 );
/**
 * Get Head Content
 */
function ascend_get_post_head_content() {
	global $post;
	if ( 'post' == get_post_type() ) {
		$ascend = ascend_get_options();
		if ( has_post_format( 'video' ) ) {
			$headcontent = get_post_meta( $post->ID, '_kad_video_blog_head', true );
			if ( empty( $headcontent ) || $headcontent == 'default' ) {
				if ( ! empty( $ascend['video_post_blog_default'] ) ) {
					$headcontent = $ascend['video_post_blog_default'];
				} else {
					$headcontent = 'video';
				}
			}
		} else if ( has_post_format( 'gallery' ) ) {
			$headcontent = get_post_meta( $post->ID, '_kad_gallery_blog_head', true );
			if ( empty( $headcontent ) || $headcontent == 'default' ) {
				if ( ! empty( $ascend['gallery_post_blog_default'] ) ) {
					$headcontent = $ascend['gallery_post_blog_default'];
				} else {
					$headcontent = 'carouselslider';
				}
			}
		} elseif ( has_post_format( 'image' ) ) {
			$headcontent = get_post_meta( $post->ID, '_kad_image_blog_head', true );
			if ( empty( $headcontent ) || $headcontent == 'default' ) {
				if ( ! empty( $ascend['image_post_blog_default'] ) ) {
					$headcontent = $ascend['image_post_blog_default'];
				} else {
					$headcontent = 'image';
				}
			}
		} else {
			$headcontent = 'none';
		}
	} else {
		$headcontent = 'none';
	}
	return $headcontent;
}
/**
 * Carousel for Single Posts
 */
function ascend_single_post_upper_headcontent() {
	if ( 'post' === get_post_type() ) {
		get_template_part( 'templates/post', 'head-upper-content' );
	}
}
add_action( 'ascend_single_post_begin', 'ascend_single_post_upper_headcontent', 10 );


/**
 * Above Title for Single Posts
 */
function ascend_single_post_headcontent() {
	if ( 'post' === get_post_type() ) {
		get_template_part( 'templates/post', 'head-content' );
	}
}
add_action( 'ascend_single_post_before_header', 'ascend_single_post_headcontent', 10 );
/**
 * Meta Date Author.
 */
function ascend_single_post_meta_date_author() {
	if ( 'post' === get_post_type() ) {
		get_template_part( 'templates/entry', 'meta-date-author' );
	}
}
add_action( 'ascend_single_attachment_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_post_excerpt_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_single_loop_post_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_single_post_header', 'ascend_single_post_meta_date_author', 30 );

/**
 * Single post title
 */
function ascend_post_header_title() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['blog_post_title_inpost'] ) && '0' === $ascend['blog_post_title_inpost'] ) {
		// do nothing.
	} else {
		$tag = apply_filters( 'ascend_post_inner_title_tag', 'h1' );
		echo '<' . esc_attr( $tag ) . ' class="entry-title">';
			the_title();
		echo '</' . esc_attr( $tag ) . '>';
	}
}
add_action( 'ascend_single_attachment_header', 'ascend_post_header_title', 20 );
add_action( 'ascend_single_post_header', 'ascend_post_header_title', 20 );

/**
 * Single Image (ATTACHMENT PAGE)
 */
function ascend_single_attachment_image() {
	echo wp_get_attachment_image( get_the_ID(), 'full' );
}
add_action( 'ascend_single_attachment_before_header', 'ascend_single_attachment_image', 20 );
/**
 * Post Head categories.
 */
function ascend_post_header_meta_categories() {
	echo '<div class="kt_post_category kt-post-cats">';
		the_category( ' | ' );
	echo '</div>';
}
add_action( 'ascend_post_photo_grid_excerpt_after_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'ascend_post_grid_excerpt_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'ascend_post_excerpt_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'ascend_single_loop_post_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'ascend_single_post_before_header', 'ascend_post_header_meta_categories', 20 );

/**
 * Post Navigation
 */
function ascend_post_footer_pagination() {
	wp_link_pages(
		array(
			'before'      => '<nav class="pagination kt-pagination">',
			'after'       => '</nav>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		)
	);
}
add_action( 'ascend_single_attachment_footer', 'ascend_post_footer_pagination', 10 );
add_action( 'ascend_single_post_footer', 'ascend_post_footer_pagination', 10 );
/**
 * Post Tags
 */
function ascend_post_footer_tags() {
	$tags = get_the_tags();
	if ( $tags ) {
		echo '<div class="posttags post-footer-section">';
		the_tags( __( 'Tags:', 'ascend' ), ' ', '' );
		echo '</div>';
	}
}
add_action( 'ascend_single_post_footer', 'ascend_post_footer_tags', 20 );

/**
 * Post Navigation
 */
function ascend_post_nav() {
	$ascend = ascend_get_options();
	if ( ! isset( $ascend['show_postlinks'] ) || '0' !== $ascend['show_postlinks'] ) {
		get_template_part( 'templates/entry', 'post-links' );
	}
}
add_action( 'ascend_single_post_footer', 'ascend_post_nav', 40 );

/**
 * Post Author box
 */
function ascend_post_authorbox() {
	global $post;
	$ascend = ascend_get_options();
	$authorbox = get_post_meta( $post->ID, '_kad_blog_author', true );
	if ( ( empty( $authorbox ) || 'default' === $authorbox ) && is_singular( 'post' ) ) {
		if ( isset( $ascend['post_author_default'] ) && ( 'yes' === $ascend['post_author_default'] ) ) {
			ascend_author_box();
		}
	} elseif ( 'yes' === $authorbox ) {
		ascend_author_box();
	}
}
add_action( 'ascend_single_post_after', 'ascend_post_authorbox', 20 );
/**
 * Post Bottom Carousel
 */
function ascend_post_bottom_carousel() {
	if ( is_singular( 'post' ) ) {
		global $post, $ascend_bottom_carousel;
		$ascend = ascend_get_options();
		$ascend_bottom_carousel = get_post_meta( $post->ID, '_kad_blog_carousel_similar', true );
		if ( empty( $ascend_bottom_carousel ) || 'default' === $ascend_bottom_carousel ) {
			if ( isset( $ascend['post_carousel_default'] ) ) {
				$ascend_bottom_carousel = $ascend['post_carousel_default'];
			}
		}

		if ( 'similar' === $ascend_bottom_carousel || 'recent' === $ascend_bottom_carousel ) {
			get_template_part( 'templates/bottom', 'post-carousel' );
		}
	}
}
add_action( 'ascend_single_post_after', 'ascend_post_bottom_carousel', 30 );

/**
 * Post Comments
 */
function ascend_post_comments() {
	comments_template( '/templates/comments.php' );
}
add_action( 'ascend_single_attachment_after', 'ascend_post_comments', 40 );
add_action( 'ascend_single_post_after', 'ascend_post_comments', 40 );


/**
 * Post Grid Title
 */
function ascend_post_grid_excerpt_header_title() {
	$tag = apply_filters( 'ascend_post_grid_title_tag', 'h5' );
	echo '<a href="' . esc_url( get_permalink() ) . '">';
		echo '<' . esc_attr( $tag ) . ' class="entry-title">';
			the_title();
		echo '</' . esc_attr( $tag ) . '>';
	echo '</a>';
}
add_action( 'ascend_post_photo_grid_excerpt_header', 'ascend_post_grid_excerpt_header_title', 10 );
add_action( 'ascend_post_grid_excerpt_header', 'ascend_post_grid_excerpt_header_title', 10 );

/**
 * Footer Meta
 */
function ascend_post_grid_footer_meta() {
	get_template_part( 'templates/entry', 'meta-grid-footer' );
}
add_action( 'ascend_post_grid_excerpt_footer', 'ascend_post_grid_footer_meta', 20 );
