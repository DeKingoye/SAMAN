<?php
namespace ova_collections_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_artists extends Widget_Base {


	public function get_name() {
		return 'ova_artists';
	}

	public function get_title() {
		return __( 'Explore the Artists', 'ova-collection' );
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
				'label' => __( 'Content', 'ova-collection' ),
			]
		);

		$this->add_control(
			'total_count',
			[
				'label'   => __( 'Total Artist', 'ova-collection' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3
			]
		);

		$this->add_control(
			'number_artist_on_row',
			[
				'label' => __( 'Number Artist on row', 'ova-collection' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '33.3333%',
				'options' => [
					'50%'      => __( '2', 'ova-collection' ),
					'33.3333%' => __( '3', 'ova-collection' ),
					'25%'      => __( '4', 'ova-collection' ),
				],
				'selectors' => [
					'{{ WRAPPER }} .archive_artist .content .items' => 'width: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'show_name',
			[
				'label' => __( 'Show Name', 'ova-collection' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ova-collection' ),
				'label_off' => __( 'Hide', 'ova-collection' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .archive_artist .content .items .name ' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'show_type',
			[
				'label' => __( 'Show Type', 'ova-collection' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ova-collection' ),
				'label_off' => __( 'Hide', 'ova-collection' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .archive_artist .content .items .skill ' => 'display: block;',
				],
			]
		);

		$this->add_control(
			'show_contact',
			[
				'label' => __( 'Show Contact', 'ova-collection' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ova-collection' ),
				'label_off' => __( 'Hide', 'ova-collection' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .archive_artist .content .items .contact ' => 'display: block;',
				],
			]
		);

	}


	protected function render() {

		$settings = $this->get_settings();

		$colection_type = '';

		$args= array(
			'post_type' => 'artist',
			'post_status' => 'publish',
			'posts_per_page' => $settings['total_count']
		);
		
		$artists  = new \WP_Query($args); ?>

		<div class="container">
			<div class="row">
				<div class="archive_artist elementor-artists">

					<div class="content">
						<?php if($artists->have_posts() ) : while ( $artists->have_posts() ) : $artists->the_post(); ?>

							<div class="items elementor-items">
								<?php 

								$id = get_the_id();

								$collection_artist  = get_post_meta( $id , 'collection_artist' , true ); 

								$artist_skill = get_post_meta( $id, 'artist_skill', true );

								$artist_phone = get_post_meta( $id, 'artist_phone', true );

								$artist_email = get_post_meta( $id, 'artist_email', true );

								?>


								<a class="img" href="<?php echo get_the_permalink(); ?>">
									<?php echo get_the_post_thumbnail(); ?>
								</a>

								<a class="name second_font" href="<?php echo get_the_permalink(); ?>">
									<?php echo get_the_title(); ?>
								</a>


								<?php if ($artist_skill != '') { ?>
									<div class="skill"> 
										<?php echo esc_html($artist_skill);  ?>
									</div>
								<?php } ?>

								<div class="contact">
									<?php if ($artist_phone != '') { ?>
										<span><a class="phone" href="tel:<?php echo preg_replace('/\s+/', '', $artist_phone);  ?>"><?php echo esc_html($artist_phone . ' /');  ?></a></span>
									<?php } ?>

									<?php if ($artist_email != '') { ?>
										<a href="mailto:<?php echo esc_html($artist_email); ?>" class="email"> 
											<?php esc_html_e( 'Email', 'ova-collection' );  ?>
										</a>
									<?php } ?>
								</div>

							</div>

						<?php endwhile; endif; wp_reset_postdata(); ?>
					</div>

				</div>
			</div>
		</div>

		<?php 
	}
}
