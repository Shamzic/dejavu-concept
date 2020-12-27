<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Kadence Recent_Posts widget class
 *  Just a rewite of wp recent post
 * 
 */
class ascend_recent_posts_widget extends WP_Widget {

  	private static $instance = 0;
	public function __construct() {
  		$widget_ops = array('classname' => 'kadence_recent_posts', 'description' => __('This shows the most recent posts on your site with a thumbnail', 'ascend'));
  		parent::__construct('kadence_recent_posts', __('Ascend: Recent Posts', 'ascend'), $widget_ops);
	}

  	public function widget($args, $instance) {

	    if ( ! isset( $args['widget_id'] ) ) {
	      $args['widget_id'] = $this->id;
	    }

	    extract($args);

    	$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
    	if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
    		$number = 10; 
    	}
    	if(isset($instance['orderby'])) {
	      	$orderby = $instance['orderby'];
	    } else {
	      	$orderby = 'date';
	    }
	    if($orderby == "menu_order" || $orderby == "title") {
	      	$order = "ASC";
	    } else {
	      	$order = "DESC";
	    }
	    if(isset($instance['first_feature']) && $instance['first_feature'] == "true") {
	      	$feature = "true";
	    } else {
	      	$feature = "false";
	    }
	    if(isset($instance['read_more']) && $instance['read_more'] == "true") {
	      	$readmore = "true";
	    } else {
	      	$readmore = "false";
	    }
	    if(isset($instance['read_more_txt']) && !empty($instance['read_more_txt'])) {
	      	$readmore_txt = $instance['read_more_txt'];
	    } else {
	      	$readmore_txt = __('Read More', 'ascend');
	    }
	    if(isset($instance['thecate'])) {
	      	$cat = $instance['thecate'];
	    } else {
	      	$cat = __('Read More', 'ascend');
	    }
    	$r = new WP_Query( apply_filters( 'widget_posts_args', array( 
	        'posts_per_page' => $number,
	        'category_name' => $cat,
	        'no_found_rows' => true,
	        'post_status' => 'publish',
	        'orderby' => $orderby,
	        'order' => $order,
	        'ignore_sticky_posts' => true 
	        ) 
	    ) );
    	if ($r->have_posts()) :
	    	$image_size = apply_filters('kadence_post_widget_image_size', array('width'=> 60, 'height' => 60));
	    	$feature_image_size = apply_filters('kadence_post_feature_widget_image_size', array('width'=> 420, 'height' => 280));

	    	echo $before_widget; 
	    	
	    	if ( $title ) {
	    		echo $before_title . $title . $after_title; 
	    	}
		    
		    echo '<ul>';
		    	$i = 1;
		        while ($r->have_posts()) : $r->the_post();
		        global $post;
		        if($feature == "true" && $i == 1) { 
	    			echo '<li class="clearfix postclass kt-top-featured">';
	    			if(has_post_thumbnail( $post->ID ) ) {
	    				echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr(get_the_title()).'" class="recentpost_featimg">';
	                	echo ascend_get_full_image_output($feature_image_size['width'], $feature_image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
	                	echo '</a>';
	                } 
          		} else {
		        	echo '<li class="clearfix postclass">';
		            if(has_post_thumbnail( $post->ID ) ) { 
		                echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr(get_the_title()).'" class="recentpost_featimg">';
		                echo ascend_get_full_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
		                echo '</a>';
		            }
		        }
		            echo '<div class="recent_posts_widget_content">';
			            echo '<div class="recent_posts_widget_content_inner">';
			            echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr(get_the_title()).'" class="recentpost_title">';
			                        the_title(); 
			            echo '</a>';
			            echo '<span class="recentpost_date kt_color_gray">'.get_the_date(get_option( 'date_format' )).'</span>';
			            echo '</div>';
		            echo '</div>';
		        echo '</li>';
		        $i ++;
		        endwhile; 
		    echo '</ul>';
	    	if($readmore == 'true') {
	    		if(isset($instance['thecate']) && !empty($instance['thecate'])) {
	    			$cat = get_category_by_slug($instance['thecate']); 
	    			$link = get_category_link($cat->term_id);
	    		} else {
	    			$post_id = get_option( 'page_for_posts' );
	    			if(isset($post_id) && !empty($post_id)) {
	    				$link = get_the_permalink($post_id);
	    			} else {
	    				$link = home_url();
	    			}
	    		}
	    		echo '<div class="rpw_readmore_container">';
	    			echo '<a href="'.esc_url($link).'" class="button posts_widget_readmore"><span>'.esc_html($readmore_txt).'</span></a>';
	    		echo '</div>';
	    	}
	    	echo $after_widget;

    		wp_reset_postdata();
    	endif;
	}

