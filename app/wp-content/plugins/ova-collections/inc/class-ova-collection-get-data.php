<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVACOLL_get_data {
	public function __construct() {

		add_filter( 'upload_file_ext', 'upload_file_ext', 1, 1);

		add_filter( 'OVACOLL_collection', array( $this, 'OVACOLL_collection' ), 10, 0 );

		add_filter( 'OVACOLL_artist', array( $this, 'OVACOLL_artist' ), 10, 1 );

		add_filter( 'OVACOLL_artist_list', array( $this, 'OVACOLL_artist_list' ), 10, 0 );
		
		add_filter( 'OVACOLL_location', array( $this, 'OVACOLL_location' ), 10, 1 );

		add_filter( 'OVACOLL_type', array( $this, 'OVACOLL_type' ), 10, 1 );

		add_filter( 'OVACOLL_search_collection', array( $this, 'OVACOLL_search_collection' ), 10, 1 );

		add_filter( 'OVACOLL_collection_get', array( $this, 'OVACOLL_collection_get' ), 10, 1 );

	}


	function upload_file_ext($ext_types){
		$ext_types['zip'] = 'application/zip';
		return $ext_types;
	}


	private function OVACOLL_query_base( $paged = '', $orderby = 'date', $order = 'ASC' ){

		$args_base = $args_paged = $args_orderby = $args_type = $args_loc = array();

		$args_base = array(
			'post_status' => 'publish',
			'order'	=> $order
		);
		
		if( is_tax( 'type' ) ||  get_query_var( 'type' ) != '' ){
			$args_type = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'type',
						'field'    => 'slug',
						'terms'    => get_query_var( 'type' ),
					)
				)
			);
		}

		if( is_tax( 'location' ) ||  get_query_var( 'location' ) != '' ){
			$args_loc = array( 
				'tax_query' => array(
					array(
						'taxonomy' => 'location',
						'field'    => 'slug',
						'terms'    => get_query_var( 'location' ),
					)
				)
			);
		}
		
		$args_paged = ( $paged != '' ) ? array( 'paged' => $paged ) : array();

		switch ($orderby) {

			case 'date':
			$args_orderby =  array( 'orderby' => 'date' );
			break;

			case 'title':
			$args_orderby =  array( 'orderby' => 'title' );
			break;

			case 'ID':
			$args_orderby =  array( 'orderby' => 'ID' );
			break;
			
			case 'artist_custom_sort':
			$args_orderby =  array( 'orderby' => 'meta_value', 'meta_key' => $orderby );
			break;
			
			case 'collection_custom_sort':
			$args_orderby =  array( 'orderby' => 'meta_value', 'meta_key' => $orderby );
			break;		
			
			default:

			break;
		}
		
		// $args_orderby = ($orderby == 'date') ? array( 'orderby' => 'date' ) : array( 'orderby' => 'meta_value', 'meta_key' => $orderby );

		return array_merge_recursive( $args_base, $args_paged, $args_orderby, $args_type, $args_loc );

	}


	public function OVACOLL_collection(){

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$orderby   = OVACOLL_Settings::archive_collection_orderby();
		$order     = OVACOLL_Settings::archive_collection_order();
		

		$args_basic = $args_base = array();

		$args_basic = $this->OVACOLL_query_base( $paged, $orderby, $order );
		
		$args_base = array(
			'post_type'      => 'collection'
			
		);

		$args = array_merge_recursive( $args_basic, $args_base );

		$collection = new WP_Query( $args );

		return $collection;
	}


	public function OVACOLL_artist($params){

		$paged   = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$orderby = OVACOLL_Settings::archive_artist_orderby();
		$order   = OVACOLL_Settings::archive_artist_order();

		$args_basic = $args_base  = array();
		
		$args_basic = $this->OVACOLL_query_base( $paged, $orderby, $order );

		
		if( is_archive( 'artist' ) ){
			$args_base = array(
				'post_type'      => 'artist',
				
			);
		}else{
			$args_base = array(
				'post_type'      => 'artist',
				'posts_per_page' => '-1',
				'post_name__in'  => $params,
			);
		}

		$args = array_merge_recursive( $args_basic, $args_base  );

		$artist = new WP_Query( $args );
		
		return $artist;
	}


	public function OVACOLL_artist_list(){

		$args = array(
			'post_type' => 'artist',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
			'order'	=> 'ASC',
			'orderby'	=> apply_filters( 'ovacll_list_artist_orderby' ,'title' ),
		);

		$artist = new WP_Query( $args );
		
		return $artist;
	}


	public function OVACOLL_location($selected){

		$args = array(
			'show_option_all'   => '' ,
			'show_option_none'   => esc_html__( 'All Location', 'ova-collection' ),
			'post_type'         => 'collection',
			'post_status'       => 'publish',
			'posts_per_page'    => '-1',
			'option_none_value' => '',
			'orderby'			=> apply_filters( 'ovacll_list_locations_orderby' ,'title' ),
			'order'             => 'ASC',
			'show_count'        => 0,
			'hide_empty'        => 0,
			'child_of'          => 0,
			'exclude'           => '',
			'include'           => '',
			'echo'              => 1,
			'selected'          => $selected,
			'hierarchical'      => 1,
			'name'              => 'coll_location',
			'id'                => '',
			'depth'             => 0,
			'tab_index'         => 0,
			'taxonomy'          => 'location',
			'hide_if_empty'     => false,
			'value_field'       => 'slug',
		);

		$location = new WP_Query( $args );

		return wp_dropdown_categories($args);
	}


	public function OVACOLL_type($selected){

		$args = array(
			'show_option_all'   => '' ,
			'show_option_none'   => esc_html__( 'All Type', 'ova-collection' ),
			'post_type'         => 'collection',
			'post_status'       => 'publish',
			'posts_per_page'    => '-1',
			'option_none_value' => '',
			'orderby'           => apply_filters( 'ovacll_list_types_orderby' ,'title' ),
			'order'             => 'ASC',
			'show_count'        => 0,
			'hide_empty'        => 0,
			'child_of'          => 0,
			'exclude'           => '',
			'include'           => '',
			'echo'              => 1,
			'selected'          => $selected,
			'hierarchical'      => 1,
			'name'              => 'coll_type',
			'id'                => '',
			'depth'             => 0,
			'tab_index'         => 0,
			'taxonomy'          => 'type',
			'hide_if_empty'     => false,
			'value_field'       => 'slug',
		);

		$type = new WP_Query( $args );

		return wp_dropdown_categories($args);
	}


	public function OVACOLL_search_collection($params){

		$location = isset( $params['coll_location'] ) ? esc_html( $params['coll_location'] ) : '' ;

		$type = isset( $params['coll_type'] ) ? esc_html( $params['coll_type'] ) : '' ;

		$artist = isset( $params['coll_artist'] ) ? esc_html( $params['coll_artist'] ) : '' ;

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		// $show_post = OVACOLL_Settings::archive_collection_show_post();

		// Init query
		$args_basic = $args_location = $args_type = $args_artist = $args_base = array();

		$args_basic = $this->OVACOLL_query_base( $paged );

		$args_base = array(
			'post_type'      => 'collection',
			// 'posts_per_page' => $show_post,
		);

		if($location){
			$args_location = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'location',
						'field'    => 'slug',
						'terms'    => $location
					)
				)
			);
		}

		if($type){
			$args_type = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'type',
						'field'    => 'slug',
						'terms'    => $type
					)
				)
			);
		}	

		if($artist){
			$args_artist = array(
				'meta_query' => array(
					array(
						'key'     => 'collection_artist',
						'value'   => $artist,
						'compare' => 'LIKE'
					)
				)
			);
		}
		// var_dump($artist);


		$args = array_merge_recursive( $args_basic, $args_location, $args_type, $args_artist, $args_base );

		$events = new WP_Query( $args );

		return $events;
	}


	public function OVACOLL_collection_get($slug_artist){

		$args_basic = $args_base = $args_artist = array();

		$args_basic = $this->OVACOLL_query_base( );
		
		$args_base = array(
			'post_type' => 'collection',
			'posts_per_page'    => '-1',
		);

		if($slug_artist){
			$args_artist = array(
				'meta_query' => array(
					array(
						'key'     => 'collection_artist',
						'value'   => $slug_artist,
						'compare' => 'LIKE'
					)
				)
			);
		}

		$args = array_merge_recursive( $args_basic, $args_base, $args_artist );

		$collection = new WP_Query( $args );

		return $collection;
	}



}
new OVACOLL_get_data();