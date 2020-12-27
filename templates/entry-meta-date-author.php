<div class="post-top-meta kt_color_gray">
    <span class="postdate kt-post-date updated" itemprop="datePublished">
        <?php echo get_the_date(get_option( 'date_format' ));?>
    </span>   
    <span class="postauthortop kt-post-author author vcard">
        <?php 
       		$ascend = ascend_get_options();
        	if(!empty($ascend['post_by_text'])) {
        		$authorbytext = $ascend['post_by_text'];
        	} else {
        		$authorbytext = __('by', 'ascend');
        	} 
        	echo '<span class="kt-by-author">'.esc_html($authorbytext).'</span>'; ?>
        	<span itemprop="author">
        		<a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta('ID')) ); ?>" class="fn kt_color_gray" rel="author">
        		<?php echo get_the_author() ?>
        		</a>
        	</span>
    </span>   
</div>