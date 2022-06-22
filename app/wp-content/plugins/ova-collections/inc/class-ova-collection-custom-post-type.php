<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVACOLL_custom_post_type' ) ) {

	class OVACOLL_custom_post_type{

		public function __construct(){

			add_action( 'init', array( $this, 'OVACOLL_register_post_type_collection' ) );

			add_action( 'init', array( $this, 'OVACOLL_register_post_type_artist' ) );

			add_action( 'init', array( $this, 'OVACOLL_custom_taxonomy_type' ) );

			add_action( 'init', array( $this, 'OVACOLL_custom_taxonomy_location' ) );
		}

		
		function OVACOLL_register_post_type_collection() {

			$labels = array(
				'name'                  => _x( 'Collections', 'Post Type General Name', 'ova-collection' ),
				'singular_name'         => _x( 'Collection', 'Post Type Singular Name', 'ova-collection' ),
				'menu_name'             => __( 'Collections', 'ova-collection' ),
				'name_admin_bar'        => __( 'Post Type', 'ova-collection' ),
				'archives'              => __( 'Item Archives', 'ova-collection' ),
				'attributes'            => __( 'Item Attributes', 'ova-collection' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ova-collection' ),
				'all_items'             => __( 'All Collections', 'ova-collection' ),
				'add_new_item'          => __( 'Add New Collection', 'ova-collection' ),
				'add_new'               => __( 'Add New Collection', 'ova-collection' ),
				'new_item'              => __( 'New Item', 'ova-collection' ),
				'edit_item'             => __( 'Edit Collection', 'ova-collection' ),
				'view_item'             => __( 'View Item', 'ova-collection' ),
				'view_items'            => __( 'View Items', 'ova-collection' ),
				'search_items'          => __( 'Search Item', 'ova-collection' ),
				'not_found'             => __( 'Not found', 'ova-collection' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ova-collection' ),
			);
			$args = array(
				'description'         => __( 'Post Type Description', 'ova-collection' ),
				'labels'              => $labels,
				'supports'            => array( 'author', 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => 'ova-collection-menu',
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'collection', 'URL slug', 'ova-collection' ) ),
				'capability_type'     => 'post',
			);
			register_post_type( 'collection', $args );
		}
		
		// Register Artists
		function OVACOLL_register_post_type_artist() {

			$labels = array(
				'name'                  => _x( 'Artists', 'Post Type General Name', 'ova-collection' ),
				'singular_name'         => _x( 'Artist', 'Post Type Singular Name', 'ova-collection' ),
				'menu_name'             => __( 'Artists', 'ova-collection' ),
				'name_admin_bar'        => __( 'Post Type', 'ova-collection' ),
				'archives'              => __( 'Item Archives', 'ova-collection' ),
				'attributes'            => __( 'Item Attributes', 'ova-collection' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ova-collection' ),
				'all_items'             => __( 'All Artists', 'ova-collection' ),
				'add_new_item'          => __( 'Add New Artist', 'ova-collection' ),
				'add_new'               => __( 'Add New Artist', 'ova-collection' ),
				'new_item'              => __( 'New Item', 'ova-collection' ),
				'edit_item'             => __( 'Edit Artist', 'ova-collection' ),
				'view_item'             => __( 'View Item', 'ova-collection' ),
				'view_items'            => __( 'View Items', 'ova-collection' ),
				'search_items'          => __( 'Search Item', 'ova-collection' ),
				'not_found'             => __( 'Not found', 'ova-collection' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ova-collection' ),
			);
			$args = array(
				'description'          => __( 'Post Type Description', 'ova-collection' ),
				'labels'               => $labels,
				'supports'             => array( 'author', 'title', 'editor', 'comments', 'excerpt', 'thumbnail' ),
				'hierarchical'         => false,
				'public'               => true,
				'show_ui'              => true,
				'show_in_menu'         => 'ova-collection-menu',
				'menu_position'        => 5,
				'query_var'            => true,
				'has_archive'          => true,
				'exclude_from_search'  => true,
				'publicly_queryable'   => true,
				'rewrite'              => array( 'slug' => _x( 'artist', 'URL slug', 'ova-collection' ) ),
				'capability_type'      => 'post',
				'show_in_nav_menus' => true,
			);
			register_post_type( 'artist', $args );
		}
		

		// Register Custom Taxonomy Tags
		function OVACOLL_custom_taxonomy_type() {
		
			$labels = array(
				'name'                       => _x( 'Type', 'Post Type General Name', 'ova-collection' ),
				'singular_name'              => _x( 'Type', 'Post Type Singular Name', 'ova-collection' ),
				'menu_name'                  => __( 'Type', 'ova-collection' ),
				'all_items'                  => __( 'All Type', 'ova-collection' ),
				'parent_item'                => __( 'Parent Item', 'ova-collection' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-collection' ),
				'new_item_name'              => __( 'New Item Name', 'ova-collection' ),
				'add_new_item'               => __( 'Add New Type', 'ova-collection' ),
				'add_new'                    => __( 'Add New Type', 'ova-collection' ),
				'edit_item'                  => __( 'Edit Type', 'ova-collection' ),
				'view_item'                  => __( 'View Item', 'ova-collection' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ova-collection' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ova-collection' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ova-collection' ),
				'popular_items'              => __( 'Popular Items', 'ova-collection' ),
				'search_items'               => __( 'Search Items', 'ova-collection' ),
				'not_found'                  => __( 'Not Found', 'ova-collection' ),
				'no_terms'                   => __( 'No items', 'ova-collection' ),
				'items_list'                 => __( 'Items list', 'ova-collection' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ova-collection' ),
			);
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_in_menu'      => 'ova-collection-menu',
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'rewrite'              => array( 'slug' => _x( 'type', 'URL slug', 'ova-collection' ) ),
			);
			register_taxonomy( 'type', array( 'collection' ), $args );
		}


		// Register Custom Taxonomy Location
		function OVACOLL_custom_taxonomy_location() {

			$labels = array(
				'name'                       => _x( 'Location', 'Post Type General Name', 'ova-collection' ),
				'singular_name'              => _x( 'Location', 'Post Type Singular Name', 'ova-collection' ),
				'menu_name'                  => __( 'Location', 'ova-collection' ),
				'all_items'                  => __( 'All Location', 'ova-collection' ),
				'parent_item'                => __( 'Parent Item', 'ova-collection' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-collection' ),
				'new_item_name'              => __( 'New Item Name', 'ova-collection' ),
				'add_new_item'               => __( 'Add New Location', 'ova-collection' ),
				'add_new'                    => __( 'Add New Location', 'ova-collection' ),
				'edit_item'                  => __( 'Edit Location', 'ova-collection' ),
				'view_item'                  => __( 'View Item', 'ova-collection' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ova-collection' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ova-collection' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ova-collection' ),
				'popular_items'              => __( 'Popular Items', 'ova-collection' ),
				'search_items'               => __( 'Search Items', 'ova-collection' ),
				'not_found'                  => __( 'Not Found', 'ova-collection' ),
				'no_terms'                   => __( 'No items', 'ova-collection' ),
				'items_list'                 => __( 'Items list', 'ova-collection' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ova-collection' ),
			);
			$args = array(
				'labels'             => $labels,
				'hierarchical'       => true,
				'publicly_queryable' => true,
				'public'             => true,
				'show_ui'            => true,
				'show_in_menu'       => 'ova-collection-menu',
				'show_admin_column'  => true,
				'show_in_nav_menus'  => true,
				'show_tagcloud'      => false,
				'rewrite'              => array( 'slug' => _x( 'location', 'URL slug', 'ova-collection' ) ),
			);
			register_taxonomy( 'location', array( 'collection' ), $args );
		}


	}

	new OVACOLL_custom_post_type();
}