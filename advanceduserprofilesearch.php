<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Advanceduserprofilesearch
 *
 * @wordpress-plugin
 * Plugin Name:      Advanced User Profile Search Plugin
 * Plugin URI:        : https://webdesign-studenten.nl/nl/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Webdesign Studenten
 * Author URI:        : https://webdesign-studenten.nl/nl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       advanceduserprofilesearch
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ADVANCEDUSERPROFILESEARCH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-advanceduserprofilesearch-activator.php
 */
function activate_advanceduserprofilesearch() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanceduserprofilesearch-activator.php';

	Advanceduserprofilesearch_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-advanceduserprofilesearch-deactivator.php
 */
function deactivate_advanceduserprofilesearch() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanceduserprofilesearch-deactivator.php';
	Advanceduserprofilesearch_Deactivator::deactivate();
}
function some_woocommerce_addon_activate() {
  
    if( !class_exists( 'WooCommerce' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die( __( 'Please install and Activate WooCommerce. (WooCommerce Plugin is required for this plugin)', 'woocommerce-addon-slug' ), 'Plugin dependency check', array( 'back_link' => true ) );
    }
}

//sets up activation hook
register_activation_hook(__FILE__, 'some_woocommerce_addon_activate');
register_activation_hook( __FILE__, 'activate_advanceduserprofilesearch' );
register_deactivation_hook( __FILE__, 'deactivate_advanceduserprofilesearch' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-advanceduserprofilesearch.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_advanceduserprofilesearch() {

	$plugin = new Advanceduserprofilesearch();
	$plugin->run();

}
run_advanceduserprofilesearch();
