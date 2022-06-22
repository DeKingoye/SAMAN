<?php 
defined( 'ABSPATH' ) || exit();
global $post;
if( !class_exists( 'OVAEX_Admin_Assets' ) ){
	class OVAEX_Admin_Assets{

		public function __construct(){

			add_action( 'admin_footer', array( $this, 'enqueue_scripts' ), 10, 2 );

		}

		public function enqueue_scripts(){

			// Init Css Admin
			wp_enqueue_style( 'ovaex-admin-style', OVAEX_PLUGIN_URI.'assets/css/admin/ovaex-admin-style.css' );

			// Init JS Admin
			wp_enqueue_script( 'ovaex-admin-script', OVAEX_PLUGIN_URI.'assets/js/admin/ovaex-admin-script.js', array('jquery'), false, true );

			// Jquery UI
			wp_enqueue_style( 'jquery-ui', OVAEX_PLUGIN_URI.'assets/libs/jquery-ui/jquery-ui.min.css' );
			wp_enqueue_script( 'jquery-ui-tabs' );

			// Jquery Datetimepicker
			wp_enqueue_style( 'datetimepicker-style', OVAEX_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.css' );
			wp_enqueue_script( 'datetimepicker-script', OVAEX_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.js', array('jquery'), false, true );

		}
	}
	new OVAEX_Admin_Assets();
}