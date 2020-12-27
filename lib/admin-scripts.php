<?php
/**
 * Enqueue CSS & JS
 *
 * @package Ascend Theme
 */

/**
 * Enqueue CSS & JS
 *
 * @param string $hook is the page hook.
 */
function ascend_admin_scripts( $hook ) {

	wp_register_script( 'kadence-toolkit-install', get_template_directory_uri() . '/assets/js/admin-activate.js', false, ASCEND_VERSION );

	if ( 'appearance_page_kad_options' === $hook || 'widgets.php' === $hook ) {
		wp_enqueue_script( 'select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', array( 'jquery' ), ASCEND_VERSION, false );
	}
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook && 'widgets.php' !== $hook && 'appearance_page_kad_options' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'ascend_admin_styles', get_template_directory_uri() . '/assets/css/ascend_admin.css', false, ASCEND_VERSION );

	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook && 'widgets.php' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'ascend_admin_main', get_template_directory_uri() . '/assets/js/min/ascend-admin-main-min.js', array( 'wp-color-picker', 'jquery' ), ASCEND_VERSION, false );
}

add_action( 'admin_enqueue_scripts', 'ascend_admin_scripts' );

/**
 * Enqueue block editor style
 */
function ascend_block_editor_styles() {
	wp_enqueue_style( 'ascend-guten-editor-styles', get_template_directory_uri() . '/assets/css/guten-editor-style.css', false, ASCEND_VERSION, 'all' );
}

add_action( 'enqueue_block_editor_assets', 'ascend_block_editor_styles' );

/**
 * Add inline css for fonts
 */
