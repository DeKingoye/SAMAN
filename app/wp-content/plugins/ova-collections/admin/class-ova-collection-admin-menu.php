<?php
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVACOLL_admin_menu' ) ){

	class OVACOLL_admin_menu{

		public function __construct(){
			$this->init();
		}

		public function init(){
			add_action( 'admin_menu', array( $this, 'OVACOLL_register_menu' ) );
		}

		public function OVACOLL_register_menu(){

			// Get Options
			
			add_menu_page( 
				__( 'Collections', 'ova-collection' ), 
				__( 'Collections', 'ova-collection' ), 
				'edit_posts', 
				'ova-collection-menu', 
				null,
				'dashicons-calendar-alt', 
				4
			);

			add_submenu_page( 
				'ova-collection-menu', 
				__( 'Type', 'ova-collection' ), 
				__( 'Type', 'ova-collection' ), 
				'administrator', 
				'edit-tags.php?taxonomy=type'.'&post_type=collection'
			);

			add_submenu_page( 
				'ova-collection-menu', 
				__( 'Location', 'ova-collection' ), 
				__( 'Location', 'ova-collection' ), 
				'administrator', 
				'edit-tags.php?taxonomy=location'.'&post_type=collection'
			);

			add_submenu_page( 
				'ova-collection-menu', 
				__( 'Settings', 'ova-collection' ),
				__( 'Settings', 'ova-collection' ),
				'administrator',
				'settings_collection',
				array( 'OVACOLL_Admin_Settings', 'create_admin_setting_page' )
			);
		}

	}
	new OVACOLL_admin_menu();

}