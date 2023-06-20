<?php
namespace AmadeusElementor\Modules\Skillbar\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Skillbar extends Widget_Base {

	public function get_name() {
		return 'amadeus-skillbar';
	}

	public function get_title() {
		return __( 'Skillbar', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-signal';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'skillbar',
			'skill',
			'skills',
			'bar',
			'progress',
			'progress bar',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-skillbar', 'appear' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-skillbar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label'         => __( 'Skillbar', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'Web Design', 'amadeus-elementor' ),
				'label_block'   => true,
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_control(
			'percent',
			[
				'label'         => __( 'Percentage', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'      => 85,
					'unit'      => '%',
				],
				'label_block'   => true,
			]
		);

		$this->add_control(
			'display_percent',
			[
				'label'         => __( 'Display % Number', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Show', 'amadeus-elementor' ),
					'false'     => __( 'Hide', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => __( 'Style', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'inner',
				'options'       => [
					'inner'     => __( 'Inner', 'amadeus-elementor' ),
					'outside'   => __( 'Outside', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'display_stripe',
			[
				'label'         => __( 'Display Stripe', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Show', 'amadeus-elementor' ),
					'false'     => __( 'Hide', 'amadeus-elementor' ),
				],
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
			'section_style',
			[
				'label'         => __( 'Skill Bar', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-skillbar-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label'         => __( 'Bar Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-skillbar-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_shadow',
			[
				'label'         => __( 'Inset Shadow', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'true',
				'options'       => [
					'true'      => __( 'Yes', 'amadeus-elementor' ),
					'false'     => __( 'No', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'skillbar_title',
				'selector'      => '{{WRAPPER}} .amadeus-skillbar',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings       = $this->get_settings_for_display();

		// Vars
		$elements_style = $settings['style'];
		$percent        = $settings['percent']['size'];
		$title          = $settings['title'];
		$show_percent   = $settings['display_percent'];
		$show_stripe    = $settings['display_stripe'];

		// Wrapper classes
		$wrap_classes = array( 'amadeus-skillbar' );
		if ( 'false' === $settings['box_shadow'] ) {
			$wrap_classes[] = 'disable-box-shadow';
		}
		if ( $elements_style ) {
			$wrap_classes[] = 'style-' . $elements_style;
		}
		if ( 'inner' === $elements_style ) {
			$wrap_classes[] = 'amadeus-skillbar-container';
		}

		// Turn wrap classes into a string
		$wrap_classes = implode( ' ', $wrap_classes ); ?>

		<div class="<?php echo esc_attr( $wrap_classes ); ?>" data-percent="<?php echo esc_attr( $percent ); ?>&#37;">

			<?php if ( 'inner' === $elements_style ) { ?>

				<div class="amadeus-skillbar-title">

					<div class="amadeus-skillbar-title-inner">
						<?php echo esc_attr( $title ); ?>
					</div><!-- .amadeus-skillbar-title-inner -->

				</div><!-- .amadeus-skillbar-title -->

			<?php } elseif ( 'outside' === $elements_style ) { ?>

				<div class="amadeus-skillbar-title">
					<?php echo esc_attr( $title ); ?>
				</div><!-- .amadeus-skillbar-title-inner -->

				<?php if ( 'true' === $show_percent ) { ?>
					<div class="amadeus-skill-bar-percent"><?php echo esc_attr( $percent ); ?>&#37;</div>
				<?php } ?>

				<div style="clear:both"></div>

			<?php } ?>

			<?php if ( $settings['percent'] ) { ?>

				<?php if ( 'outside' === $elements_style ) { ?>
					<div class="amadeus-skillbar-container">
				<?php } ?>

					<div class="amadeus-skillbar-bar">
						<?php if ( 'true' === $show_percent && 'inner' === $elements_style ) { ?>
							<div class="amadeus-skill-bar-percent"><?php echo esc_attr( $percent ); ?>&#37;</div>
						<?php } ?>
						<?php if ( 'true' === $show_stripe ) { ?>
							<div class="amadeus-skill-bar-stripe"></div>
						<?php } ?>
					</div><!-- .amadeus-skillbar -->

				<?php if ( 'outside' === $elements_style ) { ?>
					</div>
				<?php } ?>

			<?php } ?>

		</div><!-- .amadeus-skillbar -->

		<?php
	}

	protected function content_template() { ?>
		<#
			var wrap_classes = 'amadeus-skillbar';

			if ( 'false' == settings.box_shadow ) {
				wrap_classes += ' disable-box-shadow';
			}
			if ( '' !== settings.style ) {
				wrap_classes += ' style-' + settings.style;
			}
			if ( 'inner' == settings.style ) {
				wrap_classes += ' amadeus-skillbar-container';
			}
		#>

		<div class="{{ wrap_classes }}" data-percent="{{ settings.percent.size }}&#37;">

			<# if ( 'inner' == settings.style ) { #>

				<div class="amadeus-skillbar-title">

					<div class="amadeus-skillbar-title-inner">
						{{{ settings.title }}}
					</div><!-- .amadeus-skillbar-title-inner -->

				</div><!-- .amadeus-skillbar-title -->

			<# } else if ( 'outside' == settings.style ) { #>

				<div class="amadeus-skillbar-title">
					{{{ settings.title }}}
				</div><!-- .amadeus-skillbar-title-inner -->

				<# if ( 'true' == settings.display_percent ) { #>
					<div class="amadeus-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
				<# } #>

				<div style="clear:both"></div>

			<# } #>

			<# if ( settings.percent ) { #>

				<# if ( 'outside' == settings.style ) { #>
					<div class="amadeus-skillbar-container">
				<# } #>

					<div class="amadeus-skillbar-bar">
						<# if ( 'true' == settings.display_percent && 'inner' == settings.style ) { #>
							<div class="amadeus-skill-bar-percent">{{ settings.percent.size }}&#37;</div>
						<# } #>
						<# if ( 'true' == settings.display_stripe ) { #>
							<div class="amadeus-skill-bar-stripe"></div>
						<# } #>
					</div><!-- .amadeus-skillbar -->

				<# if ( 'outside' == settings.style ) { #>
					</div>
				<# } #>

			<# } #>

		</div><!-- .amadeus-skillbar -->
		<?php
	}

}
