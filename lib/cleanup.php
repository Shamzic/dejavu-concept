<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Wrap embedded media for video fit
 */
add_filter('embed_oembed_html', 'ascend_maybe_video_wrap_embed', 10, 2);

function ascend_video_wrap_embed( $html ) {
	return $html && is_string( $html ) ? sprintf( '<div class="entry-content-asset videofit">%s</div>', $html ) : $html;
}
/**
 * Checks embed URL patterns to see if they should be wrapped in some special HTML, particularly
 * for responsive videos.
 *
 * @author     Automattic
 * @link       http://jetpack.me
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since  1.0.0
 * @access public
 * @param  string  $html
 * @param  string  $url
 * @return string
 */
function ascend_maybe_video_wrap_embed( $html, $url ) {
	if ( ! $html || ! is_string( $html ) || ! $url )
		return $html;
	$do_wrap = false;
	$patterns = array(
		'#http://((m|www)\.)?youtube\.com/watch.*#i',
		'#https://((m|www)\.)?youtube\.com/watch.*#i',
		'#http://((m|www)\.)?youtube\.com/playlist.*#i',
		'#https://((m|www)\.)?youtube\.com/playlist.*#i',
		'#http://youtu\.be/.*#i',
		'#https://youtu\.be/.*#i',
		'#https?://(.+\.)?vimeo\.com/.*#i',
		'#https?://(www\.)?dailymotion\.com/.*#i',
		'#https?://dai.ly/*#i',
		'#https?://(www\.)?hulu\.com/watch/.*#i',
		'#https?://wordpress.tv/.*#i',
		'#https?://(www\.)?funnyordie\.com/videos/.*#i',
		'#https?://vine.co/v/.*#i',
		'#https?://(www\.)?collegehumor\.com/video/.*#i',
		'#https?://(www\.|embed\.)?ted\.com/talks/.*#i'
	);
	$patterns = apply_filters( 'ascend_maybe_wrap_embed_patterns', $patterns );
	foreach ( $patterns as $pattern ) {
		$do_wrap = preg_match( $pattern, $url );
		if ( $do_wrap )
			return ascend_video_wrap_embed( $html );
	}
	return $html;
}

/**
 * Set Excert Length
 */
function ascend_excerpt_length($length) {
 	$ascend = ascend_get_options();

  	return isset( $ascend['post_word_count'] ) ? absint( $ascend['post_word_count'] ) : 40;
}
add_filter('excerpt_length', 'ascend_excerpt_length', 999);

function ascend_excerpt_more($more) {
  	$ascend = ascend_get_options();

  	$readmore = (! empty( $ascend['post_readmore_text'] ) ) ? $ascend['post_readmore_text'] : __('Read More', 'ascend');

  	return ' &hellip; <a class="kt-excerpt-readmore more-link" href="' . esc_url( get_permalink() ) . '">'. esc_html($readmore) . '</a>';
}
add_filter('excerpt_more', 'ascend_excerpt_more');

function ascend_custom_excerpt_more( $excerpt ) {
  	$excerpt_more = '';
  	if( has_excerpt() ) {
      	$ascend = ascend_get_options();
    	$readmore = (! empty( $ascend['post_readmore_text'] ) ) ? $ascend['post_readmore_text'] : __('Read More', 'ascend');

    	$excerpt_more = '&hellip; <a class="kt-excerpt-readmore more-link" href="' . esc_url( get_permalink() ). '">'. esc_html($readmore) . '</a>';
  	}
  	return $excerpt . $excerpt_more;
}
add_filter( 'get_the_excerpt', 'ascend_custom_excerpt_more' );

/**
 * Add additional classes for widgets
 *
 */
function ascend_widget_first_last_classes($params) {
  	global $my_widget_num;

  	$this_id = $params[0]['id'];
  	$arr_registered_widgets = wp_get_sidebars_widgets();

  	if (!$my_widget_num) {
    	$my_widget_num = array();
  	}

  	if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
   		return $params;
  	}

  	if (isset($my_widget_num[$this_id])) {
    	$my_widget_num[$this_id] ++;
  	} else {
    	$my_widget_num[$this_id] = 1;
  	}

  	$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

  	if ($my_widget_num[$this_id] == 1) {
    	$class .= 'widget-first ';
  	} elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
    	$class .= 'widget-last ';
  	}

  	$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);

  	return $params;
}
add_filter('dynamic_sidebar_params', 'ascend_widget_first_last_classes');


