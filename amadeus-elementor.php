<?php
/**
 * Plugin Name:					Amadeus Elementor
 * Plugin URI:					https://www.amadeus-elementor.com/
 * Description:					Provides a collection of powerful, fully customizable, and extendable widgets on top of any Elementor version and works independently with any WordPress theme.
 * Version:						2.0.0
 * Requires at least:			6.0
 * Requires PHP:				7.4
 * Author:						BAKKBONE Australia
 * Author URI:					https://www.bakkbone.com.au/
 * License:						GNU General Public License (GPL) 3.0 or later
 * License URI:					https://www.gnu.org/licenses/gpl.html
 * Tested up to:				6.2.2
 * WC tested up to:				7.8.0
 * Elementor tested up to:		3.14.0
 * Elementor Pro tested up to:	3.14.0
 * Text Domain:					amadeus-elementor
 * Domain Path:					/lang
 * 
 * This plugin is a fork of UranusWP's now-defunct "Zeus Elementor".
**/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Amadeus_Elementor to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Amadeus_Elementor
 */
function amadeus_elementor() {
	return Amadeus_Elementor::instance();
}
amadeus_elementor();

/**
 * Main Amadeus_Elementor Class
 *
 * @class Amadeus_Elementor
 * @version 1.0.0
 * @since 1.0.0
 * @package Amadeus_Elementor
 */
final class Amadeus_Elementor {
	/**
	 * Amadeus_Elementor The single instance of Amadeus_Elementor.
	 *
	 * @var     object
	 * @access  private
	 * @since   1.0.0
	 */
	private static $instance = null;

	/**
	 * The token.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 *
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Current theme template.
	 *
	 * @var String
	 */
	public $template;

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token        = 'amadeus-elementor';
		$this->plugin_url   = plugin_dir_url( __FILE__ );
		$this->plugin_path  = plugin_dir_path( __FILE__ );
		$this->version      = '2.0.0';
		$this->template     = get_template();

		define( 'AMADEUS_ELEMENTOR__FILE__', __FILE__ );
		define( 'AMADEUS_ELEMENTOR_PATH', $this->plugin_path );
		define( 'AMADEUS_URL', plugins_url( '/', AMADEUS_ELEMENTOR__FILE__ ) );
		define( 'AMADEUS_ASSETS_URL', AMADEUS_URL . 'assets/' );
		define( 'AMADEUS_ELEMENTOR_VERSION', $this->version );

		if($this->is_zeus_still_here()){
			add_action( 'init', array( $this, 'thrill_kratos' ) );
		}
		
		add_action('init', array($this, 'please_kratos'));
		
