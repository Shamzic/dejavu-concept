<?php 
$headcontent = ascend_get_post_head_content();
if('none' == $headcontent) {
	if(has_post_thumbnail()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
        echo '<div class="meta_post_image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
            echo '<meta itemprop="url" content="'.esc_url($image[0]).'">';
            echo '<meta itemprop="width" content="'.esc_attr($image[1]).'">';
            echo '<meta itemprop="height" content="'.esc_attr($image[2]).'">';
        echo '</div>';
	}
}