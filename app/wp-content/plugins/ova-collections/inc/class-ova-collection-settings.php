<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}


class OVACOLL_Settings {

	
	public static function collection_post_type_rewrite_slug(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['collection_post_type_rewrite_slug'] ) ? $ops['collection_post_type_rewrite_slug'] : 'collection';
	}

	public static function collection_post_type_rewrite_artist_slug(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['collection_post_type_rewrite_artist_slug'] ) ? $ops['collection_post_type_rewrite_artist_slug'] : 'artist';
	}
	
	public static function archive_collection_orderby(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_orderby'] ) ? $ops['archive_collection_orderby'] : 'date';
	}	

	public static function archive_collection_order(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_order'] ) ? $ops['archive_collection_order'] : 'ASC';
	}

	
	public static function archive_artist_orderby(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_orderby'] ) ? $ops['archive_artist_orderby'] : 'date';
	}

	public static function archive_artist_order(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_order'] ) ? $ops['archive_artist_order'] : 'ASC';
	}

	public static function archive_collection_heading(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_heading'] ) ? $ops['archive_collection_heading'] : '';
	}

	public static function archive_collection_desc(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_desc'] ) ? $ops['archive_collection_desc'] : '';
	}

	public static function background_heading_archive_aritst(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['background_heading_archive_aritst'] ) ? $ops['background_heading_archive_aritst'] : '';
	}

	public static function archive_artist_heading(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_heading'] ) ? $ops['archive_artist_heading'] : '';
	}

	public static function archive_artist_desc(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_desc'] ) ? $ops['archive_artist_desc'] : 'ASC';
	}

	public static function archive_collection_type(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_type'] ) ? $ops['archive_collection_type'] : 'type1';
	}

	public static function archive_collection_header(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_header'] ) ? $ops['archive_collection_header'] : 'default';
	}

	public static function archive_collection_footer(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_collection_footer'] ) ? $ops['archive_collection_footer'] : 'default';
	}

	public static function single_collection_header(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['single_collection_header'] ) ? $ops['single_collection_header'] : 'default';
	}

	public static function single_collection_footer(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['single_collection_footer'] ) ? $ops['single_collection_footer'] : 'default';
	}



	public static function archive_artist_header(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_header'] ) ? $ops['archive_artist_header'] : 'default';
	}

	public static function archive_artist_footer(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['archive_artist_footer'] ) ? $ops['archive_artist_footer'] : 'default';
	}

	public static function single_artist_header(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['single_artist_header'] ) ? $ops['single_artist_header'] : 'default';
	}

	public static function single_artist_footer(){
		$ops = get_option('ovacoll_options');
		return isset( $ops['single_artist_footer'] ) ? $ops['single_artist_footer'] : 'default';
	}

	

}

new OVACOLL_Settings();