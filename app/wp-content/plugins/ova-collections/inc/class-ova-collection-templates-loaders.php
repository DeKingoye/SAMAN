<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVACOLL_templates_loader {
	
	/**
	 * The Constructor
	 */
	public function __construct() {


		


		add_filter( 'template_include', array( $this, 'template_loader' ) );
		
	}

	

	public function template_loader( $template ) {

		$post_type = isset($_REQUEST['post_type'] ) ? esc_html( $_REQUEST['post_type'] ) : get_post_type();

		
		if( is_tax( 'type' ) ||  get_query_var( 'type' ) != '' ){

			$paged = get_query_var('paged') ? get_query_var('paged') : '1';
			
			query_posts( '&type='.get_query_var( 'type' ).'&paged=' . $paged );
			ovacoll_get_template( 'archive-collection.php' );
			return false;
		}

		if( is_tax( 'location' ) ||  get_query_var( 'location' ) != '' ){

			$paged = get_query_var('paged') ? get_query_var('paged') : '1';
			
			query_posts( '&location='.get_query_var( 'location' ).'&paged=' . $paged );
			ovacoll_get_template( 'archive-collection.php' );
			return false;
		}

		// Is Collection Post Type
		if(  $post_type == 'collection' ){

			if ( is_post_type_archive( 'collection' ) || is_tax( 'collection' ) ) { 

				ovacoll_get_template( 'archive-collection.php' );
				return false;

			} else if ( is_single() ) {

				ovacoll_get_template( 'single-collection.php' );
				return false;

			}
		}

		// Is Artist Post Type
		if(  $post_type == 'artist' ){

			if ( is_post_type_archive( 'artist' ) || is_tax( 'artist' ) ) { 

				ovacoll_get_template( 'archive-artist.php' );
				return false;

			} else if ( is_single() ) {

				ovacoll_get_template( 'single-artist.php' );
				return false;

			}
		}

		if ( $post_type !== 'collection' && $post_type !== 'artist'){
			return $template;
		}
	}
}

new OVACOLL_templates_loader();
