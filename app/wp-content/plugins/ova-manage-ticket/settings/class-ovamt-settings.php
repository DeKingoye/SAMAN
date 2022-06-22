<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class OVAMT_Settings {

	public static function ovamt_product_slug(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_product_slug'] ) ? $ops['ovamt_product_slug'] : '';
	}

	public static function ovamt_date_time(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_date_time'] ) ? $ops['ovamt_date_time'] : 'Select Time | 07:30 am - 11:30 pm , 07:30 am - 11:30 pm | 10:00 am - 2:00 pm , 10:00 am - 2:00 pm | 1:00 am - 5:00 pm , 1:00 am - 5:00 pm';	
	}
	public static function ovamt_date_format(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_date_format'] ) ? $ops['ovamt_date_format'] : 'Y/m/d';			
	}

	public static function ovamt_disabled_week_days(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_disabled_week_days'] ) ? $ops['ovamt_disabled_week_days'] : '';			
	}

	public static function ovamt_disabled_date(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_disabled_date'] ) ? $ops['ovamt_disabled_date'] : '';			
	}

	public static function ovamt_pagi_num(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_pagi_num'] ) ? $ops['ovamt_pagi_num'] : '20';			
	}	

	public static function ovamt_lang(){
		$ops = get_option('ovamt_options');
		return isset( $ops['ovamt_lang'] ) ? $ops['ovamt_lang'] : 'en';			
	}	
	
	
	
}

new OVAMT_Settings();

