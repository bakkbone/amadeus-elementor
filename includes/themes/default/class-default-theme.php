<?php
/**
 * Default theme
 */

class Amadeus_Default_Theme {

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
			// Replace header.php template.
			add_action( 'get_header', [ $this, 'override_header' ] );

			// Add our header.
			add_action( 'amadeus_header', 'amadeus_render_header' );
		}

		if ( amadeus_footer_enabled() ) {
			// Replace footer.php template.
			add_action( 'get_footer', [ $this, 'override_footer' ] );

			// Add our footer.
			add_action( 'amadeus_footer', 'amadeus_render_footer' );
		}
	}

	/**
	 * Function for overriding the header.
	 */
	public function override_header() {
		require AMADEUS_ELEMENTOR_PATH . 'includes/themes/default/header.php';
		$templates   = [];
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	/**
	 * Function for overriding the footer.
	 */
	public function override_footer() {
		require AMADEUS_ELEMENTOR_PATH . 'includes/themes/default/footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

}

new Amadeus_Default_Theme();