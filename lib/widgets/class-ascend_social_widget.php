<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Social widget
 */
class ascend_social_widget extends WP_Widget {
  	private static $instance = 0;
    public function __construct() {
    	$widget_ops = array('classname' => 'widget_kadence_social', 'description' => __('Simple way to add Social Icons', 'ascend'));
    	parent::__construct('widget_kadence_social', __('Ascend: Social Links', 'ascend'), $widget_ops);
  	}

  	function widget($args, $instance) {

	    if (!isset($args['widget_id'])) {
	      $args['widget_id'] = null;
	    }
	    extract($args);

	    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
	    if (!isset($instance['facebook'])) { $instance['facebook'] = ''; }
	    if (!isset($instance['twitter'])) { $instance['twitter'] = ''; }
	    if (!isset($instance['instagram'])) { $instance['instagram'] = ''; }
	    if (!isset($instance['googleplus'])) { $instance['googleplus'] = ''; }
	    if (!isset($instance['flickr'])) { $instance['flickr'] = ''; }
	    if (!isset($instance['vimeo'])) { $instance['vimeo'] = ''; }
	    if (!isset($instance['youtube'])) { $instance['youtube'] = ''; }
	    if (!isset($instance['pinterest'])) { $instance['pinterest'] = ''; }
	    if (!isset($instance['dribbble'])) { $instance['dribbble'] = ''; }
	    if (!isset($instance['linkedin'])) { $instance['linkedin'] = ''; }
	    if (!isset($instance['tumblr'])) { $instance['tumblr'] = ''; }
	    if (!isset($instance['stumbleupon'])) { $instance['stumbleupon'] = ''; }
	    if (!isset($instance['vk'])) { $instance['vk'] = ''; }
	    if (!isset($instance['viadeo'])) { $instance['viadeo'] = ''; }
	    if (!isset($instance['xing'])) { $instance['xing'] = ''; }
	    if (!isset($instance['yelp'])) { $instance['yelp'] = ''; }
	    if (!isset($instance['soundcloud'])) { $instance['soundcloud'] = ''; }
	    if (!isset($instance['snapchat'])) { $instance['snapchat'] = ''; }
	    if (!isset($instance['behance'])) { $instance['behance'] = ''; }
	    if (!isset($instance['rss'])) { $instance['rss'] = ''; }
	    if (!isset($instance['tooltip'])) { $instance['tooltip'] = 'tooltip'; }
	    if (!isset($instance['tooltip_dir'])) { $instance['tooltip_dir'] = 'top'; }

	    echo $before_widget;
	    if ($title) {
	      	echo $before_title;
	      	echo $title;
	      	echo $after_title;
	    }

	    echo '<div class="kadence_social_widget clearfix">';

	    if(!empty($instance['facebook'])):
	        echo '<a href="'.esc_url($instance['facebook']).'" class="facebook_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Facebook" aria-label="Facebook"><i class="kt-icon-facebook"></i></a>';
	    endif;
	    if(!empty($instance['twitter'])):
	        echo '<a href="'.esc_url($instance['twitter']).'" class="twitter_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Twitter" aria-label="Twitter"><i class="kt-icon-twitter"></i></a>';
	    endif;
	    if(!empty($instance['instagram'])):
	        echo '<a href="'.esc_url($instance['instagram']).'" class="instagram_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Instagram" aria-label="Instagram"><i class="kt-icon-instagram"></i></a>';
	    endif;
	    if(!empty($instance['flickr'])):
	        echo '<a href="'.esc_url($instance['flickr']).'" class="flickr_link" data-toggle="'.esc_attr($instance['tooltip']).'" target="_blank" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Flickr" aria-label="Flickr"><i class="kt-icon-flickr"></i></a>';
	    endif;
	    if(!empty($instance['vimeo'])):
	        echo '<a href="'.esc_url($instance['vimeo']).'" class="vimeo_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Vimeo" aria-label="Vimeo"><i class="kt-icon-vimeo"></i></a>';
	    endif;
	    if(!empty($instance['youtube'])):
	        echo '<a href="'.esc_url($instance['youtube']).'" class="youtube_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="YouTube" aria-label="YouTube"><i class="kt-icon-youtube"></i></a>';
	    endif;
	    if(!empty($instance['pinterest'])):
	        echo '<a href="'.esc_url($instance['pinterest']).'" class="pinterest_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Pinterest" aria-label="Pinterest"><i class="kt-icon-pinterest"></i></a>';
	    endif;
	    if(!empty($instance['dribbble'])):
	        echo '<a href="'.esc_url($instance['dribbble']).'" class="dribbble_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Dribbble" aria-label="Dribbble"><i class="kt-icon-dribbble"></i></a>';
	    endif;
	    if(!empty($instance['linkedin'])):
	        echo '<a href="'.esc_url($instance['linkedin']).'" class="linkedin_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="LinkedIn" aria-label="LinkedIn"><i class="kt-icon-linkedin"></i></a>';
	    endif;
	    if(!empty($instance['tumblr'])):
	        echo '<a href="'.esc_url($instance['tumblr']).'" class="tumblr_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Tumblr" aria-label="Tumblr"><i class="kt-icon-tumblr"></i></a>';
	    endif;
	    if(!empty($instance['stumbleupon'])):
	        echo '<a href="'.esc_url($instance['stumbleupon']).'" class="stumbleupon_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="StumbleUpon" aria-label="StumbleUpon"><i class="kt-icon-stumbleupon"></i></a>';
	    endif;
	    if(!empty($instance['vk'])):
	        echo '<a href="'.esc_url($instance['vk']).'" class="vk_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="VK" aria-label="VK"><i class="kt-icon-vk"></i></a>';
	    endif;
	    if(!empty($instance['viadeo'])):
	        echo '<a href="'.esc_url($instance['viadeo']).'" class="viadeo_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Viadeo" aria-label="Viadeo"><i class="kt-icon-viadeo"></i></a>';
	    endif;
	    if(!empty($instance['xing'])):
	        echo '<a href="'.esc_url($instance['xing']).'" class="xing_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Xing" aria-label="Xing"><i class="kt-icon-xing"></i></a>';
	    endif;
	    if(!empty($instance['soundcloud'])):
	        echo '<a href="'.esc_url($instance['soundcloud']).'" class="soundcloud_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Soundcloud" aria-label="Soundcloud"><i class="kt-icon-soundcloud"></i></a>';
	    endif;
	    if(!empty($instance['yelp'])):
	        echo '<a href="'.esc_url($instance['yelp']).'" class="yelp_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Yelp" aria-label="Yelp"><i class="kt-icon-yelp"></i></a>';
	    endif;
	    if(!empty($instance['snapchat'])):
	        echo '<a href="'.esc_url($instance['snapchat']).'" class="snapchat_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Snapchat" aria-label="Snapchat"><i class="kt-icon-snapchat-ghost"></i></a>';
	    endif;
	    if(!empty($instance['behance'])):
	        echo '<a href="'.esc_url($instance['behance']).'" class="behance_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="Behance" aria-label="Behance"><i class="kt-icon-behance"></i></a>';
	    endif;
	    if(!empty($instance['rss'])):
	        echo '<a href="'.esc_url($instance['rss']).'" class="rss_link" target="_blank" data-toggle="'.esc_attr($instance['tooltip']).'" data-placement="'.esc_attr($instance['tooltip_dir']).'" data-original-title="RSS" aria-label="RSS"><i class="kt-icon-feed"></i></a>';
	    endif;

	    echo '</div>';
	    echo $after_widget;

  	}

