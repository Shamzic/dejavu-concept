 <?php 
 global $post, $ascend_has_sidebar, $ascend_feat_width;

    $ascend = ascend_get_options();

    $postclass = array('postclass');
    $postclass[] = 'kt_no_post_header_content';
    $postclass[] = 'kad_blog_item';

    do_action( 'ascend_single_post_before' ); 
    ?> 
    <article <?php post_class($postclass); ?>>
                <?php if (has_post_thumbnail( $post->ID ) ) { 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    $style = 'background-image: url('.esc_url($image[0]).');'; 
                    $quote_class = 'kt-image-quote'; ?>
                   <?php 
                } else {
                    $quote_class = 'kt-text-quote';
                    $style = '';
                } ?>
                <div class="entry-content kt-quote-post-outer <?php echo esc_attr($quote_class);?> clearfix" style="<?php echo esc_attr($style);?>">
                    <div class="kt-quote-post">
                        <?php
                        do_action( 'ascend_single_post_content_before' );
                        
                            the_content(); 
                        
                        do_action( 'ascend_single_post_content_after' );
                        ?>
                    </div>
                </div>
                <?php $author = get_post_meta( $post->ID, '_kad_quote_author', true ); 
                if(!empty($author)) {
                    echo '<div class="kt-quote-post-author">';
                    echo '<p>- '. esc_html($author).'</p>';
                    echo '</div>';
                }
                ?>
        <footer class="single-footer">
        <?php 
            /**
            * @hooked ascend_post_footer_meta - 30
            */
            do_action( 'ascend_single_loop_post_footer' );

            if ( comments_open() ) :
                echo '<p class="kad_comments_link">';
                  	comments_popup_link( 
	                    '<i class="kt-icon-comments-o"></i>'. __( 'Leave a Reply', 'ascend' ), 
	                    '<i class="kt-icon-comments-o"></i>'. __( '1 Comment', 'ascend' ), 
	                   	'<i class="kt-icon-comments-o"></i>'. __( '% Comments', 'ascend' ),
	                    'comments-link',
	                    '<i class="kt-icon-comments-o"></i>'. __( 'Comments are Closed', 'ascend' )
                	);
                echo '</p>';
            endif;
          ?>
        </footer>
    </article>