		// If Elementor is not activated.
		if(!in_array('elementor/elementor.php', apply_filters("active_plugins", get_option("active_plugins")))){
			add_action( 'admin_notices', array( $this, 'show_notices' ), 30 );
		} else {
			// Widgets.
			$GLOBALS['amadeus_widgets'] = require_once AMADEUS_ELEMENTOR_PATH . 'widgets.php';

			register_activation_hook( __FILE__, array( $this, 'install' ) );

			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			add_action( 'plugins_loaded', array( $this, 'setup' ) );

			register_activation_hook( __FILE__, array( $this, 'save_widgets_db' ) );

		}
	}
	
	public static function is_zeus_still_here() {
		$file_path = 'zeus-elementor/zeus-elementor.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
	
	public static function please_kratos(){
		if(!get_option('is_kratos_pleased')){
			update_option('amadeus_settings', get_option('zeus_settings'));
			if(get_option('zeus_settings')){
				delete_option('zeus_settings');
			}
			if(get_option('zeus_mailchimp_api_key')){
				update_option('amadeus_mailchimp_api_key', get_option('zeus_mailchimp_api_key'));
				delete_option('zeus_mailchimp_api_key');
			}
			if(get_option('zeus_google_map_api_key')){
				update_option('amadeus_google_maps_api_key', get_option('zeus_google_map_api_key'));
				delete_option('zeus_google_map_api_key');
			}
			if(get_option('zeus_review_notice_zeus_installed_time')){
				delete_option('zeus_review_notice_zeus_installed_time');
			}
			if(get_option('olympus_notice_zeus_installed_time')){
				delete_option('olympus_notice_zeus_installed_time');
			}
			if(get_option('zeus-elementor-version')){
				delete_option('zeus-elementor-version');
			}
			$args = [
				'numberposts'	=> -1,
				'post_type'		=> 'any',
			];
			$posts = get_posts($args);
			foreach($posts as $post){
				$id = $post->ID;
				error_log($id);
				
				$content = wp_kses_post($post->post_content);
				$modifiedcontent = wp_kses_post(preg_replace('/<!-- \.zeus/','<!-- .amadeus', $content));
				
				$newedata = preg_replace('/zeus/', 'amadeus', get_post_meta($id, '_elementor_data', true));
				$ecu = unserialize(get_post_meta($id, '_elementor_controls_usage', true));
				
				$newecu = [];
				foreach($ecu as $k => $v){
					if(preg_match('/zeus/', $k)){
						$kk = preg_replace('/zeus/', 'amadeus', $k);
						$newecu[$kk] = $v;
					} else {
						$newecu[$k] = $v;
					}
				}
				$newecu = serialize($newecu);
				
				$postdata = [
					'ID'			=> $id,
					'post_content'	=> $modifiedcontent,
					'meta_input'	=> [
						'_elementor_data'			=> $newedata,
						'_elementor_controls_usage'	=> $newecu
					]
				];
				wp_update_post($postdata);
			}
			update_option('is_kratos_pleased', 1, true);
		}
	}
	
	public static function thrill_kratos(){
		if(in_array('zeus-elementor/zeus-elementor.php', apply_filters("active_plugins", get_option("active_plugins")))){
			deactivate_plugins('zeus-elementor/zeus-elementor.php');
		}
		if(function_exists('request_filesystem_credentials')){
			$deleted = delete_plugins(['zeus-elementor/zeus-elementor.php']);
			if(is_wp_error($deleted)){
				$msg = $deleted->get_error_messages;
				error_log($msg);
			}
		} else {
			add_filter('all_plugins', function($all_plugins){
				unset($all_plugins['zeus-elementor/zeus-elementor.php']);
				return $all_plugins;
			});
			add_filter('plugin_action_links_amadeus-elementor/amadeus-elementor.php', function($links){
					$format = '<a href="%1$s" title="%2$s">%3$s</a>';
					return array_merge(
						$links,
						array(
							'<span class="delete">'.sprintf(
								$format,
								wp_nonce_url( 'plugins.php?action=delete-selected&verify-delete=1&checked=zeus-elementor%2Fzeus-elementor.php', 'bulk-plugins' ),
								__('Delete Zeus Elementor (Recommended)', 'amadeus-elementor'),
								__('Delete Zeus Elementor (Recommended)', 'amadeus-elementor')
							).'</span>'
						)
					);
			}, 10, 1);
		}
	}

	/**
	 * Main Amadeus_Elementor Instance.
	 *
	 * Ensures only one instance of Amadeus_Elementor is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Amadeus_Elementor()
	 * @return Amadeus_Elementor Main instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'amadeus-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->log_version_number();
	}

	/**
	 * Log the plugin version number.
	 *
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Check if Elementor is installed.
	 *
	 * @access  private
	 * @since   1.0.1
	 * @return  void
	 */
	private function is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}

	/**
	 * Add notice if Elementor is not activated.
	 *
	 * @return void
	 */
	public function show_notices() {
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if ( $this->is_elementor_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = '<p>' . __( 'Amadeus Elementor is not working because you need to activate the Elementor plugin.', 'amadeus-elementor' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'amadeus-elementor' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = '<p>' . __( 'Amadeus Elementor is not working because you need to install the Elementor plugin.', 'amadeus-elementor' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'amadeus-elementor' ) ) . '</p>';
		}

		echo '<div class="error">' . $message . '</div>';
	}

	/**
	 * Setup all the things.
	 *
	 * @return void
	 */
	public function setup() {
		require AMADEUS_ELEMENTOR_PATH . 'includes/class-amadeus-notices.php';
		require AMADEUS_ELEMENTOR_PATH . 'includes/plugin.php';
		require_once AMADEUS_ELEMENTOR_PATH . 'includes/admin/settings.php';
		require_once AMADEUS_ELEMENTOR_PATH . 'includes/helpers.php';

		// If header or footer selected.
		if ( amadeus_header_enabled() || amadeus_footer_enabled() ) {
			if ( 'hello-elementor' === $this->template ) {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/class-hello-elementor-theme.php';
			} elseif ( 'generatepress' === $this->template ) {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/class-generatepress-theme.php';
			} elseif ( 'astra' === $this->template ) {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/class-astra-theme.php';
			} elseif ( 'oceanwp' === $this->template ) {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/class-oceanwp-theme.php';
			} elseif ( 'storefront' === $this->template ) {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/class-storefront-theme.php';
			} else {
				require_once AMADEUS_ELEMENTOR_PATH . 'includes/themes/default/class-default-theme.php';
			}

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_header_footer_scripts' ) );
		}
	}

	/**
	 * Save default widgets values to database.
	 *
	 * @since 1.0.0
	 */
	public function save_widgets_db() {
		// If the widgets are not already in the database.
		if ( ! get_option( 'zeus_settings' ) ) {
			$defaults = array_fill_keys( array_keys( $GLOBALS['amadeus_widgets'] ), 1 );
			$elements = array_merge( $defaults, array_fill_keys( array_keys( $defaults ), true ) );

			// Update new settings.
			return update_option( 'zeus_settings', $elements );
		}
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_header_footer_scripts() {
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}

		if ( class_exists( '\ElementorPro\Plugin' ) ) {
			$elementor_pro = \ElementorPro\Plugin::instance();
			$elementor_pro->enqueue_styles();
		}

		if ( amadeus_header_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( amadeus_header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( amadeus_header_id() );
			}

			$css_file->enqueue();
		}

		if ( amadeus_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( amadeus_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( amadeus_footer_id() );
			}

			$css_file->enqueue();
		}
	}

}
