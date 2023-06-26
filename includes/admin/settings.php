<?php
/**
 * Settings page
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Amadeus_Settings {

	/**
	 * Start things up
	 */
	public function __construct() {
		// Add footer text.
		add_filter( 'admin_footer_text', [ $this, 'admin_footer_text' ], 99 );

		// Add panel menu
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 0 );

		// Add scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'admin_head', [ $this, 'admin_head' ] );

		// Save settings
		if ( is_admin() ) {
			add_action( 'wp_ajax_amadeus_save_settings', [ $this, 'save_settings' ] );
		}
	}

	/**
	 * Admin footer text.
	 *
	 * Modifies the "Thank you" text displayed in the admin footer.
	 *
	 * Fired by `admin_footer_text` filter.
	 *
	 * @since 1.0.4
	 * @access public
	 *
	 * @param string $footer_text The content that will be printed.
	 *
	 * @return string The content that will be printed.
	 */
	public function admin_footer_text( $footer_text ) {
		$current_screen = get_current_screen();
		$is_ae_screen = ( $current_screen && false !== strpos( $current_screen->id, 'amadeus' ) );

		if ( $is_ae_screen ) {
			$footer_text = sprintf(
				/* translators: 1: Amadeus Elementor, 2: Link to plugin review */
				__( 'Enjoyed %1$s? Please leave us a %2$s rating. We really appreciate your support!', 'amadeus-elementor' ),
				'<strong>' . esc_html__( 'Amadeus Elementor', 'amadeus-elementor' ) . '</strong>',
				'<a href="https://wordpress.org/support/plugin/amadeus-elementor/reviews/?filter=5" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
			);
		}

		return $footer_text;
	}

	/**
	 * Registers a new menu page
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Amadeus Elementor', 'amadeus-elementor' ),
			__( 'Amadeus Elementor', 'amadeus-elementor' ),
			'manage_options',
			'amadeus-settings',
			[ $this, 'settings_page' ],
			plugins_url( '/assets/admin/img/amadeus.svg', AMADEUS_ELEMENTOR__FILE__ ),
			'58.6'
		);
	}

	/**
	 * Loading all essential scripts
	 *
	 * @since 1.0.0
	 */
	public function admin_enqueue_scripts( $hook ) {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'amadeus-elementor-admin-icon', plugins_url( '/assets/admin/css/icon.min.css', AMADEUS_ELEMENTOR__FILE__ ) );

		if ( isset( $hook ) && 'toplevel_page_amadeus-settings' === $hook ) {
			// Admin style
			wp_enqueue_style( 'amadeus-elementor-admin', plugins_url( '/assets/admin/css/style' . $suffix . '.css', AMADEUS_ELEMENTOR__FILE__ ) );

			// Admin script
			wp_enqueue_script( 'amadeus-elementor-admin', plugins_url( '/assets/admin/js/admin' . $suffix . '.js', AMADEUS_ELEMENTOR__FILE__ ), array( 'jquery', 'popper', 'tippy' ), AMADEUS_ELEMENTOR_VERSION, true );

			// Tooltip
			wp_register_script( 'popper', plugins_url( '/assets/js/vendors/popper.min.js', AMADEUS_ELEMENTOR__FILE__ ), array(), AMADEUS_ELEMENTOR_VERSION, true );
			wp_register_script( 'tippy', plugins_url( '/assets/js/vendors/tippy-bundle.umd.min.js', AMADEUS_ELEMENTOR__FILE__ ), array(), AMADEUS_ELEMENTOR_VERSION, true );

			// JS string translation
			$texts = [
				'saving'    => __( 'Saving Data...', 'amadeus-elementor' ),
				'saved'     => __( 'Settings Saved!', 'amadeus-elementor' ),
				'error'     => __( 'Oops... Something went wrong!', 'amadeus-elementor' ),
			];

			wp_localize_script( 'amadeus-elementor-admin', 'localize', array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'nonce'     => wp_create_nonce( 'amadeus-elementor' ),
				'lang'      => $texts,
			) );
		}
	}
	
	/**
	 * Loading select2
	 *
	 * @since 2.0.0
	 */
	public function admin_head(){
		$current_screen = get_current_screen();
		$is_ae_screen = ( $current_screen && false !== strpos( $current_screen->id, 'amadeus' ) );
		
		if($is_ae_screen){
			?>
			<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					jQuery('.amadeus-select2').select2({
						selectionCssClass: 'amadeus-select2-span'
					});
				});
			</script>
			<?php
		}
	}

	/**
	 * Create settings page.
	 *
	 * @since 1.0.0
	 */
	public function settings_page() {

		if ( is_RTL() ) {
			$icon = 'left';
		} else {
			$icon = 'right';
		} ?>

		<div class="amadeus-settings-wrap">

			<div id="amadeus-top-bar-wrap">
				<div class="amadeus-top-bar">
					<div class="amadeus-top-bar-main">
						<div class="amadeus-top-bar-logo">
							<div><img src="<?php echo plugins_url( '/assets/admin/img/amadeus.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-top-bar"></div>
							<h1><?php echo esc_html__( 'Amadeus Elementor', 'amadeus-elementor' ); ?></h1>
						</div>
					</div>

					<div class="amadeus-top-bar-second">
						<button type="submit" class="button amadeus-btn amadeus-btn-js"><span><?php echo esc_html__( 'Save Settings', 'amadeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
					</div>
				</div>
			</div>

			<form id="amadeus-settings" action="options.php" method="POST">

				<div class="amadeus-settings-tabs">
					<ul class="amadeus-tabs">
						<li>
							<a href="#general" class="active">
								<img src="<?php echo plugins_url( '/assets/admin/img/general.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-general-settings">
								<span><?php echo esc_html__( 'General', 'amadeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#widgets">
								<img src="<?php echo plugins_url( '/assets/admin/img/widgets.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-widgets">
								<span><?php echo esc_html__( 'Widgets', 'amadeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#integrations">
								<img src="<?php echo plugins_url( '/assets/admin/img/integrations.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-integrations">
								<span><?php echo esc_html__( 'Integrations', 'amadeus-elementor' ); ?></span>
							</a>
						</li>
						<li>
							<a href="#header-footer">
								<img src="<?php echo plugins_url( '/assets/admin/img/header-footer.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-header-footer">
								<span><?php echo esc_html__( 'Header/Footer', 'amadeus-elementor' ); ?></span>
							</a>
						</li>
					</ul>
					<?php
					include_once AMADEUS_ELEMENTOR_PATH . '/includes/admin/general.php';
					include_once AMADEUS_ELEMENTOR_PATH . '/includes/admin/widgets.php';
					include_once AMADEUS_ELEMENTOR_PATH . '/includes/admin/integrations.php';
					include_once AMADEUS_ELEMENTOR_PATH . '/includes/admin/header-footer.php'; ?>
				</div>

			</form>

		</div>

	<?php
	}

	/**
	 * Saving data with ajax request
	 *
	 * @since 1.0.0
	 */
	public function save_settings() {
		check_ajax_referer( 'amadeus-elementor', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( esc_html__('You are not allowed to do this action', 'amadeus-elementor' ) );
		}

		if ( ! isset( $_POST['fields'] ) ) {
			return;
		}

		parse_str( $_POST['fields'], $settings );

		// Saving MailChimp API Key
		if ( isset( $settings['mailchimp_api_key'] ) ) {
			update_option( 'amadeus_mailchimp_api_key', sanitize_text_field( $settings['mailchimp_api_key'] ) );
		}

		// Saving Google Maps API Key
		if ( isset( $settings['google_maps_api_key'] ) ) {
			update_option( 'amadeus_google_maps_api_key', sanitize_text_field( $settings['google_maps_api_key'] ) );
		}

		// Save header
		if ( isset( $settings['amadeus-header-template'] ) ) {
			update_option( 'amadeus_header', sanitize_text_field( $settings['amadeus-header-template'] ) );
		}

		// Save footer
		if ( isset( $settings['amadeus-footer-template'] ) ) {
			update_option( 'amadeus_footer', sanitize_text_field( $settings['amadeus-footer-template'] ) );
		}

		// Widgets checkboxes
		$defaults = array_fill_keys( array_keys( $GLOBALS['amadeus_widgets'] ), false );
		$elements = array_merge( $defaults, array_fill_keys( array_keys( array_intersect_key( $settings, $defaults ) ), true ) );

		// Update new settings
		$updated = update_option( 'amadeus_settings', $elements );

		// Return the validated/sanitized options
		wp_send_json( $updated );
	}

	/**
	 * Get option.
	 *
	 * @since 1.0.0
	 * */
	public function get_widgets_option( $option = null ) {
		$defaults = array_fill_keys( array_keys( $GLOBALS['amadeus_widgets'] ), true );
		$options = get_option( 'amadeus_settings', $defaults );
		$options = array_merge( $defaults, $options );

		return ( isset( $option ) ? ( isset( $options[$option] ) ? $options[$option] : 0 ) : array_keys( array_filter( $options ) ) );
	}

	/**
	 * Elementor templates post type.
	 *
	 * @since 1.0.0
	 * */
	public function get_templates() {

		// Return library templates array
		$templates      = array( '&mdash; ' . esc_html__( 'Select', 'amadeus-elementor' ) . ' &mdash;' );
		$get_templates  = get_posts(
			array(
				'post_type' => 'elementor_library',
				'numberposts' => -1,
				'post_status' => 'publish',
			)
		);

		if ( ! empty( $get_templates ) ) {
			foreach ( $get_templates as $template ) {
				$templates[ $template->ID ] = $template->post_title;
			}
		}

		return $templates;

	}

}
new Amadeus_Settings();
