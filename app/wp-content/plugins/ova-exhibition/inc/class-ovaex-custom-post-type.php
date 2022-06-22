<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVAEX_custom_post_type' ) ) {

	class OVAEX_custom_post_type{

		public function __construct(){

			add_action( 'init', array( $this, 'OVAEX_register_post_type_exhibition' ) );

		}

		
		function OVAEX_register_post_type_exhibition() {
			

			$labels = array(
				'name'                  => _x( 'Exhibitions', 'Post Type General Name', 'ovaex' ),
				'singular_name'         => _x( 'Exhibition', 'Post Type Singular Name', 'ovaex' ),
				'menu_name'             => __( 'Exhibitions', 'ovaex' ),
				'name_admin_bar'        => __( 'Post Type', 'ovaex' ),
				'archives'              => __( 'Item Archives', 'ovaex' ),
				'attributes'            => __( 'Item Attributes', 'ovaex' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ovaex' ),
				'all_items'             => __( 'All Exhibitions', 'ovaex' ),
				'add_new_item'          => __( 'Add New Exhibition', 'ovaex' ),
				'add_new'               => __( 'Add New Exhibition', 'ovaex' ),
				'new_item'              => __( 'New Item', 'ovaex' ),
				'edit_item'             => __( 'Edit Exhibition', 'ovaex' ),
				'view_item'             => __( 'View Item', 'ovaex' ),
				'view_items'            => __( 'View Items', 'ovaex' ),
				'search_items'          => __( 'Search Item', 'ovaex' ),
				'not_found'             => __( 'Not found', 'ovaex' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ovaex' ),
			);
			$args = array(
				'description'         => __( 'Post Type Description', 'ovaex' ),
				'labels'              => $labels,
				'supports'            => array( 'author', 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => 'ovaex-menu',
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'exhibition', 'URL slug', 'ovaex' ) ),
				'capability_type'     => 'post',
			);
			register_post_type( 'exhibition', $args );
		}

	}

	new OVAEX_custom_post_type();
}