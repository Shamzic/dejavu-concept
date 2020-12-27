<?php 

    global $post;

    $postclass = array('postclass');
    $postclass[] = 'kt_no_post_header_content';

   	while (have_posts()) : the_post(); 
         
        do_action( 'ascend_single_post_before' ); 

        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class($postclass); ?> itemscope itemtype="http://schema.org/CreativeWork">
                <?php if (has_post_thumbnail( $post->ID ) ) { 
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    $style = 'background-image: url('.esc_url($image[0]).');'; 
                    $quote_class = 'kt-image-quote'; ?>
                    <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <meta itemprop="url" content="<?php echo esc_url($image[0]); ?>">
                        <meta itemprop="width" content="<?php echo esc_attr($image[1])?>">
                        <meta itemprop="height" content="<?php echo esc_attr($image[2])?>">
                    </div>
                   <?php 
                } else {
                    $quote_class = 'kt-text-quote';
                    $style = '';
                } ?>
                <div class="entry-content kt-quote-post-outer <?php echo esc_attr($quote_class);?> clearfix" itemprop="description" style="<?php echo esc_attr($style);?>">
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
                * @hooked ascend_post_footer_pagination - 10
                * @hooked ascend_post_footer_tags - 20
                * @hooked ascend_post_footer_meta - 30
                * @hooked ascend_post_nav - 40
                */
                do_action( 'ascend_single_post_footer' );
                ?>
                </footer>
            </article>
            <?php
            /**
            * @hooked ascend_post_authorbox - 20
            * @hooked ascend_post_bottom_carousel - 30
            * @hooked ascend_post_comments - 40
            */
            do_action( 'ascend_single_post_after' );

            endwhile; 

do_action( 'ascend_single_post_end' ); 