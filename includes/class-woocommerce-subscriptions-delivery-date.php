<?php

/**
 * This file defines the core plugin class
 *
 * @link       https://www.linkedin.com/in/ans-mehmood-dev
 * @since      1.0.0
 *
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/includes
 */


/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woocommerce_Subscriptions_Delivery_Date
 * @subpackage Woocommerce_Subscriptions_Delivery_Date/includes
 * @author     Ans Mehmood <ansmehmood.workmail@gmail.com>
 */
class Woocommerce_Subscriptions_Delivery_Date {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woocommerce_Subscriptions_Delivery_Date_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'WOOCOMMERCE_SUBSCRIPTIONS_DELIVERY_DATE_VERSION' ) ) {

			$this->version = WOOCOMMERCE_SUBSCRIPTIONS_DELIVERY_DATE_VERSION;
		} else {
			
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woocommerce-subscriptions-delivery-date';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocommerce_Subscriptions_Delivery_Date_Loader. Orchestrates the hooks of the plugin.
	 * - Woocommerce_Subscriptions_Delivery_Date_i18n. Defines internationalization functionality.
	 * - Woocommerce_Subscriptions_Delivery_Date_Admin. Defines all hooks for the admin area.
	 * - Woocommerce_Subscriptions_Delivery_Date_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-subscriptions-delivery-date-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-subscriptions-delivery-date-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-subscriptions-delivery-date-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocommerce-subscriptions-delivery-date-public.php';

		$this->loader = new Woocommerce_Subscriptions_Delivery_Date_Loader();

	}


	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocommerce_Subscriptions_Delivery_Date_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocommerce_Subscriptions_Delivery_Date_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woocommerce_Subscriptions_Delivery_Date_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_product_options_general_product_data', $plugin_admin, 'add_delivery_date_field' );
		$this->loader->add_action( 'woocommerce_process_product_meta', $plugin_admin, 'save_delivery_date_field' );
	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woocommerce_Subscriptions_Delivery_Date_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_before_add_to_cart_button', $plugin_public,'display_recurring_dates' );
		$this->loader->add_filter( 'woocommerce_add_cart_item_data', $plugin_public, 'add_delivery_date_to_cart_item', 10, 2 );
		$this->loader->add_filter( 'woocommerce_get_item_data', $plugin_public, 'display_delivery_date_cart', 10, 2 );
		$this->loader->add_filter( 'woocommerce_cart_item_name', $plugin_public, 'add_delivery_date_cart_editable' );
		$this->loader->add_action( 'woocommerce_update_cart_action_cart_updated', $plugin_public, 'update_delivery_date_cart' );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();
	}


	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;
	}


	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woocommerce_Subscriptions_Delivery_Date_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;
	}


	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;
	}

}
