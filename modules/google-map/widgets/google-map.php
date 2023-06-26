<?php
namespace AmadeusElementor\Modules\GoogleMap\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Google_Map extends Widget_Base {

	public function get_name() {
		return 'amadeus-google-map';
	}

	public function get_title() {
		return __( 'Google Maps', 'amadeus-elementor' );
	}

	public function get_icon() {
		return 'amadeus-icon amadeus-map-marker';
	}

	public function get_categories() {
		return [ 'amadeus-elements' ];
	}

	public function get_keywords() {
		return [
			'google',
			'map',
			'amadeus',
		];
	}

	public function get_script_depends() {
		return [ 'amadeus-google-map-api', 'amadeus-google-map' ];
	}

	public function get_style_depends() {
		return [ 'amadeus-google-map' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_google_map',
			[
				'label'         => __( 'Addresses', 'amadeus-elementor' ),
			]
		);

		$api_key = get_option( 'amadeus_google_maps_api_key' );

		if ( ! $api_key ) {
			$this->add_control(
				'set_key',
				[
					'type'      => Controls_Manager::RAW_HTML,
					'raw'   => sprintf( __( 'Please set your Google maps API key on the %1$ssettings page%2$s', 'amadeus-elementor' ), '<a href="' . add_query_arg( array( 'page' => 'amadeus-settings' ), esc_url( admin_url( 'admin.php' ) ) ) . '" target="_blank">', '</a>' ),
				]
			);
		}

		$repeater = new Repeater();

		$repeater->add_control(
			'map_latitude',
			[
				'name'              => 'map_latitude',
				'label'             => __( 'Latitude', 'amadeus-elementor' ),
				'description'       => sprintf( '<a href="https://www.latlong.net/" target="_blank">%1$s</a> %2$s', __( 'Click here', 'amadeus-elementor' ), __( 'to find Latitude and Longitude of your location', 'amadeus-elementor' ) ),
				'type'              => Controls_Manager::TEXT,
				'label_block'       => true,
				'dynamic'           => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'map_longitude',
			[
				'name'              => 'map_longitude',
				'label'             => __( 'Longitude', 'amadeus-elementor' ),
				'description'       => sprintf( '<a href="https://www.latlong.net/" target="_blank">%1$s</a> %2$s', __( 'Click here', 'amadeus-elementor' ), __( 'to find Latitude and Longitude of your location', 'amadeus-elementor' ) ),
				'type'              => Controls_Manager::TEXT,
				'label_block'       => true,
				'dynamic'            => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'map_title',
			[
				'name'              => 'map_title',
				'label'             => __( 'Address Title', 'amadeus-elementor' ),
				'type'              => Controls_Manager::TEXT,
				'default'           => '',
				'label_block'       => true,
				'dynamic'           => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'map_marker_infowindow',
			[
				'name'              => 'map_marker_infowindow',
				'label'             => __( 'Info Window', 'amadeus-elementor' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'no',
				'return_value'      => 'yes',
			]
		);

		$repeater->add_control(
			'map_info_window_open',
			[
				'name'              => 'map_info_window_open',
				'label'             => __( 'Open Info Window on Load', 'amadeus-elementor' ),
				'type'              => Controls_Manager::SWITCHER,
				'default'           => 'yes',
				'conditions'        => [
					'terms' => [
						[
							'name' => 'map_marker_infowindow',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'map_description',
			[
				'name'              => 'map_description',
				'label'             => __( 'Address Description', 'amadeus-elementor' ),
				'type'              => Controls_Manager::TEXTAREA,
				'label_block'       => true,
				'dynamic'           => [
					'active' => true,
				],
				'conditions'        => [
					'terms' => [
						[
							'name' => 'map_marker_infowindow',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'map_marker_icon_type',
			[
				'name'              => 'map_marker_icon_type',
				'label'             => __( 'Marker Icon', 'amadeus-elementor' ),
				'type'              => Controls_Manager::SELECT,
				'default'           => 'default',
				'options'           => [
					'default'     => __( 'Default', 'amadeus-elementor' ),
					'custom'      => __( 'Custom', 'amadeus-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'map_marker_icon',
			[
				'name'              => 'map_marker_icon',
				'label'             => __( 'Custom Marker Icon', 'amadeus-elementor' ),
				'type'              => Controls_Manager::MEDIA,
				'conditions'        => [
					'terms' => [
						[
							'name' => 'map_marker_icon_type',
							'operator' => '==',
							'value' => 'custom',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'map_custom_marker_size',
			[
				'name'              => 'map_custom_marker_size',
				'label'             => __( 'Marker Size', 'amadeus-elementor' ),
				'type'              => Controls_Manager::SLIDER,
				'size_units'        => [ 'px' ],
				'description'       => __( 'Note: If you want to retain the image original size, then set the Marker Size as blank.', 'amadeus-elementor' ),
				'default'           => [
					'size' => 30,
					'unit' => 'px',
				],
				'range'             => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'conditions'        => [
					'terms' => [
						[
							'name'     => 'map_marker_icon_type',
							'operator' => '==',
							'value'    => 'custom',
						],
					],
				],
			]
		);

		$this->add_control(
			'amadeus_map_addresses',
			[
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'map_latitude'      => 40.617340,
						'map_longitude'     => -74.011828,
						'map_title'         => __( 'New York', 'amadeus-elementor' ),
						'map_description'   => __( 'Add your description here', 'amadeus-elementor' ),
					],
				],
				'title_field' => '<i class="fas fa-map-marker-alt"></i> {{{ map_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_settings',
			[
				'label'         => __( 'Settings', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'map_zoom',
			[
				'label'         => __( 'Zoom Level', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 10,
				],
				'range'         => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
			]
		);

		$this->add_control(
			'map_type',
			[
				'label'         => __( 'Map Type', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'roadmap',
				'options'       => [
					'roadmap'      => __( 'Road Map', 'amadeus-elementor' ),
					'satellite'    => __( 'Satellite', 'amadeus-elementor' ),
					'hybrid'       => __( 'Hybrid', 'amadeus-elementor' ),
					'terrain'      => __( 'Terrain', 'amadeus-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'marker_animation',
			[
				'label'         => __( 'Marker Animation', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '',
				'options'       => [
					''         => __( 'None', 'amadeus-elementor' ),
					'drop'     => __( 'Drop', 'amadeus-elementor' ),
					'bounce'   => __( 'Bounce', 'amadeus-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_controls',
			[
				'label'         => __( 'Controls', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'map_option_streeview',
			[
				'label'         => __( 'Street View Controls', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'label_on'      => __( 'On', 'amadeus-elementor' ),
				'label_off'     => __( 'Off', 'amadeus-elementor' ),
				'return_value'  => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'map_type_control',
			[
				'label'         => __( 'Map Type Control', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'label_on'      => __( 'On', 'amadeus-elementor' ),
				'label_off'     => __( 'Off', 'amadeus-elementor' ),
				'return_value'  => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'zoom_control',
			[
				'label'         => __( 'Zoom Control', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'label_on'      => __( 'On', 'amadeus-elementor' ),
				'label_off'     => __( 'Off', 'amadeus-elementor' ),
				'return_value'  => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'fullscreen_control',
			[
				'label'         => __( 'Fullscreen Control', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'label_on'      => __( 'On', 'amadeus-elementor' ),
				'label_off'     => __( 'Off', 'amadeus-elementor' ),
				'return_value'  => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'map_scroll_zoom',
			[
				'label'         => __( 'Scroll Wheel Zoom', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'label_on'      => __( 'On', 'amadeus-elementor' ),
				'label_off'     => __( 'Off', 'amadeus-elementor' ),
				'return_value'  => 'yes',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_theme',
			[
				'label'         => __( 'Map Style', 'amadeus-elementor' ),
			]
		);

		$this->add_control(
			'map_theme',
			[
				'label'         => __( 'Map Theme', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'standard',
				'options'       => [
					'standard'     => __( 'Standard', 'amadeus-elementor' ),
					'silver'       => __( 'Silver', 'amadeus-elementor' ),
					'retro'        => __( 'Retro', 'amadeus-elementor' ),
					'dark'         => __( 'Dark', 'amadeus-elementor' ),
					'night'        => __( 'Night', 'amadeus-elementor' ),
					'aubergine'    => __( 'Aubergine', 'amadeus-elementor' ),
					'custom'       => __( 'Custom', 'amadeus-elementor' ),
				],
			]
		);

		$this->add_control(
			'map_custom_style',
			[
				'label'         => __( 'Custom Style', 'amadeus-elementor' ),
				'description'   => sprintf( '<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s', __( 'Click here', 'amadeus-elementor' ), __( 'to get JSON style code to style your map', 'amadeus-elementor' ) ),
				'type'          => Controls_Manager::TEXTAREA,
				'condition'     => [
					'map_theme' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_style',
			[
				'label'         => __( 'Map', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'map_width',
			[
				'label'         => __( 'Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px', '%' ],
				'default'       => [
					'size' => 100,
					'unit' => '%',
				],
				'range'         => [
					'px' => [
						'min' => 100,
						'max' => 1920,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-google-map' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'map_height',
			[
				'label'         => __( 'Height', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => [ 'px' ],
				'default'       => [
					'size' => 500,
					'unit' => 'px',
				],
				'range'         => [
					'px' => [
						'min' => 80,
						'max' => 1200,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .amadeus-google-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_info_window_style',
			[
				'label'         => __( 'Info Window', 'amadeus-elementor' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'map_align',
			[
				'label'         => __( 'Alignment', 'amadeus-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'        => [
						'title'   => __( 'Left', 'amadeus-elementor' ),
						'icon'    => 'eicon-h-align-left',
					],
					'center'      => [
						'title'   => __( 'Center', 'amadeus-elementor' ),
						'icon'    => 'eicon-h-align-center',
					],
					'right'       => [
						'title'   => __( 'Right', 'amadeus-elementor' ),
						'icon'    => 'eicon-h-align-right',
					],
				],
				'default'       => '',
				'selectors'     => [
					'{{WRAPPER}} .amadeus-google-map' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'iw_max_width',
			[
				'label'         => __( 'Info Window Max Width', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size' => 240,
				],
				'range'         => [
					'px'        => [
						'min'   => 40,
						'max'   => 500,
						'step'  => 1,
					],
				],
			]
		);

		$this->add_responsive_control(
			'info_padding',
			[
				'label'         => __( 'Padding', 'amadeus-elementor' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .gm-style .amadeus-infowindow-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'         => __( 'Title', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gm-style .amadeus-infowindow-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'         => __( 'Bottom Spacing', 'amadeus-elementor' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'{{WRAPPER}} .gm-style .amadeus-infowindow-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'title_typography',
				'selector'      => '{{WRAPPER}} .gm-style .amadeus-infowindow-title',
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'         => __( 'Description', 'amadeus-elementor' ),
				'type'          => Controls_Manager::HEADING,
				'separator'     => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'         => __( 'Color', 'amadeus-elementor' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .gm-style .amadeus-infowindow-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'description_typography',
				'selector'      => '{{WRAPPER}} .gm-style .amadeus-infowindow-description',
			]
		);

		$this->end_controls_section();

	}

	protected function get_map_styles() {
		$map_styles = array(
			'silver' => '[{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]',
			'retro' => '[{"elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}]',
			'dark' => '[{"elementType":"geometry","stylers":[{"color":"#212121"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#212121"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#757575"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#181818"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"poi.park","elementType":"labels.text.stroke","stylers":[{"color":"#1b1b1b"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#8a8a8a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#373737"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#3c3c3c"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#3d3d3d"}]}]',
			'night' => '[{"elementType":"geometry","stylers":[{"color":"#242f3e"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#746855"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#242f3e"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#263c3f"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#6b9a76"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#38414e"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#212a37"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#9ca5b3"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#746855"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#1f2835"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#f3d19c"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2f3948"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#17263c"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#515c6d"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#17263c"}]}]',
			'aubergine' => '[{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0e1626"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}]',
		);

		return $map_styles;
	}

	protected function render() {
		$settings = $this->get_settings();
		$map_styles = $this->get_map_styles();

		$i = 1;

		$this->add_render_attribute( 'google-map', [
			'id'     => 'amadeus-google-map-' . esc_attr( $this->get_id() ),
			'class'  => 'amadeus-google-map',
		] );

		if ( ! empty( $settings['map_zoom']['size'] ) ) {
			$this->add_render_attribute( 'google-map', 'data-zoom', $settings['map_zoom']['size'] );
		}

		if ( $settings['iw_max_width']['size'] ) {
			$this->add_render_attribute( 'google-map', 'data-iw-max-width', $settings['iw_max_width']['size'] );
		}

		if ( 'standard' !== $settings['map_theme'] ) {
			if ( 'custom' !== $settings['map_theme'] ) {
				$this->add_render_attribute( 'google-map', 'data-custom-style', $map_styles[ $settings['map_theme'] ] );
			} elseif ( ! empty( $settings['map_custom_style'] ) ) {
				$this->add_render_attribute( 'google-map', 'data-custom-style', $settings['map_custom_style'] );
			}
		}

		$amadeus_map_locations = array();

		foreach ( $settings['amadeus_map_addresses'] as $index => $item ) {

			$amadeus_map_location = array(
				$item['map_latitude'],
				$item['map_longitude'],
			);

			if ( 'yes' === $item['map_marker_infowindow'] ) {
				$amadeus_map_location[] = 'yes';
			} else {
				$amadeus_map_location[] = '';
			}

			$amadeus_map_location[] = $item['map_title'];
			$amadeus_map_location[] = $item['map_description'];

			if ( 'custom' === $item['map_marker_icon_type']
				&& '' !== $item['map_marker_icon']['url'] ) {
				$amadeus_map_location[] = 'custom';
				$amadeus_map_location[] = $item['map_marker_icon']['url'];
				$amadeus_map_location[] = $item['map_custom_marker_size']['size'];
			} else {
				$amadeus_map_location[] = '';
				$amadeus_map_location[] = '';
				$amadeus_map_location[] = '';
			}

			if ( 'yes' === $item['map_info_window_open'] ) {
				$amadeus_map_location[] = 'iw_open';
			} else {
				$amadeus_map_location[] = '';
			}

			$amadeus_map_locations[] = $amadeus_map_location;
		}

		$this->add_render_attribute( 'google-map', 'data-locations', wp_json_encode( $amadeus_map_locations ) ); ?>

		<div class="amadeus-google-map-wrap">
			<div <?php $this->print_render_attribute_string( 'google-map' ); ?>></div>
		</div>

		<?php
	}

	protected function content_template() { ?>
		<#
			function get_map_styles() {
				return {
					'silver': '[{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]',
					'retro': '[{"elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}]',
					'dark': '[{"elementType":"geometry","stylers":[{"color":"#212121"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#212121"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#757575"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#181818"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"poi.park","elementType":"labels.text.stroke","stylers":[{"color":"#1b1b1b"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#8a8a8a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#373737"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#3c3c3c"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#3d3d3d"}]}]',
					'night': '[{"elementType":"geometry","stylers":[{"color":"#242f3e"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#746855"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#242f3e"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#263c3f"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#6b9a76"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#38414e"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#212a37"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#9ca5b3"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#746855"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#1f2835"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#f3d19c"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2f3948"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#17263c"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#515c6d"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#17263c"}]}]',
					'aubergine': '[{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0e1626"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}]',
				};
			}
		   
			var map_styles = get_map_styles();

			view.addRenderAttribute(
				'google-map',
				{
					'class' : 'amadeus-google-map',
				}
			);
		   
			if ( '' != settings.map_zoom.size ) {
				view.addRenderAttribute( 'google-map', { 'data-zoom' : settings.map_zoom.size } );
			}
		   
			if ( '' != settings.iw_max_width.size ) {
				view.addRenderAttribute( 'google-map', { 'data-iw-max-width' : settings.iw_max_width.size } );
			}

			if ( 'standard' != settings.map_theme ) {
				if ( 'custom' != settings.map_theme ) {
					view.addRenderAttribute( 'google-map', { 'data-custom-style' : map_styles[settings.map_theme] } );
				} else if ( settings.map_custom_style ) {
					view.addRenderAttribute( 'google-map', { 'data-custom-style' : settings.map_custom_style } );
				}
			}
		   
			var amadeus_map_locations = [];

			_.each( settings.amadeus_map_addresses, function( item ) {

				var amadeus_map_location = [ item.map_latitude, item.map_longitude ];
		   
				if ( 'yes' == item.map_marker_infowindow ) {
					amadeus_map_location.push( 'yes' );
				} else {
					amadeus_map_location.push( "" );
				}

				amadeus_map_location.push( item.map_title );
				amadeus_map_location.push( item.map_description );

				if ( 'custom' == item.map_marker_icon_type
					&& '' != item.map_marker_icon.url ) {
					amadeus_map_location.push( 'custom' );
					amadeus_map_location.push( item.map_marker_icon.url );
					amadeus_map_location.push( item.map_custom_marker_size.size );
				} else {
					amadeus_map_location.push( "" );
					amadeus_map_location.push( "" );
					amadeus_map_location.push( "" );
				}

				if ( 'yes' == item.map_info_window_open ) {
					amadeus_map_location.push( 'iw_open' );
				} else {
					amadeus_map_location.push( "" );
				}

				amadeus_map_locations.push( amadeus_map_location );

			});
		   
			view.addRenderAttribute( 'google-map', { 'data-locations' : JSON.stringify( amadeus_map_locations ) } );
		#>

		<div class="amadeus-google-map-container">
			<div {{{ view.getRenderAttributeString( 'google-map' ) }}}></div>
		</div>

		<?php
	}

}
