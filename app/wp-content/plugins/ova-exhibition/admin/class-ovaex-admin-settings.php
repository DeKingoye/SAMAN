<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVAEX_Admin_Settings' ) ){

	/**
	 * Make Admin Class
	 */
	class OVAEX_Admin_Settings{

		/**
		 * Construct Admin
		 */
		public function __construct(){

			add_action( 'admin_enqueue_scripts', array( $this, 'ovaex_load_media' ) );
			add_action( 'admin_init', array( $this, 'register_options' ) );

		}


		public function ovaex_load_media() {
			wp_enqueue_media();
		}

		public function print_options_section(){
			return true;
		}

		public function register_options(){

			register_setting(
				'ovaex_options_group', // Option group
				'ovaex_options', // Name Option
				array( $this, 'settings_callback' ) // Call Back
			);

			/**
			 * General Settings
			 */
			// Add Section: General Settings
			add_settings_section(
				'ovaex_general_section_id', // ID
				esc_html__('General Setting', 'ovaex'), // Title
				array( $this, 'print_options_section' ),
				'ovaex_general_settings' // Page
			);

			// Add Fields: General Section
			add_settings_field(
				'ovaex_exhibition_post_type_rewrite_slug', // ID
				esc_html__('Rewrite Slug','ovaex'),
				array( $this, 'ovaex_exhibition_post_type_rewrite_slug' ),
				'ovaex_general_settings', // Page
				'ovaex_general_section_id' // Section ID
			);
			
			
			
			

			add_settings_field(
				'ovaex_format_date_lang', // ID
				esc_html__('Calendar Language','ovaex'),
				array( $this, 'ovaex_format_date_lang' ),
				'ovaex_general_settings', // Page
				'ovaex_general_section_id' // Section ID
			);


			/**
			 * General Settings
			 */
			// Add Section: Archive Exhibiton Settings
			add_settings_section(
				'ovaex_archive_exhibition_section_id', // ID
				esc_html__('Archive Exhibiton Settings', 'ovaex'), // Title
				array( $this, 'print_options_section' ),
				'ovaex_archive_exhibiton_settings' // Page
			);

			add_settings_field(
				'ovaex_show_past', // ID
				esc_html__('Show Past in Archive','ovaex'),
				array( $this, 'ovaex_show_past' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_orderby', // ID
				esc_html__('Order By','ovaex'),
				array( $this, 'archive_exhibition_orderby' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_order', // ID
				esc_html__('Order','ovaex'),
				array( $this, 'archive_exhibition_order' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_type', // ID
				esc_html__('Archive Type','ovaex'),
				array( $this, 'archive_exhibition_type' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_heading', // ID
				esc_html__('Heading','ovaex'),
				array( $this, 'archive_exhibition_heading' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_desc', // ID
				esc_html__('Description','ovaex'),
				array( $this, 'archive_exhibition_desc' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'ovaex_format_date_frontend', // ID
				esc_html__('Date Format','ovaex'),
				array( $this, 'ovaex_format_date_frontend' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);


			add_settings_field(
				'archive_exhibition_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'archive_exhibition_header' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'archive_exhibition_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'archive_exhibition_footer' ),
				'ovaex_archive_exhibiton_settings', // Page
				'ovaex_archive_exhibition_section_id' // Section ID
			);

			// Add Section: Single Exhibiton Settings
			add_settings_section(
				'ovaex_single_exhibition_section_id', // ID
				esc_html__('Single Exhibiton Settings', 'ovaex'), // Title
				array( $this, 'print_options_section' ),
				'ovaex_single_exhibiton_settings' // Page
			);

			add_settings_field(
				'ovaex_format_date_frontend_single', // ID
				esc_html__('Date Format','ovaex'),
				array( $this, 'ovaex_format_date_frontend_single' ),
				'ovaex_single_exhibiton_settings', // Page
				'ovaex_single_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'single_exhibition_header', // ID
				esc_html__('Header','ova-collection'),
				array( $this, 'single_exhibition_header' ),
				'ovaex_single_exhibiton_settings', // Page
				'ovaex_single_exhibition_section_id' // Section ID
			);

			add_settings_field(
				'single_exhibition_footer', // ID
				esc_html__('Footer','ova-collection'),
				array( $this, 'single_exhibition_footer' ),
				'ovaex_single_exhibiton_settings', // Page
				'ovaex_single_exhibition_section_id' // Section ID
			);

		}

		public function settings_callback( $input ){

			$new_input = array();

			if( isset( $input['ovaex_exhibition_post_type_rewrite_slug'] ) )
				$new_input['ovaex_exhibition_post_type_rewrite_slug'] = sanitize_text_field( $input['ovaex_exhibition_post_type_rewrite_slug'] ) ? sanitize_text_field( $input['ovaex_exhibition_post_type_rewrite_slug'] ) : 'exhibition';

			if( isset( $input['ovaex_show_past'] ) )
				$new_input['ovaex_show_past'] = sanitize_text_field( $input['ovaex_show_past'] ) ? sanitize_text_field( $input['ovaex_show_past'] ) : 'yes';

			if( isset( $input['archive_exhibition_orderby'] ) )
				$new_input['archive_exhibition_orderby'] = sanitize_text_field( $input['archive_exhibition_orderby'] ) ? sanitize_text_field( $input['archive_exhibition_orderby'] ) : 'title';

			if( isset( $input['archive_exhibition_order'] ) )
				$new_input['archive_exhibition_order'] = sanitize_text_field( $input['archive_exhibition_order'] ) ? sanitize_text_field( $input['archive_exhibition_order'] ) : 'ASC';

			if( isset( $input['archive_exhibition_heading'] ) )
				$new_input['archive_exhibition_heading'] = sanitize_text_field( $input['archive_exhibition_heading'] ) ? sanitize_text_field( $input['archive_exhibition_heading'] ) : '';

			if( isset( $input['archive_exhibition_desc'] ) )
				$new_input['archive_exhibition_desc'] = sanitize_text_field( $input['archive_exhibition_desc'] ) ? sanitize_text_field( $input['archive_exhibition_desc'] ) : '';

			if( isset( $input['archive_exhibition_type'] ) )
				$new_input['archive_exhibition_type'] = sanitize_text_field( $input['archive_exhibition_type'] ) ? sanitize_text_field( $input['archive_exhibition_type'] ) : 'grid';

			

			

			if( isset( $input['ovaex_format_date_lang'] ) )
				$new_input['ovaex_format_date_lang'] = sanitize_text_field( $input['ovaex_format_date_lang'] ) ? sanitize_text_field( $input['ovaex_format_date_lang'] ) : 'en';

			if( isset( $input['ovaex_format_date_frontend'] ) )
				$new_input['ovaex_format_date_frontend'] = sanitize_text_field( $input['ovaex_format_date_frontend'] ) ? sanitize_text_field( $input['ovaex_format_date_frontend'] ) : 'M d, Y';

			if( isset( $input['ovaex_format_date_frontend_single'] ) )
				$new_input['ovaex_format_date_frontend_single'] = sanitize_text_field( $input['ovaex_format_date_frontend_single'] ) ? sanitize_text_field( $input['ovaex_format_date_frontend_single'] ) : 'd M Y';


			if( isset( $input['archive_exhibition_header'] ) )
				$new_input['archive_exhibition_header'] = sanitize_text_field( $input['archive_exhibition_header'] ) ? sanitize_text_field( $input['archive_exhibition_header'] ) : 'default';

			if( isset( $input['archive_exhibition_footer'] ) )
				$new_input['archive_exhibition_footer'] = sanitize_text_field( $input['archive_exhibition_footer'] ) ? sanitize_text_field( $input['archive_exhibition_footer'] ) : 'default';

			if( isset( $input['single_exhibition_header'] ) )
				$new_input['single_exhibition_header'] = sanitize_text_field( $input['single_exhibition_header'] ) ? sanitize_text_field( $input['single_exhibition_header'] ) : 'default';

			if( isset( $input['single_exhibition_footer'] ) )
				$new_input['single_exhibition_footer'] = sanitize_text_field( $input['single_exhibition_footer'] ) ? sanitize_text_field( $input['single_exhibition_footer'] ) : 'default';

			return $new_input;
		}


		public static function create_admin_setting_page() { ?>
			<div class="wrap">
				<h1><?php esc_html_e( "Exhibiton Settings", "ovaex" ); ?></h1>

				<form method="post" action="options.php">
					<div id="tabs">
						<?php settings_fields( 'ovaex_options_group' ); // Options group ?>

						<!-- Menu Tab -->
						<ul>
							<li><a href="#ovaex_general_settings"><?php esc_html_e( 'General Settings', 'ovaex' ); ?></a></li>
							<li><a href="#ovaex_exhibiton_settings"><?php esc_html_e( 'Exhibiton Settings', 'ovaex' ); ?></a></li>
						</ul>

						<!-- General Tab Content -->  
						<div id="ovaex_general_settings" class="ovaex_admin_settings">
							<?php do_settings_sections( 'ovaex_general_settings' ); // Page ?>
						</div>

						<!-- General Tab Content -->  
						<div id="ovaex_exhibiton_settings" class="ovaex_admin_settings">
							<?php do_settings_sections( 'ovaex_archive_exhibiton_settings' ); // Page ?>
							<hr>
							<?php do_settings_sections( 'ovaex_single_exhibiton_settings' ); // Page ?>
						</div>
					</div>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php }

		/***** General Settings *****/
		public function ovaex_exhibition_post_type_rewrite_slug(){
			$ovaex_exhibition_post_type_rewrite_slug = esc_attr( OVAEX_Settings::ovaex_exhibition_post_type_rewrite_slug() );
			printf(
				'<input type="text"  id="ovaex_exhibition_post_type_rewrite_slug" name="ovaex_options[ovaex_exhibition_post_type_rewrite_slug]" value="%s" />',
				isset( $ovaex_exhibition_post_type_rewrite_slug ) ? $ovaex_exhibition_post_type_rewrite_slug : 'exhibition'
			);
			echo '<span >'.esc_html__(' Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long and  without any spaces', 'ovaex').'<span>';
		}
		

		public function ovaex_format_date_lang(){
			$ovaex_format_date_lang = OVAEX_Settings::ovaex_format_date_lang() ? OVAEX_Settings::ovaex_format_date_lang() : 'en';
			?>
			<input type="text" name="ovaex_options[ovaex_format_date_lang]" value="<?php echo esc_attr($ovaex_format_date_lang) ?>" />
			<?php
			echo esc_html__('Example: en','ovaex');
			echo '<br/>'.esc_html__('You can check language here','ovaex').' <a href="https://xdsoft.net/jqplugins/datetimepicker/#lang" target="_blank">'.'Here'.'</a>';
		}


		/***** Exhibition Settings *****/
		public function ovaex_show_past() {
			$ovaex_show_past = esc_attr( OVAEX_Settings::ovaex_show_past() );
			$ovaex_show_past = isset( $ovaex_show_past ) ? $ovaex_show_past : 'yes';
			$yes = ( 'yes' == $ovaex_show_past ) ? 'selected' : '';
			$no  = ( 'no' == $ovaex_show_past ) ? 'selected' : '';

			?>
			<select name="ovaex_options[ovaex_show_past]" id="ovaex_show_past">
				<option <?php echo esc_attr($yes) ?> value="yes"><?php echo esc_html__('Yes', 'ovaex') ?></option>
				<option <?php echo esc_attr($no) ?> value="no"><?php echo esc_html__('No', 'ovaex') ?></option>
			</select>
			<?php
		}

		public function archive_exhibition_orderby(){
			$archive_exhibition_orderby = OVAEX_Settings::archive_exhibition_orderby();
			$archive_exhibition_orderby = isset( $archive_exhibition_orderby ) ? $archive_exhibition_orderby : 'title';

			$title                  = ( 'title' == $archive_exhibition_orderby) ? 'selected' : '';
			$exhibition_custom_sort = ( 'exhibition_custom_sort' == $archive_exhibition_orderby) ? 'selected' : '';
			$ex_start_date          = ( 'ex_start_date' == $archive_exhibition_orderby) ? 'selected' : '';
			$id                     = ( 'ID' == $archive_exhibition_orderby) ? 'selected' : '';

			?>
			<select name="ovaex_options[archive_exhibition_orderby]" id="archive_exhibition_orderby">
				<option <?php echo esc_attr($title) ?> value="title"><?php echo esc_html__('Title', 'ovaex') ?></option>
				<option <?php echo esc_attr($exhibition_custom_sort) ?> value="exhibition_custom_sort"><?php echo esc_html__('Custom Sort', 'ovaex') ?></option>
				<option <?php echo esc_attr($ex_start_date) ?> value="ex_start_date"><?php echo esc_html__('Start Date', 'ovaex') ?></option>
				<option <?php echo esc_attr($id) ?> value="ID"><?php echo esc_html__('ID', 'ovaex') ?></option>
			</select>
			<?php
		}

		public function archive_exhibition_order(){
			$archive_exhibition_order = OVAEX_Settings::archive_exhibition_order(); 	
			$archive_exhibition_order = isset( $archive_exhibition_order ) ? $archive_exhibition_order : 'ASC';

			$asc_selected  = ('ASC' == $archive_exhibition_order) ? 'selected' : '';
			$desc_selected = ('DESC' == $archive_exhibition_order) ? 'selected' : '';

			?>
			<select name="ovaex_options[archive_exhibition_order]" id="archive_exhibition_order">
				<option <?php echo esc_attr($asc_selected) ?> value="ASC"><?php echo esc_html__('Ascending', 'ovaex') ?></option>
				<option <?php echo esc_attr($desc_selected) ?> value="DESC"><?php echo esc_html__('Descending', 'ovaex') ?></option>
			</select>
			<?php
		}

		public function archive_exhibition_type(){
			$archive_exhibition_type = OVAEX_Settings::archive_exhibition_type();
			$archive_exhibition_type = isset( $archive_exhibition_type ) ? $archive_exhibition_type : 'grid';
			
			$grid = ( 'grid' == $archive_exhibition_type) ? 'selected' : '';
			$list = ( 'list' == $archive_exhibition_type) ? 'selected' : '';

			?>
			<select name="ovaex_options[archive_exhibition_type]" id="archive_exhibition_type">
				<option <?php echo esc_attr($grid) ?> value="grid"><?php echo esc_html__('Grid', 'ovaex') ?></option>
				<option <?php echo esc_attr($list) ?> value="list"><?php echo esc_html__('List', 'ovaex') ?></option>
			</select>
			<?php
		}

		public function archive_exhibition_heading(){
			$archive_exhibition_heading =  esc_attr( OVAEX_Settings::archive_exhibition_heading() );
			printf(
				'<input type="text" id="archive_exhibition_heading"  name="ovaex_options[archive_exhibition_heading]" value="%s" />',
				isset( $archive_exhibition_heading ) ? $archive_exhibition_heading : ''
			);
		}

		public function archive_exhibition_desc(){
			$archive_exhibition_desc = esc_attr( OVAEX_Settings::archive_exhibition_desc() );
			printf(
				'<textarea id="archive_exhibition_desc" rows="4" cols="50" name="ovaex_options[archive_exhibition_desc]" value="%s">'.$archive_exhibition_desc.'</textarea>',
				isset( $archive_exhibition_desc ) ? $archive_exhibition_desc : ''
			);
		}

		public function ovaex_format_date_frontend(){
			$ovaex_format_date_frontend = OVAEX_Settings::ovaex_format_date_frontend() ? OVAEX_Settings::ovaex_format_date_frontend() : 'M d, Y';
			?>
			<input type="text" name="ovaex_options[ovaex_format_date_frontend]" value="<?php echo esc_attr($ovaex_format_date_frontend) ?>" />
			<?php
			echo esc_html__('Example: M j, Y','ovaex');
			echo '<br/>'.esc_html__('You can check language here','ovaex').' <a href="http://php.net/manual/en/function.date.php" target="_blank">'.'Here'.'</a>';
		}

		public function ovaex_format_date_frontend_single(){
			$ovaex_format_date_frontend_single = OVAEX_Settings::ovaex_format_date_frontend_single() ? OVAEX_Settings::ovaex_format_date_frontend_single() : 'd M Y';
			?>
			<input type="text" name="ovaex_options[ovaex_format_date_frontend_single]" value="<?php echo esc_attr($ovaex_format_date_frontend_single) ?>" />
			<?php
			echo esc_html__('Example: j M Y','ovaex');
			echo '<br/>'.esc_html__('You can check language here','ovaex').' <a href="http://php.net/manual/en/function.date.php" target="_blank">'.'Here'.'</a>';
		}


		public function archive_exhibition_header(){
			$archive_exhibition_header = OVAEX_Settings::archive_exhibition_header(); 	
			$archive_exhibition_header = isset( $archive_exhibition_header ) ? $archive_exhibition_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovaex_options[archive_exhibition_header]" id="archive_exhibition_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $archive_exhibition_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function archive_exhibition_footer(){
			$archive_exhibition_footer = OVAEX_Settings::archive_exhibition_footer(); 	
			$archive_exhibition_footer = isset( $archive_exhibition_footer ) ? $archive_exhibition_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovaex_options[archive_exhibition_footer]" id="archive_exhibition_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $archive_exhibition_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_exhibition_header(){
			$single_exhibition_header = OVAEX_Settings::single_exhibition_header(); 	
			$single_exhibition_header = isset( $single_exhibition_header ) ? $single_exhibition_header : 'default';

			$list_header = apply_filters('muzze_list_header', '');

			?>
			<select name="ovaex_options[single_exhibition_header]" id="single_exhibition_header">
				<?php if( $list_header ){ ?>
					<?php foreach ($list_header as $key => $value) { ?>
						<option <?php if( $key == $single_exhibition_header ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}

		public function single_exhibition_footer(){
			$single_exhibition_footer = OVAEX_Settings::single_exhibition_footer(); 	
			$single_exhibition_footer = isset( $single_exhibition_footer ) ? $single_exhibition_footer : 'default';

			$list_footer = apply_filters('muzze_list_footer', '');

			?>
			<select name="ovaex_options[single_exhibition_footer]" id="single_exhibition_footer">
				<?php if( $list_footer ){ ?>
					<?php foreach ($list_footer as $key => $value) { ?>
						<option <?php if( $key == $single_exhibition_footer ) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				<?php } ?>
				
			</select>
			<?php
		}




	}
	new OVAEX_Admin_Settings();
}
