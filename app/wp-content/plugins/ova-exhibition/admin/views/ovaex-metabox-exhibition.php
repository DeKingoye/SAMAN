
<?php 
if( !defined( 'ABSPATH' ) ) exit();
?>


<div id="tabs">

	<ul>
		<li><a href="#metabox-exhibition-basic"><?php esc_html_e( 'Basic', 'ovaex' ); ?> </a></li>
		<li><a href="#metabox-exhibition-gallery" class=""><?php esc_html_e( 'Gallery', 'ovaex' ); ?></a></li>

	</ul>

	<!-- Basic Tab Content -->  
	<div id="metabox-exhibition-basic">

		<?php require_once( OVAEX_PLUGIN_PATH.'/admin/views/ovaex-metabox-exhibition-basic.php' ); ?>

	</div>

	<!-- Gallery -->  
	<div id="metabox-exhibition-gallery">

		<?php require_once( OVAEX_PLUGIN_PATH.'/admin/views/ovaex-metabox-exhibition-gallery.php' ); ?>

	</div>

</div>

<br/> 


<div id="dialogs">
	<!-- Ajax display here -->
</div>	

