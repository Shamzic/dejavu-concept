<?php
/**
 * Schema Functions
 *
 * @package Ascend Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get any necessary microdata.
 *
 * @param string $context The element to target.
 * @return string Our final attribute to add to the element.
 */
function ascend_get_microdata( $context ) {
	$data = false;

	if ( ! apply_filters( 'ascend_microdata', true, $context ) ) {
		return false;
	}

	if ( 'html' === $context ) {
		$type = 'WebPage';

		if ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) {
			$type = 'Blog';
		} elseif ( is_author() ) {
			$type = 'ProfilePage';
		}

		if ( is_search() ) {
			$type = 'SearchResultsPage';
		}

		$type = apply_filters( 'ascend_html_itemtype', $type );

		$data = sprintf(
			'itemtype="https://schema.org/%s" itemscope',
			esc_html( $type )
		);
	}

	if ( 'header' === $context ) {
		$data = 'itemtype="https://schema.org/WPHeader" itemscope';
	}

	if ( 'navigation' === $context ) {
		$data = 'itemtype="https://schema.org/SiteNavigationElement" itemscope';
	}

	if ( 'article' === $context ) {
		$type = apply_filters( 'ascend_article_itemtype', 'CreativeWork' );

		$data = sprintf(
			'itemtype="https://schema.org/%s" itemscope',
			esc_html( $type )
		);
	}

	if ( 'post-author' === $context ) {
		$data = 'itemprop="author" itemtype="https://schema.org/Person" itemscope';
	}

	if ( 'comment-body' === $context ) {
		$data = 'itemtype="https://schema.org/Comment" itemscope';
	}

	if ( 'comment-author' === $context ) {
		$data = 'itemprop="author" itemtype="https://schema.org/Person" itemscope';
	}

	if ( 'sidebar' === $context ) {
		$data = 'itemtype="https://schema.org/WPSideBar" itemscope';
	}

	if ( 'footer' === $context ) {
		$data = 'itemtype="https://schema.org/WPFooter" itemscope';
	}
	if ( 'video' === $context ) {
			$data = 'itemprop="video" itemtype="http://schema.org/VideoObject" itemscope';
	}

	if ( $data ) {
		return apply_filters( "ascend_{$context}_schema", $data );
	}
}

/**
 * Output our microdata for an element.
 *
 * @param string $context The element to target.
 */
function ascend_do_microdata( $context ) {
	echo ascend_get_microdata( $context ); // phpcs:ignore
}
