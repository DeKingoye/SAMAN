<?php 
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVACOLL_admin_assets' ) ){
	class OVACOLL_admin_assets{

		public function __construct(){
			add_action( 'admin_footer', array( $this, 'enqueue_scripts' ), 10, 2 );
		}

		public function enqueue_scripts(){

			// Init Css Admin
			wp_enqueue_style( 'ovacoll-admin-style', OVACOLL_PLUGIN_URI.'assets/css/admin/ovacoll-admin-style.css' );

			wp_enqueue_script( 'ovacoll-admin-script', OVACOLL_PLUGIN_URI.'assets/js/admin/ovacoll-admin-script.js' );

			// Jquery UI
			wp_enqueue_style( 'jquery-ui', OVACOLL_PLUGIN_URI.'assets/libs/jquery-ui/jquery-ui.min.css' );
			wp_enqueue_script( 'jquery-ui-tabs' );
		}
	}
	new OVACOLL_admin_assets();
}
