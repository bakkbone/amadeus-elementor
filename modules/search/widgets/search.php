<?php
namespace AmadeusElementor\Modules\Search\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Search extends Widget_Base {

	public function get_name() {
		return 'amadeus-search';
	}

	public function get_title() {
		return __( 'Ajax Search', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-magnifier-check';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'ajax',
			'search',
			'search icon',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-search' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-search' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_search',
			[
				'label'         => __( 'Search', 'amadeus-elementor' ),
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
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
				'selectors' => [
					'{{WRAPPER}} .amadeus-search-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 44,
				],
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
				'selectors' => [
					'{{WRAPPER}} .amadeus-search-wrap input, {{WRAPPER}} .amadeus-search-wrap .search-submit' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'         => __( 'Placeholder', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Search', 'amadeus-elementor' ),
				'placeholder'   => __( 'Search', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'post_type',
			array(
				'label'         => __( 'Search Source', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '0',
				'options'       => amadeus_get_available_post_types(),
			)
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
				'prefix_class' => 'amadeus%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input',
			[
				'label'         => __( 'Input', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_input_style' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_hover',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color_hover',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_color_focus',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'input_focus_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-searchform input.field:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'input_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-searchform input.field',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform input.field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'newsletter_input',
				'selector'      => '{{WRAPPER}} .amadeus-searchform input.field',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'         => __( 'Icon Button', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SECTION,
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Font Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-searchform button svg' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'btn_color_hover',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-searchform button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_results',
			[
				'label'         => __( 'Search Results', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SECTION,
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'results_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'after',
			]
		);

		$this->start_controls_tabs( 'tabs_results_links_style' );

		$this->start_controls_tab(
			'tab_results_links_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'results_links_bg',
			[
				'label'         => __( 'Links Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.search-result-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_color',
			[
				'label'         => __( 'Links Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.search-result-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_border_color',
			[
				'label'         => __( 'Links Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_icons_color',
			[
				'label'         => __( 'Icons Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a i.icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_all_links_color',
			[
				'label'         => __( 'All Results Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.all-results' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'results_links_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'results_links_hover_bg',
			[
				'label'         => __( 'Links Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.search-result-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_hover_color',
			[
				'label'         => __( 'Links Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.search-result-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_links_hover_border_color',
			[
				'label'         => __( 'Links Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_icons_hover_color',
			[
				'label'         => __( 'Icons Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a:hover i.icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'results_all_links_hover_color',
			[
				'label'         => __( 'All Results Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a.all-results:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'results_links_padding',
			[
				'label' => __( 'Links Padding', 'amadeus-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'results_search_typo',
				'selector'      => '{{WRAPPER}} .amadeus-search-wrap .amadeus-search-results ul li a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_no_search_results',
			[
				'label'         => __( 'No Results Found', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SECTION,
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'no_results_heading_color',
			[
				'label'         => __( 'Heading Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-no-search-results h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'no_results_heading_typo',
				'selector'      => '{{WRAPPER}} .amadeus-search-wrap .amadeus-no-search-results h6',
			]
		);

		$this->add_control(
			'no_results_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-wrap .amadeus-no-search-results p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'no_results_text_typo',
				'selector'      => '{{WRAPPER}} .amadeus-search-wrap .amadeus-no-search-results p',
			]
		);

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$type = $settings['post_type'];
		$type = $type ? $type : 'any';
		$placeholder = $settings['placeholder'];

		$this->add_render_attribute( 'wrapper', 'class', 'amadeus-search-wrap' );

		$this->add_render_attribute( 'form', [
			'class' => [
				'amadeus-searchform',
			],
			'method' => [
				'get',
			],
			'id' => [
				'amadeus-searchform',
			],
			'action' => [
				esc_url( home_url( '/' ) ),
			],
		] );

		$this->add_render_attribute( 'input', [
			'type' => [
				'text',
			],
			'class' => [
				'field',
			],
			'name' => [
				's',
			],
			'data-type' => [
				esc_attr( $type ),
			],
		] );

		// Placeholder
		if ( ! empty( $placeholder ) ) {
			$this->add_render_attribute( 'input', 'placeholder', esc_attr( $placeholder ) );
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<form <?php $this->print_render_attribute_string( 'form' ); ?>>
				<input <?php $this->print_render_attribute_string( 'input' ); ?>>
				<button type="submit" class="search-submit" value="">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512"><path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5 S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9 C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"/></svg>
				</button>
			</form>
			<div class="amadeus-ajax-loading"></div>
			<div class="amadeus-search-results"></div>
		</div>

		<?php
	}

	// No template because it cause a js error in the edit mode
	protected function content_template() {}

}
