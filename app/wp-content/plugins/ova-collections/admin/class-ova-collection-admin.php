<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVACOLL_admin' ) ){

	/**
	 * Make Admin Class
	 */
	class OVACOLL_admin{
		public static $custom_meta_fields = array();

		/**
		 * Construct Admin
		 */
		public function __construct(){
			$this->init();

		}

		public function init(){
			require_once( OVACOLL_PLUGIN_PATH. '/admin/class-ova-collection-admin-menu.php' );
			require_once( OVACOLL_PLUGIN_PATH. '/admin/class-ova-collection-admin-assets.php' );
			require_once( OVACOLL_PLUGIN_PATH. '/admin/class-ova-collection-admin-settings.php' );
		}


	}
	new OVACOLL_admin();


	

}