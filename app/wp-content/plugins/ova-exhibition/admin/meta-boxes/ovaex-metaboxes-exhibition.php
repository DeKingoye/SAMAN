<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEX_metaboxes_render_exhibition' ) ){

	class OVAEX_metaboxes_render_exhibition{

		public static function render(){

			require_once( OVAEX_PLUGIN_PATH. '/admin/views/ovaex-metabox-exhibition.php' );

		}

		public static function save($post_id, $post_data){
			
			if( empty($post_data) ) exit();

			// Checked Special
			if( array_key_exists('ovaex_special', $post_data) == false ){
				$post_data['ovaex_special'] = '';
			}else{
				$post_data['ovaex_special'] = 'checked';
			}

			// Check gallery exits
			if( !$post_data['ovaex_gallery_id'] ){
				$post_data['ovaex_gallery_id'] = '';
			}
			
			foreach ($post_data as $key => $value) {

				if($key == 'ex_start_date') $value = strtotime($value);
				if($key == 'ex_end_date') $value = strtotime($value);
				
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
?>