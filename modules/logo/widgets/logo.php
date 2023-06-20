<?php
namespace AmadeusElementor\Modules\Logo\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Logo extends Widget_Base {

	public function get_name() {
		return 'amadeus-logo';
	}

	public function get_title() {
		return __( 'Logo', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-eye';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'logo',
			'header',
			'site',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-logo' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_logo',
			[
				'label'         => __( 'Logo', 'amadeus-elementor' ),
			]
		);

		$this->add_control( 'warning_text', [
			'type'              => Controls_Manager::RAW_HTML,
			'raw'               => __( 'The Logo need to be set on your theme customizer settings.', 'amadeus-elementor' ),
		] );

		$this->add_control(
			'logo_link',
			[
				'label'         => __( 'Logo Link', 'amadeus-elementor' ),
				'description'   => __( 'Default link is your site url', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'schema',
			[
				'label'         => __( 'Add Schema Markup', 'amadeus-elementor' ),
				'description'   => __( 'Schema Markup helps search engines better understand your content, recommended to enable it.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'tagline',
			[
				'label'         => __( 'Add Tagline', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'no',
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'placeholder'   => __( 'Enter your logo tagline', 'amadeus-elementor' ),
				'rows'          => 10,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_tag',
			[
				'label'         => __( 'Description Tag', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'h2',
				'options'       => [
					'h1'     => __( 'H1', 'amadeus-elementor' ),
					'h2'     => __( 'H2', 'amadeus-elementor' ),
					'h3'     => __( 'H3', 'amadeus-elementor' ),
					'h4'     => __( 'H4', 'amadeus-elementor' ),
					'h5'     => __( 'H5', 'amadeus-elementor' ),
					'h6'     => __( 'H6', 'amadeus-elementor' ),
					'div'    => __( 'div', 'amadeus-elementor' ),
					'span'   => __( 'span', 'amadeus-elementor' ),
					'p'      => __( 'p', 'amadeus-elementor' ),
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Logo', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'         => __( 'Max Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => 10,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-logo img' => 'max-width: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'max_height',
			[
				'label'         => __( 'Max Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => 10,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-logo img' => 'max-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'    => [
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
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'selector'      => '{{WRAPPER}} .amadeus-logo img',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-logo img',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'placeholder'   => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_logo',
			[
				'label'         => __( 'Logo: Hover', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'opacity',
			[
				'label'         => __( 'Opacity', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-logo a:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'hover_border',
				'selector'      => '{{WRAPPER}} .amadeus-logo a:hover img',
			]
		);

		$this->add_control(
			'hover_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo a:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'hover_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-logo a:hover img',
			]
		);

		$this->add_responsive_control(
			'hover_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo a:hover img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_bg',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo-description' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo-description' => 'color: {{VALUE}}',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'desc_typography',
				'selector'      => '{{WRAPPER}} .amadeus-logo-description',
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'desc_border',
				'selector'      => '{{WRAPPER}} .amadeus-logo-description',
			]
		);

		$this->add_control(
			'desc_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'desc_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-logo-description',
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'placeholder'   => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-logo-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'tagline' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get logo.
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		// Description.
		$tag = $settings['desc_tag'];

		$this->add_render_attribute( 'wrapper', 'class', 'amadeus-logo' );

		// Schema markup
		if ( 'yes' === $settings['schema'] ) {
			$this->add_render_attribute( 'wrapper', [
				'itemscope' => '',
				'itemtype' => 'https://schema.org/Brand',
			] );
		}

		// Logo URL
		if ( ! empty( $settings['logo_link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['logo_link'] );
		} else {
			$this->add_render_attribute( 'link', 'href', esc_url( home_url( '/' ) ) );
			$this->add_render_attribute( 'link', 'rel', 'home' );
		}

		// Description
		$this->add_render_attribute( 'description', 'class', 'amadeus-logo-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' ); ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<div class="amadeus-logo-inner">
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<?php
					if ( function_exists( 'the_custom_logo' ) && $custom_logo_id ) {
						$logo_url = wp_get_attachment_image_src( $custom_logo_id, 'full' )[0];
						?>
						<img src="<?php echo esc_url( $logo_url ); ?>" />
						<?php
					} else {
						echo esc_html( get_bloginfo( 'name' ) );
					}
					?>
				</a>
			</div>

			<?php
			// Site description.
			if ( 'yes' === $settings['tagline']
				&& ! empty( $settings['description'] ) ) { ?>
				<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'description' ); ?>>
				<?php $this->print_unescaped_setting( 'description' ); ?>
				</<?php echo esc_attr( $tag ); ?>>
				<?php
			} ?>

		</div>
		<?php
	}

}
