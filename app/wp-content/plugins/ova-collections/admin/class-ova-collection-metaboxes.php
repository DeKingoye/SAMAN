<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVACOLL_metaboxes' ) ){

	class OVACOLL_metaboxes{

		public function __construct(){

			$this->require_metabox();


			add_action( 'add_meta_boxes', array( $this , 'OVACOLL_add_metabox' ) );

			add_action( 'save_post', array( $this , 'OVACOLL_save_metabox' ) );


			// Save
			add_action( 'ova_collection_update_collection_meta_collection', array( 'OVACOLL_metaboxes_render_collection' ,'save' ), 10, 2 );

			add_action( 'ova_collection_update_collection_meta_artist', array( 'OVACOLL_metaboxes_render_artist' ,'save' ), 10, 2 );


		}


		public function require_metabox(){

			require_once( OVACOLL_PLUGIN_PATH.'admin/meta-boxes/ova-collection-metaboxes-collection.php' );

			require_once( OVACOLL_PLUGIN_PATH.'admin/meta-boxes/ova-collection-metaboxes-artist.php' );


		}

		function OVACOLL_add_metabox() {

			add_meta_box( 'ova-collection-metabox-settings',
				'Collections',
				array('OVACOLL_metaboxes_render_collection', 'render'),
				'collection',
				'normal',
				'high'
			);

			add_meta_box( 'ova-collection-metabox-settings-artist',
				'Artist',
				array('OVACOLL_metaboxes_render_artist', 'render'),
				'artist',
				'normal',
				'high'
			);


		}

		

		function OVACOLL_save_metabox($post_id) {

			// Bail if we're doing an auto save
			if ( empty( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) return;

			// if our nonce isn't there, or we can't verify it, bail
			if( !isset( $_POST['ova_collection_nonce'] ) || !wp_verify_nonce( $_POST['ova_collection_nonce'], 'ova_collection_nonce' ) ) return;

			do_action( 'ova_collection_update_collection_meta_collection', $post_id, $_POST );

			do_action( 'ova_collection_update_collection_meta_artist', $post_id, $_POST );	
			
		}

		

	}


	new OVACOLL_metaboxes();

}
?>