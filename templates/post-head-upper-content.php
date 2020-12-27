<?php
global $post;
	$ascend = ascend_get_options();
	$height = get_post_meta( $post->ID, '_kad_posthead_height', true );
if ( ! empty( $height ) ) {
	$slideheight = $height;
} else {
	$slideheight = 400;
}
	$ascend_headcontent = ascend_get_post_head_content();

if ( $ascend_headcontent == 'imgcarousel' ) { ?>
		<section class="postfeat kt-upper-head-content post-carousel-upper">
			<div class="slick-slider kad-light-gallery kt-slickslider kt-image-carousel loading" data-slider-speed="7000" data-slider-anim-speed="400" data-slider-fade="false" data-slider-type="carousel" data-slider-auto="true" data-slider-arrows="true">
					<?php
					$image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
					if ( ! empty( $image_gallery ) ) {
						$attachments = array_filter( explode( ',', $image_gallery ) );
						if ( $attachments ) {
							foreach ( $attachments as $attachment ) {
								$alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
								$img = ascend_get_image_array( null, $slideheight, true, null, $alt, $attachment, false );
								if ( ascend_lazy_load_filter() ) {
									$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="' . esc_url( $img['src'] ) . '" ';
								} else {
									$image_src_output = 'src="' . esc_url( $img['src'] ) . '"';
								}
								echo '<div class="kt-slick-slide">';
									echo '<a href="' . esc_url( $img['full'] ) . '" data-rel="lightbox">';
										echo '<img ' . $image_src_output . ' width="' . esc_attr( $img['width'] ) . '" height="' . esc_attr( $img['height'] ) . '" alt="' . esc_attr( $img['alt'] ) . '" ' . $img['srcset'] . '/>';
									echo '</a>';
								echo '</div>';
							}
						}
					}
					?>
											
			</div> <!--Image Slider-->
		</section>
	<?php
}