function ascend_editor_dynamic_css() {
	global $current_screen;
	$the_current_screen = get_current_screen();
	if ( ( method_exists( $the_current_screen, 'is_block_editor' ) && $the_current_screen->is_block_editor() ) || ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) ) {
		$ascend        = ascend_get_options();
		$options_fonts = array( 'font_h1', 'font_h2', 'font_h3', 'font_h4', 'font_h5', 'font_p' );
		$load_gfonts   = array();
		foreach ( $options_fonts as $options_key ) {
			if ( isset( $ascend[ $options_key ] ) && isset( $ascend[ $options_key ]['google'] ) && 'false' !== $ascend[ $options_key ]['google'] ) {
				// check if it's in the array.
				if ( isset( $load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ] ) ) {
					if ( isset( $ascend[ $options_key ]['font-weight'] ) && ! empty( $ascend[ $options_key ]['font-weight'] ) ) {
						if ( isset( $ascend[ $options_key ]['font-style'] ) && ! empty( $ascend[ $options_key ]['font-style'] ) && ! is_numeric( $ascend[ $options_key ]['font-style'] ) && 'normal' !== $ascend[ $options_key ]['font-style'] ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style'][ $ascend[ $options_key ]['font-weight'] . $ascend[ $options_key ]['font-style'] ] = $ascend[ $options_key ]['font-weight'] . $ascend[ $options_key ]['font-style'];
						} else {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style'][ $ascend[ $options_key ]['font-weight'] ] = $ascend[ $options_key ]['font-weight'];
						}
					}
					if ( isset( $ascend[ $options_key ]['subsets'] ) && ! empty( $ascend[ $options_key ]['subsets'] ) ) {
						$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['subsets'][ $ascend[ $options_key ]['subsets'] ] = $ascend[ $options_key ]['subsets'];
					}
				} else {
					$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ] = array(
						'font-family' => $ascend[ $options_key ]['font-family'],
						'font-style'  => array(),
						'subsets'     => array(),
					);
					if ( isset( $ascend[ $options_key ]['font-weight'] ) && ! empty( $ascend[ $options_key ]['font-weight'] ) ) {
						if ( isset( $ascend[ $options_key ]['font-style'] ) && ! empty( $ascend[ $options_key ]['font-style'] ) && ! is_numeric( $ascend[ $options_key ]['font-style'] ) && 'normal' !== $ascend[ $options_key ]['font-style'] ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style'][ $ascend[ $options_key ]['font-weight'] . $ascend[ $options_key ]['font-style'] ] = $ascend[ $options_key ]['font-weight'] . $ascend[ $options_key ]['font-style'];
						} else {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style'][ $ascend[ $options_key ]['font-weight'] ] = $ascend[ $options_key ]['font-weight'];
						}
					}
					if ( isset( $ascend[ $options_key ]['subsets'] ) && ! empty( $ascend[ $options_key ]['subsets'] ) ) {
						$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['subsets'][ $ascend[ $options_key ]['subsets'] ] = $ascend[ $options_key ]['subsets'];
					}
				}
				if ( 'font_p' === $options_key ) {
					$path      = trailingslashit( get_template_directory() ) . 'lib/gfont-json.php';
					$all_fonts = include $path;
					if ( isset( $all_fonts[ $ascend[ $options_key ]['font-family'] ] ) ) {
						$p_font = $all_fonts[ $ascend[ $options_key ]['font-family'] ];
						if ( isset( $p_font['variants']['italic']['400'] ) ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style']['400italic'] = '400italic';
						}
						if ( isset( $p_font['variants']['italic']['700'] ) ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style']['700italic'] = '700italic';
						}
						if ( isset( $p_font['variants']['normal']['400'] ) ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style']['400'] = '400';
						}
						if ( isset( $p_font['variants']['normal']['700'] ) ) {
							$load_gfonts[ sanitize_key( $ascend[ $options_key ]['font-family'] ) ]['font-style']['700'] = '700';
						}
					}
				}
			}
		}
		if ( ! empty( $load_gfonts ) ) {
			// Build the font family link.
			$link    = '';
			$subsets = array();
			foreach ( $load_gfonts as $gfont_values ) {
				if ( ! empty( $link ) ) {
					$link .= '%7C'; // Append a new font to the string.
				}
				$link .= $gfont_values['font-family'];
				if ( ! empty( $gfont_values['font-style'] ) ) {
					$link .= ':';
					$link .= implode( ',', $gfont_values['font-style'] );
				}
				if ( ! empty( $gfont_values['subsets'] ) ) {
					foreach ( $gfont_values['subsets'] as $subset ) {
						if ( ! in_array( $subset, $subsets ) ) {
							array_push( $subsets, $subset );
						}
					}
				}
			}
			if ( ! empty( $subsets ) ) {
				$link .= '&amp;subset=' . implode( ',', $subsets );
			}
			echo '<link href="//fonts.googleapis.com/css?family=' . esc_attr( str_replace( '|', '%7C', $link ) ) . ' " rel="stylesheet">';
		}
		echo '<style type="text/css" id="ascend-editor-font-family">';
		if ( isset( $ascend['font_h1'] ) ) {
			echo 'body.block-editor-page .editor-post-title__block .editor-post-title__input, body.block-editor-page .wp-block-heading h1, body.block-editor-page .editor-block-list__block h1, body.block-editor-page .editor-post-title__block .editor-post-title__input {
					font-size: ' . esc_attr( $ascend['font_h1']['font-size'] ) . ';
					line-height: ' . esc_attr( $ascend['font_h1']['line-height'] ) . ';
					font-weight: ' . ( isset( $ascend['font_h1']['font-weight'] ) ? esc_attr( $ascend['font_h1']['font-weight'] ) : '600' ) . ';
					font-family: ' . esc_attr( $ascend['font_h1']['font-family'] ) . ';
					letter-spacing: ' . esc_attr( $ascend['font_h1']['letter-spacing'] ) . ';
					color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_h1']['color'] ) && ! empty( $ascend['font_h1']['color'] ) ? $ascend['font_h1']['color'] : '' ) ) . ';
				}';
		}
		if ( isset( $ascend['font_h2'] ) ) {
			echo 'body.gutenberg-editor-page .wp-block-heading h2, body.gutenberg-editor-page .editor-block-list__block h2, body.block-editor-page .wp-block-heading h2, body.block-editor-page .editor-block-list__block h2 {
				font-size: ' . esc_attr( $ascend['font_h2']['font-size'] ) . ';
				line-height: ' . esc_attr( $ascend['font_h2']['line-height'] ) . ';
				font-weight: ' . ( isset( $ascend['font_h2']['font-weight'] ) ? esc_attr( $ascend['font_h2']['font-weight'] ) : '400' ) . ';
				font-family: ' . esc_attr( $ascend['font_h2']['font-family'] ) . ';
				letter-spacing: ' . esc_attr( $ascend['font_h2']['letter-spacing'] ) . ';
				color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_h2']['color'] ) && ! empty( $ascend['font_h2']['color'] ) ? $ascend['font_h2']['color'] : '' ) ) . ';
			}';
		}
		if ( isset( $ascend['font_h3'] ) ) {
			echo 'body.gutenberg-editor-page .wp-block-heading h3, body.gutenberg-editor-page .editor-block-list__block h3, body.block-editor-page .wp-block-heading h3, body.block-editor-page .editor-block-list__block h3 {
				font-size: ' . esc_attr( $ascend['font_h3']['font-size'] ) . ';
				line-height: ' . esc_attr( $ascend['font_h3']['line-height'] ) . ';
				font-weight: ' . ( isset( $ascend['font_h3']['font-weight'] ) ? esc_attr( $ascend['font_h3']['font-weight'] ) : '400' ) . ';
				font-family: ' . esc_attr( $ascend['font_h3']['font-family'] ) . ';
				letter-spacing: ' . esc_attr( $ascend['font_h3']['letter-spacing'] ) . ';
				color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_h3']['color'] ) && ! empty( $ascend['font_h3']['color'] ) ? $ascend['font_h3']['color'] : '' ) ) . ';
			}';
		}
		if ( isset( $ascend['font_h4'] ) ) {
			echo 'body.gutenberg-editor-page .wp-block-heading h4, body.gutenberg-editor-page .editor-block-list__block h4, body.block-editor-page .wp-block-heading h4, body.block-editor-page .editor-block-list__block h4 {
				font-size: ' . esc_attr( $ascend['font_h4']['font-size'] ) . ';
				line-height: ' . esc_attr( $ascend['font_h4']['line-height'] ) . ';
				font-weight: ' . ( isset( $ascend['font_h4']['font-weight'] ) ? esc_attr( $ascend['font_h4']['font-weight'] ) : '400' ) . ';
				font-family: ' . esc_attr( $ascend['font_h4']['font-family'] ) . ';
				letter-spacing: ' . esc_attr( $ascend['font_h4']['letter-spacing'] ) . ';
				color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_h4']['color'] ) && ! empty( $ascend['font_h4']['color'] ) ? $ascend['font_h4']['color'] : '' ) ) . ';
			} body.gutenberg-editor-page .editor-block-list__block .widgets-container .so-widget h4 {font-size:inherit; letter-spacing:normal; font-family:inherit;}';
		}
		if ( isset( $ascend['font_h5'] ) ) {
			echo 'body.gutenberg-editor-page .wp-block-heading h5, body.gutenberg-editor-page .editor-block-list__block h5, body.block-editor-page .wp-block-heading h5, body.block-editor-page .editor-block-list__block h5 {
				font-size: ' . esc_attr( $ascend['font_h5']['font-size'] ) . ';
				line-height: ' . esc_attr( $ascend['font_h5']['line-height'] ) . ';
				font-weight: ' . ( isset( $ascend['font_h5']['font-weight'] ) ? esc_attr( $ascend['font_h5']['font-weight'] ) : 'normal' ) . ';
				font-family: ' . esc_attr( $ascend['font_h5']['font-family'] ) . ';
				letter-spacing: ' . esc_attr( $ascend['font_h5']['letter-spacing'] ) . ';
				color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_h5']['color'] ) && ! empty( $ascend['font_h5']['color'] ) ? $ascend['font_h5']['color'] : '' ) ) . ';
			}';
		}
		if ( isset( $ascend['font_p'] ) ) {
			echo '.edit-post-visual-editor, .edit-post-visual-editor p, body.gutenberg-editor-page .editor-block-list__block, .edit-post-visual-editor, .edit-post-visual-editor p, .edit-post-visual-editor.editor-styles-wrapper p {
				font-size: ' . esc_attr( $ascend['font_p']['font-size'] ) . ';
				font-weight: ' . ( isset( $ascend['font_p']['font-weight'] ) ? esc_attr( $ascend['font_p']['font-weight'] ) : '400' ) . ';
				font-family: ' . esc_attr( $ascend['font_p']['font-family'] ) . ';
				letter-spacing: ' . esc_attr( $ascend['font_p']['letter-spacing'] ) . ';
				color: ' . esc_attr( ( isset( $ascend['guten_preview'] ) && 1 == $ascend['guten_preview'] && isset( $ascend['font_p']['color'] ) && ! empty( $ascend['font_p']['color'] ) ? $ascend['font_p']['color'] : '' ) ) . ';
			}';
			echo '.block-editor-page .edit-post-visual-editor {
				font-family: ' . esc_attr( $ascend['font_p']['font-family'] ) . ';
			}';
		}
		if ( 1 == $ascend['guten_preview'] && isset( $ascend['content_background'] ) ) {
			echo '.block-editor-page .edit-post-visual-editor {';
				echo ( ! empty( $ascend['content_background']['background-color'] ) ? 'background-color: ' . esc_attr( $ascend['content_background']['background-color'] ) . ';' : '' );
				echo ( ! empty( $ascend['content_background']['background-image'] ) ? 'background-image: ' . esc_attr( $ascend['content_background']['background-image'] ) . ';' : '' );
				echo ( ! empty( $ascend['content_background']['background-repeat'] ) ? 'background-repeat: ' . esc_attr( $ascend['content_background']['background-repeat'] ) . ';' : '' );
				echo ( ! empty( $ascend['content_background']['background-position'] ) ? 'background-position: ' . esc_attr( $ascend['content_background']['background-position'] ) . ';' : '' );
				echo ( ! empty( $ascend['content_background']['background-size'] ) ? 'background-size: ' . esc_attr( $ascend['content_background']['background-size'] ) . ';' : '' );
				echo ( ! empty( $ascend['content_background']['background-attachment'] ) ? 'background-attachment: ' . esc_attr( $ascend['content_background']['background-attachment'] ) . ';' : '' );
			echo '}';
		}
		echo '</style>';
	}
}
add_action( 'admin_head-post.php', 'ascend_editor_dynamic_css' );
add_action( 'admin_head-post-new.php', 'ascend_editor_dynamic_css' );
