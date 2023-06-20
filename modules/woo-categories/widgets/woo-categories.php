<?php
namespace AmadeusElementor\Modules\WooCategories\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class WooCategories extends Widget_Base {

	public function get_name() {
		return 'amadeus-woo-categories';
	}

	public function get_title() {
		return __( 'Woo - Categories', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-cart-full';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'woo',
			'woocommerce',
			'ecommerce',
			'category',
			'categories',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return array( 'amadeus-woo-categories' );
	}

	protected function register_controls() {

		// Return if not activated
		if ( ! is_woocommerce_active() ) {

			$this->start_controls_section( 'warning', [
				'label'             => __( 'Warning!', 'amadeus-elementor' ),
			] );

			$this->add_control( 'warning_text', [
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( '<strong>WooCommerce</strong> is not installed or activated on your site. Please install and activate it first to be able to use this widget.', 'amadeus-elementor' ),
			] );

			$this->end_controls_section();

		} else {

			$this->start_controls_section(
				'section_woo_categories',
				[
					'label'         => __( 'Products', 'amadeus-elementor' ),
				]
			);

			$this->add_responsive_control(
				'columns',
				[
					'label'          => __( 'Columns', 'amadeus-elementor' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '4',
					'tablet_default' => '2',
					'mobile_default' => '1',
					'options' => array(
						'1'  => '1',
						'2'  => '2',
						'3'  => '3',
						'4'  => '4',
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
					),
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product' => 'width: calc( 100% / {{VALUE}} - 30px );',
					],
				]
			);

			$this->add_control(
				'number',
				[
					'label'         => __( 'Categories Count', 'amadeus-elementor' ),
					'type'          => Controls_Manager::NUMBER,
					'default'       => '4',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_filter',
				[
					'label'         => __( 'Query', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'source',
				[
					'label'         => _x( 'Source', 'Posts Query Control', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						''          => __( 'Show All', 'amadeus-elementor' ),
						'by_id'     => __( 'Manual Selection', 'amadeus-elementor' ),
						'by_parent' => __( 'By Parent', 'amadeus-elementor' ),
					],
				]
			);

			$categories = get_terms( 'product_cat' );

			$options = [];
			foreach ( $categories as $category ) {
				$options[ $category->term_id ] = $category->name;
			}

			$this->add_control(
				'categories',
				[
					'label'         => __( 'Categories', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT2,
					'options'       => $options,
					'default'       => [],
					'label_block'   => true,
					'multiple'      => true,
					'condition'     => [
						'source' => 'by_id',
					],
				]
			);

			$parent_options = [ '0' => __( 'Only Top Level', 'amadeus-elementor' ) ] + $options;
			$this->add_control(
				'parent',
				[
					'label'         => __( 'Parent', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => '0',
					'options'       => $parent_options,
					'condition'     => [
						'source' => 'by_parent',
					],
				]
			);

			$this->add_control(
				'hide_empty',
				[
					'label'         => __( 'Hide Empty', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'return_value'  => 'yes',
				]
			);

			$this->add_control(
				'hide_count',
				[
					'label'         => __( 'Hide Product Count', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SWITCHER,
					'return_value'  => 'yes',
					'selectors'     => [
						'{{WRAPPER}} .amadeus-woo .woocommerce .woocommerce-loop-category__title .count' => 'display: none;',
					],
				]
			);

			$this->add_control(
				'orderby',
				[
					'label'         => __( 'Order by', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'name',
					'options'       => [
						'name'        => __( 'Name', 'amadeus-elementor' ),
						'slug'        => __( 'Slug', 'amadeus-elementor' ),
						'description' => __( 'Description', 'amadeus-elementor' ),
						'count'       => __( 'Count', 'amadeus-elementor' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'         => __( 'Order', 'amadeus-elementor' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'desc',
					'options'       => [
						'asc'  => __( 'ASC', 'amadeus-elementor' ),
						'desc' => __( 'DESC', 'amadeus-elementor' ),
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_item_style',
				[
					'label'         => __( 'Item', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'item_background_color',
				[
					'label'         => __( 'Background Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'item_border',
					'placeholder'   => '1px',
					'selector'      => '{{WRAPPER}} .woocommerce ul.products li.product',
					'separator'     => 'before',
				]
			);

			$this->add_control(
				'item_border_radius',
				[
					'label'         => __( 'Border Radius', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'item_box_shadow',
					'selector'      => '{{WRAPPER}} .woocommerce ul.products li.product',
				]
			);

			$this->add_responsive_control(
				'item_padding',
				[
					'label'         => __( 'Padding', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
				]
			);

			$this->add_responsive_control(
				'item_margin',
				[
					'label'         => __( 'Margin', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_image_style',
				[
					'label'         => __( 'Image', 'amadeus-elementor' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'image_border',
					'placeholder'   => '1px',
					'selector'      => '{{WRAPPER}} .woocommerce ul.products li.product a img',
				]
			);

			$this->add_control(
				'image_border_radius',
				[
					'label'         => __( 'Border Radius', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'          => 'image_box_shadow',
					'selector'      => '{{WRAPPER}} .woocommerce ul.products li.product a img',
				]
			);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'         => __( 'Margin', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'title_typography',
					'selector'      => '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'         => esc_html__( 'Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'label'         => esc_html__( 'Hover Color', 'amadeus-elementor' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product a:hover .woocommerce-loop-category__title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'         => __( 'Margin', 'amadeus-elementor' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		// Return if not activated
		if ( ! is_woocommerce_active() ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$attributes = [
			'number'     => $settings['number'],
			'columns'    => $settings['columns'],
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? 1 : 0,
			'orderby'    => $settings['orderby'],
			'order'      => $settings['order'],
		];

		if ( 'by_id' === $settings['source'] ) {
			$attributes['ids'] = implode( ',', $settings['categories'] );
		} elseif ( 'by_parent' === $settings['source'] ) {
			$attributes['parent'] = $settings['parent'];
		}

		$this->add_render_attribute( 'shortcode', $attributes );

		echo '<div class="amadeus-woo">' . do_shortcode( '[product_categories ' . $this->get_render_attribute_string( 'shortcode' ) . ']' ) . '</div>';
	}

	public function render_plain_content() {}

}
