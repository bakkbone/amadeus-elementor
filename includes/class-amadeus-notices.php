<?php
/**
 * Builds our notices.
 *
 * @package Amadeus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Amadeus_Notices {

	/**
	 * The admin notices key.
	 */
	const ADMIN_NOTICES_KEY = 'amadeus_admin_notices';

	/**
	 * Member Variable
	 *
	 * @var object instance
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'review_notice' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_amadeus_set_admin_notice_viewed', array( $this, 'ajax_set_admin_notice_viewed' ) );
	}

	/**
	 * Get install time.
	 *
	 * @return int Unix timestamp when Amadeus was installed.
	 */
	private function get_install_time( $source ) {
		$time = get_option( $source . '_amadeus_installed_time' );
		if ( ! $time ) {
			$time = time();
			update_option( $source . '_amadeus_installed_time', $time );
		}
		return $time;
	}

	/**
	 * Add a review notice
	 *
	 * @access public
	 */
	public function review_notice() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$notice_id = 'amadeus_review_notice';

		if ( $this->is_user_notice_viewed( $notice_id ) ) {
			return;
		}

		// Show notice after 1 week from installed time.
		if ( strtotime( '+1 week', $this->get_install_time( $notice_id ) ) > time() ) {
			return;
		}

		$dismiss_url = add_query_arg( [
			'action' => 'amadeus_set_admin_notice_viewed',
			'notice_id' => esc_attr( $notice_id ),
		], admin_url( 'admin-post.php' ) );
		?>
		<div class="notice amadeus-notice amadeus-review-notice amadeus-dismiss-notice" data-notice_id="<?php echo esc_attr( $notice_id ); ?>">
			<div class="amadeus-notice-icon">
				<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m29.911 13.75-6.229 6.072 1.471 8.576c.064.375-.09.754-.398.978-.174.127-.381.191-.588.191-.159 0-.319-.038-.465-.115l-7.702-4.049-7.701 4.048c-.336.178-.745.149-1.053-.076-.308-.224-.462-.603-.398-.978l1.471-8.576-6.23-6.071c-.272-.266-.371-.664-.253-1.025s.431-.626.808-.681l8.609-1.25 3.85-7.802c.337-.683 1.457-.683 1.794 0l3.85 7.802 8.609 1.25c.377.055.69.319.808.681s.019.758-.253 1.025z"/></svg>
			</div>
			<div class="amadeus-notice-content">
				<p><?php esc_html_e( 'Thanks for using Amadeus Elementor! Could you please do us a huge favor and give it a 5-star rating on WordPress.org to help us spread the word and boost our motivation?', 'amadeus-elementor' ); ?></p>
				<p><strong>– Team BAKKBONE</strong></p>

				<div class="amadeus-notice-buttons">
					<a href="https://wordpress.org/support/plugin/amadeus-elementor/reviews/?filter=5#new-post" rel="nofollow" target="_blank"><?php esc_html_e( 'Yes, you deserve it!', 'amadeus-elementor' ); ?></a>
					<a href="<?php echo esc_url_raw( $dismiss_url ); ?>" class="amadeus-notice-dismiss"><?php esc_html_e( 'I already have', 'amadeus-elementor' ); ?></a>
				</div>
			</div>
			<button type="button" class="notice-dismiss amadeus-notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'amadeus-elementor' ); ?></span></button>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'amadeus-notice', AMADEUS_ASSETS_URL . 'admin/css/notice' . $suffix . '.css', array(), AMADEUS_ELEMENTOR_VERSION );
		wp_enqueue_script( 'amadeus-notice', AMADEUS_ASSETS_URL . 'admin/js/notice' . $suffix . '.js', array(), AMADEUS_ELEMENTOR_VERSION, true );
	
		wp_localize_script(
			'amadeus-notice',
			'amadeusNotice',
			apply_filters(
				'amadeus_localize_js_notice',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
				)
			)
		);
	}

	/**
	 * Get user notices.
	 *
	 * Retrieve the list of notices for the current user.
	 *
	 * @access private
	 * @static
	 *
	 * @return array A list of user notices.
	 */
	private static function get_user_notices() {
		return get_user_meta( get_current_user_id(), self::ADMIN_NOTICES_KEY, true );
	}

	/**
	 * Is user notice viewed.
	 *
	 * Whether the notice was viewed by the user.
	 *
	 * @access public
	 * @static
	 *
	 * @param int $notice_id The notice ID.
	 *
	 * @return bool Whether the notice was viewed by the user.
	 */
	public static function is_user_notice_viewed( $notice_id ) {
		$notices = self::get_user_notices();

		if ( empty( $notices ) || empty( $notices[ $notice_id ] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Set admin notice as viewed.
	 *
	 * Flag the user admin notice as viewed using an authenticated ajax request.
	 *
	 * Fired by `wp_ajax_amadeus_set_admin_notice_viewed` action.
	 *
	 * @access public
	 * @static
	 */
	public static function ajax_set_admin_notice_viewed() {
		if ( empty( $_REQUEST['notice_id'] ) ) {
			wp_die();
		}

		$notices = self::get_user_notices();
		if ( empty( $notices ) ) {
			$notices = [];
		}

		$notices[ $_REQUEST['notice_id'] ] = 'true';
		update_user_meta( get_current_user_id(), self::ADMIN_NOTICES_KEY, $notices );

		if ( ! wp_doing_ajax() ) {
			wp_safe_redirect( admin_url() );
			die;
		}

		wp_die();
	}
}
Amadeus_Notices::get_instance();
