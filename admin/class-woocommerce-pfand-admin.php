<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Pfand
 * @subpackage Woocommerce_Pfand/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Pfand
 * @subpackage Woocommerce_Pfand/admin
 * @author     Daniel Kay <daniel@nerdissimo.de>
 */
class Woocommerce_Pfand_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $woocommerce_pfand    The ID of this plugin.
	 */
	private $woocommerce_pfand;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $woocommerce_pfand       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $woocommerce_pfand, $version ) {

		$this->woocommerce_pfand = $woocommerce_pfand;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Pfand_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Pfand_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->woocommerce_pfand, plugin_dir_url( __FILE__ ) . 'css/woocommerce-pfand-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Pfand_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Pfand_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->woocommerce_pfand, plugin_dir_url( __FILE__ ) . 'js/woocommerce-pfand-admin.js', array( 'jquery' ), $this->version, false );

	}

}
