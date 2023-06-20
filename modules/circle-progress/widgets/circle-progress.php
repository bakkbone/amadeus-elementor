<?php
namespace AmadeusElementor\Modules\CircleProgress\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Circle_Progress extends Widget_Base {

	public function get_name() {
		return 'amadeus-circle-progress';
	}

	public function get_title() {
		return __( 'Circle Progress', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-spinner4';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'pie',
			'charts',
			'circle',
			'progress',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-circle-progress' );
	}

	public function get_style_depends() {
		return array( 'amadeus-circle-progress' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_circle_progress',
			array(
				'label' => __( 'Circle Progress', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'goal',
			array(
				'label'   => __( 'Percent', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '60',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'   => __( 'Speed (s)', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'step',
			array(
				'label'   => __( 'Steps', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'   => __( 'Delay', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'text_before',
			array(
				'label'       => __( 'Text Before', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_middle',
			array(
				'label'       => __( 'Text Middle', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_after',
			array(
				'label'       => __( 'Text After', 'amadeus-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'amadeus-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Add your content here', 'amadeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Circle Progress', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'barsize',
			array(
				'label'   => __( 'Bar Size', 'amadeus-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			)
		);

		$this->add_control(
			'barcap',
			array(
				'label'   => __( 'Bar Cap', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'round',
				'options' => array(
					'round'  => __( 'Rounded', 'amadeus-elementor' ),
					'square' => __( 'Square', 'amadeus-elementor' ),
					'butt'   => __( 'Butt', 'amadeus-elementor' ),
				),
			)
		);

		$this->add_control(
			'circle_outside_color',
			array(
				'label'     => esc_html__( 'Circle Outside Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress svg ellipse' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'circle_inside_color',
			array(
				'label'     => esc_html__( 'Circle Inside Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress svg path' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'circle_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_before_heading',
			array(
				'label'     => __( 'Text Before', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_before_typography',
				'selector' => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-before',
			)
		);

		$this->add_control(
			'text_before_color',
			array(
				'label'     => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_before_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_middle_heading',
			array(
				'label'     => __( 'Number/Text Middle', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_middle_typography',
				'selector' => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-middle',
			)
		);

		$this->add_control(
			'text_middle_color',
			array(
				'label'     => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-middle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_middle_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-middle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_after_heading',
			array(
				'label'     => __( 'Text After', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_after_typography',
				'selector' => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-after',
			)
		);

		$this->add_control(
			'text_after_color',
			array(
				'label'     => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-after' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_after_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress .amadeus-circle-progress-label .amadeus-circle-progress-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

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
				'selector' => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content',
			)
		);

		$this->add_control(
			'content_background_color',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'content_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content',
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content',
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-circle-progress-wrap .amadeus-circle-progress-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-circle-progress-wrap' );

		$this->add_render_attribute(
			'inner',
			'class',
			array(
				'amadeus-circle-progress',
				'pieProgress',
				'amadeus-cp-' . $settings['barcap'],
			)
		);

		$this->add_render_attribute( 'inner', 'role', 'progressbar' );

		if ( ! empty( $settings['goal'] ) ) {
			$this->add_render_attribute( 'inner', 'data-goal', $settings['goal'] );
		}

		$this->add_render_attribute( 'inner', 'data-valuemin', '0' );

		if ( ! empty( $settings['speed'] ) ) {
			$this->add_render_attribute( 'inner', 'data-speed', $settings['speed'] * 15 );
		}

		if ( ! empty( $settings['step'] ) ) {
			$this->add_render_attribute( 'inner', 'data-step', $settings['step'] );
		}

		if ( ! empty( $settings['delay'] ) ) {
			$this->add_render_attribute( 'inner', 'data-delay', $settings['delay'] * 1000 );
		}

		if ( ! empty( $settings['barsize'] ) ) {
			$this->add_render_attribute( 'inner', 'data-barsize', intval( $settings['barsize'] ) );
		}

		$this->add_render_attribute( 'inner', 'data-valuemax', '100' );

		$this->add_render_attribute( 'label', 'class', 'amadeus-circle-progress-label' );
		$this->add_render_attribute( 'before', 'class', 'amadeus-circle-progress-before' );
		$this->add_render_attribute( 'text', 'class', 'amadeus-circle-progress-middle' );
		$this->add_render_attribute(
			'number',
			'class',
			array(
				'amadeus-circle-progress-number',
				'amadeus-circle-progress-middle',
			)
		);
		$this->add_render_attribute( 'after', 'class', 'amadeus-circle-progress-after' );
		$this->add_render_attribute( 'content', 'class', 'amadeus-circle-progress-content' ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>
			<div <?php $this->print_render_attribute_string( 'inner' ); ?>>
				<div <?php $this->print_render_attribute_string( 'label' ); ?>>
					<?php
					if ( $settings['text_before'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'before' ); ?>><?php $this->print_unescaped_setting( 'text_before' ); ?></div>
						<?php
					}

					if ( $settings['text_middle'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'text' ); ?>><?php $this->print_unescaped_setting( 'text_middle' ); ?></div>
						<?php
					} else {
						?>
						<div <?php $this->print_render_attribute_string( 'number' ); ?>></div>
						<?php
					}

					if ( $settings['text_after'] ) {
						?>
						<div <?php $this->print_render_attribute_string( 'after' ); ?>><?php $this->print_unescaped_setting( 'text_after' ); ?></div>
						<?php
					}
					?>
				</div>
			</div>

			<?php
			if ( $settings['content'] ) {
				?>
				<div <?php $this->print_render_attribute_string( 'content' ); ?>><?php $this->print_unescaped_setting( 'content' ); ?></div>
				<?php
			}
			?>

		</div>

		<?php
	}

}
