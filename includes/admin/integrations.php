<?php
/**
 * Integrations tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_RTL() ) {
	$icon = 'left';
} else {
	$icon = 'right';
} ?>

<div id="integrations" class="amadeus-elements amadeus-integrations">

	<div class="row">

		<div class="amadeus-container">

			<div class="amadeus-block amadeus-setting">
				<label for="mailchimp_api_key"><?php esc_html_e( 'MailChimp API Key', 'amadeus-elementor' ); ?></label>
				<input name="mailchimp_api_key" type="text" id="mailchimp_api_key" value="<?php echo esc_attr( get_option( 'amadeus_mailchimp_api_key' ) ); ?>" class="regular-text">
				<p class="description"><?php echo sprintf( esc_html__( 'Used for the MailChimp widget. %1$sFollow this article%2$s to get your API Key.', 'amadeus-elementor' ), '<a href="https://plugins.bkbn.au/docs/amadeus/widgets/get-your-mailchimp-api-key-and-choose-your-list-id/" target="_blank">', '</a>' ); ?></p>
			</div>

			<div class="amadeus-block amadeus-setting">
				<label for="google_maps_api_key"><?php esc_html_e( 'Google Maps API Key', 'amadeus-elementor' ); ?></label>
				<input name="google_maps_api_key" type="text" id="google_maps_api_key" value="<?php echo esc_attr( get_option( 'amadeus_google_maps_api_key' ) ); ?>" class="regular-text">
				<p class="description"><?php echo sprintf( esc_html__( 'Used for the Google Maps widget. %1$sFollow this article%2$s to get your API Key.', 'amadeus-elementor' ), '<a href="https://plugins.bkbn.au/docs/amadeus/widgets/get-your-google-maps-api-key/" target="_blank">', '</a>' ); ?></p>
			</div>

		</div>

		<p class="submit">
			<button type="button" class="button amadeus-btn amadeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'amadeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>

	</div>
</div>
