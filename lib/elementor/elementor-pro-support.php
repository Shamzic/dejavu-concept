<?php
/**
 * Elementor Pro Support
 *
 * @package Ascend Theme
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Ascend Elementor Compatibility
 */
if ( ! class_exists( 'Ascend_Elementor_Pro' ) ) {

	/**
	 * Ascend Elementor Compatibility
	 *
	 * @since 1.2.7
	 */
	class Ascend_Elementor_Pro {

		/**
		 * Instance Control Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object Class object.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'elementor/theme/register_locations', array( $this, 'ascend_register_elementor_locations' ) );

			add_action( 'ascend_header', array( $this, 'ascend_elementor_do_header' ), 0 );
			add_action( 'ascend_footer', array( $this, 'ascend_elementor_do_footer' ), 0 );
		}

		/**
		 * Elementor Location support.
		 *
		 * @param object $elementor_theme_manager the theme manager.
		 */
		public function ascend_register_elementor_locations( $elementor_theme_manager ) {
			$elementor_theme_manager->register_location( 'header' );
			$elementor_theme_manager->register_location( 'footer' );
		}

		/**
		 * Header Support
		 *
		 * @return void
		 */
		public function ascend_elementor_do_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'ascend_header', 'ascend_header_markup' );
			}
		}

		/**
		 * Footer Support
		 *
		 * @return void
		 */
		public function ascend_elementor_do_footer() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $did_location ) {
				remove_action( 'ascend_footer', 'ascend_footer_markup' );
			}
		}
	}
	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Ascend_Elementor_Pro::get_instance();
}
