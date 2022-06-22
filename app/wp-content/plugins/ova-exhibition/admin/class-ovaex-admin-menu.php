<?php
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAEX_admin_menu' ) ){

	class OVAEX_admin_menu{

		public function __construct(){
			$this->init();
		}

		public function init(){
			add_action( 'admin_menu', array( $this, 'OVAEX_register_menu' ) );
		}

		public function OVAEX_register_menu(){

			// Get Options
			
			add_menu_page( 
				__( 'Exhibition', 'ovaex' ), 
				__( 'Exhibition', 'ovaex' ), 
				'edit_posts',
				'ovaex-menu', 
				null,
				'dashicons-calendar', 
				4
			);
			
			add_submenu_page( 
				'ovaex-menu', 
				__( 'Settings', 'ovaex' ),
				__( 'Settings', 'ovaex' ),
				'administrator',
				'ovaex_general_settings',
				array( 'OVAEX_Admin_Settings', 'create_admin_setting_page' )
			);

		}

	}
	new OVAEX_admin_menu();

}