<?php
/**
 * OceanWP theme
 */

class Amadeus_OceanWP_Theme {
	private static $instance = null;

	/**
	 * Instance.
	 *
	 * @return object Class object.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initiator
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'hooks' ] );
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( amadeus_header_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_header' ] );
			add_action( 'ocean_header', 'amadeus_render_header' );
		}

		if ( amadeus_footer_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_footer' ] );
			add_action( 'ocean_footer', 'amadeus_render_footer' );
		}
	}

	/**
	 * Disable header from the theme.
	 */
	public function setup_header() {
		remove_action( 'ocean_top_bar', 'oceanwp_top_bar_template' );
		remove_action( 'ocean_header', 'oceanwp_header_template' );
		remove_action( 'ocean_page_header', 'oceanwp_page_header_template' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function setup_footer() {
		remove_action( 'ocean_footer', 'oceanwp_footer_template' );
	}

}
Amadeus_OceanWP_Theme::get_instance();
