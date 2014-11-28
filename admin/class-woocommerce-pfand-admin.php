<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://www.nerdissimo.de
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
     * Register custom taxonomy
     *
     * @since   1.0.0
     */
    public function deposit_taxonomy() {

        $labels = array( 
            'name' => _x( 'Deposit Types', 'taxonomy general name', $this->woocommerce_pfand ),
            'singular_name' => _x( 'Deposit Type', 'taxonomy singular name', $this->woocommerce_pfand ),
            'menu_name' => _x( 'Deposit Types', 'admin menu', $this->woocommerce_pfand ),
            'name_admin_bar' => _x( 'Add New Deposit Type', 'add new on admin bar', $this->woocommerce_pfand ),
            'add_new_item' => _x( 'Add New Deposit Type', 'add new on admin menu', $this->woocommerce_pfand ),
            'search_items' => __( 'Search Deposit Types', $this->woocommerce_pfand ),
            'popular_items' => __( 'Popular Deposit Types', $this->woocommerce_pfand ),
            'all_items' => __( 'All Deposit Types', $this->woocommerce_pfand ),
            'parent_item' => __( 'Parent Deposit Type', $this->woocommerce_pfand ),
            'parent_item_colon' => __( 'Parent Deposit Type:', $this->woocommerce_pfand ),
            'edit_item' => __( 'Edit Deposit Type', $this->woocommerce_pfand ),
            'update_item' => __( 'Update Deposit Type', $this->woocommerce_pfand ),
            'new_item_name' => __( 'New Deposit Type', $this->woocommerce_pfand ),
            'separate_items_with_commas' => __( 'Separate deposit types with commas', $this->woocommerce_pfand ),
            'add_or_remove_items' => __( 'Add or remove Deposit Types', $this->woocommerce_pfand ),
            'choose_from_most_used' => __( 'Choose from most used Deposit Types', $this->woocommerce_pfand ),
        );

        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => false,
            'show_admin_column' => false,
            'hierarchical' => false,
            'rewrite' => false,
            'query_var' => true
        );

        register_taxonomy( 'product_deptype', array( 'product' ), $args );
    }

}
