<?php
namespace ovaex_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use OVAEX_Settings;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ovaex_exhibition_ajax extends Widget_Base {


	public function get_name() {
		return 'ovaex_exhibition_ajax';
	}

	public function get_title() {
		return __( 'Exhibition Load Ajax', 'ovaex' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {
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
			'order_by',
			[
				'label'   => __( 'Order By', 'ovaex' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title'                  => __( 'Title', 'ovaex' ),
					'exhibition_custom_sort' => __( 'Custom Sort', 'ovaex' ),
					'ex_start_date'          => __( 'Start Date', 'ovaex' ),
					'ID'                     => __( 'ID', 'ovaex' ),					
				],
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
			'type_exhibition',
			[
				'label' => __('Exhibition Type','ovaex'),
				'type'  => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'type1' => __('Grid','ovaex'),
					'type2' => __('List','ovaex')
				]
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
					'type_exhibition' => 'type1'
				]
			]
		);	

		$this->add_control(
			'upcoming_day',
			[
				'label' => __('Upcoming Day','ovaex'),
				'type' => Controls_Manager::NUMBER,
				'default' => 7,
				'min' => 1,
				'description' => __('Add a day before the event takes place, Ex: 7 day', 'ovaex')
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

		// load more
		$this->start_controls_section(
			'section_load_more_style',
			[
				'label' => __( 'Load More', 'ovaex' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'load_more_typography',
				'label' => __( 'Typography', 'ovaex' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span',
			]
		);

		$this->add_responsive_control(
			'read_more_padding',
			[
				'label' => __( 'Padding', 'ovaex' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'read_more_margin',
			[
				'label' => __( 'Margin', 'ovaex' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'ovaex' ),
			]
		);

		$this->add_control(
			'read_more_text_color',
			[
				'label' => __( 'Text Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'read_more_background_color',
			[
				'label' => __( 'Background Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

				// Tab button hover
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'ovaex' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more:hover, {{WRAPPER}} .exhibition_arc .ova-nodata span:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more:hover, {{WRAPPER}} .exhibition_arc .ova-nodata span:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'ovaex' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more:hover, {{WRAPPER}} .exhibition_arc .ova-nodata span:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'ovaex' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exhibition_arc .ova_more_post .load-more, {{WRAPPER}} .exhibition_arc .ova-nodata span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


	}

	protected function render() {

		
		$settings = $this->get_settings();

		$number_artist_on_row = '';

		$ehibition_type = $settings['type_exhibition'];

		if( $ehibition_type == 'type1'){
			$number_artist_on_row = $settings['number_artist_on_row'] != '' ? $settings['number_artist_on_row'] : '';
		} elseif( $ehibition_type == 'type2'){
			$number_artist_on_row = 'list';
		}

		$upcoming_day        = absint( $settings['upcoming_day'] );

		$ovaex_order_by      = $settings['order_by'];
		$ovaex_order         = $settings['order'];
		$ovaex_post_per_page = absint( $settings['total_count'] );
		$paged               = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


		switch( $ovaex_order_by ) {
			case 'title' : {
				$agr_order = [
					'orderby'   => 'title',
					'order'          => $ovaex_order,
				];
				break;
			}
			case 'ID' : {
				$agr_order = [
					'orderby'   => 'ID',
					'order'          => $ovaex_order,
				];
				break;
			}
			case 'exhibition_custom_sort' : {
				$agr_order = [
					'orderby'   => 'meta_value',
					'meta_key' => 'exhibition_custom_sort',
					'order'          => $ovaex_order,
				];
				break;
			}
			case 'ex_start_date' : {
				$agr_order = [
					'orderby'   => 'meta_value',
					'meta_key' => 'ex_start_date',
					'order'          => $ovaex_order,
				];
				break;
			}
			default: {
				$agr_order = [
					'orderby'   => 'ID',
					'order'          => $ovaex_order,
				];
				break;
			}
		}

		$args= array(
			'post_type'      => 'exhibition',
			'post_status'    => 'publish',
			'paged'          => $paged,
			'posts_per_page' => $ovaex_post_per_page,
			'meta_query'     => array(
				array(
					array(
						'relation' => 'AND',
						array(
							'key' => 'ex_start_date',
							'value' => current_time('timestamp' ),
							'compare' => '<'
						),
						array(
							'key' => 'ex_end_date',
							'value' => current_time('timestamp' ),
							'compare' => '>='
						)
					)
				)
			)
		); 

		$args = array_merge( $args, $agr_order );

		$exhibition  = new \WP_Query($args); ?>


		<div class="exhibition_arc">

			<div class="wrap-content element-arc">
				
				<ul class="nav nav-tabs">
					<li class="nav-item exhibition_tab_item">
						<a class="nav-link active" href="#current" role="tab" data-toggle="tab" data-behav="tab" data-type_action="current" data-post="exhibition" data-perpage="<?php echo esc_attr($ovaex_post_per_page); ?>" data-paged="1" data-order-by="<?php echo esc_attr($ovaex_order_by);?>" data-order="<?php echo esc_attr($ovaex_order); ?>" data-columns="<?php echo esc_attr($number_artist_on_row);?>" data-upcoming="<?php echo esc_attr($upcoming_day); ?>"><?php esc_html_e('current','ovaex');?></a>
					</li>
					<li class="nav-item exhibition_tab_item">
						<a class="nav-link " href="#" role="tab" data-paged="1" data-toggle="tab" data-behav="tab" data-type_action="upcoming" data-post="exhibition" data-perpage="<?php echo esc_attr($ovaex_post_per_page); ?>" data-order-by="<?php echo esc_attr($ovaex_order_by);?>" data-order="<?php echo esc_attr($ovaex_order); ?>" data-columns="<?php echo esc_attr($number_artist_on_row);?>" data-upcoming="<?php echo esc_attr($upcoming_day); ?>"><?php esc_html_e('upcoming','ovaex');?></a>
					</li>
					<li class="nav-item exhibition_tab_item">
						<a class="nav-link " href="#past" role="tab" data-paged="1" data-behav="tab" data-toggle="tab" data-type_action="past" data-post="exhibition" data-perpage="<?php echo esc_attr($ovaex_post_per_page); ?>" data-order-by="<?php echo esc_attr($ovaex_order_by);?>" data-order="<?php echo esc_attr($ovaex_order); ?>" data-columns="<?php echo esc_attr($number_artist_on_row);?>" data-upcoming="<?php echo esc_attr($upcoming_day); ?>"><?php esc_html_e('past','ovaex');?></a>
					</li>
				</ul>
				<div class="tab-content">
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

						<div class="post-items <?php echo esc_attr($number_artist_on_row);?>">
							<div class="img-exhibition">
								<a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>">
									<?php the_post_thumbnail(); ?>
								</a>
							</div>
							<div class="content">
								<h3 class="second_font">
									<a href="<?php echo esc_url($link_ex); ?>" title="<?php the_title();?>">
										<?php the_title();?>
									</a>
								</h3>
								<div class="times">
									<?php if( $date_start_fm === $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html($date_start_fm) .'&nbsp'.'&#47;'.'&nbsp'. esc_html($time_start) .'&nbsp'.'&#45;'.'&nbsp'. esc_html($time_end);?></span>
									<?php } elseif( $date_start_fm != $date_end_fm && $date_start_fm != '' && $date_end_fm != '' ){ ?>
										<span><?php echo esc_html($date_start_fm);?> -</span>
										<span><?php echo esc_html($date_end_fm);?></span>
									<?php } ?>
								</div>
							</div>
						</div>

					<?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
				</div>           	
			</div>

			
			<div class="ova_more_post" data-behav="load" data-type_action="current" data-paged="2" data-post="exhibition" data-perpage="<?php echo esc_attr($ovaex_post_per_page); ?>" data-order-by="<?php echo esc_attr($ovaex_order_by);?>" data-order="<?php echo esc_attr($ovaex_order); ?>" data-columns="<?php echo esc_attr($number_artist_on_row);?>" data-upcoming="<?php echo esc_attr($upcoming_day); ?>">
				<span class="load-more"><?php echo esc_html__('Load More','ovaex'); ?></span>
				<img class="image-loadmore" src="<?php echo OVAEX_PLUGIN_URI ?>/assets/img/loadmore.GIF" alt="loadmore">
			</div>
			<div class="ova-nodata"><span><?php echo esc_html__('No Data','ovaex'); ?></span></div>

		</div>

	<?php }
}
