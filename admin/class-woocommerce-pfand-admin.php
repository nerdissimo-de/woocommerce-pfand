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

        add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 50 ); 
        add_action( 'woocommerce_settings_tabs_deposit', array( $this, 'settings_tab' ) ); 
        add_action( 'woocommerce_update_options_deposit', array( $this, 'update_settings' ) );

        add_filter( 'manage_edit-product_deptype_columns', array( $this, 'deptype_columns' ) ); 

    }

    /** 
     * Adds a new settings tab to the WooCommerce settings tabs array. 
     *
     * @since   2.0.0
     */ 
    function add_settings_tab( $settings_tabs ) { 
        $settings_tabs['deposit'] = __( 'Deposit', $this->woocommerce_pfand ); 
        return $settings_tabs; 
    } 
 
    /** 
     * Uses the WooCommerce admin fields API to output settings via the woocommerce_admin_fields() function. 
     *
     * @since   2.0.0
     */ 
    function settings_tab() { 
        woocommerce_admin_fields( $this->get_settings() ); 
    } 
 
    /** 
     * Uses the WooCommerce options API to save settings via the woocommerce_update_options() function. 
     *
     * @since   2.0.0
     */ 
    function update_settings() { 
        woocommerce_update_options( $this->get_settings() ); 
    } 
 
    /** 
     * Get all the settings for this plugin for woocommerce_admin_fields() function. 
     * 
     * @return array Array of settings for woocommerce_admin_fields() function. 
     * @since   2.0.0
     */ 
    function get_settings() { 

        // Start Section
        $settings = array( 
            'section_title' => array( 
                'name'     => __( 'Deposit', $this->woocommerce_pfand ), 
                'type'     => 'title', 
                'desc'     => '', 
                'id'       => 'wc_deposit_section_title' 
            ),
            'hide_in_loop' => array( 
                'name' => __( 'Hide in loop', $this->woocommerce_pfand ), 
                'type' => 'checkbox', 
                'desc' => __( 'If checked hides deposit display on archives and single product pages.', $this->woocommerce_pfand ), 
                'id'   => 'wc_deposit_hide_in_loop' 
            ), 
            'hide_in_cart' => array( 
                'name' => __( 'Hide in cart/checkout', $this->woocommerce_pfand ), 
                'type' => 'checkbox', 
                'desc' => __( 'If checked hides deposit display next to the product prices in the cart and checkout.', $this->woocommerce_pfand ), 
                'id'   => 'wc_deposit_hide_in_cart' 
            )
        ); 
        
        $settings = apply_filters( 'wc_deposit_settings', $settings );


        // End Section
        $settings['section_end'] = array( 
             'type' => 'sectionend', 
             'id' => 'wc_deposit_section_end' 
        );
 
        return $settings; 
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

    /**
     * Adjust columns in Admin UI
     *
     * @since   1.0.0
     */
    function deptype_columns( $columns ) {
        $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __( 'Deposit Type', $this->woocommerce_pfand ),
            'description' => __( 'Description', $this->woocommerce_pfand ),
            'posts' => __( 'Count', $this->woocommerce_pfand )
        );
        return $new_columns;
    }

}
