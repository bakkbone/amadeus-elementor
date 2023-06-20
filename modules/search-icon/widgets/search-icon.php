<?php
namespace AmadeusElementor\Modules\SearchIcon\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class SearchIcon extends Widget_Base {

	public function get_name() {
		return 'amadeus-search-icon';
	}

	public function get_title() {
		return __( 'Search Icon', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-search';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'search',
			'search icon',
			'header',
			'site',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-search-icon' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-search-icon' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_search_icon',
			[
				'label'         => __( 'Search Icon', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Search Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'dropdown',
				'options'       => [
					'dropdown'  => __( 'Drop Down', 'amadeus-elementor' ),
					'overlay'   => __( 'Overlay', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'         => __( 'Placeholder', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Search', 'amadeus-elementor' ),
				'placeholder'   => __( 'Search', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'overlay_text',
			[
				'label'         => __( 'Input Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Type your search', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => _x( 'Source', 'Posts Type', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => $this->get_post_types(),
				'default'       => 'any',
				'label_block'   => true,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'    => [
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
				'default'       => '',
				'prefix_class' => 'amadeus%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Search Icon', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'         => __( 'Font Size', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-search-icon-wrap .amadeus-search-toggle svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-icon-wrap .amadeus-search-toggle svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-icon-wrap .amadeus-search-toggle:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-icon-wrap .amadeus-search-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dropdown_style',
			[
				'label'         => esc_html__( 'Drop Down', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-search-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-dropdown' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'dropdown_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-search-dropdown',
				'separator'     => 'before',
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-search-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_style',
			[
				'label'         => esc_html__( 'Overlay', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-search-{{ID}}' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_close_style',
			[
				'label'         => esc_html__( 'Overlay Close Button', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_overlay_close_style' );

		$this->start_controls_tab(
			'tab_overlay_close_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-search-{{ID}} a.amadeus-search-overlay-close' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-search-{{ID}} a.amadeus-search-overlay-close span:before, #amadeus-search-{{ID}}  a.amadeus-search-overlay-close span:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_close_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg_hover',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-search-{{ID}} a.amadeus-search-overlay-close:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color_hover',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-search-{{ID}} a.amadeus-search-overlay-close:hover span:before, #amadeus-search-{{ID}}  a.amadeus-search-overlay-close:hover span:after' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label'         => esc_html__( 'Input', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_input_style' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input, #amadeus-search-{{ID}} form input, #amadeus-search-{{ID}} form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_hover',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_hover',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover, #amadeus-search-{{ID}} form input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:hover, #amadeus-search-{{ID}} form input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_focus',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus, #amadeus-search-{{ID}} form input:focus, #amadeus-search-{{ID}} form label:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} form input:focus, #amadeus-search-{{ID}} form input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'input_focus_box_shadow',
				'selector'      => '{{WRAPPER}} form input:focus, #amadeus-search-{{ID}} form input:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'input_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} form input, #amadeus-search-{{ID}} form input',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} form input, #amadeus-search-{{ID}} form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} form input, #amadeus-search-{{ID}} form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'input_typo',
				'selector'      => '{{WRAPPER}} form input, #amadeus-search-{{ID}} form input, #amadeus-search-{{ID}} form label',
			]
		);

		$this->end_controls_section();

	}

	private static function get_post_types( $args = [] ) {
		$post_type_args = [
			'show_in_nav_menus' => true,
		];

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
		}

		$_post_types = get_post_types( $post_type_args, 'objects' );

		$post_types  = [];
		$post_types['any']  = esc_html__( 'Any', 'amadeus-elementor' );

		foreach ( $_post_types as $post_type => $object ) {
			$post_types[ $post_type ] = $object->label;
		}

		return $post_types;
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$id         = $this->get_id();

		// Style
		$style = $settings['style'];

		$this->add_render_attribute( 'search-icon-wrap', 'class',
			[
				'amadeus-search-icon-wrap',
				'amadeus-search-icon-' . $style,
			]
		);

		$this->add_render_attribute( 'form-wrap', 'id', 'amadeus-search-' . esc_attr( $id ) );
		$this->add_render_attribute( 'form-wrap', 'class', 'amadeus-search-' . $style );

		// Link
		$this->add_render_attribute( 'link', 'href', '#' );
		$this->add_render_attribute( 'link', 'class', 'amadeus-search-toggle' );

		if ( ! empty( $style ) ) {
			$this->add_render_attribute( 'link', 'class', 'amadeus-' . $style . '-link' );
		}

		$this->add_render_attribute( 'input', 'type', 'text' );
		$this->add_render_attribute( 'input', 'class', 'field' );
		$this->add_render_attribute( 'input', 'name', 's' );

		// Placeholder
		if ( ! empty( $settings['placeholder'] ) ) {
			$this->add_render_attribute( 'input', 'placeholder', $settings['placeholder'] );
		} ?>

		<div <?php $this->print_render_attribute_string( 'search-icon-wrap' ); ?>>
			<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512"><path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5 S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9 C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"/></svg>
			</a>

			<div <?php $this->print_render_attribute_string( 'form-wrap' ); ?>>
				<?php
				if ( 'dropdown' === $style ) { ?>
					<form method="get" class="amadeus-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input <?php $this->print_render_attribute_string( 'input' ); ?>>
						<?php
						if ( ! empty( $settings['source'] ) && 'any' !== $settings['source'] ) { ?>
							<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
							<?php
						} ?>
					</form>
					<?php
				} elseif ( 'overlay' === $style ) { ?>
					<div class="container">
						<form method="get" class="amadeus-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<a href="#" class="amadeus-search-overlay-close"><span></span></a>
							<input class="amadeus-search-overlay-input" type="search" name="s" autocomplete="off" value="">
							<?php
							if ( ! empty( $settings['source'] ) && 'any' !== $settings['source'] ) { ?>
								<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
								<?php
							} ?>
							<label><?php echo esc_attr( $settings['overlay_text'] ); ?><span><i></i><i></i><i></i></span></label>
						</form>
					</div>
					<?php
				} ?>
			</div>
		</div>

		<?php
	}

	// No template because it cause a js error in the edit mode
	protected function content_template() {}

}
