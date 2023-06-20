<?php
namespace AmadeusElementor\Modules\Banner\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Banner extends Widget_Base {

	public function get_name() {
		return 'amadeus-banner';
	}

	public function get_title() {
		return esc_html__( 'Banner', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-picture2';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'banner',
			'image',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-banner' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_banner',
			[
				'label'         => esc_html__( 'Banner', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => esc_html__( 'Animation Effect', 'amadeus-elementor' ),
				'description'   => sprintf( __( 'You can see all animations on the <a href="%s" target="_blank">demonstration page</a>.', 'amadeus-elementor' ), 'https://www.amadeus-elementor.com/widgets/banner/' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'gaia',
				'options' => [
					'gaia'      => esc_html__( 'Beethoven', 'amadeus-elementor' ),
					'poseidon'  => esc_html__( 'Bach', 'amadeus-elementor' ),
					'cronos'    => esc_html__( 'Rachmaninov', 'amadeus-elementor' ),
					'hades'     => esc_html__( 'Chopin', 'amadeus-elementor' ),
					'demeter'   => esc_html__( 'Vivaldi', 'amadeus-elementor' ),
					'apollo'    => esc_html__( 'Debussy', 'amadeus-elementor' ),
					'athena'    => esc_html__( 'Tchaikovsky', 'amadeus-elementor' ),
					'artemis'   => esc_html__( 'Haydn', 'amadeus-elementor' ),
					'ares'      => esc_html__( 'Schumann', 'amadeus-elementor' ),
					'hermes'    => esc_html__( 'Wagner', 'amadeus-elementor' ),
					'eros'      => esc_html__( 'Strauss', 'amadeus-elementor' ),
					'hera'      => esc_html__( 'Schubert', 'amadeus-elementor' ),
					'aphrodite' => esc_html__( 'Handel', 'amadeus-elementor' ),
					'amadeus'   => esc_html__( 'Mozart', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'         => esc_html__( 'Image', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'image',
				'label'         => esc_html__( 'Image Size', 'amadeus-elementor' ),
				'default'       => 'large',
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => esc_html__( 'Title', 'amadeus-elementor' ),
				'default'       => esc_html__( 'This is the title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'         => esc_html__( 'Description', 'amadeus-elementor' ),
				'default'       => esc_html__( 'Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => esc_html__( 'Link', 'amadeus-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => esc_html__( 'General', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_banner_style' );

		$this->start_controls_tab(
			'tab_banner_normal',
			[
				'label'         => esc_html__( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'banner_normal_opacity',
			[
				'label'         => esc_html__( 'Opacity', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors'     => [
					'body {{WRAPPER}} .amadeus-banner img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_banner_hover',
			[
				'label'         => esc_html__( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'banner_hover_opacity',
			[
				'label'         => esc_html__( 'Opacity', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors'     => [
					'body {{WRAPPER}} .amadeus-banner:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'          => 'banner_background',
				'selector'      => '{{WRAPPER}} .amadeus-banner',
				'separator'     => 'before',
			)
		);

		$this->add_control(
			'banner_additional_color',
			[
				'label'         => esc_html__( 'Additional Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner.amadeus-apolo .amadeus-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-bubba figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-bubba figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-chico figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-jazz figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-layla figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-layla figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-ming figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-marley .amadeus-banner-title:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-romeo figcaption:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-romeo figcaption:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-roxy figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-ruby .amadeus-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-banner.amadeus-sarah .amadeus-banner-title:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'banner_border',
				'selector'      => '{{WRAPPER}} .amadeus-banner',
			]
		);

		$this->add_responsive_control(
			'banner_padding',
			[
				'label'         => esc_html__( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_margin',
			[
				'label'         => esc_html__( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_border_radius',
			[
				'label'         => esc_html__( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'banner_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-banner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label'         => esc_html__( 'Banner Title', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner .amadeus-banner-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typo',
				'selector'      => '{{WRAPPER}} .amadeus-banner .amadeus-banner-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label'         => esc_html__( 'Banner Description', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-banner .amadeus-banner-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typo',
				'selector'      => '{{WRAPPER}} .amadeus-banner .amadeus-banner-text',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$link           = $settings['link'];
		$effect         = $settings['effect'];

		$this->add_render_attribute( 'banner', 'class', 'amadeus-banner' );
		if ( ! empty( $effect ) ) {
			$this->add_render_attribute( 'banner', 'class', 'amadeus-' . $effect );
		}

		$this->add_render_attribute( 'content', 'class', 'amadeus-banner-content' );
		$this->add_render_attribute( 'title', 'class', 'amadeus-banner-title' );
		$this->add_render_attribute( 'description', 'class', 'amadeus-banner-text' ); ?>

		<figure <?php $this->print_render_attribute_string( 'banner' ); ?>>
			<?php
			if ( ! empty( $link['url'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'amadeus-banner-link' );
				$this->add_link_attributes( 'link', $settings['link'] );
				?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php
			}
			?>
				<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>
				<figcaption>
					<div <?php $this->print_render_attribute_string( 'content' ); ?>>
						<h5 <?php $this->print_render_attribute_string( 'title' ); ?>><?php $this->print_unescaped_setting( 'title' ); ?></h5>
						<div <?php $this->print_render_attribute_string( 'description' ); ?>><?php $this->print_unescaped_setting( 'description' ); ?></div>
					</div>
				</figcaption>
			<?php if ( ! empty( $link['url'] ) ) : ?>
				</a>
			<?php endif; ?>
		</figure>
		<?php
	}

	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'banner', 'class', 'amadeus-banner' );

		if ( settings.effect ) {
			view.addRenderAttribute( 'banner', 'class', 'amadeus-' + settings.effect );
		}

		view.addRenderAttribute( 'content', 'class', 'amadeus-banner-content' );
		view.addRenderAttribute( 'title', 'class', 'amadeus-banner-title' );
		view.addRenderAttribute( 'description', 'class', 'amadeus-banner-text' );

		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		var imageUrl = elementor.imagesManager.getImageUrl( image );
		#>

		<figure {{{ view.getRenderAttributeString( 'banner' ) }}}>
			<# if ( settings.link ) { #>
				<a href="#" class="amadeus-banner-link">
			<# } #>
				<img src="{{ imageUrl }}">
				<figcaption>
					<div {{{ view.getRenderAttributeString( 'content' ) }}}>
						<h5 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h5>
						<div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
					</div>
				</figcaption>
			<# if ( settings.link ) { #>
				</a>
			<# } #>
		</figure>
		<?php
	}
}
