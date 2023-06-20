<?php
namespace AmadeusElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use \Elementor\Plugin;

// Elementor Classes
use \Elementor\Controls_Manager;

/**
 * Main Plugin Class
 *
 * Register elementor widget.
 *
 * @since 1.0.0
 */
class AmadeusElementorPlugin {

	/**
	 * @var Manager
	 */
	public $modules_manager;

	/**
	 * @var Plugin
	 */
	private static $instance;
	/**
	 * @var Module_Base[]
	 */
	private $modules = array();

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );

		add_action( 'elementor/init', array( $this, 'init' ), 0 );
		add_action( 'elementor/init', array( $this, 'init_panel_section' ), 0 );
		add_action( 'elementor/elements/categories_registered', array( $this, 'init_panel_section' ) );

		// Modules to enqueue styles
		$this->modules = array(
			'accordion',
			'advanced-heading',
			'alert',
			'animated-heading',
			'banner',
			'blog-carousel',
			'blog-grid',
			'brands',
			'business-hours',
			'buttons',
			'call-to-action',
			'circle-progress',
			'content-protection',
			'countdown',
			'flip-box',
			'google-map',
			'hotspots',
			'image-comparison',
			'image-gallery',
			'info-box',
			'instagram',
			'logo',
			'mailchimp',
			'member',
			'member-carousel',
			'modal',
			'navbar',
			'off-canvas',
			'price-list',
			'pricing-table',
			'recipe',
			'scroll-up',
			'search',
			'search-icon',
			'skillbar',
			'table',
			'tabs',
			'testimonial',
			'testimonial-carousel',
			'timeline',
			'toggle',
			'woo-addtocart',
			'woo-products',
			'woo-slider',
			'woo-categories',
		);
	}

	/**
	 * Autoload Classes
	 *
	 * @since 1.0.0
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					array( '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '', '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$class_to_load
				)
			);
			$filename = AMADEUS_ELEMENTOR_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include $filename;
			}
		}
	}

	/**
	 * Init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init() {

		// Elementor hooks
		$this->add_actions();

		// Include extensions
		$this->includes();

		// Components
		$this->init_components();

		do_action( 'amadeus_elementor/init' );
	}

	/**
	 * Plugin instance
	 *
	 * @since 1.0.0
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Front-end Scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );

		// Load some widgets CSS on front end to avoid styling issues
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widgets_styles' ] );

		// Preview Styles
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

		// Editor Style
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
	}

	/**
	 * Register scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_scripts() {

		$ajax_url = admin_url( 'admin-ajax.php' );
		$amadeus_nonce = wp_create_nonce( 'amadeus' );
		$dir_name = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$map_api = get_option( 'amadeus_google_maps_api_key' );

		// Register vendors scripts.
		wp_register_script(
			'asPieProgress',
			AMADEUS_ASSETS_URL . 'js/vendors/asPieProgress.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'event-move',
			AMADEUS_ASSETS_URL . 'js/vendors/event.move.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_register_script(
			'twentytwenty',
			AMADEUS_ASSETS_URL . 'js/vendors/twentytwenty.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_register_script(
			'imagesloaded',
			AMADEUS_ASSETS_URL . 'js/vendors/imagesloaded.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'morphext',
			AMADEUS_ASSETS_URL . 'js/vendors/morphext.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_register_script(
			'typed',
			AMADEUS_ASSETS_URL . 'js/vendors/typed.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'popper',
			AMADEUS_ASSETS_URL . 'js/vendors/popper.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_register_script(
			'tippy',
			AMADEUS_ASSETS_URL . 'js/vendors/tippy-bundle.umd.min.js',
			array(),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		// Register widgets scripts.
		if ( isset( $map_api ) && ! empty( $map_api ) ) {
			wp_register_script(
				'amadeus-google-map-api',
				'https://maps.googleapis.com/maps/api/js?key=' . $map_api,
				'',
				rand()
			);
		} else {
			wp_register_script(
				'amadeus-google-map-api',
				'https://maps.googleapis.com/maps/api/js',
				'',
				rand()
			);
		}

		wp_register_script(
			'amadeus-accordion',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/accordion' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-alert',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/alert' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-animated-heading',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/animated-heading' . $suffix . '.js',
			array( 'elementor-frontend', 'morphext', 'typed' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-blog-carousel',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/blog-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-blog-grid',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/blog-grid' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-circle-progress',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/circle-progress' . $suffix . '.js',
			array( 'elementor-frontend', 'asPieProgress' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-countdown',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/countdown' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-google-map',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/google-map' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-hotspots',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/hotspots' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-image-comparison',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/image-comparison' . $suffix . '.js',
			array( 'elementor-frontend', 'event-move', 'twentytwenty', 'imagesloaded' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-member',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/member' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-member-carousel',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/member-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-menu',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/menu' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-modal',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/modal' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-navbar',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/navbar' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-mailchimp',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/mailchimp' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_localize_script(
			'amadeus-mailchimp',
			'localize',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $amadeus_nonce,
			)
		);

		wp_register_script(
			'amadeus-off-canvas',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/off-canvas' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-pricing-table',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/pricing-table' . $suffix . '.js',
			array( 'elementor-frontend', 'popper', 'tippy' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-scroll-up',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/scroll-up' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-search-icon',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/search-icon' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-search',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/search' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);
		wp_localize_script(
			'amadeus-search',
			'searchData',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $amadeus_nonce,
			)
		);

		wp_register_script(
			'amadeus-skillbar',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/skillbar' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-tabs',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/tabs' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-testimonial-carousel',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/testimonial-carousel' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-toggle',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/toggle' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-tooltip',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/tooltip' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

		wp_register_script(
			'amadeus-woo-slider',
			AMADEUS_ASSETS_URL . 'js/' . $dir_name . '/woo-slider' . $suffix . '.js',
			array( 'elementor-frontend' ),
			AMADEUS_ELEMENTOR_VERSION,
			true
		);

	}

	/**
	 * Register styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_styles() {
		$dir_name = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// General style (match all themes).
		wp_enqueue_style( 'amadeus-general', AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/general' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );

		// Vendors.
		wp_register_style( 'tippy', AMADEUS_ASSETS_URL . 'css/vendors/tippy/tippy.css', array(), '6.3.1', 'all' );

		// Widgets.
		foreach ( $this->modules as $module_name ) {
			wp_register_style(
				'amadeus-' . $module_name . '',
				AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/' . $module_name . $suffix . '.css',
				array(),
				AMADEUS_ELEMENTOR_VERSION
			);
		}

	}

	/**
	 * Load some widgets CSS on front end to avoid styling issues
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function widgets_styles() {
		$dir_name = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'amadeus-menu', AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/menu' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );
		wp_enqueue_style( 'amadeus-site-breadcrumbs', AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/site-breadcrumbs' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );
		wp_enqueue_style( 'amadeus-page-title', AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/page-title' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );

		// Only load if WooCommerce activated
		if ( is_woocommerce_active() ) {
			wp_enqueue_style( 'amadeus-woo-menu-cart', AMADEUS_ASSETS_URL . 'css/' . $dir_name . '/woo-menu-cart' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );
		}
	}

	/**
	 * Enqueue styles in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function preview_styles() {

		foreach ( $this->modules as $module_name ) {
			wp_enqueue_style( 'amadeus-' . $module_name . '' );
		}

	}

	/**
	 * Enqueue style in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function editor_style() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'amadeus-elementor-editor', AMADEUS_ASSETS_URL . 'admin/css/editor' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );
		wp_enqueue_style( 'amadeus-icons', AMADEUS_ASSETS_URL . 'admin/css/amadeus-icons.css', array(), AMADEUS_ELEMENTOR_VERSION );
	}

	/**
	 * Include components
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		// Modules
		include_once AMADEUS_ELEMENTOR_PATH . 'includes/managers/modules.php';

	}

	/**
	 * Sections init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init_panel_section() {
		// Add element category in panel
		Plugin::instance()->elements_manager->add_category(
			'amadeus-elements',
			array(
				'title' => '<i class="amadeus-main-icon amadeus-mozart" aria-hidden="true"></i>' . __( 'Amadeus Elements', 'amadeus-elementor' ),
			),
			1
		);
	}

	/**
	 * Components init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function init_components() {
		$this->modules_manager = new Modules_Manager();
	}
}

if ( ! defined( 'AMADEUS_ELEMENTOR_TESTS' ) ) {
	// In tests we run the instance manually.
	AmadeusElementorPlugin::instance();
}
