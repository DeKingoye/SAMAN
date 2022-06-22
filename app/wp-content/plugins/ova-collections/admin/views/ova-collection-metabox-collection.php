
<?php

if( !defined( 'ABSPATH' ) ) exit();

global $post; 

$collection_artist           = get_post_meta( $post->ID,'collection_artist', true );
$collection_artists          = apply_filters( 'OVACOLL_artist', '' );

$collection_year_number      = get_post_meta( $post->ID, 'collection_year_number', true ) ? get_post_meta( $post->ID, 'collection_year_number', true ) : '';
$collection_year_text        = get_post_meta( $post->ID, 'collection_year_text', true ) ? get_post_meta( $post->ID, 'collection_year_text', true ) : '';

$collection_address          = get_post_meta( $post->ID, 'collection_address', true ) ? get_post_meta( $post->ID, 'collection_address', true ) : '';

$collection_marterial        = get_post_meta( $post->ID, 'collection_marterial', true ) ? get_post_meta( $post->ID, 'collection_marterial', true ) : '';

$collection_accession_number = get_post_meta( $post->ID, 'collection_accession_number', true ) ? get_post_meta( $post->ID, 'collection_accession_number', true ) : '';

$collection_dimensions       = get_post_meta( $post->ID, 'collection_dimensions', true ) ? get_post_meta( $post->ID, 'collection_dimensions', true ) : '';

$collection_credit           = get_post_meta( $post->ID, 'collection_credit', true ) ? get_post_meta( $post->ID, 'collection_credit', true ) : '';

$collection_file_download    = get_post_meta( $post->ID, 'collection_file_download', true ) ? get_post_meta( $post->ID, 'collection_file_download', true ) : '';

$collection_visual_desc      = get_post_meta( $post->ID, 'collection_visual_desc', true ) ? get_post_meta( $post->ID, 'collection_visual_desc', true ) : '';

$collection_history          = get_post_meta( $post->ID, 'collection_history', true ) ? get_post_meta( $post->ID, 'collection_history', true ) : '';

$collection_publication      = get_post_meta( $post->ID, 'collection_publication', true ) ? get_post_meta( $post->ID, 'collection_publication', true ) : '';

$collection_custom_sort     = get_post_meta( $post->ID, 'collection_custom_sort', true ) ? get_post_meta( $post->ID, 'collection_custom_sort', true ) : '1';

$collection_special          = get_post_meta( $post->ID, 'collection_special', true ) ? get_post_meta( $post->ID, 'collection_special', true ) : '';

