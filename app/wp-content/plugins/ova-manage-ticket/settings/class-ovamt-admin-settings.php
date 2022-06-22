<?php 

if( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVAMT_Admin_Settings' ) ){

	/**
	 * Make Admin Class
	 */
	class OVAMT_Admin_Settings{

		/**
		 * Construct Admin
		 */
		public function __construct(){
			add_action( 'admin_init', array( $this, 'register_options' ) );
		}

		public function print_options_section(){
			return true;
		}

		public function register_options(){

			register_setting(
				'ovamt_options_group', // Option group
				'ovamt_options', // Name Option
				array( $this, 'settings_callback' ) // Call Back
			);

			/**
			 * General Settings
			 */
			// Add Section: General Settings
			add_settings_section(
				'general_section_id', // ID
				esc_html__('General Setting', 'ovamt'), // Title
				array( $this, 'print_options_section' ),
				'ovamt_general_settings' // Page
			);

			// Add Fields: General Section
			add_settings_field(
				'ovamt_product_slug', // ID
				esc_html__('Choose a product','ovamt'),
				array( $this, 'ovamt_product_slug' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			// Add Fields: General Section
			add_settings_field(
				'ovamt_date_time', // ID
				esc_html__('Make Time Range','ovamt'),
				array( $this, 'ovamt_date_time' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			add_settings_field(
				'ovamt_date_format', // ID
				esc_html__('Date Format','ovamt'),
				array( $this, 'ovamt_date_format' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			add_settings_field(
				'ovamt_disabled_week_days', // ID
				esc_html__('Disabled WeekDays ','ovamt'),
				array( $this, 'ovamt_disabled_week_days' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			add_settings_field(
				'ovamt_disabled_date', // ID
				esc_html__('Disabled Days ','ovamt'),
				array( $this, 'ovamt_disabled_date' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			add_settings_field(
				'ovamt_pagi_num', // ID
				esc_html__('Item in each Manage Ticket Page','ovamt'),
				array( $this, 'ovamt_pagi_num' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

			add_settings_field(
				'ovamt_lang', // ID
				esc_html__('Language display in Date Calendar','ovamt'),
				array( $this, 'ovamt_lang' ),
				'ovamt_general_settings', // Page
				'general_section_id' // Section ID
			);

		}

		public function settings_callback( $input ){

			$new_input = array();

			if( isset( $input['ovamt_product_slug'] ) )
				$new_input['ovamt_product_slug'] = sanitize_text_field( $input['ovamt_product_slug'] ) ? sanitize_text_field( $input['ovamt_product_slug'] ) : '';

			if( isset( $input['ovamt_date_time'] ) )
				$new_input['ovamt_date_time'] = sanitize_text_field( $input['ovamt_date_time'] ) ? sanitize_text_field( $input['ovamt_date_time'] ) : '';

			if( isset( $input['ovamt_date_format'] ) )
				$new_input['ovamt_date_format'] = sanitize_text_field( $input['ovamt_date_format'] ) ? sanitize_text_field( $input['ovamt_date_format'] ) : 'Y/m/d';

			if( isset( $input['ovamt_disabled_week_days'] ) )
				$new_input['ovamt_disabled_week_days'] = sanitize_text_field( $input['ovamt_disabled_week_days'] ) ? sanitize_text_field( $input['ovamt_disabled_week_days'] ) : '';

			if( isset( $input['ovamt_disabled_date'] ) )
				$new_input['ovamt_disabled_date'] = sanitize_text_field( $input['ovamt_disabled_date'] ) ? sanitize_text_field( $input['ovamt_disabled_date'] ) : '';

			if( isset( $input['ovamt_pagi_num'] ) )
				$new_input['ovamt_pagi_num'] = sanitize_text_field( $input['ovamt_pagi_num'] ) ? sanitize_text_field( $input['ovamt_pagi_num'] ) : '20';

			if( isset( $input['ovamt_lang'] ) )
				$new_input['ovamt_lang'] = sanitize_text_field( $input['ovamt_lang'] ) ? sanitize_text_field( $input['ovamt_lang'] ) : 'en';



			
			
			
			return $new_input;
		}

		


		public static function create_admin_setting_page() { ?>
			<div class="wrap">
				<h1><?php esc_html_e( "Manage Ticket Settings", "ovamt" ); ?></h1>

				<form method="post" action="options.php">

					<div id="tabs">

						<?php settings_fields( 'ovamt_options_group' ); // Options group ?>

						<!-- Menu Tab -->
						<ul>
							<li><a href="#general_settings"><?php esc_html_e( 'General Settings', 'ovamt' ); ?></a></li>
							
						</ul>


						<!-- General Tab Content -->  
						<div id="general_settings" class="ovamt_settings">
							<?php do_settings_sections( 'ovamt_general_settings' ); // Page ?>
						</div>

					</div>


					<?php submit_button(); ?>
				</form>
			</div>

		<?php }




		

		public function ovamt_product_slug(){

			$ovamt_product_slug = OVAMT_Settings::ovamt_product_slug();
			$ovamt_product_slug = isset( $ovamt_product_slug ) ? $ovamt_product_slug : '';

			$args_p = array(
				'post_type'	=> 'product',
				'post_status'	=> 'publish',
				'posts_per_page' => '-1',
			);

			$p = new WP_Query( $args_p );

			$html = '<select name="ovamt_options[ovamt_product_slug]">';
			$html .= '<option value=""></option>';

			if ( $p->have_posts() ) : while ( $p->have_posts() ) : $p->the_post();
				
				global $post;
				
				$html .= '<option value="'.$post->post_name.'" '.selected( $ovamt_product_slug, $post->post_name, false).'>'.get_the_title().'</option>';
				
			endwhile;endif;

			$html .= '</select">';

			echo $html;
		}

		public function ovamt_date_time(){

			$html = '<textarea cols="100" rows="5" name="ovamt_options[ovamt_date_time]">'.OVAMT_Settings::ovamt_date_time().'</textarea>';
			
			echo $html;
			echo '<br/>'.esc_html__('Syntax: ', 'ovamt').'label1,value1 | label2,value2'.'<br/>';
			echo '<br/>'.esc_html__('If you doesnt insert : ', 'ovamt').'label1,value1 | label2,value2'.'<br/>';
			echo esc_html_e('Example: ', 'ovamt').'Select Time | 07:30 am - 11:30 pm , 07:30 am - 11:30 pm | 10:00 am - 2:00 pm , 10:00 am - 2:00 pm | 1:00 am - 5:00 pm , 1:00 am - 5:00 pm';
		}

		public function ovamt_date_format(){
			$date_format = OVAMT_Settings::ovamt_date_format() ? OVAMT_Settings::ovamt_date_format() : 'Y/m/d';
			$html = '<input type="text" name="ovamt_options[ovamt_date_format]" value="'.$date_format.'" />';
			
			echo $html;
			echo '<br/>'.esc_html__('You can find format: ', 'ovamt').'<a href="http://php.net/manual/ru/function.date.php" target="_blank">Here</a>';
			echo '<br/>'.esc_html__('Example: ', 'ovamt').'Y/m/d';
		}

		public function ovamt_disabled_week_days(){
			$ovamt_disabled_week_days = OVAMT_Settings::ovamt_disabled_week_days() ? OVAMT_Settings::ovamt_disabled_week_days() : '';
			$html = '<input type="text" name="ovamt_options[ovamt_disabled_week_days]" value="'.$ovamt_disabled_week_days.'" />';
			
			echo $html;
			echo '<br/>'.esc_html__('0: Sunday, 1: Monday, 2: Tuesday, 3: Wednesday, 4: Thursday, 5: Friday, 6: Saturday', 'ovamt');
			echo '<br/>'.esc_html__('Example: 0,3,4', 'ovamt');
		}

		public function ovamt_disabled_date(){
			$ovamt_disabled_date = OVAMT_Settings::ovamt_disabled_date() ? OVAMT_Settings::ovamt_disabled_date() : '';
			
			$html = '<textarea name="ovamt_options[ovamt_disabled_date]" cols="100" rows="5">'.$ovamt_disabled_date.'</textarea>';
			echo $html;
			echo '<br/>'.esc_html__("Example", 'ovamt').'  '."['25/03/2019','25/04/2019','25/05/2019','12/05/2019','12/07/2019','15/08/2019']";
			
		}

		public function ovamt_pagi_num(){
			$ovamt_pagi_num = OVAMT_Settings::ovamt_pagi_num() ? OVAMT_Settings::ovamt_pagi_num() : '20';
			$html = '<input type="number" name="ovamt_options[ovamt_pagi_num]" value="'.$ovamt_pagi_num.'" />';
			
			echo $html;
			
		}

		public function ovamt_lang(){
			$ovamt_lang = OVAMT_Settings::ovamt_lang() ? OVAMT_Settings::ovamt_lang() : 'en';
			$html = '<input type="text" name="ovamt_options[ovamt_lang]" value="'.$ovamt_lang.'" />';
			
			echo $html;
			echo '<br/>'.esc_html__('You can check language here','ovamt').' <a href="https://xdsoft.net/jqplugins/datetimepicker/#lang" target="_blank">'.'https://xdsoft.net/jqplugins/datetimepicker/#lang</a>';
			
		}

		

		

		
		
		


	}
	new OVAMT_Admin_Settings();
}
