<?php
namespace AmadeusElementor\Modules\Hotspots\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Hotspots extends Widget_Base {

	public function get_name() {
		return 'amadeus-hotspots';
	}

	public function get_title() {
		return __( 'Hotspots', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-fire';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'hot',
			'spot',
			'hotspot',
			'image',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-hotspots' );
	}

	public function get_style_depends() {
		return array( 'amadeus-hotspots', 'tippy', 'tippy-arrow' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_hotspots_image',
			array(
				'label' => __( 'Image', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'amadeus-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image',
				'label'   => __( 'Image Size', 'amadeus-elementor' ),
				'default' => 'large',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots',
			array(
				'label' => __( 'Hotspots', 'amadeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'hotspots_tabs' );

		$repeater->start_controls_tab( 'tab_content', array( 'label' => __( 'Content', 'amadeus-elementor' ) ) );

		$repeater->add_control(
			'hotspot_type',
			array(
				'label'   => __( 'Type', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text', 'amadeus-elementor' ),
					'icon'  => __( 'Icon', 'amadeus-elementor' ),
					'blank' => __( 'Blank', 'amadeus-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'hotspot_text',
			array(
				'label'     => __( 'Text', 'amadeus-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( '1', 'amadeus-elementor' ),
				'condition' => array(
					'hotspot_type' => 'text',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'hotspot_icon',
			[
				'label'         => __( 'Icon', 'amadeus-elementor' ),
				'type'          => Controls_Manager::ICONS,
				'default'       => [
					'value'     => 'fas fa-snowflake',
					'library'   => 'fa-solid',
				],
				'condition'     => [
					'hotspot_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'hotspot_link',
			array(
				'label'   => __( 'Link', 'amadeus-elementor' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => '',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', array( 'label' => __( 'Position', 'amadeus-elementor' ) ) );

		$repeater->add_control(
			'hotspot_top_position',
			array(
				'label'     => __( 'Top position', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				),
			)
		);

		$repeater->add_control(
			'hotspot_left_position',
			array(
				'label'     => __( 'Left position', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_tooltip', array( 'label' => __( 'Tooltip', 'amadeus-elementor' ) ) );

		$repeater->add_control(
			'tooltip',
			array(
				'label'   => __( 'Tooltip', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$repeater->add_control(
			'tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 's',
				'options'   => array(
					'n'      => __( 'Top', 'amadeus-elementor' ),
					'ne-alt' => __( 'Top Start', 'amadeus-elementor' ),
					'ne'     => __( 'Top End', 'amadeus-elementor' ),
					'e'      => __( 'Right', 'amadeus-elementor' ),
					'se-alt' => __( 'Right Start', 'amadeus-elementor' ),
					'se'     => __( 'Right End', 'amadeus-elementor' ),
					's'      => __( 'Bottom', 'amadeus-elementor' ),
					'sw-alt' => __( 'Bottom Start', 'amadeus-elementor' ),
					'sw'     => __( 'Bottom End', 'amadeus-elementor' ),
					'w'      => __( 'Left', 'amadeus-elementor' ),
					'nw-alt' => __( 'Left Start', 'amadeus-elementor' ),
					'nw'     => __( 'Left End', 'amadeus-elementor' ),
				),
				'condition' => array(
					'tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tooltip_content',
			array(
				'label'     => __( 'Tooltip Content', 'amadeus-elementor' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your tooltip content here', 'amadeus-elementor' ),
				'condition' => array(
					'tooltip' => 'yes',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tab();

		$this->add_control(
			'hotspots',
			array(
				'label'       => __( 'Hotspots', 'amadeus-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'hotspot_text' => '1',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ hotspot_text }}}',
			)
		);

		$this->add_control(
			'disable_pulse',
			array(
				'label'        => __( 'Disable Pulse Effect', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'none',
				'selectors'    => array(
					'{{WRAPPER}} .amadeus-hotspot-inner:before' => 'display: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_tooltip',
			array(
				'label' => __( 'Tooltip', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'fade_in_time',
			array(
				'label'              => __( 'Fade In Time (ms)', 'amadeus-elementor' ),
				'description'        => __( 'Time until tooltips appear.', 'amadeus-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 200,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'fade_out_time',
			array(
				'label'              => __( 'Fade Out Time (ms)', 'amadeus-elementor' ),
				'description'        => __( 'Time until tooltips dissapear.', 'amadeus-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 100,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => __( 'Image', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'label'    => __( 'Image Border', 'amadeus-elementor' ),
				'selector' => '{{WRAPPER}} .amadeus-hotspots-wrap img',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-hotspots-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-hotspots-wrap img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_style',
			array(
				'label' => __( 'Hotspots', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hotspots_typo',
				'selector' => '{{WRAPPER}} .amadeus-hotspot-inner',
			)
		);

		$this->start_controls_tabs( 'tabs_hotspots_style' );

		$this->start_controls_tab(
			'tab_hotspots_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'hotspots_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-hotspot-inner, {{WRAPPER}} .amadeus-hotspot-inner:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-hotspot-inner, {{WRAPPER}} .amadeus-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hotspots_hover',
			array(
				'label' => __( 'Hover', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'hotspots_hover_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-hotspot-inner:hover, {{WRAPPER}} .amadeus-hotspot-inner:hover:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_hover_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hotspots_size',
			array(
				'label'     => __( 'Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 40,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-hotspot-inner, {{WRAPPER}} .amadeus-hotspot-inner:before' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-hotspot-inner' => 'line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hotspots_border',
				'label'    => __( 'Border', 'amadeus-elementor' ),
				'selector' => '{{WRAPPER}} .amadeus-hotspot-inner',
			)
		);

		$this->add_responsive_control(
			'hotspots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-hotspot-inner, {{WRAPPER}} .amadeus-hotspot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hotspots_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-hotspot-inner',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			array(
				'label' => __( 'Tooltips', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltips_typo',
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_control(
			'tooltips_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'background-color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box > .tippy-arrow' => 'color: {{VALUE}};',
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box > .tippy-svg-arrow' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltips_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tooltips_border',
				'label'    => __( 'Border', 'amadeus-elementor' ),
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltips_box_shadow',
				'selector' => 'div[id*="tippy-"].amadeus-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		} ?>

		<div class="amadeus-hotspots-wrap">
			<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) ); ?>

			<?php
			if ( $settings['hotspots'] ) {
				?>
				<div class="amadeus-hotspot-wrap">
					<?php
					foreach ( $settings['hotspots'] as $index => $item ) :
						$hotspot_tag = 'div';
						$hotspot     = $this->get_repeater_setting_key( 'hotspot', 'hotspots', $index );
						$text        = $this->get_repeater_setting_key( 'hotspot_text', 'hotspots', $index );
						$icon        = $this->get_repeater_setting_key( 'hotspot_icon', 'hotspots', $index );

						$this->add_render_attribute(
							$hotspot,
							array(
								'class' => array(
									'amadeus-hotspot-inner',
									'elementor-repeater-item-' . $item['_id'],
								),
							)
						);

						if ( 'yes' === $item['tooltip'] ) {
							$this->add_render_attribute(
								$hotspot,
								array(
									'class' => array(
										'amadeus-hotspot-tooltip',
										'amadeus-tooltip-' . $item['tooltip_position'],
									),
									'title' => $this->parse_text_editor( $item['tooltip_content'] ),
								)
							);
						}

						$this->add_render_attribute( $text, 'class', 'amadeus-hotspot-text' );

						if ( ! empty( $item['hotspot_link']['url'] ) ) {
							$hotspot_tag = 'a';
							$this->add_link_attributes( $hotspot, $item['hotspot_link'] );
						}
						?>

						<<?php echo esc_attr( $hotspot_tag ); ?> <?php $this->print_render_attribute_string( $hotspot ); ?>>
							<?php
							if ( 'blank' !== $item['hotspot_type'] ) {
								?>
								<span <?php $this->print_render_attribute_string( $text ); ?>>
									<?php
									if ( 'icon' === $item['hotspot_type'] && ! empty( $item['hotspot_icon'] ) ) {
										\Elementor\Icons_Manager::render_icon( $item['hotspot_icon'], [ 'aria-hidden' => 'true' ] );
									} else {
										$this->print_text_editor( $item['hotspot_text'] );
									}
									?>
								</span>
								<?php
							}
							?>
						</<?php echo esc_attr( $hotspot_tag ); ?>>

						<?php
					endforeach;
					?>
				</div>
				<?php
			}
			?>
		</div>

		<?php
	}

	protected function content_template() {
		?>
		<# if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			if ( ! image_url ) {
				return;
			} #>

			<div class="amadeus-hotspots-wrap">
				<img src="{{ image_url }}" />

				<# if ( settings.hotspots ) { #>
					<div class="amadeus-hotspot-wrap">
						<# _.each( settings.hotspots, function( item, index ) {

							var hotspot_tag 	= 'div',
								hotspot 		= view.getRepeaterSettingKey( 'hotspot', 'hotspots', index ),
								text 			= view.getRepeaterSettingKey( 'hotspot_text', 'hotspots', index ),
								icon 			= view.getRepeaterSettingKey( 'hotspot_icon', 'hotspots', index ),
								iconHTML 		= elementor.helpers.renderIcon( view, item.hotspot_icon, { 'aria-hidden': true }, 'i' , 'object' );

							view.addRenderAttribute( hotspot, 'class', [
								'amadeus-hotspot-inner',
								'elementor-repeater-item-' + item._id,
							] );

							if ( 'yes' == item.tooltip ) {
								view.addRenderAttribute( hotspot, 'class', 'amadeus-hotspot-tooltip' );
								view.addRenderAttribute( hotspot, 'class', 'amadeus-tooltip-' + item.tooltip_position );
								view.addRenderAttribute( hotspot, 'title', item.tooltip_content );
							}

							view.addRenderAttribute( text, 'class', 'amadeus-hotspot-text' );

							if ( '' != item.hotspot_link.url ) {
								hotspot_tag = 'a';
								view.addRenderAttribute( hotspot, 'href', item.hotspot_link.url );
							} #>

							<{{ hotspot_tag }} {{{ view.getRenderAttributeString( hotspot ) }}}>
								<# if ( 'blank' != item.hotspot_type ) { #>
									<span {{{ view.getRenderAttributeString( text ) }}}>
										<# if ( 'icon' == item.hotspot_type && '' !== item.hotspot_icon ) { #>
											<# if ( iconHTML && iconHTML.rendered ) { #>
												{{{ iconHTML.value }}}
											<# }
										} else { #>
											{{ item.hotspot_text }}
										<# } #>
									</span>
								<# } #>
							</{{ hotspot_tag }}>
						<# } ); #>
					</div>
				<# } #>
			</div>

		<# } #>
		<?php
	}

}
