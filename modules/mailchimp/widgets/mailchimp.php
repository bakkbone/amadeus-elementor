<?php
namespace AmadeusElementor\Modules\Mailchimp\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Mailchimp extends Widget_Base {

	public function get_name() {
		return 'amadeus-mailchimp';
	}

	public function get_title() {
		return __( 'MailChimp', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-mailbox-full';
	}

	public function get_categories() {
		return array( 'amadeus-elements' );
	}

	public function get_keywords() {
		return array(
			'form',
			'newsletter',
			'email',
			'mailchimp',
			'amadeus',
		);
	}

	public function get_script_depends() {
		return array( 'amadeus-mailchimp' );
	}

	public function get_style_depends() {
		return array( 'amadeus-mailchimp' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_form',
			array(
				'label' => __( 'MailChimp Settings', 'amadeus-elementor' ),
			)
		);

		$this->add_control(
			'mailchimp_lists',
			[
				'label'         => __( 'Mailchimp List', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'label_block'   => false,
				'description'   => sprintf( __( 'You need to set your API Key on the %1$ssettings page%2$s', 'amadeus-elementor' ), '<a href="' . add_query_arg( array( 'page' => 'amadeus-settings' ), esc_url( admin_url( 'admin.php' ) ) ) . '" target="_blank">', '</a>' ),
				'options'       => amadeus_mailchimp_lists(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields',
			[
				'label'         => __( 'Fields', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'display_labels',
			[
				'label'         => __( 'Display Labels', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes',
			]
		);

		$this->add_control(
			'display_first_name',
			[
				'label'         => __( 'Enable First Name', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes',
			]
		);

		$this->add_control(
			'first_name_text',
			[
				'label'         => __( 'First Name Label', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'First Name', 'amadeus-elementor' ),
				'condition'     => [
					'display_first_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'display_last_name',
			[
				'label'         => __( 'Enable Last Name', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'return_value'  => 'yes',
			]
		);

		$this->add_control(
			'last_name_text',
			[
				'label'         => __( 'Last Name Label', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'Last Name', 'amadeus-elementor' ),
				'condition'     => [
					'display_last_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_text',
			[
				'label'         => __( 'Email Label', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'Email Address', 'amadeus-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => __( 'Button Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'Subscribe', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'loading_text',
			[
				'label'         => __( 'Loading Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => false,
				'default'       => __( 'Submitting...', 'amadeus-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message',
			[
				'label'         => __( 'Message', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'success_text',
			[
				'label'         => __( 'Success Text', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [
					'active' => true,
				],
				'label_block'   => true,
				'default'       => __( 'You have subscribed successfully!', 'amadeus-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general_style',
			[
				'label'         => __( 'General', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'mailchimp_layout',
			[
				'label'         => __( 'Layout', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'blocks' => __( 'Blocks', 'amadeus-elementor' ),
					'inline' => __( 'Inline', 'amadeus-elementor' ),
				],
				'default'       => 'blocks',

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'          => 'mailchimp_bg',
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'types'         => [ 'none', 'classic', 'gradient' ],
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap',
			]
		);

		$this->add_responsive_control(
			'mailchimp_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mailchimp_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'mailchimp_border',
				'label'         => __( 'Border', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap',
			]
		);

		$this->add_responsive_control(
			'mailchimp_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'mailchimp_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_style',
			[
				'label'         => __( 'Form Fields', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fields_spacing',
			[
				'label'         => __( 'Fields Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap.amadeus-mc-blocks .amadeus-field' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .amadeus-mailchimp-wrap.amadeus-mc-inline .amadeus-form-fields .amadeus-field' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .amadeus-mailchimp-wrap.amadeus-mc-inline .amadeus-form-fields .amadeus-field' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_labels_style',
			[
				'label'         => __( 'Layouts', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'display_labels' => 'yes',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'labels_typography',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field label',
				'condition'     => [
					'display_labels' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'display_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_inputs_style',
			[
				'label'         => __( 'Inputs', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'display_labels' => 'yes',
				],
				'separator'     => 'before',
			]
		);

		$this->add_responsive_control(
			'inputs_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', 'em', '%' ],
				'range'         => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'inputs_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', 'em', '%' ],
				'range'         => [
					'px' => [
						'min' => 30,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'inputs_typography',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input',
			]
		);

		$this->start_controls_tabs( 'tabs_inputs_style' );

		$this->start_controls_tab(
			'tab_inputs_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'inputs_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'inputs_background_hover_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_focus',
			[
				'label'         => __( 'Focus', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'inputs_background_focus_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_focus_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_focus_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'inputs_placeholder_color',
			[
				'label'         => __( 'Placeholder Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
				'separator'     => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'inputs_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input',
			]
		);

		$this->add_control(
			'inputs_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'inputs_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input',
			]
		);

		$this->add_responsive_control(
			'inputs_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_btn_style',
			[
				'label'         => __( 'Button', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typography',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'         => __( 'Normal', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'         => __( 'Hover', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'         => __( 'Border Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'button_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-field .amadeus-mc-subscribe' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_msg_style',
			[
				'label'         => __( 'Message', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'msg_typography',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message',
			]
		);

		$this->add_responsive_control(
			'msg_align',
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
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_msg_style' );

		$this->start_controls_tab(
			'tab_success_msg',
			[
				'label'         => __( 'Success', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'success_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message.amadeus-mc-success-text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'success_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message.amadeus-mc-success-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_error_msg',
			[
				'label'         => __( 'Error', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'error_background_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message.amadeus-mc-error-text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_text_color',
			[
				'label'         => __( 'Text Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message.amadeus-mc-error-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'msg_border',
				'placeholder'   => '1px',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message',
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'msg_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'msg_box_shadow',
				'selector'      => '{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message',
			]
		);

		$this->add_responsive_control(
			'msg_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'msg_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-mailchimp-wrap .amadeus-mc-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$api_key    = get_option( 'amadeus_mailchimp_api_key' );
		$mc_layout  = $settings['mailchimp_layout'];
		$labels     = $settings['display_labels'];
		$fn_text    = $settings['first_name_text'];
		$ln_text    = $settings['last_name_text'];
		$e_text     = $settings['email_text'];

		// Layout Class
		if ( 'blocks' === $mc_layout ) {
			$layout = 'amadeus-mc-blocks';
		} elseif ( 'inline' === $mc_layout ) {
			$layout = 'amadeus-mc-inline';
		}

		$this->add_render_attribute( 'wrapper', [
			'class' => [
				'amadeus-mailchimp-wrap',
				esc_attr( $layout ),
			],
			'data-mailchimp-id' => [
				esc_attr( $this->get_id() ),
			],
			'data-api-key' => [
				esc_attr( $api_key ),
			],
			'data-list-id' => [
				$settings['mailchimp_lists'],
			],
			'data-button-text' => [
				$settings['button_text'],
			],
			'data-success-text' => [
				$settings['success_text'],
			],
			'data-loading-text' => [
				$settings['loading_text'],
			],
		] );

		$this->add_render_attribute( 'fields-wrapper', [
			'class' => [
				'amadeus-form-fields',
			],
		] );

		if ( ! empty( $api_key ) ) { ?>

			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<form id="amadeus-mc-form-<?php echo esc_attr( $this->get_id() ); ?>" class="amadeus-mc-form" method="POST">
					<div <?php $this->print_render_attribute_string( 'fields-wrapper' ); ?>>

						<?php
						if ( 'yes' === $settings['display_first_name'] ) { ?>
							<div class="amadeus-field amadeus-mc-fname">
								<?php
								if ( 'yes' === $labels ) { ?>
									<label for="amadeus_mc_fn_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_attr( $fn_text ); ?></label>
									<?php
								} ?>
								<input id="amadeus_mc_fn_<?php echo esc_attr( $this->get_id() ); ?>" type="text" name="amadeus_mc_firstname" class="amadeus-mc-input amadeus-mc-input-fn" placeholder="<?php echo esc_attr( $fn_text ); ?>">
							</div>
							<?php
						}

						if ( 'yes' === $settings['display_last_name'] ) { ?>
							<div class="amadeus-field amadeus-mc-lname">
								<?php
								if ( 'yes' === $labels ) { ?>
									<label for="amadeus_mc_ln_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_attr( $ln_text ); ?></label>
									<?php
								} ?>
								<input id="amadeus_mc_ln_<?php echo esc_attr( $this->get_id() ); ?>" type="text" name="amadeus_mc_lastname" class="amadeus-mc-input amadeus-mc-input-ln" placeholder="<?php echo esc_attr( $ln_text ); ?>">
							</div>
							<?php
						} ?>

						<div class="amadeus-field amadeus-mc-email">
							<?php
							if ( 'yes' === $labels ) { ?>
								<label for="amadeus_mc_e_<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_attr( $e_text ); ?></label>
								<?php
							} ?>
							<input id="amadeus_mc_e_<?php echo esc_attr( $this->get_id() ); ?>" type="email" name="amadeus_mc_email" class="amadeus-mc-input amadeus-mc-input-email" placeholder="<?php echo esc_attr( $e_text ); ?>" required="required">
						</div>

						<div class="amadeus-field amadeus-mc-submit">
							<button type="submit" id="amadeus-subscribe-<?php echo esc_attr( $this->get_id() ); ?>" class="amadeus-button amadeus-mc-subscribe">
								<div class="amadeus-btn-loader"></div>
								<span><?php echo esc_attr( $settings['button_text'] ); ?></span>
							</button>
						</div>

					</div>
					<div class="amadeus-mc-message"></div>
				</form>
			</div>

			<?php
		} else { ?>
			<p class="amadeus-mc-error"><?php echo esc_html__( 'Please ensure your API key has been added in settings, and you have selected a list in this widget\'s settings.', 'amadeus-elementor' ); ?></p>
			<?php
		}

	}

	/**
	 * Render Call to Action widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		var mcLayout    = settings.mailchimp_layout,
			layout      = '',
			labels      = settings.display_labels,
			fnText      = settings.first_name_text,
			lnText      = settings.last_name_text,
			eText       = settings.email_text;

		// Layout Class
		if ( 'blocks' == mcLayout ) {
			layout = 'amadeus-mc-blocks';
		} else if ( 'inline' == mcLayout ) {
			layout = 'amadeus-mc-inline';
		}

		view.addRenderAttribute( 'wrapper', 'class', [ 'amadeus-mailchimp-wrap', layout ] );
		view.addRenderAttribute( 'fields-wrapper', 'class', 'amadeus-form-fields' );

		if ( ! _.isEmpty( settings.mailchimp_lists ) ) { #>

			<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
				<form id="amadeus-mc-form" class="amadeus-mc-form" method="POST">
					<div {{{ view.getRenderAttributeString( 'fields-wrapper' ) }}}>

						<# if ( 'yes' === settings.display_first_name ) { #>
							<div class="amadeus-field amadeus-mc-fname">
								<# if ( 'yes' === labels ) { #>
									<label for="amadeus_mc_fn">{{{ fnText }}}</label>
								<# } #>
								<input id="amadeus_mc_fn" type="text" name="amadeus_mc_firstname" class="amadeus-mc-input amadeus-mc-input-fn" placeholder="{{{ fnText }}}">
							</div>
						<# } #>

						<# if ( 'yes' === settings.display_last_name ) { #>
							<div class="amadeus-field amadeus-mc-lname">
								<# if ( 'yes' === labels ) { #>
									<label for="amadeus_mc_ln">{{{ lnText }}}</label>
								<# } #>
								<input id="amadeus_mc_ln" type="text" name="amadeus_mc_lastname" class="amadeus-mc-input amadeus-mc-input-ln" placeholder="{{{ lnText }}}">
							</div>
						<# } #>

						<div class="amadeus-field amadeus-mc-email">
							<# if ( 'yes' === labels ) { #>
								<label for="amadeus_mc_e">{{{ eText }}}</label>
							<# } #>
							<input id="amadeus_mc_e" type="email" name="amadeus_mc_email" class="amadeus-mc-input amadeus-mc-input-email" placeholder="{{{ eText }}}" required="required">
						</div>

						<div class="amadeus-field amadeus-mc-submit">
							<button type="submit" id="amadeus-subscribe" class="amadeus-button amadeus-mc-subscribe">
								<div class="amadeus-btn-loader"></div>
								<span>{{{ settings.button_text }}}</span>
							</button>
						</div>

					</div>
					<div class="amadeus-mc-message"></div>
				</form>
			</div>

		<# } else { #>
			<p class="amadeus-mc-error"><?php echo esc_html__( 'Please ensure your API key has been added in settings, and you have selected a list in this widget\'s settings.', 'amadeus-elementor' ); ?></p>
		<# } #>

		<?php
	}

}
