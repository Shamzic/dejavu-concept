<?php
/**
 * Post video Template.
 *
 * @package Ascend Theme
 */

global $post;
$video = get_post_meta( $post->ID, '_kad_post_video', true );
$schema = apply_filters( 'ascend_video_schema', true );
?>
<div <?php ( $schema ? ascend_do_microdata( 'video' ) : '' ) ?>>
	<?php if ( $schema ) { ?>
		<meta itemprop="name" content="<?php echo esc_attr( get_post_meta( $post->ID, '_kad_video_meta_title', true ) ); ?>" />
		<meta itemprop="description" content="<?php echo esc_attr( get_post_meta( $post->ID, '_kad_video_meta_description', true ) ); ?>" />
		<?php if ( has_post_thumbnail() ) { ?>
			<meta itemprop="thumbnailURL" content="<?php the_post_thumbnail_url(); ?>"/>
			<?php
		}
	}
	if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
		if ( $schema ) {
			?>
			<meta itemprop="contentURL" content="<?php echo esc_attr( $video ); ?>" />
		<?php } ?>
		<div id="schema-videoobject" class="videofit video-container">
		<?php echo do_shortcode( wp_oembed_get( wp_kses_post( $video ) ) ); ?>
		</div>
		<?php
	} else {
		preg_match( '/src="([^"]+)"/', $video, $match );
		if ( isset( $match[1] ) ) {
			$url = $match[1];
		} else {
			preg_match( '/url="([^"]+)"/', $video, $match );
			if ( isset( $match[1] ) ) {
				$url = $match[1];
			} else {
				$url = '';
			}
		}
		if ( $schema ) {
			?>
			<meta itemprop="embedURL" content="<?php echo esc_attr( $url ); ?>" />
		<?php } ?>
		<div id="schema-videoobject" class="videofit video-container">
			<?php
			$allowed_tags           = wp_kses_allowed_html( 'post' );
			$allowed_tags['iframe'] = array(
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
				'name'            => true,
				'id'              => true,
				'class'           => true,
				'style'           => true,
			);

			echo do_shortcode( wp_kses( $video, $allowed_tags ) );
			?>
		</div>
		<?php
	}
	?>
</div>
