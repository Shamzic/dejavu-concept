<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Kadence_Image_Grid_Widget widget class
 * 
 */
class ascend_post_grid_widget extends WP_Widget {

  private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_image_grid', 'description' => __('This shows a grid of featured images from recent posts or portfolio items', 'ascend'));
      parent::__construct('kadence_image_grid', __('Ascend: Post Grid', 'ascend'), $widget_ops);
  }

  public function widget($args, $instance) {

    extract($args);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
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
    if(isset($instance['gridchoice'])) {
    	$gridchoice = $instance['gridchoice'];
    } else {
    	$gridchoice = 'post';
    }
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
      $number = 8; 
    }
    
    echo $before_widget; 

    if ( $title ) echo $before_title . $title . $after_title;
        
       switch ($instance['gridchoice']) {
      
        case "portfolio" :
        
            $r = new WP_Query( 
                apply_filters('widget_posts_args', array( 
                'post_type' => 'portfolio', 
                'portfolio-type' => $instance['thetype'], 
                'no_found_rows' => true, 
                'posts_per_page' => $number, 
                'post_status' => 'publish', 
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true 
                ) ) 
            );
            if ($r->have_posts()) :       
                $image_size = apply_filters('ascend_widget_image_size', array('width'=> 60, 'height' => 60));
                echo '<div class="imagegrid-widget clearfix">';
                    while ($r->have_posts()) : $r->the_post(); 
                        global $post; 
                        if(has_post_thumbnail( $post->ID ) ) {
                            echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr(get_the_title()).'" class="imagegrid_item lightboxhover">';
                                echo ascend_get_full_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
                            echo '</a>';
                        } 
                endwhile; 
                echo '</div>';
                wp_reset_postdata(); 
            endif;

        break;
        case "post":          
            $r = new WP_Query( 
                apply_filters('widget_posts_args', array( 
                    'posts_per_page' => $number, 
                    'category_name' => $instance['thecat'], 
                    'no_found_rows' => true, 
                    'orderby' => $orderby,
                    'order' => $order,
                    'post_status' => 'publish', 
                    'ignore_sticky_posts' => true 
                ) ) 
            );

            if ($r->have_posts()) : 
                $image_size = apply_filters('ascend_widget_image_size', array('width'=> 60, 'height' => 60));
                echo '<div class="imagegrid-widget clearfix">';
                while ($r->have_posts()) : $r->the_post(); 
                    global $post; 
                    if(has_post_thumbnail( $post->ID ) ) {
                         echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr(get_the_title()).'" class="imagegrid_item lightboxhover">';
                            echo ascend_get_full_image_output($image_size['width'], $image_size['height'], true, 'attachment-widget-thumb wp-post-image', null, null, true);
                        echo '</a>';
                    }
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            endif;
        break; 
    } 
    echo $after_widget;

  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['thecat'] = sanitize_text_field($new_instance['thecat']);
    $instance['orderby'] = sanitize_text_field($new_instance['orderby']);
    $instance['thetype'] = sanitize_text_field($new_instance['thetype']);
    $instance['gridchoice'] = sanitize_text_field($new_instance['gridchoice']);

    return $instance;
  }

  public function form( $instance ) {
    
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $gridchoice = isset($instance['gridchoice']) ? esc_attr($instance['gridchoice']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 6;
    if (isset($instance['thecat'])) { $thecat = esc_attr($instance['thecat']); } else {$thecat = '';}
    if (isset($instance['thetype'])) { $thetype = esc_attr($instance['thetype']); } else {$thetype = '';}
    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'date';}
    $orderoptions = array(array('name' => 'Date', 'slug' => 'date'), array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Comment Count', 'slug' => 'comment_count'), array('name' => 'Modified', 'slug' => 'modified'), array('name' => 'Menu Order', 'slug' => 'menu_order'), array('name' => 'Title', 'slug' => 'title'));
     $types= get_terms('portfolio-type');
     $type_options = array();
          $type_options[] = '<option value="">All</option>';
    if(!empty($types) && !is_wp_error($types) ) {
      foreach ($types as $type) {
        if ($thetype==$type->slug) { $selected=' selected="selected"';} else { $selected=""; }
        $type_options[] = '<option value="' . esc_attr($type->slug) .'"' . $selected . '>' . esc_html($type->name) . '</option>';
      }
    }
     $categories= get_categories();
     $cat_options = array();
          $cat_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cat) {
      if ($thecat==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . esc_attr($cat->slug) .'"' . $selected . '>' . esc_html($cat->name ). '</option>';
    }
    $order_options = array();
    foreach ($orderoptions as $ooption) {
      if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $order_options[] = '<option value="' . esc_attr($ooption['slug']) .'"' . $selected . '>' . esc_html($ooption['name']) . '</option>';
    }


?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascend'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('gridchoice'); ?>"><?php _e('Grid Choice:','ascend'); ?></label>
        <select id="<?php echo $this->get_field_id('gridchoice'); ?>" name="<?php echo $this->get_field_name('gridchoice'); ?>">
            <option value="post"<?php echo ($gridchoice === 'post' ? ' selected="selected"' : ''); ?>><?php _e('Blog Posts', 'ascend'); ?></option>
            <option value="portfolio"<?php echo ($gridchoice === 'portfolio' ? ' selected="selected"' : ''); ?>><?php _e('Portfolio', 'ascend'); ?></option>
        </select></p>
        
        <p><label for="<?php echo $this->get_field_id('thecat'); ?>"><?php _e('If Post - Choose Category (Optional):', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('thecat'); ?>" name="<?php echo $this->get_field_name('thecat'); ?>"><?php echo implode('', $cat_options); ?></select></p>
        
    <p><label for="<?php echo $this->get_field_id('thetype'); ?>"><?php _e('If Portfolio - Choose Type (Optional):', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('thetype'); ?>" name="<?php echo $this->get_field_name('thetype'); ?>"><?php echo implode('', $type_options); ?></select></p>
        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of images to show:', 'ascend'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
     <p>
    <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'ascend'); ?></label>
    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
    </p>
  
<?php
  }
}