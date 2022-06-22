<?php 

if( !defined( 'ABSPATH' ) ) exit();

global $post;

$artist_phone        = get_post_meta( $post->ID, 'artist_phone', true );

$artist_skill        = get_post_meta( $post->ID, 'artist_skill', true );

$artist_email        = get_post_meta( $post->ID, 'artist_email', true );

$artist_custom_sort = get_post_meta( $post->ID, 'artist_custom_sort', true ) ? get_post_meta( $post->ID, 'artist_custom_sort', true ) : 1;

?>

<div class="ovacoll_metabox_artist">

	<!-- General Tab Content -->  
	<div id="ovacoll_metabox_artist_basic" class="ovacoll_metabox_artist_basic">
		<div class="ova_collection_metabox_artist">

			<br>
			<div class="ova_collection_row">
				<label class="label" for="artist_skill"><strong><?php esc_html_e( 'Skill', 'ova-collection' ); ?>: </strong></label>
				<input type="text" id="artist_skill" value="<?php echo esc_attr($artist_skill); ?>" placeholder="<?php esc_html_e( 'your skill', 'ova-collection' ); ?>"  name="artist_skill" />
			</div>
			<br>

			<div class="ova_collection_row">
				<label class="label" for="artist_phone"><strong><?php esc_html_e( 'Phone', 'ova-collection' ); ?>: </strong></label>
				<input type="text" id="artist_phone" value="<?php echo esc_attr($artist_phone); ?>" placeholder="<?php esc_html_e( '+861231232323', 'ova-collection' ); ?>"  name="artist_phone" />
			</div>
			<br>

			<div class="ova_collection_row">
				<label class="label" for="artist_email"><strong><?php esc_html_e( 'Email', 'ova-collection' ); ?>: </strong></label>
				<input type="text" id="artist_email" value="<?php echo esc_attr($artist_email); ?>" placeholder="<?php esc_html_e( 'email@mail.com', 'ova-collection' ); ?>"  name="artist_email" />
			</div>
			<br>

			<div class="ova_collection_row">
				<label class="label" for="artist_custom_sort"><strong><?php esc_html_e( 'Custom Sort', 'ova-collection' ); ?>: </strong></label>
				<input type="number" id="artist_custom_sort" value="<?php echo esc_attr($artist_custom_sort); ?>" placeholder="<?php esc_html_e( 'Insert Number', 'ova-collection' ); ?>"  name="artist_custom_sort" />
			</div>
			<br>

		</div>
	</div>

</div>

<?php wp_nonce_field( 'ova_collection_nonce', 'ova_collection_nonce' ); ?>