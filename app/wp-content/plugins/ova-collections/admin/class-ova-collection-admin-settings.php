<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVACOLL_admin_settings' ) ){

	/**
	 * Make Admin Class
	 */
	class OVACOLL_admin_settings{

		/**
		 * Construct Admin
		 */
		public function __construct(){
			add_action( 'admin_enqueue_scripts', array( $this, 'ovacoll_load_media' ) );
			add_action( 'admin_init', array( $this, 'register_options' ) );
		}


		public function ovacoll_load_media() {
			wp_enqueue_media();
		}

		public function print_options_section(){
			return true;
		}


		public function register_options(){

			register_setting(
				'ovacoll_options_group', // Option group
				'ovacoll_options', // Name Option
				array( $this, 'settings_callback' ) // Call Back
			);


			/**
			 * General Settings
			 */
			// Add Section: General Settings
			add_settings_section(
				'ovacoll_general_section_id', // ID
				esc_html__('General Setting', 'ova-collection'), // Title
				array( $this, 'print_options_section' ),
				'ovacoll_general_settings' // Page
			);

			// Add Fields: General Section
			add_settings_field(
				'collection_post_type_rewrite_slug', // ID
				esc_html__('Rewrite Collection Slug','ova-collection'),
				array( $this, 'collection_post_type_rewrite_slug' ),
				'ovacoll_general_settings', // Page
				'ovacoll_general_section_id' // Section ID
			);

			add_settings_field(
				'collection_post_type_rewrite_artist_slug', // ID
				esc_html__('Rewrite Artist Slug','ova-collection'),
				array( $this, 'collection_post_type_rewrite_artist_slug' ),
				'ovacoll_general_settings', // Page
				'ovacoll_general_section_id' // Section ID
			);


			/**
			 * Collection Settings
			 */
			// Add Section: Collection Settings
			add_settings_section(
				'ovacoll_archive_collection_section_id', // ID
				esc_html__('Archive Collection Setting', 'ova-collection'), // Title
				array( $this, 'print_options_section' ),
				'ovacoll_collection_settings' // Page
			);

			// Add Fields: Collection Section
			add_settings_field(
				'archive_collection_orderby', // ID
				esc_html__('Order By','ova-collection'),
				array( $this, 'archive_collection_orderby' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			add_settings_field(
				'archive_collection_order', // ID
				esc_html__('Order','ova-collection'),
				array( $this, 'archive_collection_order' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			

			add_settings_field(
				'archive_collection_heading', // ID
				esc_html__('Heading','ova-collection'),
				array( $this, 'archive_collection_heading' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			add_settings_field(
				'archive_collection_desc', // ID
				esc_html__('Description','ova-collection'),
				array( $this, 'archive_collection_desc' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			add_settings_field(
				'archive_collection_type', // ID
				esc_html__('Collection Type','ova-collection'),
				array( $this, 'archive_collection_type' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			add_settings_field(
				'archive_collection_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'archive_collection_header' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			add_settings_field(
				'archive_collection_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'archive_collection_footer' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_archive_collection_section_id' // Section ID
			);

			// Add Section: Collection Settings
			add_settings_section(
				'ovacoll_single_collection_section_id', // ID
				esc_html__('Single Collection Setting', 'ova-collection'), // Title
				array( $this, 'print_options_section' ),
				'ovacoll_collection_settings' // Page
			);

			add_settings_field(
				'single_collection_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'single_collection_header' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_single_collection_section_id' // Section ID
			);

			add_settings_field(
				'single_collection_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'single_collection_footer' ),
				'ovacoll_collection_settings', // Page
				'ovacoll_single_collection_section_id' // Section ID
			);

			


			/**
			 * Artist Settings
			 */
			/** Add Section: Archive Artist Settings **/
			add_settings_section(
				'ovacoll_archive_artist_section_id', // ID
				esc_html__('Archive Artists Setting', 'ova-collection'), // Title
				array( $this, 'print_options_section' ),
				'archive_artist_settings' // Page
			);

			add_settings_field(
				'archive_artist_orderby', // ID
				esc_html__('Order By','ova-collection'),
				array( $this, 'archive_artist_orderby' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			add_settings_field(
				'archive_artist_order', // ID
				esc_html__('Order','ova-collection'),
				array( $this, 'archive_artist_order' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			add_settings_field(
				'archive_artist_heading', // ID
				esc_html__('Heading','ova-collection'),
				array( $this, 'archive_artist_heading' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			add_settings_field(
				'archive_artist_desc', // ID
				esc_html__('Description','ova-collection'),
				array( $this, 'archive_artist_desc' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			add_settings_field(
				'archive_artist_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'archive_artist_header' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			add_settings_field(
				'archive_artist_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'archive_artist_footer' ),
				'archive_artist_settings', // Page
				'ovacoll_archive_artist_section_id' // Section ID
			);

			/** Add Section: Single Artist Settings **/
			add_settings_section(
				'ovacoll_single_artist_section_id', // ID
				esc_html__('Single Artists Setting', 'ova-collection'), // Title
				array( $this, 'print_options_section' ),
				'single_artist_settings' // Page
			);
			add_settings_field(
				'background_heading_archive_aritst', // ID
				esc_html__('Background Heading','ova-collection'),
				array( $this, 'background_heading_archive_aritst' ),
				'single_artist_settings', // Page
				'ovacoll_single_artist_section_id' // Section ID
			);
			

			add_settings_field(
				'single_artist_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'single_artist_header' ),
				'single_artist_settings', // Page
				'ovacoll_single_artist_section_id' // Section ID
			);

			add_settings_field(
				'single_artist_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'single_artist_footer' ),
				'single_artist_settings', // Page
				'ovacoll_single_artist_section_id' // Section ID
			);

		}


		public function settings_callback( $input ){

			$new_input = array();

			if( isset( $input['collection_post_type_rewrite_slug'] ) )
				$new_input['collection_post_type_rewrite_slug'] = sanitize_text_field( $input['collection_post_type_rewrite_slug'] ) ? sanitize_text_field( $input['collection_post_type_rewrite_slug'] ) : 'collection';

			if( isset( $input['collection_post_type_rewrite_artist_slug'] ) )
				$new_input['collection_post_type_rewrite_artist_slug'] = sanitize_text_field( $input['collection_post_type_rewrite_artist_slug'] ) ? sanitize_text_field( $input['collection_post_type_rewrite_artist_slug'] ) : 'artist';

			

			if( isset( $input['archive_collection_orderby'] ) )
				$new_input['archive_collection_orderby'] = sanitize_text_field( $input['archive_collection_orderby'] ) ? sanitize_text_field( $input['archive_collection_orderby'] ) : 'date';

			if( isset( $input['archive_collection_order'] ) )
				$new_input['archive_collection_order'] = sanitize_text_field( $input['archive_collection_order'] ) ? sanitize_text_field( $input['archive_collection_order'] ) : 'ASC';

			if( isset( $input['archive_artist_orderby'] ) )
				$new_input['archive_artist_orderby'] = sanitize_text_field( $input['archive_artist_orderby'] ) ? sanitize_text_field( $input['archive_artist_orderby'] ) : 'date';

			if( isset( $input['archive_artist_order'] ) )
				$new_input['archive_artist_order'] = sanitize_text_field( $input['archive_artist_order'] ) ? sanitize_text_field( $input['archive_artist_order'] ) : 'ASC';

			

			if( isset( $input['archive_collection_heading'] ) )
				$new_input['archive_collection_heading'] = sanitize_text_field( $input['archive_collection_heading'] ) ? sanitize_text_field( $input['archive_collection_heading'] ) : '';

			if( isset( $input['archive_collection_desc'] ) )
				$new_input['archive_collection_desc'] = sanitize_text_field( $input['archive_collection_desc'] ) ? sanitize_text_field( $input['archive_collection_desc'] ) : '';

			if( isset( $input['background_heading_archive_aritst'] ) )
				$new_input['background_heading_archive_aritst'] = sanitize_text_field( $input['background_heading_archive_aritst'] ) ? sanitize_text_field( $input['background_heading_archive_aritst'] ) : '';

			if( isset( $input['archive_artist_heading'] ) )
				$new_input['archive_artist_heading'] = sanitize_text_field( $input['archive_artist_heading'] ) ? sanitize_text_field( $input['archive_artist_heading'] ) : '';

			if( isset( $input['archive_artist_desc'] ) )
				$new_input['archive_artist_desc'] = sanitize_text_field( $input['archive_artist_desc'] ) ? sanitize_text_field( $input['archive_artist_desc'] ) : 'ASC';

			if( isset( $input['archive_collection_type'] ) )
				$new_input['archive_collection_type'] = sanitize_text_field( $input['archive_collection_type'] ) ? sanitize_text_field( $input['archive_collection_type'] ) : 'type1';

			if( isset( $input['archive_collection_header'] ) )
				$new_input['archive_collection_header'] = sanitize_text_field( $input['archive_collection_header'] ) ? sanitize_text_field( $input['archive_collection_header'] ) : 'default';

			if( isset( $input['archive_collection_footer'] ) )
				$new_input['archive_collection_footer'] = sanitize_text_field( $input['archive_collection_footer'] ) ? sanitize_text_field( $input['archive_collection_footer'] ) : 'default';


			if( isset( $input['single_collection_header'] ) )
				$new_input['single_collection_header'] = sanitize_text_field( $input['single_collection_header'] ) ? sanitize_text_field( $input['single_collection_header'] ) : 'default';

			if( isset( $input['single_collection_footer'] ) )
				$new_input['single_collection_footer'] = sanitize_text_field( $input['single_collection_footer'] ) ? sanitize_text_field( $input['single_collection_footer'] ) : 'default';





			if( isset( $input['archive_artist_header'] ) )
				$new_input['archive_artist_header'] = sanitize_text_field( $input['archive_artist_header'] ) ? sanitize_text_field( $input['archive_artist_header'] ) : 'default';

			if( isset( $input['archive_artist_footer'] ) )
				$new_input['archive_artist_footer'] = sanitize_text_field( $input['archive_artist_footer'] ) ? sanitize_text_field( $input['archive_artist_footer'] ) : 'default';


			if( isset( $input['single_artist_header'] ) )
				$new_input['single_artist_header'] = sanitize_text_field( $input['single_artist_header'] ) ? sanitize_text_field( $input['single_artist_header'] ) : 'default';

			if( isset( $input['single_artist_footer'] ) )
				$new_input['single_artist_footer'] = sanitize_text_field( $input['single_artist_footer'] ) ? sanitize_text_field( $input['single_artist_footer'] ) : 'default';

			

			return $new_input;
		}


		public static function create_admin_setting_page() { ?>
			<div class="wrap ovacoll_admin_setting">
				<h1><?php esc_html_e( "Collection Settings", "ova-collection" ); ?></h1>

				<form method="post" action="options.php">
					<div id="tabs">
						<?php settings_fields( 'ovacoll_options_group' ); // Options group ?>

						<!-- Menu Tab -->
						<ul>
							<li><a href="#ovacoll_general_settings"><?php esc_html_e( 'General Settings', 'ova-collection' ); ?></a></li>
							<li><a href="#ovacoll_collection_settings"><?php esc_html_e( 'Collection Settings', 'ova-collection' ); ?></a></li>
							<li><a href="#artist_settings"><?php esc_html_e( 'Artist Settings', 'ova-collection' ); ?></a></li>
						</ul>

						<!-- General Tab Content -->  
						<div id="ovacoll_general_settings" class="ovacoll_general_settings">
							<?php do_settings_sections( 'ovacoll_general_settings' ); // Page ?>
						</div>

						<!-- Collection Settings -->  
						<div id="ovacoll_collection_settings" class="ovacoll_collection_settings">
							<?php do_settings_sections( 'ovacoll_collection_settings' ); // Page ?>
						</div>

						<!-- Collection Settings -->  
						<div id="artist_settings" class="ovacoll_artist_settings">
							<?php do_settings_sections( 'archive_artist_settings' ); // Page ?>
							<hr>
							<?php do_settings_sections( 'single_artist_settings' ); // Page ?>

						</div>

					</div>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php }


		/**
		 * General Settings
		 */
		public function collection_post_type_rewrite_slug(){
			$collection_post_type_rewrite_slug =  OVACOLL_Settings::collection_post_type_rewrite_slug();

			printf(
				'<input type="text"  id="collection_post_type_rewrite_slug" name="ovacoll_options[collection_post_type_rewrite_slug]" value="%s" />',
				isset( $collection_post_type_rewrite_slug ) ? $collection_post_type_rewrite_slug : 'collection'
			);

			echo '<span >'.esc_html__(' Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long and  without any spaces', 'ova-collection').'<span>';
		}

		public function collection_post_type_rewrite_artist_slug(){
			$collection_post_type_rewrite_artist_slug =  OVACOLL_Settings::collection_post_type_rewrite_artist_slug();

			printf(
				'<input type="text"  id="collection_post_type_rewrite_artist_slug" name="ovacoll_options[collection_post_type_rewrite_artist_slug]" value="%s" />',
				isset( $collection_post_type_rewrite_artist_slug ) ? $collection_post_type_rewrite_artist_slug : 'artist'
			);

			echo '<span >'.esc_html__(' Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long and  without any spaces', 'ova-collection').'<span>';
		}


		/**
		 * Collection Settings
		 */
		public function archive_collection_orderby(){
			$archive_collection_orderby = OVACOLL_Settings::archive_collection_orderby();
			$archive_collection_orderby = isset( $archive_collection_orderby ) ? $archive_collection_orderby : 'date';

			$title                  = ( 'title' == $archive_collection_orderby) ? 'selected' : '';
			$collection_custom_sort = ( 'collection_custom_sort' == $archive_collection_orderby) ? 'selected' : '';
			$date                   = ( 'date' == $archive_collection_orderby) ? 'selected' : '';
			$id                     = ( 'ID' == $archive_collection_orderby) ? 'selected' : '';

			?>
			<select name="ovacoll_options[archive_collection_orderby]" id="archive_collection_orderby">
				<option <?php echo esc_attr($date) ?> value="date"><?php echo esc_html__('Date', 'ova-collection') ?></option>
				<option <?php echo esc_attr($title) ?> value="title"><?php echo esc_html__('Title', 'ova-collection') ?></option>
				<option <?php echo esc_attr($collection_custom_sort) ?> value="collection_custom_sort"><?php echo esc_html__('Custom Sort', 'ova-collection') ?></option>
				<option <?php echo esc_attr($id) ?> value="ID"><?php echo esc_html__('ID', 'ova-collection') ?></option>
			</select>
			<?php
		}

		public function archive_collection_order(){
			$archive_collection_order = OVACOLL_Settings::archive_collection_order(); 	
			$archive_collection_order = isset( $archive_collection_order ) ? $archive_collection_order : 'ASC';

			$asc_selected  = ('ASC' == $archive_collection_order) ? 'selected' : '';
			$desc_selected = ('DESC' == $archive_collection_order) ? 'selected' : '';

			?>
			<select name="ovacoll_options[archive_collection_order]" id="archive_collection_order">
				<option <?php echo esc_attr($asc_selected) ?> value="ASC"><?php echo esc_html__('Ascending', 'ova-collection') ?></option>
				<option <?php echo esc_attr($desc_selected) ?> value="DESC"><?php echo esc_html__('Descending', 'ova-collection') ?></option>
			</select>
			<?php
		}

		

		public function archive_collection_heading(){
			$archive_collection_heading =  OVACOLL_Settings::archive_collection_heading();

			isset( $archive_collection_heading ) ? $archive_collection_heading : '';
			printf(
				'<input type="text"  id="archive_collection_heading" name="ovacoll_options[archive_collection_heading]" value="%s" />',
				isset( $archive_collection_heading ) ? $archive_collection_heading : ''
			);
		}

		public function archive_collection_desc(){
			$archive_collection_desc =  OVACOLL_Settings::archive_collection_desc();

			isset( $archive_collection_desc ) ? $archive_collection_desc : '';
			printf(
				'<textarea id="archive_collection_desc" rows="4" cols="50" name="ovacoll_options[archive_collection_desc]" value="%s">'.$archive_collection_desc.'</textarea>',
				isset( $archive_collection_desc ) ? $archive_collection_desc : ''
			);
		}

		public function archive_collection_type(){
			$archive_collection_type = OVACOLL_Settings::archive_collection_type(); 	
			$archive_collection_type = isset( $archive_collection_type ) ? $archive_collection_type : 'type1';

			$type1 = ('type1' == $archive_collection_type) ? 'selected' : '';
			$type2 = ('type2' == $archive_collection_type) ? 'selected' : '';

			?>
			<select name="ovacoll_options[archive_collection_type]" id="archive_collection_type">
				<option <?php echo esc_attr($type1) ?> value="type1"><?php echo esc_html__('Type 1', 'ova-collection') ?></option>
				<option <?php echo esc_attr($type2) ?> value="type2"><?php echo esc_html__('Type 2', 'ova-collection') ?></option>
			</select>
			<?php
		}

		public function archive_collection_header(){
			$archive_collection_header = OVACOLL_Settings::archive_collection_header(); 	
			$archive_collection_header = isset( $archive_collection_header ) ? $archive_collection_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovacoll_options[archive_collection_header]" id="archive_collection_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $archive_collection_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function archive_collection_footer(){
			$archive_collection_footer = OVACOLL_Settings::archive_collection_footer(); 	
			$archive_collection_footer = isset( $archive_collection_footer ) ? $archive_collection_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovacoll_options[archive_collection_footer]" id="archive_collection_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $archive_collection_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}



		public function single_collection_header(){
			$single_collection_header = OVACOLL_Settings::single_collection_header(); 	
			$single_collection_header = isset( $single_collection_header ) ? $single_collection_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovacoll_options[single_collection_header]" id="single_collection_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $single_collection_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_collection_footer(){
			$single_collection_footer = OVACOLL_Settings::single_collection_footer(); 	
			$single_collection_footer = isset( $single_collection_footer ) ? $single_collection_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovacoll_options[single_collection_footer]" id="single_collection_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $single_collection_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}




		

		/**
		 * Artist Settings
		 */
		public function archive_artist_orderby(){
			$archive_artist_orderby = OVACOLL_Settings::archive_artist_orderby();
			$archive_artist_orderby = isset( $archive_artist_orderby ) ? $archive_artist_orderby : 'date';
			
			$title              = ( 'title' == $archive_artist_orderby) ? 'selected' : '';
			$artist_custom_sort = ( 'artist_custom_sort' == $archive_artist_orderby) ? 'selected' : '';
			$date               = ( 'date' == $archive_artist_orderby) ? 'selected' : '';
			$id                 = ( 'ID' == $archive_artist_orderby) ? 'selected' : '';

			?>
			<select name="ovacoll_options[archive_artist_orderby]" id="archive_artist_orderby">
				<option <?php echo esc_attr($date) ?> value="date"><?php echo esc_html__('Date', 'ova-collection') ?></option>
				<option <?php echo esc_attr($title) ?> value="title"><?php echo esc_html__('Title', 'ova-collection') ?></option>
				<option <?php echo esc_attr($artist_custom_sort) ?> value="artist_custom_sort"><?php echo esc_html__('Custom Sort', 'ova-collection') ?></option>
				<option <?php echo esc_attr($id) ?> value="ID"><?php echo esc_html__('ID', 'ova-collection') ?></option>
			</select>
			<?php
		}

		public function archive_artist_order(){
			$archive_artist_order = OVACOLL_Settings::archive_artist_order(); 	
			$archive_artist_order = isset( $archive_artist_order ) ? $archive_artist_order : 'ASC';

			$asc_selected  = ('ASC' == $archive_artist_order) ? 'selected' : '';
			$desc_selected = ('DESC' == $archive_artist_order) ? 'selected' : '';

			?>
			<select name="ovacoll_options[archive_artist_order]" id="archive_artist_order">
				<option <?php echo esc_attr($asc_selected) ?> value="ASC"><?php echo esc_html__('Ascending', 'ova-collection') ?></option>
				<option <?php echo esc_attr($desc_selected) ?> value="DESC"><?php echo esc_html__('Descending', 'ova-collection') ?></option>
			</select>
			<?php
		}

		public function background_heading_archive_aritst( ) {

			$background_heading_archive_aritst = OVACOLL_Settings::background_heading_archive_aritst();

			$value = '';
			if ( $background_heading_archive_aritst ) {
				$image_attributes = wp_get_attachment_image_src( $background_heading_archive_aritst, 'medium' );
				$src = $image_attributes[0];
				$value = $background_heading_archive_aritst;
			}

			?>
			<div class="upload">
				<?php if( $background_heading_archive_aritst ) { ?>
					<img data-src="<?php echo esc_attr($src) ?>" src="<?php echo esc_attr($src) ?>" width="100px"/>
				<?php } ?>
				<div>
					<input type="hidden" name="ovacoll_options[background_heading_archive_aritst]" id="background_heading_archive_aritst" value="<?php echo esc_attr($value) ?>" />
					<button type="submit" class="upload_image_button button"><?php echo esc_html('Upload') ?></button>
					<button type="submit" class="remove_image_button button">&times;</button>
				</div>
			</div>
			<?php
		}

		public function archive_artist_heading(){
			$archive_artist_heading =  OVACOLL_Settings::archive_artist_heading();

			isset( $archive_artist_heading ) ? $archive_artist_heading : '';
			printf(
				'<input type="text"  id="archive_artist_heading" name="ovacoll_options[archive_artist_heading]" value="%s" />',
				isset( $archive_artist_heading ) ? $archive_artist_heading : ''
			);
		}

		public function archive_artist_desc(){
			$archive_artist_desc =  OVACOLL_Settings::archive_artist_desc();

			isset( $archive_artist_desc ) ? $archive_artist_desc : 'ASC';
			printf(
				'<textarea id="archive_artist_desc" rows="4" cols="50" name="ovacoll_options[archive_artist_desc]" value="%s">'.$archive_artist_desc.'</textarea>',
				isset( $archive_artist_desc ) ? $archive_artist_desc : ''
			);
		}

		
		public function archive_artist_header(){
			$archive_artist_header = OVACOLL_Settings::archive_artist_header(); 	
			$archive_artist_header = isset( $archive_artist_header ) ? $archive_artist_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovacoll_options[archive_artist_header]" id="archive_artist_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $archive_artist_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function archive_artist_footer(){
			$archive_artist_footer = OVACOLL_Settings::archive_artist_footer(); 	
			$archive_artist_footer = isset( $archive_artist_footer ) ? $archive_artist_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovacoll_options[archive_artist_footer]" id="archive_artist_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $archive_artist_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}



		public function single_artist_header(){
			$single_artist_header = OVACOLL_Settings::single_artist_header(); 	
			$single_artist_header = isset( $single_artist_header ) ? $single_artist_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovacoll_options[single_artist_header]" id="single_artist_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $single_artist_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_artist_footer(){
			$single_artist_footer = OVACOLL_Settings::single_artist_footer(); 	
			$single_artist_footer = isset( $single_artist_footer ) ? $single_artist_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovacoll_options[single_artist_footer]" id="single_artist_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $single_artist_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}


	}

	if( is_admin() ) new OVACOLL_admin_settings();
	
}