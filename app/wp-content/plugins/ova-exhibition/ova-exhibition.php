<?php
/*
Plugin Name: Ovatheme Exhibition
Plugin URI: https://themeforest.net/user/ovatheme
Description: Ovatheme Exhibition
Author: Ovatheme
Version: 1.0.8
Author URI: https://themeforest.net/user/ovatheme/portfolio
Text Domain: ovaex
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) exit();



if (!class_exists('OVAEX')) {
	
	class OVAEX
	{
		static $_instance = null;

		function __construct()
		{
			$this -> define_constants();
			$this -> includes();
			$this -> supports();
			$this -> rewirte_slug();
		}

		function define_constants(){
			$this->define( 'OVAEX_PLUGIN_FILE', __FILE__ );
			$this->define( 'OVAEX_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
			$this->define( 'OVAEX_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			load_plugin_textdomain( 'ovaex', false, basename( dirname( __FILE__ ) ) .'/languages' ); 
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

		function includes() {

			// inc
			require_once( OVAEX_PLUGIN_PATH.'inc/class-ovaex-assets.php' );

			require_once( OVAEX_PLUGIN_PATH.'inc/class-ovaex-custom-post-type.php' );

			require_once( OVAEX_PLUGIN_PATH.'inc/class-ovaex-get-data.php' );

			require_once( OVAEX_PLUGIN_PATH.'inc/class-ovaex-settings.php' );

			require_once( OVAEX_PLUGIN_PATH.'inc/class-ovaex-templates-loaders.php' );

			require_once( OVAEX_PLUGIN_PATH.'inc/ovaex-core-functions.php' );


			// admin
			if( is_admin() ){
				require_once( OVAEX_PLUGIN_PATH.'admin/class-ovaex-metaboxes.php' );
				require_once( OVAEX_PLUGIN_PATH.'admin/class-ovaex-admin.php' );
			}
		}

		function supports() {

			/* Make Elementors */
			if ( did_action( 'elementor/loaded' ) ) {
				include OVAEX_PLUGIN_PATH.'elementor/class-ovaex-register-elementor.php';
			}
		}

		public function rewirte_slug(){

			add_filter( 'register_post_type_args', array($this, 'ovaex_change_post_types_slug' ), 10, 2 );

		}

		public function ovaex_change_post_types_slug( $args, $post_type ) {
			
		   // Exhibition Slug
			$exhibition_slug = 'exhibition';
			$exhibition_rewrite_slug = OVAEX_Settings::ovaex_exhibition_post_type_rewrite_slug();
			if ( $exhibition_slug === $post_type && $exhibition_slug != $exhibition_rewrite_slug && $exhibition_rewrite_slug != '' ) {
				$args['rewrite']['slug'] = $exhibition_rewrite_slug;
			}

			return $args;
		}

	}
}

function OVAEX() {
	return OVAEX::instance();
}

$GLOBALS['OVAEX'] = OVAEX();