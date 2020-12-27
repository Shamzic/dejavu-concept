<?php 

class Ascend_custom_menu {

	protected static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
  	/**
   	* Initializes the plugin by setting localization, filters, and administration functions.
   	*/
  	function __construct() {    
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'ascend_add_nav_fields' ) );

		// add new fields via hook
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'ascend_custom_nav_fields' ), 10, 4 );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'ascend_update_nav_fields'), 10, 3 );

		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'ascend_edit_admin_walker') );

  	} // end constructor
  
  
	/**
	* Add custom fields to $item nav object
	* in order to be used in custom Walker
	*
	* @access      public
	* @since       1.0 
	* @return      void
	*/
  	public function ascend_add_nav_fields( $menu_item ) {
  
		$menu_item->ktlgmenu = get_post_meta( $menu_item->ID, '_menu_item_ktlgmenu', true );
		$menu_item->ktcolumnmenu = get_post_meta( $menu_item->ID, '_menu_item_ktcolumnmenu', true );
		$menu_item->kticonmenu = get_post_meta( $menu_item->ID, '_menu_item_kticonmenu', true );

		return $menu_item;
      
 	}
	/**
	* Add fields to hook added in Walker
	* This will allow us to play nicely with any other plugin that is adding the same hook
	*/
  	public function ascend_custom_nav_fields( $item_id, $item, $depth, $args ) {

    	?>

		<p class="field-ktlgmenu ktlgmenu description-wide ktlgmenu-wide" style="clear:both">
		<label for="edit-menu-item-ktlgmenu-<?php echo esc_attr($item_id); ?>">
		   <input type="checkbox" id="edit-menu-item-ktlgmenu-<?php echo esc_attr($item_id); ?>" value="enabled" name="menu-item-ktlgmenu[<?php echo esc_attr($item_id); ?>]"  <?php checked( $item->ktlgmenu, 'enabled' ); ?>  />
		    <?php _e( 'Enable Mega Sub-Menu', 'ascend' ); ?>
		</label>
		</p>
		<p class="field-ktcolumnmenu description-wide ktcolumnmenu ktcolumnmenu-wide" style="clear:both">
		  <label for="edit-menu-item-ktcolumnmenu-<?php echo esc_attr($item_id); ?>">
		      <?php _e( 'Submenu Number of Columns', 'ascend'); ?>
		      <select id="edit-menu-item-ktcolumnmenu-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-ktcolumnmenu" name="menu-item-ktcolumnmenu[<?php echo esc_attr($item_id); ?>]">
		        <option value="2" <?php selected( $item->ktcolumnmenu, '2' ); ?>>2</option>
		        <option value="3" <?php selected( $item->ktcolumnmenu, '3' ); ?>>3</option>
		        <option value="4" <?php selected( $item->ktcolumnmenu, '4' ); ?>>4</option>
		      </select>
		  </label>
		</p>
		<p class="field-kticonmenu description description-thin">
		  <label for="edit-menu-item-kticonmenu-<?php echo esc_attr($item_id); ?>">
		      <?php _e( 'Icon Class (e.g. kt-icon-home)', 'ascend' ); ?><br />
		      <input type="text" id="edit-menu-item-kticonmenu-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-kticonmenu[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->kticonmenu ); ?>" />
		  </label>
		</p>
    <?php
  }
	/**
	* Save menu custom fields
	*
	* @access      public
	* @since       1.0 
	* @return      void
	*/
  	function ascend_update_nav_fields( $menu_id, $menu_item_db_id, $args ) {
  
      	// Check if element is properly sent
	    if(isset( $_REQUEST['menu-item-ktlgmenu'][$menu_item_db_id] ) ) {
	    	$value = sanitize_title(wp_unslash($_REQUEST['menu-item-ktlgmenu'][$menu_item_db_id]));
	    	update_post_meta( $menu_item_db_id, '_menu_item_ktlgmenu', $value );
	    } else {
	    	delete_post_meta($menu_item_db_id, '_menu_item_ktlgmenu');
	    }
      
      	if( isset( $_REQUEST['menu-item-ktcolumnmenu'][$menu_item_db_id] ) ) {
      		$valuecolumn = absint($_REQUEST['menu-item-ktcolumnmenu'][$menu_item_db_id]);
          	update_post_meta( $menu_item_db_id, '_menu_item_ktcolumnmenu', $valuecolumn );
        } else {
        	delete_post_meta($menu_item_db_id, '_menu_item_ktcolumnmenu');
        }

     	if( isset( $_REQUEST['menu-item-kticonmenu'][$menu_item_db_id] ) ) {
          	$valueicon = sanitize_title(wp_unslash($_REQUEST['menu-item-kticonmenu'][$menu_item_db_id]));
          	update_post_meta( $menu_item_db_id, '_menu_item_kticonmenu', $valueicon );
        } else {
        	delete_post_meta($menu_item_db_id, '_menu_item_kticonmenu');
        }
      
  	}
  
	/**
	* Define new Walker edit
	*
	* @access      public
	* @since       1.0 
	* @return      void
	*/
  	function ascend_edit_admin_walker($walker) {
  
      	return 'Ascend_Walker_Nav_Menu_Custom';
      
  	}

}
function ascend_custom_menu() {
	return Ascend_custom_menu::instance();
}

// instantiate plugin's class
$GLOBALS['ascend_custom_menu'] = ascend_custom_menu();