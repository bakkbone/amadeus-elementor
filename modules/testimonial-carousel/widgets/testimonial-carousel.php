<?php
namespace AmadeusElementor\Modules\TestimonialCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;

class Testimonial_Carousel extends Widget_Base {

	public function get_name() {
		return 'amadeus-testimonial-carousel';
	}

	public function get_title() {
		return __( 'Testimonial Carousel', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-star';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'testimonial',
			'testimonials',
			'blockquote',
			'testi',
			'review',
			'recommendation',
			'appreciation',
			'feedback',
			'testimonial carousel',
			'testimonial slider',
			'carousel',
			'slider',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-testimonial-carousel' );
	}

	public function get_style_depends() {
		return array( 'amadeus-testimonial-carousel' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonial',
			array(
				'label' => __( 'Testimonial', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'testimonial_style',
			array(
				'label'   => __( 'Style', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => array(
					'classic' => __( 'Classic', 'amadeus-elementor' ),
					'inline'  => __( 'Inline', 'amadeus-elementor' ),
					'bubble'  => __( 'Bubble', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'testimonial_inline_image_position',
			array(
				'label'          => __( 'Image Alignment', 'amadeus-elementor' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'before',
				'options'        => array(
					'before' => array(
						'title' => __( 'Before', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'after'  => array(
						'title' => __( 'After', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'style_transfer' => true,
				'condition'      => array(
					'testimonial_style' => 'inline',
				),
			)
		);

		$this->add_control(
			'testimonial_symbol',
			array(
				'label'   => __( 'Display Symbol', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'dynamic' => array(
					'active' => true,
				),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'testimonial_alignment',
			array(
				'label'          => __( 'Alignment', 'amadeus-elementor' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'center',
				'options'        => array(
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
				'style_transfer' => true,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'testimonial_content',
			array(
				'label'   => __( 'Content', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array(
					'active' => true,
				),
				'rows'    => '10',
				'default' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'amadeus-elementor' ),
			)
		);

		$repeater->add_control(
			'testimonial_image',
			array(
				'label'   => __( 'Choose Image', 'amadeus-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'testimonial_image',
				'default'   => 'full',
				'separator' => 'none',
			)
		);

		$repeater->add_control(
			'testimonial_name',
			array(
				'label'   => __( 'Name', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Mark Wolf', 'amadeus-elementor' ),
			)
		);

		$repeater->add_control(
			'testimonial_company',
			array(
				'label'   => __( 'Company', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Web Designer', 'amadeus-elementor' ),
			)
		);

		$repeater->add_control(
			'testimonial_rating',
			array(
				'label'   => __( 'Display Rating', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'dynamic' => array(
					'active' => true,
				),
				'default' => 'no',
			)
		);

		$repeater->add_control(
			'testimonial_rating_number',
			array(
				'label'     => __( 'Rating Number', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'rating-five',
				'options'   => array(
					'rating-one'   => __( '1', 'amadeus-elementor' ),
					'rating-two'   => __( '2', 'amadeus-elementor' ),
					'rating-three' => __( '3', 'amadeus-elementor' ),
					'rating-four'  => __( '4', 'amadeus-elementor' ),
					'rating-five'  => __( '5', 'amadeus-elementor' ),
				),
				'condition' => array(
					'testimonial_rating' => 'yes',
				),
			)
		);

		$this->add_control(
			'testimonial_slider',
			array(
				'label'       => __( 'Testimonial Item', 'amadeus-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'amadeus-elementor' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'amadeus-elementor' ),
						'testimonial_company' => __( 'Web Designer', 'amadeus-elementor' ),
						'testimonial_rating'  => 'no',
					),
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'amadeus-elementor' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'amadeus-elementor' ),
						'testimonial_company' => __( 'Web Designer', 'amadeus-elementor' ),
						'testimonial_rating'  => 'no',
					),
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'amadeus-elementor' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'amadeus-elementor' ),
						'testimonial_company' => __( 'Web Designer', 'amadeus-elementor' ),
						'testimonial_rating'  => 'no',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ testimonial_name }}}',
			)
		);

		$this->add_control(
			'testimonial_image_position',
			array(
				'label'          => __( 'Image Position', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'aside',
				'options'        => array(
					'aside' => __( 'Aside', 'amadeus-elementor' ),
					'top'   => __( 'Top', 'amadeus-elementor' ),
				),
				'condition'      => array(
					'testimonial_style!' => 'inline',
				),
				'separator'      => 'before',
				'style_transfer' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_blog_carousel',
			array(
				'label' => __( 'Carousel', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'carousel_effect',
			array(
				'label'       => __( 'Effect', 'amadeus-elementor' ),
				'description' => __( 'Sets transition effect', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => array(
					'slide'     => __( 'Slide', 'amadeus-elementor' ),
					'fade'      => __( 'Fade', 'amadeus-elementor' ),
					'coverflow' => __( 'Coverflow', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_responsive_control(
			'items',
			array(
				'label'          => __( 'Visible Items', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array( 'size' => 1 ),
				'tablet_default' => array( 'size' => 1 ),
				'mobile_default' => array( 'size' => 1 ),
				'range'          => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'size_units'     => '',
				'condition'      => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_responsive_control(
			'slides',
			array(
				'label'          => __( 'Items By Slides', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array( 'size' => 1 ),
				'tablet_default' => array( 'size' => 1 ),
				'mobile_default' => array( 'size' => 1 ),
				'range'          => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'size_units'     => '',
				'condition'      => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'      => __( 'Items Gap', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => 10 ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_control(
			'slider_speed',
			array(
				'label'       => __( 'Slider Speed', 'amadeus-elementor' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array( 'size' => 400 ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 3000,
						'step' => 1,
					),
				),
				'size_units'  => '',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => __( 'Autoplay', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'      => __( 'Autoplay Speed', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => 2000 ),
				'range'      => array(
					'px' => array(
						'min'  => 500,
						'max'  => 5000,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'        => __( 'Pause On Hover', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'    => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'infinite_loop',
			array(
				'label'        => __( 'Infinite Loop', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'navigation_heading',
			array(
				'label'     => __( 'Navigation', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'        => __( 'Arrows', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'        => __( 'Dots', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			array(
				'label' => __( 'Arrows', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'arrows_size',
			array(
				'label'     => __( 'Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array( 'size' => 20 ),
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-carousel .amadeus-swiper-buttons svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrows_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-carousel .amadeus-swiper-buttons svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_icon',
			array(
				'label' => __( 'Quote Icon', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-symbol path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-symbol-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-symbol-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-symbol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-symbol-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_content',
			array(
				'label' => __( 'Content', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Text Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .amadeus-testimonial-content',
			)
		);

		$this->add_control(
			'content_bg',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-content, {{WRAPPER}} .amadeus-testimonial-bubble .amadeus-testimonial-content, {{WRAPPER}} .amadeus-testimonial-bubble .amadeus-testimonial-content:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-content, {{WRAPPER}} .amadeus-testimonial-bubble .amadeus-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-content, {{WRAPPER}} .amadeus-testimonial-bubble .amadeus-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_img',
			array(
				'label' => __( 'Image', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'img_width',
			array(
				'label'      => __( 'Image Width', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 60,
					'unit' => 'px',
				),
				'range'      => array(
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-image img' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'img_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'body {{WRAPPER}} .amadeus-testimonial-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'img_border',
				'label'    => __( 'Border', 'amadeus-elementor' ),
				'selector' => '{{WRAPPER}} .amadeus-testimonial-image img',
			)
		);

		$this->add_control(
			'img_border_radius',
			array(
				'label'     => __( 'Border Radius', 'amadeus-elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_details',
			array(
				'label' => __( 'Details', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_heading',
			array(
				'label' => __( 'Name', 'amadeus-elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .amadeus-testimonial-name',
			)
		);

		$this->add_control(
			'company_heading',
			array(
				'label'     => __( 'Company', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'company_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-company' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'company_typography',
				'selector' => '{{WRAPPER}} .amadeus-testimonial-company',
			)
		);

		$this->add_control(
			'rating_heading',
			array(
				'label'     => __( 'Rating', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'rating_spacing',
			array(
				'label'      => __( 'Spacing', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-rating li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .amadeus-testimonial-rating li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				),
			)
		);

		$this->add_responsive_control(
			'rating_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			array(
				'label' => __( 'Pagination', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'dots_size',
			array(
				'label'     => __( 'Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array( 'size' => 8 ),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-carousel .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_active_color',
			array(
				'label'     => __( 'Active Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-carousel .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'dots_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-testimonial-carousel .swiper-pagination-bullet' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function testimonial_meta( $item ) {
		$settings     = $this->get_settings_for_display();
		$style        = $settings['testimonial_style'];
		$img_position = $settings['testimonial_image_position'];
		$has_content  = ! ! $item['testimonial_content'];
		$has_image    = ! ! $item['testimonial_image']['url'];
		$has_name     = ! ! $item['testimonial_name'];
		$has_company  = ! ! $item['testimonial_company'];
		$has_rating   = $item['testimonial_rating'];

		$this->add_render_attribute( 'meta', 'class', 'amadeus-testimonial-meta' );

		if ( $item['testimonial_image']['url'] ) {
			$this->add_render_attribute( 'meta', 'class', 'amadeus-has-image' );
		}

		if ( $img_position && 'inline' !== $style ) {
			$this->add_render_attribute( 'meta', 'class', 'amadeus-testimonial-image-position-' . $img_position );
		}

		if ( $has_rating ) {
			$this->add_render_attribute(
				'rating',
				array(
					'class' => array(
						'amadeus-testimonial-rating',
						$item['testimonial_rating_number'],
					),
				)
			);
		}

		$html    = '<div ' . $this->get_render_attribute_string( 'meta' ) . '>';
		$html   .= '<div class="amadeus-testimonial-meta-inner">';
		if ( $has_image && 'inline' !== $style ) {
			$html .= '<div class="amadeus-testimonial-image">';
			$image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_image' );
			if ( ! empty( $item['link']['url'] ) ) {
				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			}
			$html .= wp_kses_post( $image_html );
			$html .= '</div>';
		}

		if ( $has_name || $has_company ) {

			$html .= '<div class="amadeus-testimonial-details">';
			if ( $has_name ) {
				$this->add_render_attribute( 'testimonial_name', 'class', 'amadeus-testimonial-name' );

				$html .= '<div ' . $this->get_render_attribute_string( 'testimonial_name' ) . '>' . $item['testimonial_name'] . '</div>';

			}

			if ( $has_company ) {

				$this->add_render_attribute( 'testimonial_company', 'class', 'amadeus-testimonial-company' );

				$html .= '<div ' . $this->get_render_attribute_string( 'testimonial_company' ) . '>' . $item['testimonial_company'] . '</div>';

			}

			if ( 'yes' === $has_rating ) {
				$html .= '<ul ' . $this->get_render_attribute_string( 'rating' ) . '>';
				$html .= '<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>';
				$html .= '<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>';
				$html .= '<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>';
				$html .= '<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>';
				$html .= '<li><svg viewBox="0 -10 511.99143 511" xmlns="http://www.w3.org/2000/svg"><path d="m510.652344 185.882812c-3.371094-10.367187-12.566406-17.707031-23.402344-18.6875l-147.796875-13.417968-58.410156-136.75c-4.3125-10.046875-14.125-16.53125-25.046875-16.53125s-20.738282 6.484375-25.023438 16.53125l-58.410156 136.75-147.820312 13.417968c-10.835938 1-20.011719 8.339844-23.402344 18.6875-3.371094 10.367188-.257813 21.738282 7.9375 28.925782l111.722656 97.964844-32.941406 145.085937c-2.410156 10.667969 1.730468 21.699219 10.582031 28.097656 4.757813 3.457031 10.347656 5.183594 15.957031 5.183594 4.820313 0 9.644532-1.28125 13.953125-3.859375l127.445313-76.203125 127.421875 76.203125c9.347656 5.585938 21.101562 5.074219 29.933593-1.324219 8.851563-6.398437 12.992188-17.429687 10.582032-28.097656l-32.941406-145.085937 111.722656-97.964844c8.191406-7.1875 11.308594-18.535156 7.9375-28.925782zm-252.203125 223.722657"/></svg></li>';
				$html .= '</ul>';
			}

			$html .= '</div>';

		}

			$html .= '</div>';

		$html .= '</div>';

		return $html;
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$style      = $settings['testimonial_style'];
		$align      = $settings['testimonial_alignment'];
		$img_align  = $settings['testimonial_inline_image_position'];
		$has_symbol = $settings['testimonial_symbol'];

		$this->add_render_attribute( 'wrapper', 'class', 'amadeus-testimonial-wrapper amadeus-carousel-container' );

		if ( $align ) {
			$this->add_render_attribute( 'wrapper', 'class', 'amadeus-testimonial-text-align-' . $align );
		}

		if ( $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'amadeus-testimonial-' . $style );
		}

		if ( 'inline' === $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'amadeus-testimonial-image-' . $img_align );
		}

		// Data settings
		$this->add_render_attribute( 'wrapper', 'class', 'swiper-container' );

		if ( 'yes' === $settings['dots'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'has-dots' );
		}

		$carousel_settings = array();

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

		$this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

		<div class="amadeus-testimonial-carousel swiper-container-wrap">

			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

				<div class="swiper-wrapper">

					<?php
					$i = 0;
					foreach ( $settings['testimonial_slider'] as $item ) :
						$has_content = ! ! $item['testimonial_content'];
						$has_image   = ! ! $item['testimonial_image']['url'];
						$has_name    = ! ! $item['testimonial_name'];
						$has_company = ! ! $item['testimonial_company'];
						$has_rating  = $item['testimonial_rating'];
						?>

						<div class="swiper-slide">

							<?php
							if ( $has_image && 'inline' == $style && 'before' === $img_align ) {
								?>
								<div class="amadeus-testimonial-image">
									<?php
									$image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_image' );
									if ( ! empty( $settings['link']['url'] ) ) {
										$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
									}
									echo wp_kses_post( $image_html ); ?>
								</div>
								<?php
							}

							if ( 'yes' === $has_symbol &&
								( 'inline' !== $style || 'inline' === $style && 'after' === $img_align ) ) {
								?>
								<div class="amadeus-testimonial-symbol">
									<div class="amadeus-testimonial-symbol-inner">
										<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
									</div>
								</div>
								<?php
							}

							if ( $has_content ) {
								$this->add_render_attribute( 'testimonial_content_wrapper', 'class', 'amadeus-testimonial-content' );
								$this->add_render_attribute( 'testimonial_content', 'class', 'amadeus-testimonial-content-inner' );
								?>

								<div <?php $this->print_render_attribute_string( 'testimonial_content_wrapper' ); ?>>
									<div <?php $this->print_render_attribute_string( 'testimonial_content' ); ?>>
										<?php $this->print_text_editor( $item['testimonial_content'] ); ?>
									</div>

									<?php
									if ( 'inline' === $style && ( $has_image || $has_name || $has_company ) ) {
										echo $this->testimonial_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									}
									?>
								</div>
								<?php
							}

							if ( 'inline' !== $style && ( $has_image || $has_name || $has_company ) ) {
								echo $this->testimonial_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}

							if ( 'yes' === $has_symbol && 'inline' === $style && 'before' === $img_align ) {
								?>
								<div class="amadeus-testimonial-symbol">
									<div class="amadeus-testimonial-symbol-inner">
										<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
									</div>
								</div>
								<?php
							}

							if ( $has_image && 'inline' === $style && 'after' === $img_align ) {
								?>
								<div class="amadeus-testimonial-image">
									<?php
									$image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_image' );
									if ( ! empty( $settings['link']['url'] ) ) {
										$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
									}
									echo wp_kses_post( $image_html ); ?>
								</div>
								<?php
							}
							?>

						</div>

						<?php
						$i++;
					endforeach;
					?>

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