?>
<div class="ovacoll_metabox_collection">
	
	<br>
	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'Artist', 'ova-collection' ); ?>: </strong></label>
		<select name="collection_artist[]" multiple>
			<option value="" ><?php esc_html_e( "Select Artist", "ova-collection" ); ?> </option>

			<?php if($collection_artists->have_posts() ) : while ( $collection_artists->have_posts() ) : $collection_artists->the_post(); 

				$selected = (in_array($post->post_name, $collection_artist) == true )? 'selected' : '';

				?>
				<option value="<?php echo esc_attr($post->post_name); ?>" <?php echo esc_attr($selected); ?> > <?php the_title(); ?> </option>

			<?php endwhile;endif; wp_reset_postdata(); ?>
		</select>

	</div>
	<br>


	<div class="ova_collection_row .two_row">
		<label class="label" ><strong><?php esc_html_e( 'Year', 'ova-collection' ); ?>: </strong></label>
		<input type="text" value="<?php echo esc_attr($collection_year_number); ?>" placeholder="1845"  name="collection_year_number" />
		<input type="text" value="<?php echo esc_attr($collection_year_text); ?>" placeholder="Early 20th century"  name="collection_year_text" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label" for="collection_address"><strong><?php esc_html_e( 'Address', 'ova-collection' ); ?>: </strong></label>
		<input type="text" id="collection_address" value="<?php echo esc_attr($collection_address); ?>" placeholder="Room 25, South Wall"  name="collection_address" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label" for="collection_marterial"><strong><?php esc_html_e( 'Material', 'ova-collection' ); ?>: </strong></label>
		<input type="text" id="collection_marterial" value="<?php echo esc_attr($collection_marterial); ?>" placeholder="Oil on panel"  name="collection_marterial" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label" for="collection_accession_number"><strong><?php esc_html_e( 'Accession Number', 'ova-collection' ); ?>: </strong></label>
		<input type="text" id="collection_accession_number" value="<?php echo esc_attr($collection_accession_number); ?>" placeholder="1945.81"  name="collection_accession_number" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label" for="collection_dimensions"><strong><?php esc_html_e( 'Dimensions', 'ova-collection' ); ?>: </strong></label>
		<input type="text" id="collection_dimensions" value="<?php echo esc_attr($collection_dimensions); ?>" placeholder="68 x 57,6cm"  name="collection_dimensions" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label" for="collection_credit"><strong><?php esc_html_e( 'Credit', 'ova-collection' ); ?>: </strong></label>
		<input type="text" id="collection_credit" value="<?php echo esc_attr($collection_credit); ?>" placeholder="Art & History Museum"  name="collection_credit" />
	</div>
	<br/>


	<div class="ova_collection_row">
		<label class="label" for="collection_custom_sort"><strong><?php esc_html_e( 'Custom Sort', 'ova-collection' ); ?>: </strong></label>
		<input type="number" id="collection_custom_sort" value="<?php echo esc_attr($collection_custom_sort); ?>" placeholder="<?php esc_html_e( 'Insert Number', 'ova-collection' ); ?>"  name="collection_custom_sort" />
	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'Special Collection:', 'ova-collection' ); ?></strong></label>
		<select name="collection_special">
			<option value="no" <?php echo esc_attr( $collection_special == 'no' ? 'selected' : '' ); ?> > <?php esc_html_e( 'No', 'ova-collection' );; ?></option>
			<option value="yes" <?php echo esc_attr( $collection_special == 'yes' ? 'selected' : '' ); ?> > <?php esc_html_e( 'Yes', 'ova-collection' );; ?></option>
		</select>

	</div>
	<br>


	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'File Download', 'ova-collection' ); ?>: </strong></label>
		<?php
		$link_download = '';
		if ( $collection_file_download ) {
			$image_attributes = wp_get_attachment_image_src( $collection_file_download, 'medium' );
			$src = $image_attributes[0];
			$link_download = $collection_file_download ;
		} 
		?>

		<div>
			<input type="text" name="collection_file_download" value="<?php echo esc_attr( $link_download ); ?>" />
			<button type="submit" class="upload_image_button button"><?php esc_html_e( 'Upload', 'ova-collection' ) ?></button>
			<button type="submit" class="remove_image_button button">&times;</button>
		</div>

		<?php if ( $collection_file_download ) { ?>
			<img data-src="<?php echo esc_url( $src ); ?> " src="<?php echo esc_url($src); ?>" width="100px"/>
		<?php } ?>

	</div>
	<br/>

	
	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'Visual Description', 'ova-collection' ); ?>: </strong></label>
		<?php wp_editor ( 
			$collection_visual_desc,
			'collection_visual_desc',
			array ( 
				"media_buttons" => true,
				"textarea_rows" => 5,
				"wpautop" => false
			)
		); ?>
	</div>
	<br/>
	

	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'Timeline of Art History', 'ova-collection' ); ?>: </strong></label>
		<?php wp_editor ( 
			$collection_history,
			'collection_history',
			array ( 
				"media_buttons" => true,
				"textarea_rows" => 5,
				"wpautop" => false
			)
		); ?>
	</div>
	<br/>


	<div class="ova_collection_row">
		<label class="label"><strong><?php esc_html_e( 'Publications', 'ova-collection' ); ?>: </strong></label>
		<?php wp_editor ( 
			$collection_publication,
			'collection_publication',
			array ( 
				"media_buttons" => true,
				"textarea_rows" => 5,
				"wpautop" => false
			)
		); ?>
	</div>
	<br/>

</div>

<?php wp_nonce_field( 'ova_collection_nonce', 'ova_collection_nonce' ); ?>