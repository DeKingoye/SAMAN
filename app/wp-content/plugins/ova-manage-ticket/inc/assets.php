<?php defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAMT_Assets' ) ){
	class OVAMT_Assets{

		public function __construct(){
			add_action( 'admin_footer', array( $this, 'ovamt_admin_enqueue_scripts' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( $this, 'ovamt_enqueue_script' ) );
		}

		public function ovamt_admin_enqueue_scripts(){
			
			// Script
			wp_enqueue_style( 'datetimepicker-style', OVAMT_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.css' );
			wp_enqueue_script( 'datetimepicker-script', OVAMT_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.js', array('jquery'), false, true );

			wp_enqueue_script( 'admin_script', OVAMT_PLUGIN_URI.'assets/ovamt_admin_script.js', array('jquery'), false, true );


			// Admin Css
			wp_enqueue_style('ovaem_admin_style', OVAMT_PLUGIN_URI.'/assets/ovamt_admin_style.css', array(), null);

			
		}

		public function ovamt_enqueue_script(){

			if( is_singular( 'product' ) ){
				wp_enqueue_style( 'datetimepicker-style', OVAMT_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.css' );
				wp_enqueue_script( 'datetimepicker-script', OVAMT_PLUGIN_URI.'assets/libs/datetimepicker/jquery.datetimepicker.js', array('jquery'), false, true );

				wp_enqueue_style('ovaem_style', OVAMT_PLUGIN_URI.'/assets/ovamt_style.css', array(), null);
				wp_enqueue_script( 'ovamt_script', OVAMT_PLUGIN_URI.'assets/ovamt_script.js', array('jquery'), false, true );	
			}
			

			
		}

	}
	new OVAMT_Assets();
}
