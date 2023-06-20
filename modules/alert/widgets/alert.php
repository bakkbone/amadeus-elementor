<?php
namespace AmadeusElementor\Modules\Alert\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Alert extends Widget_Base {

	public function get_name() {
		return 'amadeus-alert';
	}

	public function get_title() {
		return __( 'Alert', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-warning-circle';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'alert',
			'notice',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-alert' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-alert' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label'         => __( 'Alert', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'         => __( 'Type', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'notice',
				'options'       => [
					'notice'    => __( 'Notice', 'amadeus-elementor' ),
					'error'     => __( 'Error', 'amadeus-elementor' ),
					'warning'   => __( 'Warning', 'amadeus-elementor' ),
					'success'   => __( 'Success', 'amadeus-elementor' ),
					'info'      => __( 'Info', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'small',
				'options'       => [
					'small'     => __( 'Small', 'amadeus-elementor' ),
					'big'       => __( 'Big', 'amadeus-elementor' ),
					'minimal'   => __( 'Minimal', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Your Title', 'amadeus-elementor' ),
				'default'       => __( 'This is an Alert Message', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
				'condition' => [
					'style!' => 'small',
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'placeholder'   => __( 'Your Description', 'amadeus-elementor' ),
				'default'       => __( 'Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'amadeus-elementor' ),
				'separator'     => 'none',
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'view',
			[
				'label'         => __( 'View', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HIDDEN,
				'default'       => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_type',
			[
				'label'         => __( 'Alert', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-alert' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-alert' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-alert-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'alert_title',
				'selector'      => '{{WRAPPER}} .amadeus-alert-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-alert-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'alert_content',
				'selector'      => '{{WRAPPER}} .amadeus-alert-content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper classes
		$wrap_classes = array( 'amadeus-alert' );
		if ( ! empty( $settings['type'] ) ) {
			$wrap_classes[] = 'amadeus-alert-' . $settings['type'];
		}
		if ( ! empty( $settings['style'] ) ) {
			$wrap_classes[] = 'amadeus-alert-' . $settings['style'];
		}

		// Turn wrap classes into a string
		$wrap_classes = implode( ' ', $wrap_classes );

		// Alert icon
		if ( 'notice' === $settings['type'] ) {
			$alert_icon = 'fas fa-bell';
		} elseif ( 'error' === $settings['type'] ) {
			$alert_icon = 'fas fa-times';
		} elseif ( 'warning' === $settings['type'] ) {
			$alert_icon = 'fas fa-exclamation';
		} elseif ( 'success' === $settings['type'] ) {
			$alert_icon = 'fas fa-check';
		} elseif ( 'info' === $settings['type'] ) {
			$alert_icon = 'fas fa-info';
		}
		?>

		<div class="<?php echo esc_attr( $wrap_classes ); ?>" role="alert">

			<div class="amadeus-alert-content-wrap">

				<div class="amadeus-alert-icon"><i class="<?php echo esc_attr( $alert_icon ); ?>"></i></div>
				<?php
				// Display content if defined
				if ( ! empty( $settings['content'] ) ) {
					?>
					<div class="amadeus-alert-content">
						<?php
						// Display heading if defined
						if ( ! empty( $settings['title'] ) && 'small' !== $settings['style'] ) {
							?>
							<h2 class="amadeus-alert-heading">
								<?php echo esc_attr( $settings['title'] ); ?>
							</h2>
							<?php
						}
						echo do_shortcode( $settings['content'] );
						?>
					</div><!-- .amadeus-alert-content -->
					<?php
				}
				?>
			</div><!-- .amadeus-alert-content -->
		</div><!-- .amadeus-alert -->
		<?php
	}

	protected function content_template() { ?>
		<#
			var wrap_classes = 'amadeus-alert',
				alert_icon = '';

			if ( '' !== settings.type ) {
				wrap_classes += ' amadeus-alert-' + settings.type;
			}
			if ( '' !== settings.style ) {
				wrap_classes += ' amadeus-alert-' + settings.style;
			}

			if ( 'notice' === settings.type ) {
				alert_icon = 'fas fa-bell';
			} else if ( 'error' === settings.type ) {
				alert_icon = 'fas fa-times';
			} else if ( 'warning' === settings.type ) {
				alert_icon = 'fas fa-exclamation';
			} else if ( 'success' === settings.type ) {
				alert_icon = 'fas fa-check';
			} else if ( 'info' === settings.type ) {
				alert_icon = 'fas fa-info';
			}
		#>

		<div class="{{ wrap_classes }}" role="alert">
			<div class="amadeus-alert-content-wrap">
				<div class="amadeus-alert-icon"><i class="{{ alert_icon }}"></i></div>
				<# if ( settings.content ) { #>
					<div class="amadeus-alert-content">
						<# if ( settings.title && 'small' !== settings.style ) { #>
							<h2 class="amadeus-alert-heading">{{{ settings.title }}}</h2>
						<# } #>
						{{{ settings.content }}}
					</div>
				<# } #>
			</div>
		</div>
		<?php
	}
}
