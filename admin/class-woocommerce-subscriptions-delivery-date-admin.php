<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/ans-mehmood-dev
 * @since      1.0.0
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/admin
 * @author     Ans Mehmood <ansmehmood.workmail@gmail.com>
 */
class Woocommerce_Subscriptions_Delivery_Date_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-subscriptions-delivery-date-admin.css', array(), $this->version, 'all' );

	}

	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-subscriptions-delivery-date-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * This function adds the delivery date field to the product editor.
	 */
	public function add_delivery_date_field() {

		global $woocommerce, $post;
	
		echo '<div class="options_group">';
		woocommerce_wp_select( array(
			'id' => '_delivery_date_period',
			'label' => __('Delivery Date Period', 'woocommerce-subscriptions-delivery-date'),
			'options' => array(
				'every_2_weeks' => __('Every 2 Weeks', 'woocommerce-subscriptions-delivery-date'),
				'every_month' => __('Every Month', 'woocommerce-subscriptions-delivery-date'),
				'every_6_months' => __('Every 6 Months', 'woocommerce-subscriptions-delivery-date')
			)
		) );
		echo '</div>';
	}


	/**
	 * Saves the delivery date field data when the product is updated.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_delivery_date_field( $post_id ) {

		$delivery_date_period = sanitize_text_field( $_POST['_delivery_date_period'] );
		update_post_meta( $post_id, '_delivery_date_period', $delivery_date_period );
	}

}