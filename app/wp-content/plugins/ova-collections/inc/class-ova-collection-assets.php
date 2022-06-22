<?php 
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVACOLL_assets' ) ){
	class OVACOLL_assets{

		public function __construct(){

			add_action( 'wp_enqueue_scripts', array( $this, 'ovacoll_enqueue_scripts' ), 10, 0 );

			/* Add JS for Elementor */
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ova_enqueue_scripts_elementor_coll' ) );
		}

		public function ovacoll_enqueue_scripts(){

			// Init Css
			wp_enqueue_style( 'ovacoll_style', OVACOLL_PLUGIN_URI.'assets/css/frontend/ovacoll-style.css' );

			// Imageloaded masonry	

			if( is_post_type_archive('collection') || is_singular('collection') || is_tax( 'location' ) || is_tax( 'type') ){
				wp_enqueue_script('masonry');
				wp_enqueue_script('imagesLoaded');
			}

			// Init Js
			wp_enqueue_script( 'ovacoll_script', OVACOLL_PLUGIN_URI.'assets/js/frontend/ovacoll-script.js' );			

			// Pretty Photo
			if( is_singular( 'collection' ) ){
				wp_enqueue_style('prettyphoto', OVACOLL_PLUGIN_URI.'assets/libs/prettyphoto/css/prettyPhoto.css');
				if ( is_ssl()) {
					wp_enqueue_script('prettyphoto', OVACOLL_PLUGIN_URI.'assets/libs/prettyphoto/jquery.prettyPhoto_https.js', array('jquery'),null,true);
				}
				else{
					wp_enqueue_script('prettyphoto', OVACOLL_PLUGIN_URI.'assets/libs/prettyphoto/jquery.prettyPhoto.js', array('jquery'),null,true);
				}
			}
		}

		// Add JS for elementor
		public function ova_enqueue_scripts_elementor_coll(){
			wp_enqueue_script( 'script-elementor-coll', OVACOLL_PLUGIN_URI. 'assets/js/script-elementor.js', [ 'jquery' ], false, true );
		}
	}
	new OVACOLL_assets();
}
