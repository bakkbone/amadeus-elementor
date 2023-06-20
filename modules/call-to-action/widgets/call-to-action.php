<?php
namespace AmadeusElementor\Modules\CallToAction\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class CallToAction extends Widget_Base {

	public function get_name() {
		return 'amadeus-call-to-action';
	}

	public function get_title() {
		return __( 'Call To Action', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-stop2';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'call',
			'action',
			'notice',
			'message',
			'banner',
			'cta',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-call-to-action' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cta_general',
			[
				'label'         => __( 'General', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'basic',
				'options'       => [
					'basic'     => __( 'Basic', 'amadeus-elementor' ),
					'inside'    => __( 'Inside', 'amadeus-elementor' ),
					'outside'   => __( 'Outside', 'amadeus-elementor' ),
				],
				'render_type'   => 'template',
				'prefix_class'  => 'amadeus-cta-style-',
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
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
				'size_units'    => [ 'px', 'vh' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-inner' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label'         => __( 'Image Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'above',
				'options'       => [
					'left' => [
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'above' => [
						'title' => __( 'Above', 'amadeus-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'amadeus-cta-%s-image-',
				'condition' => [
					'style' => 'outside',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'options'       => [
					'left'      => [
						'title'     => __( 'Left', 'amadeus-elementor' ),
						'icon'      => 'eicon-text-align-left',
					],
					'center'    => [
						'title'     => __( 'Center', 'amadeus-elementor' ),
						'icon'      => 'eicon-text-align-center',
					],
					'right'     => [
						'title'     => __( 'Right', 'amadeus-elementor' ),
						'icon'      => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'vertical_position',
			[
				'label'         => __( 'Vertical Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
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
				'prefix_class'  => 'amadeus-cta-valign-',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'         => __( 'Choose Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'dynamic'       => [ 'active' => true ],
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'bg_image',
				'label'         => __( 'Image Resolution', 'amadeus-elementor' ),
				'default'       => 'large',
				'condition'     => [
					'bg_image[id]!' => '',
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay',
			[
				'label'         => __( 'Add Overlay?', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'heading_bg_image',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'condition'     => [
					'bg_image[url]!' => '',
					'style!' => 'basic',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'image_min_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
					'position!' => 'above',
				],
			]
		);

		$this->add_responsive_control(
			'image_min_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'    => [ 'px', 'vh' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_content',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'element',
			[
				'label'         => __( 'Element', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'none',
				'options'       => [
					'none' => [
						'title' => __( 'None', 'amadeus-elementor' ),
						'icon' => 'eicon-ban',
					],
					'image' => [
						'title' => __( 'Image', 'amadeus-elementor' ),
						'icon' => 'eicon-image-bold',
					],
					'icon' => [
						'title' => __( 'Icon', 'amadeus-elementor' ),
						'icon' => 'eicon-star',
					],
				],
			]
		);

		$this->add_control(
			'element_image',
			[
				'label'         => __( 'Choose Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
				'show_label'    => false,
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'element_image',
				'default'       => 'thumbnail',
				'condition'     => [
					'element' => 'image',
					'element_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'selected_cta_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'far fa-gem',
					'library'   => 'fa-regular',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Call to action heading', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'rows'          => 5,
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h3',
				'options'       => amadeus_get_available_tags(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_button',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click me', 'amadeus-elementor' ),
				'placeholder'   => __( 'Click me', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'         => __( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'amadeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'link_click',
			[
				'label'         => __( 'Apply Link On', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'button',
				'options'       => [
					'button' => __( 'Button Only', 'amadeus-elementor' ),
					'box' => __( 'Whole Box', 'amadeus-elementor' ),
				],
				'condition'     => [
					'btn_link[url]!' => '',
				],
			]
		);

		$this->add_control(
			'selected_btn_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => '',
					'library'   => 'fa-regular',
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
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Icon Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 3,
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .amadeus-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'secondary_btn',
			[
				'label'         => __( 'Show Secondary Button?', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'yes',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			's_btn_text',
			[
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Click me', 'amadeus-elementor' ),
				'placeholder'   => __( 'Click me', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_btn_link',
			[
				'label'         => __( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'amadeus-elementor' ),
				'default'       => [
					'url' => '#',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'selected_s_btn_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => '',
					'library'   => 'fa-regular',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_icon_align',
			[
				'label'         => __( 'Icon Position', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'left',
				'options'       => [
					'left' => __( 'Before', 'amadeus-elementor' ),
					'right' => __( 'After', 'amadeus-elementor' ),
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			's_icon_size',
			[
				'label'         => __( 'Icon Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 3,
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_icon_indent',
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
					'{{WRAPPER}} .amadeus-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Box', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-cta',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'basic',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-cta',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'element_style',
			[
				'label'         => __( 'Element', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'element!' => [
						'none',
						'',
					],
				],
			]
		);

		$this->add_control(
			'element_image_spacing',
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
					'{{WRAPPER}} .amadeus-cta-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_image_width',
			[
				'label'         => __( 'Size', 'amadeus-elementor' ) . ' (%)',
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
					'{{WRAPPER}} .amadeus-cta-image img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'element_image_border',
				'selector'      => '{{WRAPPER}} .amadeus-cta-image img',
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_image_border_radius',
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
					'{{WRAPPER}} .amadeus-cta-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'element' => 'image',
				],
			]
		);

		$this->add_control(
			'element_icon_spacing',
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
					'{{WRAPPER}} .amadeus-cta-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_size',
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
					'{{WRAPPER}} .amadeus-cta .amadeus-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_padding',
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
					'{{WRAPPER}} .amadeus-cta .amadeus-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-icon' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-cta .amadeus-icon svg' => 'fill: {{VALUE}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'element_icon_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-icon',
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->add_control(
			'element_icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'element' => 'icon',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->add_control(
			'content_background',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}}.amadeus-cta-style-outside .amadeus-cta .amadeus-cta-inner' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}}.amadeus-cta-style-outside .amadeus-cta .amadeus-cta-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'outside',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typo',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'title_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'title_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typo',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-description',
			]
		);

		$this->add_responsive_control(
			'description_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'          => 'description_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label'         => __( 'Buttons', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label'         => __( 'Hover Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_s_btn_style',
			[
				'label'         => __( 'Secondary Button', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'secondary_btn' => 'yes',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 's_button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_s_button_style' );

		$this->start_controls_tab(
			'tab_s_button_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_s_button_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_background_hover_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn:hover' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 's_button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn',
				'separator'     => 'before',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			's_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 's_button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn',
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			's_button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-btn .amadeus-button.amadeus-cta-s-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'secondary_btn' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hover_effects',
			[
				'label'         => __( 'Hover Effects', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'content_hover_heading',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label'         => __( 'Hover Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'groups'        => [
					[
						'label' => __( 'None', 'amadeus-elementor' ),
						'options' => [
							'' => __( 'None', 'amadeus-elementor' ),
						],
					],
					[
						'label' => __( 'Entrance', 'amadeus-elementor' ),
						'options' => [
							'enter-from-right' => 'Slide In Right',
							'enter-from-left' => 'Slide In Left',
							'enter-from-top' => 'Slide In Up',
							'enter-from-bottom' => 'Slide In Down',
							'enter-zoom-in' => 'Zoom In',
							'enter-zoom-out' => 'Zoom Out',
							'fade-in' => 'Fade In',
						],
					],
					[
						'label' => __( 'Reaction', 'amadeus-elementor' ),
						'options' => [
							'grow' => 'Grow',
							'shrink' => 'Shrink',
							'move-right' => 'Move Right',
							'move-left' => 'Move Left',
							'move-up' => 'Move Up',
							'move-down' => 'Move Down',
						],
					],
					[
						'label' => __( 'Exit', 'amadeus-elementor' ),
						'options' => [
							'exit-to-right' => 'Slide Out Right',
							'exit-to-left' => 'Slide Out Left',
							'exit-to-top' => 'Slide Out Up',
							'exit-to-bottom' => 'Slide Out Down',
							'exit-zoom-in' => 'Zoom In',
							'exit-zoom-out' => 'Zoom Out',
							'fade-out' => 'Fade Out',
						],
					],
				],
				'default'       => 'fade-in',
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'animation_class',
			[
				'label'         => __( 'Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HIDDEN,
				'default'       => 'animated-content',
				'prefix_class'  => 'amadeus-',
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'content_animation_duration',
			[
				'label'         => __( 'Animation Duration', 'amadeus-elementor' ) . ' (ms)',
				'type'          => Controls_Manager::SLIDER,
				'render_type'   => 'template',
				'default'       => [
					'size' => 1000,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta-content' => 'transition-duration: {{SIZE}}ms',
					'{{WRAPPER}}.amadeus-cta-sequenced-animation .amadeus-cta-content:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
					'{{WRAPPER}}.amadeus-cta-sequenced-animation .amadeus-cta-content:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
					'{{WRAPPER}}.amadeus-cta-sequenced-animation .amadeus-cta-content:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
				],
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'sequenced_animation',
			[
				'label'         => __( 'Sequenced Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'return_value'  => 'amadeus-cta-sequenced-animation',
				'prefix_class'  => '',
				'condition'     => [
					'content_animation!' => '',
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'background_hover_heading',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'separator'     => 'before',
				'condition'     => [
					'style' => 'inside',
				],
			]
		);

		$this->add_control(
			'transformation',
			[
				'label'         => __( 'Hover Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'' => 'None',
					'zoom-in' => 'Zoom In',
					'zoom-out' => 'Zoom Out',
					'move-left' => 'Move Left',
					'move-right' => 'Move Right',
					'move-up' => 'Move Up',
					'move-down' => 'Move Down',
				],
				'default'       => 'zoom-in',
				'prefix_class'  => 'amadeus-bg-transform amadeus-bg-transform-',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'         => __( 'Overlay Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-bg-overlay' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'          => 'bg_filters',
				'selector'      => '{{WRAPPER}} .amadeus-cta .amadeus-cta-bg',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_blend_mode',
			[
				'label'         => __( 'Blend Mode', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'' => __( 'Normal', 'amadeus-elementor' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'overlay_color_hover',
			[
				'label'         => __( 'Overlay Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta:hover .amadeus-cta-bg-overlay' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'          => 'bg_filters_hover',
				'selector'      => '{{WRAPPER}} .amadeus-cta:hover .amadeus-cta-bg',
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->add_control(
			'effect_duration',
			[
				'label'         => __( 'Transition Duration', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'render_type'   => 'template',
				'default'       => [
					'size' => 1500,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 3000,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-cta .amadeus-cta-bg, {{WRAPPER}} .amadeus-cta .amadeus-cta-bg-overlay' => 'transition-duration: {{SIZE}}ms',
				],
				'condition'     => [
					'style!' => 'basic',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$bg_image           = '';
		$wrapper_tag        = 'div';
		$btn_tag            = 'a';
		$tag                = $settings['title_html_tag'];
		$animation          = $settings['content_animation'];

		$this->add_render_attribute( 'wrapper', 'class', 'amadeus-cta' );

		if ( ! empty( $settings['bg_image']['id'] ) ) {
			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {
			$bg_image = $settings['bg_image']['url'];
		}

		$this->add_render_attribute( [
			'bg_image' => [
				'class' => 'amadeus-cta-bg',
				'style' => 'background-image: url(' . $bg_image . ');',
			],
		] );

		$this->add_render_attribute( 'element', [
			'class' => [
				'amadeus-cta-item',
				'amadeus-cta-content',
			],
		] );

		if ( 'icon' === $settings['element'] ) {
			$this->add_render_attribute( 'element', 'class', 'amadeus-cta-icon' );
		} elseif ( 'image' === $settings['element'] && ! empty( $settings['element_image']['url'] ) ) {
			$this->add_render_attribute( 'element', 'class', 'amadeus-cta-image' );
		}

		$this->add_render_attribute( 'title', [
			'class' => [
				'amadeus-cta-title',
				'amadeus-cta-content',
			],
		] );
		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute( 'description', [
			'class' => [
				'amadeus-cta-description',
				'amadeus-cta-content',
			],
		] );
		$this->add_inline_editing_attributes( 'description' );

		$this->add_render_attribute( 'btn-wrapper', [
			'class' => [
				'amadeus-cta-btn',
				'amadeus-cta-content',
			],
		] );

		$this->add_render_attribute( 'btn', 'class',
			[
				'amadeus-button',
				'elementor-button',
			]
		);

		$this->add_render_attribute( 's-btn', [
			'class' => [
				'amadeus-button',
				'elementor-button',
				'amadeus-cta-s-btn',
			],
		] );

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$link_element = 'btn';

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag = 'a';
				$btn_tag = 'span';
				$link_element = 'wrapper';
			}

			$this->add_link_attributes( $link_element, $settings['btn_link'] );
		}

		if ( ! empty( $settings['s_btn_link']['url'] ) ) {
			$this->add_link_attributes( 's-btn', $settings['s_btn_link'] );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			$this->add_render_attribute( 's-btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		if ( ! empty( $animation ) && 'inside' === $settings['style'] ) {
			$animation_class = 'amadeus-animated-' . $animation;
			$this->add_render_attribute( 'element', 'class', $animation_class );
			$this->add_render_attribute( 'title', 'class', $animation_class );
			$this->add_render_attribute( 'description', 'class', $animation_class );
			$this->add_render_attribute( 'btn-wrapper', 'class', $animation_class );
		} ?>

		<<?php echo esc_attr( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php
			if ( 'basic' !== $settings['style']
				&& ! empty( $bg_image ) ) : ?>
				<div class="amadeus-cta-bg-wrapper">
					<div <?php $this->print_render_attribute_string( 'bg_image' ); ?>></div>
					<?php
					if ( 'yes' === $settings['overlay'] ) : ?>
						<div class="amadeus-cta-bg-overlay"></div>
						<?php
					endif; ?>
				</div>
				<?php
			endif; ?>

			<div class="amadeus-cta-inner">
				<?php
				if ( 'image' === $settings['element']
					&& ! empty( $settings['element_image']['url'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'element' ); ?>>
						<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'element_image' ) ); ?>
					</div>
					<?php
				elseif ( 'icon' === $settings['element']
					&& ( ! empty( $settings['selected_cta_icon'] ) ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'element' ); ?>>
						<div class="amadeus-icon">
							<?php Icons_Manager::render_icon( $settings['selected_cta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
					<?php
				endif;

				if ( ! empty( $settings['title'] ) ) : ?>
					<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
						<?php $this->print_unescaped_setting( 'title' ); ?>
					</<?php echo esc_attr( $tag ); ?>>
					<?php
				endif;

				if ( ! empty( $settings['description'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'description' ); ?>><?php $this->print_unescaped_setting( 'description' ); ?></div>
					<?php
				endif;

				if ( ! empty( $settings['btn_text'] ) && ! empty( $settings['btn_link']['url'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'btn-wrapper' ); ?>>
						<<?php echo esc_attr( $btn_tag ); ?> <?php $this->print_render_attribute_string( 'btn' ); ?>>
							<?php
							if ( 'left' === $settings['icon_align']
								&& ! empty( $settings['selected_btn_icon'] ) ) :
								Icons_Manager::render_icon( $settings['selected_btn_icon'], [ 'aria-hidden' => 'true' ] );
							endif; ?>
							<span><?php $this->print_unescaped_setting( 'btn_text' ); ?></span>
							<?php
							if ( 'right' === $settings['icon_align']
								&& ! empty( $settings['selected_btn_icon'] ) ) :
								Icons_Manager::render_icon( $settings['selected_btn_icon'], [ 'aria-hidden' => 'true' ] );
							endif; ?>
						</<?php echo esc_attr( $btn_tag ); ?>>

						<?php
						if ( 'yes' === $settings['secondary_btn']
							&& ! empty( $settings['s_btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 's-btn' ); ?>>
								<?php
								if ( 'left' === $settings['s_icon_align']
									&& ( ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									Icons_Manager::render_icon( $settings['selected_s_btn_icon'], [ 'aria-hidden' => 'true' ] );
								endif; ?>
								<span><?php $this->print_unescaped_setting( 's_btn_text' ); ?></span>
								<?php
								if ( 'right' === $settings['s_icon_align']
									&& ( ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									Icons_Manager::render_icon( $settings['selected_s_btn_icon'], [ 'aria-hidden' => 'true' ] );
								endif; ?>
							</a>
							<?php
						endif; ?>
					</div>
					<?php
				endif; ?>
			</div>
		</<?php echo esc_attr( $wrapper_tag ); ?>>

		<?php
	}

	/**
	 * Render Call to Action widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		var wrapperTag          = 'div',
			buttonTag          	= 'a',
			contentAnimation    = settings.content_animation,
			animationClass,
			iconHTML            = elementor.helpers.renderIcon( view, settings.selected_cta_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			btnIconHTML         = elementor.helpers.renderIcon( view, settings.selected_btn_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			sbtnIconHTML        = elementor.helpers.renderIcon( view, settings.selected_s_btn_icon, { 'aria-hidden': true }, 'i' , 'object' );

		if ( '' !== settings.bg_image.url ) {
			var bg_image = {
				id: settings.bg_image.id,
				url: settings.bg_image.url,
				size: settings.bg_image_size,
				dimension: settings.bg_image_custom_dimension,
				model: view.getEditModel()
			};

			var bgImageUrl = elementor.imagesManager.getImageUrl( bg_image );
		}

		view.addRenderAttribute( 'wrapper', 'class', 'amadeus-cta' );

		view.addRenderAttribute( 'bg_image', 'style', 'background-image: url(' + bgImageUrl + ');' );

		view.addRenderAttribute( 'element', 'class', [ 'amadeus-cta-item', 'amadeus-cta-content' ] );

		if ( 'icon' === settings.element ) {
			view.addRenderAttribute( 'element', 'class', 'amadeus-cta-icon' );
		} else if ( 'image' === settings.element && '' !== settings.element_image.url ) {
			var image = {
				id: settings.element_image.id,
				url: settings.element_image.url,
				size: settings.element_image_size,
				dimension: settings.element_image_custom_dimension,
				model: view.getEditModel()
			};

			var imageUrl = elementor.imagesManager.getImageUrl( image );
			view.addRenderAttribute( 'element', 'class', 'amadeus-cta-image' );
		}

		view.addRenderAttribute( 'title', 'class', [ 'amadeus-cta-title', 'amadeus-cta-content' ] );
		view.addInlineEditingAttributes( 'title' );

		view.addRenderAttribute( 'description', 'class', [ 'amadeus-cta-description', 'amadeus-cta-content' ] );
		view.addInlineEditingAttributes( 'description' );

		view.addRenderAttribute( 'btn-wrapper', 'class', [ 'amadeus-cta-btn', 'amadeus-cta-content' ] );

		if ( 'box' === settings.link_click ) {
			wrapperTag = 'a';
			buttonTag = 'span';
			view.addRenderAttribute( 'wrapper', 'href', '#' );
		}

		if ( settings.button_hover_animation ) {
			view.addRenderAttribute( 'btn', 'class', 'elementor-animation-' + settings.button_hover_animation );
			view.addRenderAttribute( 's-btn', 'class', 'elementor-animation-' + settings.button_hover_animation );
		}

		if ( contentAnimation && 'inside' === settings.style ) {
			var animationClass = 'amadeus-animated-' + contentAnimation;
			view.addRenderAttribute( 'element', 'class', animationClass );
			view.addRenderAttribute( 'title', 'class', animationClass );
			view.addRenderAttribute( 'description', 'class', animationClass );
			view.addRenderAttribute( 'btn-wrapper', 'class', animationClass );
		} #>

		<{{ wrapperTag }} {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<# if ( 'basic' !== settings.style && ! _.isEmpty( bg_image ) ) { #>
				<div class="amadeus-cta-bg-wrapper">
					<div class="amadeus-cta-bg" {{{ view.getRenderAttributeString( 'bg_image' ) }}}></div>
					<# if ( 'yes' === settings.overlay ) { #>
						<div class="amadeus-cta-bg-overlay"></div>
					<# } #>
				</div>
			<# } #>

			<div class="amadeus-cta-inner">
				<# if ( 'image' === settings.element
					&& '' !== settings.element_image.url ) { #>
					<div {{{ view.getRenderAttributeString( 'element' ) }}}>
						<img src="{{ imageUrl }}">
					</div>
				<# } else if ( 'icon' === settings.element && ( settings.cta_icon || settings.selected_cta_icon ) ) { #>
					<div {{{ view.getRenderAttributeString( 'element' ) }}}>
						<div class="amadeus-icon">
							<# if ( iconHTML && iconHTML.rendered ) { #>
								{{{ iconHTML.value }}}
							<# } #>
						</div>
					</div>
				<# }

				if ( settings.title ) { #>
					<{{ settings.title_html_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_html_tag }}>
				<# }

				if ( settings.description ) { #>
					<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
				<# }

				if ( settings.btn_text ) { #>
					<div {{{ view.getRenderAttributeString( 'btn-wrapper' ) }}}>
						<{{ buttonTag }} href="{{ settings.btn_link.url }}" class="amadeus-button elementor-button elementor-animation-{{ settings.button_animation }}">
							<#
							if ( 'left' == settings.icon_align && ( btnIconHTML && btnIconHTML.rendered ) ) { #>
								{{{ btnIconHTML.value }}}
							<# } #>
							<span>{{{ settings.btn_text }}}</span>
							<#
							if ( 'right' == settings.icon_align && ( btnIconHTML && btnIconHTML.rendered ) ) { #>
								{{{ btnIconHTML.value }}}
							<# } #>
						</{{ buttonTag }}>

						<# if ( 'yes' == settings.secondary_btn && settings.s_btn_text ) { #>
							<a href="{{ settings.s_btn_link.url }}" class="amadeus-button amadeus-cta-s-btn elementor-button elementor-animation-{{ settings.button_animation }}">
								<# if ( 'left' == settings.s_icon_align && sbtnIconHTML && sbtnIconHTML.rendered ) { #>
									{{{ sbtnIconHTML.value }}}
								<# } #>
								<span>{{{ settings.s_btn_text }}}</span>
								<# if ( 'right' == settings.s_icon_align && sbtnIconHTML && sbtnIconHTML.rendered ) { #>
									{{{ sbtnIconHTML.value }}}
								<# } #>
							</a>
						<# } #>
					</div>
				<# } #>
			</div>
		</{{ wrapperTag }}>
		<?php
	}

}
