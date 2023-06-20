<?php
namespace AmadeusElementor\Modules\Tabs\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Tabs extends Widget_Base {

	public function get_name() {
		return 'amadeus-tabs';
	}

	public function get_title() {
		return __( 'Tabs', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-window-tab';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'tabs',
			'accordion',
			'toggle',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-tabs' );
	}

	public function get_style_depends() {
		return array( 'amadeus-tabs' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tabs',
			array(
				'label' => __( 'Tabs', 'amadeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'name'        => 'tab_title',
				'label'       => __( 'Title & Content', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Tab Title', 'amadeus-elementor' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'tab_icon',
			array(
				'name'    => 'tab_icon',
				'label'   => __( 'Icon', 'amadeus-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'source',
			array(
				'name'    => 'source',
				'label'   => __( 'Select Source', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'   => __( 'Custom', 'amadeus-elementor' ),
					'template' => __( 'Template', 'amadeus-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'tab_content',
			array(
				'name'       => 'tab_content',
				'label'      => __( 'Content', 'amadeus-elementor' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
				'show_label' => false,
				'condition'  => array(
					'source' => 'custom',
				),
				'dynamic'    => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'templates',
			array(
				'name'      => 'templates',
				'label'     => __( 'Content', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => amadeus_get_available_templates(),
				'condition' => array(
					'source' => 'template',
				),
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Items', 'amadeus-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tab_title'   => __( 'Tab #1', 'amadeus-elementor' ),
						'tab_content' => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
					),
					array(
						'tab_title'   => __( 'Tab #2', 'amadeus-elementor' ),
						'tab_content' => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
					),
					array(
						'tab_title'   => __( 'Tab #3', 'amadeus-elementor' ),
						'tab_content' => __( 'I am a text block. Click the edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'amadeus-elementor' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->add_control(
			'tab_layout',
			array(
				'label'     => __( 'Layout', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => __( 'Top', 'amadeus-elementor' ),
					'bottom' => __( 'Bottom', 'amadeus-elementor' ),
					'left'   => __( 'Left', 'amadeus-elementor' ),
					'right'  => __( 'Right', 'amadeus-elementor' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'amadeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'condition' => array(
					'tab_layout' => array( 'top', 'bottom' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			array(
				'label' => __( 'Additional Options', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'active_item',
			array(
				'label'              => __( 'Active Item No', 'amadeus-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 20,
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Tab', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'tab_spacing',
			array(
				'label'     => __( 'Tab Spacing', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs-wrap' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs-wrap .amadeus-tab-title' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs-left .amadeus-tabs-wrap .amadeus-tab-title, {{WRAPPER}} .amadeus-tabs-right .amadeus-tabs-wrap .amadeus-tab-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title',
			)
		);

		$this->start_controls_tabs( 'tabs_tab_style' );

		$this->start_controls_tab(
			'tab_tab_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_background_color',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title',
			)
		);

		$this->add_control(
			'tab_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'tab_box_shadow',
				'selector'  => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'tab_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title',
			)
		);

		$this->add_control(
			'tab_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'tab_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_tab_active',
			array(
				'label' => __( 'Active', 'amadeus-elementor' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_active_background_color',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active',
			)
		);

		$this->add_control(
			'tab_active_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'tab_active_box_shadow',
				'selector'  => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'tab_active_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active',
			)
		);

		$this->add_control(
			'tab_active_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-content',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background_color',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tabs-content-wrap',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_spacing',
			array(
				'label'     => __( 'Content Spacing', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs.amadeus-tabs-top .amadeus-tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs.amadeus-tabs-bottom .amadeus-tab-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs.amadeus-tabs-left .amadeus-tab-content' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs.amadeus-tabs-right .amadeus-tab-content' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-tabs .amadeus-tabs-content-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'content_border',
				'selector'      => '{{WRAPPER}} .amadeus-tabs .amadeus-tab-content, {{WRAPPER}} .amadeus-tabs .amadeus-tab-mobile-title',
			]
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tabs-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label' => __( 'Icon', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'   => __( 'Alignment', 'amadeus-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => __( 'Start', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'End', 'amadeus-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => is_rtl() ? 'right' : 'left',
			)
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			array(
				'label' => __( 'Active', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'icon_active_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title.amadeus-active i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => __( 'Spacing', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title .amadeus-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-tabs .amadeus-tab-title .amadeus-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id_int   = substr( $this->get_id_int(), 0, 3 );
		$layout   = $settings['tab_layout'];

		$this->add_render_attribute(
			'wrap',
			'class',
			array(
				'amadeus-tabs',
				'amadeus-tabs-' . $layout,
			)
		);

		if ( ! empty( $settings['active_item'] ) ) {
			$data = array( $settings['active_item'] );
			$this->add_render_attribute( 'wrap', 'class', 'amadeus-has-active-item' );
		}

		$this->add_render_attribute( 'tabs-wrap', 'class', 'amadeus-tabs-wrap' );

		if ( 'top' === $layout
			|| 'bottom' === $layout ) {
			$this->add_render_attribute(
				'tabs-wrap',
				'class',
				array(
					'amadeus-tabs-normal',
					'amadeus-tabs-' . $settings['align'],
				)
			);
		} ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'tabs-wrap' ); ?>>
				<?php
				foreach ( $settings['tabs'] as $index => $item ) :
					$tab_count     = $index + 1;
					$active_item   = ( $tab_count === $settings['active_item'] ) ? ' amadeus-active' : '';
					$tab_title_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

					$this->add_render_attribute(
						$tab_title_key,
						array(
							'id'            => 'amadeus-tab-title-' . $id_int . $tab_count,
							'class'         => array( 'amadeus-tab-title', $active_item ),
							'data-tab'      => $tab_count,
							'tabindex'      => $id_int . $tab_count,
							'role'          => 'tab',
							'aria-controls' => 'amadeus-tab-content-' . $id_int . $tab_count,
						)
					);
					?>

					<div <?php $this->print_render_attribute_string( $tab_title_key ); ?>>
						<?php
						if ( ! empty( $item['tab_icon'] )
							&& 'left' === $settings['icon_align'] ) {
							?>
							<span class="amadeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}

						if ( $item['tab_title'] ) {
							$this->print_unescaped_setting( 'tab_title', 'tabs', $index );
						}

						if ( ! empty( $item['tab_icon'] )
							&& 'right' === $settings['icon_align'] ) {
							?>
							<span class="amadeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}
						?>
					</div>
					<?php
				endforeach;
				?>
			</div>

			<div class="amadeus-tabs-content-wrap">
				<?php
				foreach ( $settings['tabs'] as $index => $item ) :
					$tab_count            = $index + 1;
					$active_item          = ( $tab_count === $settings['active_item'] ) ? ' amadeus-active' : '';
					$tab_content_key      = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
					$tab_title_mobile_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute(
						$tab_content_key,
						array(
							'id'              => 'amadeus-tab-content-' . $tab_count,
							'class'           => array( 'amadeus-tab-content', $active_item ),
							'role'            => 'tabpanel',
							'aria-labelledby' => 'amadeus-tab-title-' . $id_int . $tab_count,
						)
					);

					$this->add_render_attribute(
						$tab_title_mobile_key,
						array(
							'class'    => array( 'amadeus-tab-title', 'amadeus-tab-mobile-title', $active_item ),
							'tabindex' => $id_int . $tab_count,
							'data-tab' => $tab_count,
							'role'     => 'tab',
						)
					);
					?>

					<div <?php $this->print_render_attribute_string( $tab_title_mobile_key ); ?>>
						<?php
						if ( ! empty( $item['tab_icon'] )
							&& 'left' === $settings['icon_align'] ) {
							?>
							<span class="amadeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}

						if ( $item['tab_title'] ) {
							$this->print_unescaped_setting( 'tab_title', 'tabs', $index );
						}

						if ( ! empty( $item['tab_icon'] )
							&& 'right' === $settings['icon_align'] ) {
							?>
							<span class="amadeus-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}
						?>
					</div>

					<div <?php $this->print_render_attribute_string( $tab_content_key ); ?>>
						<?php
						if ( 'custom' === $item['source']
							&& ! empty( $item['tab_content'] ) ) {
							$this->print_text_editor( $item['tab_content'] );
						} elseif ( 'template' === $item['source']
							&& ( '0' !== $item['templates'] && ! empty( $item['templates'] ) ) ) {
							echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>

		<?php
	}
}
