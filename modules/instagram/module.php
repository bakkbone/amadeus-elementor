<?php
namespace AmadeusElementor\Modules\Instagram;

use AmadeusElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Instagram',
		];
	}

	public function get_name() {
		return 'amadeus-instagram';
	}

	public function __construct() {
		parent::__construct();
		require_once AMADEUS_ELEMENTOR_PATH . 'includes/class-amadeus-instagram-api.php';
	}
}
