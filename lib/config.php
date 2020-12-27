<?php
/**
 * Config
 *
 * @package Ascend Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get Ascend Options.
 */
function ascend_get_options() {
	$options = get_option( 'ascend' );
	if ( isset( $_REQUEST['wp_customize'] ) ) {
		$options = apply_filters( 'ascend_theme_options_filter', $options );
	}
	return $options;
}
/**
 * Configuration values
 */
function ascend_max_width() {
	$ascend = ascend_get_options();
	if ( isset( $ascend['site_max_width'] ) && '940' == $ascend['site_max_width'] ) {
		$maxwidth = '940';
	} else if ( isset( $ascend['site_max_width'] ) && '1440' == $ascend['site_max_width'] ) {
		$maxwidth = '1470';
	} else if ( isset( $ascend['site_max_width'] ) && '1740' == $ascend['site_max_width'] ) {
		$maxwidth = '1770';
	} else if ( isset( $ascend['site_max_width'] ) && 'none' == $ascend['site_max_width'] ) {
		$maxwidth = 'none';
	} else {
		$maxwidth = '1170';
	}

	return apply_filters( 'ascend_max_width', $maxwidth );
}

// body classes
function ascend_body_classes( $classes ) {
	$ascend = ascend_get_options();
	if ( isset( $ascend['site_layout'] ) ) {
		$site_layout = 'kad-header-position-' . $ascend['site_layout'];
	} else {
		$site_layout = 'kad-header-position-above';
	}
	$classes[] = $site_layout;
	if ( isset( $ascend['kadence_themes_lightbox'] ) && 0 == $ascend['kadence_themes_lightbox'] ) {
		$classes[] = 'kt-turnoff-lightbox';
	}
	if ( isset( $ascend['show_subindicator'] ) && 0 == $ascend['show_subindicator'] ) {
		// Do nothing
	} else {
		$classes[] = 'kt-showsub-indicator';
	}
	if ( isset( $ascend['show_vert_subindicator'] ) && 1 == $ascend['show_vert_subindicator'] ) {
		$classes[] = 'kt-show-vertsub-indicator';
	} else {
		// Do nothing
	}
	if ( isset( $ascend['blog_post_title_inpost'] ) && 0 == $ascend['blog_post_title_inpost'] && is_single() ) {
		$classes[] = 'kt-single-post-no-inner-title';
	}
	$width = ascend_max_width();
	if ( $width == 'none' ) {
		$widthclass = 'kt-width-large kt-width-xlarge kt-width-full';
	} else if ( $width == '940' ) {
		$widthclass = 'kt-width-small';
	} else if ( $width == '1470' ) {
		$widthclass = 'kt-width-large';
	} else if ( $width == '1770' ) {
		$widthclass = 'kt-width-large kt-width-xlarge';
	} else {
		$widthclass = '';
	}
	$classes[] = $widthclass;
	if ( isset( $ascend['site_layout_style'] ) ) {
		$classes[] = 'body-style-' . esc_attr( $ascend['site_layout_style'] );
	} else {
		$classes[] = 'body-style-normal';
	}
	if ( ascend_trans_header() ) {
		$classes[] = 'trans-header';
	} else {
		$classes[] = 'none-trans-header';
	}

	return $classes;
}
add_filter( 'body_class', 'ascend_body_classes' );

function ascend_container_class() {
	global $post;
	$page_content_width = get_post_meta( $post->ID, '_kad_page_content_width', true );
	if ( isset( $page_content_width ) && $page_content_width == 'full' ) {
		$content_class = 'container-fullwidth';
	} else if ( isset( $page_content_width ) && $page_content_width == 'contained' ) {
		$content_class = 'container-contained';
	} else {
		$ascend = ascend_get_options();
		if ( isset( $ascend['default_page_content_width'] ) && $ascend['default_page_content_width'] == 'full' ) {
			$content_class = 'container-fullwidth';
		} else {
			$content_class = 'container-contained';
		}
	}
	return apply_filters( 'ascend_page_content_class', $content_class );
}


