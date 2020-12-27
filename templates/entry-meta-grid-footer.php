<?php
/**
 * Footer Meta Content
 *
 * @package Ascend Theme
 */

?>
<div class="post-grid-footer-meta kt_color_gray">
	<?php do_action( 'ascend_before_grid_post_footer_meta' ); ?>
	<span class="postdate kt-post-date">
		<?php echo get_the_date( get_option( 'date_format' ) ); ?>
	</span> 
	<?php
	if ( 0 !== get_comments_number() ) {
		echo '<span class="postcommentscount kt-post-comments"><a href="' . esc_url( get_the_permalink() ) . '#comments" class="kt_color_gray"><i class="kt-icon-comments-o"></i>' . esc_html( get_comments_number( '0', '1', '%' ) ) . '</a></span>';
	}
	?>
	<span class="postauthor kt-post-author author vcard">
			<span>
				<span class="kt_color_gray" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo esc_attr( get_the_author() ); ?>">
					<i class="kt-icon-user"></i>
				</span>
			</span>
	</span>
</div>
