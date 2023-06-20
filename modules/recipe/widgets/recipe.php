<?php
namespace AmadeusElementor\Modules\Recipe\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Recipe extends Widget_Base {

	public function get_name() {
		return 'amadeus-recipe';
	}

	public function get_title() {
		return __( 'Recipe', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-fork-knife';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'recipe',
			'cook',
			'cooking',
			'reviews',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-recipe' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_recipe',
			[
				'label'         => __( 'Info', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'name',
			[
				'label'         => __( 'Recipe Name', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'My amazing cook recipe', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => '',
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => __( 'I am a text block. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
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

		$this->add_control(
			'title_html_tag',
			[
				'label'         => __( 'HTML Tag', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => amadeus_get_available_tags(),
			]
		);

		$this->add_control(
			'schema',
			[
				'label'         => __( 'Schema Markup', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'meta_heading',
			[
				'label'         => __( 'Recipe Meta', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'author',
			[
				'label'         => __( 'Show Author Meta', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'date',
			[
				'label'         => __( 'Show Author Date', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_details',
			[
				'label'         => __( 'Details', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'prep_time',
			[
				'label'         => __( 'Prep Time', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => __( '10', 'amadeus-elementor' ),
				'title'         => __( 'In minutes', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'prep_icon',
			[
				'label'         => __( 'Prep Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-leaf',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'prep_time!' => '',
				],
			]
		);

		$this->add_control(
			'prep_text',
			[
				'label'         => __( 'Prep Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Prep Time', 'amadeus-elementor' ),
				'condition'     => [
					'prep_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'prep_value',
			[
				'label'         => __( 'Prep Value', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Minutes', 'amadeus-elementor' ),
				'condition'     => [
					'prep_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'cook_time',
			[
				'label'         => __( 'Cook Time', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => __( '30', 'amadeus-elementor' ),
				'title'         => __( 'In minutes', 'amadeus-elementor' ),
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'cook_icon',
			[
				'label'         => __( 'Cook Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-utensils',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'cook_time!' => '',
				],
			]
		);

		$this->add_control(
			'cook_text',
			[
				'label'         => __( 'Cook Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Cook Time', 'amadeus-elementor' ),
				'condition'     => [
					'cook_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'cook_value',
			[
				'label'         => __( 'Cook Value', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Minutes', 'amadeus-elementor' ),
				'condition'     => [
					'cook_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'total_time',
			[
				'label'         => __( 'Total Time', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => __( '40', 'amadeus-elementor' ),
				'title'         => __( 'In minutes', 'amadeus-elementor' ),
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'total_icon',
			[
				'label'         => __( 'Total Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-clock',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'total_time!' => '',
				],
			]
		);

		$this->add_control(
			'total_text',
			[
				'label'         => __( 'Total Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Total Time', 'amadeus-elementor' ),
				'condition'     => [
					'total_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'total_value',
			[
				'label'         => __( 'Total Value', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Minutes', 'amadeus-elementor' ),
				'condition'     => [
					'total_time!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'servings',
			[
				'label'         => __( 'Servings', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => __( '4', 'amadeus-elementor' ),
				'title'         => __( 'Number of people', 'amadeus-elementor' ),
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'servings_icon',
			[
				'label'         => __( 'Servings Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-users',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'servings!' => '',
				],
			]
		);

		$this->add_control(
			'servings_text',
			[
				'label'         => __( 'Servings Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Serves', 'amadeus-elementor' ),
				'condition'     => [
					'servings!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'servings_value',
			[
				'label'         => __( 'Servings Value', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'People', 'amadeus-elementor' ),
				'condition'     => [
					'servings!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'calories',
			[
				'label'         => __( 'Calories', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => __( '345', 'amadeus-elementor' ),
				'title'         => __( 'In kcal', 'amadeus-elementor' ),
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'calories_icon',
			[
				'label'         => __( 'Calories Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-bolt',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'calories!' => '',
				],
			]
		);

		$this->add_control(
			'calories_text',
			[
				'label'         => __( 'Calories Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Calories', 'amadeus-elementor' ),
				'condition'     => [
					'calories!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'calories_value',
			[
				'label'         => __( 'Calories Value', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'kcal', 'amadeus-elementor' ),
				'condition'     => [
					'calories!' => '',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ingredients',
			[
				'label'         => __( 'Ingredients', 'amadeus-elementor' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ingredient',
			[
				'name'          => 'ingredient',
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Ingredient', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'ingredients',
			[
				'label'         => '',
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'ingredient' => __( 'Ingredient #1', 'amadeus-elementor' ),
					],
					[
						'ingredient' => __( 'Ingredient #2', 'amadeus-elementor' ),
					],
					[
						'ingredient' => __( 'Ingredient #3', 'amadeus-elementor' ),
					],
					[
						'ingredient' => __( 'Ingredient #4', 'amadeus-elementor' ),
					],
				],
				'title_field'   => '{{{ ingredient }}}',
			]
		);

		$this->add_control(
			'ingredients_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-circle',
					'library'   => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instructions',
			[
				'label'         => __( 'Instructions', 'amadeus-elementor' ),
			]
		);

		$repeater->add_control(
			'instruction',
			[
				'name'          => 'instruction',
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Instruction', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'instructions',
			[
				'label'         => '',
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'instruction' => __( 'Instruction #1', 'amadeus-elementor' ),
					],
					[
						'instruction' => __( 'Instruction #2', 'amadeus-elementor' ),
					],
					[
						'instruction' => __( 'Instruction #3', 'amadeus-elementor' ),
					],
					[
						'instruction' => __( 'Instruction #4', 'amadeus-elementor' ),
					],
				],
				'title_field'   => '{{{ instruction }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_notes',
			[
				'label'         => __( 'Notes', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'notes',
			[
				'label'         => '',
				'type'          => Controls_Manager::WYSIWYG,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label'         => __( 'Box', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'box_background',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'box_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'sections_border_color',
			[
				'label'         => __( 'Sections Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-section' => 'border-top-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_title_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'content_title_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_title_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-title',
			]
		);

		$this->add_responsive_control(
			'content_title_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_desc_heading',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'content_desc_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_desc_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-description',
			]
		);

		$this->add_control(
			'content_image_heading',
			[
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'content_image_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_image_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_meta_heading',
			[
				'label'         => __( 'Meta', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'content_meta_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'content_meta_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-meta',
			]
		);

		$this->add_responsive_control(
			'content_meta_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_details_style',
			[
				'label'         => __( 'Details', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'details_background',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details',
			]
		);

		$this->add_responsive_control(
			'details_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'details_title_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'details_title_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'details_title_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-title',
			]
		);

		$this->add_control(
			'details_content_heading',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'details_content_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'details_content_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-value',
			]
		);

		$this->add_control(
			'details_icon_heading',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'details_icon_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'details_icon_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-details-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ingredients_style',
			[
				'label'         => __( 'Ingredients', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ingredients_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ingredients_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredients > h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ingredients_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredients > h3',
			]
		);

		$this->add_responsive_control(
			'ingredients_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredients > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ingredients_content_heading',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'ingredients_content_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredients-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ingredients_content_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredients-list',
			]
		);

		$this->add_responsive_control(
			'ingredients_icon_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredient i, {{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-ingredient svg' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instructions_style',
			[
				'label'         => __( 'Instructions', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'instructions_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'instructions_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-instructions > h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'instructions_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-instructions > h3',
			]
		);

		$this->add_responsive_control(
			'instructions_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-instructions > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'instructions_content_heading',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'instructions_content_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-instructions-list' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'instructions_content_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-instructions-list',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_notes_style',
			[
				'label'         => __( 'Notes', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'notes_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'notes_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-notes > h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'notes_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-notes > h3',
			]
		);

		$this->add_responsive_control(
			'notes_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-notes > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'notes_content_heading',
			[
				'label'         => __( 'Content', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'notes_content_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-notes-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'notes_content_typography',
				'selector'      => '{{WRAPPER}} .amadeus-recipe-wrap .amadeus-recipe-notes-text',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$tag        = $settings['title_html_tag'];
		$schema     = $settings['schema'];

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-recipe-wrap' );
		$this->add_render_attribute( 'header', 'class', 'amadeus-recipe-header' );

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'class', 'amadeus-recipe-image' );
			$this->add_render_attribute( 'image-tag', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image-tag', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image-tag', 'title', Control_Media::get_image_title( $settings['image'] ) );
		}

		$this->add_render_attribute( 'content', 'class', 'amadeus-recipe-header-content' );
		$this->add_render_attribute( 'name', 'class', 'amadeus-recipe-title' );
		$this->add_inline_editing_attributes( 'name', 'none' );

		$this->add_render_attribute( 'meta', 'class', 'amadeus-recipe-meta' );
		$this->add_render_attribute( 'meta-author', 'class', [
			'amadeus-recipe-meta-item',
			'amadeus-recipe-meta-author',
		] );
		$this->add_render_attribute( 'meta-date', 'class', [
			'amadeus-recipe-meta-item',
			'amadeus-recipe-meta-date',
		] );

		$this->add_render_attribute( 'description', 'class', 'amadeus-recipe-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		$this->add_render_attribute( 'details', 'class', [
			'amadeus-recipe-details',
			'amadeus-recipe-section',
		] );
		$this->add_render_attribute( 'details-list', 'class', 'amadeus-recipe-details-list' );
		$this->add_render_attribute( 'details-icon', 'class', 'amadeus-recipe-details-icon' );
		$this->add_render_attribute( 'details-content', 'class', 'amadeus-recipe-details-content' );
		$this->add_render_attribute( 'details-title', 'class', 'amadeus-recipe-details-title' );
		$this->add_render_attribute( 'details-value', 'class', 'amadeus-recipe-details-value' );

		$this->add_render_attribute( 'ingredients', 'class', [
			'amadeus-recipe-ingredients',
			'amadeus-recipe-section',
		] );
		$this->add_render_attribute( 'ingredients-list', 'class', 'amadeus-recipe-ingredients-list' );

		$this->add_render_attribute( 'instructions', 'class', [
			'amadeus-recipe-instructions',
			'amadeus-recipe-section',
		] );
		$this->add_render_attribute( 'instructions-list', 'class', 'amadeus-recipe-instructions-list' );

		$this->add_render_attribute( 'notes', 'class', [
			'amadeus-recipe-notes',
			'amadeus-recipe-section',
		] );
		$this->add_render_attribute( 'notes-text', 'class', 'amadeus-recipe-notes-text' );
		$this->add_inline_editing_attributes( 'notes-text', 'basic' );

		if ( 'yes' === $schema ) {
			$this->add_render_attribute( 'wrap', 'itemscope', '' );
			$this->add_render_attribute( 'wrap', 'itemtype', 'http://schema.org/Recipe' );
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->add_render_attribute( 'image', [
					'itemprop' => 'image',
					'itemscope' => '',
					'itemtype' => 'https://schema.org/ImageObject',
				] );
				$this->add_render_attribute( 'image-url', [
					'itemprop' => 'url',
					'itemtype' => $settings['image']['url'],
				] );
				$this->add_render_attribute( 'image-height', [
					'itemprop' => 'height',
					'content' => '',
				] );
				$this->add_render_attribute( 'image-width', [
					'itemprop' => 'width',
					'content' => '',
				] );
				$this->add_render_attribute( 'image-tag', 'itemprop', 'image' );
			}
			$this->add_render_attribute( 'name', 'itemprop', 'name' );
			$this->add_render_attribute( 'description', 'itemprop', 'description' );
			$this->add_render_attribute( 'meta-author', 'itemprop', 'author' );
			$this->add_render_attribute( 'meta-date', 'itemprop', 'datePublished' );
			$this->add_render_attribute( 'details-prep', [
				'itemprop' => 'prepTime',
				'content' => 'PT15MIN',
			] );
			$this->add_render_attribute( 'details-cook', [
				'itemprop' => 'cookTime',
				'content' => 'PT30MIN',
			] );
			$this->add_render_attribute( 'details-total', [
				'itemprop' => 'totalTime',
				'content' => 'PT45MIN',
			] );
			$this->add_render_attribute( 'details-servings', [
				'itemprop' => 'recipeYield',
			] );
			$this->add_render_attribute( 'details-calories', [
				'itemprop' => 'nutrition',
				'itemscope' => 'PT15MIN',
				'itemtype' => 'http://schema.org/NutritionInformation',
			] );
			$this->add_render_attribute( 'details-calories-item', 'itemprop', 'calories' );
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'header' ); ?>>
				<?php
				if ( ! empty( $settings['image']['url'] ) ) { ?>
					<div <?php $this->print_render_attribute_string( 'image' ); ?>>
						<img <?php $this->print_render_attribute_string( 'image-tag' ); ?> />

						<?php
						if ( ! empty( $settings['image']['url'] ) ) { ?>
							<meta <?php $this->print_render_attribute_string( 'image-url' ); ?>>
							<meta <?php $this->print_render_attribute_string( 'image-height' ); ?>>
							<meta <?php $this->print_render_attribute_string( 'image-width' ); ?>>
							<?php
						} ?>
					</div>
					<?php
				} ?>

				<div <?php $this->print_render_attribute_string( 'content' ); ?>>

					<?php
					if ( ! empty( $settings['name'] ) ) { ?>
						<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'name' ); ?>>
							<?php $this->print_unescaped_setting( 'name' ); ?>
						</<?php echo esc_attr( $tag ); ?>>
						<?php
					} ?>

					<?php
					if ( 'yes' === $settings['author']
						|| 'yes' === $settings['date'] ) { ?>
						<ul <?php $this->print_render_attribute_string( 'meta' ); ?>>
							<?php
							if ( 'yes' === $settings['author'] ) { ?>
								<li <?php $this->print_render_attribute_string( 'meta-author' ); ?>>
									<?php echo get_the_author(); ?>
								</li>
								<?php
							} ?>

							<?php
							if ( 'yes' === $settings['date'] ) { ?>
								<li <?php $this->print_render_attribute_string( 'meta-date' ); ?>>
									<?php the_time( 'F d, Y' ); ?>
								</li>
								<?php
							} ?>
						</ul>
						<?php
					} ?>

					<?php
					if ( ! empty( $settings['description'] ) ) { ?>
						<div <?php $this->print_render_attribute_string( 'description' ); ?>>
							<?php $this->print_unescaped_setting( 'description' ); ?>
						</div>
						<?php
					} ?>
				</div>
			</div>

			<div <?php $this->print_render_attribute_string( 'details' ); ?>>
				<ul <?php $this->print_render_attribute_string( 'details-list' ); ?>>
					<?php
					if ( $settings['prep_time'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'details-prep' ); ?>>
							<span <?php $this->print_render_attribute_string( 'details-icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['prep_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>

							<span <?php $this->print_render_attribute_string( 'details-content' ); ?>>
								<span <?php $this->print_render_attribute_string( 'details-title' ); ?>>
									<?php $this->print_unescaped_setting( 'prep_text' ); ?>
								</span>

								<span <?php $this->print_render_attribute_string( 'details-value' ); ?>>
									<span><?php $this->print_unescaped_setting( 'prep_time' ); ?></span> <?php $this->print_unescaped_setting( 'prep_value' ); ?>
								</span>
							</span>
						</li>
						<?php
					} ?>

					<?php
					if ( $settings['cook_time'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'details-cook' ); ?>>
							<span <?php $this->print_render_attribute_string( 'details-icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['cook_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>

							<span <?php $this->print_render_attribute_string( 'details-content' ); ?>>
								<span <?php $this->print_render_attribute_string( 'details-title' ); ?>>
									<?php $this->print_unescaped_setting( 'cook_text' ); ?>
								</span>

								<span <?php $this->print_render_attribute_string( 'details-value' ); ?>>
									<span><?php $this->print_unescaped_setting( 'cook_time' ); ?></span> <?php $this->print_unescaped_setting( 'cook_value' ); ?>
								</span>
							</span>
						</li>
						<?php
					} ?>

					<?php
					if ( $settings['total_time'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'details-total' ); ?>>
							<span <?php $this->print_render_attribute_string( 'details-icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['total_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>

							<span <?php $this->print_render_attribute_string( 'details-content' ); ?>>
								<span <?php $this->print_render_attribute_string( 'details-title' ); ?>>
									<?php $this->print_unescaped_setting( 'total_text' ); ?>
								</span>

								<span <?php $this->print_render_attribute_string( 'details-value' ); ?>>
									<span><?php $this->print_unescaped_setting( 'total_time' ); ?></span> <?php $this->print_unescaped_setting( 'total_value' ); ?>
								</span>
							</span>
						</li>
						<?php
					} ?>

					<?php
					if ( $settings['servings'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'details-servings' ); ?>>
							<span <?php $this->print_render_attribute_string( 'details-icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['servings_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>

							<span <?php $this->print_render_attribute_string( 'details-content' ); ?>>
								<span <?php $this->print_render_attribute_string( 'details-title' ); ?>>
									<?php $this->print_unescaped_setting( 'servings_text' ); ?>
								</span>

								<span <?php $this->print_render_attribute_string( 'details-value' ); ?>>
									<span><?php $this->print_unescaped_setting( 'servings' ); ?></span> <?php $this->print_unescaped_setting( 'servings_value' ); ?>
								</span>
							</span>
						</li>
						<?php
					} ?>

					<?php
					if ( $settings['calories'] ) { ?>
						<li <?php $this->print_render_attribute_string( 'details-calories' ); ?>>
							<span <?php $this->print_render_attribute_string( 'details-calories-item' ); ?>>
								<span <?php $this->print_render_attribute_string( 'details-icon' ); ?>>
									<?php Icons_Manager::render_icon( $settings['calories_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>

								<span <?php $this->print_render_attribute_string( 'details-content' ); ?>>
									<span <?php $this->print_render_attribute_string( 'details-title' ); ?>>
										<?php $this->print_unescaped_setting( 'calories_text' ); ?>
									</span>

									<span <?php $this->print_render_attribute_string( 'details-value' ); ?>>
										<span><?php $this->print_unescaped_setting( 'calories' ); ?></span> <?php $this->print_unescaped_setting( 'calories_value' ); ?>
									</span>
								</span>
							</span>
						</li>
						<?php
					} ?>
				</ul>
			</div>

			<div <?php $this->print_render_attribute_string( 'ingredients' ); ?>>
				<h3><?php esc_html_e( 'Ingredients', 'amadeus-elementor' ); ?></h3>

				<ul <?php $this->print_render_attribute_string( 'ingredients-list' ); ?>>
					<?php
					foreach ( $settings['ingredients'] as $index => $item ) :
						$ingredient_key = $this->get_repeater_setting_key( 'ingredient', 'ingredients', $index );
						$this->add_render_attribute( $ingredient_key, 'class', 'amadeus-recipe-ingredient-text' );
						$this->add_inline_editing_attributes( $ingredient_key, 'none' );

						if ( 'yes' === $schema ) {
							$this->add_render_attribute( $ingredient_key, 'itemprop', 'recipeIngredient' );
						}

						if ( $item['ingredient'] ) : ?>
							<li class="amadeus-recipe-ingredient">
								<?php
								if ( '' !== $settings['ingredients_icon'] ) { ?>
									<?php Icons_Manager::render_icon( $settings['ingredients_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									<?php
								} ?>

								<span <?php echo wp_kses_post( $this->get_render_attribute_string( $ingredient_key ) ); ?>>
									<?php echo wp_kses_post( $item['ingredient'] ); ?>
								</span>
							</li>
							<?php
						endif;
					endforeach; ?>
				</ul>
			</div>

			<div <?php $this->print_render_attribute_string( 'instructions' ); ?>>
				<h3><?php esc_html_e( 'Instructions', 'amadeus-elementor' ); ?></h3>

				<ol <?php $this->print_render_attribute_string( 'instructions-list' ); ?>>
					<?php
					foreach ( $settings['instructions'] as $index => $item ) :
						$instruction_key = $this->get_repeater_setting_key( 'instruction', 'instructions', $index );
						$this->add_render_attribute( $instruction_key, 'class', 'amadeus-recipe-instruction-text' );
						$this->add_inline_editing_attributes( $instruction_key, 'none' );

						if ( 'yes' === $schema ) {
							$this->add_render_attribute( $instruction_key, 'itemprop', 'recipeInstructions' );
						}

						if ( $item['instruction'] ) : ?>
							<li class="amadeus-recipe-instruction">
								<span <?php echo wp_kses_post( $this->get_render_attribute_string( $instruction_key ) ); ?>>
									<?php echo wp_kses_post( $item['instruction'] ); ?>
								</span>
							</li>
							<?php
						endif;
					endforeach; ?>
				</ol>
			</div>

			<?php
			if ( ! empty( $settings['notes'] ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'notes' ); ?>>
					<h3><?php esc_html_e( 'Notes', 'amadeus-elementor' ); ?></h3>

					<div <?php $this->print_render_attribute_string( 'notes-text' ); ?>>
						<?php echo wp_kses_post( $this->parse_text_editor( $settings['notes'] ) ); ?>
					</div>
				</div>
				<?php
			} ?>
		</div>
		<?php
	}

	protected function content_template() { ?>
		<#
		var i = 1,
			prepiconHTML = elementor.helpers.renderIcon( view, settings.prep_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			cookiconHTML = elementor.helpers.renderIcon( view, settings.cook_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			totaliconHTML = elementor.helpers.renderIcon( view, settings.total_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			servingsiconHTML = elementor.helpers.renderIcon( view, settings.servings_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			caloriesiconHTML = elementor.helpers.renderIcon( view, settings.calories_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			ingredientsiconHTML = elementor.helpers.renderIcon( view, settings.ingredients_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<div class="amadeus-recipe-wrap">
			<div class="amadeus-recipe-header">
				<# if ( '' != settings.image.url ) { #>
					<div class="amadeus-recipe-image">
						<img src="{{ settings.image.url }}">
					</div>
				<# } #>

				<div class="amadeus-recipe-header-content">
					<# if ( '' != settings.name ) {
						view.addRenderAttribute( 'name', 'class', 'amadeus-recipe-title' );
						view.addInlineEditingAttributes( 'name' ); #>

						<{{ settings.title_html_tag }} {{{ view.getRenderAttributeString( 'name' ) }}}>
							{{{ settings.name }}}
						</{{ settings.title_html_tag }}>
					<# } #>

					<# if ( 'yes' == settings.author || 'yes' == settings.date ) { #>
						<ul class="amadeus-recipe-meta">
							<# if ( 'yes' == settings.author ) { #>
								<li class="amadeus-recipe-meta-item amadeus-recipe-meta-author"><?php echo get_the_author(); ?></li>
							<# } #>

							<# if ( 'yes' == settings.date ) { #>
								<li class="amadeus-recipe-meta-item amadeus-recipe-meta-date"><?php the_time( 'F d, Y' ); ?></li>
							<# } #>
						</ul>
					<# } #>

					<# if ( '' != settings.description ) {
						view.addRenderAttribute( 'description', 'class', 'amadeus-recipe-description' );
						view.addInlineEditingAttributes( 'description', 'basic' ); #>

						<div {{{ view.getRenderAttributeString( 'description' ) }}}>
							{{{ settings.description }}}
						</div>
					<# } #>
				</div>
			</div>

			<div class="amadeus-recipe-details amadeus-recipe-section">
				<ul class="amadeus-recipe-details-list">
					<# if ( '' != settings.prep_time ) { #>
						<li>
							<span class="amadeus-recipe-details-icon">
								<# if ( prepiconHTML && prepiconHTML.rendered ) { #>
									{{{ prepiconHTML.value }}}
								<# } #>
							</span>

							<span class="amadeus-recipe-details-content">
								<span class="amadeus-recipe-details-title">
									{{{ settings.prep_text }}}
								</span>

								<span class="amadeus-recipe-details-value">
									<span>{{{ settings.prep_time }}}</span> {{{ settings.prep_value }}}
								</span>
							</span>
						</li>
					<# } #>

					<# if ( '' != settings.cook_time ) { #>
						<li>
							<span class="amadeus-recipe-details-icon">
								<# if ( cookiconHTML && cookiconHTML.rendered ) { #>
									{{{ cookiconHTML.value }}}
								<# } #>
							</span>

							<span class="amadeus-recipe-details-content">
								<span class="amadeus-recipe-details-title">
									{{{ settings.cook_text }}}
								</span>

								<span class="amadeus-recipe-details-value">
									<span>{{{ settings.cook_time }}}</span> {{{ settings.cook_value }}}
								</span>
							</span>
						</li>
					<# } #>

					<# if ( '' != settings.total_time ) { #>
						<li>
							<span class="amadeus-recipe-details-icon">
								<# if ( totaliconHTML && totaliconHTML.rendered ) { #>
									{{{ totaliconHTML.value }}}
								<# } #>
							</span>

							<span class="amadeus-recipe-details-content">
								<span class="amadeus-recipe-details-title">
									{{{ settings.total_text }}}
								</span>

								<span class="amadeus-recipe-details-value">
									<span>{{{ settings.total_time }}}</span> {{{ settings.total_value }}}
								</span>
							</span>
						</li>
					<# } #>

					<# if ( '' != settings.servings ) { #>
						<li>
							<span class="amadeus-recipe-details-icon">
								<# if ( servingsiconHTML && servingsiconHTML.rendered ) { #>
									{{{ servingsiconHTML.value }}}
								<# } #>
							</span>

							<span class="amadeus-recipe-details-content">
								<span class="amadeus-recipe-details-title">
									{{{ settings.servings_text }}}
								</span>

								<span class="amadeus-recipe-details-value">
									<span>{{{ settings.servings }}}</span> {{{ settings.servings_value }}}
								</span>
							</span>
						</li>
					<# } #>

					<# if ( '' != settings.calories ) { #>
						<li>
							<span class="amadeus-recipe-details-icon">
								<# if ( caloriesiconHTML && caloriesiconHTML.rendered ) { #>
									{{{ caloriesiconHTML.value }}}
								<# } #>
							</span>

							<span class="amadeus-recipe-details-content">
								<span class="amadeus-recipe-details-title">
									{{{ settings.calories_text }}}
								</span>

								<span class="amadeus-recipe-details-value">
									<span>{{{ settings.calories }}}</span> {{{ settings.calories_value }}}
								</span>
							</span>
						</li>
					<# } #>
				</ul>
			</div>

			<div class="amadeus-recipe-ingredients amadeus-recipe-section">
				<h3><?php esc_html_e( 'Ingredients', 'amadeus-elementor' ); ?></h3>

				<ul class="amadeus-recipe-ingredients-list">
					<# _.each( settings.ingredients, function( item ) { #>
						<# if ( '' != item.ingredient ) { #>
							<li class="amadeus-recipe-ingredient">
								<# if ( '' != settings.ingredients_icon ) { #>
									<# if ( ingredientsiconHTML && ingredientsiconHTML.rendered ) { #>
										{{{ ingredientsiconHTML.value }}}
									<# } #>
								<# } #>

								<#
								var ingredient = item.ingredient,
									ingredient_key = 'ingredients.' + (i - 1) + '.ingredient';

								view.addRenderAttribute( ingredient_key, 'class', 'amadeus-recipe-ingredient-text' );
								view.addInlineEditingAttributes( ingredient_key ); #>

								<span {{{ view.getRenderAttributeString( ingredient_key ) }}}>
									{{{ ingredient }}}
								</span>
							</li>
						<# } #>
					<# } ); #>
				</ul>
			</div>

			<div class="amadeus-recipe-instructions amadeus-recipe-section">
				<h3><?php esc_html_e( 'Instructions', 'amadeus-elementor' ); ?></h3>

				<ol class="amadeus-recipe-instructions-list">
					<# _.each( settings.instructions, function( item ) { #>
						<# if ( '' != item.instruction ) { #>
							<li class="amadeus-recipe-instruction">
								<#
								var instruction = item.instruction,
									instruction_key = 'instructions.' + (i - 1) + '.instruction';

								view.addRenderAttribute( instruction_key, 'class', 'amadeus-recipe-instruction-text' );
								view.addInlineEditingAttributes( instruction_key ); #>

								<span {{{ view.getRenderAttributeString( instruction_key ) }}}>
									{{{ instruction }}}
								</span>
							</li>
						<# } #>
					<# } ); #>
				</ol>
			</div>

			<# if ( '' != settings.notes ) {
				view.addRenderAttribute( 'notes-text', 'class', 'amadeus-recipe-notes-text' );
				view.addInlineEditingAttributes( 'notes-text', 'basic' ); #>

				<div class="amadeus-recipe-notes amadeus-recipe-section">
					<h3><?php esc_html_e( 'Notes', 'amadeus-elementor' ); ?></h3>

					<div {{{ view.getRenderAttributeString( 'notes-text' ) }}}>
						{{{ settings.notes }}}
					</div>
				</div>
			<# } #>
		</div>
		<?php
	}

}