  	public function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['title'] 			= sanitize_text_field($new_instance['title']);
	    $instance['facebook'] 		= esc_url_raw($new_instance['facebook']);
	    $instance['twitter'] 		= esc_url_raw($new_instance['twitter']);
	    $instance['instagram'] 		= esc_url_raw($new_instance['instagram']);
	    $instance['flickr'] 		= esc_url_raw($new_instance['flickr']);
	    $instance['vimeo'] 			= esc_url_raw($new_instance['vimeo']);
	    $instance['youtube'] 		= esc_url_raw($new_instance['youtube']);
	    $instance['pinterest'] 		= esc_url_raw($new_instance['pinterest']);
	    $instance['dribbble'] 		= esc_url_raw($new_instance['dribbble']);
	    $instance['linkedin'] 		= esc_url_raw($new_instance['linkedin']);
	    $instance['tumblr'] 		= esc_url_raw($new_instance['tumblr']);
	    $instance['stumbleupon'] 	= esc_url_raw($new_instance['stumbleupon']);
	    $instance['vk'] 			= esc_url_raw($new_instance['vk']);
	    $instance['viadeo'] 		= esc_url_raw($new_instance['viadeo']);
	    $instance['xing'] 			= esc_url_raw($new_instance['xing']);
	    $instance['yelp'] 			= esc_url_raw($new_instance['yelp']);
	    $instance['soundcloud'] 	= esc_url_raw($new_instance['soundcloud']);
	    $instance['snapchat'] 		= esc_url_raw($new_instance['snapchat']);
	    $instance['behance'] 		= esc_url_raw($new_instance['behance']);
	    $instance['rss'] 			= esc_url_raw($new_instance['rss']);
	    $instance['tooltip'] 		= sanitize_text_field($new_instance['tooltip']);
	    $instance['tooltip_dir'] 	= sanitize_text_field($new_instance['tooltip_dir']);

