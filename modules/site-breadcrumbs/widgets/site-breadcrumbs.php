<?php
namespace AmadeusElementor\Modules\SiteBreadcrumbs\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class SiteBreadcrumbs extends Widget_Base {
	public function get_name() {
		return 'amadeus-site-breadcrumbs';
	}

	public function get_title() {
		return __( 'Breadcrumbs', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-chevron-right';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'breadcrumbs',
			'heading',
			'title',
			'page title',
			'header',
			'page header',
			'site',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-site-breadcrumbs' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_breadcrumbs',
			[
				'label'         => __( 'Breadcrumbs', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => __( 'Source', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'default',
				'options'       => [
					'default'   => __( 'Amadeus Breadcrumbs', 'amadeus-elementor' ),
					'yoast'     => __( 'Yoast SEO Breadcrumbs', 'amadeus-elementor' ),
					'navxt'     => __( 'Breadcrumb NavXT', 'amadeus-elementor' ),
					'rank-math' => __( 'Rank Math Breadcrumbs', 'amadeus-elementor' ),
				],
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
				'default'       => 'right',
				'prefix_class'  => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_breadcrumbs',
			[
				'label'         => __( 'Breadcrumbs', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'typography',
				'selector'      => '{{WRAPPER}}.elementor-widget-amadeus-site-breadcrumbs',
			]
		);

		$this->add_control(
			'color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}}.elementor-widget-amadeus-site-breadcrumbs' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'         => __( 'Separator Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-breadcrumbs .amadeus-separator' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'source' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_links_style' );

		$this->start_controls_tab(
			'tab_links_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'links_text_color',
			[
				'label'         => __( 'Links Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}}.elementor-widget-amadeus-site-breadcrumbs a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_links_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'         => __( 'Links Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}}.elementor-widget-amadeus-site-breadcrumbs a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$source = $settings['source'];

		if ( function_exists( 'yoast_breadcrumb' ) && 'yoast' === $source ) {
			// Check if breadcrumb is turned on from WPSEO option.
			return yoast_breadcrumb( '<div id="amadeus-breadcrumbs-yoast" >', '</div>' );
		} elseif ( function_exists( 'bcn_display' ) && 'navxt' === $source ) {
			// Check if breadcrumb is turned on from Breadcrumb NavXT plugin.
			return '<div class="amadeus-breadcrumb-navxt" typeof="BreadcrumbList" vocab="https://schema.org/">' . bcn_display() . '</div>';
		} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) && 'rank-math' === $source ) {
			// Check if breadcrumb is turned on from Rank Math plugin.
			rank_math_the_breadcrumbs();
		} else {
			// Load default breadcrumb.
			echo amadeus_get_breadcrumb_trail(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}

	public function render_plain_content() {}
}
