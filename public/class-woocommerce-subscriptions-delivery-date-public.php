<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/ans-mehmood-dev
 * @since      1.0.0
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/public
 * @author     Ans Mehmood <ansmehmood.workmail@gmail.com>
 */
class Woocommerce_Subscriptions_Delivery_Date_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-subscriptions-delivery-date-public.css', array(), $this->version, 'all' );

	}

	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-subscriptions-delivery-date-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Thid fucntion
	 */
	public static function calculate_recurring_dates( $period ) {

		$dates = [];
		$current_date = new DateTime();
		switch ( $period ) {

			case 'every_2_weeks':
				for ( $i = 0; $i < 3; $i++ ) {
					$dates[] = $current_date->modify( '+2 weeks' )->format( 'Y-m-d' );
				}
				break;
			case 'every_month':
				for ( $i = 0; $i < 3; $i++ ) {
					$dates[] = $current_date->modify( '+1 month' )->format( 'Y-m-d' );
				}
				break;
			case 'every_6_months':
				for ( $i = 0; $i < 3; $i++ ) {
					$dates[] = $current_date->modify( '+6 months' )->format( 'Y-m-d' );
				}
				break;
		}
		return $dates;
	}


	/**
	 * Calculates recurring dates based on the period.
	 *
	 * @param string $period The period for recurring dates.
	 * @return array The calculated recurring dates.
	 */
	public function display_recurring_dates() {

		global $post;
		$period = get_post_meta( $post->ID, '_delivery_date_period', true );
		$dates = self::calculate_recurring_dates( $period );
	
		if ( !empty( $dates ) ) {

			echo '<div class="delivery-date-field">';
			echo '<label for="delivery_date">' . __( 'Select Delivery Date', 'woocommerce-subscriptions-delivery-date' ) . '</label>';
			echo '<select name="delivery_date" id="delivery_date">';
			foreach ( $dates as $date ) {

				echo '<option value="' . esc_attr( $date ) . '">' . esc_html( $date ) . '</option>';
			}
			echo '</select>';
			echo '</div>';
		}
	}


	/**
	 * Adds delivery date to cart item data.
	 *
	 * @param array $cart_item_data The cart item data.
	 * @param int $product_id The product ID.
	 * @return array The updated cart item data.
	 */
	public function add_delivery_date_to_cart_item( $cart_item_data, $product_id ) {

		if ( isset( $_POST['delivery_date'] ) ) {

			$cart_item_data['delivery_date'] = sanitize_text_field( $_POST['delivery_date'] );
		}
		return $cart_item_data;
	}


	/**
	 * Displays the delivery date in the cart (non-editable).
	 *
	 * @param array $item_data The item data.
	 * @param array $cart_item The cart item data.
	 * @return array The updated item data.
	 */
	public function display_delivery_date_cart( $item_data, $cart_item ) {

		if ( isset( $cart_item['delivery_date'] ) ) {

			$item_data[] = [
				'name' => __( 'Delivery Date', 'woocommerce-subscriptions-delivery-date' ),
				'value' => sanitize_text_field( $cart_item['delivery_date'] ),
			];
		}
		return $item_data;
	}


	/**
	 * Makes the delivery date editable in the cart.
	 *
	 * @param string $product_name The product name.
	 * @param array $cart_item The cart item data.
	 * @param string $cart_item_key The cart item key.
	 * @return string The updated product name.
	 */
	public function add_delivery_date_cart_editable( $product_name, $cart_item, $cart_item_key ) {

		if ( isset( $cart_item['delivery_date'] ) ) {

			// Fetch recurring dates based on product's delivery date period
			$period = get_post_meta( $cart_item['product_id'], '_delivery_date_period', true );
			$recurring_dates = self::calculate_recurring_dates( $period );

			// Build select dropdown for delivery date
			$delivery_date_dropdown = '<select name="cart[' . $cart_item_key . '][delivery_date]">';
			foreach ( $recurring_dates as $date ) {

				$delivery_date_dropdown .= '<option value="' . esc_attr( $date ) . '" ' . selected( $cart_item['delivery_date'], $date, false ) . '>' . esc_html( $date ) . '</option>';
			}
			$delivery_date_dropdown .= '</select>';

			// Append editable delivery date to the product name in cart
			$product_name .= '<dl class="variation">
				<dt>' . __( 'Delivery Date', 'woocommerce-subscriptions-delivery-date' ) . '</dt>
				<dd>' . $delivery_date_dropdown . '</dd>
			</dl>';
		}
		return $product_name;
	}


	/**
	 * Updates the delivery date in the cart.
	 */
	public function update_delivery_date_cart() {
		
		if ( isset( $_POST['cart'] ) ) {

			foreach ( $_POST['cart'] as $cart_item_key => $values ) {

				if ( isset( $values['delivery_date'] ) ) {

					WC()->cart->cart_contents[$cart_item_key]['delivery_date'] = sanitize_text_field( $values['delivery_date'] );
				}
			}
		}
	}

}