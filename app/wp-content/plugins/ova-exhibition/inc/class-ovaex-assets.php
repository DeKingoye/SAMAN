<?php 
defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVAEX_Assets' ) ){
	class OVAEX_Assets{

		public function __construct(){

			add_action( 'wp_enqueue_scripts', array( $this, 'ovaex_enqueue_style' ) );

			/* Add JS for Elementor */
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'ova_enqueue_scripts_elementor_ovaex' ) );
		}

		public function ovaex_enqueue_style(){

			// Init Css
			wp_enqueue_style( 'ovaex-style', OVAEX_PLUGIN_URI.'assets/css/frontend/ovaex-style.css', array(), null );

			// Init JS
			wp_enqueue_script( 'ovaex-script', OVAEX_PLUGIN_URI.'assets/js/frontend/ovaex-script.js', array('jquery'), false, true );

			// Carousel
			if ( is_singular( 'exhibition' ) ){
				wp_enqueue_style( 'owl-carousel', OVAEX_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
				wp_enqueue_script( 'owl-carousel', OVAEX_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
			}

		}

		// Add JS for elementor
		public function ova_enqueue_scripts_elementor_ovaex(){
			wp_enqueue_script( 'script-elementor-ovaex', OVAEX_PLUGIN_URI. 'assets/js/script-elementor.js', [ 'jquery' ], false, true );
			$admin_url      = admin_url('admin-ajax.php');
			$arg_loadmore   = array( 'url' => $admin_url);
			wp_localize_script('script-elementor-ovaex', 'load_more', $arg_loadmore);
		}
	}
	new OVAEX_Assets();
}