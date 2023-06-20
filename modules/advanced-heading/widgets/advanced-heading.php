<?php
namespace AmadeusElementor\Modules\AdvancedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AdvancedHeading extends Widget_Base {

	public function get_name() {
		return 'amadeus-advanced-heading';
	}

	public function get_title() {
		return __( 'Advanced Heading', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-text-color';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'heading',
			'advanced',
			'advanced heading',
			'title',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-advanced-heading' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_advanced_heading',
			[
				'label'         => __( 'Heading', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'         => __( 'Heading', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Advanced Heading', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label'         => __( 'Sub Heading', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Your Sub Heading Here', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => 'http://your-link.com',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => amadeus_get_available_tags(),
			]
		);

		$this->add_responsive_control(
			'align',
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_background_heading',
			[
				'label'         => __( 'Background Heading', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'background_heading',
			[
				'label'         => __( 'Background Heading', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Background Heading', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'background_heading_hide',
			[
				'label'         => __( 'Hide On', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'tm',
				'options'       => [
					'never' => __( 'Never', 'amadeus-elementor' ),
					'tm'    => __( 'Tablet and Mobile ', 'amadeus-elementor' ),
					'm'     => __( 'Mobile', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'background_heading_align',
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
				'prefix_class' => 'amadeus%s-background-heading-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_heading',
			[
				'label'         => __( 'Heading', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'main_heading!' => '',
				],
			]
		);

		$this->add_control(
			'main_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'main_heading_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-heading' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'main_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'main_heading_advanced_color',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-heading > div',
				'condition'     => [
					'main_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'main_heading_typography',
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'main_heading_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-heading',
			]
		);

		$this->add_control(
			'main_heading_margin',
			[
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_heading_line',
			[
				'label'         => __( 'Add Line', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'main_heading_line_color',
			[
				'label'         => __( 'Line Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'main_heading_line_align',
			[
				'label'         => __( 'Line Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'bottom',
				'options'       => [
					'left'       => __( 'Before', 'amadeus-elementor' ),
					'right'      => __( 'After', 'amadeus-elementor' ),
					'left-right' => __( 'Before and After', 'amadeus-elementor' ),
					'bottom'     => __( 'Bottom', 'amadeus-elementor' ),
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_line_indent',
			[
				'label'         => __( 'Line Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 8,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'main_heading_line' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line.amadeus-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line.amadeus-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-main-line.amadeus-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_heading',
			[
				'label'         => __( 'Sub Heading', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'sub_heading!' => '',
				],
			]
		);

		$this->add_control(
			'sub_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-heading' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'sub_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'sub_heading_advanced_color',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-heading > div',
				'condition'     => [
					'sub_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'sub_heading_typography',
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'sub_heading_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-heading',
			]
		);

		$this->add_control(
			'sub_heading_margin',
			[
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_heading_line',
			[
				'label'         => __( 'Add Line', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'sub_heading_line_color',
			[
				'label'         => __( 'Line Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min'  => 1,
						'max'  => 48,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'sub_heading_line_align',
			[
				'label'         => __( 'Line Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'bottom',
				'options'       => [
					'left'       => __( 'Before', 'amadeus-elementor' ),
					'right'      => __( 'After', 'amadeus-elementor' ),
					'left-right' => __( 'Before and After', 'amadeus-elementor' ),
					'bottom'     => __( 'Bottom', 'amadeus-elementor' ),
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_line_indent',
			[
				'label'         => __( 'Line Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 8,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'sub_heading_line' => 'yes',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line.amadeus-line-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line.amadeus-line-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-sub-line.amadeus-line-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_background_heading',
			[
				'label'         => __( 'Background Heading', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'background_heading!' => '',
				],
			]
		);

		$this->add_control(
			'background_heading_advanced_color',
			[
				'label'         => __( 'Advanced Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_heading_advanced_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div',
				'condition' => [
					'background_heading_advanced_color' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_color',
			[
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div' => 'color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_background_color',
			[
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'background_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_control(
			'background_heading_padding',
			[
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'background_heading_typography',
				'selector'  => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'background_heading_shadow',
				'selector' => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'background_heading_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'background_heading_border_radius',
			[
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'background_heading_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div',
			]
		);

		$this->add_control(
			'background_heading_opacity',
			[
				'label' => __( 'Opacity', 'amadeus-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.05,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-advanced-heading .amadeus-background-heading > div' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$title_tag  = $settings['title_html_tag'];
		$hide       = $settings['background_heading_hide'];
		$main_line  = $settings['main_heading_line_align'];
		$sub_line   = $settings['sub_heading_line_align'];

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-advanced-heading' );

		$this->add_render_attribute( 'background-heading', 'class', 'amadeus-background-heading' );

		if ( 'never' !== $hide ) {
			$this->add_render_attribute( 'background-heading', 'class', 'amadeus-hide-' . $hide );
		}

		if ( 'yes' === $settings['background_heading_advanced_color'] ) {
			$this->add_render_attribute( 'background-heading', 'class', 'amadeus-has-bg' );
		}

		$this->add_render_attribute( 'main-heading', 'class', 'amadeus-main-heading' );

		if ( 'yes' === $settings['main_heading_advanced_color'] ) {
			$this->add_render_attribute( 'main-heading', 'class', 'amadeus-has-bg' );
		}

		$this->add_render_attribute( 'sub-heading', 'class', 'amadeus-sub-heading' );

		if ( 'yes' === $settings['sub_heading_advanced_color'] ) {
			$this->add_render_attribute( 'sub-heading', 'class', 'amadeus-has-bg' );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'heading', $settings['link'] );
			$title_tag = 'a';
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>

			<?php
			if ( ! empty( $settings['background_heading'] ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'background-heading' ); ?>>
					<div><?php $this->print_unescaped_setting( 'background_heading' ); ?></div>
				</div>
				<?php
			}

			if ( ! empty( $settings['main_heading'] ) ) { ?>
				<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( 'heading' ); ?> <?php $this->print_render_attribute_string( 'main-heading' ); ?>>
					<div>
						<?php $this->print_unescaped_setting( 'main_heading' ); ?>

						<?php
						if ( 'yes' === $settings['main_heading_line'] ) {
							if ( 'left-right' === $main_line ) {
								?>
								<div class="amadeus-line amadeus-main-line amadeus-line-align-left"></div><div class="amadeus-line amadeus-main-line amadeus-line-align-right"></div>
								<?php
							} else {
								?>
								<div class="amadeus-line amadeus-main-line amadeus-line-align-<?php echo esc_attr( $main_line ); ?>"></div>
								<?php
							}
						}
						?>
					</div>
				</<?php echo esc_attr( $title_tag ); ?>>
				<?php
			}

			if ( ! empty( $settings['sub_heading'] ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'sub-heading' ); ?>>
					<div>
						<?php $this->print_unescaped_setting( 'sub_heading' ); ?>

						<?php
						if ( 'yes' === $settings['sub_heading_line'] ) {
							if ( 'left-right' === $sub_line ) {
								?>
								<div class="amadeus-line amadeus-sub-line amadeus-line-align-left"></div><div class="amadeus-line amadeus-sub-line amadeus-line-align-right"></div>
								<?php
							} else {
								?>
								<div class="amadeus-line amadeus-sub-line amadeus-line-align-<?php echo esc_attr( $sub_line ); ?>"></div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<?php
			}
			?>

		</div>

		<?php
	}

	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'background-heading', 'class', 'amadeus-background-heading' );

		if ( 'never' != settings.background_heading_hide ) {
			view.addRenderAttribute( 'background-heading', 'class', 'amadeus-hide-' + settings.background_heading_hide );
		}

		if ( 'yes' == settings.background_heading_advanced_color ) {
			view.addRenderAttribute( 'background-heading', 'class', 'amadeus-has-bg' );
		}

		var tag = settings.title_html_tag;
		view.addRenderAttribute( 'main-heading', 'class', 'amadeus-main-heading' );

		if ( 'yes' == settings.main_heading_advanced_color ) {
			view.addRenderAttribute( 'main-heading', 'class', 'amadeus-has-bg' );
		}

		if ( '' !== settings.link.url ) {
			tag = 'a';
			view.addRenderAttribute( 'main-heading', 'href', settings.link.url );
		}

		view.addRenderAttribute( 'sub-heading', 'class', 'amadeus-sub-heading' );

		if ( 'yes' == settings.sub_heading_advanced_color ) {
			view.addRenderAttribute( 'sub-heading', 'class', 'amadeus-has-bg' );
		} #>

		<div class="amadeus-advanced-heading">

			<# if ( settings.background_heading ) { #>
				<div {{{ view.getRenderAttributeString( 'background-heading' ) }}}>
					<div>{{{ settings.background_heading }}}</div>
				</div>
			<# }

			if ( settings.main_heading ) { #>
				<{{ tag }} {{{ view.getRenderAttributeString( 'main-heading' ) }}}>
					<div>
						{{{ settings.main_heading }}}

						<# if ( 'yes' == settings.main_heading_line ) {
							if ( 'left-right' == settings.main_heading_line_align ) { #>
								<div class="amadeus-line amadeus-main-line amadeus-line-align-left"></div><div class="amadeus-line amadeus-main-line amadeus-line-align-right"></div>
							<# } else { #>
								<div class="amadeus-line amadeus-main-line amadeus-line-align-{{ settings.main_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</{{ tag }}>
			<# }

			if ( settings.sub_heading ) { #>
				<div {{{ view.getRenderAttributeString( 'sub-heading' ) }}}>
					<div>
						{{{ settings.sub_heading }}}

						<# if ( 'yes' == settings.sub_heading_line ) {
							if ( 'left-right' == settings.sub_heading_line_align ) { #>
								<div class="amadeus-line amadeus-sub-line amadeus-line-align-left"></div><div class="amadeus-line amadeus-sub-line amadeus-line-align-right"></div>
							<# } else { #>
								<div class="amadeus-line amadeus-sub-line amadeus-line-align-{{ settings.sub_heading_line_align }}"></div>
							<# }
						} #>
					</div>
				</div>

			<# } #>

		</div>
		<?php
	}
}
