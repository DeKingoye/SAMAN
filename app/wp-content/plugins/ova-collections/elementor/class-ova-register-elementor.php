<?php

namespace ova_collections_elementor;

use ova_collections_elementor\widgets\ova_collections;
use ova_collections_elementor\widgets\ova_artists;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Ova_Collections_Register_Elementor {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

	     // Register Ovatheme Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'add_ovatheme_category' ) );
	    
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		

	}

	
	public function add_ovatheme_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'ovatheme',
	        [
	            'title' => __( 'Ovatheme', 'ova-collection' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}


	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		
		require OVACOLL_PLUGIN_PATH . 'elementor/widgets/ova-collections.php';

		require OVACOLL_PLUGIN_PATH . 'elementor/widgets/ova-artists.php';
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ova_collections() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ova_artists() );

	}
	    
	

}

new Ova_Collections_Register_Elementor();