  	public function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;
	    $instance['title'] 			= sanitize_text_field($new_instance['title']);
	    $instance['orderby'] 		= sanitize_text_field($new_instance['orderby']);
	    $instance['number'] 		= (int) $new_instance['number'];
	    $instance['thecate'] 		= sanitize_text_field($new_instance['thecate']);
	    $instance['first_feature'] 	= sanitize_text_field($new_instance['first_feature']);
	    $instance['read_more'] 		= sanitize_text_field($new_instance['read_more']);
	    $instance['read_more_txt'] 	= sanitize_text_field($new_instance['read_more_txt']);
	    return $instance;
  	}

  	public function form( $instance ) {
	    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	    $number = isset($instance['number']) ? absint($instance['number']) : 5;
	    if (isset($instance['thecate'])) { $thecate = esc_attr($instance['thecate']); } else {$thecate = '';}
	    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'date';}
	    $first_feature = isset($instance['first_feature']) ? $instance['first_feature'] : "false";
	    $read_more = isset($instance['read_more']) ? $instance['read_more'] : "false";
	    $read_more_txt = isset($instance['read_more_txt']) ? esc_attr($instance['read_more_txt']) : '';
	    $orderoptions = array(array('name' => 'Date', 'slug' => 'date'), array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Comment Count', 'slug' => 'comment_count'), array('name' => 'Modified', 'slug' => 'modified'));
	    $true_false_options = array(array('name' => 'False', 'slug' => 'false'), array('name' => 'True', 'slug' => 'true'));
	    $categories= get_categories();
	    $cate_options = array();
	    $cate_options[] = '<option value="">All</option>';
	    foreach ($categories as $cate) {
	      	if ($thecate==$cate->slug) { $selected=' selected="selected"';} else { $selected=""; }
	      	$cate_options[] = '<option value="' . esc_attr($cate->slug) .'"' . $selected . '>' . esc_html($cate->name) . '</option>';
	    }
	    $order_options = array();
	    foreach ($orderoptions as $ooption) {
	      	if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
	      	$order_options[] = '<option value="' . esc_attr($ooption['slug']) .'"' . $selected . '>' . esc_html($ooption['name']) . '</option>';
	    }
	    $feature_options = array();
    	foreach ($true_false_options as $foption) {
      		if ($first_feature==$foption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      		$feature_options[] = '<option value="' . esc_attr($foption['slug']) .'"' . $selected . '>' . esc_html($foption['name']) . '</option>';
    	}
    	$readmore_options = array();
    	foreach ($true_false_options as $roption) {
      		if ($read_more ==$roption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      		$readmore_options[] = '<option value="' . esc_attr($roption['slug']) .'"' . $selected . '>' . esc_html($roption['name']) . '</option>';
    	}
		?>
	    <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'ascend'); ?></label>
	    	<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
	    </p>
        <p>
    		<label for="<?php echo $this->get_field_id('thecate'); ?>"><?php _e('Limit to Catagory (Optional):', 'ascend'); ?></label>
    		<select id="<?php echo $this->get_field_id('thecate'); ?>" name="<?php echo $this->get_field_name('thecate'); ?>"><?php echo implode('', $cate_options); ?></select>
  		</p>
  		<p>
	    	<label for="<?php echo $this->get_field_id('first_feature'); ?>"><?php _e('Feature first item:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('first_feature'); ?>" name="<?php echo $this->get_field_name('first_feature'); ?>"><?php echo implode('', $feature_options); ?></select>
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('View more link at end of post list?:', 'ascend'); ?></label>
	    	<select id="<?php echo $this->get_field_id('read_more'); ?>" name="<?php echo $this->get_field_name('read_more'); ?>"><?php echo implode('', $readmore_options); ?></select>
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('read_more_txt'); ?>"><?php _e('View more link text:', 'ascend'); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id('read_more_txt'); ?>" name="<?php echo $this->get_field_name('read_more_txt'); ?>" type="text" value="<?php echo esc_attr($read_more_txt); ?>" />
	    </p>
<?php
  }
}
