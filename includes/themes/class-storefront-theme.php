<?php
/**
 * Storefront theme
 */

class Amadeus_Storefront_Theme {
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
			add_action( 'storefront_before_header', 'amadeus_render_header' );
		}

		if ( amadeus_footer_enabled() ) {
			add_action( 'template_redirect', [ $this, 'setup_footer' ] );
			add_action( 'storefront_after_footer', 'amadeus_render_footer' );
		}

		if ( amadeus_header_enabled() || amadeus_footer_enabled() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'styles' ] );
		}
	}

	/**
	 * Disable header from the theme.
	 */
	public function setup_header() {
		for ( $priority = 0; $priority < 200; $priority ++ ) {
			remove_all_actions( 'storefront_header', $priority );
		}
	}

	/**
	 * Disable footer from the theme.
	 */
	public function setup_footer() {
		for ( $priority = 0; $priority < 200; $priority ++ ) {
			remove_all_actions( 'storefront_footer', $priority );
		}
	}

	/**
	 * Add inline CSS to hide empty divs for header and footer
	 */
	public function styles() {
		$css = '';

		if ( true === amadeus_header_enabled() ) {
			$css .= '.site-header { display: none; }';
		}

		if ( true === amadeus_footer_enabled() ) {
			$css .= '.site-footer { display: none; }';
		}

		wp_add_inline_style( 'storefront-style', $css );
	}

}
Amadeus_Storefront_Theme::get_instance();
