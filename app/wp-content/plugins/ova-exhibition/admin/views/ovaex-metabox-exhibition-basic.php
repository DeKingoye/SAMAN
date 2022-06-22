<?php

if( !defined( 'ABSPATH' ) ) exit();

global $post;

$date = 'Y/m/d';
$time = 'H:i';
$lang = OVAEX_Settings::ovaex_format_date_lang();

$ex_start_date            = get_post_meta( $post->ID, 'ex_start_date', true ) ? get_post_meta( $post->ID, 'ex_start_date', true ) : '';
$ex_end_date              = get_post_meta( $post->ID, 'ex_end_date', true ) ? get_post_meta( $post->ID, 'ex_end_date', true ) : '';

$ex_curator               = get_post_meta( $post->ID, 'ex_curator', true ) ? get_post_meta( $post->ID, 'ex_curator', true ) : '';

$ex_location              = get_post_meta( $post->ID, 'ex_location', true ) ? get_post_meta( $post->ID, 'ex_location', true ) : '';

$ex_duaration             = get_post_meta( $post->ID, 'ex_duaration', true ) ? get_post_meta( $post->ID, 'ex_duaration', true ) : '';

$ovaex_member_book_link   = get_post_meta( $post->ID, 'ovaex_member_book_link', true ) ? get_post_meta( $post->ID, 'ovaex_member_book_link', true ) : '';

$ovaex_target_member_book = get_post_meta( $post->ID, 'ovaex_target_member_book', true ) ? get_post_meta( $post->ID, 'ovaex_target_member_book', true ) : '';

$ovaex_order_book_link    = get_post_meta( $post->ID, 'ovaex_order_book_link', true ) ? get_post_meta( $post->ID, 'ovaex_order_book_link', true ) : '';

$ovaex_target_order_book  = get_post_meta( $post->ID, 'ovaex_target_order_book', true ) ? get_post_meta( $post->ID, 'ovaex_target_order_book', true ) : '';

$checked                  = get_post_meta( $post->ID, 'ovaex_special', true ) ? get_post_meta( $post->ID, 'ovaex_special', true ) : '' ;

$exhibition_custom_sort   = get_post_meta( $post->ID, 'exhibition_custom_sort', true ) ? get_post_meta( $post->ID, 'exhibition_custom_sort', true ) : '1' ;


if( $ex_start_date && $ex_end_date ){
	$ex_start_date_time = date_i18n( $date .' '. $time, $ex_start_date );
	$ex_end_date_time   =  date_i18n( $date .' '. $time, $ex_end_date );	
}else{
	$ex_start_date_time = $ex_end_date_time = '';
}


?>
<div class="ovaex_metabox">

	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Time:', 'oavex' ); ?></strong></label>
		<input type="text" class="ex_start_date" data-date="<?php echo esc_attr($date .' '. $time) ?>" data-lang="<?php echo esc_attr($lang) ?>" autocomplete="off" value="<?php echo esc_attr($ex_start_date_time); ?>" placeholder="Insert Time Start"  name="ex_start_date" />
		<input type="text" class="ex_end_date" data-date="<?php echo esc_attr($date .' '. $time) ?>" data-lang="<?php echo esc_attr($lang) ?>" autocomplete="off" value="<?php echo esc_attr($ex_end_date_time); ?>" placeholder="Insert Time End"  name="ex_end_date" />
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Curators:', 'oavex' ); ?></strong></label>
		<input type="text" id="ex_curator" value="<?php echo esc_attr($ex_curator); ?>" placeholder="Insert Curators"  name="ex_curator" />
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Location:', 'oavex' ); ?></strong></label>
		<input type="text" id="ex_location" value="<?php echo esc_attr($ex_location); ?>" placeholder="New York"  name="ex_location" />
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Duration:', 'oavex' ); ?></strong></label>
		<input type="text" id="ex_duaration" value="<?php echo esc_attr($ex_duaration); ?>" placeholder="60 Minutes"  name="ex_duaration" />
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Member:', 'ovaex' ); ?></strong></label>
		<?php
		$member_target_self = ( '_self' == $ovaex_target_member_book )? 'selected' : '';
		$member_target_blank = ( '_blank' == $ovaex_target_member_book )? 'selected' : '';
		?>
		<input type="text" id="ovaex_member_book_link" value="<?php echo esc_attr($ovaex_member_book_link); ?>" placeholder="Insert link"  name="ovaex_member_book_link" autocomplete="off" />
		<select id="ovaex_target_member_book" name="ovaex_target_member_book">
			<option <?php echo $member_target_self ?> value="_self"><?php esc_html_e( 'Self', 'ovaex' ); ?></option>
			<option <?php echo $member_target_blank ?> value="_blank"><?php esc_html_e( 'Blank', 'ovaex' ); ?></option>
		</select>
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Order Ticket:', 'ovaex' ); ?></strong></label>
		<?php
		$order_target_self = ( '_self' == $ovaex_target_order_book )? 'selected' : '';
		$order_target_blank = ( '_blank' == $ovaex_target_order_book )? 'selected' : '';
		?>
		<input type="text" id="ovaex_order_book_link" value="<?php echo esc_attr($ovaex_order_book_link); ?>" placeholder="Insert link"  name="ovaex_order_book_link" autocomplete="off" />
		<select id="ovaex_target_order_book" name="ovaex_target_order_book">
			<option <?php echo $order_target_self ?> value="_self"><?php esc_html_e( 'Self', 'ovaex' ); ?></option>
			<option <?php echo $order_target_blank ?> value="_blank"><?php esc_html_e( 'Blank', 'ovaex' ); ?></option>
		</select>
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Special Exhibition:', 'ovaex' ); ?></strong></label>
		<input type="checkbox" value="<?php echo esc_attr($checked); ?>" name="ovaex_special" <?php echo esc_attr($checked); ?> />
	</div>
	<br>

	<div class="ovaex_row">
		<label class="label"><strong><?php esc_html_e( 'Custom Sort:', 'ovaex' ); ?></strong></label>
		<input type="text" value="<?php echo esc_attr($exhibition_custom_sort); ?>" name="exhibition_custom_sort" />
	</div>
	<br>


</div>

<?php wp_nonce_field( 'ovaex_nonce', 'ovaex_nonce' ); ?>