function ascend_carousel_columns( $columns, $sidebar = false ) {
	if ( empty( $columns ) ) {
		$columns = 4;
	}
	$cc = array();
	$maxwidth = ascend_max_width();
	if ( 6 == $columns ) {
		$cc['md'] = 6;
		$cc['sm'] = 5;
		$cc['xs'] = 4;
		$cc['ss'] = 3;
	} else if ( 5 == $columns ) {
		$cc['md'] = 5;
		$cc['sm'] = 4;
		$cc['xs'] = 3;
		$cc['ss'] = 2;
	} else if ( 4 == $columns ) {
		$cc['md'] = 4;
		$cc['sm'] = 3;
		$cc['xs'] = 2;
		$cc['ss'] = 2;
	} else if ( 3 == $columns ) {
		$cc['md'] = 3;
		$cc['sm'] = 2;
		$cc['xs'] = 2;
		$cc['ss'] = 1;
	} else if ( 2 == $columns ) {
		$cc['md'] = 2;
		$cc['sm'] = 2;
		$cc['xs'] = 1;
		$cc['ss'] = 1;
	} else {
		$cc['md'] = 1;
		$cc['sm'] = 1;
		$cc['xs'] = 1;
		$cc['ss'] = 1;
	}
	if ( $sidebar ) {
		if ( 'none' == $maxwidth || '1770' == $maxwidth ) {
			if ( 1 == $cc['md'] ) {
				$cc['xxl'] = 1;
				$cc['xl'] = 1;
			} else {
				$cc['xxl'] = ( $cc['md'] + 1 );
				$cc['xl'] = ( $cc['md'] );
			}
		} else if ( '1470' == $maxwidth ) {
			if ( $cc['md'] == 1 ) {
				$cc['xxl'] = 1;
				$cc['xl'] = 1;
			} else {
				$cc['xxl'] = ( $cc['md'] );
				$cc['xl'] = ( $cc['md'] );
			}
		} else {
			$cc['xxl'] = $cc['md'];
			$cc['xl'] = $cc['md'];
		}
	} else {
		if ( 'none' == $maxwidth || '1770' == $maxwidth ) {
			if ( $cc['md'] == 1 ) {
				$cc['xxl'] = 1;
				$cc['xl'] = 1;
			} else {
				$cc['xxl'] = ( $cc['md'] + 2 );
				$cc['xl'] = ( $cc['md'] + 1 );
			}
		} else if ( '1470' == $maxwidth ) {
			if ( $cc['md'] == 1 ) {
				$cc['xxl'] = 1;
				$cc['xl'] = 1;
			} else {
				$cc['xxl'] = ( $cc['md'] + 1 );
				$cc['xl'] = ( $cc['md'] + 1 );
			}
		} else {
			$cc['xxl'] = $cc['md'];
			$cc['xl'] = $cc['md'];
		}
	}

	return apply_filters( 'ascend_carousel_columns', $cc, $columns, $sidebar );
}
function ascend_carousel_columns_sidebar( $columns ) {
	if ( empty( $columns ) ) {
		$columns = 4;
	}
	$cc = array();
	$maxwidth = ascend_max_width();
	if ( 6 == $columns ) {
		$cc['md'] = 6;
		$cc['sm'] = 5;
		$cc['xs'] = 4;
		$cc['ss'] = 3;
	} else if ( 5 == $columns ) {
		$cc['md'] = 5;
		$cc['sm'] = 4;
		$cc['xs'] = 3;
		$cc['ss'] = 2;
	} else if ( 4 == $columns ) {
		$cc['md'] = 4;
		$cc['sm'] = 3;
		$cc['xs'] = 2;
		$cc['ss'] = 2;
	} else if ( 3 == $columns ) {
		$cc['md'] = 3;
		$cc['sm'] = 3;
		$cc['xs'] = 2;
		$cc['ss'] = 1;
	} else if ( 2 == $columns ) {
		$cc['md'] = 2;
		$cc['sm'] = 2;
		$cc['xs'] = 1;
		$cc['ss'] = 1;
	} else {
		$cc['md'] = 1;
		$cc['sm'] = 1;
		$cc['xs'] = 1;
		$cc['ss'] = 1;
	}
	if ( 'none' == $maxwidth || '1770' == $maxwidth ) {
		if ( $cc['md'] == 1 ) {
			$cc['xxl'] = 1;
			$cc['xl'] = 1;
		} else {
			$cc['xxl'] = ( $cc['md'] + 1 );
			$cc['xl'] = ( $cc['md'] );
		}
	} else if ( '1470' == $maxwidth ) {
		if ( $cc['md'] == 1 ) {
			$cc['xxl'] = 1;
			$cc['xl'] = 1;
		} else {
			$cc['xxl'] = ( $cc['md'] );
			$cc['xl'] = ( $cc['md'] );
		}
	} else {
		$cc['xxl'] = $cc['md'];
		$cc['xl'] = $cc['md'];
	}

	return apply_filters( 'ascend_carousel_columns', $cc, $columns );
}
function ascend_post_sidebar_image_width() {
	$maxwidth = ascend_max_width();
	if ( 'none' == $maxwidth ) {
		$width = 1600;
	} else if ( '940' == $maxwidth ) {
		$width = 640;
	} else if ( '1470' == $maxwidth ) {
		$width = 1040;
	} else if ( '1770' == $maxwidth ) {
		$width = 1360;
	} else {
		$width = 812;
	}

	return $width;
}
function ascend_post_image_width() {
	$maxwidth = ascend_max_width();
	if ( 'none' == $maxwidth ) {
		$width = 1600;
	} else if ( '940' == $maxwidth ) {
		$width = 940;
	} else if ( '1470' == $maxwidth ) {
		$width = 1440;
	} else if ( '1770' == $maxwidth ) {
		$width = 1740;
	} else {
		$width = 1140;
	}

	return $width;
}

