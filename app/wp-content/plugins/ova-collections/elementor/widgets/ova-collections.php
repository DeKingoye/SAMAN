<?php
namespace ova_collections_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_collections extends Widget_Base {


	public function get_name() {
		return 'ova_collections';
	}

	public function get_title() {
		return __( 'Explore the Collection', 'ova-collection' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'ovatheme' ];
	}

	public function get_script_depends() {

		wp_enqueue_script('imagesLoaded');
		wp_enqueue_script('masonry');
		
		return [ 'script-elementor' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ova-collection' ),
			]
		);
		$this->add_control(
			'colection_type',
			[
				'label' => __('Colection Type', 'ova-colection'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'type1' => __('Type 1', 'ova-colection'),
					'type2' => __('Type 2', 'ova-colection')
				],
				'default' => 'type1'
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'   => __( 'Order By', 'ova-colection' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'collection_custom_sort',
				'options' => [
					'title'                  => __( 'Title', 'ova-colection' ),
					'date'                   => __( 'Date', 'ova-colection' ),
					'collection_custom_sort' => __( 'Custom Sort', 'ova-colection' ),
					'ID'                     => __( 'ID', 'ova-colection' ),					
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'ova-collection' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'Descending', 'ova-collection' ),
					'ASC'  => __( 'Ascending', 'ova-collection' ),
					
				],

			]
		);

		$this->add_control(
			'total_count',
			[
				'label'   => __( 'Total Post', 'ova-collection' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'default' => 3
			]
		);

		$this->add_control(
			'filter_type',
			[
				'label' => __( 'Filter Type', 'ova-collection' ),
				'type' => Controls_Manager::TEXT,
				'description' => __( 'Insert Slug Type. Example: prints, photography', 'ova-collection' ),
				'default' => '',
			]
		);


		$this->add_control(
			'show_title',
			[
				'label'        => __( 'Show Title', 'ova-collection' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'show_artists',
			[
				'label'        => __( 'Show Artists', 'ova-collection' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		
		$this->end_controls_section();

		// section style //

		// Title style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ova-collection' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'ova-collection' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .archive_collection .content_archive_coll .items_archive_coll .desc .title ',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ova-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_collection .content_archive_coll .items_archive_coll .desc .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'ova-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_collection .content_archive_coll .items_archive_coll .desc .title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_magin',
			[
				'label' => __( 'Title Margin', 'ova-collection' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .archive_collection .content_archive_coll .items_archive_coll .desc .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_artists_style',
			[
				'label' => __( 'Artists', 'ova-collection' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'artists_typography',
				'label' => __( 'Typography', 'ova-collection' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .archive_collection .content_archive_coll.type1 .items_archive_coll .desc .artists a',
			]
		);

		$this->add_control(
			'artists_color',
			[
				'label' => __( 'Artists Color', 'ova-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_collection .content_archive_coll.type1 .items_archive_coll .desc .artists a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'artists_hover_color',
			[
				'label' => __( 'Artists Hover Color', 'ova-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_collection .content_archive_coll.type1 .items_archive_coll .desc .artists a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();		

	}

	protected function render() {

		$settings = $this->get_settings();

		$text_read_more = (!empty($settings['text_read_more'])) ? $settings['text_read_more'] : 'Details';
		$collections_type = (!empty($settings['colection_type'])) ? $settings['colection_type'] : 'type1'; 

		$args_basic = array(
			'post_type'      => 'collection',
			'post_status'    => 'publish',
			'orderby'        => $settings['order_by'],
			'order'          => $settings['order'],
			'posts_per_page' => $settings['total_count']
		);

		if ( $settings['filter_type'] ) {
			$tax_query = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'type',
						'field' => 'slug',
						'terms' =>  explode(',', $settings['filter_type'])
					),
				),
			);
		} else {
			$tax_query = array();
		}
		
		$args = array_merge_recursive( $args_basic, $tax_query );
		
		$collections  = new \WP_Query($args); ?>

		<div class="archive_collection">

			<div class="content_archive_coll <?php echo esc_attr($collections_type);?> element-wrapper">
				<?php if($collections->have_posts() ) : while ( $collections->have_posts() ) : $collections->the_post(); ?>
					<?php 
					$id = get_the_id();

					$collection_year_number = get_post_meta( $id, 'collection_year_number', true );

					$collection_artist  = get_post_meta( $id,'collection_artist', true );

					$args_artist = array(
						'post_type'      => 'artist',
						'posts_per_page' => '-1',
						'post_name__in'  => $collection_artist,
					);

					$artists = get_posts( $args_artist );

					$value_artist = '';
					
					
					?>
					

					<div class="items_archive_coll element-items">
						<div class="wrapper-content">
							<div class="img">
								<?php if( has_image_size( 'shop_single' ) ){ ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'shop_single', '' ); ?></a>
								<?php }else{ ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium_large', '' ); ?></a>
								<?php } ?>
							</div>
							<div class="desc">
								<?php if( $settings['show_title'] == 'yes') : ?>
									<h2 class="title second_font"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?>, <?php echo esc_attr( $collection_year_number ); ?></a></h2>
								<?php endif; ?>
								<?php if( $settings['show_artists'] == 'yes' ) : ?>
									<div class="artists">
										<?php 

											foreach ($artists as $value) {

												$artist_id = $value->ID;
												$artist_link = get_the_permalink( $artist_id );
												$artist_title = get_the_title( $artist_id );
											
												$value_artist .= '<a href=" '.$artist_link.' ">'.$artist_title.'</a>'.', ' ;

											}
											echo substr($value_artist, 0, -2) ;

										 ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

				<?php endwhile;endif; wp_reset_postdata(); ?>
				
			</div>

		</div>
		<?php 
	}
}
