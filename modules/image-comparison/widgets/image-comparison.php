<?php
namespace AmadeusElementor\Modules\ImageComparison\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class ImageComparison extends Widget_Base {

	public function get_name() {
		return 'amadeus-image-comparison';
	}

	public function get_title() {
		return __( 'Image Comparison', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-files-compare';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'image',
			'comparison',
			'banner',
			'before',
			'after',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-image-comparison' );
	}

	public function get_style_depends() {
		return array( 'amadeus-image-comparison' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_before_image',
			array(
				'label' => __( 'Before Image', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'before_label',
			array(
				'label'   => __( 'Label', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Before', 'amadeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => __( 'Image', 'amadeus-elementor' ),
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
				'name'      => 'before_image',
				'default'   => 'full',
				'separator' => 'none',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_after_image',
			array(
				'label' => __( 'After Image', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'after_label',
			array(
				'label'   => __( 'Label', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'After', 'amadeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'after_label',
				'default'   => 'full',
				'separator' => 'none',
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => __( 'Image', 'amadeus-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_settings',
			array(
				'label' => __( 'Settings', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'visible_ratio',
			array(
				'label'      => __( 'Visible Ratio', 'amadeus-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'size_units' => '',
			)
		);

		$this->add_control(
			'orientation',
			array(
				'label'   => __( 'Orientation', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'vertical'   => __( 'Vertical', 'amadeus-elementor' ),
					'horizontal' => __( 'Horizontal', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'move_slider',
			array(
				'label'   => __( 'Move Slider', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'drag',
				'options' => array(
					'drag'        => __( 'Drag', 'amadeus-elementor' ),
					'mouse_move'  => __( 'Mouse Move', 'amadeus-elementor' ),
					'mouse_click' => __( 'Mouse Click', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'before_after',
			array(
				'label'        => __( 'Before/After Labels', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			array(
				'label'     => __( 'Labels', 'amadeus-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_labels_style' );

		$this->start_controls_tab(
			'tab_label_before',
			array(
				'label'     => __( 'Before', 'amadeus-elementor' ),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'label_before_background',
			array(
				'label'     => __( 'Background color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'label_before_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_label_after',
			array(
				'label'     => __( 'After', 'amadeus-elementor' ),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'label_after_background',
			array(
				'label'     => __( 'Background color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'label_after_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'labels_typography',
				'selector'  => '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'separator' => 'before',
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'labels_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .twentytwenty-overlay > div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'labels_horizontal_align',
			array(
				'label'        => __( 'Horizontal Alignment', 'amadeus-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'top'    => array(
						'title' => __( 'Top', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'amadeus-elementor' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'condition'    => array(
					'orientation'  => 'horizontal',
					'before_after' => 'yes',
				),
				'prefix_class' => 'amadeus-label-horizontal-',
			)
		);

		$this->add_responsive_control(
			'labels_vertical_align',
			array(
				'label'        => __( 'Vertical Alignment', 'amadeus-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'condition'    => array(
					'orientation'  => 'vertical',
					'before_after' => 'yes',
				),
				'prefix_class' => 'amadeus-label-vertical-',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'labels_border',
				'label'     => __( 'Border', 'amadeus-elementor' ),
				'selector'  => '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_control(
			'labels_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .twentytwenty-overlay > div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'labels_box_shadow',
				'selector'  => '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'condition' => array(
					'before_after' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_handle_style',
			array(
				'label' => __( 'Handle', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_handle_style' );

		$this->start_controls_tab(
			'tab_handle_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'handle_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-handle' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-up-arrow'   => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_handle_hover',
			array(
				'label' => __( 'Hover', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'handle_hover_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-handle:hover, {{WRAPPER}} .active .twentytwenty-handle' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_hover_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-left-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-right-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-down-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-up-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'handle_size',
			array(
				'label'     => __( 'Size (%)', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 38,
				),
				'range'     => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-handle' => 'width: {{SIZE}}px; height: {{SIZE}}px; margin-left: calc(-{{SIZE}}px/2); margin-top: calc(-{{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'margin-bottom: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'margin-top: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-left: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'margin-right: calc({{SIZE}}px/2);',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			array(
				'label' => __( 'Separator', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'separator_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'separator_width',
			array(
				'label'          => __( 'Width', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'size' => 2,
					'unit' => 'px',
				),
				'size_units'     => array( 'px', '%' ),
				'range'          => array(
					'px' => array(
						'max' => 20,
					),
				),
				'tablet_default' => array(
					'unit' => 'px',
				),
				'mobile_default' => array(
					'unit' => 'px',
				),
				'selectors'      => array(
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}}; margin-top: calc(-{{SIZE}}{{UNIT}}/2);',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'wrap',
			array(
				'class' => array(
					'amadeus-image-comparison',
					'twentytwenty-container',
				),
			)
		);

		$image_settings = array(
			'visible_ratio'      => ( '' !== $settings['visible_ratio']['size'] ? $settings['visible_ratio']['size'] : '0.5' ),
			'orientation'        => ( '' !== $settings['orientation'] ? $settings['orientation'] : 'vertical' ),
			'before_label'       => ( '' !== $settings['before_label'] ? esc_attr( $settings['before_label'] ) : '' ),
			'after_label'        => ( '' !== $settings['after_label'] ? esc_attr( $settings['after_label'] ) : '' ),
			'slider_on_hover'    => ( 'mouse_move' === $settings['move_slider'] ? true : false ),
			'slider_with_handle' => ( 'drag' === $settings['move_slider'] ? true : false ),
			'slider_with_click'  => ( 'mouse_click' === $settings['move_slider'] ? true : false ),
			'no_overlay'         => ( 'yes' === $settings['before_after'] ? false : true ),
		); ?>

		<figure <?php $this->print_render_attribute_string( 'wrap' ); ?> data-settings='<?php echo wp_json_encode( $image_settings ); ?>'>

			<?php
			if ( ! empty( $settings['before_image']['url'] ) ) {
				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'before_image' ) );
			}

			if ( ! empty( $settings['after_image']['url'] ) ) {
				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'after_image' ) );
			}
			?>

		</figure>

		<?php
	}

	protected function content_template() {
		?>

		<#
		var before_image = {
			id: settings.before_image.id,
			url: settings.before_image.url,
			size: settings.before_image_size,
			dimension: settings.before_image_custom_dimension,
			model: view.getEditModel()
		};

		var after_image = {
			id: settings.after_image.id,
			url: settings.after_image.url,
			size: settings.after_image_size,
			dimension: settings.after_image_custom_dimension,
			model: view.getEditModel()
		};

		view.addRenderAttribute( 'before-image', 'src', elementor.imagesManager.getImageUrl( before_image ) );
		view.addRenderAttribute( 'after-image', 'src', elementor.imagesManager.getImageUrl( after_image ) );

		var visible_ratio       = ( settings.visible_ratio.size != '' ) ? settings.visible_ratio.size : '0.5',
			slider_on_hover     = ( settings.move_slider == 'mouse_move' ) ? true : false,
			slider_with_handle  = ( settings.move_slider == 'drag' ) ? true : false,
			slider_with_click   = ( settings.move_slider == 'mouse_click' ) ? true : false,
			no_before_after     = ( settings.before_after == 'yes' ) ? false : true;
		#>

		<figure class="amadeus-image-comparison twentytwenty-container" data-settings='{ "visible_ratio":{{ visible_ratio }},"orientation":"{{ settings.orientation }}","before_label":"{{ settings.before_label }}","after_label":"{{ settings.after_label }}","slider_on_hover":{{ slider_on_hover }},"slider_with_handle":{{ slider_with_handle }},"slider_with_click":{{ slider_with_click }},"no_overlay":{{ no_before_after }} }'>

			<# if ( settings.before_image.url ) { #>
				<img {{{ view.getRenderAttributeString( 'before-image' ) }}}>
			<# } #>

			<# if ( settings.after_image.url ) { #>
				<img {{{ view.getRenderAttributeString( 'after-image' ) }}}>
			<# } #>

		</figure>

		<?php
	}

}
