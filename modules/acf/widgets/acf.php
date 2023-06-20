<?php
namespace AmadeusElementor\Modules\ACF\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACF extends Widget_Base {

	public function get_name() {
		return 'amadeus-acf';
	}

	public function get_title() {
		return __( 'ACF', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-pushpin';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'advanced custom fields',
			'field',
			'fields',
			'acf',
			'amadeus',
		];
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_acf_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'amadeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>Advanced Custom Fields</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'amadeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_acf',
				[
					'label'         => __( 'ACF', 'amadeus-elementor' ),
				]
			);

			$this->add_control(
				'field_name',
				[
					'label'         => __( 'Field Name', 'amadeus-elementor' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic'       => [ 'active' => true ],
				]
			);

			$this->add_control(
				'field_type',
				[
					'label'         => __( 'Field Type', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'text',
					'options'       => [
						'text' => __( 'Text', 'amadeus-elementor' ),
						'link' => __( 'Link', 'amadeus-elementor' ),
					],
				]
			);

			$this->add_control(
				'link_text',
				[
					'label'         => __( 'Link Text', 'amadeus-elementor' ),
					'type'          => Controls_Manager::TEXT,
					'condition'     => [
						'field_type' => 'link',
					],
					'dynamic'       => [ 'active' => true ],
				]
			);

			$this->add_control(
				'link_target',
				[
					'label'         => __( 'Link Target', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'self',
					'options'       => [
						'self' => __( 'Self', 'amadeus-elementor' ),
						'blank' => __( 'Blank', 'amadeus-elementor' ),
					],
					'condition'     => [
						'field_type' => 'link',
					],
				]
			);

			$this->add_control(
				'link_nofollow',
				[
					'label'         => __( 'Add Nofollow', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'field_type' => 'link',
					],
				]
			);

			$this->add_control(
				'field_label',
				[
					'label'         => __( 'Label', 'amadeus-elementor' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic'       => [ 'active' => true ],
				]
			);

			$this->add_control(
				'icon',
				[
					'label'         => __( 'Icon', 'amadeus-elementor' ),
					'type'          => Controls_Manager::ICONS,
					'label_block'   => true,
					'default'       => [
						'value'   => '',
						'library' => 'fa-solid',
					],
				]
			);

			$this->add_control(
				'icon_align',
				[
					'label'         => __( 'Icon Position', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'left',
					'options'       => [
						'left' => __( 'Before', 'amadeus-elementor' ),
						'right' => __( 'After', 'amadeus-elementor' ),
					],
					'condition'     => [
						'icon!' => '',
					],
				]
			);

			$this->add_control(
				'icon_indent',
				[
					'label'         => __( 'Icon Spacing', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px' => [
							'max' => 50,
						],
					],
					'condition'     => [
						'icon!' => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .amadeus-acf .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label'         => __( 'Alignment', 'amadeus-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'options'       => [
						'left'    => [
							'title' => __( 'Left', 'amadeus-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'amadeus-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'amadeus-elementor' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label'         => __( 'Field', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'field_typography',
					'selector'      => '{{WRAPPER}} .amadeus-acf .amadeus-acf-field',
				]
			);

			$this->add_control(
				'field_color',
				[
					'label'         => __( 'Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf .amadeus-acf-field' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_label_style',
				[
					'label'         => __( 'Label', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'field_label!' => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'label_typography',
					'selector'      => '{{WRAPPER}} .amadeus-acf .amadeus-acf-label',
					'condition'     => [
						'field_label!' => '',
					],
				]
			);

			$this->add_control(
				'label_color',
				[
					'label'         => __( 'Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf .amadeus-acf-label' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'field_label!' => '',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_icon_style',
				[
					'label'         => __( 'Icon', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
					'condition'     => [
						'icon!' => '',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'         => __( 'Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf .amadeus-acf-icon' => 'color: {{VALUE}};',
					],
					'condition'     => [
						'icon!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label'         => __( 'Size', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [
						'px' => [
							'min'   => 5,
							'max'   => 200,
						],
					],
					'selectors'     => [
						'{{WRAPPER}} .amadeus-acf .amadeus-acf-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [
						'icon!' => '',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		// Return if not activated
		if ( ! is_acf_active() ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		$type = $settings['field_type'];

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-acf' );

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', [
				'amadeus-acf-icon',
				'elementor-align-icon-' . $settings['icon_align'],
			] );
		}

		$this->add_render_attribute( 'label', 'class', 'amadeus-acf-label' );
		$this->add_render_attribute( 'field', 'class', 'amadeus-acf-field' );

		$this->add_render_attribute( 'link', 'class', 'amadeus-acf-field' );
		$this->add_render_attribute( 'link', 'href', esc_url( get_field( $settings['field_name'] ) ) );
		$this->add_render_attribute( 'link', 'target', '_' . $settings['link_target'] );

		if ( true === $settings['link_nofollow'] ) {
			$this->add_render_attribute( 'link', 'rel', 'nofollow' );
		}
		?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<?php
			if ( ! empty( $settings['icon'] ) && 'left' === $settings['icon_align'] ) {
				?>
				<span <?php $this->print_render_attribute_string( 'icon' ); ?>>
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
				<?php
			}

			if ( ! empty( $settings['field_label'] ) ) { ?>
				<span <?php $this->print_render_attribute_string( 'label' ); ?>>
					<?php echo esc_attr( $settings['field_label'] ); ?>
				</span>
				<?php
			}

			if ( 'text' === $type ) {
				?>
				<span <?php $this->print_render_attribute_string( 'field' ); ?>>
					<?php echo do_shortcode( get_field( $settings['field_name'] ) ); ?>
				</span>
				<?php
			} elseif ( 'link' === $type ) {
				?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<?php
					if ( ! empty( $settings['link_text'] ) ) {
						echo esc_attr( $settings['link_text'] );
					} else {
						echo do_shortcode( get_field( $settings['field_name'] ) );
					}
					?>
				</a>
				<?php
			}
			?>

			<?php
			if ( ! empty( $settings['icon'] ) && 'right' === $settings['icon_align'] ) {
				?>
				<span <?php $this->print_render_attribute_string( 'icon' ); ?>>
					<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
				<?php
			}
			?>
		</div>
		<?php
	}
}