	    return $instance;
  	}

  	public function form($instance) {
	    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	    $facebook = isset($instance['facebook']) ? esc_attr($instance['facebook']) : '';
	    $twitter = isset($instance['twitter']) ? esc_attr($instance['twitter']) : '';
	    $instagram = isset($instance['instagram']) ? esc_attr($instance['instagram']) : '';
	    $flickr = isset($instance['flickr']) ? esc_attr($instance['flickr']) : '';
	    $vimeo = isset($instance['vimeo']) ? esc_attr($instance['vimeo']) : '';
	    $youtube = isset($instance['youtube']) ? esc_attr($instance['youtube']) : '';
	    $pinterest = isset($instance['pinterest']) ? esc_attr($instance['pinterest']) : '';
	    $dribbble = isset($instance['dribbble']) ? esc_attr($instance['dribbble']) : '';
	    $linkedin = isset($instance['linkedin']) ? esc_attr($instance['linkedin']) : '';
	    $tumblr = isset($instance['tumblr']) ? esc_attr($instance['tumblr']) : '';
	    $stumbleupon = isset($instance['stumbleupon']) ? esc_attr($instance['stumbleupon']) : '';
	    $vk = isset($instance['vk']) ? esc_attr($instance['vk']) : '';
	    $viadeo = isset($instance['viadeo']) ? esc_attr($instance['viadeo']) : '';
	    $xing = isset($instance['xing']) ? esc_attr($instance['xing']) : '';
	    $yelp = isset($instance['yelp']) ? esc_attr($instance['yelp']) : '';
	    $soundcloud = isset($instance['soundcloud']) ? esc_attr($instance['soundcloud']) : '';
	    $snapchat = isset($instance['snapchat']) ? esc_attr($instance['snapchat']) : '';
	    $behance = isset($instance['behance']) ? esc_attr($instance['behance']) : '';
	    $rss = isset($instance['rss']) ? esc_attr($instance['rss']) : '';
	    $tooltip = isset($instance['tooltip']) ? esc_attr($instance['tooltip']) : 'tooltip';
	    $tooltip_dir = isset($instance['tooltip_dir']) ? esc_attr($instance['tooltip_dir']) : 'top';
	    $tool_options = array(array("slug" => "tooltip", "name" => __('Enable', 'ascend')), array("slug" => "none", "name" => __('Disable', 'ascend')));
	    $tool_options_array = array();
	    foreach ($tool_options as $tool_option) {
	      	if ($tooltip == $tool_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$tool_options_array[] = '<option value="' . esc_attr($tool_option['slug']) .'"' . $selected . '>' . esc_html($tool_option['name']) . '</option>';
	    }
	    $tool_directions = array(array("slug" => "top", "name" => __('Top', 'ascend')), array("slug" => "bottom", "name" => __('Bottom', 'ascend')), array("slug" => "left", "name" => __('Left', 'ascend')), array("slug" => "right", "name" => __('Right', 'ascend')));
	    $tool_directions_array = array();
	    foreach ($tool_directions as $tool_direction) {
	      	if ($tooltip_dir == $tool_direction['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$tool_directions_array[] = '<option value="' . esc_attr($tool_direction['slug']) .'"' . $selected . '>' . esc_html($tool_direction['name']) . '</option>';
	    }
	  	?>
	  	<p>
	      	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php _e('Instagram:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php _e('Flickr:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php _e('Vimeo:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php _e('Youtube:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php _e('Pinterest:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php _e('Dribbble:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e('Linkedin:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php _e('Tumblr:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>"><?php _e('Stumbleupon:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>" name="<?php echo esc_attr($this->get_field_name('stumbleupon')); ?>" type="text" value="<?php echo esc_attr($stumbleupon); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('vk')); ?>"><?php _e('VK:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vk')); ?>" name="<?php echo esc_attr($this->get_field_name('vk')); ?>" type="text" value="<?php echo esc_attr($vk); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('viadeo')); ?>"><?php _e('Viadeo:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('viadeo')); ?>" name="<?php echo esc_attr($this->get_field_name('viadeo')); ?>" type="text" value="<?php echo esc_attr($viadeo); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('xing')); ?>"><?php _e('xing:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('xing')); ?>" name="<?php echo esc_attr($this->get_field_name('xing')); ?>" type="text" value="<?php echo esc_attr($xing); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('yelp')); ?>"><?php _e('Yelp:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('yelp')); ?>" name="<?php echo esc_attr($this->get_field_name('yelp')); ?>" type="text" value="<?php echo esc_attr($yelp); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('soundcloud')); ?>"><?php _e('Soundcloud:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('soundcloud')); ?>" name="<?php echo esc_attr($this->get_field_name('soundcloud')); ?>" type="text" value="<?php echo esc_attr($soundcloud); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('snapchat')); ?>"><?php _e('Snapchat:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('snapchat')); ?>" name="<?php echo esc_attr($this->get_field_name('snapchat')); ?>" type="text" value="<?php echo esc_attr($snapchat); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('behance')); ?>"><?php _e('Behance:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('behance')); ?>" name="<?php echo esc_attr($this->get_field_name('behance')); ?>" type="text" value="<?php echo esc_attr($behance); ?>" />
	    </p>
	    <p>
	      	<label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php _e('RSS:', 'ascend'); ?></label>
	      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" type="text" value="<?php echo esc_attr($rss); ?>" />
	    </p>
	    <p>
	   		<label for="<?php echo $this->get_field_id('tooltip'); ?>"><?php _e('Show Tooltip', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('tooltip'); ?>" name="<?php echo $this->get_field_name('tooltip'); ?>"><?php echo implode('', $tool_options_array); ?></select>
	    </p>
	    <p>
	   		<label for="<?php echo $this->get_field_id('tooltip_dir'); ?>"><?php _e('Tooltip Direction', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('tooltip_dir'); ?>" name="<?php echo $this->get_field_name('tooltip_dir'); ?>"><?php echo implode('', $tool_directions_array); ?></select>
	    </p>
	  	<?php
  	}
}