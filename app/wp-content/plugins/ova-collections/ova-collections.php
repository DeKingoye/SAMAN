<?php
/*
Plugin Name: Ovatheme Collections
Plugin URI: https://themeforest.net/user/ovatheme
Description: OvaTheme Collections
Author: Ovatheme
Version: 1.2.4
Author URI: https://themeforest.net/user/ovatheme/portfolio
Text Domain: ova-collection
Domain Path: /languages/
*/

if ( !defined( 'ABSPATH' ) ) exit();


if (!class_exists('ovacollection')) {
	
	class ovacollection
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
			$this->define( 'OVACOLL_PLUGIN_FILE', __FILE__ );
			$this->define( 'OVACOLL_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
			$this->define( 'OVACOLL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			load_plugin_textdomain( 'ova-collection', false, basename( dirname( __FILE__ ) ) .'/languages' );
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
			require_once( OVACOLL_PLUGIN_PATH.'inc/class-ova-collection-custom-post-type.php' );

			require_once( OVACOLL_PLUGIN_PATH.'inc/class-ova-collection-get-data.php' );

			require_once( OVACOLL_PLUGIN_PATH.'inc/class-ova-collection-settings.php' );

			require_once( OVACOLL_PLUGIN_PATH.'inc/ova-collection-core-functions.php' );
			
			require_once( OVACOLL_PLUGIN_PATH.'inc/class-ova-collection-templates-loaders.php' );

			require_once( OVACOLL_PLUGIN_PATH.'inc/class-ova-collection-assets.php' );


			// admin
			require_once( OVACOLL_PLUGIN_PATH.'admin/class-ova-collection-metaboxes.php' );

			if( is_admin() ){
				require_once( OVACOLL_PLUGIN_PATH.'admin/class-ova-collection-admin.php' );
			}
		}


		function supports() {

			/* Make Elementors */
			if ( did_action( 'elementor/loaded' ) ) {
				include OVACOLL_PLUGIN_PATH.'elementor/class-ova-register-elementor.php';
			}

		}


		public function rewirte_slug(){

			add_filter( 'register_post_type_args', array($this, 'ovacoll_change_post_types_collection_slug' ), 10, 2 );
			add_filter( 'register_post_type_args', array($this, 'ovacoll_change_post_types_artist_slug' ), 10, 2 );

		}


		public function ovacoll_change_post_types_collection_slug( $args, $post_type ) {

		   // Collection Slug
			$collection_slug = 'collection';
			$collection_rewrite_slug = OVACOLL_Settings::collection_post_type_rewrite_slug();
			if ( $collection_slug === $post_type && $collection_slug != $collection_rewrite_slug && $collection_rewrite_slug != '' ) {
				$args['rewrite']['slug'] = $collection_rewrite_slug;
			}

			return $args;
		}

		public function ovacoll_change_post_types_artist_slug( $args, $post_type ) {

		   // Collection Slug
			$artist_slug = 'artist';
			$artist_rewrite_slug = OVACOLL_Settings::collection_post_type_rewrite_artist_slug();
			if ( $artist_slug === $post_type && $artist_slug != $artist_rewrite_slug && $artist_rewrite_slug != '' ) {
				$args['rewrite']['slug'] = $artist_rewrite_slug;
			}

			return $args;
		}
		
	}
}

function ovacollection() {
	return ovacollection::instance();
}

$GLOBALS['ovacollection'] = ovacollection();