function ascend_icon_list() {
	$icons = array( 'kt-icon-asterisk', 'kt-icon-plus', 'kt-icon-question', 'kt-icon-minus', 'kt-icon-glass', 'kt-icon-music', 'kt-icon-search', 'kt-icon-envelope-o', 'kt-icon-heart', 'kt-icon-star', 'kt-icon-star-o', 'kt-icon-user', 'kt-icon-film', 'kt-icon-th-large', 'kt-icon-th', 'kt-icon-th-list', 'kt-icon-check', 'kt-icon-close', 'kt-icon-remove', 'kt-icon-times', 'kt-icon-search-plus', 'kt-icon-search-minus', 'kt-icon-power-off', 'kt-icon-signal', 'kt-icon-cog', 'kt-icon-gear', 'kt-icon-trash-o', 'kt-icon-home', 'kt-icon-file-o', 'kt-icon-clock-o', 'kt-icon-road', 'kt-icon-download', 'kt-icon-arrow-circle-o-down', 'kt-icon-arrow-circle-o-up', 'kt-icon-inbox', 'kt-icon-play-circle-o', 'kt-icon-repeat', 'kt-icon-rotate-right', 'kt-icon-refresh', 'kt-icon-list-alt', 'kt-icon-lock', 'kt-icon-flag', 'kt-icon-headphones', 'kt-icon-volume-off', 'kt-icon-volume-down', 'kt-icon-volume-up', 'kt-icon-qrcode', 'kt-icon-barcode', 'kt-icon-tag', 'kt-icon-tags', 'kt-icon-book', 'kt-icon-bookmark', 'kt-icon-print', 'kt-icon-camera', 'kt-icon-font', 'kt-icon-bold', 'kt-icon-italic', 'kt-icon-text-height', 'kt-icon-text-width', 'kt-icon-align-left', 'kt-icon-align-center', 'kt-icon-align-right', 'kt-icon-align-justify', 'kt-icon-list', 'kt-icon-dedent', 'kt-icon-outdent', 'kt-icon-indent', 'kt-icon-video-camera', 'kt-icon-image', 'kt-icon-photo', 'kt-icon-picture-o', 'kt-icon-pencil', 'kt-icon-map-marker', 'kt-icon-adjust', 'kt-icon-tint', 'kt-icon-edit', 'kt-icon-pencil-square-o', 'kt-icon-share-square-o', 'kt-icon-check-square-o', 'kt-icon-arrows', 'kt-icon-step-backward', 'kt-icon-fast-backward', 'kt-icon-backward', 'kt-icon-play', 'kt-icon-pause', 'kt-icon-stop', 'kt-icon-forward', 'kt-icon-fast-forward', 'kt-icon-step-forward', 'kt-icon-eject', 'kt-icon-chevron-left', 'kt-icon-chevron-right', 'kt-icon-plus-circle', 'kt-icon-minus-circle', 'kt-icon-times-circle', 'kt-icon-check-circle', 'kt-icon-question-circle', 'kt-icon-info-circle', 'kt-icon-crosshairs', 'kt-icon-times-circle-o', 'kt-icon-check-circle-o', 'kt-icon-ban', 'kt-icon-arrow-left', 'kt-icon-arrow-right', 'kt-icon-arrow-up', 'kt-icon-arrow-down', 'kt-icon-mail-forward', 'kt-icon-share', 'kt-icon-expand', 'kt-icon-compress', 'kt-icon-exclamation-circle', 'kt-icon-gift', 'kt-icon-leaf', 'kt-icon-fire', 'kt-icon-eye', 'kt-icon-eye-slash', 'kt-icon-exclamation-triangle', 'kt-icon-warning', 'kt-icon-plane', 'kt-icon-calendar', 'kt-icon-random', 'kt-icon-comment', 'kt-icon-magnet', 'kt-icon-chevron-up', 'kt-icon-chevron-down', 'kt-icon-retweet', 'kt-icon-shopping-cart', 'kt-icon-folder', 'kt-icon-folder-open', 'kt-icon-arrows-v', 'kt-icon-arrows-h', 'kt-icon-bar-chart', 'kt-icon-bar-chart-o', 'kt-icon-twitter-square', 'kt-icon-facebook-square', 'kt-icon-camera-retro', 'kt-icon-key', 'kt-icon-cogs', 'kt-icon-gears', 'kt-icon-comments', 'kt-icon-thumbs-o-up', 'kt-icon-thumbs-o-down', 'kt-icon-star-half', 'kt-icon-heart-o', 'kt-icon-sign-out', 'kt-icon-linkedin-square', 'kt-icon-thumb-tack', 'kt-icon-external-link', 'kt-icon-sign-in', 'kt-icon-trophy', 'kt-icon-github-square', 'kt-icon-upload', 'kt-icon-lemon-o', 'kt-icon-phone', 'kt-icon-square-o', 'kt-icon-bookmark-o', 'kt-icon-phone-square', 'kt-icon-twitter', 'kt-icon-facebook', 'kt-icon-facebook-f', 'kt-icon-github', 'kt-icon-unlock', 'kt-icon-credit-card', 'kt-icon-feed', 'kt-icon-rss', 'kt-icon-hdd-o', 'kt-icon-bullhorn', 'kt-icon-bell-o', 'kt-icon-certificate', 'kt-icon-hand-o-right', 'kt-icon-hand-o-left', 'kt-icon-hand-o-up', 'kt-icon-hand-o-down', 'kt-icon-arrow-circle-left', 'kt-icon-arrow-circle-right', 'kt-icon-arrow-circle-up', 'kt-icon-arrow-circle-down', 'kt-icon-globe', 'kt-icon-wrench', 'kt-icon-tasks', 'kt-icon-filter', 'kt-icon-briefcase', 'kt-icon-arrows-alt', 'kt-icon-group', 'kt-icon-users', 'kt-icon-chain', 'kt-icon-link', 'kt-icon-cloud', 'kt-icon-flask', 'kt-icon-cut', 'kt-icon-scissors', 'kt-icon-copy', 'kt-icon-files-o', 'kt-icon-paperclip', 'kt-icon-floppy-o', 'kt-icon-save', 'kt-icon-square', 'kt-icon-bars', 'kt-icon-navicon', 'kt-icon-reorder', 'kt-icon-list-ul', 'kt-icon-list-ol', 'kt-icon-strikethrough', 'kt-icon-underline', 'kt-icon-table', 'kt-icon-magic', 'kt-icon-truck', 'kt-icon-pinterest', 'kt-icon-pinterest-square', 'kt-icon-google-plus-square', 'kt-icon-google-plus', 'kt-icon-money', 'kt-icon-caret-down', 'kt-icon-caret-up', 'kt-icon-caret-left', 'kt-icon-caret-right', 'kt-icon-columns', 'kt-icon-sort', 'kt-icon-unsorted', 'kt-icon-sort-desc', 'kt-icon-sort-down', 'kt-icon-sort-asc', 'kt-icon-sort-up', 'kt-icon-envelope', 'kt-icon-linkedin', 'kt-icon-rotate-left', 'kt-icon-undo', 'kt-icon-gavel', 'kt-icon-legal', 'kt-icon-dashboard', 'kt-icon-tachometer', 'kt-icon-comment-o', 'kt-icon-comments-o', 'kt-icon-bolt', 'kt-icon-flash', 'kt-icon-sitemap', 'kt-icon-umbrella', 'kt-icon-clipboard', 'kt-icon-paste', 'kt-icon-lightbulb-o', 'kt-icon-exchange', 'kt-icon-cloud-download', 'kt-icon-cloud-upload', 'kt-icon-user-md', 'kt-icon-stethoscope', 'kt-icon-suitcase', 'kt-icon-bell', 'kt-icon-coffee', 'kt-icon-cutlery', 'kt-icon-file-text-o', 'kt-icon-building-o', 'kt-icon-hospital-o', 'kt-icon-ambulance', 'kt-icon-medkit', 'kt-icon-fighter-jet', 'kt-icon-beer', 'kt-icon-h-square', 'kt-icon-plus-square', 'kt-icon-angle-double-left', 'kt-icon-angle-double-right', 'kt-icon-angle-double-up', 'kt-icon-angle-double-down', 'kt-icon-angle-left', 'kt-icon-angle-right', 'kt-icon-angle-up', 'kt-icon-angle-down', 'kt-icon-desktop', 'kt-icon-laptop', 'kt-icon-tablet', 'kt-icon-mobile', 'kt-icon-mobile-phone', 'kt-icon-circle-o', 'kt-icon-quote-left', 'kt-icon-quote-right', 'kt-icon-spinner', 'kt-icon-circle', 'kt-icon-mail-reply', 'kt-icon-reply', 'kt-icon-github-alt', 'kt-icon-folder-o', 'kt-icon-folder-open-o', 'kt-icon-smile-o', 'kt-icon-frown-o', 'kt-icon-meh-o', 'kt-icon-gamepad', 'kt-icon-keyboard-o', 'kt-icon-flag-o', 'kt-icon-flag-checkered', 'kt-icon-terminal', 'kt-icon-code', 'kt-icon-mail-reply-all', 'kt-icon-reply-all', 'kt-icon-star-half-empty', 'kt-icon-star-half-full', 'kt-icon-star-half-o', 'kt-icon-location-arrow', 'kt-icon-crop', 'kt-icon-code-fork', 'kt-icon-chain-broken', 'kt-icon-unlink', 'kt-icon-info', 'kt-icon-exclamation', 'kt-icon-superscript', 'kt-icon-subscript', 'kt-icon-eraser', 'kt-icon-puzzle-piece', 'kt-icon-microphone', 'kt-icon-microphone-slash', 'kt-icon-shield', 'kt-icon-calendar-o', 'kt-icon-fire-extinguisher', 'kt-icon-rocket', 'kt-icon-maxcdn', 'kt-icon-chevron-circle-left', 'kt-icon-chevron-circle-right', 'kt-icon-chevron-circle-up', 'kt-icon-chevron-circle-down', 'kt-icon-html5', 'kt-icon-css3', 'kt-icon-anchor', 'kt-icon-unlock-alt', 'kt-icon-bullseye', 'kt-icon-ellipsis-h', 'kt-icon-ellipsis-v', 'kt-icon-rss-square', 'kt-icon-play-circle', 'kt-icon-ticket', 'kt-icon-minus-square', 'kt-icon-minus-square-o', 'kt-icon-level-up', 'kt-icon-level-down', 'kt-icon-check-square', 'kt-icon-pencil-square', 'kt-icon-external-link-square', 'kt-icon-share-square', 'kt-icon-compass', 'kt-icon-caret-square-o-down', 'kt-icon-toggle-down', 'kt-icon-caret-square-o-up', 'kt-icon-toggle-up', 'kt-icon-caret-square-o-right', 'kt-icon-toggle-right', 'kt-icon-eur', 'kt-icon-euro', 'kt-icon-gbp', 'kt-icon-dollar', 'kt-icon-usd', 'kt-icon-inr', 'kt-icon-rupee', 'kt-icon-cny', 'kt-icon-jpy', 'kt-icon-rmb', 'kt-icon-yen', 'kt-icon-rouble', 'kt-icon-rub', 'kt-icon-ruble', 'kt-icon-krw', 'kt-icon-won', 'kt-icon-bitcoin', 'kt-icon-btc', 'kt-icon-file', 'kt-icon-file-text', 'kt-icon-sort-alpha-asc', 'kt-icon-sort-alpha-desc', 'kt-icon-sort-amount-asc', 'kt-icon-sort-amount-desc', 'kt-icon-sort-numeric-asc', 'kt-icon-sort-numeric-desc', 'kt-icon-thumbs-up', 'kt-icon-thumbs-down', 'kt-icon-youtube-square', 'kt-icon-youtube', 'kt-icon-xing', 'kt-icon-xing-square', 'kt-icon-youtube-play', 'kt-icon-dropbox', 'kt-icon-stack-overflow', 'kt-icon-instagram', 'kt-icon-flickr', 'kt-icon-adn', 'kt-icon-bitbucket', 'kt-icon-bitbucket-square', 'kt-icon-tumblr', 'kt-icon-tumblr-square', 'kt-icon-long-arrow-down', 'kt-icon-long-arrow-up', 'kt-icon-long-arrow-left', 'kt-icon-long-arrow-right', 'kt-icon-apple', 'kt-icon-windows', 'kt-icon-android', 'kt-icon-linux', 'kt-icon-dribbble', 'kt-icon-skype', 'kt-icon-foursquare', 'kt-icon-trello', 'kt-icon-female', 'kt-icon-male', 'kt-icon-gittip', 'kt-icon-gratipay', 'kt-icon-sun-o', 'kt-icon-moon-o', 'kt-icon-archive', 'kt-icon-bug', 'kt-icon-vk', 'kt-icon-weibo', 'kt-icon-renren', 'kt-icon-pagelines', 'kt-icon-stack-exchange', 'kt-icon-arrow-circle-o-right', 'kt-icon-arrow-circle-o-left', 'kt-icon-caret-square-o-left', 'kt-icon-toggle-left', 'kt-icon-dot-circle-o', 'kt-icon-wheelchair', 'kt-icon-vimeo-square', 'kt-icon-try', 'kt-icon-turkish-lira', 'kt-icon-plus-square-o', 'kt-icon-space-shuttle', 'kt-icon-slack', 'kt-icon-envelope-square', 'kt-icon-wordpress', 'kt-icon-openid', 'kt-icon-bank', 'kt-icon-institution', 'kt-icon-university', 'kt-icon-graduation-cap', 'kt-icon-mortar-board', 'kt-icon-yahoo', 'kt-icon-google', 'kt-icon-reddit', 'kt-icon-reddit-square', 'kt-icon-stumbleupon-circle', 'kt-icon-stumbleupon', 'kt-icon-delicious', 'kt-icon-digg', 'kt-icon-pied-piper-pp', 'kt-icon-pied-piper-alt', 'kt-icon-drupal', 'kt-icon-joomla', 'kt-icon-language', 'kt-icon-fax', 'kt-icon-building', 'kt-icon-child', 'kt-icon-paw', 'kt-icon-spoon', 'kt-icon-cube', 'kt-icon-cubes', 'kt-icon-behance', 'kt-icon-behance-square', 'kt-icon-steam', 'kt-icon-steam-square', 'kt-icon-recycle', 'kt-icon-automobile', 'kt-icon-car', 'kt-icon-cab', 'kt-icon-taxi', 'kt-icon-tree', 'kt-icon-spotify', 'kt-icon-deviantart', 'kt-icon-soundcloud', 'kt-icon-database', 'kt-icon-file-pdf-o', 'kt-icon-file-word-o', 'kt-icon-file-excel-o', 'kt-icon-file-powerpoint-o', 'kt-icon-file-image-o', 'kt-icon-file-photo-o', 'kt-icon-file-picture-o', 'kt-icon-file-archive-o', 'kt-icon-file-zip-o', 'kt-icon-file-audio-o', 'kt-icon-file-sound-o', 'kt-icon-file-movie-o', 'kt-icon-file-video-o', 'kt-icon-file-code-o', 'kt-icon-vine', 'kt-icon-codepen', 'kt-icon-jsfiddle', 'kt-icon-life-bouy', 'kt-icon-life-buoy', 'kt-icon-life-ring', 'kt-icon-life-saver', 'kt-icon-support', 'kt-icon-circle-o-notch', 'kt-icon-ra', 'kt-icon-rebel', 'kt-icon-resistance', 'kt-icon-empire', 'kt-icon-ge', 'kt-icon-git-square', 'kt-icon-git', 'kt-icon-hacker-news', 'kt-icon-y-combinator-square', 'kt-icon-yc-square', 'kt-icon-tencent-weibo', 'kt-icon-qq', 'kt-icon-wechat', 'kt-icon-weixin', 'kt-icon-paper-plane', 'kt-icon-send', 'kt-icon-paper-plane-o', 'kt-icon-send-o', 'kt-icon-history', 'kt-icon-circle-thin', 'kt-icon-header', 'kt-icon-paragraph', 'kt-icon-sliders', 'kt-icon-share-alt', 'kt-icon-share-alt-square', 'kt-icon-bomb', 'kt-icon-futbol-o', 'kt-icon-soccer-ball-o', 'kt-icon-tty', 'kt-icon-binoculars', 'kt-icon-plug', 'kt-icon-slideshare', 'kt-icon-twitch', 'kt-icon-yelp', 'kt-icon-newspaper-o', 'kt-icon-wifi', 'kt-icon-calculator', 'kt-icon-paypal', 'kt-icon-google-wallet', 'kt-icon-cc-visa', 'kt-icon-cc-mastercard', 'kt-icon-cc-discover', 'kt-icon-cc-amex', 'kt-icon-cc-paypal', 'kt-icon-cc-stripe', 'kt-icon-bell-slash', 'kt-icon-bell-slash-o', 'kt-icon-trash', 'kt-icon-copyright', 'kt-icon-at', 'kt-icon-eyedropper', 'kt-icon-paint-brush', 'kt-icon-birthday-cake', 'kt-icon-area-chart', 'kt-icon-pie-chart', 'kt-icon-line-chart', 'kt-icon-lastfm', 'kt-icon-lastfm-square', 'kt-icon-toggle-off', 'kt-icon-toggle-on', 'kt-icon-bicycle', 'kt-icon-bus', 'kt-icon-ioxhost', 'kt-icon-angellist', 'kt-icon-cc', 'kt-icon-ils', 'kt-icon-shekel', 'kt-icon-sheqel', 'kt-icon-meanpath', 'kt-icon-buysellads', 'kt-icon-connectdevelop', 'kt-icon-dashcube', 'kt-icon-forumbee', 'kt-icon-leanpub', 'kt-icon-sellsy', 'kt-icon-shirtsinbulk', 'kt-icon-simplybuilt', 'kt-icon-skyatlas', 'kt-icon-cart-plus', 'kt-icon-cart-arrow-down', 'kt-icon-diamond', 'kt-icon-ship', 'kt-icon-user-secret', 'kt-icon-motorcycle', 'kt-icon-street-view', 'kt-icon-heartbeat', 'kt-icon-venus', 'kt-icon-mars', 'kt-icon-mercury', 'kt-icon-intersex', 'kt-icon-transgender', 'kt-icon-transgender-alt', 'kt-icon-venus-double', 'kt-icon-mars-double', 'kt-icon-venus-mars', 'kt-icon-mars-stroke', 'kt-icon-mars-stroke-v', 'kt-icon-mars-stroke-h', 'kt-icon-neuter', 'kt-icon-genderless', 'kt-icon-facebook-official', 'kt-icon-pinterest-p', 'kt-icon-whatsapp', 'kt-icon-server', 'kt-icon-user-plus', 'kt-icon-user-times', 'kt-icon-bed', 'kt-icon-hotel', 'kt-icon-viacoin', 'kt-icon-train', 'kt-icon-subway', 'kt-icon-medium', 'kt-icon-y-combinator', 'kt-icon-yc', 'kt-icon-optin-monster', 'kt-icon-opencart', 'kt-icon-expeditedssl', 'kt-icon-battery', 'kt-icon-battery-4', 'kt-icon-battery-full', 'kt-icon-battery-3', 'kt-icon-battery-three-quarters', 'kt-icon-battery-2', 'kt-icon-battery-half', 'kt-icon-battery-1', 'kt-icon-battery-quarter', 'kt-icon-battery-0', 'kt-icon-battery-empty', 'kt-icon-mouse-pointer', 'kt-icon-i-cursor', 'kt-icon-object-group', 'kt-icon-object-ungroup', 'kt-icon-sticky-note', 'kt-icon-sticky-note-o', 'kt-icon-cc-jcb', 'kt-icon-cc-diners-club', 'kt-icon-clone', 'kt-icon-balance-scale', 'kt-icon-hourglass-o', 'kt-icon-hourglass-1', 'kt-icon-hourglass-start', 'kt-icon-hourglass-2', 'kt-icon-hourglass-half', 'kt-icon-hourglass-3', 'kt-icon-hourglass-end', 'kt-icon-hourglass', 'kt-icon-hand-grab-o', 'kt-icon-hand-rock-o', 'kt-icon-hand-paper-o', 'kt-icon-hand-stop-o', 'kt-icon-hand-scissors-o', 'kt-icon-hand-lizard-o', 'kt-icon-hand-spock-o', 'kt-icon-hand-pointer-o', 'kt-icon-hand-peace-o', 'kt-icon-trademark', 'kt-icon-registered', 'kt-icon-creative-commons', 'kt-icon-gg', 'kt-icon-gg-circle', 'kt-icon-tripadvisor', 'kt-icon-odnoklassniki', 'kt-icon-odnoklassniki-square', 'kt-icon-get-pocket', 'kt-icon-wikipedia-w', 'kt-icon-safari', 'kt-icon-chrome', 'kt-icon-firefox', 'kt-icon-opera', 'kt-icon-internet-explorer', 'kt-icon-television', 'kt-icon-tv', 'kt-icon-contao', 'kt-icon-500px', 'kt-icon-amazon', 'kt-icon-calendar-plus-o', 'kt-icon-calendar-minus-o', 'kt-icon-calendar-times-o', 'kt-icon-calendar-check-o', 'kt-icon-industry', 'kt-icon-map-pin', 'kt-icon-map-signs', 'kt-icon-map-o', 'kt-icon-map', 'kt-icon-commenting', 'kt-icon-commenting-o', 'kt-icon-houzz', 'kt-icon-vimeo', 'kt-icon-black-tie', 'kt-icon-fonticons', 'kt-icon-reddit-alien', 'kt-icon-edge', 'kt-icon-credit-card-alt', 'kt-icon-codiepie', 'kt-icon-modx', 'kt-icon-fort-awesome', 'kt-icon-usb', 'kt-icon-product-hunt', 'kt-icon-mixcloud', 'kt-icon-scribd', 'kt-icon-pause-circle', 'kt-icon-pause-circle-o', 'kt-icon-stop-circle', 'kt-icon-stop-circle-o', 'kt-icon-shopping-bag', 'kt-icon-shopping-basket', 'kt-icon-hashtag', 'kt-icon-bluetooth', 'kt-icon-bluetooth-b', 'kt-icon-percent', 'kt-icon-gitlab', 'kt-icon-wpbeginner', 'kt-icon-wpforms', 'kt-icon-envira', 'kt-icon-universal-access', 'kt-icon-wheelchair-alt', 'kt-icon-question-circle-o', 'kt-icon-blind', 'kt-icon-audio-description', 'kt-icon-volume-control-phone', 'kt-icon-braille', 'kt-icon-assistive-listening-systems', 'kt-icon-american-sign-language-interpreting', 'kt-icon-asl-interpreting', 'kt-icon-deaf', 'kt-icon-deafness', 'kt-icon-hard-of-hearing', 'kt-icon-glide', 'kt-icon-glide-g', 'kt-icon-sign-language', 'kt-icon-signing', 'kt-icon-low-vision', 'kt-icon-viadeo', 'kt-icon-viadeo-square', 'kt-icon-snapchat', 'kt-icon-snapchat-ghost', 'kt-icon-snapchat-square', 'kt-icon-pied-piper', 'kt-icon-first-order', 'kt-icon-yoast', 'kt-icon-themeisle', 'kt-icon-google-plus-circle', 'kt-icon-google-plus-official', 'kt-icon-fa', 'kt-icon-font-awesome', 'kt-icon-handshake-o', 'kt-icon-envelope-open', 'kt-icon-envelope-open-o', 'kt-icon-linode', 'kt-icon-address-book', 'kt-icon-address-book-o', 'kt-icon-address-card', 'kt-icon-vcard', 'kt-icon-address-card-o', 'kt-icon-vcard-o', 'kt-icon-user-circle', 'kt-icon-user-circle-o', 'kt-icon-user-o', 'kt-icon-id-badge', 'kt-icon-drivers-license', 'kt-icon-id-card', 'kt-icon-drivers-license-o', 'kt-icon-id-card-o', 'kt-icon-quora', 'kt-icon-free-code-camp', 'kt-icon-telegram', 'kt-icon-thermometer', 'kt-icon-thermometer-4', 'kt-icon-thermometer-full', 'kt-icon-thermometer-3', 'kt-icon-thermometer-three-quarters', 'kt-icon-thermometer-2', 'kt-icon-thermometer-half', 'kt-icon-thermometer-1', 'kt-icon-thermometer-quarter', 'kt-icon-thermometer-0', 'kt-icon-thermometer-empty', 'kt-icon-shower', 'kt-icon-bath', 'kt-icon-bathtub', 'kt-icon-s15', 'kt-icon-podcast', 'kt-icon-window-maximize', 'kt-icon-window-minimize', 'kt-icon-window-restore', 'kt-icon-times-rectangle', 'kt-icon-window-close', 'kt-icon-times-rectangle-o', 'kt-icon-window-close-o', 'kt-icon-bandcamp', 'kt-icon-grav', 'kt-icon-etsy', 'kt-icon-imdb', 'kt-icon-ravelry', 'kt-icon-eercast', 'kt-icon-microchip', 'kt-icon-snowflake-o', 'kt-icon-superpowers', 'kt-icon-wpexplorer', 'kt-icon-meetup' );

	return apply_filters( 'ascend_icon_list', $icons );

}
add_filter( 'redux/ascend/field/font/icons', 'ascend_icon_list' );
add_filter( 'kt_toolkit_icon_list', 'ascend_icon_list' );

if ( ! isset( $content_width ) ) {
	$content_width = 1140; }
