<?php
namespace AmadeusElementor\Modules\Table\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Table extends Widget_Base {

	public function get_name() {
		return 'amadeus-table';
	}

	public function get_title() {
		return __( 'Table', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-grid';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'table',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-table' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			[
				'label'         => __( 'Header', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'hide_headers_mobile',
			[
				'label'         => __( 'Hide Headers on Mobile', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'hide',
				'prefix_class'  => 'amadeus-table-mobile-header-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'mobile_display',
			[
				'label'         => __( 'Mobile Display', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'column',
				'options'       => [
					'column'    => __( 'Column', 'amadeus-elementor' ),
					'inline'    => __( 'Inline', 'amadeus-elementor' ),
				],
				'prefix_class'  => 'amadeus-table-mobile-header-',
				'condition'     => [
					'hide_headers_mobile!' => 'hide',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'cell_text',
			[
				'label'         => __( 'Cell Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'cell_icon',
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

		$repeater->add_control(
			'cell_icon_align',
			[
				'label'         => __( 'Icon Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'amadeus-elementor' ),
					'right' => __( 'After', 'amadeus-elementor' ),
				],
				'condition'     => [
					'cell_icon!' => '',
				],
			]
		);

		$repeater->add_control(
			'cell_icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'cell_icon!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} thead {{CURRENT_ITEM}} .amadeus-table-text .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} thead {{CURRENT_ITEM}} .amadeus-table-text .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'cell_span',
			[
				'label'         => __( 'Column Span', 'amadeus-elementor' ),
				'title'         => __( 'How many columns should this column span across.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
			]
		);

		$repeater->add_control(
			'cell_row_span',
			[
				'label'         => __( 'Row Span', 'amadeus-elementor' ),
				'title'         => __( 'How many rows should this column span across.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'separator'     => 'below',
			]
		);

		$repeater->add_control(
			'_item_id',
			[
				'label'         => __( 'CSS ID', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'css_classes',
			[
				'label'         => __( 'CSS Classes', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'header_cells',
			[
				'label'         => __( 'Rows', 'amadeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'cell_text' => __( 'Header #1', 'amadeus-elementor' ),
					],
					[
						'cell_text' => __( 'Header #2', 'amadeus-elementor' ),
					],
					[
						'cell_text' => __( 'Header #3', 'amadeus-elementor' ),
					],
				],
				'prevent_empty' => true,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ cell_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'content_type',
			[
				'label'         => __( 'Element', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'cell',
				'options'       => [
					'row'   => __( 'Row', 'amadeus-elementor' ),
					'cell'  => __( 'Cell', 'amadeus-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'cell_type',
			[
				'label'         => __( 'Cell Type', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'td',
				'options'   => [
					'td'    => __( 'Default', 'amadeus-elementor' ),
					'th'    => __( 'Header', 'amadeus-elementor' ),
				],
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_text',
			[
				'label'         => __( 'Content Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'content_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'default'       => [
					'value'   => '',
					'library' => 'fa-solid',
				],
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_icon_align',
			[
				'label'         => __( 'Icon Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'amadeus-elementor' ),
					'right' => __( 'After', 'amadeus-elementor' ),
				],
				'condition'     => [
					'content_icon!' => '',
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'content_icon!' => '',
					'content_type' => 'cell',
				],
				'selectors'     => [
					'{{WRAPPER}} tbody {{CURRENT_ITEM}} .amadeus-table-text .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} tbody {{CURRENT_ITEM}} .amadeus-table-text .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'content_span',
			[
				'label'         => __( 'Column Span', 'amadeus-elementor' ),
				'title'         => __( 'How many columns should this column span across.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_row_span',
			[
				'label'         => __( 'Row Span', 'amadeus-elementor' ),
				'title'         => __( 'How many rows should this column span across.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'min'           => 1,
				'max'           => 20,
				'step'          => 1,
				'separator'     => 'below',
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_link',
			[
				'label'         => __( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'condition' => [
					'content_type' => 'cell',
				],
			]
		);

		$repeater->add_control(
			'content_item_id',
			[
				'label'         => __( 'CSS ID', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'content_css_classes',
			[
				'label'         => __( 'CSS Classes', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'rows',
			[
				'label'         => __( 'Rows', 'amadeus-elementor' ),
				'type'          => Controls_Manager::REPEATER,
				'default'       => [
					[
						'content_type'  => 'row',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #1', 'amadeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #2', 'amadeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #3', 'amadeus-elementor' ),
						'cell_type'     => 'td',
					],
					[
						'content_type'  => 'row',
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #1', 'amadeus-elementor' ),
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #2', 'amadeus-elementor' ),
					],
					[
						'content_type'  => 'cell',
						'content_text'  => __( 'Column #3', 'amadeus-elementor' ),
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field'   => 'Start {{ content_type }}: {{{ content_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => esc_html__( 'Table', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label'         => __( 'Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units'    => [ '%', 'px' ],
				'range'         => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
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
				'prefix_class' => 'amadeus%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rows_style',
			[
				'label'         => esc_html__( 'Rows', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'row_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-table-row',
			]
		);

		$this->add_control(
			'row_alternate',
			[
				'label'         => __( 'Alternate', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'even',
				'options'       => [
					'even'  => __( 'Even', 'amadeus-elementor' ),
					'odd'   => __( 'Odd', 'amadeus-elementor' ),
				],

			]
		);

		$this->start_controls_tabs( 'tabs_row_style' );

		$this->start_controls_tab(
			'tab_row_default_style',
			[
				'label'         => __( 'Default', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'row_style_heading',
			[
				'label'         => __( 'Default', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_bg',
			[
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-row' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-row .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_style_hover_heading',
			[
				'label'     => __( 'Hover', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_hover_bg',
			[
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-row:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_hover_color',
			[
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-row:hover .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_row_alternate_style',
			[
				'label'         => __( 'Alternate', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'row_style_alternate_heading',
			[
				'label'     => __( 'Default', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_alternate_bg',
			[
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-odd .amadeus-table-row:nth-child(odd),
					 {{WRAPPER}} .amadeus-table-even .amadeus-table-row:nth-child(even)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_alternate_color',
			[
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-odd .amadeus-table-row:nth-child(odd) .amadeus-table-text,
					 {{WRAPPER}} .amadeus-table-even .amadeus-table-row:nth-child(even) .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_style_alternate_hover_heading',
			[
				'label'     => __( 'Hover', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'row_alternate_hover_bg',
			[
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-odd .amadeus-table-row:nth-child(odd):hover,
					 {{WRAPPER}} .amadeus-table-even .amadeus-table-row:nth-child(even):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_alternate_hover_color',
			[
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .amadeus-table-odd .amadeus-table-row:nth-child(odd):hover .amadeus-table-text,
					 {{WRAPPER}} .amadeus-table-even .amadeus-table-row:nth-child(even):hover .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cells_style',
			[
				'label'     => __( 'Cells', 'amadeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'cell_typography',
				'label'     => __( 'Typography', 'amadeus-elementor' ),
				'selector'  => '{{WRAPPER}} .amadeus-table td.amadeus-table-cell',
			]
		);

		$this->start_controls_tabs( 'tabs_cell_colors' );

		$this->start_controls_tab(
			'tab_cell_colors',
			[
				'label'         => __( 'Default', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'cell_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-cell' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-cell .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cell_hover_colors',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'cell_hover_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-cell:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-cell:hover .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'cell_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'cell_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-table-cell',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_headers_style',
			[
				'label'     => __( 'Headers', 'amadeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'headers_typography',
				'label'     => __( 'Typography', 'amadeus-elementor' ),
				'selector'  => '{{WRAPPER}} .amadeus-table th.amadeus-table-cell',
			]
		);

		$this->start_controls_tabs( 'tabs_headers_colors' );

		$this->start_controls_tab(
			'tab_headers_colors',
			[
				'label'         => __( 'Default', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'headers_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.amadeus-table-cell' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-table-cell[data-title]:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'headers_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.amadeus-table-cell .amadeus-table-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-table-cell[data-title]:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_headers_hover_colors',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'headers_hover_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.amadeus-table-cell:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'headers_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} th.amadeus-table-cell:hover .amadeus-table-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'headers_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} th.amadeus-table-cell .amadeus-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-table-cell[data-title]:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'headers_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} th.amadeus-table-cell, {{WRAPPER}} .amadeus-table-cell[data-title]:before',
			]
		);

		$this->end_controls_section();

	}

	protected function is_invalid_first_row() {
		$settings = $this->get_settings();
		if ( 'row' === $settings['rows'][0]['content_type'] ) {
			return false;
		}
		return true;
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();

		$counter        = 1;
		$cell_counter   = 0;
		$head_output    = '';
		$output         = '';
		$row_count      = count( $settings['rows'] );

		$this->add_render_attribute( 'table', 'class', [
			'amadeus-table',
			'amadeus-table-' . $settings['row_alternate'],
		] );

		$this->add_render_attribute( 'row', 'class', 'amadeus-table-row' ); ?>

		<table <?php $this->print_render_attribute_string( 'table' ); ?>>
			<?php
			if ( $settings['header_cells'] ) { ?>
				<thead>
					<tr <?php $this->print_render_attribute_string( 'row' ); ?>>
						<?php
						foreach ( $settings['header_cells'] as $index => $row ) {
							$key = $this->get_repeater_setting_key( 'cell_text', 'header_cells', $index );

							$this->add_render_attribute( 'header-' . $counter, 'class', 'amadeus-table-cell' );
							$this->add_render_attribute( 'header-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );
							$this->add_render_attribute( 'header-text-' . $counter, 'class', 'amadeus-table-text' );
							$this->add_render_attribute( $key, 'class', 'amadeus-table-text-inner' );
							$this->add_inline_editing_attributes( $key, 'basic' );

							if ( $row['_item_id'] ) {
								$this->add_render_attribute( 'header-' . $counter, 'id', $row['_item_id'] );
							}

							if ( $row['css_classes'] ) {
								$this->add_render_attribute( 'header-' . $counter, 'class', $row['css_classes'] );
							}

							if ( $row['cell_span'] > 1 ) {
								$this->add_render_attribute( 'header-' . $counter, 'colspan', $row['cell_span'] );
							}

							if ( $row['cell_row_span'] > 1 ) {
								$this->add_render_attribute( 'header-' . $counter, 'rowspan', $row['cell_row_span'] );
							} ?>

							<th <?php $this->print_render_attribute_string( 'header-' . $counter ); ?>>
								<span <?php $this->print_render_attribute_string( 'header-text-' . $counter ); ?>>
									<?php
									if ( ! empty( $row['cell_icon'] ) ) {
										$this->add_render_attribute( 'icon-' . $counter, 'class', 'elementor-align-icon-' . $row['cell_icon_align'] ); ?>
										<span <?php $this->print_render_attribute_string( 'icon-' . $counter ); ?>>
											<?php \Elementor\Icons_Manager::render_icon( $row['cell_icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</span>
										<?php
									}
									?>
									<span <?php $this->print_render_attribute_string( $key ); ?>><?php echo esc_attr( $row['cell_text'] ); ?></span>
								</span>
							</th>
							<?php
						}
						?>
					</tr>
				</thead>
				<?php
			}

			if ( $settings['rows'] ) {
				?>
				<tbody>
					<?php if ( $this->is_invalid_first_row() ) { ?>
						<tr <?php $this->print_render_attribute_string( 'row' ); ?>>
					<?php } ?>

						<?php
						foreach ( $settings['rows'] as $index => $row ) {
							$text_tag       = 'span';
							$header_text    = '';
							$content_key    = $this->get_repeater_setting_key( 'content_text', 'rows', $index );

							if ( ! empty( $row['content_link']['url'] ) ) {
								$text_tag = 'a';
								$this->add_link_attributes( 'text-' . $counter, $row['content_link'] );
							}

							if ( 'cell' === $row['content_type'] ) {
								if ( 'hide' !== $settings['hide_headers_mobile'] ) {
									// Fetch corresponding header cell text
									if ( isset( $settings['header_cells'][ $cell_counter ] ) ) {
										$header_text = $settings['header_cells'][ $cell_counter ]['cell_text'];
									}
									// Increment to next cell
									$cell_counter++;
								}

								$this->add_render_attribute( 'cell-' . $counter, 'class', 'amadeus-table-cell' );
								$this->add_render_attribute( 'cell-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );

								$this->add_render_attribute( 'text-' . $counter, 'class', 'amadeus-table-text' );
								$this->add_render_attribute( $content_key, 'class', 'amadeus-table-text-inner' );
								$this->add_inline_editing_attributes( $content_key, 'basic' );

								if ( $row['content_item_id'] ) {
									$this->add_render_attribute( 'cell-' . $counter, 'id', $row['content_item_id'] );
								}

								if ( $row['content_css_classes'] ) {
									$this->add_render_attribute( 'cell-' . $counter, 'class', $row['content_css_classes'] );
								}

								if ( $header_text ) {
									$this->add_render_attribute( 'cell-' . $counter, 'data-title', $header_text );
								}

								if ( $row['content_span'] > 1 ) {
									$this->add_render_attribute( 'cell-' . $counter, 'colspan', $row['content_span'] );
								}

								if ( $row['content_row_span'] > 1 ) {
									$this->add_render_attribute( 'cell-' . $counter, 'rowspan', $row['content_row_span'] );
								} ?>

								<<?php echo esc_attr( $row['cell_type'] ); ?> <?php $this->print_render_attribute_string( 'cell-' . $counter ); ?>>
									<<?php echo esc_attr( $text_tag ); ?> <?php $this->print_render_attribute_string( 'text-' . $counter ); ?>>
									<?php
									if ( ! empty( $row['content_icon'] ) ) {
										$this->add_render_attribute( 'icon-' . $counter, 'class', 'elementor-align-icon-' . $row['content_icon_align'] );
										?>
										<span <?php $this->print_render_attribute_string( 'icon-' . $counter ); ?>>
											<?php \Elementor\Icons_Manager::render_icon( $row['content_icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</span>
										<?php
									}
									?>
									<span <?php $this->print_render_attribute_string( $content_key ); ?>><?php $this->print_text_editor( $row['content_text'] ); ?></span>
									</<?php echo esc_attr( $text_tag ); ?>>
								</<?php echo esc_attr( $row['cell_type'] ); ?>>
								<?php
							} else {
								$this->add_render_attribute( 'row-' . $counter, 'class', 'amadeus-table-row' );
								$this->add_render_attribute( 'row-' . $counter, 'class', 'elementor-repeater-item-' . $row['_id'] );

								if ( $row['content_item_id'] ) {
									$this->add_render_attribute( 'row-' . $counter, 'id', $row['content_item_id'] );
								}

								if ( $row['content_css_classes'] ) {
									$this->add_render_attribute( 'row-' . $counter, 'class', $row['content_css_classes'] );
								}

								if ( $counter > 1 && $counter < $row_count ) {
									?>
									</tr><tr <?php $this->print_render_attribute_string( 'row-' . $counter ); ?>>
									<?php
								} elseif ( 1 === $counter && false === $this->is_invalid_first_row() ) {
									?>
									<tr <?php $this->print_render_attribute_string( 'row-' . $counter ); ?>>
									<?php
								}

								$cell_counter = 0;
							}
							$counter++;
						}
						?>
					</tr>
				</tbody>
				<?php
			}
			?>
		</table>
		<?php
	}

	protected function content_template() { ?>
		<#
		var counter                 = 1,
			cell_counter            = 0,
			row_count               = settings.rows.length,
			is_invalid_first_row    = false;

		if ( 'row' !== settings.rows[0].type ) {
			is_invalid_first_row = true;
		} #>

		<table class="amadeus-table amadeus-table-{{ settings.row_alternate }}">

			<# if ( settings.header_cells ) { #>

				<thead>

					<tr class="amadeus-table-row">

						<# _.each( settings.header_cells, function( row ) { #>

							<th id="{{ row._item_id }}" class="amadeus-table-cell elementor-repeater-item-{{ row._id }} {{ row.css_classes }}" colspan="{{ row.cell_span }}" rowspan="{{ row.cell_row_span }}">
								<span class="amadeus-table-text">

									<# if ( row.cell_icon ) {
										cellIconsHTML = elementor.helpers.renderIcon( view, row.cell_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
										if ( cellIconsHTML && cellIconsHTML.rendered ) { #>
											<span class="elementor-align-icon-{{ row.cell_icon_align }}">
												{{{ cellIconsHTML.value }}}
											</span>
										<# }
									} #>

									<span class="amadeus-table-text-inner elementor-inline-editing" data-elementor-setting-key="header_cells.{{ counter - 1 }}.cell_text" data-elementor-inline-editing-toolbar="basic">{{{ row.cell_text }}}</span>

								</span>
							</th>

						<# counter++;

						} ); counter = 1; #>

					</tr>

				</thead>

			<# } #>

			<# if ( settings.rows ) { #>

				<tbody>

					<# if ( is_invalid_first_row ) { #>
						<tr class="amadeus-table-row">
					<# }

						_.each( settings.rows, function( row ) {

							var text_tag            = 'span',
								text_link           = '',
								header_text         = '',
								data_header_text    = '';

							if ( '' !== row.content_link.url ) {
								text_tag = 'a';
								text_link = 'href="' + row.content_link.url + '"';
							}

							if ( row.content_type === 'cell' ) {

								if ( 'hide' !== settings.hide_headers_mobile ) {

									if ( undefined !== settings.header_cells[ cell_counter ] ) {
										header_text = settings.header_cells[ cell_counter ].cell_text;
									}

									cell_counter++;
								}

								if ( header_text ) {
									data_header_text = 'data-title="' + header_text + '"';
								} #>

								<{{ row.cell_type }} id="{{ row.content_item_id }}" class="amadeus-table-cell elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" colspan="{{ row.content_span }}" rowspan="{{ row.content_row_span }}" {{{ data_header_text }}}>

									<{{ text_tag }} {{ text_link }} class="amadeus-table-text">
										<# if ( row.content_icon ) {
											contentIconsHTML = elementor.helpers.renderIcon( view, row.content_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
											if ( contentIconsHTML && contentIconsHTML.rendered ) { #>
												<span class="elementor-align-icon-{{ row.content_icon_align }}">
													{{{ contentIconsHTML.value }}}
												</span>
											<# }
										} #>
										<span class="amadeus-table-text-inner elementor-inline-editing" data-elementor-setting-key="rows.{{ counter - 1 }}.content_text" data-elementor-inline-editing-toolbar="basic">{{{ row.content_text }}}</span>
									</{{ text_tag }}>

								</{{ row.cell_type }}>

							<# } else {

								if ( counter > 1 && counter < row_count ) { #>
									</tr><tr class="amadeus-table-row elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" id="{{ row.content_item_id }}">
								<# } else if ( 1 === counter && ! is_invalid_first_row ) { #>
									<tr class="amadeus-table-row elementor-repeater-item-{{ row._id }} {{ row.content_css_classes }}" id="{{ row.content_item_id }}">
								<# }

								cell_counter = 0;
							}

						counter++;

						} ); #>

					</tr>

				</tbody>

			<# } #>

		</table>

		<?php
	}
}
