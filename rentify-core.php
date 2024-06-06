<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webpenter.com
 * @since             1.0.0
 * @package           Rentify_Core
 *
 * @wordpress-plugin
 * Plugin Name:       Rentify Core
 * Plugin URI:        https://rentify.webpenter.com
 * Description:       A theme for Real Estate Rental Businesses.
 * Version:           1.0.0
 * Author:            WebPenter
 * Author URI:        https://webpenter.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rentify-core
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
define( 'RENTIFY_CORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rentify-core-activator.php
 */
function activate_rentify_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rentify-core-activator.php';
	Rentify_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rentify-core-deactivator.php
 */
function deactivate_rentify_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rentify-core-deactivator.php';
	Rentify_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rentify_core' );
register_deactivation_hook( __FILE__, 'deactivate_rentify_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rentify-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rentify_core() {

	$plugin = new Rentify_Core();
	$plugin->run();

}
run_rentify_core();
