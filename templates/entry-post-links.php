<?php 
$ascend = ascend_get_options();

if(isset($ascend['postlinks_in_cat']) && $ascend['postlinks_in_cat'] == "cat"){
	$cat_setting = true;
} else {
	$cat_setting = false;
}
?>
<div class="post-footer-section">
	<div class="kad-post-navigation clearfix">
	        <div class="alignleft kad-previous-link">
	        <?php previous_post_link('%link', '<span class="kt_postlink_meta kt_color_gray">'.__('Previous Post', 'ascend').'</span><span class="kt_postlink_title">%title</span>', $in_same_term = $cat_setting); ?> 
	        </div>
	        <div class="alignright kad-next-link">
	        <?php next_post_link('%link', '<span class="kt_postlink_meta kt_color_gray">'.__('Next Post', 'ascend').'</span><span class="kt_postlink_title">%title</span>', $in_same_term = $cat_setting); ?> 
	        </div>
	 </div> <!-- end navigation -->
 </div>