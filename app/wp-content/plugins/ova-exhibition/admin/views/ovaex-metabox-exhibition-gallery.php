<?php

if( !defined( 'ABSPATH' ) ) exit();

$post_id = isset( $_REQUEST['post'] ) ? $_REQUEST['post'] : '';
$ovaex_gallery_id = get_post_meta( $post_id, 'ovaex_gallery_id', true); 

?>
<div class="ovaex_metabox">

	<a class="gallery-add button button button-primary button-large text-right" href="#" data-uploader-title=<?php esc_html_e( "Add image(s) to gallery", "ovaex" ); ?>" data-uploader-button-text="Add image(s)"><?php esc_html_e( "Add image(s)", "ovaex" ); ?></a>


	<ul id="gallery-metabox-list">
		<?php if ($ovaex_gallery_id) : foreach ($ovaex_gallery_id as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
			<li>
				<input type="hidden" name="ovaex_gallery_id[<?php echo $key; ?>]" value="<?php echo esc_attr($value); ?>">
				<img class="image-preview" src="<?php echo $image[0]; ?>">
				<a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><?php esc_html_e( "Change image", "ovaex" ); ?></a>
				<small><a class="remove-image" href="#"><?php esc_html_e( "Remove image", "ovaex" ); ?></a></small>
			</li>

		<?php endforeach; endif; ?>
		
	</ul>
</div>

