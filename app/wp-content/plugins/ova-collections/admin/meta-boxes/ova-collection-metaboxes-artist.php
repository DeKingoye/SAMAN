<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVACOLL_metaboxes_render_artist' ) ){

	class OVACOLL_metaboxes_render_artist{

		public static function render(){

			require_once( OVACOLL_PLUGIN_PATH. '/admin/views/ova-collection-metabox-artist.php' );

		}

		public static function save($post_id, $post_data){

			if( empty($post_data) ) exit();

			foreach ($post_data as $key => $value) {
				update_post_meta( $post_id, $key, $value );
			}

			// $artist_name = $_POST['artist_name'];
			// update_post_meta( $post_id, 'artist_name', $artist_name );
		}
	}
}
?>