<?php
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAMT_admin_menu' ) ){

	class OVAMT_admin_menu{

		public function __construct(){
			$this->init();
		}

		public function init(){
			add_action( 'admin_menu', array( $this, 'OVAEV_register_menu' ) );
		}

		public function OVAEV_register_menu(){

			// Get Options
			
			add_menu_page( 
				__( 'Manage Ticket', 'ovamt' ), 
				__( 'Manage Ticket', 'ovamt' ), 
				'manage_options',
				'manage-ticket', 
				'ovamt_display_booking',
				'dashicons-calendar', 
				4
			);

			add_submenu_page( 
				'manage-ticket', 
				__( 'Settings', 'ovamt' ),
				__( 'Settings', 'ovamt' ),
				'manage_options',
				'ovamt_general_settings',
				array( 'OVAMT_Admin_Settings', 'create_admin_setting_page' )
			);

		}

	}
	new OVAMT_admin_menu();

}