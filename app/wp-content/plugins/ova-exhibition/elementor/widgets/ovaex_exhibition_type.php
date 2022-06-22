<?php
namespace ovaex_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use OVAEX_Settings;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ovaex_exhibition_type extends Widget_Base {


	public function get_name() {
		return 'ovaex_exhibition_type';
	}

	public function get_title() {
		return __( 'Exhibition Grid & Slide', 'ovaex' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style( 'owl-carousel', OVAEX_PLUGIN_URI.'assets/libs/owl-carousel/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', OVAEX_PLUGIN_URI.'assets/libs/owl-carousel/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'script-elementor' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ovaex' ),
			]
		);

		$this->add_control(
			'total_count',
			[
				'label'   => __( 'Total Exhibition', 'ovaex' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3
			]
		);

		$this->add_control(
			'time_exhibition',
			[
				'label'   => __('Choose time', 'ovaex'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'current'  => __('Current','ovaex'),
					'upcoming' => __('Upcoming','ovaex'),
					'past'     => __('Past','ovaex'),
				],
				'default'   => 'current',
			]
		);

		$this->add_control(
			'upcoming_day_ex',
			[
				'label'     => __('Upcoming Day','ovaex'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 100,
				'min'       => 1,
				'condition' => [
					'time_exhibition' => 'upcoming'
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'ovaex' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'Descending', 'ovaex' ),
					'ASC'  => __( 'Ascending', 'ovaex' ),
					
				],

			]
		);

		$this->add_control(
			'exhibition_type',
			[
				'label' => __('Exhibition Type','ovaex'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'grid' => __('Grid','ovaex'),
					'slide' => __('Slide','ovaex')
				],
				'default' => 'grid'
			]
		);

		$this->add_control(
			'number_artist_on_row',
			[
				'label' => __( 'Number Exhibition on row', 'ovaex' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ex3_columns',
				'options' => [
					'ex2_columns' => __( '2 Columns', 'ovaex' ),
					'ex3_columns' => __( '3 Columns', 'ovaex' ),
					'ex4_columns' => __( '4 Columns', 'ovaex' ),
				],
				'condition' => [
					'exhibition_type' => 'grid'
				]
			]
		);

		$this->add_control(
			'total_columns_slide',
			[
				'label'   => __( 'Desktop: Total item each slide', 'ovaex' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => __( '1 items', 'ovaex' ),
					'2' => __( '2 items', 'ovaex' ),
					'3' => __( '3 items', 'ovaex' ),
					'4' => __( '4 items', 'ovaex' ),
				],
				'condition' => [
					'exhibition_type' => 'slide',  
				]
			]
		);

		$this->add_control(
			'items_ipad',
			[
				'label'   => __( 'Ipad: Total item each slide', 'ovaex'),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => __( '1 items', 'ovaex'),
					'2' => __( '2 items', 'ovaex'),
					'3' => __( '3 items', 'ovaex'),
					'4' => __( '4 items', 'ovaex'),
				],
				'condition' => [
					'exhibition_type' => 'slide',

				]
			]
		);

		$this->add_control(
			'items_mobile',
			[
				'label'   => __( 'Mobile: Total item each slide', 'ovaex'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( '1 items', 'ovaex'),
					'2' => __( '2 items', 'ovaex'),
					'3' => __( '3 items', 'ovaex'),
					'4' => __( '4 items', 'ovaex'),
				],
				'condition' => [
					'exhibition_type' => 'slide',
				]
			]
		);

		$this->add_control(
			'show_time_date',
			[
				'label' => __( 'Show Time/Date', 'ovaex' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ovaex' ),
				'label_off' => __( 'Hide', 'ovaex' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider Settings', 'ovaex' ),
				'condition' => [
					'exhibition_type' => 'slide'
				]
			]
		);

		$this->add_control(
			'margin_items',
			[
				'label' => __( 'Margin Right Items', 'ovaex' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
			]

		);

		$this->add_control(
			'arows_control',
			[
				'label' => __('Show Navigation', 'ovaex'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'dots_control',
			[
				'label'   => __('Show Paging', 'ovaex'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);


		$this->add_control(
			'pause_on_hover',
			[
				'label'   => __( 'Pause on Hover', 'ovaex' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'ovaex' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed', 'ovaex' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				]
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'ovaex' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'smartspeed',
			[
				'label'   => __( 'Smart Speed', 'ovaex' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500
			]
		);

		$this->add_control(
			'slideby',
			[
				'label' => __( "Navigation slide by x. 'page' string can be set to slide by page.", 'ovaex' ),
				'type'  => Controls_Manager::NUMBER,
				'description' => __( 'Example: 1', 'ovaex' ),
				'default'     => '1'
			]
		);

		$this->add_control(
			'position_arrow',
			[
				'label' => __( 'Position Arrow', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 136,
				],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .wrap-content.owl-carousel .owl-nav .owl-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// SEttings Controls

		// Title style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ovaex' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'ovaex' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content h3',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content h3 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content h3 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_magin',
			[
				'label' => __( 'Title Margin', 'ovaex' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Date_Time_style
		$this->start_controls_section(
			'section_date_time_style',
			[
				'label' => __( 'Date/Time', 'ovaex' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_time_typography',
				'label' => __( 'Typography', 'ovaex' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content .times span',
			]
		);

		$this->add_control(
			'date_time_color',
			[
				'label' => __( 'Text Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .wrap-content .post-items .content .times span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		
		$settings = $this->get_settings();

		$number_artist_on_row = $settings['number_artist_on_row'];

		$exhibition_type = $settings['exhibition_type'];
		$exhibition_class = '';
		if( $exhibition_type == 'slide' ){
			$exhibition_class = 'slide-owl owl-carousel';
		} elseif( $exhibition_type == 'grid'){
			$exhibition_class = 'grid';
		}

		//Get setting slide

		$data_option['total_columns_slide'] = absint( $settings['total_columns_slide'] ); 
		$data_option['items_ipad']          = absint( $settings['items_ipad'] ); 
		$data_option['items_mobile']        = absint( $settings['items_mobile'] ); 
		$data_option['smartSpeed']          = absint( $settings['smartspeed'] );
		$data_option['margin']              = absint( $settings['margin_items'] ); 
		$data_option['loop']                =  ( $settings['infinite'] == 'yes') ? true : false;
		$data_option['autoplay']            =  ( $settings['autoplay'] == 'yes') ? true : false;
		$data_option['autoplayTimeout']     = absint( $settings['autoplay_speed'] );
		$data_option['autoplayHoverPause']  =  ( $settings['pause_on_hover'] == 'yes') ? true : false;
		$data_option['dots']                =  ( $settings['dots_control'] == 'yes') ? true : false;
		$data_option['nav']                 =  ( $settings['arows_control'] == 'yes') ? true : false;
		$data_option['slideBy']             = absint( $settings['slideby'] );
		$data_option['prev'] = '<i class="ti-angle-left"></i>';
		$data_option['next'] = '<i class="ti-angle-right"></i>';
		

		$data_option_encode = wp_json_encode($data_option);

		// Get data Exhibition

		$ovaex_order = $settings['order'];
		$ovaex_post_per_page = $settings['total_count'];

		$upcoming_day = $settings['upcoming_day_ex']; 

		if( $settings['time_exhibition'] == 'current'){
			$args= array(
				'post_type'      => 'exhibition',
				'post_status'    => 'publish',
				'order'          => $ovaex_order,
				'posts_per_page' => $ovaex_post_per_page,
				//'orderby'        => 'meta_value_num',
				'meta_query'     => array(
					
						array(
							'relation' => 'AND',
							array(
								'key'     => 'ex_start_date',
								'value'   => current_time('timestamp' ),
								'compare' => '<'
							),
							array(
								'key'     => 'ex_end_date',
								'value'   => current_time('timestamp' ),
								'compare' => '>='
							)
						)
					
				)
			);
		} elseif( $settings['time_exhibition'] == 'upcoming' ){
			$args= array(
				'post_type'      => 'exhibition',
				'post_status'    => 'publish',
				'order'          => $ovaex_order,
				'posts_per_page' => $ovaex_post_per_page,
				//'orderby'        => 'meta_value_num',
				'meta_query' => array(
					array(
						'relation' => 'AND',
						array(
							'key'      => 'ex_start_date',
							'value'    => current_time( 'timestamp' ),
							'compare'  => '>'
						),
						array(
							'key'     => 'ex_start_date',
							'value'   => current_time( 'timestamp') + ( $upcoming_day * 24 * 60 * 60 ),
							'compare' => '<='
						)	
					)
				)
			);
		} elseif( $settings['time_exhibition'] == 'past' ){
			$args= array(
				'post_type'      => 'exhibition',
				'post_status'    => 'publish',
				'order'          => $ovaex_order,
				'posts_per_page' => $ovaex_post_per_page,
				//'orderby'      => 'meta_value_num',
				'meta_query'     => array(
					array(
						'key'     => 'ex_end_date',
						'value'   => current_time('timestamp' ),
						'compare' => '<',					
					),
				),
			);
		}
		
		$exhibition  = new \WP_Query($args); ?>
		

		<div class="exhibition_arc element_exh">

			<div class="wrap-content <?php echo esc_attr($exhibition_class);?>" <?php if($exhibition_type == 'slide') : ?> data-options="<?php echo esc_attr($data_option_encode); ?>" <?php endif; ?>>
				
				<?php if( $exhibition->have_posts() ) : while( $exhibition->have_posts() ) : $exhibition->the_post();
					
					$post_ID = get_the_ID();

					$date = OVAEX_Settings::ovaex_format_date_frontend();
					
					$ex_start_date = get_post_meta( $post_ID, 'ex_start_date', true );
					$ex_end_date   = get_post_meta( $post_ID, 'ex_end_date', true );

					$date_start_fm = $ex_start_date != '' ? date_i18n($date, $ex_start_date ) : '';
					$date_end_fm   = $ex_end_date != '' ? date_i18n($date, $ex_end_date ) : '';

					$day_week_st   = $ex_start_date != '' ? date_i18n( 'l', $ex_start_date ) : ''; 
					$day_week_end  = $ex_end_date != '' ? date_i18n( 'l', $ex_end_date ) : '';

					$time_start    = $ex_start_date != '' ? date_i18n(get_option('time_format'), $ex_start_date ) : ''; 
					$time_end      = $ex_end_date != '' ? date_i18n(get_option('time_format'), $ex_end_date ) : ''; 

					$link_ex = add_query_arg( apply_filters('ex_back_param', 'back'), apply_filters('ex_back_val', 'ago'), get_the_permalink() );

					?>
					<div class="post-items <?php if( $exhibition_type == 'grid' ){ echo esc_attr($number_artist_on_row); }?>">

						<a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>">
							
							<?php if( has_image_size( 'shop_single' ) ){ ?>
								<?php the_post_thumbnail( 'shop_single', '' ); ?>
							<?php }else{ ?>
								<?php the_post_thumbnail( 'medium_large', '' ); ?>
							<?php } ?>	
						</a>

						<div class="content">

							<h3 class="second_font">
								<a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>">
									<?php the_title();?>
								</a>
							</h3>

							<?php if( $settings['show_time_date'] == 'yes') : ?>
								<div class="times">
									<?php if( $date_start_fm === $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html_e( 'Open', 'ovaex' ).'&nbsp'.esc_html($time_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
									<?php } elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html($date_start_fm);?> -</span>
										<span><?php echo esc_html($date_end_fm);?></span>
									<?php } ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; endif; wp_reset_postdata(); ?>

			</div>

		</div>

	<?php }
}
