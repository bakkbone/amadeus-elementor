<?php
namespace AmadeusElementor\Modules\Countdown\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Utils;

class Countdown extends Widget_Base {

	public function get_name() {
		return 'amadeus-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-stopwatch';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'countdown',
			'timer',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-countdown' );
	}

	public function get_style_depends() {
		return array( 'amadeus-countdown' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_countdown',
			array(
				'label' => __( 'Countdown', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'due_date',
			array(
				'label'       => __( 'Due Date', 'amadeus-elementor' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'amadeus-elementor' ), Utils::get_timezone_string() ),
			)
		);

		$this->add_control(
			'label_display',
			array(
				'label'        => __( 'View', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'block'  => __( 'Block', 'amadeus-elementor' ),
					'inline' => __( 'Inline', 'amadeus-elementor' ),
				),
				'default'      => 'block',
				'prefix_class' => 'amadeus-countdown-label-',
			)
		);

		$this->add_control(
			'show_days',
			array(
				'label'   => __( 'Days', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_hours',
			array(
				'label'   => __( 'Hours', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_minutes',
			array(
				'label'   => __( 'Minutes', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_seconds',
			array(
				'label'   => __( 'Seconds', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_labels',
			array(
				'label'     => __( 'Show Label', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'custom_labels',
			array(
				'label'        => __( 'Custom Label', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'show_labels!' => '',
				),
			)
		);

		$this->add_control(
			'label_days',
			array(
				'label'       => __( 'Days', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Days', 'amadeus-elementor' ),
				'placeholder' => __( 'Days', 'amadeus-elementor' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_days'      => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_hours',
			array(
				'label'       => __( 'Hours', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Hours', 'amadeus-elementor' ),
				'placeholder' => __( 'Hours', 'amadeus-elementor' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_hours'     => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_minutes',
			array(
				'label'       => __( 'Minutes', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Minutes', 'amadeus-elementor' ),
				'placeholder' => __( 'Minutes', 'amadeus-elementor' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_minutes'   => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_seconds',
			array(
				'label'       => __( 'Seconds', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Seconds', 'amadeus-elementor' ),
				'placeholder' => __( 'Seconds', 'amadeus-elementor' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_seconds'   => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			array(
				'label' => __( 'Additional Options', 'amadeus-elementor' ),
			)
		);

		$this->add_responsive_control(
			'container_width',
			array(
				'label'          => __( 'Container Width', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
					'size' => 80,
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'range'          => array(
					'px' => array(
						'min' => 0,
						'max' => 2000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'     => array( '%', 'px' ),
				'selectors'      => array(
					'{{WRAPPER}} .amadeus-countdown-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'        => __( 'Alignment', 'amadeus-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'amadeus-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => 'amadeus-countdown-align-',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Columns', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options'        => array(
					'1' => __( '1', 'amadeus-elementor' ),
					'2' => __( '2', 'amadeus-elementor' ),
					'3' => __( '3', 'amadeus-elementor' ),
					'4' => __( '4', 'amadeus-elementor' ),
				),
				'prefix_class'   => 'amadeus%s-countdown-column-',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Boxes', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'boxes_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'boxes_spacing',
			array(
				'label'     => __( 'Space Between', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 8,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'boxes_border',
				'selector'  => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'boxes_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxes_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item',
			)
		);

		$this->add_responsive_control(
			'boxes_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_numbers_style',
			array(
				'label' => __( 'Numbers', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'numbers_typography',
				'selector' => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number',
			)
		);

		$this->add_control(
			'numbers_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'numbers_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'numbers_border',
				'selector'  => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'numbers_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'numbers_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number',
			)
		);

		$this->add_responsive_control(
			'numbers_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			array(
				'label' => __( 'Labels', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typography',
				'selector' => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label',
			)
		);

		$this->add_control(
			'labels_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'labels_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'labels_border',
				'selector'  => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'labels_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'labels_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label',
			)
		);

		$this->add_responsive_control(
			'labels_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'labels_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-countdown-wrap .amadeus-countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	private function get_strftime( $instance ) {
		$string = '';
		if ( $instance['show_days'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_days', 'amadeus-countdown-days' );
		}
		if ( $instance['show_hours'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_hours', 'amadeus-countdown-hours' );
		}
		if ( $instance['show_minutes'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_minutes', 'amadeus-countdown-minutes' );
		}
		if ( $instance['show_seconds'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_seconds', 'amadeus-countdown-seconds' );
		}

		return $string;
	}

	private $default_countdown_labels;

	private function init_default_countdown_labels() {
		$this->default_countdown_labels = array(
			'label_months'  => __( 'Months', 'amadeus-elementor' ),
			'label_weeks'   => __( 'Weeks', 'amadeus-elementor' ),
			'label_days'    => __( 'Days', 'amadeus-elementor' ),
			'label_hours'   => __( 'Hours', 'amadeus-elementor' ),
			'label_minutes' => __( 'Minutes', 'amadeus-elementor' ),
			'label_seconds' => __( 'Seconds', 'amadeus-elementor' ),
		);
	}

	public function get_default_countdown_labels() {
		if ( ! $this->default_countdown_labels ) {
			$this->init_default_countdown_labels();
		}

		return $this->default_countdown_labels;
	}

	private function render_countdown_item( $instance, $label, $part_class ) {
		$string = '<div class="amadeus-countdown-item-wrap"><div class="amadeus-countdown-item"><span class="amadeus-countdown-number ' . $part_class . '"></span>';

		if ( $instance['show_labels'] ) {
			$default_labels = $this->get_default_countdown_labels();
			$label          = ( $instance['custom_labels'] ) ? $instance[ $label ] : $default_labels[ $label ];
			$string        .= ' <span class="amadeus-countdown-label">' . $label . '</span>';
		}

		$string .= '</div></div>';

		return $string;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$due_date = $settings['due_date'];
		$string   = $this->get_strftime( $settings );

		// Handle timezone ( we need to set GMT time )
		$gmt      = get_gmt_from_date( $due_date . ':00' );
		$due_date = strtotime( $gmt );

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-countdown-wrap' );
		$this->add_render_attribute( 'wrap', 'data-date', $due_date ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<?php echo $string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<?php
	}

}
