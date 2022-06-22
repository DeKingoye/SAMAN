<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEX_metaboxes' ) ){

	class OVAEX_metaboxes{

		public function __construct(){

			$this->require_metabox();


			add_action( 'add_meta_boxes', array( $this , 'OVAEX_add_metabox' ) );

			add_action( 'save_post', array( $this , 'OVAEX_save_metabox' ) );


			// Save
			add_action( 'ovaex_update_meta_exhibition', array( 'OVAEX_metaboxes_render_exhibition' ,'save' ), 10, 2 );

		}


		public function require_metabox(){

			require_once( OVAEX_PLUGIN_PATH.'admin/meta-boxes/ovaex-metaboxes-exhibition.php' );

		}

		function OVAEX_add_metabox() {

			add_meta_box( 'ovaex-metabox-settings-exhibition',
				'Exhibitions',
				array('OVAEX_metaboxes_render_exhibition', 'render'),
				'exhibition',
				'normal',
				'high'
			);

		}

		

		function OVAEX_save_metabox($post_id) {

			// Bail if we're doing an auto save
			if ( empty( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) return;

			// if our nonce isn't there, or we can't verify it, bail
			if( !isset( $_POST['ovaex_nonce'] ) || !wp_verify_nonce( $_POST['ovaex_nonce'], 'ovaex_nonce' ) ) return;

			do_action( 'ovaex_update_meta_exhibition', $post_id, $_POST );
			
		}

	}

	new OVAEX_metaboxes();

}
?>