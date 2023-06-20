<?php
/**
 * Integrations tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get option
$header = get_option( 'amadeus_header' );
$footer = get_option( 'amadeus_footer' );

// Return library templates array
$templates  = get_posts(
	array(
		'post_type' => 'elementor_library',
		'numberposts' => -1,
		'post_status' => 'publish',
	)
);

$header_any_selected = $header ? '' : ' selected';
$footer_any_selected = $footer ? '' : ' selected';

?>

<div id="header-footer" class="amadeus-elements amadeus-header-footer">
	<div class="row">
		<div class="amadeus-top">
			<p><?php esc_html_e( 'You can use this feature to assign Elementor Templates as headers and footers.', 'amadeus-elementor' ); ?></p>
		</div>
		<div class="amadeus-container">
			<div class="amadeus-block amadeus-setting amadeus-header">
				<label for="amadeus-header-template"><?php esc_html_e( 'Select Your Header', 'amadeus-elementor' ); ?></label>
				<select class="amadeus-select2" id="amadeus-header-template" name="amadeus-header-template">
					<option value="" disabled<?php echo esc_html($header_any_selected); ?>><?php '&mdash; ' . esc_html_e( 'Select a header...', 'amadeus-elementor' ) . ' &mdash;'; ?></option>
					<?php
					if ( ! empty( $templates ) ) {
						foreach ( $templates as $template ) {
							$selected = $header == $template->ID ? 'selected' : '';
							echo '<option value="' . esc_attr( $template->ID ) . '" ' . esc_html( $selected ) . '>' . esc_html( $template->post_title ) . '</option>';
						}
					} ?>
				</select>

				<p class="description"><?php echo sprintf( esc_html__( 'Select your header created in %1$sElementor Templates%2$s for your entire site.', 'amadeus-elementor' ), '<a href="' . add_query_arg( array( 'post_type' => 'elementor_library' ), esc_url( admin_url( 'edit.php' ) ) ) . '" target="_blank">', '</a>' ); ?>
				</p>
			</div>

			<div class="amadeus-block amadeus-setting amadeus-footer">
				<label for="amadeus-footer-template"><?php esc_html_e( 'Select Your Footer', 'amadeus-elementor' ); ?></label>
				<select class="amadeus-select2" id="amadeus-footer-template" name="amadeus-footer-template">
					<option value="" disabled<?php echo esc_html($footer_any_selected); ?>><?php '&mdash; ' . esc_html_e( 'Select a footer...', 'amadeus-elementor' ) . ' &mdash;'; ?></option>
					<?php
					if ( ! empty( $templates ) ) {
						foreach ( $templates as $template ) {
							$selected = $footer == $template->ID ? 'selected' : '';
							echo '<option value="' . esc_attr( $template->ID ) . '" ' . esc_html( $selected ) . '>' . esc_html( $template->post_title ) . '</option>';
						}
					} ?>
				</select>
				<p class="description"><?php echo sprintf( esc_html__( 'Select your footer created in %1$sElementor Templates%2$s for your entire site.', 'amadeus-elementor' ), '<a href="' . add_query_arg( array( 'post_type' => 'elementor_library' ), esc_url( admin_url( 'edit.php' ) ) ) . '" target="_blank">', '</a>' ); ?>
			</div>
		</div>
		<p class="submit">
			<button type="button" class="button amadeus-btn amadeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'amadeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>
	</div>
</div>
