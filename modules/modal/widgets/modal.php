<?php
namespace AmadeusElementor\Modules\Modal\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Modal extends Widget_Base {

	public function get_name() {
		return 'amadeus-modal';
	}

	public function get_title() {
		return __( 'Modal', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-link';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'form',
			'contact',
			'modal',
			'popup',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-modal' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-modal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_modal_button',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'text',
			[
				'label'         => __( 'Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Open Modal', 'amadeus-elementor' ),
				'condition'     => [
					'layout' => 'default',
				],
				'dynamic'       => [ 'active' => true ],
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
					'justify' => [
						'title' => __( 'Justified', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'       => '',
				'prefix_class' => 'amadeus%s-align-',
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'label_block'   => true,
				'condition'     => [
					'layout' => 'default',
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
				'condition'     => [
					'icon!' => '',
					'layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'amadeus-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'         => __( 'Icon Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 4,
				],
				'range'         => [
					'px' => [
						'max' => 50,
					],
				],
				'condition'     => [
					'icon!' => '',
					'layout' => 'default',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-modal-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal',
			[
				'label'         => __( 'Modal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'         => __( 'Layout', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'default',
				'options'       => [
					'default'   => __( 'Default', 'amadeus-elementor' ),
					'timer'     => __( 'Timer Popup', 'amadeus-elementor' ),
					'exit'      => __( 'Exit-Intent', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'cookie',
			[
				'label'         => __( 'Add Cookie', 'amadeus-elementor' ),
				'description'   => __( 'Add a cookie to display the modal only once.', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
					'layout' => [ 'timer', 'exit' ],
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'default',
				'options'       => [
					'default'   => __( 'Default', 'amadeus-elementor' ),
					'full'      => __( 'Full Screen', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'display_after',
			[
				'label'         => __( 'Display After (s)', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 10,
				],
				'range'         => [
					'px' => [
						'min' => 1,
						'max' => 60,
					],
				],
				'condition'     => [
					'layout' => 'timer',
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label'         => __( 'Source', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'content',
				'options'       => [
					'content'   => __( 'Content', 'amadeus-elementor' ),
					'template'  => __( 'Template', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'         => '',
				'type'          => Controls_Manager::WYSIWYG,
				'default'       => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
				'condition'     => [
					'source' => 'content',
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'templates',
			[
				'label'         => __( 'Choose Template', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '0',
				'options'       => amadeus_get_available_templates(),
				'condition'     => [
					'source' => 'template',
				],
			]
		);

		$this->add_responsive_control(
			'content_align',
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
				'condition'     => [
					'source' => 'content',
				],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner' => 'text-align: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'modal_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'modal_close_button',
			[
				'label'         => __( 'Close Button', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'inside',
				'options'       => [
					'inside'    => __( 'Inside', 'amadeus-elementor' ),
					'outside'   => __( 'Outside', 'amadeus-elementor' ),
					'none'      => __( 'None', 'amadeus-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'modal_button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-modal-button a',
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_modal_button_style' );

		$this->start_controls_tab(
			'tab_modal_button_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_modal_button_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_hover_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a:hover' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a:hover' => 'border-color: {{VALUE}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'modal_button_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-modal-button a',
				'separator'     => 'before',
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'modal_button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'modal_button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-modal-button a',
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'modal_button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'modal_button_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-modal-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'layout' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_style',
			[
				'label'         => __( 'Modal', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'modal_typography',
				'selector'      => '#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'modal_background_color',
				'selector'      => '#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner',
			]
		);

		$this->add_control(
			'modal_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'modal_link_color',
			[
				'label'         => __( 'Link Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'modal_link_hover_color',
			[
				'label'         => __( 'Link Hover Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'modal_border',
				'placeholder'   => '1px',
				'default'       => '1px',
				'selector'      => '#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'modal_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'modal_box_shadow',
				'selector'      => '#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner',
			]
		);

		$this->add_responsive_control(
			'modal_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'modal_close_btn_heading',
			[
				'label'         => __( 'Close Button', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
				'condition'     => [
					'modal_close_button!' => 'none',
				],
			]
		);

		$this->add_control(
			'modal_close_btn_color',
			[
				'label'         => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'modal_close_button!' => 'none',
				],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-close svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'modal_close_btn_hover_color',
			[
				'label'         => esc_html__( 'Hover Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'condition'     => [
					'modal_close_button!' => 'none',
				],
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-close:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'modal_overlay_heading',
			[
				'label'         => __( 'Overlay', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'modal_overlay_background_color',
			[
				'label'         => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'#amadeus-modal-{{ID}}.amadeus-modal-wrap .amadeus-modal-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$id         = $this->get_id();
		$style      = $settings['style'];
		$source     = $settings['source'];
		$close      = $settings['modal_close_button'];

		$this->add_render_attribute( 'button-wrap', 'class', 'amadeus-modal-button' );

		$this->add_render_attribute( 'button', 'href', '#amadeus-modal-' . esc_attr( $id ) );
		$this->add_render_attribute( 'button', 'class',
			[
				'button',
				'elementor-button',
			]
		);

		$this->add_render_attribute( 'icon-align', 'class', [
			'amadeus-button-icon',
			'elementor-align-icon-' . $settings['icon_align'],
		] );

		$this->add_render_attribute( 'modal', 'id', 'amadeus-modal-' . esc_attr( $id ) );
		$this->add_render_attribute( 'modal', 'class', 'amadeus-modal-wrap' );

		if ( 'full' === $style ) {
			$this->add_render_attribute( 'modal', 'class', 'amadeus-modal-full' );
		}

		if ( 'template' === $source ) {
			$this->add_render_attribute( 'modal', 'class', 'has-template' );
		}

		$this->add_render_attribute( 'modal-container', 'class', 'amadeus-modal-container' );
		$this->add_render_attribute( 'modal-inner', 'class', 'amadeus-modal-inner' );

		$this->add_render_attribute( 'modal-overlay', 'class', 'amadeus-modal-overlay' );

		if ( 'default' === $settings['layout'] ) { ?>

			<div <?php $this->print_render_attribute_string( 'button-wrap' ); ?>>
				<a <?php $this->print_render_attribute_string( 'button' ); ?>>
					<?php
					if ( ! empty( $settings['icon'] ) && 'left' === $settings['icon_align'] ) { ?>
						<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
						<?php
					} ?>

					<span><?php echo esc_attr( $settings['text'] ); ?></span>

					<?php
					if ( ! empty( $settings['icon'] ) && 'right' === $settings['icon_align'] ) { ?>
						<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
						<?php
					} ?>
				</a>
			</div>

		<?php } ?>

		<div <?php $this->print_render_attribute_string( 'modal' ); ?>>
			<?php
			if ( 'outside' === $close ) {
				$this->close_btn();
			} ?>
			<div <?php $this->print_render_attribute_string( 'modal-container' ); ?>>
				<div <?php $this->print_render_attribute_string( 'modal-inner' ); ?>>
					<?php
					if ( 'inside' === $close ) {
						$this->close_btn();
					} ?>

					<?php
					if ( ! empty( $source ) ) {
						if ( 'content' === $source
							&& ! empty( $settings['content'] ) ) {
							echo do_shortcode( $settings['content'] );
						} elseif ( 'template' === $source
							&& ( '0' !== $settings['templates'] && ! empty( $settings['templates'] ) ) ) {
							echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					} ?>
				</div>
			</div>
			<div <?php $this->print_render_attribute_string( 'modal-overlay' ); ?>></div>
		</div>

		<?php
		if ( ! \Elementor\Plugin::instance()->editor->is_edit_mode()
			&& 'default' !== $settings['layout'] ) { ?>
			<?php $this->scripts(); ?>
			<?php
		} ?>

		<?php
	}

	protected function close_btn() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'modal-close', 'type', 'button' );
		$this->add_render_attribute( 'modal-close', 'class', [
			'amadeus-modal-close',
			'amadeus-modal-close-' . $settings['modal_close_button'],
		] ); ?>

		<button <?php $this->print_render_attribute_string( 'modal-close' ); ?>>
			<svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
				<path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249
					C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306
					C514.019,27.23,514.019,14.135,505.943,6.058z"/>
				<path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636
					c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/>
			</svg>
		</button>

		<?php
	}

	protected function scripts() {
		$settings   = $this->get_settings();
		$id         = $this->get_id();
		$layout     = $settings['layout'];
		$timer      = ( $settings['display_after'] ) ? ( $settings['display_after']['size'] * 1000 ) : 1000;
		$cookie     = $settings['cookie'];
		$time       = 2592000;
		$path       = ( defined( 'COOKIEPATH' ) ? COOKIEPATH : '' );
		$domain     = ( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '' );
		$secure     = (int) is_ssl();

		if ( '1' === $secure ) {
			$secure = 'secure;';
		} ?>

		<script type="text/javascript">
			( function( $ ) {

				<?php if ( 'timer' === $layout && 'yes' !== $cookie ) { ?>
					$( document ).on( 'ready', function() {
						setTimeout( function() {
							var innerWidth = $( 'html' ).innerWidth();
							$( 'html' ).css( 'overflow', 'hidden' );
							var hiddenInnerWidth = $( 'html' ).innerWidth();
							$( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );

							// Open the modal
							$( '#amadeus-modal-<?php echo esc_attr( $id ); ?>' ).fadeIn( 500 );
						}, <?php echo esc_attr( $timer ); ?> );
					} );
				<?php } ?>

				<?php if ( 'exit' === $layout && 'yes' !== $cookie ) { ?>
					$( document ).on( 'mouseleave', function( e ) {
						if ( e.clientY <= 0 || e.clientX <= 0
							|| ( e.clientX >= window.innerWidth || e.clientY >= window.innerHeight ) ) {
							var innerWidth = $( 'html' ).innerWidth();
							$( 'html' ).css( 'overflow', 'hidden' );
							var hiddenInnerWidth = $( 'html' ).innerWidth();
							$( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );

							// Open the modal
							$( '#amadeus-modal-<?php echo esc_attr( $id ); ?>' ).fadeIn( 500 );
						}
					} );
				<?php } ?>

				<?php if ( 'yes' === $cookie ) { ?>
					$( document ).ready( function () {
						var modal       = $( '#amadeus-modal-<?php echo esc_attr( $id ); ?>' ),
							cookie      = $.fn.amadeusGetCookieModal();

						// handle set-cookie button click
						$( document ).on( 'click', '#amadeus-modal-<?php echo esc_attr( $id ); ?> .amadeus-modal-close, #amadeus-modal-<?php echo esc_attr( $id ); ?> .amadeus-modal-overlay', function( e ) {
							e.preventDefault();

							var date        = new Date(),
								later_date  = new Date(),
								modal       = $( '#amadeus-modal-<?php echo esc_attr( $id ); ?>' );

							// set expiry time in seconds
							later_date.setTime( parseInt( date.getTime() ) + parseInt( <?php echo esc_attr( $time ); ?> ) * 1000 );

							// set cookie
							document.cookie = 'amadeus_modal_closed_<?php echo esc_attr( $id ); ?>=true;expires=' + later_date.toUTCString() + ';<?php echo esc_attr( $secure ); ?>';

							// trigger custom event
							$.event.trigger( {
								type: 'amadeusSetCookieModal',
								value: 'true',
								time: date,
								expires: later_date
							} );

							// Hide modal
							$( 'html' ).css( {
								'overflow': '',
								'margin-right': ''
							} );

							// Close the modal
							modal.closest( '.amadeus-modal-wrap' ).fadeOut( 500 );

							// Add class to the modal to not show it again
							modal.addClass( 'amadeus-modal-closed' );
						} );

						// Cookie is not set
						if ( typeof cookie === 'undefined' ) {
							<?php if ( 'timer' === $layout ) { ?>
								$( document ).on( 'ready', function() {
									setTimeout( function() {
										var innerWidth = $( 'html' ).innerWidth();
										$( 'html' ).css( 'overflow', 'hidden' );
										var hiddenInnerWidth = $( 'html' ).innerWidth();
										$( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );

										// Open the modal
										modal.fadeIn( 500 );
									}, <?php echo esc_attr( $timer ); ?> );
								} );
							<?php } ?>

							<?php if ( 'exit' === $layout ) { ?>
								$( document ).on( 'mouseleave', function( e ) {
									if ( e.clientY <= 0 || e.clientX <= 0
										|| ( e.clientX >= window.innerWidth || e.clientY >= window.innerHeight ) ) {

										if ( ! modal.hasClass( 'amadeus-modal-closed' ) ) {
											var innerWidth = $( 'html' ).innerWidth();
											$( 'html' ).css( 'overflow', 'hidden' );
											var hiddenInnerWidth = $( 'html' ).innerWidth();
											$( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );
										}

										// Open the modal
										modal.fadeIn( 500 );
									}
								} );
							<?php } ?>
						}

					} );

					// Get cookie value
					$.fn.amadeusGetCookieModal = function() {
						var value = "; " + document.cookie,
							parts = value.split( '; amadeus_modal_closed_<?php echo esc_attr( $id ); ?>=' );

						if ( parts.length === 2 )
							return parts.pop().split( ';' ).shift();
						else
							return;
					}
				<?php } ?>

			} )( jQuery );
		</script>

		<?php
	}

}
