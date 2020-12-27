<?php
/**
 * Add functions files
 *
 * @package Ascend Theme
 */

define( 'ASCEND_OPTIONS_SLUG', 'ascend' );
define( 'ASCEND_LANGUAGE_SLUG', 'ascend' );

/**
 * Language setup
 */
function ascend_lang_setup() {
	load_theme_textdomain( 'ascend', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'ascend_lang_setup' );

/**
 * Init Theme Options
 */
require_once trailingslashit( get_template_directory() ) . 'themeoptions/redux/framework.php';                  // Options framework.
require_once trailingslashit( get_template_directory() ) . 'themeoptions/options.php';                          // Options settings.
require_once trailingslashit( get_template_directory() ) . 'themeoptions/options/ascend_extension.php';         // Options framework extension.

/*
 * Init Theme Startup/Core utilities/classes
 */
require_once trailingslashit( get_template_directory() ) . 'lib/init.php';                                          // Initial theme setup and constants.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-ascend-plugin-check.php';             // Sidebar class.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-ascend-sidebar.php';                  // Sidebar class.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-ascend-get-image.php';                    // Image Processing.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-ascend_walker_nav_menu_custom.php';     // Custom Walker.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-ascend_custom_menu.php';              // Custom Menu settings.
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-kadence-breadcrumbs.php'; // Breadcrumbs.
require_once trailingslashit( get_template_directory() ) . 'lib/elementor/elementor-support.php';                   // Elementor Header and Footer Compat.
require_once trailingslashit( get_template_directory() ) . 'lib/ascend-plugins-activate.php';                       // Plugin Activation.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/ascend_cmb_extensions.php';               // Custom Metaboxe Settings.
require_once trailingslashit( get_template_directory() ) . 'lib/config.php';                                        // Configuration.
require_once trailingslashit( get_template_directory() ) . 'lib/config-pagetitle.php';                                  // Page title Configuration.
require_once trailingslashit( get_template_directory() ) . 'lib/config-sidebar.php';                                // Sidebar Configuration.
require_once trailingslashit( get_template_directory() ) . 'lib/image_functions.php';                               // Image Functions.
require_once trailingslashit( get_template_directory() ) . 'lib/ascend_slider.php';                                     // Build Slider.
require_once trailingslashit( get_template_directory() ) . 'lib/ascend_collage_gallery.php';                            // Build collage.

/*
 * Init Custom post type, metaboxes
 */
require_once trailingslashit( get_template_directory() ) . 'lib/cleanup.php';                                       // Cleanup
require_once trailingslashit( get_template_directory() ) . 'lib/nav.php';                                           // Custom nav modifications
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/post-metaboxes.php';                  // Custom metaboxes.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/sidebar-metaboxes.php';               // Custom metaboxes.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/page-template-blog-metaboxes.php';        // Custom metaboxes.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/portfolio-metaboxes.php';                 // Custom metaboxes.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/pagesetting-metaboxes.php';               // Custom metaboxes.
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes/postheader-metaboxes.php';                // Custom metaboxes.

/*
 * Init Widgets
 */
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/class-ascend_contact_widget.php';           // Contact Widget.
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/class-ascend_recent_posts_widget.php';          // Recent Posts Widget.
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/class-ascend_post_grid_widget.php';             // Post Grid Widget.
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/class-ascend_social_widget.php';                // Social Widget.
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/class-ascend_image_widget.php';                 // Image Widget.
require_once trailingslashit( get_template_directory() ) . 'lib/widgets/widget_setup.php';                              // Widget Setup.

/*
 * Template Hooks
 */
require_once trailingslashit( get_template_directory() ) . 'lib/custom.php';                                    // Custom functions.
require_once trailingslashit( get_template_directory() ) . 'lib/pagebuilder.php';                               // Pagebuilder Extensions.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/breadcrumbs.php';                    // Breadcrumbs.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/authorbox.php';                  // Author box.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/posts.php';                      // Posts Template Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/portfolio.php';                  // Portfolio Template Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/hooks_page.php';                     // Page Template Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/hooks_header.php';               // Header Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/hooks_mobile_header.php';            // Mobile Header Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/hooks_topbar_header.php';            // Topbar Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/hooks_footer.php';               // Footer Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/posts_list.php';                     // Post List Hooks.
require_once trailingslashit( get_template_directory() ) . 'lib/template_hooks/archive.php';                        // Archive Hooks.

/*
* Woomcommerce Support
*/
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-support.php';                   // Woocommerce functions.
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-archive-hooks.php';                 // Woocommerce archive functions.
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-single-product-hooks.php';      // Woocommerce Single Product.
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-account.php';                   // Woocommerce My Account.
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/woo-cart.php';                      // Woocommerce Cart.

/*
 * Load Scripts
 */
require_once trailingslashit( get_template_directory() ) . 'lib/admin-scripts.php'; // Admin Scripts.
require_once trailingslashit( get_template_directory() ) . 'lib/scripts.php';       // Front End Scripts and stylesheets.
require_once trailingslashit( get_template_directory() ) . 'lib/output_css.php';    // Fontend Custom CSS.

/**
 * Note: Do not add any custom code here. Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 * https://www.kadencewp.com/child-themes/
 */

