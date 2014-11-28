<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.nerdissimo.de
 * @since             1.0.0
 * @package           Woocommerce_Pfand
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Pfand
 * Plugin URI:        http://www.nerdissimo.de
 * Description:       This plugin makes it easy to add Deposits (Pfand) to WooCommerce products
 * Version:           1.0.0
 * Author:            Nerdissimo
 * Author URI:        http://www.nerdissimo.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-pfand
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-pfand-activator.php
 */
function activate_woocommerce_pfand() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-pfand-activator.php';
	Woocommerce_Pfand_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-pfand-deactivator.php
 */
function deactivate_woocommerce_pfand() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-pfand-deactivator.php';
	Woocommerce_Pfand_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_pfand' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_pfand' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-pfand.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_pfand() {

	$plugin = new Woocommerce_Pfand();
	$plugin->run();

}
run_woocommerce_pfand();
