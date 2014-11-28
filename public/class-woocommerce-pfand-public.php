<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.nerdissimo.de
 * @since      1.0.0
 *
 * @package    Woocommerce_Pfand
 * @subpackage Woocommerce_Pfand/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Pfand
 * @subpackage Woocommerce_Pfand/public
 * @author     Daniel Kay <daniel@nerdissimo.de>
 */
class Woocommerce_Pfand_Public {

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
	 * @var      string    $woocommerce_pfand       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $woocommerce_pfand, $version ) {

        $this->woocommerce_pfand = $woocommerce_pfand;
        $this->version = $version;

        add_filter( 'woocommerce_get_price_suffix', array( $this, 'add_deposit_value_to_price_suffix' ), 10, 2 );
        add_filter( 'woocommerce_cart_item_price', array( $this, 'add_deposit_value_to_cart_item_price' ), 10, 3 );
        add_filter( 'woocommerce_cart_item_subtotal', array( $this, 'add_deposit_value_to_cart_item_subtotal' ), 10, 3 );

        add_action( 'woocommerce_cart_calculate_fees', array( $this, 'add_deposit_value_to_totals' ) );

	}

    /**
     * Adds deposit value to price displays
     * e.g. archive, content, single, cart
     *
     * @since   1.0.0
     */
    function add_deposit_value_to_price_suffix( $price_display_suffix, $product ) {

        $dep_total = $this->get_deposit( $product->id );

        if( ! empty( $dep_total ) ) {

            // Remove </small>
            $price_display_suffix = preg_replace( '/<\/small>/', '', $price_display_suffix, 1 );

            $price_display_suffix .= '<br />';
            $price_display_suffix .= sprintf( __( 'plus deposit of %s', $this->woocommerce_pfand ), wc_price( $dep_total ) );

            $price_display_suffix .= '</small>';

        }

        return $price_display_suffix;
    }

    /**
     * Adds deposit value to item price displays in the cart
     *
     * @since   1.0.0
     */
    function add_deposit_value_to_cart_item_price( $product_price, $values, $cart_item_key ) {
 
        $dep_total = $this->get_deposit( $values['product_id'] );

        if( ! empty( $dep_total ) ) {
            return $product_price . '<br /><small class="deposit_label">' .  sprintf( __( 'plus deposit of %s', $this->woocommerce_pfand ), wc_price( $dep_total ) ) . '</small>';
        }
 
        return $product_price;
    }

    /**
     * Adds deposit value to subtotal display in cart
     *
     * @since   1.0.0
     */
    function add_deposit_value_to_cart_item_subtotal( $product_price, $values, $cart_item_key ) {
 
        $dep_total = $this->get_deposit( $values['product_id'], $values['quantity'] );

        if( ! empty( $dep_total ) ) {
            return $product_price . '<br /><small class="deposit_label">' .  sprintf( __( 'plus deposit of %s', $this->woocommerce_pfand ), wc_price( $dep_total ) ) . '</small>';
        }
 
        return $product_price;
    }

    /**
     * Adds deposit value to totals
     */
    function add_deposit_value_to_totals() {
        global $woocommerce;

        $dep_total = 0;
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $dep_total = $dep_total + $this->get_deposit( $cart_item['product_id'], $cart_item['quantity'] );
        }

        $woocommerce->cart->add_fee( __( 'Deposit Total', $this->woocommerce_pfand ), $dep_total );
    }

    /**
     * Function to calculate deposits
     *
     * @since   1.0.0
     */
    function get_deposit( $id, $quantity = 1 ) {

        $terms = get_the_terms( $id, 'product_deptype' );

        if( $terms && ! is_wp_error( $terms ) ) {
            $dep_total = 0;
            foreach( $terms as $term ) {
                $dep_total = $dep_total + $term->name;
            }
        }  

        if( $dep_total > 0 ) {
            $dep_total = $dep_total * $quantity;
            return $dep_total;
        }

        return false;
    }

}
