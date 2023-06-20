<?php
namespace AmadeusElementor\Modules\Instagram\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Instagram extends Widget_Base {

	public function get_name() {
		return 'amadeus-instagram';
	}

	public function get_title() {
		return __( 'Instagram', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-camera3';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'instagram',
			'social',
			'insta',
			'feed',
			'gallery',
			'amadeus',
		];
	}

	public function get_style_depends() {
		return [ 'amadeus-instagram' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_instagram_token',
			[
				'label'         => __( 'Token', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'access_token',
			[
				'label'         => __( 'Access Token', 'amadeus-elementor' ),
				'description'   => '<a href="https://plugins.bkbn.au/docs/amadeus/widgets/get-instagram-access-token/" target="_blank">'.__( 'Get Access Token', 'amadeus-elementor' ).'</a>',
				'type'          => Controls_Manager::TEXT,
				'label_block'   => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label'         => __( 'Settings', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'data_cache_limit',
			[
				'label'         => __( 'Data Cache Time', 'amadeus-elementor' ),
				'description'   => __( 'Cache expiration time (Minutes)', 'amadeus-elementor' ),
				'type'          => Controls_Manager::NUMBER,
				'min'           => 1,
				'default'       => 60,
			]
		);

		$this->add_control(
			'images_count',
			[
				'label'         => __( 'Images Count', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 12,
				],
				'range'         => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'         => __( 'Columns', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '5',
				'options'       => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-item' => 'width: calc( 100% / {{VALUE}} );',
				],
			]
		);

		$this->add_control(
			'force_square',
			[
				'label'        => __( 'Force Square Image?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_responsive_control(
			'square_image_size',
			[
				'label'     => __( 'Image Dimension (px)', 'amadeus-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 200,
				],
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .amadeus-insta.amadeus-insta-square .amadeus-insta-img' => 'width: 100%; height: {{SIZE}}{{UNIT}}; object-fit: cover;',
				],
				'condition' => [
					'force_square' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_heading',
			[
				'label'         => __( 'Header', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'header',
			[
				'label'        => __( 'Display Header', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'avatar',
			[
				'label'         => __( 'Choose Avatar', 'amadeus-elementor' ),
				'type'          => Controls_Manager::MEDIA,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'avatar_img',
				'label'         => __( 'Image Resolution', 'amadeus-elementor' ),
				'default'       => 'thumbnail',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'username',
			[
				'label'         => __( 'Username', 'amadeus-elementor' ),
				'description'   => __( 'Override your username', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'bio',
			[
				'label'         => __( 'Biography', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'I am a text block. Click edit button to change this text.', 'amadeus-elementor' ),
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label'        => __( 'Enable Button', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'         => __( 'Button Text', 'amadeus-elementor' ),
				'default'       => __( 'Follow on Instagram', 'amadeus-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'header' => 'yes',
					'button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_target',
			[
				'label'        => __( 'Open in new window?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'header' => 'yes',
					'button' => 'yes',
				],
			]
		);

		$this->add_control(
			'items_heading',
			[
				'label'         => __( 'Items', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'overlay',
			[
				'label'        => __( 'Enable Overlay', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'link',
			[
				'label'        => __( 'Enable Link', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'        => __( 'Open in new window?', 'amadeus-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'link' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general',
			[
				'label'         => __( 'General', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wrap_color',
			[
				'label'         => __( 'Background Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'wrap_border',
				'selector'      => '{{WRAPPER}} .amadeus-insta',
			]
		);

		$this->add_responsive_control(
			'wrap_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wrap_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'         => __( 'Items', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'border',
				'selector'      => '{{WRAPPER}} .amadeus-insta .amadeus-insta-item-inner',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header',
			[
				'label'         => __( 'Header', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'header_img_size',
			[
				'label'          => __( 'Avatar Size', 'amadeus-elementor' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [ 'size' => 75 ],
				'range'          => [
					'px' => [
						'min'  => 10,
						'max'  => 300,
						'step' => 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'      => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'username_title',
			[
				'label'         => __( 'Username', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'username_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-username, {{WRAPPER}} .amadeus-insta .amadeus-insta-username a' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'username_typo',
				'selector'      => '{{WRAPPER}} .amadeus-insta .amadeus-insta-username',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'bio_title',
			[
				'label'         => __( 'Biography', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-desc' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'bio_typo',
				'selector'      => '{{WRAPPER}} .amadeus-insta .amadeus-insta-desc',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_follow',
			[
				'label'         => __( 'Follow Button', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'button_typo',
				'selector'      => '{{WRAPPER}} .amadeus-insta .amadeus-insta-button a',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'button_shadow',
				'label'         => __( 'Box Shadow', 'amadeus-elementor' ),
				'selector'      => '{{WRAPPER}} .amadeus-insta .amadeus-insta-button a',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'amadeus-elementor' ),
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'amadeus-elementor' ),
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_hover_bg',
			[
				'label'         => __( 'Background', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a:hover' => 'background-color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a:hover' => 'color: {{VALUE}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before',
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_margin',
			[
				'label'         => __( 'Margin', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'         => __( 'Border Radius', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'     => [
					'header' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay',
			[
				'label'         => __( 'Overlay', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'         => __( 'Overlay Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-item .amadeus-insta-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => __( 'Icon Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .amadeus-insta .amadeus-insta-item .amadeus-insta-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	private function render_items() {
		$settings   = $this->get_settings_for_display();
		$url        = 'https://graph.instagram.com/me';
		$token      = $settings['access_token'];
		$cache      = $settings['data_cache_limit'];
		$info_key   = 'amadeus_insta_info_' . md5( str_replace( '.', '_', $token ) . $cache );
		$media_key  = 'amadeus_insta_' . md5( str_replace( '.', '_', $token ) . $cache );
		$html       = '';

		// Get info
		if ( get_transient( $info_key ) === false ) {
			$request_args = array(
				'timeout' => 10,
			);
			$get_info = wp_remote_retrieve_body( wp_remote_get( $url . '?fields=id,username&access_token=' . $token, $request_args ) );
			$info_json = json_decode( $get_info, true );

			if ( ! empty( $info_json['data'] ) ) {
				set_transient( $info_key, $get_info, ( $cache * MINUTE_IN_SECONDS ) );
			}
		} else {
			$get_info = get_transient( $info_key );
		}

		// Get media
		if ( get_transient( $media_key ) === false ) {
			$request_args = array(
				'timeout' => 10,
			);
			$get_media = wp_remote_retrieve_body( wp_remote_get( $url . '/media/?fields=username,id,caption,media_type,media_url,permalink,thumbnail_url,timestamp&limit=200&access_token=' . $token, $request_args ) );
			$media_json = json_decode( $get_media, true );

			if ( ! empty( $media_json['data'] ) ) {
				set_transient( $media_key, $get_media, ( $cache * MINUTE_IN_SECONDS ) );
			}
		} else {
			$get_media = get_transient( $media_key );
		}

		$get_info = json_decode( $get_info, true );
		$get_media = json_decode( $get_media, true );

		if ( empty( $get_media['data'] ) ) {
			return;
		}

		// Username
		$username = $settings['username'];
		if ( ! empty( $username ) ) {
			$name = $username;
		} else {
			$name = $get_info['username'];
		}

		// If link
		$link = '';
		$end_link = '';
		$link_target = ( $settings['button_target'] ) ? 'target=_blank' : 'target=_self';
		if ( 'yes' === $settings['button'] ) {
			$link = '<a href="https://www.instagram.com/' . esc_attr( $get_info['username'] ) . '" ' . esc_attr( $link_target ) . '>';
			$end_link = '</a>';
		}

		$items = array_splice( $get_media['data'], ( 0 * $settings['images_count']['size'] ), $settings['images_count']['size'] );

		$icon = '<svg aria-hidden="true" aria-label="Instagram" data-icon="instagram" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>';

		if ( 'yes' === $settings['header'] ) {
			$html .= '<div class="amadeus-insta-header">';

			$html .= '<div class="amadeus-insta-left">';

			if ( ! empty( $settings['avatar']['url'] ) ) {
				$html .= '<div class="amadeus-insta-avatar">' . wp_kses_post( $link ) . wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'avatar' ) ) . wp_kses_post( $end_link ) . '</div>';
			}

			$html .= '<div class="amadeus-insta-details">';
			$html .= '<h3 class="amadeus-insta-username">' . wp_kses_post( $link ) . esc_attr( $name ) . wp_kses_post( $end_link ) . '</h3>';

			if ( ! empty( $settings['bio'] ) ) {
				$html .= '<p class="amadeus-insta-desc">' . wp_kses_post( $settings['bio'] ) . '</p>';
			}

			$html .= '</div>';

			$html .= '</div>';

			if ( 'yes' === $settings['button'] ) {
				$html .= '<div class="amadeus-insta-button">' . wp_kses_post( $link ) . $icon . '<span>' . esc_attr( $settings['button_text'] ) . '</span>' . wp_kses_post( $end_link ) . '</div>';
			}

			$html .= '</div>';
		}

		$html .= '<div class="amadeus-insta-pictures">';
		foreach ( $items as $item ) {
			if ( 'yes' === $settings['link'] ) {
				$target = ( $settings['link_target'] ) ? 'target=_blank' : 'target=_self';
				$tag = 'a';
				$link = ' href="' . $item['permalink'] . '" ' . esc_attr( $target );
			} else {
				$tag = 'div';
				$link = '';
			}

			$image_src = ( 'VIDEO' === $item['media_type'] ) ? $item['thumbnail_url'] : $item['media_url'];

			$html .= '<' . esc_attr( $tag ) . wp_kses_post( $link ) . ' class="amadeus-insta-item">';
			$html .= '<div class="amadeus-insta-item-inner">';
			if ( 'CAROUSEL_ALBUM' === $item['media_type'] ) {
				$html .= '<div class="amadeus-insta-gallery-icon"><svg aria-hidden="true" data-icon="clone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48zM362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6zm96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6z"></path></svg></div>';
			}
			$html .= '<img class="amadeus-insta-img" src="' . esc_attr( $image_src ) . '">';
			if ( 'yes' === $settings['overlay'] ) {
				$html .= '<div class="amadeus-insta-icon">' . $icon . '</div>';
			}
			$html .= '</div>';
			$html .= '</' . esc_attr( $tag ) . '>';
		}
		$html .= '</div>';

		return $html;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'insta-wrap', [
			'class' => [
				'amadeus-insta',
			],
			'id' => 'amadeus-insta-' . $this->get_id(),
		] );

		if ( 'yes' === $settings['force_square'] ) {
			$this->add_render_attribute( 'insta-wrap', 'class', 'amadeus-insta-square' );
		} ?>

		<div <?php $this->print_render_attribute_string( 'insta-wrap' ); ?>>
			<?php echo $this->render_items(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>

		<?php
	}
}
