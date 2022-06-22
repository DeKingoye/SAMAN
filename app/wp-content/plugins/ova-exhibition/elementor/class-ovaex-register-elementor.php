<?php

namespace ovaex_elementor;

use ovaex_elementor\widgets\ovaex_exhibition_ajax;
use ovaex_elementor\widgets\ovaex_exhibition_type;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



class OVAEX_Register_Elementor {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {

     	// Register Ovatheme Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_ovatheme_category' ) );
	    
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		
	}
	
	public function add_ovatheme_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovatheme',
	        [
	            'title' => __( 'Ovatheme', 'ovaex' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}


	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}


	private function includes() {
		
		require OVAEX_PLUGIN_PATH . 'elementor/widgets/ovaex_exhibition_ajax.php';
		require OVAEX_PLUGIN_PATH . 'elementor/widgets/ovaex_exhibition_type.php';
		
	}


	private function register_widget() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovaex_exhibition_ajax() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovaex_exhibition_type() );

	}
	    
	

}

new OVAEX_Register_Elementor();





