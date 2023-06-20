<?php
/**
 * Widgets tab
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

<div id="widgets" class="amadeus-elements amadeus-widgets">
	<div class="row">
		<div class="amadeus-top">
			<p><?php esc_html_e( 'You can choose to Activate or Deactivate all widgets at once by clicking the buttons below', 'amadeus-elementor' ); ?></p>
			<div class="amadeus-buttons">
				<button type="button" class="amadeus-btn-enable"><span class="dashicons dashicons-yes"></span><span><?php esc_html_e( 'Enable All', 'amadeus-elementor' ); ?></span></button>
				<button type="button" class="amadeus-btn-disable"><span class="dashicons dashicons-no-alt"></span><span><?php esc_html_e( 'Disable All', 'amadeus-elementor' ); ?></span></button>
			</div>
		</div>
		<div class="amadeus-container">
			<?php
			foreach ( $GLOBALS['amadeus_widgets'] as $widget => $val ) :
				?>
				<div class="amadeus-block amadeus-checkbox">
					<div class="amadeus-widgets-info">
						<p class="amadeus-widget-title"><?php echo esc_attr( $val['title'] ); ?></p>
						<?php
						if ( ! empty( $val['demo_link'] ) ) {
							?>
							<a class="amadeus-widget-link amadeus-demo-link" href="<?php echo esc_url( $val['demo_link'] ); ?>" target="_blank" data-text="<?php esc_html_e( 'Widget Demo', 'amadeus-elementor' ); ?>">
								<img src="<?php echo plugins_url( '/assets/admin/img/demo.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-demo">
							</a>
							<?php
						}
						?>
					</div>
					<input type="checkbox" name="<?php echo esc_attr( $widget ); ?>" id="<?php echo esc_attr( $widget ); ?>" <?php echo checked( 1, $this->get_widgets_option( $widget ), false ); ?>>
					<label for="<?php echo esc_attr( $widget ); ?>"></label>
				</div>
				<?php
			endforeach;
			?>
		</div>
		<p class="submit">
			<button type="button" class="button amadeus-btn amadeus-btn-js"><span><?php esc_html_e( 'Save Settings', 'amadeus-elementor' ); ?></span><span class="dashicons dashicons-arrow-<?php echo esc_attr( $icon ); ?>-alt"></span></button>
		</p>
	</div>
</div>
