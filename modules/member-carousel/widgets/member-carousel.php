<?php
namespace AmadeusElementor\Modules\MemberCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Member_Carousel extends Widget_Base {

	public function get_name() {
		return 'amadeus-member-carousel';
	}

	public function get_title() {
		return __( 'Member Carousel', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-user';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'member',
			'user',
			'team',
			'carousel',
			'slider',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-member-carousel', 'swiper' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-member-carousel' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_members',
			[
				'label'         => __( 'Members', 'amadeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'         => __( 'Name', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Member #1', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'role',
			[
				'label'         => __( 'Role', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Co-Founder', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
				'rows'          => 10,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'mail',
			[
				'label'         => __( 'Mail Address', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'facebook',
			[
				'label'         => __( 'Facebook', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '#',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'twitter',
			[
				'label'         => __( 'Twitter', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '#',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'instagram',
			[
				'label'         => __( 'Instagram', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => '#',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'linkedin',
			[
				'label'         => __( 'linkedin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'youtube',
			[
				'label'         => __( 'YouTube', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'pinterest',
			[
				'label'         => __( 'Pinterest', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'members',
			[
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'          => __( 'Member #1', 'amadeus-elementor' ),
						'role'          => __( 'Co-Founder', 'amadeus-elementor' ),
						'description'   => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
						'facebook'      => '#',
						'twitter'       => '#',
						'instagram'     => '#',
					],
					[
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'          => __( 'Member #2', 'amadeus-elementor' ),
						'role'          => __( 'Co-Founder', 'amadeus-elementor' ),
						'description'   => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
						'facebook'      => '#',
						'twitter'       => '#',
						'instagram'     => '#',
					],
					[
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'          => __( 'Member #3', 'amadeus-elementor' ),
						'role'          => __( 'Co-Founder', 'amadeus-elementor' ),
						'description'   => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
						'facebook'      => '#',
						'twitter'       => '#',
						'instagram'     => '#',
					],
					[
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'          => __( 'Member #4', 'amadeus-elementor' ),
						'role'          => __( 'Co-Founder', 'amadeus-elementor' ),
						'description'   => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
						'facebook'      => '#',
						'twitter'       => '#',
						'instagram'     => '#',
					],
				],
				'title_field'   => '{{{ name }}}',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'Name HTML Tag', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h3',
				'options'       => amadeus_get_available_tags(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_member_carousel',
			[
				'label'         => __( 'Carousel', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'carousel_effect',
			[
				'label'       => __( 'Effect', 'amadeus-elementor' ),
				'description' => __( 'Sets transition effect', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => [
					'slide'     => __( 'Slide', 'amadeus-elementor' ),
					'fade'      => __( 'Fade', 'amadeus-elementor' ),
					'coverflow' => __( 'Coverflow', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'items',
			[
				'label'          => __( 'Visible Items', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 2 ],
				'tablet_default' => [ 'size' => 2 ],
				'mobile_default' => [ 'size' => 1 ],
				'range'          => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
				'size_units'     => '',
				'condition'      => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_responsive_control(
			'slides',
			[
				'label'          => __( 'Items By Slides', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 2 ],
				'tablet_default' => [ 'size' => 2 ],
				'mobile_default' => [ 'size' => 1 ],
				'range'          => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					],
				],
				'size_units'     => '',
				'condition'      => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Items Gap', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 10 ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'carousel_effect' => [ 'slide', 'coverflow' ],
				],
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => __( 'Slider Speed', 'amadeus-elementor' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [ 'size' => 400 ],
				'range'       => [
					'px' => [
						'min'  => 100,
						'max'  => 3000,
						'step' => 1,
					],
				],
				'size_units'  => '',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'      => __( 'Autoplay Speed', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 2000 ],
				'range'      => [
					'px' => [
						'min'  => 500,
						'max'  => 5000,
						'step' => 1,
					],
				],
				'size_units' => '',
				'condition'  => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => __( 'Pause On Hover', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'    => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'        => __( 'Infinite Loop', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'navigation_heading',
			[
				'label'     => __( 'Navigation', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'        => __( 'Arrows', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __( 'Dots', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			[
				'label'         => __( 'Arrows', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'      => __( 'Size', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 20 ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-swiper-buttons svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-swiper-buttons svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Member', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'member_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-details' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'member_border',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-details',
			]
		);

		$this->add_responsive_control(
			'member_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'member_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'member_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_heading',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'         => __( 'Text Alignment', 'amadeus-elementor' ),
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
					'justify' => [
						'title' => __( 'Justified', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label'         => __( 'Content Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'image_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label'         => __( 'Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			[
				'label'         => __( 'Name', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'name_typography',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-name',
			]
		);

		$this->add_responsive_control(
			'name_spacing',
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
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_role',
			[
				'label'         => __( 'Role', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'role_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-role' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'role_typography',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-role',
			]
		);

		$this->add_responsive_control(
			'role_spacing',
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
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'text_typography',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-description',
			]
		);

		$this->add_responsive_control(
			'text_spacing',
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
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			[
				'label'         => __( 'Social Icon', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icons_bg',
			[
				'label'         => __( 'Wrapper Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icons_wrap_padding',
			[
				'label'         => __( 'Wrapper Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icons_style' );

		$this->start_controls_tab(
			'tab_icons_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'icons_background',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a .amadeus-icon use' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icons_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'icons_hover_background',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a:hover .amadeus-icon use' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'icons_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'icons_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icons_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Icons Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 6,
						'max' => 150,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li a .amadeus-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icons_indent',
			[
				'label'         => __( 'Icons Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .amadeus-member-carousel-wrap .amadeus-member-carousel-social li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			[
				'label'         => __( 'Pagination', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'      => __( 'Size', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [ 'size' => 8 ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_active_color',
			[
				'label'         => __( 'Active Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-member-carousel-wrap .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$title_tag  = $settings['title_html_tag'];

		// Data settings
		$this->add_render_attribute(
			'amadeus-carousel-container',
			[
				'class'           => [
					'amadeus-member-carousel',
					'swiper-container',
					'amadeus-carousel-container',
				],
			]
		);

		if ( 'yes' === $settings['dots'] ) {
			$this->add_render_attribute( 'amadeus-carousel-container', 'class', 'has-dots' );
		}

		$carousel_settings = [];

		if ( ! empty( $settings['items']['size'] ) ) {
			$carousel_settings['items'] = $settings['items']['size'];
		}

		if ( ! empty( $settings['items_tablet']['size'] ) ) {
			$carousel_settings['items-tablet'] = $settings['items_tablet']['size'];
		}

		if ( ! empty( $settings['items_mobile']['size'] ) ) {
			$carousel_settings['items-mobile'] = $settings['items_mobile']['size'];
		}

		if ( ! empty( $settings['slides']['size'] ) ) {
			$carousel_settings['slides'] = $settings['slides']['size'];
		}

		if ( ! empty( $settings['slides_tablet']['size'] ) ) {
			$carousel_settings['slides-tablet'] = $settings['slides_tablet']['size'];
		}

		if ( ! empty( $settings['slides_mobile']['size'] ) ) {
			$carousel_settings['slides-mobile'] = $settings['slides_mobile']['size'];
		}

		if ( ! empty( $settings['margin']['size'] ) ) {
			$carousel_settings['margin'] = $settings['margin']['size'];
		}
		if ( ! empty( $settings['margin_tablet']['size'] ) ) {
			$carousel_settings['margin-tablet'] = $settings['margin_tablet']['size'];
		}
		if ( ! empty( $settings['margin_mobile']['size'] ) ) {
			$carousel_settings['margin-mobile'] = $settings['margin_mobile']['size'];
		}

		if ( $settings['carousel_effect'] ) {
			$carousel_settings['effect'] = $settings['carousel_effect'];
		}

		if ( ! empty( $settings['slider_speed']['size'] ) ) {
			$carousel_settings['speed'] = $settings['slider_speed']['size'];
		}

		if ( 'yes' === $settings['autoplay'] && ! empty( $settings['autoplay_speed']['size'] ) ) {
			$carousel_settings['autoplay'] = $settings['autoplay_speed']['size'];
		} else {
			$carousel_settings['autoplay'] = '0';
		}

		if ( 'yes' === $settings['pause_on_hover'] ) {
			$carousel_settings['pause-on-hover'] = 'true';
		}

		if ( 'yes' === $settings['infinite_loop'] ) {
			$carousel_settings['loop'] = '1';
		}

		if ( 'yes' === $settings['arrows'] ) {
			$carousel_settings['arrows'] = '1';
		}

		if ( 'yes' === $settings['dots'] ) {
			$carousel_settings['dots'] = '1';
		}

		$this->add_render_attribute( 'amadeus-carousel-container', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

		<div class="amadeus-member-carousel-wrap swiper-container-wrap">

			<div <?php $this->print_render_attribute_string( 'amadeus-carousel-container' ); ?>>
				<div class="swiper-wrapper">

					<?php
					foreach ( $settings['members'] as $index => $item ) :

						// Data
						$name           = $item['name'];
						$role           = $item['role'];
						$description    = $item['description'];
						$mail           = $item['mail'];
						$facebook       = $item['facebook'];
						$twitter        = $item['twitter'];
						$instagram      = $item['instagram'];
						$linkedin       = $item['linkedin'];
						$youtube        = $item['youtube'];
						$pinterest      = $item['pinterest']; ?>

						<div class="amadeus-member-carousel-slide swiper-slide">
							<div class="amadeus-member-carousel-details">
								<?php
								if ( ! empty( $item['image']['url'] ) ) { ?>
									<div class="amadeus-member-carousel-image">
										<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'image' ) ); ?>
									</div>
									<?php
								} ?>
								<div class="amadeus-member-carousel-content">
									<?php
									if ( ! empty( $name ) ) { ?>
										<<?php echo esc_attr( $title_tag ); ?> class="amadeus-member-carousel-name">
											<?php echo esc_html( $name ); ?>
										</<?php echo esc_attr( $title_tag ); ?>>
										<?php
									}

									if ( ! empty( $role ) ) { ?>
										<span class="amadeus-member-carousel-role"><?php $this->print_text_editor( $item['role'] ); ?></span>
										<?php
									}

									if ( ! empty( $description ) ) { ?>
										<div class="amadeus-member-carousel-description"><?php $this->print_text_editor( $item['description'] ); ?></div>
										<?php
									}

									if ( ! empty( $mail )
										|| ! empty( $facebook )
										|| ! empty( $twitter )
										|| ! empty( $instagram )
										|| ! empty( $linkedin )
										|| ! empty( $youtube )
										|| ! empty( $pinterest ) ) { ?>

										<ul class="amadeus-member-carousel-social">
											<?php
											if ( ! empty( $mail ) ) { ?>
												<li><a href="mailto:<?php esc_attr( $mail_address ); ?>"><i class="fas fa-envelope"></i></a></li>
												<?php
											}

											if ( ! empty( $facebook ) ) { ?>
												<li><a href="<?php esc_url( $facebook ); ?>"><i class="fab fa-facebook"></i></a></li>
												<?php
											}

											if ( ! empty( $twitter ) ) { ?>
												<li><a href="<?php esc_url( $twitter ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
												<?php
											}

											if ( ! empty( $instagram ) ) { ?>
												<li><a href="<?php esc_url( $instagram ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
												<?php
											}

											if ( ! empty( $linkedin ) ) { ?>
												<li><a href="<?php esc_url( $linkedin ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
												<?php
											}

											if ( ! empty( $youtube ) ) { ?>
												<li><a href="<?php esc_url( $youtube ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
												<?php
											}

											if ( ! empty( $pinterest ) ) { ?>
												<li><a href="<?php esc_url( $pinterest ); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
												<?php
											} ?>
										</ul>

										<?php
									} ?>
								</div>
							</div>
						</div>
						<?php
					endforeach; ?>

				</div>
			</div>

			<?php
			if ( 'yes' === $settings['arrows'] ) {
				?>
				<div class="swiper-button-next amadeus-swiper-buttons swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php
					if ( is_RTL() ) {
						?>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" xml:space="preserve"><path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></svg>
						<?php
					} else {
						?>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" xml:space="preserve"><path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/></svg>
						<?php
					}
					?>
				</div>
				<div class="swiper-button-prev amadeus-swiper-buttons swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php
					if ( is_RTL() ) {
						?>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.004 492.004" xml:space="preserve"><path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12 c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028 c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265 c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/></svg>
						<?php
					} else {
						?>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" xml:space="preserve"><path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12 C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084 c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864 l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/></svg>
						<?php
					}
					?>
				</div>
				<?php
			}

			if ( 'yes' === $settings['dots'] ) {
				?>
				<div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
				<?php
			}
			?>

		</div>

		<?php
	}

}
