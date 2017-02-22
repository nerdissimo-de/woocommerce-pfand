<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://www.nerdissimo.de
 * @since             1.0.0
 * @package           Woo_Pfand
 *
 * @wordpress-plugin
 * Plugin Name:       Pfand (Deposit) for WooCommerce Products
 * Plugin URI:        http://www.nerdissimo.de
 * Description:       This plugin makes it easy to add Deposits (Pfand) to WooCommerce products
 * Version:           2.0.0
 * Author:            Nerdissimo
 * Author URI:        http://www.nerdissimo.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-pfand
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-pfand-activator.php
 */
function activate_woo_pfand() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-pfand-activator.php';
	Woo_Pfand_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-pfand-deactivator.php
 */
function deactivate_woo_pfand() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-pfand-deactivator.php';
	Woo_Pfand_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_pfand' );
register_deactivation_hook( __FILE__, 'deactivate_woo_pfand' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-pfand.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_pfand() {

	$plugin = new Woo_Pfand();
	$plugin->run();

}
run_woo_pfand();
