<?php
namespace AmadeusElementor\Modules\Member\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Member extends Widget_Base {

	public function get_name() {
		return 'amadeus-member';
	}

	public function get_title() {
		return __( 'Member', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-user';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'member',
			'user',
			'team',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-member' );
	}

	public function get_style_depends() {
		return array( 'amadeus-member' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_member',
			array(
				'label' => __( 'General', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'amadeus-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'   => __( 'Name', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'amadeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'role',
			array(
				'label'   => __( 'Role', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Co-Founder', 'amadeus-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'amadeus-elementor' ),
				'rows'    => 10,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'   => __( 'Name HTML Tag', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => amadeus_get_available_tags(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_links',
			array(
				'label' => __( 'Social Icons', 'amadeus-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link_title',
			array(
				'label'   => __( 'Title', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Facebook',
			)
		);

		$repeater->add_control(
			'social_link',
			array(
				'label'   => __( 'Link', 'amadeus-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
			)
		);

		$repeater->add_control(
			'social_icon',
			array(
				'label'   => __( 'Choose Icon', 'amadeus-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => 'fa-brands',
				),
			)
		);

		$repeater->add_control(
			'icon_background',
			array(
				'label'     => __( 'Icon Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'social_links',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Facebook',
					),
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Twitter',
					),
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Instagram',
					),
				),
				'title_field' => '{{{ social_link_title }}}',
			)
		);

		$this->add_control(
			'member_tooltip',
			array(
				'label'   => __( 'Tooltip', 'amadeus-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'member_tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => __( 'Top', 'amadeus-elementor' ),
					'bottom' => __( 'Bottom', 'amadeus-elementor' ),
				),
				'condition' => array(
					'member_tooltip' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Member', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'member_bg',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'member_border',
				'selector' => '{{WRAPPER}} .amadeus-member-wrap',
			)
		);

		$this->add_responsive_control(
			'member_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_responsive_control(
			'member_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'member_margin',
			array(
				'label'      => __( 'Margin', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_heading',
			array(
				'label'     => __( 'Content', 'amadeus-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Text Alignment', 'amadeus-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_padding',
			array(
				'label'      => __( 'Content Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => __( 'Image', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'image_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-member-wrap .amadeus-member-image',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_control(
			'image_spacing',
			array(
				'label'     => __( 'Spacing', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			array(
				'label' => __( 'Name', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .amadeus-member-wrap .amadeus-member-name',
			)
		);

		$this->add_responsive_control(
			'name_spacing',
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
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_role',
			array(
				'label' => __( 'Role', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-role' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'role_typography',
				'selector' => '{{WRAPPER}} .amadeus-member-wrap .amadeus-member-role',
			)
		);

		$this->add_responsive_control(
			'role_spacing',
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
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			array(
				'label' => __( 'Text', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .amadeus-member-wrap .amadeus-member-description',
			)
		);

		$this->add_responsive_control(
			'text_spacing',
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
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			array(
				'label' => __( 'Social Icon', 'amadeus-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icons_bg',
			array(
				'label'     => __( 'Icons Background', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'icons_wrap_padding',
			array(
				'label'      => __( 'Icons Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_icons_style' );

		$this->start_controls_tab(
			'tab_icons_normal',
			array(
				'label' => __( 'Normal', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'icons_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icons_hover',
			array(
				'label' => __( 'Hover', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'icons_hover_background',
			array(
				'label'     => __( 'Background Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_hover_color',
			array(
				'label'     => __( 'Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'amadeus-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'icons_border',
				'label'       => __( 'Border', 'amadeus-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'icons_border_radius',
			array(
				'label'      => __( 'Border Radius', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icons_padding',
			array(
				'label'      => __( 'Padding', 'amadeus-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 150,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icons_indent',
			array(
				'label'     => __( 'Icon Spacing', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-member-wrap .amadeus-member-icons a:first-child' => 'margin-left: 0;',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$title_tag = $settings['title_html_tag'];

		$this->add_render_attribute( 'wrap', 'class', 'amadeus-member-wrap' ); ?>

		<div <?php $this->print_render_attribute_string( 'wrap' ); ?>>

			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				?>
				<div class="amadeus-member-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' ) ); ?>
				</div>
				<?php
			}
			?>

			<div class="amadeus-member-content">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					?>
					<<?php echo esc_attr( $title_tag ); ?> class="amadeus-member-name">
						<?php echo wp_kses_post( $settings['name'] ); ?>
					</<?php echo esc_attr( $title_tag ); ?>>
					<?php
				}
				?>

				<?php
				if ( ! empty( $settings['role'] ) ) {
					?>
					<span class="amadeus-member-role"><?php $this->print_unescaped_setting( 'role' ); ?></span>
					<?php
				}
				?>

				<?php
				if ( ! empty( $settings['description'] ) ) {
					?>
					<div class="amadeus-member-description"><?php $this->print_unescaped_setting( 'description' ); ?></div>
					<?php
				}
				?>
			</div>

			<div class="amadeus-member-icons">
				<?php
				foreach ( $settings['social_links'] as $index => $item ) :
					$link = $this->get_repeater_setting_key( 'links', 'social_links', $index );

					$this->add_render_attribute( $link, 'href', esc_url( $item['social_link'] ) );

					$this->add_render_attribute(
						$link,
						array(
							'class' => array(
								'amadeus-member-icon',
								'elementor-repeater-item-' . $item['_id'],
							),
						)
					);

					if ( 'yes' === $settings['member_tooltip'] ) {
						$tooltip_position = $settings['member_tooltip_position'];

						$this->add_render_attribute(
							$link,
							array(
								'class'                 => array(
									'amadeus-member-tooltip',
									'amadeus-tooltip-' . $tooltip_position,
								),
								'title'                 => $item['social_link_title'],
								'data-tooltip-position' => $tooltip_position,
							)
						);
					}

					$this->add_render_attribute( $link, 'target', '_blank' );
					?>

					<a <?php $this->print_render_attribute_string( $link ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</a>
					<?php
				endforeach;
				?>
			</div>
		</div>

		<?php
	}

	protected function content_template() {
		?>
		<#
		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		var imageUrl = elementor.imagesManager.getImageUrl( image ); #>
		<div class="amadeus-member-wrap">

			<# if ( imageUrl ) { #>
				<div class="amadeus-member-image">
					<img src="{{ imageUrl }}">
				</div>
			<# } #>

			<div class="amadeus-member-content">
				<# if ( settings.name ) { #>
					<{{settings.title_html_tag}} class="amadeus-member-name">
						{{{ settings.name }}}
					</{{settings.title_html_tag}}>
				<# } #>

				<# if ( settings.role ) { #>
					<span class="amadeus-member-role">{{{ settings.role }}}</span>
				<# } #>

				<# if ( settings.description ) { #>
					<div class="amadeus-member-description">{{{ settings.description }}}</div>
				<# } #>
			</div>

			<div class="amadeus-member-icons">
				<# _.each( settings.social_links, function( item, index ) {
					var link = view.getRepeaterSettingKey( 'links', 'social_links', index ),
						iconHTML = elementor.helpers.renderIcon( view, item.social_icon, { 'aria-hidden': true }, 'i' , 'object' );

					view.addRenderAttribute( link, 'href', item.social_link );
					view.addRenderAttribute( link, 'class', 'amadeus-member-icon' );
					view.addRenderAttribute( link, 'class', 'elementor-repeater-item-' + item._id );

					if ( 'yes' === settings.member_tooltip ) {
						var tooltipPosition = settings.member_tooltip_position;

						view.addRenderAttribute( link, 'class', 'amadeus-member-tooltip' );
						view.addRenderAttribute( link, 'class', 'amadeus-tooltip-' + tooltipPosition );
						view.addRenderAttribute( link, 'title', item.social_link_title );
						view.addRenderAttribute( link, 'data-tooltip-position', 'amadeus-tooltip-' + tooltipPosition );
					}

					view.addRenderAttribute( link, 'target', '_blank' ); #>

					<a {{{ view.getRenderAttributeString( link ) }}}>
						{{{ iconHTML.value }}}
					</a>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}
