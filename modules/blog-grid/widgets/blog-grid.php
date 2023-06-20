<?php
namespace AmadeusElementor\Modules\BlogGrid\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Blog_Grid extends Widget_Base {

	public function get_name() {
		return 'amadeus-blog-grid';
	}

	public function get_title() {
		return __( 'Blog Grid', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-newsletters';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'post',
			'blog post',
			'blog',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-blog-grid' );
	}

	public function get_style_depends() {
		return array( 'amadeus-blog-grid' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_blog_grid',
			array(
				'label' => __( 'Blog Grid', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'count',
			array(
				'label'       => __( 'Post Per Page', 'amadeus-elementor' ),
				'description' => __( 'You can enter "-1" to display all posts.', 'amadeus-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'selectors' => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-entry' => 'width: calc(100% / {{VALUE}});',
				],
			)
		);

		$this->add_responsive_control(
			'grid_position',
			array(
				'label'       => __( 'Grid Position', 'amadeus-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'amadeus-grid-%s-image-',
				'default'     => 'center',
			)
		);

		$this->add_control(
			'heading_image',
			[
				'type'          => Controls_Manager::HEADING,
				'label'         => __( 'Image', 'amadeus-elementor' ),
				'condition'     => [
					'grid_position!' => 'center',
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
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-media' => 'min-width: {{SIZE}}{{UNIT}}; -ms-flex: 0 0 {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'grid_position!' => 'center',
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
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-media img' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition'     => [
					'grid_position!' => 'center',
				],
			]
		);

		$this->add_control(
			'grid_equal_heights',
			array(
				'label'     => __( 'Equal Heights', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
			)
		);

		$this->add_control(
			'pagination',
			array(
				'label'   => __( 'Pagination', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'pagination_position',
			array(
				'label'       => __( 'Pagination Position', 'amadeus-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .amadeus-pagination ul' => 'text-align: {{VALUE}};',
				),
				'default'     => 'center',
				'condition'   => array(
					'pagination' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'post_type',
			array(
				'label'   => __( 'Source', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => amadeus_get_available_post_types(),
			)
		);

		$this->add_control(
			'authors',
			array(
				'label'       => __( 'Author', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => amadeus_get_authors_list(),
				'multiple'    => true,
				'post_type'   => '',
			)
		);

		$post_types = amadeus_get_available_post_types();
		$post_types['by_id'] = __( 'Manual Selection', 'amadeus-elementor' );

		$taxonomies = get_taxonomies( [], 'objects' );

		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) || ! in_array( $object->object_type[0], array_keys( $post_types ) ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				[
					'label' => $object->label,
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
					'object_type' => $taxonomy,
					'condition' => [
						'post_type' => $object->object_type,
					],
				]
			);
		}

		$this->add_control(
			'post__not_in',
			array(
				'label'       => __( 'Exclude', 'amadeus-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => amadeus_get_post_list(),
				'multiple'    => true,
				'post_type'   => '',
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => __( 'Default', 'amadeus-elementor' ),
					'DESC' => __( 'DESC', 'amadeus-elementor' ),
					'ASC'  => __( 'ASC', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => amadeus_get_orderby_options(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_elements',
			array(
				'label' => __( 'Elements', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'image_size',
			array(
				'label'   => __( 'Image Size', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => amadeus_get_img_sizes(),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => __( 'Display Title', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'amadeus-elementor' ),
				'label_off' => __( 'Hide', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'meta',
			[
				'label'        => __( 'Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'author',
			[
				'label'        => __( 'Author Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'date',
			[
				'label'        => __( 'Date Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'cat',
			[
				'label'        => __( 'Categories Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'comments',
			[
				'label'        => __( 'Comments Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'tags',
			[
				'label'        => __( 'Tags Meta', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'amadeus-elementor' ),
				'label_off'    => __( 'No', 'amadeus-elementor' ),
				'return_value' => 'yes',
				'condition'     => [
					'meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt',
			array(
				'label'     => __( 'Display Excerpt', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Yes', 'amadeus-elementor' ),
				'label_off' => __( 'No', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'excerpt_length',
			array(
				'label'   => __( 'Excerpt Length', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '15',
				'condition'     => [
					'excerpt' => 'yes',
				],
			)
		);

		$this->add_control(
			'readmore',
			array(
				'label'     => __( 'Display Read More', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Yes', 'amadeus-elementor' ),
				'label_off' => __( 'No', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'readmore_text',
			array(
				'label'       => __( 'Read More Text', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'amadeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'condition'     => [
					'readmore' => 'yes',
				],
			)
		);

		$this->add_control(
			'no_posts_text',
			array(
				'label'       => __( 'No Posts Text', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'amadeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item',
			array(
				'label' => __( 'Item', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'item_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-inner',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-inner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_thumbnail',
			array(
				'label' => __( 'Thumbnail', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'overlay_background_color',
			array(
				'label'     => __( 'Overlay Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-media .amadeus-overlay' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tab();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			array(
				'label' => __( 'Title', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-details .amadeus-grid-title',
			)
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'title_text_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-details .amadeus-grid-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-details .amadeus-grid-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta',
			array(
				'label' => __( 'Meta', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typo',
				'selector' => '{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-meta',
			)
		);

		$this->add_control(
			'meta_icons_color',
			[
				'label'         => __( 'Icons Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-meta li svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_meta_style' );

		$this->start_controls_tab(
			'tab_meta_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-meta, {{WRAPPER}} .amadeus-blog-grid .amadeus-grid-meta li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_meta_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-meta li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt',
			array(
				'label' => __( 'Excerpt', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerpt_typo',
				'selector' => '{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-details .amadeus-grid-excerpt',
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-blog-grid .amadeus-grid-details .amadeus-grid-excerpt' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-blog-grid .readmore-btn a',
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
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-blog-grid .readmore-btn a',
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
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-blog-grid .readmore-btn a',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-blog-grid .readmore-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			array(
				'label' => __( 'Pagination', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => array(
					'pagination' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_pagination_style' );

		$this->start_controls_tab(
			'tab_pagination_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'pagination_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_active',
			[
				'label'         => __( 'Active', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'pagination_active_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_active_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'pagination_background_hover_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers:hover, {{WRAPPER}} .amadeus-pagination ul li .page-numbers.current:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers:hover, {{WRAPPER}} .amadeus-pagination ul li .page-numbers.current:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-pagination ul li .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'pagination_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-pagination ul li .page-numbers',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Vars
		$post_type      = $settings['post_type'];
		$post_type      = $post_type ? $post_type : 'post';
		$posts_per_page = $settings['count'];
		$authors        = $settings['authors'];
		$exclude        = $settings['post__not_in'];
		$order          = $settings['order'];
		$orderby        = $settings['orderby'];
		$pagination     = $settings['pagination'];

		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'order'          => $order,
			'orderby'        => $orderby,
		);

		$page = get_query_var( 'paged', 1 );

		if ( 1 < $page ) {
			$args['paged'] = $page;
		}

		if ( 'by_id' === $settings['post_type'] ) {
			$args['post_type'] = 'any';
			$args['post__in'] = $settings['posts_ids'];

			if ( empty( $settings['posts_ids'] ) ) {
				// If no selection - return an empty query
				$args['post__in'] = [ 0 ];
			}
		} else {
			$args['post_type'] = $settings['post_type'];
			$args['tax_query'] = [];

			$taxonomies = get_object_taxonomies( $settings['post_type'], 'objects' );

			foreach ( $taxonomies as $object ) {
				$setting_key = $object->name . '_ids';

				if ( ! empty( $settings[ $setting_key ] ) ) {
					$args['tax_query'][] = [
						'taxonomy' => $object->name,
						'field' => 'term_id',
						'terms' => $settings[ $setting_key ],
					];
				}
			}

			if ( ! empty( $args['tax_query'] ) ) {
				$args['tax_query']['relation'] = 'AND';
			}
		}

		// Authors
		if ( ! empty( $authors ) ) {
			$args['author__in'] = $authors;
		}

		// Exclude
		if ( ! empty( $exclude ) ) {
			$args['post__not_in'] = $exclude;
		}

		// Build the WordPress query
		$amadeus_query = new \WP_Query( $args );

		// Output posts
		if ( $amadeus_query->have_posts() ) :

			// Vars
			$equal_heights  = $settings['grid_equal_heights'];
			$title          = $settings['title'];
			$meta           = $settings['meta'];
			$excerpt        = $settings['excerpt'];
			$author         = $settings['author'];
			$date         	= $settings['date'];
			$cat            = $settings['cat'];
			$comments       = $settings['comments'];
			$tags       	= $settings['tags'];
			$readmore       = $settings['readmore'];
			$readmoretext   = $settings['readmore_text'];

			// Image size
			$img_size = $settings['image_size'];
			$img_size = $img_size ? $img_size : 'medium';

			// Wrapper classes
			$wrap_classes    = array( 'amadeus-blog-grid' );

			if ( 'yes' === $equal_heights ) {
				$wrap_classes[] = 'match-height-grid';
			}

			if ( 'yes' === $author ) {
				$wrap_classes[] = 'has-avatar';
			}

			$wrap_classes    = implode( ' ', $wrap_classes ); ?>

			<div class="<?php echo esc_attr( $wrap_classes ); ?>">

				<?php
				// Start loop
				while ( $amadeus_query->have_posts() ) :
					$amadeus_query->the_post();

					// Inner classes
					$inner_classes = array( 'amadeus-grid-entry' );

					$inner_classes = implode( ' ', $inner_classes );

					// If equal heights
					$details_class = '';
					if ( 'yes' === $equal_heights ) {
						$details_class = ' match-height-content';
					}

					// Create new post object.
					$post = new \stdClass();

					// Get post data
					$get_post = get_post();

					// Post Data
					$post->ID        = $get_post->ID;
					$post->permalink = get_the_permalink( $post->ID );
					$post->title     = $get_post->post_title;

					// Only display carousel item if there is content to show
					if ( has_post_thumbnail()
						|| 'yes' === $title
						|| 'yes' === $excerpt
					) {
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $inner_classes ); ?>>

							<?php
							// Open details if the elements are yes
							if ( 'yes' === $title
								|| 'yes' === $excerpt
							) {
								?>

								<div class="amadeus-grid-inner">

									<?php

									if ( has_post_thumbnail() ) { ?>

										<div class="amadeus-grid-media">

											<a href="<?php echo esc_url( $post->permalink ); ?>" title="<?php the_title(); ?>" class="amadeus-grid-img">

												<?php
												// Display post thumbnail
												the_post_thumbnail(
													$img_size,
													array(
														'alt' => get_the_title(),
														'itemprop' => 'image',
													)
												); ?>

												<span class="amadeus-overlay"></span>

											</a>

										</div><!-- .amadeus-grid-media -->

									<?php } ?>

									<?php
									// Open details element if the title or excerpt are yes
									if ( 'yes' === $title
										|| 'yes' === $meta
										|| 'yes' === $excerpt
									) {
										?>

										<div class="amadeus-grid-details<?php echo esc_attr( $details_class ); ?>">

											<?php
											// Display title if $title is yes and there is a post title
											if ( 'yes' === $title ) {
												?>

												<h2 class="amadeus-grid-title">
													<a href="<?php echo esc_url( $post->permalink ); ?>" title="<?php the_title(); ?>"><?php echo esc_html( $post->title ); ?></a>
												</h2>

											<?php } ?>

											<?php
											// Display meta
											if ( 'yes' === $meta ) { ?>

												<ul class="amadeus-grid-meta">
													<?php
													if ( 'yes' === $author ) { ?>
														<li class="amadeus-meta-author" itemprop="name">
															<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M256,288.389c-153.837,0-238.56,72.776-238.56,204.925c0,10.321,8.365,18.686,18.686,18.686h439.747 c10.321,0,18.686-8.365,18.686-18.686C494.56,361.172,409.837,288.389,256,288.389z M55.492,474.628 c7.35-98.806,74.713-148.866,200.508-148.866s193.159,50.06,200.515,148.866H55.492z"/><path d="M256,0c-70.665,0-123.951,54.358-123.951,126.437c0,74.19,55.604,134.54,123.951,134.54s123.951-60.35,123.951-134.534 C379.951,54.358,326.665,0,256,0z M256,223.611c-47.743,0-86.579-43.589-86.579-97.168c0-51.611,36.413-89.071,86.579-89.071 c49.363,0,86.579,38.288,86.579,89.071C342.579,180.022,303.743,223.611,256,223.611z"/></svg>
															<?php echo esc_attr( the_author_posts_link() ); ?>
														</li>
														<?php
													}

													if ( 'yes' === $date ) { ?>
														<li class="amadeus-meta-date" itemprop="datePublished" pubdate>
															<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M256,0C114.845,0,0,114.839,0,256s114.845,256,256,256c141.161,0,256-114.839,256-256S397.155,0,256,0z M256,474.628 C135.45,474.628,37.372,376.55,37.372,256S135.45,37.372,256,37.372s218.628,98.077,218.628,218.622 C474.628,376.55,376.55,474.628,256,474.628z"/><path d="M343.202,256h-80.973V143.883c0-10.321-8.365-18.686-18.686-18.686s-18.686,8.365-18.686,18.686v130.803 c0,10.321,8.365,18.686,18.686,18.686h99.659c10.321,0,18.686-8.365,18.686-18.686S353.523,256,343.202,256z"/></svg>
															<?php echo esc_attr( get_the_date( 'M j, Y' ) ); ?>
														</li>
														<?php
													}

													if ( 'yes' === $cat ) { ?>
														<li class="amadeus-meta-cat">
															<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M480,105.6H244.909L182.08,41.011c-3.616-3.712-8.576-5.811-13.76-5.811H32c-17.645,0-32,14.355-32,32v377.6 c0,17.645,14.355,32,32,32h448c17.645,0,32-14.355,32-32V137.6C512,119.955,497.645,105.6,480,105.6z M473.6,438.4H38.4V73.6 h121.811l62.829,64.589c3.616,3.712,8.576,5.811,13.76,5.811h236.8V438.4z"/></svg>
															<?php the_category( ' / ', get_the_ID() ); ?>
														</li>
														<?php
													}

													if ( 'yes' === $comments && comments_open() && ! post_password_required() ) { ?>
														<li class="amadeus-meta-comments">
															<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M345.154,160.478H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,160.478,345.154,160.478z"/><path d="M345.154,236.896H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,236.896,345.154,236.896z"/><path d="M345.154,313.313H166.846c-10.552,0-19.104,8.552-19.104,19.104s8.552,19.104,19.104,19.104h178.308 c10.552,0,19.104-8.552,19.104-19.104S355.706,313.313,345.154,313.313z"/><path d="M256,0C117.302,0,4.458,112.844,4.458,251.542c0,31.516,5.795,62.351,17.251,91.708 c8.903,22.55,20.697,43.265,35.133,61.746L22.55,485.4c-2.751,6.445-1.751,13.87,2.598,19.359C28.81,509.383,34.35,512,40.119,512 c1.089,0,2.191-0.089,3.286-0.287l129.917-22.671c26.02,9.323,53.805,14.042,82.678,14.042 c138.699,0,251.542-112.844,251.542-251.542S394.699,0,256,0z M256,464.876c-26.039,0-50.945-4.496-74.023-13.367 c-3.229-1.242-6.737-1.592-10.138-0.987L71.495,468.034l25.04-58.708c2.866-6.718,1.649-14.488-3.133-20.009 c-15.143-17.474-27.307-37.693-36.12-60.026c-9.699-24.842-14.615-51.003-14.615-77.749C42.667,133.91,138.367,38.209,256,38.209 s213.333,95.701,213.333,213.333S373.633,464.876,256,464.876z"/></svg>
															<?php
															comments_popup_link(
																esc_html__( '0 Comments', 'amadeus-elementor' ),
																esc_html__( '1 Comment', 'amadeus-elementor' ),
																esc_html__( '% Comments', 'amadeus-elementor' ),
																'comments-link'
															); ?>
														</li>
														<?php
													}

													if ( 'yes' === $tags ) {
														$term_separator = apply_filters( 'amadeus_elementor_term_separator', _x( ', ', 'Used between list items, there is a space after the comma.', 'amadeus-elementor' ), 'tags' );
														$tags_list = get_the_tag_list( '', $term_separator );
		
														if ( $tags_list ) {
															echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																'amadeus_elementor_tag_list_output',
																sprintf(
																	'<li class="amadeus-meta-tags">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"><path d="M444.07,67.946H302.344c-13.613,0-26.409,5.301-36.034,14.927L65.872,283.312c-9.626,9.625-14.927,22.422-14.927,36.034 s5.301,26.409,14.927,36.034L207.596,497.1c9.934,9.934,22.984,14.9,36.033,14.9s26.099-4.967,36.033-14.902l200.44-200.44 c9.626-9.626,14.927-22.422,14.927-36.034v-141.72C495.029,90.806,472.169,67.946,444.07,67.946z M376.124,237.81 c-28.099,0-50.959-22.86-50.959-50.959s22.86-50.959,50.959-50.959s50.959,22.86,50.959,50.959S404.223,237.81,376.124,237.81z"/><path d="M410.097,0H268.371c-13.613,0-26.409,5.301-36.034,14.927L31.899,215.366c-9.626,9.625-14.927,22.422-14.927,36.034 c0,10.647,3.256,20.788,9.276,29.31c3.999-7.81,9.219-15.04,15.603-21.422L242.288,58.849 c16.041-16.041,37.369-24.876,60.056-24.876h141.724c4.942,0,9.78,0.448,14.493,1.263C451.918,14.81,432.709,0,410.097,0z"/></svg>
																	<span class="screen-reader-text">%1$s</span>
																	%2$s
																	</li> ',
																	esc_html_x( 'Tags', 'Used before tag names.', 'amadeus-elementor' ),
																	$tags_list
																)
															);
														}
													}
													?>
												</ul>

											<?php } ?>

											<?php
											// Display excerpt if $excerpt is yes
											if ( 'yes' === $excerpt ) { ?>
												<div class="amadeus-grid-excerpt">
													<?php amadeus_excerpt( $settings['excerpt_length'] ); ?>
												</div>
											<?php } ?>

											<?php
											// Display read more
											if ( 'yes' === $readmore && '' !== $readmoretext ) { ?>
												<div class="amadeus-grid-readmore readmore-btn">
													<a href="<?php echo esc_url( $post->permalink ); ?>"><?php echo esc_attr( $readmoretext ); ?></a>
												</div>
											<?php } ?>

										</div><!-- .amadeus-grid-details -->

									<?php } ?>

								</div>

							<?php } ?>

						</article>

					<?php } ?>

					<?php
					// End entry loop
				endwhile;
				?>

			</div><!-- .amadeus-blog-grid -->

			<?php
			// Display pagination if enabled
			if ( 'yes' === $pagination ) {
				amadeus_pagination( $amadeus_query );
			}

			// Reset the post data to prevent conflicts with WP globals
			wp_reset_postdata();

			// If no posts are found display message
		else :
			$no_posts_text = $settings['no_posts_text'];
			if ( '' !== $no_posts_text ) {
				?>
				<p><?php echo esc_attr( $no_posts_text ); ?></p>
				<?php
			}
			// End post check
		endif;
		?>

		<?php
	}
}
