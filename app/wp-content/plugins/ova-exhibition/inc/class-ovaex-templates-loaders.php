<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAEX_templates_loader {
	
	/**
	 * The Constructor
	 */
	public function __construct() {


		


		add_filter( 'template_include', array( $this, 'template_loader' ) );
		
	}

	

	public function template_loader( $template ) {

		$post_type = isset($_REQUEST['post_type'] ) ? esc_html( $_REQUEST['post_type'] ) : get_post_type();

		
		// Is Exhibition Post Type
		if(  $post_type == 'exhibition' ){

			if ( is_post_type_archive( 'exhibition' ) ) { 

				ovaex_get_template( 'archive-exhibition.php' );
				return false;

			} else if ( is_single() ) {
				ovaex_get_template( 'single-exhibition.php' );
				return false;

			}
		}

		
		if ( $post_type !== 'exhibition'){

			return $template;
		}

	}
}

new OVAEX_templates_loader();
