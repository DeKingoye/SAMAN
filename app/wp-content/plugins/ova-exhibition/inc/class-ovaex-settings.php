<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAEX_Settings {
	
	public static function ovaex_exhibition_post_type_rewrite_slug(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_exhibition_post_type_rewrite_slug'] ) ? $ops['ovaex_exhibition_post_type_rewrite_slug'] : '';
	}
	
	public static function ovaex_show_past(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_show_past'] ) ? $ops['ovaex_show_past'] : 'yes';
	}
	
	public static function ovaex_custom_sort(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_custom_sort'] ) ? $ops['ovaex_custom_sort'] : '1';
	}
	
	public static function archive_exhibition_orderby(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_orderby'] ) ? $ops['archive_exhibition_orderby'] : 'title';
	}
	
	public static function archive_exhibition_order(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_order'] ) ? $ops['archive_exhibition_order'] : 'ASC';
	}
	
	public static function archive_exhibition_heading(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_heading'] ) ? $ops['archive_exhibition_heading'] : '';
	}
	
	public static function archive_exhibition_desc(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_desc'] ) ? $ops['archive_exhibition_desc'] : '';
	}
	
	public static function archive_exhibition_type(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_type'] ) ? $ops['archive_exhibition_type'] : 'grid';
	}
	
	
	public static function ovaex_format_date_lang(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_format_date_lang'] ) ? $ops['ovaex_format_date_lang'] : 'en';
	}
	
	public static function ovaex_format_date_frontend(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_format_date_frontend'] ) ? $ops['ovaex_format_date_frontend'] : 'M d, Y';
	}
	
	public static function ovaex_format_date_frontend_single(){
		$ops = get_option('ovaex_options');
		return isset( $ops['ovaex_format_date_frontend_single'] ) ? $ops['ovaex_format_date_frontend_single'] : 'd M Y';
	}

	public static function archive_exhibition_header(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_header'] ) ? $ops['archive_exhibition_header'] : 'default';
	}

	public static function archive_exhibition_footer(){
		$ops = get_option('ovaex_options');
		return isset( $ops['archive_exhibition_footer'] ) ? $ops['archive_exhibition_footer'] : 'default';
	}

	public static function single_exhibition_header(){
		$ops = get_option('ovaex_options');
		return isset( $ops['single_exhibition_header'] ) ? $ops['single_exhibition_header'] : 'default';
	}

	public static function single_exhibition_footer(){
		$ops = get_option('ovaex_options');
		return isset( $ops['single_exhibition_footer'] ) ? $ops['single_exhibition_footer'] : 'default';
	}

}

new OVAEX_Settings();