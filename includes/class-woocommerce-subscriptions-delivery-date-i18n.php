<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linkedin.com/in/ans-mehmood-dev
 * @since      1.0.0
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/includes
 * @author     Ans Mehmood <ansmehmood.workmail@gmail.com>
 */
class Woocommerce_Subscriptions_Delivery_Date_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-subscriptions-delivery-date',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
