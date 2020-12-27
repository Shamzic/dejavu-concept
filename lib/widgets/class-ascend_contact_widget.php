<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Contact widget
 */
class ascend_contact_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'widget_kadence_contact', 'description' => __('Use this widget to add a Vcard to your site', 'ascend'));
        parent::__construct('widget_kadence_contact', __('Ascend: Contact/Vcard', 'ascend'), $widget_ops);
    }

    public function widget($args, $instance) {
        if (!isset($args['widget_id'])) {
          $args['widget_id'] = null;
        }

        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $company = empty($instance['company']) ? ' ' : apply_filters('widget_text', $instance['company']);
        if (!isset($instance['name'])) { $instance['name'] = ''; }
        if (!isset($instance['street_address'])) { $instance['street_address'] = ''; }
        if (!isset($instance['locality'])) { $instance['locality'] = ''; }
        if (!isset($instance['region'])) { $instance['region'] = ''; }
        if (!isset($instance['postal_code'])) { $instance['postal_code'] = ''; }
        if (!isset($instance['tel'])) { $instance['tel'] = ''; }
        if (!isset($instance['fixedtel'])) { $instance['fixedtel'] = ''; }
        if (!isset($instance['email'])) { $instance['email'] = ''; }

        echo $before_widget;
        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }
        ?>
        <div class="vcard">
      
            <?php if(!empty($instance['company'])):?><p class="vcard-company"><i class="kt-icon-building"></i><?php echo esc_html($company); ?></p><?php endif;?>
            <?php if(!empty($instance['name'])):?><p class="vcard-name fn"><i class="kt-icon-user"></i><?php echo esc_html($instance['name']); ?></p><?php endif;?>
            <?php if(!empty($instance['street_address']) || !empty($instance['locality']) || !empty($instance['region']) ):?>
                <p class="vcard-address"><i class="kt-icon-map-marker"></i><?php echo esc_html($instance['street_address']); ?>
                <span><?php echo $instance['locality']; ?> <?php echo $instance['region']; ?> <?php echo esc_html($instance['postal_code']); ?></span></p>
            <?php endif;?>
            <?php if(!empty($instance['tel'])):?><p class="tel"><i class="kt-icon-mobile"></i><?php echo esc_html($instance['tel']); ?></p><?php endif;?>
            <?php if(!empty($instance['fixedtel'])):?><p class="tel fixedtel"><i class="kt-icon-phone"></i><?php echo esc_html($instance['fixedtel']); ?></p><?php endif;?>
            <?php if(!empty($instance['email'])):?>
            	<p><a class="email" href="mailto:<?php echo esc_attr( antispambot($instance['email']) );?>"><i class="kt-icon-envelope"></i><?php echo esc_html( antispambot($instance['email']) ); ?></a></p> 
            <?php endif;?>
            
        </div>
        <?php
        echo $after_widget;

    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['company'] = sanitize_text_field($new_instance['company']);
        $instance['name'] = sanitize_text_field($new_instance['name']);
        $instance['street_address'] = sanitize_text_field($new_instance['street_address']);
        $instance['locality'] = sanitize_text_field($new_instance['locality']);
        $instance['region'] = sanitize_text_field($new_instance['region']);
        $instance['postal_code'] = sanitize_text_field($new_instance['postal_code']);
        $instance['tel'] = sanitize_text_field($new_instance['tel']);
        $instance['fixedtel'] = sanitize_text_field($new_instance['fixedtel']);
        $instance['email'] = sanitize_text_field($new_instance['email']);

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $company = isset($instance['company']) ? esc_attr($instance['company']) : '';
        $name = isset($instance['name']) ? esc_attr($instance['name']) : '';
        $street_address = isset($instance['street_address']) ? esc_attr($instance['street_address']) : '';
        $locality = isset($instance['locality']) ? esc_attr($instance['locality']) : '';
        $region = isset($instance['region']) ? esc_attr($instance['region']) : '';
        $postal_code = isset($instance['postal_code']) ? esc_attr($instance['postal_code']) : '';
        $tel = isset($instance['tel']) ? esc_attr($instance['tel']) : '';
        $fixedtel = isset($instance['fixedtel']) ? esc_attr($instance['fixedtel']) : '';
        $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
        ?>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('company')); ?>"><?php _e('Company Name:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('company')); ?>" name="<?php echo esc_attr($this->get_field_name('company')); ?>" type="text" value="<?php echo esc_attr($company); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('name')); ?>"><?php _e('Name:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('street_address')); ?>"><?php _e('Street Address:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('street_address')); ?>" type="text" value="<?php echo esc_attr($street_address); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('locality')); ?>"><?php _e('City/Locality:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('locality')); ?>" name="<?php echo esc_attr($this->get_field_name('locality')); ?>" type="text" value="<?php echo esc_attr($locality); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('region')); ?>"><?php _e('State/Region:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('region')); ?>" name="<?php echo esc_attr($this->get_field_name('region')); ?>" type="text" value="<?php echo esc_attr($region); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('postal_code')); ?>"><?php _e('Zipcode/Postal Code:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('postal_code')); ?>" type="text" value="<?php echo esc_attr($postal_code); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('tel')); ?>"><?php _e('Mobile Telephone:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel')); ?>" name="<?php echo esc_attr($this->get_field_name('tel')); ?>" type="text" value="<?php echo esc_attr($tel); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>"><?php _e('Fixed Telephone:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>" name="<?php echo esc_attr($this->get_field_name('fixedtel')); ?>" type="text" value="<?php echo esc_attr($fixedtel); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:', 'ascend'); ?></label>
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </p>
      <?php
    }
}