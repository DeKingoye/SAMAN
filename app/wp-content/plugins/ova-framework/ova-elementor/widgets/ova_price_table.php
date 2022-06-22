<?php
namespace ova_framework\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ova_price_table extends Widget_Base {

	public function get_name() {
		return 'ova_price_table';
	}

	public function get_title() {
		return __( 'Price Table', 'ova-framework' );
	}

	public function get_icon() {
		return 'fa fa-table';
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
				'label' => __( 'Price Table', 'ova-framework' ),
			]
		);
 
			$this->add_control(
				'type',
				[
					'label' => __( 'Type', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('Individual', 'ova-framework'),
				]
			);


			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('flaticon-user', 'ova-framework'),
				]
			);

			$this->add_control(
				'price',
				[
					'label' => __( 'Price', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('£50', 'ova-framework'),
				]
			);

			$this->add_control(
				'per_time',
				[
					'label' => __( 'Per Time', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('year', 'ova-framework'),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __('Invitations to members-only events, priority registration and program discounts, and more.', 'ova-framework'),
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => __( 'Text Button', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __('JOIN NOW', 'ova-framework'),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ova-framework' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'ova-framework' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);


		$this->end_controls_section();

		// end tab section_content

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div class="ova-price-table">
			<div class="type">
				<h3><?php echo esc_html($settings['type']) ?></h3>
			</div>
			<div class="wp-icon">
				<div class="icon">
					<i class="<?php echo esc_attr($settings['icon']) ?>"></i>
				</div>
			</div>
			<div class="wp-price">
				<span class="price"><?php echo esc_html($settings['price']) ?></span>
				<span class="separator"><?php echo esc_html__('/', 'ova-framework') ?></span>
				<span class="per_time"><?php echo esc_html($settings['per_time']) ?></span>
			</div>
			<div class="desc"><?php echo $settings['desc'] ?></div>
			<div class="readmore">
				<a href="<?php echo esc_attr($settings['link']['url']) ?>" class="text-button"><?php echo esc_html($settings['text_button']) ?></a>
			</div>
		</div>
	<?php
	}
}
