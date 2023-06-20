<?php
namespace AmadeusElementor\Modules\ScrollUp\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Scroll_Up extends Widget_Base {

	public function get_name() {
		return 'amadeus-scroll-up';
	}

	public function get_title() {
		return __( 'Scroll Up', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-mouse-click-both';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'scroll',
			'up',
			'top',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-scroll-up' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-scroll-up' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_scroll_up',
			[
				'label'         => __( 'Scroll Up', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'fixed_position',
			[
				'label'         => __( 'Fixed Button', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'prefix_class'  => 'amadeus-fixed-',
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'         => __( 'Button Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default'       => 'right',
				'prefix_class'  => 'amadeus-button-position-',
				'condition'     => [
					'fixed_position' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'right_spacing',
			[
				'label'         => __( 'Right Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.amadeus-fixed-yes' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'fixed_position' => 'yes',
					'button_position' => 'right',
				],
			]
		);

		$this->add_responsive_control(
			'left_spacing',
			[
				'label'         => __( 'Left Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.amadeus-fixed-yes.amadeus-button-position-left' => 'left: {{SIZE}}{{UNIT}}; right: auto',
				],
				'condition'     => [
					'fixed_position' => 'yes',
					'button_position' => 'left',
				],
			]
		);

		$this->add_responsive_control(
			'bottom_spacing',
			[
				'label'         => __( 'Bottom Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}}.amadeus-fixed-yes' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'fixed_position' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left' => [
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
				'default'       => 'center',
				'prefix_class'  => 'elementor-align%s-',
				'condition'     => [
					'fixed_position!' => 'yes',
				],
			]
		);

		$this->add_control(
			'add_text',
			[
				'label'         => __( 'Add Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'text',
			[
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Scroll Up', 'amadeus-elementor' ),
				'label_block'   => true,
				'condition'     => [
					'add_text' => 'yes',
				],
				'dynamic'       => [ 'active' => true ],
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
					'justify' => [
						'title' => __( 'Justified', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'       => '',
				'prefix_class' => 'amadeus%s-align-',
				'condition'     => [
					'fixed_position' => 'no',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'default'       => [
					'value'     => 'fas fa-angle-up',
					'library' => 'solid',
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
					'add_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 4,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'icon!' => '',
					'add_text' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button .elementor-align-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-scroll-button .elementor-align-icon-left' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'         => __( 'Min Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'min-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'         => __( 'Min Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'scroll_button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-scroll-button a',
			]
		);

		$this->start_controls_tabs( 'tabs_scroll_button_style' );

		$this->start_controls_tab(
			'tab_scroll_button_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'scroll_button_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_scroll_button_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'scroll_button_hover_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'scroll_button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-scroll-button a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'scroll_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'scroll_button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-scroll-button a',
			]
		);

		$this->add_responsive_control(
			'scroll_button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'scroll_button_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-scroll-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render_icon( $icon ) { ?>
		<span <?php $this->print_render_attribute_string( 'button-icon' ); ?>>
			<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
		</span>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$text = $settings['add_text'];
		$icon = $settings['icon'];
		$align = $settings['icon_align'];

		$this->add_render_attribute( 'button-wrap', 'class', 'amadeus-scroll-button' );

		$this->add_render_attribute( 'button', 'href', '#' );

		$this->add_render_attribute( 'button', 'class',
			[
				'button',
				'elementor-button',
			]
		);

		$this->add_render_attribute( 'button-text', 'class',
			[
				'amadeus-button-text',
				'elementor-align-icon-' . $align,
			]
		);

		$this->add_render_attribute( 'button-icon', 'class', 'amadeus-button-icon' ); ?>

		<div <?php $this->print_render_attribute_string( 'button-wrap' ); ?>>
			<a <?php $this->print_render_attribute_string( 'button' ); ?>>
				<?php
				if ( 'yes' === $text ) {
					if ( ! empty( $icon ) && 'left' === $align ) {
						$this->render_icon( $icon );
					} ?>

					<span <?php $this->print_render_attribute_string( 'button-text' ); ?>><?php echo esc_attr( $settings['text'] ); ?></span>

					<?php
					if ( ! empty( $icon ) && 'right' === $align ) {
						$this->render_icon( $icon );
					}
				} else {
					if ( ! empty( $icon ) ) {
						$this->render_icon( $icon );
					}
				} ?>
			</a>
		</div>

		<?php
	}

	public function render_plain_content() {}

}
