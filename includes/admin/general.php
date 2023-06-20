<?php
/**
 * General tab
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="general" class="amadeus-elements amadeus-general active">

	<div class="row">

		<div class="amadeus-container">

			<div class="amadeus-block amadeus-inner">
				<div class="amadeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/documentation.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Documentation', 'amadeus-elementor' ); ?></h4>
				<div class="amadeus-content">
					<p><?php esc_html_e( 'Get familiar with all of our Amadeus Elementor widgets by exploring its extensive documentation which explains everything you need to know to build awesome websites.', 'amadeus-elementor' ); ?></p>
					<a href="https://www.amadeus-elementor.com/documentation/" class="amadeus-btn" target="_blank"><?php esc_html_e( 'Documentation', 'amadeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="amadeus-block amadeus-inner">
				<div class="amadeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/support.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Need Help?', 'amadeus-elementor' ); ?></h4>
				<div class="amadeus-content">
					<p><?php echo sprintf( __( 'A widget issue? Don&#039;t worry! You can reach our free support through the %1$sWordPress Forum%2$s, ask the community on the %3$sCommunity Forums%2$s or directly reach our awesome %4$ssupport team%2$s who are always here to help you.', 'amadeus-elementor' ), '<a href="https://wordpress.org/support/plugin/amadeus-elementor/" target="_blank">', '</a>', '<a href="https://www.amadeus-elementor.com/community/" target="_blank">', '<a href="https://help.bkbn.au/new/" target="_blank">' ); ?></p>
					<a href="https://wordpress.org/support/plugin/amadeus-elementor/" class="amadeus-btn" target="_blank"><?php esc_html_e( 'Support', 'amadeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="amadeus-block amadeus-inner">
				<div class="amadeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/love.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Show your Love', 'amadeus-elementor' ); ?></h4>
				<div class="amadeus-content">
					<p><?php esc_html_e( 'Thanks for being part of the Amadeus family! Now it is time to show us some love by sharing the word and if you can take only 1 minute of your time to rate it 5 stars on WordPress, that will encourage users to follow your path', 'amadeus-elementor' ); ?></p>
					<a href="https://wordpress.org/support/plugin/amadeus-elementor/reviews/?filter=5" class="amadeus-btn" target="_blank"><?php esc_html_e( 'Leave a review', 'amadeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="amadeus-block amadeus-inner">
				<div class="amadeus-block-icon">
					<img src="<?php echo plugins_url( '/assets/admin/img/donation.svg', AMADEUS_ELEMENTOR__FILE__ ); ?>" alt="amadeus-documentation">
				</div>

				<h4><?php esc_html_e( 'Make a Donation', 'amadeus-elementor' ); ?></h4>
				<div class="amadeus-content">
					<p><?php esc_html_e( 'As you&#039;ve probably noticed, Amadeus Elementor has no limitations, it is completely free and we want it to stay that way. If you want to help us, please think about making a small donation, it would mean the world to us and will encourage us to offer you many great updates in the future!', 'amadeus-elementor' ); ?></p>
					<a href="https://www.amadeus-elementor.com/donate/" class="amadeus-btn" target="_blank"><?php esc_html_e( 'Make a donation', 'amadeus-elementor' ); ?></a>
				</div>
			</div>

			<div class="amadeus-block amadeus-inner">
				<h4><?php esc_html_e( 'Acknowledgement', 'amadeus-elementor' ); ?></h4>
				<div class="amadeus-content">
					<p><?php wp_kses_post(_e( 'This plugin is a fork of UranusWP\'s <em>Zeus Elementor</em> – our thanks to the UranusWP team.', 'amadeus-elementor' )); ?></p>
				</div>
			</div>

		</div>

	</div>
</div>