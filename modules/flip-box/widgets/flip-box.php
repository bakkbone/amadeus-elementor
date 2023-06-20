<?php
namespace AmadeusElementor\Modules\FlipBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FlipBox extends Widget_Base {

	public function get_name() {
		return 'amadeus-flip-box';
	}

	public function get_title() {
		return __( 'Flip Box', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-file-picture';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'flip box',
			'flip',
			'box',
			'banner',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-flip-box' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_front',
			[
				'label'         => __( 'Front', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'graphic_element',
			[
				'label'         => __( 'Graphic Element', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'none' => [
						'title' => __( 'None', 'amadeus-elementor' ),
						'icon'  => 'eicon-ban',
					],
					'image' => [
						'title' => __( 'Image', 'amadeus-elementor' ),
						'icon'  => 'eicon-image-bold',
					],
					'icon' => [
						'title' => __( 'Icon', 'amadeus-elementor' ),
						'icon'  => 'eicon-star',
					],
				],
				'default'       => 'icon',
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => __( 'Choose Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'image', // Actually its `image_size`
				'label'         => __( 'Image Size', 'amadeus-elementor' ),
				'default'       => 'thumbnail',
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-snowflake',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label'         => __( 'View', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'default',
				'options'       => [
					'default' => __( 'Default', 'amadeus-elementor' ),
					'stacked' => __( 'Stacked', 'amadeus-elementor' ),
					'framed'  => __( 'Framed', 'amadeus-elementor' ),
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label'         => __( 'Shape', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'circle',
				'options'       => [
					'circle' => __( 'Circle', 'amadeus-elementor' ),
					'square' => __( 'Square', 'amadeus-elementor' ),
				],
				'condition'     => [
					'icon_view!'      => 'default',
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'front_title_text',
			[
				'label'         => __( 'Title & Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'This is the heading', 'amadeus-elementor' ),
				'placeholder'   => __( 'Your Title', 'amadeus-elementor' ),
				'separator'     => 'before',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'front_description_text',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'amadeus-elementor' ),
				'placeholder'   => __( 'Your Description', 'amadeus-elementor' ),
				'title'         => __( 'Input image text here', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_back',
			[
				'label'         => __( 'Back', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'back_title_text',
			[
				'label'         => __( 'Title & Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'This is the heading', 'amadeus-elementor' ),
				'placeholder'   => __( 'Your Title', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'back_description_text',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'amadeus-elementor' ),
				'placeholder'   => __( 'Your Description', 'amadeus-elementor' ),
				'title'         => __( 'Input image text here', 'amadeus-elementor' ),
				'separator'     => 'none',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => __( 'Button Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click Here', 'amadeus-elementor' ),
				'separator'     => 'before',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'http://your-link.com', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'link_click',
			[
				'label'         => __( 'Apply Link On', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'box'    => __( 'Whole Box', 'amadeus-elementor' ),
					'button' => __( 'Button Only', 'amadeus-elementor' ),
				],
				'default'       => 'button',
				'condition'     => [
					'link[url]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label'         => __( 'Settings', 'amadeus-elementor' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', 'vh' ],
				'range'         => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-layer, {{WRAPPER}} .amadeus-flip-box-layer-overlay' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'flip_effect',
			[
				'label'         => __( 'Flip Effect', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'flip',
				'options'       => [
					'flip'     => __( 'Flip', 'amadeus-elementor' ),
					'slide'    => __( 'Slide', 'amadeus-elementor' ),
					'push'     => __( 'Push', 'amadeus-elementor' ),
					'zoom-in'  => __( 'Zoom In', 'amadeus-elementor' ),
					'zoom-out' => __( 'Zoom Out', 'amadeus-elementor' ),
					'fade'     => __( 'Fade', 'amadeus-elementor' ),
				],
				'prefix_class'  => 'amadeus-flip-box-effect-',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'flip_direction',
			[
				'label'         => __( 'Flip Direction', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left'  => __( 'Left', 'amadeus-elementor' ),
					'right' => __( 'Right', 'amadeus-elementor' ),
					'up'    => __( 'Up', 'amadeus-elementor' ),
					'down'  => __( 'Down', 'amadeus-elementor' ),
				],
				'condition'     => [
					'flip_effect!' => [
						'fade',
						'zoom-in',
						'zoom-out',
					],
				],
				'prefix_class'  => 'amadeus-flip-box-direction-',
			]
		);

		$this->add_control(
			'flip_3d',
			[
				'label'         => __( '3D Depth', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'condition'     => [
					'flip_effect' => 'flip',
				],
				'prefix_class'  => 'amadeus-flip-box-3d-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_front',
			[
				'label'         => __( 'Front', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'front_background',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-front',
			]
		);

		$this->add_control(
			'front_background_overlay',
			[
				'label'         => __( 'Background Overlay', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'front_background_image[id]!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'front_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'front_alignment',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-overlay' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'front_vertical_position',
			[
				'label'         => __( 'Vertical Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'top' => [
						'title' => __( 'Top', 'amadeus-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'amadeus-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'amadeus-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'front_border',
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-front',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'heading_image_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'condition'     => [
					'graphic_element' => 'image',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'image_width',
			[
				'label'         => __( 'Size (%)', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ '%' ],
				'default'       => [
					'unit' => '%',
				],
				'range'         => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label'         => __( 'Opacity (%)', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 1,
				],
				'range'         => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-image' => 'opacity: {{SIZE}};',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'image_border',
				'label'         => __( 'Image Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-image img',
				'condition'     => [
					'graphic_element' => 'image',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'image',
				],
			]
		);

		$this->add_control(
			'heading_icon_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'condition'     => [
					'graphic_element' => 'icon',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label'         => __( 'Icon Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label'         => __( 'Secondary Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'         => __( 'Icon Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label'         => __( 'Icon Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'icon_rotate',
			[
				'label'         => __( 'Icon Rotate', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'     => [
					'graphic_element' => 'icon',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label'         => __( 'Border Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'graphic_element' => 'icon',
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'condition'     => [
					'front_title_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'front_title_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'front_description_text!' => '',
				],
			]
		);

		$this->add_control(
			'front_title_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-title' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'front_title_typography',
				'label'         => __( 'Typography', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-title',
			]
		);

		$this->add_control(
			'heading_description_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'condition'     => [
					'front_description_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'front_description_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-desc' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'front_description_typography',
				'label'         => __( 'Typography', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-front .amadeus-flip-box-layer-desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_back',
			[
				'label'         => __( 'Back', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'back_background',
				'types'         => [ 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-back',
			]
		);

		$this->add_control(
			'back_background_overlay',
			[
				'label'         => __( 'Background Overlay', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'condition'     => [
					'back_background_image[id]!' => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'back_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'back_alignment',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'       => 'center',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-overlay' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .amadeus-flip-box-button' => 'margin-{{VALUE}}: 0',
				],
			]
		);

		$this->add_control(
			'back_vertical_position',
			[
				'label'         => __( 'Vertical Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'label_block'   => false,
				'options'       => [
					'top' => [
						'title' => __( 'Top', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-overlay' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'back_border',
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-back',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'heading_back_title_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'condition'     => [
					'back_title_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'back_title_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_control(
			'back_title_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-title' => 'color: {{VALUE}}',

				],
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'back_title_typography',
				'label'         => __( 'Typography', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-title',
				'condition'     => [
					'back_title_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_back_description_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'condition'     => [
					'back_description_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'back_description_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'back_description_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-desc' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typography_b',
				'label'         => __( 'Typography', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-back .amadeus-flip-box-layer-desc',
			]
		);

		$this->add_control(
			'heading_back_button_style',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Button', 'amadeus-elementor' ),
				'condition'     => [
					'button_text!' => '',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'label'         => esc_html__( 'Typography', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => esc_html__( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'         => esc_html__( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => esc_html__( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'          => 'button_border',
				'label'         => esc_html__( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => esc_html__( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-button',
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label'         => esc_html__( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => esc_html__( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'         => esc_html__( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => esc_html__( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => esc_html__( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-flip-box-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_hover_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-flip-box-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$wrap_tag       = 'div';
		$button_tag     = 'a';

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-flip-box-layer amadeus-flip-box-back' );

		$this->add_render_attribute( 'button', 'class', [
			'amadeus-flip-box-button',
			'button',
		] );

		if ( 'box' === $settings['link_click'] ) {
			$wrap_tag = 'a';
			$button_tag = 'button';
			$this->add_link_attributes( 'wrap', $settings['link'] );
		} else {
			$this->add_link_attributes( 'button', $settings['link'] );
			$this->add_render_attribute( 'button', 'class',
				[
					'amadeus-flip-box-button',
					'elementor-button',
				]
			);
		}

		if ( 'icon' === $settings['graphic_element'] ) {
			$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-icon-wrap' );
			$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-view-' . $settings['icon_view'] );

			if ( 'default' !== $settings['icon_view'] ) {
				$this->add_render_attribute( 'icon-wrap', 'class', 'elementor-shape-' . $settings['icon_shape'] );
			}

			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		} ?>

		<div class="amadeus-flip-box">

			<div class="amadeus-flip-box-layer amadeus-flip-box-front">
				<div class="amadeus-flip-box-layer-overlay">
					<div class="amadeus-flip-box-layer-inner">
						<?php
						if ( 'image' === $settings['graphic_element']
							&& ! empty( $settings['image']['url'] ) ) { ?>
							<div class="amadeus-flip-box-image">
								<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>
							</div>
							<?php
						} elseif ( 'icon' === $settings['graphic_element']
							&& ! empty( $settings['selected_icon'] ) ) { ?>
							<div <?php $this->print_render_attribute_string( 'icon-wrap' ); ?>>
								<div class="elementor-icon">
									<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							</div>
							<?php
						}

						if ( ! empty( $settings['front_title_text'] ) ) { ?>
							<h3 class="amadeus-flip-box-layer-title">
								<?php $this->print_unescaped_setting( 'front_title_text' ); ?>
							</h3>
							<?php
						}

						if ( ! empty( $settings['front_description_text'] ) ) { ?>
							<div class="amadeus-flip-box-layer-desc">
								<?php $this->print_unescaped_setting( 'front_description_text' ); ?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>

			<<?php echo esc_attr( $wrap_tag ); ?> <?php $this->print_render_attribute_string( 'wrap' ); ?>>
				<div class="amadeus-flip-box-layer-overlay">
					<div class="amadeus-flip-box-layer-inner">
						<?php
						if ( ! empty( $settings['back_title_text'] ) ) { ?>
							<h3 class="amadeus-flip-box-layer-title">
								<?php $this->print_unescaped_setting( 'back_title_text' ); ?>
							</h3>
							<?php
						}

						if ( ! empty( $settings['back_description_text'] ) ) { ?>
							<div class="amadeus-flip-box-layer-desc">
								<?php $this->print_unescaped_setting( 'back_description_text' ); ?>
							</div>
							<?php
						}

						if ( ! empty( $settings['button_text'] ) ) { ?>
							<<?php echo esc_attr( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
								<?php $this->print_unescaped_setting( 'button_text' ); ?>
							</<?php echo esc_attr( $button_tag ); ?>>
							<?php
						} ?>
					</div>
				</div>
			</<?php echo esc_attr( $wrap_tag ); ?>>

		</div>

		<?php
	}

	protected function content_template() { ?>
		<#
			if ( 'image' === settings.graphic_element && '' !== settings.image.url ) {
				var image = {
					id: settings.image.id,
					url: settings.image.url,
					size: settings.image_size,
					dimension: settings.image_custom_dimension,
					model: view.getEditModel()
				};

				var imageUrl = elementor.imagesManager.getImageUrl( image );
			}

			var wrapperTag = 'div',
				buttonTag = 'a';

			if ( 'box' === settings.link_click ) {
				wrapperTag = 'a';
				buttonTag = 'button';
			}

			if ( 'icon' === settings.graphic_element ) {
				var iconWrapperClasses = 'elementor-icon-wrap';
					iconWrapperClasses += ' elementor-view-' + settings.icon_view;
				if ( 'default' !== settings.icon_view ) {
					iconWrapperClasses += ' elementor-shape-' + settings.icon_shape;
				}
			}

		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<div class="amadeus-flip-box">
			<div class="amadeus-flip-box-layer amadeus-flip-box-front">
				<div class="amadeus-flip-box-layer-overlay">
					<div class="amadeus-flip-box-layer-inner">
						<# if ( 'image' === settings.graphic_element
							&& '' !== settings.image.url ) { #>
							<div class="amadeus-flip-box-image">
								<img src="{{ imageUrl }}">
							</div>
						<# } else if ( 'icon' === settings.graphic_element
							&& settings.selected_icon ) { #>
							<div class="{{ iconWrapperClasses }}" >
								<div class="elementor-icon">
									<# if ( iconHTML && iconHTML.rendered ) { #>
										{{{ iconHTML.value }}}
									<# } #>
								</div>
							</div>
						<# } #>

						<# if ( settings.front_title_text ) { #>
							<h3 class="amadeus-flip-box-layer-title">{{{ settings.front_title_text }}}</h3>
						<# } #>

						<# if ( settings.front_description_text ) { #>
							<div class="amadeus-flip-box-layer-desc">{{{ settings.front_description_text }}}</div>
						<# } #>
					</div>
				</div>
			</div>
			<{{ wrapperTag }} class="amadeus-flip-box-layer amadeus-flip-box-back">
				<div class="amadeus-flip-box-layer-overlay">
					<div class="amadeus-flip-box-layer-inner">
						<# if ( settings.back_title_text ) { #>
							<h3 class="amadeus-flip-box-layer-title">{{{ settings.back_title_text }}}</h3>
						<# } #>

						<# if ( settings.back_description_text ) { #>
							<div class="amadeus-flip-box-layer-desc">{{{ settings.back_description_text }}}</div>
						<# } #>

						<# if ( settings.button_text ) { #>
							<{{ buttonTag }} href="#" class="amadeus-flip-box-button elementor-button button">{{{ settings.button_text }}}</{{ buttonTag }}>
						<# } #>
					</div>
				</div>
			</{{ wrapperTag }}>
		</div>

		<?php
	}
}
