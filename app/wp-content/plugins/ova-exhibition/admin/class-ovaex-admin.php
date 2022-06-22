<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVAEX_admin' ) ){

	/**
	 * Make Admin Class
	 */
	class OVAEX_admin{
		public static $custom_meta_fields = array();

		/**
		 * Construct Admin
		 */
		public function __construct(){
			$this->init();

		}

		public function init(){
			require_once( OVAEX_PLUGIN_PATH. '/admin/class-ovaex-admin-menu.php' );
			require_once( OVAEX_PLUGIN_PATH. '/admin/class-ovaex-admin-assets.php' );
			require_once( OVAEX_PLUGIN_PATH. '/admin/class-ovaex-admin-settings.php' );
		}


	}
	new OVAEX_admin();


	

}