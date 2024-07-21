<?php

/**
 * @link              https://www.linkedin.com/in/ans-mehmood-dev
 * @since             1.0.0
 * @package           Woocommerce_Subscriptions_Delivery_Date
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Subscriptions Delivery Date
 * Plugin URI:        https://wordpress.org
 * Description:       This plugin adds a “Delivery Date” field to both simple and variable subscription products. This field will allow admins to set a recurring delivery date (e.g., the 3rd day of every 2 weeks or 1st day of every month). The next 3 recurring dates should be displayed on the product page in a drop-down menu. The selected date should be displayed and editable in the cart page.
 * Version:           1.0.0
 * Author:            Ans Mehmood
 * Author URI:        https://www.linkedin.com/in/ans-mehmood-dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-subscriptions-delivery-date
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die( "Congross are not allowed to jump in here!" );
}


/**
 * Currently plugin version.
 */
define( 'WOOCOMMERCE_SUBSCRIPTIONS_DELIVERY_DATE_VERSION', '1.0.0' );


/**
 * The code that runs on plugin activation.
 * This action is documented in includes/class-woocommerce-subscriptions-delivery-date-activator.php
 */
function activate_woocommerce_subscriptions_delivery_date() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-subscriptions-delivery-date-activator.php';
	Woocommerce_Subscriptions_Delivery_Date_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_subscriptions_delivery_date' );


/**
 * The code that runs on plugin deactivation.
 * This action is documented in includes/class-woocommerce-subscriptions-delivery-date-deactivator.php
 */
function deactivate_woocommerce_subscriptions_delivery_date() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-subscriptions-delivery-date-deactivator.php';
	Woocommerce_Subscriptions_Delivery_Date_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_woocommerce_subscriptions_delivery_date' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-subscriptions-delivery-date.php';


/**
 * Execution of the plugin starts here.
 *
 * @since    1.0.0
 */
function run_woocommerce_subscriptions_delivery_date() {

	$plugin = new Woocommerce_Subscriptions_Delivery_Date();
	$plugin->run();

}
run_woocommerce_subscriptions_delivery_date();