<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if(!function_exists('ascend_build_image_collage')) {
    function ascend_build_image_collage($id = null, $link ='image', $sidebar = false) {
    	if(empty($id)) {
    		$id = get_the_ID();
    	}
 		echo '<div class="kad_post_grid kad-light-gallery">';
            $image_gallery = get_post_meta( $id, '_kad_image_gallery', true );
            if(!empty($image_gallery)) {
                $attachments = array_filter( explode( ',', $image_gallery ) );
                if ($attachments) {
                    $i = 1;
                    $count = count($attachments);
                    if($count == 2) {
                        echo '<div class="kad_postgrid_wrap kt-2-collage clearfix">';
                        if($sidebar) {
                            $widthimgsize = 525;
                            $heightimgsize = 350;
                            $smallimgsize = 330;
                        } else {
                            $widthimgsize = 750; 
                            $heightimgsize = 500;
                            $smallimgsize = 460;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image_array($widthimgsize, $heightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($heightimgsize/$widthimgsize) * 100;
                            } else {
                                $img = ascend_get_image_array($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink); ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr( $padding );?>%;" data-rel="<?php echo esc_attr( $datarel );?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.wp_kses_post( $image_src_output ).' width="'.esc_attr( $img['width'] ).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'"  itemprop="contentUrl" '.wp_kses_post( $img['srcset'] ).'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url( $img['src'] ); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr( $img['width'] ); ?>">
							                <meta itemprop="height" content="<?php echo esc_attr( $img['height'] ); ?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';
                    } else if($count == 3){
                        echo '<div class="kad_postgrid_wrap kt-3-collage clearfix">';
                        if($sidebar) {
                            $widthimgsize = 525;
                            $heightimgsize = 350;
                            $swidthimgsize = 330;
                            $sheightimgsize = 170;
                        } else {
                            $widthimgsize = 750; 
                            $heightimgsize = 500;
                            $swidthimgsize = 460;
                            $sheightimgsize = 230;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image_array($widthimgsize, $heightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($heightimgsize/$widthimgsize) * 100;
                            } else {
                                $img = ascend_get_image_array($swidthimgsize, $sheightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($sheightimgsize/$swidthimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 2 || $i == 3) { 
                                echo '<div class="side_post_gal">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.wp_kses_post( $image_src_output ).' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'"  itemprop="contentUrl" '.wp_kses_post( $img['srcset'] ).'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 2 || $i == 3) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';

                    } else if($count == 4) {
                        echo '<div class="kad_postgrid_wrap kt-4-collage clearfix">';
                        if($sidebar) {
                            $largeimgsize = 440;
                            $smallimgsize = 220;
                        } else {
                            $largeimgsize = 600;
                            $smallimgsize = 300;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image_array($largeimgsize, floor($largeimgsize*1.55), true, null, $alt, $attachment, false);
                                $padding = (floor($largeimgsize*1.55)/$largeimgsize) * 100;
                            } elseif($i == 4) {
                                $img = ascend_get_image_array($largeimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$largeimgsize) * 100;
                            } else {
                                $img = ascend_get_image_array($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 2 || $i == 4) { 
                                echo '<div class="side_post_gal">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.wp_kses_post( $image_src_output ).' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'"  itemprop="contentUrl" '.wp_kses_post( $img['srcset'] ).'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 3 || $i == 4) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';

                    } else {
                        echo '<div class="kad_postgrid_wrap kt-5-collage clearfix">';
                        if($sidebar) {
                            $largeimgsize = 440;
                            $smallimgsize = 220;
                        } else {
                            $largeimgsize = 600;
                            $smallimgsize = 300;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 3) {
                                $img = ascend_get_image_array($largeimgsize, $largeimgsize, true, null, $alt, $attachment, false);
                                $padding = ($largeimgsize/$largeimgsize) * 100;
                            } else if($i == 4 || $i == 5) {
                                $img = ascend_get_image_array($largeimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$largeimgsize) * 100;
                            } else {
                                $img = ascend_get_image_array($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 1 || $i == 4) { 
                                echo '<div class="side_post_gal side-post-gal-'.esc_attr($i).'">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
	                                    <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
	                                        <?php echo '<img '.wp_kses_post( $image_src_output ).' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'"  itemprop="contentUrl" '.wp_kses_post( $img['srcset'] ).'/>'; ?>
	                                        <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width']);?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height']);?>">
	                                    </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 2 || $i == 5) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==6) break;
                        }
                        echo '</div>';
                    }
                }
            } 
   		echo '</div>';
	}
}
