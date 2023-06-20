<?php
namespace AmadeusElementor\Modules\PricingTable\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pricing_Table extends Widget_Base {

	public function get_name() {
		return 'amadeus-pricing-table';
	}

	public function get_title() {
		return __( 'Pricing Table', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-money-pouch';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'price',
			'table',
			'price table',
			'pricing table',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-pricing-table' );
	}

	public function get_style_depends() {
		return array( 'amadeus-pricing-table', 'tippy', 'tippy-arrow' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing',
			array(
				'label' => __( 'Table', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Table Style', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => __( 'Default', 'amadeus-elementor' ),
					'style-2' => __( 'Pricing Style 2', 'amadeus-elementor' ),
					'style-3' => __( 'Pricing Style 3', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'selected_table_icon',
			array(
				'label'            => __( 'Icon', 'amadeus-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'default'          => array(
					'value'   => 'far fa-gem',
					'library' => 'fa-regular',
				),
				'condition'        => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'selected_table_img',
			array(
				'label'     => __( 'Choose Image', 'amadeus-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'selected_table_img',
				'label'     => __( 'Image Resolution', 'amadeus-elementor' ),
				'default'   => 'large',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Standard', 'amadeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'sub_title',
			array(
				'label'   => __( 'Description', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Enter your description', 'amadeus-elementor' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default' => 'h3',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_price',
			array(
				'label' => __( 'Price', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( '79', 'amadeus-elementor' ),
			)
		);
		$this->add_control(
			'onsale',
			array(
				'label'        => __( 'On Sale?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'onsale_price',
			array(
				'label'     => __( 'Sale Price', 'amadeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( '59', 'amadeus-elementor' ),
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'currency_symbol',
			array(
				'label'   => __( 'Currency Symbol', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''             => __( 'None', 'amadeus-elementor' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'amadeus-elementor' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'amadeus-elementor' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'amadeus-elementor' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'amadeus-elementor' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'amadeus-elementor' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'amadeus-elementor' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'amadeus-elementor' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'amadeus-elementor' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'amadeus-elementor' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'amadeus-elementor' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'amadeus-elementor' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'amadeus-elementor' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'amadeus-elementor' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'amadeus-elementor' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'amadeus-elementor' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'amadeus-elementor' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'amadeus-elementor' ),
					'custom'       => __( 'Custom', 'amadeus-elementor' ),
				),
				'default' => 'dollar',
			)
		);

		$this->add_control(
			'currency_symbol_custom',
			array(
				'label'     => __( 'Custom Symbol', 'amadeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'currency_symbol' => 'custom',
				),
			)
		);

		$this->add_control(
			'currency_position',
			array(
				'label'   => __( 'Currency Position', 'amadeus-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'before',
				'options' => array(
					'before' => array(
						'title' => __( 'Before', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'after'  => array(
						'title' => __( 'After', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_control(
			'period',
			array(
				'label'   => __( 'Period', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => __( 'month', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'   => __( 'Period Separator', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => __( '/', 'amadeus-elementor' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_features',
			array(
				'label' => __( 'Features', 'amadeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			array(
				'label'       => __( 'Text', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'default'     => __( 'List Item', 'amadeus-elementor' ),
			)
		);

		$repeater->add_control(
			'disable_item',
			array(
				'label'        => __( 'Disable Item?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$default_icon = array(
			'value'   => 'far fa-check-circle',
			'library' => 'fa-regular',
		);

		$repeater->add_control(
			'selected_item_icon',
			array(
				'label'            => __( 'Icon', 'amadeus-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'default'          => $default_icon,
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'   => __( 'Icon Color', 'amadeus-elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#3fc893',
				'selectors' => [
					'{{WRAPPER}} .amadeus-pricing-table {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .amadeus-pricing-table {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
				],
			)
		);

		$repeater->add_control(
			'item_tooltip',
			array(
				'label' => __( 'Tooltip', 'amadeus-elementor' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$repeater->add_control(
			'item_tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 's',
				'options'   => array(
					'n'      => __( 'Top', 'amadeus-elementor' ),
					'ne-alt' => __( 'Top Start', 'amadeus-elementor' ),
					'ne'     => __( 'Top End', 'amadeus-elementor' ),
					'e'      => __( 'Right', 'amadeus-elementor' ),
					'se-alt' => __( 'Right Start', 'amadeus-elementor' ),
					'se'     => __( 'Right End', 'amadeus-elementor' ),
					's'      => __( 'Bottom', 'amadeus-elementor' ),
					'sw-alt' => __( 'Bottom Start', 'amadeus-elementor' ),
					'sw'     => __( 'Bottom End', 'amadeus-elementor' ),
					'w'      => __( 'Left', 'amadeus-elementor' ),
					'nw-alt' => __( 'Left Start', 'amadeus-elementor' ),
					'nw'     => __( 'Left End', 'amadeus-elementor' ),
				),
				'condition' => array(
					'item_tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'item_tooltip_content',
			array(
				'label'       => __( 'Tooltip Content', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'default'     => __( 'Add your tooltip content here', 'amadeus-elementor' ),
				'condition'   => array(
					'item_tooltip' => 'yes',
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item_text'          => __( 'List Item #1', 'amadeus-elementor' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #2', 'amadeus-elementor' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #3', 'amadeus-elementor' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #4', 'amadeus-elementor' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #5', 'amadeus-elementor' ),
						'selected_item_icon' => $default_icon,
					),
				),
				'title_field' => '{{{ item_text }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Buy Now', 'amadeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'amadeus-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'amadeus-elementor' ),
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'footer_additional_info',
			array(
				'label'     => __( 'Additional Info', 'amadeus-elementor' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => __( 'This is a text element', 'amadeus-elementor' ),
				'rows'      => 3,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',
			array(
				'label' => __( 'Ribbon', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'ribbon',
			array(
				'label'        => __( 'Featured?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'ribbon_style',
			array(
				'label'     => __( 'Ribbon Style', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ribbon-1',
				'options'   => array(
					'ribbon-1' => __( 'Style 1', 'amadeus-elementor' ),
					'ribbon-2' => __( 'Style 2', 'amadeus-elementor' ),
					'ribbon-3' => __( 'Style 3', 'amadeus-elementor' ),
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_title',
			array(
				'label'     => __( 'Ribbon Text', 'amadeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => __( 'Popular', 'amadeus-elementor' ),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_alignment',
			array(
				'label'          => __( 'Ribbon Alignment', 'amadeus-elementor' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'right',
				'options'        => array(
					'left'  => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'style_transfer' => true,
				'condition'      => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_table',
			array(
				'label' => __( 'Pricing Table', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_background',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'table_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'table_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_margin',
			array(
				'label'      => __( 'margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-footer' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'table_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-pricing-table',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'table_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-pricing-table',
			]
		);

		$this->add_control(
			'table_alignment',
			array(
				'label'     => __( 'Alignment', 'amadeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon Box', 'amadeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 30,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_box_width',
			array(
				'label'      => __( 'Icon Box Width', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 80,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'max' => 300,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_box_height',
			array(
				'label'     => __( 'Icon Box Height', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 80,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_shadow',
				'label'     => __( 'Box Shadow', 'amadeus-elementor' ),
				'selector'  => '{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->start_controls_tabs( 'icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			array(
				'label'     => __( 'Normal', 'amadeus-elementor' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			array(
				'label'     => __( 'Hover', 'amadeus-elementor' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_hover_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'header_background',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header .amadeus-pricing-table-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_margin',
			array(
				'label'      => __( 'margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'header_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-header .amadeus-pricing-table-heading',
			)
		);

		$this->add_control(
			'sub_heading_title',
			array(
				'label' => __( 'Sub Heading', 'amadeus-elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'sub_heading_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-subheading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_heading_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-subheading',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price',
			array(
				'label' => __( 'Price', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_background',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-prices' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-prices, {{WRAPPER}} .amadeus-pricing-table.amadeus-pricing-table-style-2 .amadeus-pricing-table-original-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-prices' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_margin',
			array(
				'label'      => __( 'margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-prices' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-prices .amadeus-pricing-table-price',
			)
		);

		$this->add_control(
			'onsale_title',
			array(
				'label'     => __( 'On Sale Price', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'onsale_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-onsale-price' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'onsale_typo',
				'selector'  => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-onsale-price',
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'period_title',
			array(
				'label' => __( 'Period', 'amadeus-elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'period_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-details' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'period_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-details',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list',
			array(
				'label' => __( 'Features List', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'features_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_margin',
			array(
				'label'      => __( 'margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'features_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list',
			)
		);

		$this->add_control(
			'features_icons_size',
			array(
				'label'     => __( 'Icons Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 20,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_space_between',
			array(
				'label'     => __( 'Space Between', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_between_border_color',
			array(
				'label'     => __( 'Border Color Between', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-list li' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			array(
				'label' => __( 'Footer', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'footer_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-footer' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'footer_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'footer_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_title',
			array(
				'label' => __( 'Button', 'amadeus-elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typo',
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow',
				'label'    => __( 'Box Shadow', 'amadeus-elementor' ),
				'selector' => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'button_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'button_hover_bg',
			array(
				'label'     => __( 'Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'additional_info_title',
			array(
				'label'     => __( 'Additional Info', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'additional_info_typo',
				'selector'  => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-additional-info',
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_control(
			'additional_info_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-additional-info' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_control(
			'additional_info_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-additional-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			array(
				'label'     => __( 'Ribbon', 'amadeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_size',
			array(
				'label'     => __( 'Font Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-ribbon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-ribbon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_bg',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-ribbon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-ribbon.amadeus-pricing-table-ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ribbon_shadow',
				'label'     => __( 'Shadow', 'amadeus-elementor' ),
				'selector'  => '{{WRAPPER}} .amadeus-pricing-table .amadeus-pricing-table-ribbon.amadeus-pricing-table-ribbon-1',
				'condition' => array(
					'ribbon'       => 'yes',
					'ribbon_style' => 'ribbon-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			array(
				'label' => __( 'Tooltips', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltips_typo',
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_control(
			'tooltips_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'background-color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box > .tippy-svg-arrow' => 'fill: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box[data-placement^=top] > .tippy-arrow:before' => 'border-top-color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box[data-placement^=left] > .tippy-arrow:before' => 'border-left-color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box[data-placement^=right] > .tippy-arrow:before' => 'border-right-color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box[data-placement^=bottom] > .tippy-arrow:before' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltips_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tooltips_border',
				'label'    => __( 'Border', 'amadeus-elementor' ),
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltips_box_shadow',
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->end_controls_section();

	}

	private function render_currency_symbol( $symbol, $location ) {
		$currency_position = $this->get_settings( 'currency_position' );
		$location_setting  = ! empty( $currency_position ) ? $currency_position : 'before';

		if ( ! empty( $symbol ) && $location === $location_setting ) {
			echo '<span class="amadeus-pricing-table-currency amadeus-currency-' . esc_attr( $location ) . '">' . esc_attr( $symbol ) . '</span>';
		}
	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'pound'        => '&#163;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'baht'         => '&#3647;',
			'yen'          => '&#165;',
			'won'          => '&#8361;',
			'guilder'      => '&fnof;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'rupee'        => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real'         => 'R$',
			'krona'        => 'kr',
		);

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$style        = $settings['style'];
		$bg_image     = '';
		$title_tag    = $settings['title_tag'];
		$currency     = $settings['currency_symbol'];
		$symbol       = '';
		$features     = $settings['items'];
		$ribbon       = $settings['ribbon'];
		$ribbon_style = $settings['ribbon_style'];
		$ribbon_title = $settings['ribbon_title'];

		if ( ! empty( $currency ) ) {
			if ( 'custom' !== $currency ) {
				$symbol = $this->get_currency_symbol( $currency );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		$this->add_render_attribute(
			'wrapper',
			'class',
			array(
				'amadeus-pricing-table',
				'amadeus-pricing-table-' . $style,
			)
		);

		if ( 'ribbon-2' !== $ribbon_style && 'yes' === $ribbon && ! empty( $ribbon_title ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'featured' );
		}

		$this->add_render_attribute( 'button', 'class', 'amadeus-pricing-table-button' );
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}
		$this->add_render_attribute( 'button', 'role', 'button' );

		$this->add_render_attribute( 'header', 'class', 'amadeus-pricing-table-header' );
		$this->add_render_attribute( 'title', 'class', 'amadeus-pricing-table-heading' );
		$this->add_render_attribute( 'sub_title', 'class', 'amadeus-pricing-table-subheading' );
		$this->add_render_attribute( 'period', 'class', 'amadeus-pricing-table-period' );
		$this->add_render_attribute( 'footer_additional_info', 'class', 'amadeus-pricing-table-additional-info' );
		$this->add_render_attribute( 'ribbon_title', 'class', 'amadeus-pricing-table-ribbon-inner' );

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'period', 'none' );
		$this->add_inline_editing_attributes( 'footer_additional_info' );
		$this->add_inline_editing_attributes( 'button_text' );
		$this->add_inline_editing_attributes( 'ribbon_title' );

		if ( 'style-3' === $style ) {
			if ( ! empty( $settings['selected_table_img']['id'] ) ) {
				$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['selected_table_img']['id'], 'selected_table_img', $settings );
			} elseif ( ! empty( $settings['selected_table_img']['url'] ) ) {
				$bg_image = $settings['selected_table_img']['url'];
			}

			$this->add_render_attribute(
				'header',
				'style',
				array(
					'background-image: url(' . $bg_image . ');',
				)
			);
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php
			// Icon
			if ( 'style-2' === $style && ! empty( $settings['selected_table_icon'] ) ) :
				?>
				<div class="amadeus-pricing-table-icon">
					<?php Icons_Manager::render_icon( $settings['selected_table_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
				<?php
			endif;

			// Heading
			if ( $settings['title'] || $settings['sub_title'] ) :
				?>
				<div <?php $this->print_render_attribute_string( 'header' ); ?>>
					<?php
					if ( ! empty( $settings['title'] ) ) :
						?>
						<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>><?php $this->print_unescaped_setting( 'title' ); ?></<?php echo esc_attr( $title_tag ); ?>>
						<?php
					endif;
					?>

					<?php
					if ( ! empty( $settings['sub_title'] ) ) :
						?>
						<span <?php $this->print_render_attribute_string( 'sub_title' ); ?>><?php $this->print_unescaped_setting( 'sub_title' ); ?></span>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;
			?>

			<div class="amadeus-pricing-table-prices">

				<?php
				if ( ! empty( $settings['price'] ) ) :
					?>
					<div class="amadeus-pricing-table-price">
						<?php
						if ( 'yes' === $settings['onsale'] && ! empty( $settings['onsale_price'] ) ) :
							?>
							<span class="amadeus-pricing-table-onsale-price">
								<?php
								$this->render_currency_symbol( $symbol, 'before' );
								$this->print_unescaped_setting( 'onsale_price' );
								$this->render_currency_symbol( $symbol, 'after' );
								?>
							</span>
							<?php
						endif;
						?>

						<span class="amadeus-pricing-table-original-price">
							<?php
							$this->render_currency_symbol( $symbol, 'before' );
							$this->print_unescaped_setting( 'price' );
							$this->render_currency_symbol( $symbol, 'after' );
							?>
						</span>
					</div>
					<?php
				endif;

				if ( ! empty( $settings['period'] ) ) :
					?>
					<div class="amadeus-pricing-table-details">
						<?php
						if ( ! empty( $settings['separator'] ) ) :
							?>
							<span class="amadeus-pricing-table-period-separator"><?php $this->print_unescaped_setting( 'separator' ); ?></span>
							<?php
						endif;
						?>

						<span <?php $this->print_render_attribute_string( 'period' ); ?>><?php $this->print_unescaped_setting( 'period' ); ?></span>
					</div>
					<?php
				endif;
				?>
			</div>

			<?php
			// Features
			if ( ! empty( $features ) ) :
				?>
				<ul class="amadeus-pricing-table-list">
					<?php
					foreach ( $features as $index => $item ) :
						$key = $this->get_repeater_setting_key( 'item_li', 'items', $index );
						$this->add_render_attribute( $key, 'class', 'elementor-repeater-item-' . $item['_id'] );

						if ( 'yes' === $item['disable_item'] ) {
							$this->add_render_attribute( $key, 'class', 'disable-item' );
						}

						$tooltip = $item['item_tooltip'];
						$tooltip_key = $this->get_repeater_setting_key( 'tooltip', 'items', $index );

						if ( 'yes' === $tooltip ) {
							$this->add_render_attribute(
								$tooltip_key,
								array(
									'class' => array(
										'amadeus-pricing-table-tooltip',
										'amadeus-tooltip-' . $item['item_tooltip_position'],
									),
									'title' => $this->parse_text_editor( $item['item_tooltip_content'] ),
								)
							);
						}

						$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'items', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );
						?>

						<li <?php $this->print_render_attribute_string( $key ); ?>>
							<?php
							if ( 'yes' === $tooltip ) {
								?>
								<span <?php $this->print_render_attribute_string( $tooltip_key ); ?>>
								<?php
							}

							if ( ! empty( $item['selected_item_icon'] ) ) :
								Icons_Manager::render_icon( $item['selected_item_icon'], [ 'aria-hidden' => 'true' ] );
							endif;

							if ( ! empty( $item['item_text'] ) ) :
								?>

								<span <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>>
									<?php $this->print_text_editor( $item['item_text'] ); ?>
								</span>

								<?php
							else :
								echo '&nbsp;';
							endif;

							if ( 'yes' === $tooltip ) {
								?>
								</span>
								<?php
							}
							?>
						</li>
						<?php
					endforeach;
					?>
				</ul>
				<?php
			endif;

			// Button
			if ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_additional_info'] ) ) :
				?>
				<div class="amadeus-pricing-table-footer">
					<?php
					if ( ! empty( $settings['button_text'] ) ) :
						?>
						<a <?php $this->print_render_attribute_string( 'button' ); ?>><?php $this->print_unescaped_setting( 'button_text' ); ?></a>
						<?php
					endif;

					if ( 'style-1' !== $settings['style'] && ! empty( $settings['footer_additional_info'] ) ) :
						?>
						<div <?php $this->print_render_attribute_string( 'footer_additional_info' ); ?>><?php $this->print_unescaped_setting( 'footer_additional_info' ); ?></div>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;

			// Ribbon
			if ( 'yes' === $ribbon && ! empty( $ribbon_title ) ) :
				$this->add_render_attribute(
					'ribbon-wrapper',
					'class',
					array(
						'amadeus-pricing-table-ribbon',
						'amadeus-pricing-table-' . $ribbon_style,
						'amadeus-pricing-table-ribbon-' . $settings['ribbon_alignment'],
					)
				);
				?>

				<div <?php $this->print_render_attribute_string( 'ribbon-wrapper' ); ?>>
					<div <?php $this->print_render_attribute_string( 'ribbon_title' ); ?>><?php $this->print_unescaped_setting( 'ribbon_title' ); ?></div>
				</div>
				<?php
			endif;
			?>

		</div>

		<?php
	}

	/**
	 * Render Price Table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			var symbols = {
				dollar: '&#36;',
				euro: '&#128;',
				franc: '&#8355;',
				pound: '&#163;',
				ruble: '&#8381;',
				shekel: '&#8362;',
				baht: '&#3647;',
				yen: '&#165;',
				won: '&#8361;',
				guilder: '&fnof;',
				peso: '&#8369;',
				peseta: '&#8359;',
				lira: '&#8356;',
				rupee: '&#8360;',
				indian_rupee: '&#8377;',
				real: 'R$',
				krona: 'kr'
			};

			var symbol          = '',
				iconsHTML       = {},
				$bg_image       = '',
				iconHTML        = elementor.helpers.renderIcon( view, settings.selected_table_icon, { 'aria-hidden': true }, 'i' , 'object' );

			if ( settings.currency_symbol ) {
				if ( 'custom' !== settings.currency_symbol ) {
					symbol = symbols[ settings.currency_symbol ] || '';
				} else {
					symbol = settings.currency_symbol_custom;
				}
			}

			view.addRenderAttribute( 'wrapper', 'class', ['amadeus-pricing-table', 'amadeus-pricing-table-' + settings.style] );

			if ( 'ribbon-2' != settings.ribbon_style && 'yes' === settings.ribbon && ! _.isEmpty( settings.ribbon_title ) ) {
				view.addRenderAttribute( 'wrapper', 'class', 'featured' );
			}

			view.addRenderAttribute( 'button', 'class', 'amadeus-pricing-table-button' );

			if ( ! _.isEmpty( settings.link.url ) ) {
				view.addRenderAttribute( 'button', settings.link );
			}

			view.addRenderAttribute( 'header', 'class', 'amadeus-pricing-table-header' );
			view.addRenderAttribute( 'title', 'class', 'amadeus-pricing-table-heading' );
			view.addRenderAttribute( 'sub_title', 'class', 'amadeus-pricing-table-subheading' );
			view.addRenderAttribute( 'period', 'class', 'amadeus-pricing-table-period' );
			view.addRenderAttribute( 'footer_additional_info', 'class', 'amadeus-pricing-table-additional-info' );
			view.addRenderAttribute( 'ribbon_title', 'class', 'amadeus-pricing-table-ribbon-inner' );

			view.addInlineEditingAttributes( 'title', 'none' );
			view.addInlineEditingAttributes( 'sub_heading', 'none' );
			view.addInlineEditingAttributes( 'period', 'none' );
			view.addInlineEditingAttributes( 'footer_additional_info' );
			view.addInlineEditingAttributes( 'button_text' );
			view.addInlineEditingAttributes( 'ribbon_title' );

			if ( 'style-3' === settings.style ) {
				if ( '' !== settings.selected_table_img.url ) {
					var bg_image = {
						id: settings.selected_table_img.id,
						url: settings.selected_table_img.url,
						size: settings.selected_table_img_size,
						dimension: settings.selected_table_img_custom_dimension,
						model: view.getEditModel()
					};

					var bgImageUrl = elementor.imagesManager.getImageUrl( bg_image );
				}

				view.addRenderAttribute( 'header', 'style', 'background-image: url(' + bgImageUrl + ');' );
			}
		#>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<#
			if ( 'style-2' === settings.style && ( ! _.isEmpty( settings.table_icon ) || ! _.isEmpty( settings.selected_table_icon ) ) ) { #>
				<div class="amadeus-pricing-table-icon">
					<#
					if ( iconHTML && iconHTML.rendered ) { #>
						{{{ iconHTML.value }}}
					<# } #>
				</div>
			<#
			}

			if ( settings.title || settings.sub_title ) { #>
				<div {{{ view.getRenderAttributeString( 'header' ) }}}>
					<#
					if ( ! _.isEmpty( settings.title ) ) { #>
						<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
					<#
					}

					if ( ! _.isEmpty( settings.sub_title ) ) { #>
						<span {{{ view.getRenderAttributeString( 'sub_title' ) }}}>{{{ settings.sub_title }}}</span>
					<#
					} #>
				</div>
			<#
			} #>

			<div class="amadeus-pricing-table-prices">

				<#
				if ( ! _.isEmpty( settings.price ) ) { #>
					<div class="amadeus-pricing-table-price">
						<#
						if ( 'yes' === settings.onsale && ! _.isEmpty( settings.onsale_price ) ) { #>
							<span class="amadeus-pricing-table-onsale-price">
								<# if ( ! _.isEmpty( symbol ) && 'before' == settings.currency_position ) { #>
									<span class="amadeus-pricing-table-currency amadeus-currency-before">{{{ symbol }}}</span>
								<# } #>
								{{{ settings.onsale_price }}}
								<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
									<span class="amadeus-pricing-table-currency amadeus-currency-after">{{{ symbol }}}</span>
								<# } #>
							</span>
						<#
						} #>

						<span class="amadeus-pricing-table-original-price">
							<# if ( ! _.isEmpty( symbol ) && 'before' == settings.currency_position ) { #>
								<span class="amadeus-pricing-table-currency amadeus-currency-before">{{{ symbol }}}</span>
							<# } #>
							{{{ settings.price }}}
							<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
								<span class="amadeus-pricing-table-currency amadeus-currency-after">{{{ symbol }}}</span>
							<# } #>
						</span>
					</div>
				<#
				}

				if ( ! _.isEmpty( settings.period ) ) { #>
					<div class="amadeus-pricing-table-details">
						<#
						if ( ! _.isEmpty( settings.separator ) ) { #>
							<span class="amadeus-pricing-table-period-separator">{{{ settings.separator }}}</span>
						<#
						} #>

						<span {{{ view.getRenderAttributeString( 'period' ) }}}>{{{ settings.period }}}</span>
					</div>
				<#
				} #>
			</div>

			<#
			if ( ! _.isEmpty( settings.items ) ) { #>
				<ul class="amadeus-pricing-table-list">
					<# _.each( settings.items, function( item, index ) {
						var key = view.getRepeaterSettingKey( 'item_li', 'items', index );

						view.addRenderAttribute( key, 'class', 'elementor-repeater-item-' + item._id );

						if ( item.disable_item ) {
							view.addRenderAttribute( key, 'class', 'disable-item' );
						}

						var tooltip     = item.item_tooltip,
							tooltipKey  = view.getRepeaterSettingKey( 'tooltip', 'items', index );

						if ( 'yes' == tooltip ) {
							view.addRenderAttribute( tooltipKey, 'class', 'amadeus-pricing-table-tooltip' );
							view.addRenderAttribute( tooltipKey, 'class', 'amadeus-tooltip-' + item.item_tooltip_position );
							view.addRenderAttribute( tooltipKey, 'title', item.item_tooltip_content );
						}

						var featureKey = view.getRepeaterSettingKey( 'item_text', 'items', index );

						view.addInlineEditingAttributes( featureKey ); #>

						<li {{{ view.getRenderAttributeString( key ) }}}>
							<# if ( 'yes' == tooltip ) { #>
								<span {{{ view.getRenderAttributeString( tooltipKey ) }}}>
							<# }

							if ( item.selected_item_icon ) {
								iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_item_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
								if ( iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
									{{{ iconsHTML[ index ].value }}}
								<# }
							} #>

							<# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
								<span {{{ view.getRenderAttributeString( featureKey ) }}}>{{{ item.item_text }}}</span>
							<# } else { #>
								&nbsp;
							<# }

							if ( 'yes' == tooltip ) { #>
								</span>
							<# } #>
						</li>
					<# } ); #>
				</ul>
			<#
			}

			if ( ! _.isEmpty( settings.button_text ) || ! _.isEmpty( settings.footer_additional_info ) ) { #>
				<div class="amadeus-pricing-table-footer">
					<#
					if ( ! _.isEmpty( settings.button_text ) ) { #>
						<a {{{ view.getRenderAttributeString( 'button' ) }}}>{{{ settings.button_text }}}</a>
					<#
					}

					if ( 'style-1' != settings.style && ! _.isEmpty( settings.footer_additional_info ) ) { #>
						<div {{{ view.getRenderAttributeString( 'footer_additional_info' ) }}}>{{{ settings.footer_additional_info }}}</div>
					<#
					} #>
				</div>
			<#
			}

			if ( 'yes' === settings.ribbon && ! _.isEmpty( settings.ribbon_title ) ) {
				view.addRenderAttribute( 'ribbon-wrapper', 'class', [
					'amadeus-pricing-table-ribbon',
					'amadeus-pricing-table-' + settings.ribbon_style,
					'amadeus-pricing-table-ribbon-' + settings.ribbon_alignment,
				] ); #>

				<div {{{ view.getRenderAttributeString( 'ribbon-wrapper' ) }}}>
					<div {{{ view.getRenderAttributeString( 'ribbon_title' ) }}}>{{{ settings.ribbon_title }}}</div>
				</div>
			<#
			} #>

		</div>

		<?php
	}

}
