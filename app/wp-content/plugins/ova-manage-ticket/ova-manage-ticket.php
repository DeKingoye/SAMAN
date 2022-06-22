<?php
/*
Plugin Name: Ovatheme Manage Ticket
Plugin URI: https://themeforest.net/user/ovatheme
Description: Ovatheme Manage Ticket
Author: Ovatheme
Version: 1.0.2
Author URI: https://themeforest.net/user/ovatheme/portfolio
Text Domain: ovamt
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) exit();

if (!class_exists('OVAMT')) {
	
	class OVAMT{
		
		static $_instance = null;

		function __construct()
		{
			$this -> define_constants();

			
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				$this -> includes();
			}
			
		}

		function define_constants(){
			$this->define( 'OVAMT_PLUGIN_FILE', __FILE__ );
			$this->define( 'OVAMT_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
			$this->define( 'OVAMT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			load_plugin_textdomain( 'ovamt', false, basename( dirname( __FILE__ ) ) .'/languages' );
		}

		function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public static function instance() {
			if ( !empty( self::$_instance ) ) {
				return self::$_instance;
			}
			return self::$_instance = new self();
		}

		public function includes() {

			// JS
			include_once( OVAMT_PLUGIN_PATH.'inc/assets.php' );

			
			include_once( OVAMT_PLUGIN_PATH.'inc/function.php' );

			include_once( OVAMT_PLUGIN_PATH.'inc/process-cart.php' );


			include_once( OVAMT_PLUGIN_PATH.'admin/class-ovamt-admin-menu.php' );
			include_once( OVAMT_PLUGIN_PATH.'settings/class-ovamt-admin-settings.php' );
			include_once( OVAMT_PLUGIN_PATH.'settings/class-ovamt-settings.php' );

			include_once( OVAMT_PLUGIN_PATH.'admin/class_display_table_booking.php' );
			include_once( OVAMT_PLUGIN_PATH.'admin/class_render_table_booking.php' );
			


			
			
		}



	}
}

function OVAMT() {
	return OVAMT::instance();
}

$GLOBALS['OVAMT'] = OVAMT();